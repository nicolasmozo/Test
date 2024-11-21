@php
$unseenMessages = Modules\SupportTicket\Entities\TicketMessage::where('unseen_admin', 0)->groupBy('ticket_id')->get();
$count = $unseenMessages->count();
@endphp

<li class="{{ Route::is('admin.ticket') || Route::is('admin.ticket-show') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.ticket') }}">
        <i class="fas fa-envelope-open-text"></i>
         <span>{{__('admin.Support Ticket')}} <sup class="badge badge-danger">{{ $count }}</sup></span>
    </a>
</li>
