@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Support Ticket')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Support Ticket')}}</h1>
          </div>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped report_table" id="dataTable">
                            <thead>
                                <tr>
                                    <th>{{__('admin.SN')}}</th>
                                    <th >{{__('admin.From')}}</th>
                                    <th >{{__('admin.Ticket Info')}}</th>
                                    <th >{{__('admin.Unread Message')}}</th>
                                    <th>{{__('admin.Status')}}</th>
                                    <th >{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $index => $ticket)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>
                                            @if ($ticket->ticket_from == 'Client')
                                                <p>
                                                    {{__('admin.Name')}}: <a href="{{ route('admin.customer-show',$ticket->user->id) }}">{{ $ticket->user->name }}</a>
                                                </p>
                                                <p>{{__('admin.User Type')}} : {{__('admin.User')}}</p>
                                                <p>{{__('admin.Email')}} : {{ $ticket->user->email  }}</p>
                                                <p>{{__('admin.Phone')}} : {{ $ticket->user->Phone  }}</p>
                                            @else
                                                <p>
                                                    {{__('admin.Name')}}: <a href="{{ route('admin.provider-show',$ticket->user->id) }}">{{ $ticket->user->name }}</a>
                                                </p>

                                                <p>{{__('admin.User Type')}} : {{__('admin.Seller')}}</p>
                                                <p>{{__('admin.Email')}} : {{ $ticket->user->email  }}</p>
                                                <p>{{__('admin.Phone')}} : {{ $ticket->user->Phone  }}</p>
                                            @endif
                                        </td>
                                        <td>
                                            <p>{{__('admin.Subject')}}: {{ html_decode($ticket->subject) }}</p>
                                            <p>{{__('admin.Ticket Id')}}: {{ $ticket->ticket_id }}</p>
                                            <p>{{__('admin.Order Id')}}: <a href="{{ route('admin.order-show',$ticket->orderItems->order_id) }}">{{ $ticket->orderItems->order_id }}</a></p>
                                            <p>{{__('admin.Created')}}: {{ $ticket->created_at->format('h:m A, d-M-Y') }}</p>
                                        </td>

                                        <td>
                                            @php
                                                $unseen = $ticket->messages->where('admin_id',0)->where('unseen_admin', 0)->count();
                                            @endphp
                                            @if ($unseen > 0)
                                            <span class="badge badge-danger">{{ $unseen }}</span>
                                            @endif

                                        </td>


                                        <td>
                                            @if($ticket->status == 'pending')
                                            <span class="badge badge-danger">{{__('admin.Pending')}}</span>
                                            @elseif ($ticket->status == 'in_progress')
                                            <span class="badge badge-success">{{__('admin.In Progress')}}</span>
                                            @elseif ($ticket->status == 'closed')
                                            <span class="badge badge-danger">{{__('admin.Closed')}}</span>
                                            @endif
                                        </td>
                                        <td>
                                        <a href="{{ route('admin.ticket-show',$ticket->ticket_id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                        <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $ticket->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </td>

                                    </tr>
                                  @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>

<script>
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/ticket-delete/") }}'+"/"+id)
    }
</script>
@endsection
