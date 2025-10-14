<?php

namespace Solutions\Contact\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Solutions\Contact\Models\ContactMessage;

class ContactSubmitController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['nullable', 'email', 'max:255'],
            'phone'      => ['nullable', 'string', 'max:50'],
            'subject'    => ['required', 'string', 'max:255'],
            'message'    => ['required', 'string'],
            'attachment' => ['nullable', 'file', 'max:10240'], // ~10MB
            'meta'       => ['nullable', 'array'],
        ]);

        $payload = [
            'name'        => $data['name'],
            'email'       => $data['email'] ?? null,
            'phone'       => $data['phone'] ?? null,
            'subject'     => $data['subject'],
            'message'     => $data['message'],
            'meta'        => $data['meta'] ?? [],   // JSON array
            'attachments' => null,                  // JSON array أو null
            'is_read'     => 0,
            'status'      => 0,                     // 0 = new
        ];

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('contact', 'public');
            $payload['attachments'] = [$path];
        }

        $msg = ContactMessage::create($payload);

        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'ok'   => true,
                'id'   => $msg->id,
                'msg'  => 'Created',
            ], 201);
        }

        return back()->with('ok', __('contact::messages.sent'));
    }
}
