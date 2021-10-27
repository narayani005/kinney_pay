@extends('layouts.layout')

@section('title')
    Wallet History
@endsection

@section('page_name')
    Wallet History 
@endsection

@section('content')
<div class="page-content-wrapper">
<div class="row">
@foreach($datas as $data)
                                <div class="col-xl-3 col-md-6">
                                    <div class="card bg-primary mini-stat position-relative">
                                        <div class="card-body">
                                            <div class="mini-stat-desc">
                                                <h5 class="text-uppercase verti-label font-size-16 text-white-50">Wallet
                                                </h5>
                                                
                                                <div class="text-white">
                                                    <h5 class="text-uppercase font-size-16 text-white-50"> cc </h5>
                                                    <h3 class="mb-3 text-white">{{ $data->trans_amt }}</h3>
                                                    <div class="">
                                                    <!--a href=""><h4><span class="badge bg-dark">  Share </span></h4> </a--> 
                                                    
                                                    <h5 class="text-uppercase font-size-16 text-white"> 
                                                        @if(Auth()->user()->id == $data->trans_by_id)
                                                            Transferred To {{ $data->trans_to_name }}
                                                        @elseif(Auth()->user()->id == $data->trans_to_id)
                                                            Credited By {{ $data->trans_by_name }}
                                                        @else

                                                        @endif
                                                        
                                                    </h5> 
                                                    <h5 class="text-uppercase font-size-10 text-white-50"> On {{ $data->trans_on }}</h5>
                                                    <h5 class="text-uppercase font-size-16 text-white-50"> Status {{ $data->status }}</h5> 
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