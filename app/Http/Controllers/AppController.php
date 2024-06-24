<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function changeLanguage($locale)
    {
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
