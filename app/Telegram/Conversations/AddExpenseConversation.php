<?php

namespace App\Telegram\Conversations;

use App\Enums\ExpenseCategoryEnum;
use App\Models\Expense;
use App\Models\User;
use App\Telegram\Handlers\CancelHandler;
use App\Telegram\Keyboards\MainKeyboard;
use Carbon\Carbon;
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
        $bot->answerCallbackQuery();
        $bot->setUserData('expense.category', $bot->callbackQuery()->data);
        $bot->sendMessage(__('texts.expenses.set_description'));
        $this->next('saveExpense');
    }


    public function saveExpense(Nutgram $bot)
    {
        if ($bot->message()->text === null) {
            $this->setDescription($bot);
            return;
        }

        Expense::create([
            'user_id' => $bot->userId(),
            'amount' => $bot->getUserData('expense.amount'),
            'category' => $bot->getUserData('expense.category'),
            'description' => $bot->message()->text,
            'created_at' => Carbon::now(),
        ]);


        $bot->sendMessage(__('texts.expenses.succes'));
        (new CancelHandler())($bot);
    }

}