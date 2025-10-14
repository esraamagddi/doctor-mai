<?php

namespace Solutions\Contact\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Solutions\Contact\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $q = ContactMessage::query();

        if ($request->filled('q')) {
            $term = '%'.trim((string) $request->input('q')).'%';
            $q->where(function ($qq) use ($term) {
                $qq->where('name', 'like', $term)
                   ->orWhere('email', 'like', $term)
                   ->orWhere('phone', 'like', $term)
                   ->orWhere('subject', 'like', $term)
                   ->orWhere('message', 'like', $term);
            });
        }

        $filterRead = $request->query('is_read');
        if (in_array((string) $filterRead, ['0', '1'], true)) {
            $q->where('is_read', (int) $filterRead);
        }

        $q->orderByDesc('id');
        $perPage = $request->integer('per_page') ?: 20;
        $items = $q->paginate($perPage);

        return view('contact::index', compact('items'));
    }

    public function show(ContactMessage $message)
    {
        return view('contact::show', compact('message'));
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('contact.index')->with('ok', __('contact::messages.deleted'));
    }

    public function mark(Request $request, ContactMessage $message)
    {
        $data = $request->validate([
            'read' => ['required', 'boolean'],
        ]);

        $message->is_read = (int) $data['read'];
        $message->save();

        return back()->with('ok', __('contact::messages.updated'));
    }

    public function bulk(Request $request)
    {
        $data = $request->validate([
            'ids'    => ['required', 'array'],
            'ids.*'  => ['integer', 'exists:contact_messages,id'],
            'action' => ['required', 'in:read,unread,delete'],
        ]);

        if ($data['action'] === 'delete') {
            ContactMessage::whereIn('id', $data['ids'])->delete();
        } else {
            $flag = $data['action'] === 'read' ? 1 : 0;
            ContactMessage::whereIn('id', $data['ids'])->update(['is_read' => $flag]);
        }

        return back()->with('ok', __('contact::messages.updated'));
    }
}
