<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    } //end of index

    public function welcome()
    {
        return view('welcome');
    }//end of welcom
}
