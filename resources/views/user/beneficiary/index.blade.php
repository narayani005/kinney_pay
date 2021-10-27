@extends('layouts.layout')

@section('title')
    List of Beneficiary
@endsection

@section('page_name')
    <i class="mdi mdi-view-list" style="color: white !important;"></i> List of Beneficiary
@endsection

@section('content')
<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card directory-card">
                <div class="card-body directory-card-bg">
                    <div style="min-height: 300px;">
                    
                    <h3> 
                    <i class="mdi mdi-view-list" style="color: gray !important;"></i> Lists of Beneficiary                        
                    </h3> 
                    @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif
                    <hr/>
                        <a href="{{ url('/create-beneficiary') }}" class="btn btn-primary waves-effect waves-light" style="float: right;"><i class="mdi mdi-account-plus"></i> Add Beneficiary</a> <br><br>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>

                            <tbody>
                            @foreach($datas as $key => $data) 
                            <tr>
                            <td> {{$loop->iteration}} </td>
                            <td>{{ $data->benefi_name }}</td>
                            <td>{{ $data->mobile }}</td>
                            
                            <td> <a  href="{{ url('/edit-beneficiary/'. $data->pid ) }}"> <span style="font-size:20px"><i class="mdi mdi-square-edit-outline" style="color: blue !important;"></i></span></a>
                            <a onclick="return confirm('Really want to delete?')" href="{{ url('/delete-beneficiary/'. $data->pid ) }}"> <span style="font-size:20px"><i class="mdi mdi-delete" style="color: red !important;"></i></span></a></td>
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