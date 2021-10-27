@extends('layouts.layout') 

@section('title') Add Beneficiary @endsection 

@section('page_name') <i class="mdi mdi-account-plus" style="color:white;"></i> Beneficiary @endsection @section('content')

<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Demo purpose only -->
                    <div style="min-height: 300px;">
                        <h3><i class="mdi mdi-account-plus"></i> Beneficiary </h3>
                        <hr />
                        @if (session('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif
                        <form action="/check-beneficiary" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="user_id" value="{{ Auth()->user()->id  }}" />

                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Beneficiary Name:</label>
                                <div class="col-md-2" style="width: 266px;">
                                    <input class="form-control" name="benefi_name" type="text" value="" style="width:260px;" required/>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Beneficiary Mobile:</label>
                                <div class="col-md-3">
                                    <input class="form-control"  name="benefi_mobile" type="text" id="mobile" value=""  placeholder=" " required />
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label"> </label>
                                <div class="col-md-3">
                                    <button class="btn btn-primary" type="submit"> Save</button>
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
