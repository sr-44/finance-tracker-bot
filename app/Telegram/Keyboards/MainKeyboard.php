<?php

namespace App\Telegram\Keyboards;

use App\Enums\ExpenseCategoryEnum;
use App\Enums\IncomeCategoryEnum;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardMarkup;
use SergiX44\Nutgram\Telegram\Types\Keyboard\KeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\ReplyKeyboardMarkup;

class MainKeyboard
{
    public static function mainMenu(): ReplyKeyboardMarkup
    {
        $markup = new ReplyKeyboardMarkup(true, false, __('texts.kbd.select'));

        $markup->addRow(
            KeyboardButton::make(__('texts.kbd.show_recent_actions'))
        );

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
        $markup = new ReplyKeyboardMarkup(true, false);

        $markup->addRow(
            KeyboardButton::make(__('texts.kbd.cancel'))
        );

        return $markup;
    }

    public static function expenseCategoryMenu(): InlineKeyboardMarkup
    {
        $markup = new InlineKeyboardMarkup();
        foreach (ExpenseCategoryEnum::getAll() as $value) {
            $markup->addRow(InlineKeyboardButton::make(__("texts.expenses.category.$value"), callback_data: $value));
        }
        return $markup;
    }

    public static function incomesCategoryMenu(): InlineKeyboardMarkup
    {
        $markup = new InlineKeyboardMarkup();
        foreach (IncomeCategoryEnum::getAll() as $value) {
            $markup->addRow(InlineKeyboardButton::make(__("texts.incomes.category.$value"), callback_data: $value));
        }
        return $markup;
    }

    public static function showActionsMenu(): ReplyKeyboardMarkup
    {
        $markup = new ReplyKeyboardMarkup(true, false);

        $markup->addRow(
            KeyboardButton::make(__('texts.kbd.add_incomes')),
            KeyboardButton::make(__('texts.kbd.add_expense'))
        );
        $markup->addRow(
            KeyboardButton::make(__('texts.kbd.main'))
        );
        return $markup;
    }
}
