<?php

namespace App\Telegram\Commands;

use SergiX44\Nutgram\Nutgram;

class StartCommand
{
    public function __invoke(Nutgram $bot): void
    {
        $bot->sendMessage(__('Hello world'));
    }
}
