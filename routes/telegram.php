<?php

/** @var Nutgram $bot */

use App\Telegram\Commands\StartCommand;
use App\Telegram\Middleware\AnswerLocale;
use App\Telegram\Handlers\RegisterUser;
use SergiX44\Nutgram\Nutgram;



/*
|--------------------------------------------------------------------------
| Nutgram Handlers
|--------------------------------------------------------------------------
|
| Here is where you can register telegram handlers for Nutgram. These
| handlers are loaded by the NutgramServiceProvider. Enjoy!
|
*/

$bot->middleware(AnswerLocale::class);
//$bot->middleware(RegisterUser::class);

$bot->onCallbackQueryData('setlang|{lang}', RegisterUser::class);
//$bot->onCommand('start', StartCommand::class)->description('The start command!');
