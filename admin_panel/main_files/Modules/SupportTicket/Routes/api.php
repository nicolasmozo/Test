<?php

use Illuminate\Http\Request;
use Modules\SupportTicket\Http\Controllers\Api\TicketMessageController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['demo','XSS', 'HtmlSpecialchars']], function () {
    Route::group(['middleware' => ['maintainance']], function () {
        Route::prefix('user')->group(function () {
            Route::get('ticket-list', [TicketMessageController::class, 'ticket_list'])->name('ticket-list');
            Route::get('create-ticket', [TicketMessageController::class, 'create_ticket'])->name('create-ticket');
            Route::post('ticket-request', [TicketMessageController::class, 'ticket_request'])->name('ticket-request');
            Route::get('show-ticket/{id}', [TicketMessageController::class, 'show_ticket'])->name('show-ticket');
            Route::post('send-ticket-message', [TicketMessageController::class, 'send_ticket_message'])->name('send-ticket-message');
        });
    });

});
