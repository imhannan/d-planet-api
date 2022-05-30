<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:thirty';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It will send mail every thirty minutes to the registered user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $emails = User::all()->pluck('email');
        foreach ($emails as $email) {
            $this->mail($email, "Thank you for registering our site");
        }
        return 0;
    }

    protected function mail(string $to, string $body)
    {
        Mail::raw($body, function ($msg) use ($to) {
            $msg->to($to);
        });
    }
}
