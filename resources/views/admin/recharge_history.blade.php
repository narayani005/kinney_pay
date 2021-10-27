@extends('layouts.layout')

@section('title')
Recharge History
@endsection

@section('page_name')
Recharge History
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
                        Recharge History
                        <!--a href="{{ url('/admin/add_wallet') }}" class="btn btn-primary waves-effect waves-light">Add Wallet</a--> 
                        
                    </h3> 
                    <hr/>

                    @if (session('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
<table id="datatable" class="table table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                <tr>
                                                        <th>#</th>
                                                        <th>User Name</th>
                                                        <th>Mobile</th>
                                                        <th>Admin Name</th>
                                                        <th>Rechaged Amount</th>
                                                        <th>Received Date Time</th>
                                                        <th>Remarks</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($datas as $data)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $data->paid_user_name }}</td>
                                                        <!--td>System Architect</td-->
                                                      
                                                        <td>{{ $data->paid_user_mobile }}</td>
                                                       
                                                        <td>{{ $data->admin_name }}</td>
                                                        <td> ₹ {{ $data->recharged_amt }} </a></td>
                                                        <td>{{ $data->recharged_date }} - {{ $data->recharged_time }}</td>
                                                        <td>{{ $data->remark }}</td>
                                                        <td>{{ $data->status }}</td>
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