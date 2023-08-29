<?php

namespace App\Telegram\Conversations;

use App\Enums\ExpenseCategoryEnum;
use App\Models\Expense;
use App\Models\User;
use App\Telegram\Commands\ShowActionsCommand;
use App\Telegram\Handlers\CancelHandler;
use App\Telegram\Keyboards\MainKeyboard;
use Carbon\Carbon;
use Psr\SimpleCache\InvalidArgumentException;
use SergiX44\Nutgram\Conversations\Conversation;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;

class AddExpenseConversation extends Conversation
{
    /**
     * @throws InvalidArgumentException
     */
    public function start(Nutgram $bot): void
    {

        $bot->sendMessage(
            __('texts.expenses.menu'),
            parse_mode: ParseMode::HTML,
            reply_markup: MainKeyboard::cancelMenu()
        );

        $this->next('setCategory');
    }


    /**
     * @throws InvalidArgumentException
     */
    public function setCategory(Nutgram $bot): void
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


    /**
     * @throws InvalidArgumentException
     */
    public function setDescription(Nutgram $bot): void
    {
        $bot->answerCallbackQuery();
        $bot->setUserData('expense.category', $bot->callbackQuery()->data);
        $bot->sendMessage(__('texts.expenses.set_description'));
        $this->next('saveExpense');
    }


    /**
     * @throws InvalidArgumentException
     */
    public function saveExpense(Nutgram $bot): void
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


        $bot->sendMessage(__('texts.expenses.success'));
        (new ShowActionsCommand())($bot);
    }

}
