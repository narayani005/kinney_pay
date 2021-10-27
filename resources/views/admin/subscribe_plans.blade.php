@extends('layouts.layout')

@section('title')
Subscribe Plans
@endsection

@section('page_name')
Subscribe Plans
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
                            Subscribe Plans
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
                                    <th>S.NO</th>
                                    <th>User Name</th>
                                    <th>Type of Plans</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
<!--                                         <a onclick="return confirm('Really want to Approve?')" href="">
                                            <i class="mdi mdi-checkbox-marked-circle fa-2x"></i> <span class="text-dark"> </span>
                                        </a>
                                        <a onclick="return confirm('Really want to Cancel?')" href=""> <i class="mdi mdi-alert-circle fa-2x"></i> </a> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection