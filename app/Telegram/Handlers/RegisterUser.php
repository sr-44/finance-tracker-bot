<?php

namespace App\Telegram\Handlers;

use App\Models\User;
use App\Telegram\Commands\StartCommand;
use Carbon\Carbon;
use SergiX44\Nutgram\Nutgram;

class RegisterUser
{
    public function __invoke(Nutgram $bot, $next, $lang): void
    {
        $user = User::where('chat_id', $bot->userId())->get()->first();
        
        if (!$user) {
            User::create([
                'chat_id' => $bot->userId(),
                'username' => $bot->user()->username,
                'locale' => $lang,
                'last_activity' => Carbon::now(),
            ]);
            StartCommand::class;
        } else {
            $user->touch('last_activity');
        }

        app()->instance(User::class, $user);

        $next($bot);
    }
}
