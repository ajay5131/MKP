<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class SelectedLang {
    
    public static function lang($column) {
        return $column . (\App::getLocale() == 'fr' ? '_fr' : '');
    }
}