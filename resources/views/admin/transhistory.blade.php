@extends('layouts.layout') 

@section('title') Transaction History @endsection 

@section('page_name') Transaction History @endsection @section('content')

<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <!-- Demo purpose only -->
                    <div style="min-height: 300px;">
                        <h3>Transaction History</h3>
                        <hr />
                        <table id='transactionHistory' width='100%'>
                        <thead>
                            <tr>
                            <td>S.NO</td>
                            <td>From Name</td>
                            <td>From ID</td>
                            <td>Transaction ID</td>
                            <td>Score</td>
                            <!-- <td>Transaction To ID</td> -->
                            <td>To Name</td>
                            <td>Wallet Type</td>
                            <td>Remarks</td>
                            <td>Status</td>
                            <td>Date & Time</td>
                            </tr>
                        </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

