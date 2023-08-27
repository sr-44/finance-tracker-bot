<?php



use App\Telegram\Handlers\CancelHandler;
use App\Telegram\Middleware\RegisterUser;
use SergiX44\Nutgram\Nutgram;

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
