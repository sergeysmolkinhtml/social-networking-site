<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send {user?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a friend request email to a user';

    /**
     * Execute the console command.
     */
    public function handle( ): void
    {

    }
}
