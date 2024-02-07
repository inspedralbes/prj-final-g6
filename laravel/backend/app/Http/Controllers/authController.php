<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

    class authController extends Controller
    {
        //

        public function checkAuthentication()
        {
            $authenticated = Auth::check();

            return response(['authenticated' => $authenticated]);
        }
    }
