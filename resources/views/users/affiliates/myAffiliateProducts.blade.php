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
    #showProductArea{max-height: 400px; overflow-y: auto;}
    .user-box{padding: 10px; margin-bottom: 10px;}
    .card-title, .icon-box{color: #fff}
    .user-box a{    font-size: 2.5rem !important; color: #fff}
    #user-dashboard{padding-top: 15px;}
    #user-dashboard section{background: #fff;margin-bottom: 10px;padding: 10px 0;}
    .pagination{margin: 0}
    .clockdiv{margin-bottom: 5px;}
    .count{ display: inline-flex; margin: 0 auto; text-align: center; align-items: center;}
    .count_d {position: relative;padding: 2px 2px 4px;margin: 0px 1px;border-radius: 5px;background: #0085ad;overflow: hidden;}
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" style="margin-bottom: 2px;">
                            <form action="" method="get">

                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input name="title" placeholder="Product Name" value="{{ Request::get('title')}}" type="text" class="form-control">
                                                </div>
                                            </div>
                                            

                                            <div class="col-md-2 col-xs-6">
                                                <div class="form-group">
                                                    
                                                    <select name="status" class="form-control">
                                                        <option value="all" {{ (Request::get('status') == "all") ? 'selected' : ''}}>All Status</option>
                                                        <option value="active" {{ (Request::get('status') == 'active') ? 'selected' : ''}}>Active</option>
                                                        <option value="pending" {{ (Request::get('status') == 'pending') ? 'selected' : ''}}>Inactive</option>
                                                        <option value="sold-out" {{ (Request::get('status') == 'sold-out') ? 'selected' : ''}}>Sold out</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-xs-6">
                                                <div class="form-group">
                                                    <select class="form-control" name="show">
                                                        <option @if(Request::get('show') == 15) selected @endif value="15">15</option>
                                                        <option @if(Request::get('show') == 25) selected @endif value="25">25</option>
                                                        <option @if(Request::get('show') == 50) selected @endif value="50">50</option>
                                                        <option @if(Request::get('show') == 100) selected @endif value="100">100</option>
                                                        <option @if(Request::get('show') == 255) selected @endif value="250">250</option>
                                                        <option @if(Request::get('show') == 500) selected @endif value="500">500</option>
                                                        <option @if(Request::get('show') == 750) selected @endif value="750">750</option>
                                                        <option @if(Request::get('show') == 1000) selected @endif value="1000">1000</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-xs-12">
                                                <div class="form-group">
                                                   <button type="submit" class="form-control btn btn-success"><i style="color:#fff; font-size: 20px;" class="fa fa-search"></i> Search</button>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-xs-12">
                                                <div class="form-group">
                                                   <button type="button" onclick="getAllProducts()" class="form-control btn btn-info"><i style="color:#fff; font-size: 20px;" class="fa fa-plus"></i> Add product ({{$totalStoreProducts}})</button>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                           
                            <div class="table-responsive">
                                <table id="config-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Old_Price</th>
                                            <th style="width: 180px;">Set Your Price</th>
                                            <th>Commission</th>
                                            <th>Time Duration</th>
                                            <th>Order</th>
                                            <th>Views</th>
                                            <th>Stock</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead> 
                                    <tbody id="positionSorting" data-table='affiliate_products'>

                                        @if(count($affiliate_products)>0)
                                        @foreach($affiliate_products as $index => $affiliate_product)
                                            
                                            <tr id="item{{$affiliate_product->id}}">
                                                <td>{{(($affiliate_products->perPage() * $affiliate_products->currentPage() - $affiliate_products->perPage()) + ($index+1) )}}</td>
                                                <td> <img src="{{asset('upload/images/product/thumb/'.$affiliate_product->feature_image)}}" alt="Image" width="40"> 
                                                <a target="_blank" href="{{ route('product_details', $affiliate_product->slug) }}?ref={{Auth::user()->affiliateAgent->referral_code}}"> {{Str::limit($affiliate_product->title, 40)}}</a>
                                                </td>
                                               
                                                <td>{{Config::get('siteSetting.currency_symble')}}{{$affiliate_product->affiliateProduct->office_rate}} </td>
                                               
                                                <td>
                                                    <p class="commissionStatus" id="commissionStatus{{$affiliate_product->id}}"></p>
                                                    <input style="padding: 5px;display: inline-flex" type="number" class="form-control" onkeyup ="setProductPrice({{$affiliate_product->id}})" value="{{  $affiliate_product->agent_price }}" id="agent_rate{{$affiliate_product->id}}" placeholder="Price">
                                                    <p style="font-size:11px;color: #616060;">Price >=  {{Config::get('siteSetting.currency_symble') . round($affiliate_product->affiliateProduct->office_rate) }}   And <=   {{ Config::get('siteSetting.currency_symble') . round($affiliate_product->product->selling_price)}}</p>
                                                </td>
                                                
                                                <td id="setcommission{{$affiliate_product->id}}">{{ Config::get('siteSetting.currency_symble') . ( $affiliate_product->agent_price - $affiliate_product->affiliateProduct->office_rate)}}</td>
                                                <td>
                                                    @php $current_date = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', date('Y-m-d'. ' 00:00:00')); 

                                                    $duration = Carbon\Carbon::parse($affiliate_product->affiliateProduct->created_at)->addDays($affiliate_product->affiliateProduct->day)->format('Y-m-d'. ' 11:59:59');

                                                    $end_date = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $duration)->format('Y-m-d'. ' 00:00:00'); 
                                                    $diff_in_days = $current_date->diffInDays($end_date);

                                                    @endphp
                                                    @if($diff_in_days > 0) {{$diff_in_days}} days left @else <span style="color:red;text-align: center;">Time Expired</span> @endif
                                                    <div class="head clockdiv" data-date="{{$duration}}">
                                                    <div class="count">
                                                          <div class="count_d" >
                                                            <span class="days">00</span>
                                                            <h2>Days</h2>
                                                          </div>
                                                          <div class="count_d" >
                                                            <span class="hours">00</span>
                                                            <h2>HOURS</h2>
                                                          </div>
                                                          <div class="count_d" >
                                                            <span class="minutes">00</span>
                                                            <h2>MINUTES</h2>
                                                          </div>
                                                          <div class="count_d" >
                                                            <span class="seconds">00</span>
                                                            <h2>SECONDS</h2>
                                                          </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>0</td>
                                                <td>{{($affiliate_product->views)}}</td>
                                                <td>{!!($affiliate_product->stock > 0) ? $affiliate_product->stock : '<span style="width: 68px" class="label label-danger">Stock Out</span>' !!}</td>
                                                
                                                <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-xs btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Action <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="{{ route('product_details', $affiliate_product->slug) }}?ref={{Auth::user()->affiliateAgent->referral_code}}" target="_blank" class="dropdown-item text-inverse" title="Get affiliate link" ><i class="fa fa-link"></i> Get Referral Link</a></li>
                                                        <li><a class="dropdown-item text-inverse" title="Remove product " onclick="deleteConfirmPopup('{{route("agent.affiliateProductRemove", $affiliate_product->id)}}')"><i class="fa fa-trash"></i> Remove Product</a></li>
                                                    </ul>
                                                </div>                                                  
                                                </td>
                                            </tr>
                                           
                                            @endforeach
                                        @else <tr><td colspan="15">No Products Found.</td></tr>@endif
                                        
                                    </tbody>
                                </table>
                            </div>
                        
                        </div>
                    </div>
                </div>

                <div class="row">
                   <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                       {{$affiliate_products->appends(request()->query())->links()}}
                      </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $affiliate_products->firstItem() }} to {{ $affiliate_products->lastItem() }} of total {{$affiliate_products->total()}} entries ({{$affiliate_products->lastPage()}} Pages)</div>
                </div>
            </div>
        <!--Middle Part End-->
    </div>
