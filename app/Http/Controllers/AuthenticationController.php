<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RequestLoginRequest;
use Illuminate\Support\Facades\Response;

class AuthenticationController extends Controller
{
    /**
     * Handles the register request.
     * 
     * @param App\Http\Requests\RegisterRequest $request
     * @return Illuminate\Support\Facades\Response
     */
    public function register(RegisterRequest $request)
    {
    }

    /**
     * Handles the request login request.
     * 
     * @param App\Http\Requests\RequestLoginRequest $request
     * @return Illuminate\Support\Facades\Response
     */
    public function requestLogin(RequestLoginRequest $request)
    {
    }

    /**
     * Handles the login request.
     * 
     * @param App\Http\Requests\LoginRequest $request
     * @return Illuminate\Support\Facades\Response
     */
    public function login(LoginRequest $request)
    {
    }
}
