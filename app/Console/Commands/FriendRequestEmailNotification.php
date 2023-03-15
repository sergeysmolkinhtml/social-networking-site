<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class FriendRequestEmailNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'friend:request-email {user-id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notification for a new friend request.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $user = User::findOrFail($this->argument('user-id'));

        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'subject' => 'New friend request',
            'message' => 'You have a new friend request. Please log in to your account to accept or reject the request.',
        ];

        Mail::send('emails.friend-request', $data, function($message) use ($data) {
            $message->to($data['email'])
                    ->subject($data['subject'])
                    ->html($data['message']);

        });

        $this->info('Friend request email notification sent successfully.');
    }
}
