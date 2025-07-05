<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class LandingController extends Controller
{
    public function Create(string $lang):Response {
        return Inertia::render('base/Landing', [
            'lang' => $lang, 
            'islogged' => Auth::user() !== null
        ]);
    }

    public function Redirect() {
        return redirect(
            sprintf('%s/landing', app()->getLocale())
        );
    }
}
