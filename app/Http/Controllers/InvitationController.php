<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use App\Http\Resources\CodeResource;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\Invitation\StoreInvitationRequest;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invitations = Invitation::all();

        return Response::json([
            'message' => null,
            'data' => CodeResource::collection($invitations),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInvitationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvitationRequest $request)
    {
        $validated = $request->validated();

        // Check whether the user has already been invited.
        $invitations = Invitation::where('email', $validated['email']);

        if ($invitations->count() > 0) {
            // Delete the previous invitations.
            $invitations->delete();
        }

        // Create a new invitation.
        $invitation = Invitation::create($validated);

        return Response::json([
            'message' => 'The invitation has been stored.',
            'data' => new CodeResource($invitation),
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invitation = Invitation::firstWhere('id', $id);

        // Check whether the invitation has been found.
        if ($invitation === null) {

            return Response::json([
                'message' => 'The invitation has not been found.',
                'data' => null,
            ], 404);
        }

        return Response::json([
            'message' => null,
            'data' => new CodeResource($invitation),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return Response::json([
            'message' => 'The invitation could not be updated',
            'data' => null,
        ], 501);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invitation = Invitation::firstWhere('id', $id);

        // Check whether the invitation has been found.
        if ($invitation === null) {

            return Response::json([
                'message' => 'The invitation has not been found.',
                'data' => null,
            ], 404);
        }

        // Delete the invitation.
        $invitation->delete();

        return Response::noContent();
    }
}
