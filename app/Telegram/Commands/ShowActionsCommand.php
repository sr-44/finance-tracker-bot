<?php

namespace App\Telegram\Commands;

use App\Telegram\Keyboards\MainKeyboard;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;

class ShowActionsCommand
{
    public function __invoke(Nutgram $bot): void
    {
        $bot->sendMessage(__('texts.show_actions'),
            parse_mode: ParseMode::HTML,
            reply_markup: MainKeyboard::showActionsMenu());
    }
}
