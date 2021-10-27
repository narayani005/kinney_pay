@extends('layouts.layout') 

@section('title') 

Edit Profile 

@endsection 

@section('page_name') 

Edit Profile 

@endsection 

@section('content')
<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Demo purpose only -->
                    <div style="min-height: 300px;">
                        <h3>Edit Profile</h3>
                        <hr />
                        @if (session('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif
                        <form action="/update_user" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Name :</label>
                                <div class="col-md-3">
                                    <input class="form-control" type="text" name="name" value="{{ $data->name }}" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Email :</label>
                                <div class="col-md-3">
                                    <input class="form-control" type="email" name="email" value="{{ $data->email }}" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Mobile :</label>
                                <div class="col-md-1">
                                    <input class="form-control" type="number" name="country_code" value="{{ $data->country_code }}"  />
                                </div>
                                <div class="col-md-2">
                                    <input class="form-control" type="number" name="mobile" maxlength="10" value="{{ $data->mobile }}"  />
                                </div>
                            </div>
                            <div class="mb-3 row">  
                                <label class="col-md-2 col-form-label">Account Type :</label>
                                <div class="col-md-3">
                                    <input class="form-control" type="text" name="trans_type" value="Kinney Pay" disabled />
                                </div>
                            </div>
                           <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Profile Upload :</label>
                                <div class="col-md-2">
                                    <input class="form-control" type="file" name="profile_img" value="{{ $data->profile_img }}" />
                                    <input class="form-control" type="hidden" name="profile_img_hidden" value="{{ $data->profile_img }}" />
                                </div>
                                <div class="col-md-1">
                                     <img class="rounded avatar-lg img-thumbnail" src="{{ URL::to('/images/profile/' .$data->profile_img.'') }}" alt="{{ $data->name }}" />
                                </div>
                             </div>

                            @if($data->is_admin)
                            <!--div class="mb-3 row">
                                <label for="example-password-input" class="col-md-2 col-form-label">Password</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="password" type="text" value="{{ $data->password }}" id="example-password-input" />
                                </div>
                            </div-->
                            @endif

                            @if($data->is_admin)
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Designation</label>
                                <div class="col-md-3">
                                    <select class="form-select" name="role" aria-label="Default select example">
                                        <option selected>Select</option>
                                        <option @if($data->is_admin == 0) selected @endif value="0"> User </option>
                                        <option @if($data->is_admin == 1) selected @endif value="1"> Admin </option>
                                    </select>
                                </div>
                            </div>
                            @endif

                            <div class="mb-3 row">
                            <label class="col-md-2 col-form-label"></label>
                                <div class="col-md-2">
                                    <input type="hidden" value="{{ $data->is_admin }}" class="form-select" name="role" />
                                    <input type="hidden" value="{{ $data->id }}" name="id" class="btn btn-primary" />
                                    <button class="btn btn-primary" type="submit"> Update</button>
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
