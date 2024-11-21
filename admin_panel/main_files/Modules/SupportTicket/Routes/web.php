<?php

use Illuminate\Support\Facades\Route;
use Modules\SupportTicket\Http\Controllers\Admin\TicketController;
use Modules\SupportTicket\Http\Controllers\Seller\ProviderTicketController;

Route::group(['as'=> 'admin.', 'prefix' => 'admin', 'middleware' => ['demo']],function (){
    Route::get('ticket', [TicketController::class, 'index'])->name('ticket');
    Route::get('ticket-show/{id}', [TicketController::class, 'show'])->name('ticket-show');
    Route::delete('ticket-delete/{id}', [TicketController::class, 'destroy'])->name('ticket-delete');
    Route::put('ticket-closed/{id}', [TicketController::class, 'closed'])->name('ticket-closed');
    Route::post('store-ticket-message', [TicketController::class, 'storeMessage'])->name('store-ticket-message');
});


Route::group(['as'=> 'seller.', 'prefix' => 'seller', 'middleware' => ['demo']],function (){
    Route::get('ticket', [ProviderTicketController::class, 'index'])->name('ticket');
    Route::get('ticket-show/{id}', [ProviderTicketController::class, 'show'])->name('ticket-show');
    Route::post('store-ticket-message', [ProviderTicketController::class, 'storeMessage'])->name('store-ticket-message');
    Route::get('create-new-ticket', [ProviderTicketController::class, 'createNewTicket'])->name('create-new-ticket');
    Route::post('store-new-ticket', [ProviderTicketController::class, 'storeNewTicket'])->name('store-new-ticket');
});
