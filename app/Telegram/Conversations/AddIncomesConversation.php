<?php

namespace App\Telegram\Conversations;

use App\Models\Income;
use App\Telegram\Commands\ShowActionsCommand;
use App\Telegram\Keyboards\MainKeyboard;
use Carbon\Carbon;
use Psr\SimpleCache\InvalidArgumentException;
use SergiX44\Nutgram\Conversations\Conversation;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;

class AddIncomesConversation extends Conversation
{
    /**
     * @throws InvalidArgumentException
     */
    public function start(Nutgram $bot): void
    {

        $bot->sendMessage(
            __('texts.incomes.menu'),
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


    /**
     * @throws InvalidArgumentException
     */
    public function setDescription(Nutgram $bot): void
    {
        $bot->answerCallbackQuery();
        $bot->setUserData('incomes.category', $bot->callbackQuery()->data);
        $bot->sendMessage(__('texts.incomes.set_description'));
        $this->next('saveExpense');
    }


    /**
     * @throws InvalidArgumentException
     */
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


        $bot->sendMessage(__('texts.incomes.success'));
        (new ShowActionsCommand())($bot);
    }

}
