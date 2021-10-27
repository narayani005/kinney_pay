@extends('layouts.layout') 

@section('title') Recharge User Wallet @endsection 

@section('page_name') Recharge User Wallet @endsection @section('content')

<div class="page-content-wrapper">
<div class="row">
<div class="col-12">
<div class="card">
<div class="card-body">
<!-- Demo purpose only -->
<div style="min-height: 300px;">
<h3>Recharge User Wallet</h3>
<hr />
@if (session('message'))
<div class="alert alert-danger" role="alert">
{{ session('message') }}
</div>
@endif
<form action="/admin/recharge" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input type="hidden" name="admin_id" value="{{ Auth()->user()->id }}" />
    <div class="mb-3 row">
        <label for="example-text-input" class="col-md-2 col-form-label"> User Mobile Number :</label>
        <!--div class="col-md-3">
            <input type="text" class="form-control" id="mobile" value=" " name ="mobile" required>
        </div-->
        <div class="col-md-3">
        
            <input type="text" name ="mobile" list="user_list" class="form-control" required >
                <datalist id="user_list">
                <option value=" "> </option>
                @foreach($datas as $data)
                <option value="{{$data->mobile}}">{{$data->name}}</option>
                @endforeach
                
                </datalist>

            <span id="errmsg" style="color: red;"></span>
         
        </div>
       
    </div>
  
    <div class="mb-3 row">
        <label for="example-text-input" class="col-md-2 col-form-label"> Amount :</label>
        <div class="col-md-3">
            <input class="form-control" name="amount" type="text" id="amount" required/>
            <span id="errmsg" style="color: red;"></span>
        </div>
    </div> 
    <div class="mb-3 row">
        <label for="example-text-input" class="col-md-2 col-form-label"> Cash received on :</label>
        <div class="col-md-2">
            <input class="form-control" name="date" type="date" id="date" max="<?= date('Y-m-d'); ?>" required/>
            <span id="errmsg" style="color: red;"></span>
        </div>
        <div class="col-md-1">
            <input class="form-control" name="time" type="time" id="time" required/>
            <span id="errmsg" style="color: red;"></span>
        </div>
    </div>  
    <div class="mb-3 row">
        <label for="example-text-input" class="col-md-2 col-form-label"> Remarks :</label>
        <div class="col-md-3">
            <textarea class="form-control" name="remark" id="remark" value="" required></textarea>
            <span id="errmsg" style="color: red;"></span>
        </div>
    </div>  
    
    <div class="mb-3 row">
    <label class="col-md-2 col-form-label"> </label>
    <div class="col-md-3">
    <button class="btn btn-primary" type="submit"> Recharge </button>
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

