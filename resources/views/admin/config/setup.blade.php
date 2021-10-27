@extends('layouts.layout') 

@section('title') Setup Configuration @endsection 

@section('page_name') Setup Configuration @endsection @section('content')

<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div style="min-height: 300px;">
                        <h3>Setup Configuration</h3>
                        <hr />
                        @if (session('message'))
                        <div class="alert alert-danger" role="alert">{{ session('message') }}</div>
                        @endif
                        <form action="/admin/store-config" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="user_id" value="{{ Auth()->user()->id  }}" />

                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Currency Type:</label>
                                <div class="col-md-3">
                                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                        <span class="input-group-text input-group-addon currency-symbol">$</span>
                                        <div class="input-group-addon currency-addon">
                                            <select class="currency-selector" name="currency_type" required>
                                                <option data-symbol="-" data-placeholder="0.00" value="-">Select</option>
                                                <option data-symbol="₹" data-placeholder="0.00" value="₹" selected>INR</option>
                                                <option data-symbol="₱" data-placeholder="0.00" value="₱">PHP</option>
                                                <option data-symbol="RM" data-placeholder="0.00" value="RM">MYR</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Country Code:</label>
                                <div class="col-md-2">
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="country_code" value="" placeholder="Country Code" aria-label="Country Code" aria-describedby="Country Code" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Service Charges:</label>
                                <div class="col-md-2">
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="service_charges" value="" placeholder="Service Charges" aria-label="Service Charges" aria-describedby="Service Charges" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label"> </label>
                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit">Setup Configuration</button>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Country</th>
                                        <th>Country Code</th>
                                        <th>Curreny Code</th>
                                        <th>Service Charges </th>
                                        <th>Action </th>                                    
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($data as $config) 
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    @if($config->currency_type == "₹")
                                        <td>Indian</td>
                                    @elseif($config->currency_type == "₱")
                                        <td>Philippines</td>
                                    @elseif($config->currency_type == "RM")
                                        <td>Malaysia</td>
                                    @elseif($config->currency_type == "£")
                                        <td>Ireland</td>
                                    @else
                                        <td> - </td>
                                    @endif
                                    <td>{{ $config->country_code }}</td>
                                    <td>{{ $config->currency_type }}</td>
                                    <td>{{ $config->service_charges }} %</td>           
                                    <td>
                                        <a onclick="return confirm('Really want to delete?')" href="{{ url('/admin/destory-account/'. $config  ->id ) }}"> <span style="font-size:20px"><i class="mdi mdi-delete" style="color: red !important;"></i></span></a>
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
</div>


@endsection
