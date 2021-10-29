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
                                                        <th>Name (Unique Key)</th>
                                                        <!--th>Position</th>
                                                        <th>Office</th-->
                                                        <th>Transaction Type</th>
                                                        <th>Transfered By (Unique Key)</th>
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
                                                        <td>{{ $data->trans_to_name }} ({{$data->trans_to_key}})</td>
                                                        <!--td>System Architect</td-->
                                                        <td>
                                                            @if($data->trans_to_acc_type == 'kinney_pay')
                                                                Kinney Pay
                                                            @endif
                                                        </td>
                                                        <td>{{ $data->trans_by_name }}  ({{$data->trans_by_key}})</td>
                                                        <td>
                                                            @if($data->status == 'Success')
                                                            <span class="badge bg-soft-success rounded-pill"><i
                                                                        class="mdi mdi-checkbox-blank-circle text-success"></i>
                                                                    <span class="text-dark">{{ $data->status }}</span></span>
                                                            @elseif($data->status == 'Failure')
                                                            <span class="badge bg-soft-danger rounded-pill"><i
                                                                        class="mdi mdi-checkbox-blank-circle text-danger"></i>
                                                                    <span class="text-dark">{{ $data->status }}</span></span>
                                                            @endif    
                                                        </td>
                                                        <td>{{ $data->trans_on }}</td>
                                                        <td> ₹ {{ $data->trans_amt }} </a></td>
                                                        <td> {{ $data->remark }} </a></td>
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