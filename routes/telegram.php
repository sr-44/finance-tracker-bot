<?php

use App\Enums\ExpenseCategoryEnum;
use App\Telegram\Commands\ShowHelpCommand;
use App\Telegram\Commands\ShowProfileCommand;
use App\Telegram\Conversations\AddExpenseConversation;
use App\Telegram\Conversations\AddIncomesConversation;
use SergiX44\Nutgram\Nutgram;
use App\Telegram\Handlers\CancelHandler;
use App\Telegram\Middleware\RegisterUser;

/** @var Nutgram $bot */

/*
|--------------------------------------------------------------------------
| Nutgram Handlers
|--------------------------------------------------------------------------
|
| Here is where you can register telegram handlers for Nutgram. These
| handlers are loaded by the NutgramServiceProvider. Enjoy!
|
*/

$bot->middleware(RegisterUser::class);

$bot->onCommand('start', CancelHandler::class);
$bot->onCommand('profile', ShowProfileCommand::class);
$bot->onCommand('help', ShowHelpCommand::class);
$bot->onText(__('texts.kbd.cancel'), CancelHandler::class);


$bot->onText(__('texts.kbd.add_incomes'), AddIncomesConversation::class);
$bot->onText(__('texts.kbd.add_expense'), AddExpenseConversation::class);
$bot->onText(__('texts.kbd.profile'), ShowProfileCommand::class);
$bot->onText(__('texts.kbd.help'), ShowHelpCommand::class);
