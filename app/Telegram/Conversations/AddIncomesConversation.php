<?php

namespace App\Telegram\Conversations;

use App\Enums\ExpenseCategoryEnum;
use App\Models\Expense;
use App\Models\Income;
use App\Models\User;
use App\Telegram\Handlers\CancelHandler;
use App\Telegram\Keyboards\MainKeyboard;
use Carbon\Carbon;
use SergiX44\Nutgram\Conversations\Conversation;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;

class AddIncomesConversation extends Conversation
{
    public function start(Nutgram $bot)
    {

        $bot->sendMessage(
            __('texts.incomes.menu'),
            parse_mode: ParseMode::HTML,
            reply_markup: MainKeyboard::cancelMenu()
        );

        $this->next('setCategory');
    }


    public function setCategory(Nutgram $bot)
    {
        if (!is_numeric($bot->message()->text)) {
            $bot->sendMessage(__('texts.numeric_pls'));
            return;
        }

        $bot->setUserData('incomes.amount', $bot->message()->text);
        $bot->sendMessage(
            __('texts.incomes.choose_category'),
            parse_mode: ParseMode::HTML,
            reply_markup: MainKeyboard::incomesCategoryMenu()
        );
        
        $this->next('setDescription');
    }


    public function setDescription(Nutgram $bot)
    {
        $bot->answerCallbackQuery();
        $bot->setUserData('incomes.category', $bot->callbackQuery()->data);
        $bot->sendMessage(__('texts.incomes.set_description'));
        $this->next('saveExpense');
    }


    public function saveExpense(Nutgram $bot)
    {
        if ($bot->message()->text === null) {
            $this->setDescription($bot);
            return;
        }

        Income::create([
            'user_id' => $bot->userId(),
            'amount' => $bot->getUserData('incomes.amount'),
            'category' => $bot->getUserData('incomes.category'),
            'description' => $bot->message()->text,
            'created_at' => Carbon::now(),
        ]);


        $bot->sendMessage(__('texts.incomes.succes'));
        (new CancelHandler())($bot);
    }

}