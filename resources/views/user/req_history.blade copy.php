@extends('layouts.layout')

@section('title')
    Requested Money History
@endsection

@section('page_name')
    Requested Money History
@endsection

@section('content')
<div class="page-content-wrapper">
<div class="row">
@foreach($datas as $data)
                                <div class="col-xl-3 col-md-6">
                                    <div class="card bg-primary mini-stat position-relative">
                                        <div class="card-body">
                                            <div class="mini-stat-desc">
                                                <h5 class="text-uppercase verti-label font-size-16 text-white-50">Requested Money History
                                                </h5>
                                                
                                                <div class="text-white">
                                                    <h5 class="text-uppercase font-size-16 text-white-50"> cc </h5>
                                                    <h3 class="mb-3 text-white"> {{ $data->req_amt }} </h3>
                                                    <div class="">
                                                    @if($data->status == 'Approved')
                                                        <a href="#" class="btn btn-success"> Redeem </a> <br/>
                                                    @else
                                                        <h5 class="text-uppercase font-size-10 text-white-50"> {{ $data->status }} </h5>
                                                
                                                    @endif
                                                    
                                                    <h5 class="text-uppercase font-size-10 text-white-50"> On {{ $data->created_at }} </h5>
                                                    
                                                    </div>
                                                </div>
                                                
                                                <div class="mini-stat-icon">
                                                    <i class="mdi mdi-cube-outline display-2"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                

                                @endforeach

                           


















                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection