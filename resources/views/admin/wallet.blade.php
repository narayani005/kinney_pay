@extends('layouts.layout')

@section('title')
Transaction History
@endsection

@section('page_name')
Transaction History
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
                        Transaction History
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
                                                        <th>Name (User ID)</th>
                                                        <!--th>Position</th>
                                                        <th>Office</th-->
                                                        <th>Transaction Type</th>
                                                        <th>Transfered By </th>
                                                        <th>Status</th>
                                                        <th>Credited date</th>
                                                        <th>Transferred Amount</th>
                                                        <th> Remarks</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($datas as $data)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $data->trans_to_name }} ({{$data->trans_to_key}} )</td>
                                                        <!--td>System Architect</td-->
                                                        <td>
                                                            @if($data->trans_to_acc_type == 'kinney_pay')
                                                                Kinney Pay
                                                            @elseif($data->trans_to_acc_type == 'kinney_plus')
                                                                Kinney Plus
                                                            @elseif($data->trans_to_acc_type == 'kinney_vpo')
                                                                Kinney VPO
                                                            @else
                                                                Kinney Pay
                                                            @endif
                                                        </td>
                                                        <td>{{ $data->trans_by_name }}</td>
                                                        <td>
                                                            @if($data->status == 'Success' || $data->status == 'Credited')
                                                            <span class="badge bg-soft-success rounded-pill"><i
                                                                        class="mdi mdi-checkbox-blank-circle text-success"></i>
                                                                    <span class="text-dark">{{ $data->status }}</span></span>
                                                            @elseif($data->status == 'Failure' || $data->status == 'Debited')
                                                            <span class="badge bg-soft-danger rounded-pill"><i
                                                                        class="mdi mdi-checkbox-blank-circle text-danger"></i>
                                                                    <span class="text-dark">{{ $data->status }}</span></span>
                                                            @else
                                                            {{ $data->status }}
                                                            @endif    
                                                        </td>
                                                        <td>{{ $data->trans_on }}</td>
                                                        <td> ₹ {{ $data->trans_amt }} </td>
                                                        <td> 
                                                            @if($data->remark == 'self_transaction' || $data->status == 'Credited' || $data->status == 'Debited') 
                                                                Self Transaction 
                                                                @if($data->status == 'Credited') 
                                                                    Credited by 
                                                                    @if($data->wallet_trans == 'kinney_plus')
                                                                        Kinney Plus
                                                                    @elseif($data->wallet_trans == 'kinney_vpo')
                                                                        Kinney VPO
                                                                    @else 
                                                                        Kinney Pay
                                                                    @endif
                                                                @elseif($data->status == 'Debited') 
                                                                    Credited to 
                                                                    @if($data->wallet_trans == 'kinney_plus')
                                                                        Kinney Plus
                                                                    @elseif($data->wallet_trans == 'kinney_vpo')
                                                                        Kinney VPO
                                                                    @else 
                                                                        Kinney Pay
                                                                    @endif
                                                                @else  

                                                                @endif 
                                                            @else {{ $data->remark }} 
                                                            @endif</td>
                                                        <td> <a onclick="return confirm('Really want to delete?')" href="{{ url('/admin/delete_wallet/'. $data->wallet_id ) }}">  <i class="mdi mdi-delete fa-2x"></i></a></td>
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