<?php

/** @var Nutgram $bot */

use App\Telegram\Commands\ShowActionsCommand;
use App\Telegram\Commands\ShowHelpCommand;
use App\Telegram\Commands\ShowProfileCommand;
use App\Telegram\Conversations\AddExpenseConversation;
use App\Telegram\Conversations\AddIncomesConversation;
use App\Telegram\Conversations\ShowExpensesConversations;
use App\Telegram\Conversations\ShowIncomesConversations;
use SergiX44\Nutgram\Nutgram;
use App\Telegram\Handlers\CancelHandler;
use App\Telegram\Middleware\RegisterUser;


$bot->middleware(RegisterUser::class);

$bot->onCommand('start', CancelHandler::class);
$bot->onCommand('profile', ShowProfileCommand::class);
$bot->onCommand('help', ShowHelpCommand::class);
$bot->onCommand('cancel', CancelHandler::class);
$bot->onCallbackQueryData('cancel', CancelHandler::class);
$bot->onText(__('texts.kbd.cancel'), CancelHandler::class);
$bot->onText(__('texts.kbd.main'), CancelHandler::class);
$bot->onText(__('texts.kbd.add_incomes'), AddIncomesConversation::class);
$bot->onText(__('texts.kbd.add_expense'), AddExpenseConversation::class);
$bot->onText(__('texts.kbd.profile'), ShowProfileCommand::class);
$bot->onText(__('texts.kbd.help'), ShowHelpCommand::class);
$bot->onText(__('texts.kbd.show_recent_actions'), ShowActionsCommand::class);
$bot->onText(__('texts.kbd.show.incomes'), ShowIncomesConversations::class);
$bot->onText(__('texts.kbd.show.expenses'), ShowExpensesConversations::class);

