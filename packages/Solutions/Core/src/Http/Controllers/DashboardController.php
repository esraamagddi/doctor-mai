<?php
namespace Solutions\Core\Http\Controllers;
use App\Http\Controllers\Controller;

class DashboardController extends Controller{

    public function index(){
        return view("core::dashboard");
    }
}