@extends('admin.master_layout')
@section('title')
    <title>{{__('admin.Languages')}}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                    <h1>{{__('admin.Languages')}}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
                        <div class="breadcrumb-item">{{__('admin.Languages')}}</div>
                </div>
            </div>
            <a href="{{ route('admin.language.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                {{ __('Add New') }}
            </a>
            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                        <tr>
                                            <th >{{__('admin.SN')}}</th>
                                            <th >{{__('admin.Name')}}</th>
                                            <th >{{__('admin.Code')}}</th>
                                            <th >{{__('admin.is Default ?')}}</th>
                                            <th >{{__('admin.Lang Direction')}}</th>
                                            <th >{{__('admin.Status')}}</th>
                                            <th >{{__('admin.Action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($languages as $index => $language)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ $language->lang_name }}</td>
                                                <td>
                                                    {{ $language->lang_code }}
                                                </td>
                                                <td>@php echo $language->isDefaultBadge @endphp </td>
                                                <td>{{ $language->lang_direction }}</td>
                                                <td>@php echo $language->statusBadge @endphp</td>
                                                <td>
                                                    <a href="{{ route('admin.languageEdit',$language->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pen" aria-hidden="true"></i></a>

                                                    @if($language->is_default !== 'Yes')
                                                        <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $language->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    @endif
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
        "use strict";
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/delete-language/") }}'+"/"+id)
        }
    </script>
@endsection
