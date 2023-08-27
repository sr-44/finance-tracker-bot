<?php

namespace App\Telegram\Middleware;


use App\Models\User;
use Carbon\Carbon;
use SergiX44\Nutgram\Nutgram;


class RegisterUser
{
    public function __invoke(Nutgram $bot, $next): void
    {
        $user = User::where('chat_id', $bot->userId())->get()->first();

        if (!$user) {
            User::create([
                'chat_id' => $bot->userId(),
                'username' => $bot->user()->username,
                'last_activity' => Carbon::now(),
            ]);
        } else {
            $user->touch('last_activity');
        }

        app()->instance(User::class, $user);

        $next($bot);
    }
}