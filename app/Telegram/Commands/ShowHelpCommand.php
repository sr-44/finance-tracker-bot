<?php

namespace App\Telegram\Commands;

use SergiX44\Nutgram\Nutgram;

class ShowHelpCommand
{
    public function __invoke(Nutgram $bot): void 
    {
        $bot->sendMessage(__('texts.help'));
    }
}
