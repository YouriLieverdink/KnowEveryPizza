<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Invitation;
use App\Models\Credential;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\RegisterRequest;
use App\Http\Requests\Authentication\RequestLoginRequest;

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
        $validated = $request->validated();

        // Attempt to retrieve the corresponding invitation from the database.
        $invitation = Invitation::where('email', $validated['email'])
            ->where('code', $validated['code'])
            ->first();

        if ($invitation === null) {
            // No invitation could be found within the database.
            return Response::json([
                'message' => 'The provided invitation could not be verified.',
                'data' => null,
            ], 401);
        }

        $now = Carbon::now();

        if ($now > $invitation->expires_at) {
            // The invitation has expired.
            return Response::json([
                'message' => 'The provided invitation has expired.',
                'data' => null,
            ], 401);
        }

        // The invitation was valid, remove it from the database.
        $invitation->delete();

        // Create a new user using the provided email address.
        $user = User::create($validated);

        // Create a personal access token for the user.
        $token = $user->createToken($validated['code']);

        return Response::json([
            'message' => null,
            'data' => [
                'token' => $token->plainTextToken,
            ],
        ], 201);
    }

    /**
     * Handles the request login request.
     * 
     * @param App\Http\Requests\RequestLoginRequest $request
     * @return Illuminate\Support\Facades\Response
     */
    public function requestLogin(RequestLoginRequest $request)
    {
        $validated = $request->validated();

        $user = User::firstWhere('email', $validated['email']);

        //  Check whether a user exists with this email.
        if ($user !== null) {

            // Check whether the user has already received credentials.
            $credentials = Credential::where('email', $validated['email']);

            if ($credentials->count() > 0) {
                // Delete the previous credentials.
                $credentials->delete();
            }

            // Create a credential for the user.
            Credential::create($validated);
        }

        return Response::json([
            'message' => 'The email with the credential has been sent.',
            'data' => null,
        ], 200);
    }

    /**
     * Handles the login request.
     * 
     * @param App\Http\Requests\LoginRequest $request
     * @return Illuminate\Support\Facades\Response
     */
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        // Attempt to retrieve the corresponding credential from the database.
        $credential = Credential::where('email', $validated['email'])
            ->where('code', $validated['code'])
            ->first();

        if ($credential === null) {
            // No credential could be found within the database.
            return Response::json([
                'message' => 'The provided credential could not be verified.',
                'data' => null,
            ], 401);
        }

        $now = Carbon::now();

        if ($now > $credential->expires_at) {
            // The credential has expired.
            return Response::json([
                'message' => 'The provided credential has expired.',
                'data' => null,
            ], 401);
        }

        // The credential was valid, remove it from the database.
        $credential->delete();

        // Retrieve the user from the database.
        $user = User::firstWhere('email', $validated['email']);

        // Create a personal access token for the user.
        $token = $user->createToken($validated['code']);

        return Response::json([
            'message' => null,
            'data' => [
                'token' => $token->plainTextToken,
            ],
        ], 201);
    }
}
