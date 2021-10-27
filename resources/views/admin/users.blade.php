@extends('layouts.layout')

@section('title')
    All Users 
@endsection

@section('page_name')
    All Users 
@endsection

@section('content')
<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div style="min-height: 300px;">
                        <h3>
                            All Users
                            <a href="{{ url('/admin/add_user') }}" class="btn btn-primary waves-effect waves-light">Add User</a>
                        </h3>
                        <hr />
                        @if (session('message'))
                        <div class="alert alert-danger" role="alert">{{ session('message') }}</div>
                        @endif
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>QR code</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach( $datas as $data)
                                <tr>
                                    <td>{{$loop->iteration}} </td>
                                    <td>
                                        <a href="{{ url('/admin/edit_profile/'. $data->id ) }}" class="text-dark">
                                            {{ $data->name}} <i class="mdi mdi-lead-pencil"></i>
                                        </a>
                                    </td>
                                    <td>{{ $data->mobile }}</td>
                                    <td>{{ $data->email }}</td>
                                    <!-- QR Code Start -->
                                    <td>
                                        @php
                                            if($data->qrcode == '')
                                                {
                                                    $qr = 'Create';
                                                    $createqr = "createqr";
                                                    $download = '';
                                                }
                                                else{
                                                    $qr = 'View';
                                                    $createqr = "viewqr";
                                                    $download = 'Download';                                                            
                                                }
                                        @endphp
                                        @if($data->qrcode == '')
                                        <a data-id="{{$data->id}}" src="{{ URL::to('images/' .$data->qrcode.'.png') }}" class="popup btn btn-default {{$createqr}} text-dark">{{ $qr }}</a>

                                        @else

                                        <img src="{{ URL::to('public/images/' .$data->qrcode.'.png') }}" data-id="{{$data->id}}" alt="QR Code" height="50" width="50"/>

                                        <a data-qr="{{$data->qrcode}}" data-id="{{$data->id}}" style="color: #3c5d7b !important;" href="{{ URL::to('public/images/' .$data->qrcode.'.png') }}" class="popup downloadqr btn btn-default {{$createqr}}" download><i class="fa fa-download" aria-hidden="true"></i></a>

                                        @endif
                                    </td>
                                    <!-- QR Code End -->
                                    <td>@if($data->is_admin == 0) User @elseif($data->is_admin == 1) Admin @endif</td>
                                    <td>
                                    <a href="{{ url('/admin/profile/'. $data->id ) }}" target="_blank"> <i class="mdi mdi-eye fa-2x"></i></a>
                                        @if($data->status == 'Active')
                                        <a onclick="return confirm('Really want to Change status to Inactive?')" href="{{ url('/admin/status/Inactive/'. $data->id ) }}"> <i class="mdi mdi-account-check fa-2x"></i></a>
                                        @elseif($data->status == 'Inactive')
                                        <a onclick="return confirm('Really want to Change status to Active?')" href="{{ url('/admin/status/Active/'. $data->id ) }}"> <i class="mdi mdi-account-off fa-2x"></i></a>
                                        @endif
                                        <a onclick="return confirm('Really want to delete?')" href="{{ url('/admin/delete_profile/'. $data->id ) }}"> <i class="mdi mdi-delete fa-2x"></i></a>
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
</div>

@endsection
