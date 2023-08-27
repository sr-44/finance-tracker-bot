<?php

namespace App\Telegram\Keyboards;

use SergiX44\Nutgram\Telegram\Types\Keyboard\KeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\ReplyKeyboardMarkup;

class MainKeyboard
{
    public static function mainMenu()
    {
        $markup = new ReplyKeyboardMarkup(true, false, __('texts.kbd.select'));

        $markup->addRow(
            KeyboardButton::make(__('texts.kbd.add_incomes')),
            KeyboardButton::make(__('texts.kbd.add_expense'))
        );

        $markup->addRow(
            KeyboardButton::make(__('texts.kbd.profile'))
        );
        $markup->addRow(
            KeyboardButton::make(__('texts.kbd.help'))
        );

        return $markup;
    }

    public static function cancelMenu(): ReplyKeyboardMarkup
    {
        $markup = new ReplyKeyboardMarkup(true, false, __('text.kbd.select'));

        $markup->addRow(
            KeyboardButton::make(__('text.kbd.cancel'))
        );

        return $markup;
    }
}