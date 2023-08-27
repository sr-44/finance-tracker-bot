<?php

namespace App\Telegram\Middleware;

use App\Models\User;
use Carbon\Carbon;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardMarkup;

class AnswerLocale
{
    public function __invoke(Nutgram $bot, $next): void
    {

        $bot->sendMessage(__('text.lang'), reply_markup: InlineKeyboardMarkup::make()->addRow(
            InlineKeyboardButton::make('EN',
                callback_data: "setlang|en"),
            InlineKeyboardButton::make('RU',
                callback_data: "setlang|ru"),
        )
        );

        $next($bot);
    }
}