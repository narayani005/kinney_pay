@extends('layouts.layout')

@section('title')
Withdraw History
@endsection

@section('page_name')
Withdraw History
@endsection

@section('content')
<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Demo purpose only -->
                    <div style="min-height: 300px;">
                        <h3>
                            Withdraw History
                            <!--a href="{{ url('/admin/add_wallet') }}" class="btn btn-primary waves-effect waves-light">Add Wallet</a-->
                        </h3>
                        <hr />

                        @if (session('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Reference ID</th>
                                    <!--th>Position</th>
                                    <th>Office</th-->
                                    <th>Withdraw Amount</th>
                                    <th>Withdraw on</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($datas as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->req_id }}</td>
                                    <!--td>System Architect</td-->

                                    <td>{{ $data->req_amt }}</td>

                                    <td>{{ $data->created_at }}</td>
                                    @if($data->status == 'Approved')
                                    <td><i class="mdi mdi-checkbox-marked-circle-outline fa-2x"></i> Approved</td>
                                    @elseif($data->status == 'Cancelled')
                                    <td><i class="mdi mdi-alert-circle fa-2x"></i> Cancelled</td>
                                    @else
                                    <td>
                                        <a onclick="return confirm('Really want to Approve?')" href="{{ url('/withdraw_money/Approved/'. $data->id ) }}">
                                            <i class="mdi mdi-checkbox-marked-circle fa-2x"></i> <span class="text-dark"> </span>
                                        </a>
                                        <a onclick="return confirm('Really want to Cancel?')" href="{{ url('/withdraw_money/Cancelled/'. $data->id ) }}"> <i class="mdi mdi-alert-circle fa-2x"></i> </a>
                                    </td>
                                    @endif
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