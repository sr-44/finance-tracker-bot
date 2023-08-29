<?php

namespace App\Telegram\Middleware;


use App\Models\User;
use App\Telegram\Keyboards\MainKeyboard;
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

            $bot->sendMessage(__('texts.welcome', [
                'name' => $bot->user()->first_name,
            ]), reply_markup: MainKeyboard::mainMenu());
            return;
        }

        $user->touch('last_activity');

        app()->instance(User::class, $user);

        $next($bot);
    }
}
