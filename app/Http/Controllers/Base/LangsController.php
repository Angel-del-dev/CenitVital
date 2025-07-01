<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;

class LangsController extends Controller
{
    public function Get(string $desired_lang, string $desired_section) {
        $DEFAULT_LANG = env('APP_DEFAULT_LANG');

        $PATH = public_path('../lang');
        $LangExt = 'json';
        $LangStr = '';
        if(
            file_exists("$PATH/{$desired_lang}") &&
            file_exists("$PATH/{$desired_lang}/{$desired_section}.{$LangExt}")
        ) {
          $LangStr = file_get_contents("$PATH/{$desired_lang}/{$desired_section}.{$LangExt}");
        } else if(
            file_exists("$PATH/{$DEFAULT_LANG}") &&
            file_exists("$PATH/{$DEFAULT_LANG}/{$desired_section}.{$LangExt}")
        ) {
            $LangStr = file_get_contents("$PATH/{$DEFAULT_LANG}/{$desired_section}.{$LangExt}");
        } else {
            return response()->json(
                ['error' => 'Default translation file is not configured'], 404
            );
        }
        return $LangStr;
    }
}
