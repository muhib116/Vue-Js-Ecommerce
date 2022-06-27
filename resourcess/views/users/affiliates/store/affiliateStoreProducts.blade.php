@extends('layouts.frontend')
@section('title', 'Picked Products For You')
@section('metatag')

@endsection
@section('css')
  <style type="text/css">
      #wrapper{background: #fdfdfdc7;}
      .ratting label{font-size: 18px;}
      .slider-container{margin-top: 12px;}
      .pagination>li>a, .pagination>li>span{padding: 6px 10px;}

</style>
@endsection
@section('content')
    <div class="container product-detail" style="margin-top:15px">
        @if(count($products)>0)
        <div class="products-list grid row number-col-4 so-filter-gird" style="margin-left: 0px;">
             @include('users.affiliates.store.products')
        </div>

        <div class="product-filter product-filter-bottom filters-panel">
            <div class="col-sm-6 col-md-6 col-lg-6 text-center">
               {{$products->appends(request()->query())->links()}}
              </div>
            <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of total {{$products->total()}} entries ({{$products->lastPage()}} Pages)</div>
        </div>

        @else
        <div style="text-align: center;margin-top: 10px;">
            <h3>Search Result Not Found.</h3>
            <p>We're sorry. We cannot find any matches for your search term</p>
            <i style="font-size: 10rem;" class="fa fa-search"></i>
        </div>
        @endif       
    </div>
@endsection
