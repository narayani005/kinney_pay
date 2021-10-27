@extends('layouts.layout') 

@section('title') Edit Beneficiary @endsection 

@section('page_name') <i class="mdi mdi-square-edit-outline" style="color: white !important;"></i> Beneficiary @endsection @section('content')

<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card directory-card">
                <div class="card-body directory-card-bg">
                    <!-- Demo purpose only -->
                    <div style="min-height: 300px;">
                        <h3><i class="mdi mdi-square-edit-outline" style="color: blue !important;"></i> Beneficiary</h3>
                        <hr />
                        @if (session('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif
                       
                        <form action="/update-beneficiary" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="pkey" value="{{ $data->id  }}" />

                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Beneficiary Name:</label>
                                <div class="col-md-3 col-sm-12">
                                    <input class="form-control" name="benefi_name" type="text" value="{{ $data->benefi_name}}" required/>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Beneficiary Mobile:</label>
                                <div class="col-md-3 col-sm-12">
                                    <input class="form-control" type="text" value="{{ $user->mobile}}"  disabled required/>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label"> </label>
                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit"> Save Changes</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
