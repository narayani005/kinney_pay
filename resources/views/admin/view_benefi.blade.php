@extends('layouts.layout')

@section('title')
    List of Beneficiary
@endsection

@section('page_name')
    List of Beneficiary 
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
                            List of Beneficiary
                        </h3>
                        @if(session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                        @endif
                        <hr />
                        <a href="{{ url('/add_benefi') }}" class="btn btn-primary waves-effect waves-light" style="float: right;"><i class="mdi mdi-account-plus"></i> Beneficiary</a> <br><br>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($datas as $data)
                                <tr>
                                    <td>{{ $data->benefi_name }}</td>
                                    <td>{{ $data->mobile }}</td>

                                    <td>
                                        <a href="{{ url('/edit_benefi/'. $data->pid ) }}">
                                            <span style="font-size: 20px;"><i class="mdi mdi-square-edit-outline"></i></span>
                                        </a>
                                        <a onclick="return confirm('Really want to delete?')" href="{{ url('/delete_benefi/'. $data->pid ) }}">
                                            <span style="font-size: 20px;"><i class="mdi mdi-delete"></i></span>
                                        </a>
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