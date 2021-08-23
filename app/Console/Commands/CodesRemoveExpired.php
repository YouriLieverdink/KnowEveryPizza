<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Code;
use Illuminate\Console\Command;

class CodesRemoveExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'codes:remove-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes the expired invitations and credentials from the database.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now()->toDateTimeString();

        // Delete all the expired credentials and invitations.
        Code::whereDate('expires_at', '<', $now)->delete();
    }
}
