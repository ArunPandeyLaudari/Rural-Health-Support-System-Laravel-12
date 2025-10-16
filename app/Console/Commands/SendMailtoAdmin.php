<?php

namespace App\Console\Commands;

use App\Mail\MailtoAdmin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMailtoAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-mailto-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will send a mail to admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Mail::to(config('app.env') === 'local' ?  config('services.mail.test_mail') : 'admin@example.com')->send(new MailtoAdmin());
    }
}
