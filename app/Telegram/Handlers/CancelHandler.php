<?php

namespace App\Telegram\Handlers;

use App\Telegram\Keyboards\MainKeyboard;
use SergiX44\Nutgram\Nutgram;

class CancelHandler
{
    public function __invoke(Nutgram $bot): void
    {
        try {
            $bot->message()?->delete();
        } catch (\Exception) {
        }

        $bot->endConversation();

        $bot->sendMessage(
            __('texts.start', ['name' => $bot->user()->first_name]), reply_markup: MainKeyboard::mainMenu());
    }
}