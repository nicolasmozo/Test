@php
$user = Auth::guard('web')->user();
$unseenMessages = Modules\SupportTicket\Entities\TicketMessage::where(['unseen_user' => 0, 'user_id' => $user->id])->groupBy('ticket_id')->get();
$count = $unseenMessages->count();
@endphp

<li class="{{ Route::is('seller.ticket') || Route::is('seller.ticket-show') || Route::is('seller.create-new-ticket') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('seller.ticket') }}"><i class="fas fa-envelope-open-text"></i>
        <span>{{__('admin.Support Ticket')}} <sup class="badge badge-danger">{{ $count }}</sup></span>
    </a>
</li>
