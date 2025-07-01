<?php

namespace App\Http\Controllers\base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LandingController extends Controller
{
    public function Create(string $lang):Response {
        return Inertia::render('base/Landing', ['lang' => $lang]);
    }

    public function Redirect() {
        return redirect(
            sprintf('%s/landing', app()->getLocale())
        );
    }
}
