<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderMail;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Reservation;

class SendReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // ここの'reminder:send'がコマンドで使われる
    protected $signature = 'reminder:send';

    /**
     * The console command description.
     *
     * @var string
     */
    // コマンドの説明
    protected $description = 'Send reminder emails to all users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today();
        $reservations = Reservation::with('user')
            ->wheredate('date', $today)
            ->get();
        foreach ($reservations as $reservation) {
            return Mail::to($reservation->user->email)->send(new ReminderMail($reservation));
        }
    }
}
