@extends('layouts.frontend')
@section('title', 'Affiliate Products')
@section('css')
    <link href="{{asset('assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
           <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    
    <style type="text/css">
    #user-dashboard .card{border-radius: 5px; }
    .d-flex {
        display: flex!important;
    }
    .icon-box i{font-size: 3rem}
    .ml-auto, .mx-auto {
        margin-left: auto!important;
    }
    table .form-control{min-width: 75px; padding: 5px;}
    table th{text-transform: capitalize;}
    .commissionStatus{font-size: 10px;color: red;line-height: normal;margin: 0 0 2px;}
    .user-box{padding: 10px; margin-bottom: 10px;}
    .card-title, .icon-box{color: #fff}
    .user-box a{    font-size: 2.5rem !important; color: #fff}
    #user-dashboard{padding-top: 15px;}
    #user-dashboard section{background: #fff;margin-bottom: 10px;padding: 10px 0;}
    .pagination{margin: 0}

    .clockdiv{margin-bottom: 5px;}
    .count{ display: inline-flex; margin: 0 auto; text-align: center; align-items: center;}
    .count_d {position: relative;padding: 2px 2px 4px;margin: 0px 1px;border-radius: 5px;background: #0c0c0c6b;overflow: hidden;}
    .count_d:before{ content: '';  position: absolute;top: 0;left: 0;width: 100%;height: 50%;}
    .count_d span { display: block; text-align: center; font-size: 12px; font-weight: 800;color: #fff;}
    .count_d h2 { display: block; text-align: center;color: #fff; font-size: 7px; font-weight: 600; text-transform: uppercase; margin: 0;}
    .irotate {  text-align: center;  margin: 0 auto; display: block;}
    .thisis { display: inline-block; vertical-align: middle; }
    .slidem { text-align: center; min-width: 90px;}
}
</style>
@endsection
@section('content')
<div class="breadcrumbs">
    <div class="container">
        <ul class="breadcrumb-cate">
            <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="#">Affiliate Program</a></li>
         </ul>
    </div>
</div>
<!-- Main Container  -->
<div class="container">
    <div class="row">
        <!--Right Part Start -->
        @include('users.inc.sidebar')
        <!--Middle Part Start-->
        <div class="col-md-9 sticky-conent" style="margin-top:10px">
            @include('users.affiliates.quicklink')
            
            <div id="content">
                <div class="form-body">
                    <!--/row-->
                    <form action="{{route('agent.affiliateProducts')}}" method="get">
                    <div class="row">
                        <div class="col-md-4 ">
                            <div class="form-group">
                            <input type="text" name="product" value="{{ Request::get('product')}}" id="product_title" class="form-control" placeholder="Product name">
                        </div>
                        </div>
                        <div class="col-md-2 col-xs-4">
                            <div class="form-group">
                                <select name="brand"  class="form-control custom-select select2">
                                    <option value="all">All brand</option>
                                    @foreach($brands as $brand)
                                    <option {{ (Request::get('brand') == $brand->id) ? 'selected' : ''}} value="{{$brand->id}}"> {{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2 col-xs-4">
                            <div class="form-group">
                               
                                <select name="category" class="form-control custom-select select2">
                                    <option value="all">All category</option>
                                    @foreach($categories as $category)
                                    <option {{ (Request::get('category') == $category->id) ? 'selected' : ''}} value="{{$category->id}}" {{ (old('category') == $category->id) ? 'selected' : '' }}> {{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-4">
                            <div class="form-group">
                                <select name="sorting" class="form-control custom-select select2">
                                    <option value="all">Sorting</option>
                                    <option {{ (Request::get('sorting') == 'asc') ? 'selected' : ''}} value="asc"> Low to High</option>
                                    <option {{ (Request::get('sorting') == 'desc') ? 'selected' : ''}} value="desc"> High to Low</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-12">
                            <div class="form-group"><button type="submit" style="width: 100%;" class="btn btn-info"><i class="fa fa-search"></i> Search</button></div>
                        </div>
                    </div>
                    </form>
                    <form action="{{route('agent.agentAffiliateProductStore')}}" id="checkMarkProducts" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <table id="config-table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="checkAll" name=""></th>
                                        <th>Product</th>
                                        <th>Old_Price</th>
                                        <th style="width: 170px;">Set Your Price</th>
                                        <th>Commission</th>
                                        <th>Quantity</th>
                                        <th>Duration</th>
                                        <th>Added</th>
                                    </tr>
                                </thead> 
                                <tbody id="showAllProducts">
                                    @if(count($allproducts)>0)
                                        @foreach($allproducts as $index => $product) 
                                            <tr @if($product->agentProduct) style="background: #ffe2e2" @else id="product{{  $product->product_id }}" @endif>
                                                <td style="text-align: center;">@if(!$product->agentProduct)<input type="checkbox" class="product_id" name="product_id[{{  $product->product_id }}]" > @endif<p> {{(($allproducts->perPage() * $allproducts->currentPage() - $allproducts->perPage()) + ($index+1) )}}</p></td>
                                                <td><a style="color: #000" target="_blank" href="{{ route('product_details', $product->slug) }}"><img width="35" src="{{ asset('upload/images/product/thumb/'. $product->feature_image)}}"> {{Str::limit($product->title, 40)}}</a></td>
                                                <td>{{ Config::get('siteSetting.currency_symble') . $product->office_rate }}</td>
                                                
                                                <td>
                                                    @if($product->agentProduct)
                                                    {{Config::get('siteSetting.currency_symble') . $product->agentProduct->agent_price}}
                                                    @else
                                                    <p class="commissionStatus" id="commissionStatus{{$product->product_id}}"></p>
                                                    <input type="number" min="1" class="form-control" onkeyup ="commissionCalculate({{$product->product_id}}, {{$product->office_rate}}, {{round($product->selling_price)}}, this.value)" value="{{round( $product->selling_price)}}" id="agent_rate{{ $product->product_id }}" name="agent_rate[{{ $product->product_id }}]">
                                                    <i style="font-size:10px;color: #616060;">Price >=  {{Config::get('siteSetting.currency_symble') . round($product->office_rate) }}   And <=   {{ Config::get('siteSetting.currency_symble') . round($product->selling_price)}}</i>
                                                    @endif
                                                </td>
                                                <td id="commission{{ $product->product_id }}">{{ Config::get('siteSetting.currency_symble') . ($product->selling_price - $product->office_rate)}}</td>
                                                <td>{{ $product->stock }}</td>
                                                <td>
                                                    @php $current_date = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', date('Y-m-d'. ' 00:00:00')); 
                                                    $end_date = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', Carbon\Carbon::parse($product->created_at)->addDays($product->day)->format('Y-m-d'. ' 00:00:00')); 
                                                    $diff_in_days = $current_date->diffInDays($end_date);
                                                    @endphp
                                                   {{($diff_in_days )}} days left
                                                </td>
                                                @if($product->agentProduct)
                                                <td><a href="javascript:void(0)" title="Alreay Added" style="color:red">Alreay Added</a></td>
                                                @else
                                                 <td><a href="javascript:void(0)"  class="btn btn-success btn-sm" onclick="addProduct({{ $product->product_id }})"><i class="fa fa-plus"></i> Add</a></td>
                                                @endif
                                            </tr>
                                        @endforeach
                                       
                                    @endif
                                </tbody>
                            </table>
                             <div style="text-align:right;"><button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-plus"></i> Add Multi Product</button></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                       <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                           {{$allproducts->appends(request()->query())->links()}}
                          </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $allproducts->firstItem() }} to {{ $allproducts->lastItem() }} of total {{$allproducts->total()}} entries ({{$allproducts->lastPage()}} Pages)</div>
                    </div>
                    </form>
                </div>
            
            </div>
        <!--Middle Part End-->
    </div>
</div>
<!-- //Main Container -->

@endsection

@section('js')
    <script src="{{asset('assets')}}/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

    <!-- end - This is for export functionality only -->
    <script>
        $(".select2").select2();
    </script>

    <script type="text/javascript">
        
        function commissionCalculate(id, office_price, selling_price, agent_rate) {
            if(agent_rate >= office_price && agent_rate <= selling_price){
                var commission = agent_rate - office_price;
                $('#commission'+id).html("{{Config::get('siteSetting.currency_symble')}}"+commission);
                $('#commissionStatus'+id).html('');
                $('#agent_rate'+id).css("border-color", "#ccc");
            }else{
                $('#commissionStatus'+id).html('Price must be greater than {{ Config::get("siteSetting.currency_symble")}}'+ office_price + ' And less than ' + '{{ Config::get("siteSetting.currency_symble")}}' + selling_price );
                $('#agent_rate'+id).css("border-color", "#ec4545");
            }
        }
        //single product added
        function addProduct(product_id) {
            var agent_rate = $('#agent_rate'+product_id).val();
            $.ajax({
                url:'{{route("agent.agentAffiliateProductStore")}}',
                type:'get',
                data:{product_id:product_id,agent_rate:agent_rate,'_token':'{{csrf_token()}}'},
                success:function(data){
                    if(data.status){
                        $('#product'+product_id).css("background-color", "#ffe2e2");
                        toastr.success(data.msg);
                    }else{
                        toastr.error(data.msg);
                    }
                }
            });
        }


        //on click select all products
        $('#checkAll').on('click', function() {
            if (this.checked == true){
                $('#showAllProducts').find('.product_id').prop('checked', true);
            }
            else{
                $('#showAllProducts').find('.product_id').prop('checked', false);
            }
        });

  
        function remove_product(id){
            $('#product'+id).remove();
        }   

    </script>

    <script type="text/javascript">
        document.addEventListener('readystatechange', event => {
        if (event.target.readyState === "complete") {
            var clockdiv = document.getElementsByClassName("clockdiv");
            var countDownDate = new Array();
            for (var i = 0; i < clockdiv.length; i++) {
                countDownDate[i] = new Array();
                countDownDate[i]['el'] = clockdiv[i];
                countDownDate[i]['time'] = new Date(clockdiv[i].getAttribute('data-date')).getTime();
                countDownDate[i]['days'] = 0;
                countDownDate[i]['hours'] = 0;
                countDownDate[i]['seconds'] = 0;
                countDownDate[i]['minutes'] = 0;
            }
          
            var countdownfunction = setInterval(function() {
                for (var i = 0; i < countDownDate.length; i++) {
                    var now = new Date().getTime();
                    var distance = countDownDate[i]['time'] - now;
                     countDownDate[i]['days'] = Math.floor(distance / (1000 * 60 * 60 * 24));
                     countDownDate[i]['hours'] = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                     countDownDate[i]['minutes'] = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                     countDownDate[i]['seconds'] = Math.floor((distance % (1000 * 60)) / 1000);
                    
                     if (distance < 0) {
                        countDownDate[i]['el'].querySelector('.days').innerHTML = 0;
                        countDownDate[i]['el'].querySelector('.hours').innerHTML = 0;
                        countDownDate[i]['el'].querySelector('.minutes').innerHTML = 0;
                        countDownDate[i]['el'].querySelector('.seconds').innerHTML = 0;
                     }else{
                        countDownDate[i]['el'].querySelector('.days').innerHTML = countDownDate[i]['days'];
                        countDownDate[i]['el'].querySelector('.hours').innerHTML = countDownDate[i]['hours'];
                        countDownDate[i]['el'].querySelector('.minutes').innerHTML = countDownDate[i]['minutes'];
                        countDownDate[i]['el'].querySelector('.seconds').innerHTML = countDownDate[i]['seconds'];
                    }
                }
            }, 1000);
        }
      });
    </script>

        <script src="{{asset('assets')}}/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets')}}/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>

    <script>
    // responsive table
        $('#config-table').DataTable({
            responsive: true,
            ordering: false,"info":false,"paging": false,searching:false
        });
    </script>
@endsection