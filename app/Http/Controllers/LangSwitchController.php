<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LangSwitchController extends Controller
{
    public function switchLang($lang)
    {
        
        $languages = Language::pluck('code')->toArray();
        if (in_array($lang, $languages)) {
            App::setLocale($lang);
            session()->put('locale', $lang);
        }

        return redirect()->back();
    }
}
