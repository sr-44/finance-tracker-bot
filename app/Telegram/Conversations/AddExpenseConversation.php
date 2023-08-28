<?php

namespace App\Telegram\Conversations;

use App\Enums\ExpenseCategoryEnum;
use App\Models\Expense;
use App\Models\User;
use App\Telegram\Keyboards\MainKeyboard;
use SergiX44\Nutgram\Conversations\Conversation;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;

class AddExpenseConversation extends Conversation
{
    public function start(Nutgram $bot)
    {

        $bot->sendMessage(
            __('texts.expenses.menu'),
            parse_mode: ParseMode::HTML,
            reply_markup: MainKeyboard::cancelMenu()
        );

        $this->next('setCategory');
    }

    public function setCategory(Nutgram $bot)
    {
        if (!is_numeric($bot->message()->text)) {
            //$this->start($bot);
            $bot->sendMessage(__('texts.numeric_pls'));
            return;
        }
        $bot->setUserData('expense.amount', $bot->message()->text);
        $bot->sendMessage(
            __('texts.expenses.choose_category'),
            parse_mode: ParseMode::HTML,
            reply_markup: MainKeyboard::expenseCategoryMenu()
        );
        //$this->end();
        $this->next('setDescription');
    }

    public function setDescription(Nutgram $bot)
    {
        $bot->setUserData('expense.category', $bot->callbackQuery()->data);
        $bot->sendMessage(__('texts.expenses.set_description'));
    }

    public function saveExpense(Nutgram $bot)
    {
    }


}