</div>
<!-- //Main Container -->

<div class="modal fade" id="offerModel" style="display: none;">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Added Product</h4>
                <button type="button" style="margin-top:-20px" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body form-row">
                <div class="card-body">
                        <form action="{{route('agent.agentAffiliateProductStore')}}" id="checkMarkProducts" method="post">
                        @csrf
                       
                        <div class="form-body">
                            <!--/row-->
                            <div class="row">
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <input type="text" id="product_title" class="form-control" placeholder="Product name">
                                </div>
                                </div>
                                <div class="col-md-2 col-xs-4">
                                    <div class="form-group">
                                       
                                        <select onchange="getAllProducts()" id="brand" class="form-control custom-select select2">
                                            <option value="all">All brand</option>
                                            @foreach($brands as $brand)
                                            <option value="{{$brand->id}}"> {{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2 col-xs-4">
                                    <div class="form-group">
                                       
                                        <select onchange="getAllProducts()" id="category" class="form-control custom-select select2">
                                            <option value="all">All category</option>
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{ (old('category') == $category->id) ? 'selected' : '' }}> {{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-4">
                                    <div class="form-group">
                                       
                                        <select onchange="getAllProducts()" id="sorting" class="form-control custom-select select2">
                                            <option value="all">Sorting</option>
                                            <option value="asc"> Low to High</option>
                                            <option value="desc"> High to Low</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <div class="form-group"><button type="button" style="width: 100%;" onclick="getAllProducts()" class="btn btn-info"><i class="fa fa-search"></i> Search</button></div>
                                </div>

                                
                                <div class="col-md-12" id="showProductArea">
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
                                        <tbody id="showAllProducts"></tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-md-center">
                                <div class="col-md-12">
                                    <div class="modal-footer">
                                        <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-plus"></i> Add Multi Product</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- delete Modal -->
@include('modal.delete-modal')
@endsection

@section('js')
    <script src="{{asset('assets')}}/node_modules/jqueryui/jquery-ui.min.js"></script>
    <script src="{{asset('assets')}}/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <!-- end - This is for export functionality only -->
    <script>
        $(".select2").select2();
    </script>
    <script type="text/javascript">
        // set seller price rate for offer 
        function setProductPrice(id) {
            var link = '{{route("agent.setProductPrice")}}';
            var agent_rate = $('#agent_rate'+id).val();
            $.ajax({
                url:link,
                method:"get",
                data:{agent_rate:agent_rate,id:id},
                success:function(data){
                    if(data.status){
                        toastr.success(data.msg);
                        $('#setcommission'+id).html("{{Config::get('siteSetting.currency_symble')}}"+data.commission);
                        $('#commissionStatus'+id).html('');
                        $('#agent_rate'+id).css("border-color", "#ccc");
                    }else{
                        $('#commissionStatus'+id).html(data.msg);
                        $('#agent_rate'+id).css("border-color", "#ec4545");
                    }
                }
            });
        }

        // get product by search
        function getAllProducts(page=null){
             $('#offerModel').modal('show');
            $('#showAllProducts').html('<tr><td colspan="9"><div style="height:135px" class="loadingData-sm"></div></td></tr>');
            var  url = '{{route("agent.affiliateGetAllProducts")}}';
            var sorting = $('#sorting').val();
            var brand = $('#brand').val();
            var category = $('#category').val();
            var product = $('#product_title').val();
       
            $.ajax({
                url:url,
                method:"get",
                data:{product:product,category:category,sorting:sorting,brand:brand,page:page},
                success:function(data){
                    
                    if(data){
                        $("#showAllProducts").html(data);
                       
                    }else{
                        $("#showAllProducts").html('<tr><td colspan="9">No product found.</td></tr>');
                    }
                },
                error: function(jqXHR, exception) {
                    toastr.error('Internal server error.');
                    $("#showAllProducts").html('<tr><td style="color:red" colspan="9">Internal server error.</td></tr>');
                }
            });
        }
        //paginate 
        $(document).on('click', 'td .pagination a', function(e){
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            getAllProducts(page);
        });

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

        $('.checkMarkProducts').click(function(){
            $.ajax({
                url:'{{route("admin.offerMultiProductStore")}}',
                type:'post',
                data:$('#checkMarkProducts').serialize(),
                success:function(data){
                    if(data.status == 'success'){
                        toastr.success(data.msg);
                        location.reload();
                    }else{
                        toastr.error(data.msg);
                    }
                }
            });
        });

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

        // if occur error open model
        @if($errors->any())
            $("#{{Session::get('submitType')}}").modal('show');
        @endif

        function deleteConfirmPopup(route, item='') {
            $('#deleteModal').modal('show');
            document.getElementById('deleteItemRoute').value = route;
            //hide delete item
            document.getElementById('item').value = item;
        }

        function deleteItem(route) {
            //separate id from route
            var id = route.split("/").pop();
            
            $.ajax({
                url:route,
                method:"get",
                success:function(data){
                    if(data.status){
                        $("#item"+id).hide();
                        toastr.success(data.msg);
                    }else{
                        toastr.error(data.msg);
                    }
                }
            });
        }

        // Enter form submit preventDefault
        $(document).on('keyup keypress', 'form input[type="text"]', function(e) {
          if(e.keyCode == 13) {
            e.preventDefault();
            return false;
          }
        });
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