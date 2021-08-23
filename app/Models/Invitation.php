<?php

namespace App\Models;

use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Traits\Children;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invitation extends Code
{
    use HasFactory, Children;

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($invitation) {

            $client = new Client([
                'base_uri' => 'https://random-word-api.herokuapp.com',
            ]);

            // Retrieve 4 random words using the client.
            $response = $client->request('GET', 'word', [
                'query' => ['number' => 4, 'swear' => 0],
            ]);

            if ($response->getStatusCode() == 200) {
                // Format the response into a data array.
                $data = json_decode((string) $response->getBody(), true);

                // Reduce words to a maximum length of 5 characters.
                $data = array_map(function ($item) {

                    if (strlen($item) >= 5) {
                        return substr($item, 0, 5);
                    }

                    return $item;
                }, $data);

                // Create the credential.
                $code = implode('-', $data);

                // Set the expires at a week in the future.
                $expires_at = Carbon::now()->addWeek();

                // Update the invitation.
                $invitation->forceFill(['code' => $code, 'expires_at' => $expires_at]);
            }
        });
    }
}
