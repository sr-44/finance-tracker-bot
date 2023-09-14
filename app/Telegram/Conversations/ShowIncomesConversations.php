<?php

namespace App\Telegram\Conversations;

use App\Models\Expense;
use App\Models\Income;
use Mockery\Exception;
use Psr\SimpleCache\InvalidArgumentException;
use SergiX44\Nutgram\Conversations\Conversation;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardMarkup;

class ShowIncomesConversations extends Conversation
{
    /**
     * @throws InvalidArgumentException
     */
    public function start(Nutgram $bot): void
    {
        $this->showActions($bot->getUserData('page.expenses', default: 1));
    }

    /**
     * @throws InvalidArgumentException
     */
    public function showActions($page = 1, $toEdit = false): void
    {
        $incomes = Income::where('user_id', $this->bot->userId())->orderBy('created_at', 'desc')->paginate(5, page: $page);

        if ($incomes->count() < 1) {
            $this->bot->sendMessage(__('texts.nothing'));
            return;
        }

        // $navButton = new InlineKeyboardMarkup();
        $navButton = [];
        if ($incomes->lastPage() > 1) {
            if ($incomes->currentPage() > 1) {
                $navButton[] = InlineKeyboardButton::make(
                    __('text.kbd.prev', ['status' => '👈']),
                    callback_data: 'prev_changePage'
                );
            } else {
                $navButton[] = InlineKeyboardButton::make(
                    __('text.kbd.prev', ['status' => '❌']),
                    callback_data: 'error_changePage'
                );
            }

            if (!$incomes->hasMorePages()) {
                $navButton[] = InlineKeyboardButton::make(
                    __('text.kbd.next', ['status' => '❌']),
                    callback_data: 'error_changePage'
                );
            } else {
                $navButton[] = InlineKeyboardButton::make(
                    __('text.kbd.next', ['status' => '👉']),
                    callback_data: 'next_changePage'
                );
            }
        }
        $str = '';
        foreach ($incomes as $income) {
            $description = $income->description;
            if ($income->description == 0){
                $description = 'Нет описания';
            }
            $str .=
                "Сумма: {$income->amount}
Категория: {$income->category}
Описание: $description
Удалить: /del{$income->id}
\n\n";
        }

        $button = new InlineKeyboardMarkup();
        $button->addRow(...$navButton);
        $button->addRow(InlineKeyboardButton::make(__('texts.kbd.cancel'), callback_data: 'cancel'));
        if ($toEdit) {
            $this->bot->editMessageText(__('texts.show_expenses', ['actions' => $str]), reply_markup: $button);
        } else {
            $this->bot->sendMessage(__('texts.show_expenses', ['actions' => $str]), reply_markup: $button);
        }
        //$this->end();
        $this->next('changePage');
    }

    /**
     * @throws InvalidArgumentException
     */
    public function changePage(Nutgram $bot): void
    {
        $arr = ['next_changePage', 'error_changePage', 'prev_changePage'];
        if ($bot->callbackQuery() === null || !in_array($bot->callbackQuery()->data, $arr, true)) {
            try {
                $bot->deleteMessage($bot->chatId(), $bot->messageId());
            } catch (Exception) {
            }
            return;
        }
        $step = explode('_', $bot->callbackQuery()->data)[0];
        $currentPage = (int)$bot->getUserData('page.expenses', default: 1);

        if ($step === 'next') {
            $currentPage++;
        } elseif ($step === 'prev') {
            $currentPage--;
        } else {
            $bot->answerCallbackQuery(text: __('text.nothing'), show_alert: true);
            return;
        }

        $this->showActions($currentPage, true);
        $bot->setUserData('page.expenses', $currentPage);
    }
}
