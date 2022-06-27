@extends('vendors.partials.vendor-master')
@section('title', 'Affiliate Product list')

@section('css-top')

    <link href="{{asset('assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
   
@endsection
@section('css')
      <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
  
    <style type="text/css">
        .commissionStatus{font-size: 10px;color: red;line-height: normal;margin: 0;}
        .dropify-wrapper{  height: 100px !important; }
        #showProductArea{max-height: 400px; overflow-y: auto;}
        .discount_type{padding: 8px 3px; border: 1px solid #ccc; border-radius: 5px;}
            .clockdiv{margin-bottom: 5px;}
    .count{ display: inline-flex; margin: 0 auto; text-align: center; align-items: center;}
    .count_d {position: relative;padding: 2px 2px 4px;margin: 0px 1px;border-radius: 5px;background: #0085ad;overflow: hidden;}
    .count_d:before{ content: '';  position: absolute;top: 0;left: 0;width: 100%;height: 50%;}
    .count_d span { display: block; text-align: center; font-size: 12px; font-weight: 800;color: #fff;}
    .count_d h2 { display: block; text-align: center;color: #fff; font-size: 7px; font-weight: 600; text-transform: uppercase; margin: 0;}
    .irotate {  text-align: center;  margin: 0 auto; display: block;}
    .thisis { display: inline-block; vertical-align: middle; }
    .slidem { text-align: center; min-width: 90px;}
    </style>
@endsection
@section('content')
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Affiliate Product</h4>
                    </div>
                    
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    
                    <div class="col-md-2 col-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pending</h5>
                            <div class="d-flex no-block align-items-center">
                                <span class="display-5 text-info"><i class="fa fa-hourglass-half"></i></span>
                                <a href="{{route('vendor.affiliateProducts', 'pending')}}" class="link display-5 ml-auto">{{$pending_products}}</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-2 col-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Active </h5>
                            <div class="d-flex no-block align-items-center">
                                <span class="display-5 text-success"><i class="fa fa-thumbs-up"></i></span>
                                <a href="{{route('vendor.affiliateProducts', 'active')}}" class="link display-5 ml-auto">{{$active_products}}</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-2 col-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Deactive </h5>
                            <div class="d-flex no-block align-items-center">
                                <span class="display-5 text-warning"><i class="fa fa-thumbs-down"></i></span>
                                <a href="{{route('vendor.affiliateProducts', 'deactive')}}" class="link display-5 ml-auto">{{$deactive_products}}</a>
                            </div>
                        </div>
                    </div>
                    </div>
                
                    <!-- Column -->
                    <div class="col-md-2 col-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Stock out</h5>
                            <div class="d-flex no-block align-items-center">
                                <span class="display-5 text-danger"><i class="fa fa-battery-empty"></i></span>
                                <a href="{{route('vendor.affiliateProducts', 'stock-out')}}" class="link display-5 ml-auto">{{$stockout_products}}</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-3">
                    <div class="card" id="productModal">
                        <div class="card-body " style="text-align: center;cursor: pointer;">
                            
                            <div class="align-items-center">
                                <span class="display-5 text-success"><i class="fa fa-plus-circle"></i></span>
                            </div>
                            <h5 class="card-title">Add Affiliate Product</h5>
                        </div>
                    </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" style="margin-bottom: 2px;">

                            <form action="" method="get">

                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input name="title" placeholder="Title" value="{{ Request::get('title')}}" type="text" class="form-control">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-2 col-4">
                                                <div class="form-group">
                                                    <select name="brand" required style="width:100%"  class="select2 form-control custom-select">
                                                       <option value="all">All Brand</option>
                                                       @foreach($brands as $brand)
                                                       <option @if(Request::get('brand') == $brand->id) selected @endif value="{{$brand->id}}">{{$brand->name}}</option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                            </div>

                                            <div class="col-md-2 col-4">
                                                <div class="form-group">
                                                    
                                                    <select name="status" class="form-control">
                                                        <option value="all" {{ (Request::get('status') == "all") ? 'selected' : ''}}>All Status</option>
                                                        <option value="active" {{ (Request::get('status') == 'active') ? 'selected' : ''}}>Active</option>
                                                        <option value="pending" {{ (Request::get('status') == 'pending') ? 'selected' : ''}}>Inactive</option>
                                                        
                                                        <option value="sold-out" {{ (Request::get('status') == 'sold-out') ? 'selected' : ''}}>Sold out</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-4">
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
                                            <div class="col-md-1 col-12">
                                                <div class="form-group">
                                                   
                                                   <button type="submit" class="form-control btn btn-success"><i style="color:#fff; font-size: 20px;" class="ti-search"></i> </button>
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
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>MRP</th>
                                            <th>Discount_Price</th>
                                            <th>Set Sale Price</th>
                                             <th>Time Duration</th>
                                            <th>Order</th>
                                            <th>Stock</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        @if(count($affiliate_products)>0)
                                        @foreach($affiliate_products as $index => $affiliate_product)
                                            <?php 
                                                $discount = $affiliate_product->discount;
                                                $discount_type = $affiliate_product->discount_type;
                                                $selling_price = $affiliate_product->selling_price;
                                                if($discount){
                                                    $calculate_discount = App\Http\Controllers\HelperController::calculate_discount($selling_price, $discount, $discount_type );
                                                    $selling_price = $calculate_discount['price'];
                                                }
                                                $offer_price = $selling_price - $affiliate_configure->minimum_offer_price;
                                            ?>
                                            <tr id="item{{$affiliate_product->id}}">
                                                <td>{{$index+1}}</td>
                                                <td> <img src="{{asset('upload/images/product/thumb/'.$affiliate_product->feature_image)}}" alt="Image" width="50"> 
                                                <a target="_blank" href="{{ route('product_details', $affiliate_product->slug) }}"> {{Str::limit($affiliate_product->title, 40)}}</a>
                                                </td>
                                               
                                                <td>{{Config::get('siteSetting.currency_symble') . $affiliate_product->selling_price}} </td>
                                                <td>{{Config::get('siteSetting.currency_symble')}}{{$offer_price}} </td>
                                                
                                                <td>
                                                    @if($affiliate_product->status != 'active')
                                                    <p class="commissionStatus" id="commissionStatus{{$affiliate_product->id}}"></p>
                                                    <input onkeyup="setProductPrice('{{$affiliate_product->id}}')" type="number" min="1" class="form-control" value="{{  $affiliate_product->seller_rate }}" id="set_seller_rate{{$affiliate_product->id}}" placeholder="Price">
                                                    <p style="font-size:11px;color: #616060;">Price less than  {{Config::get('siteSetting.currency_symble') . round($offer_price) }}</p>
                                                    @else
                                                    {{Config::get('siteSetting.currency_symble').$affiliate_product->seller_rate}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @php $current_date = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', date('Y-m-d'. ' 00:00:00')); 

                                                    $duration = Carbon\Carbon::parse($affiliate_product->created_at)->addDays($affiliate_product->day)->format('Y-m-d'. ' 11:59:59');

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
                                                
                                                <td>{!!($affiliate_product->stock > 0) ? $affiliate_product->stock : '<span style="width: 68px" class="label label-danger">Stock Out</span>' !!}</td>
                                                
                                                <td>
                                                    @if($affiliate_product->status == 'active')
                                                        <span class="label label-success"> {{$affiliate_product->status}} </span>
                                                    @else
                                                        <span class="label label-info"> {{$affiliate_product->status}} </span>
                                                    @endif
                                                </td>
                                                
                                                <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ti-settings"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                    
                                                        <span title="Remove product" data-toggle="tooltip"><button   data-target="#delete" onclick='deleteConfirmPopup("{{route("vendor.affiliateProductRemove", $affiliate_product->id)}}")'  data-toggle="modal" class="dropdown-item" ><i class="ti-trash"></i> Remove Product</button></span>
                                                    </div>
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
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- update Modal -->
        <div class="modal fade" id="offerModel" role="dialog" style="display: none;">
            <div class="modal-dialog modal-lg">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Added Product</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row">
                        <div class="card-body">
                                <form action="{{route('vendor.affiliateProductStore')}}" id="checkMarkProducts" method="post">
                                @csrf
                               
                                <div class="form-body">
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                               
                                                <select onchange="getAllProducts()" id="brand" class="form-control custom-select select2">
                                                    <option value="all">All brand</option>
                                                    @foreach($brands as $brand)
                                                    <option value="{{$brand->id}}"> {{$brand->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <select onchange="getAllProducts()" id="category" class="form-control custom-select select2">
                                                    <option value="all">All category</option>
                                                    @foreach($categories as $category)
                                                    <option value="{{$category->id}}" {{ (old('category') == $category->id) ? 'selected' : '' }}> {{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 ">
                                            <input type="text" id="product" class="form-control" placeholder="Product name">
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group"><button type="button" onclick="getAllProducts()" class="btn btn-info"><i class="fa fa-search"></i></button></div>
                                        </div>

                                        
                                        <div class="col-md-12" id="showProductArea">
                                            <p>You have to pay less than ({{ $affiliate_configure->minimum_offer_price }}tk) from the regular price.</p>
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th><input type="checkbox" id="checkAll" name=""></th>
                                                        <th>Product</th>
                                                        <th>MRP</th>
                                                        <th>Discount_Price</th>
                                                        <th>Set Sale Price</th>
                                                        <th>Set Day</th>
                                                        <th>Stock</th>
                                                        <th>Added</th>
                                                    </tr>
                                                </thead> 
                                                <tbody id="showAllProducts"></tbody>
                                            </table>
                                       
                                        </div>
                                    </div>

                                    <div class="row justify-content-md-center">
                                        
                                        <div class="col-md-12">
                                            
                                            <div class="modal-footer">
                                                <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-upload"></i> Add Multi Products</button>
                                                <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancel</button>
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
        @include('admin.modal.delete-modal')

@endsection
@section('js')
    <script src="{{asset('assets')}}/node_modules/jqueryui/jquery-ui.min.js"></script>
    <!-- This is data table -->
    <script src="{{asset('assets')}}/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets')}}/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
    <script src="{{asset('assets')}}/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

    <!-- end - This is for export functionality only -->
    <script>
        $(".select2").select2();

        $(function () {
            $('#myTable').dataTable({
                "ordering": false,
                 "paging": false,"info":false
            });
        });
      
    </script>

    <script type="text/javascript">

        // set seller price rate for offer 
        function setProductPrice(id) {
          
            var link = '{{route("vendor.setProductPrice")}}';
            var seller_rate = $('#set_seller_rate'+id).val();
            $.ajax({
                url:link,
                method:"get",
                data:{seller_rate:seller_rate,id:id},
                success:function(data){
                    if(data.status){
                        toastr.success(data.msg);
                        $('#commissionStatus'+id).html('');
                        $('#set_seller_rate'+id).css("border-color", "#e9ecef");
                    }else{
                        $('#commissionStatus'+id).html(data.msg);
                        $('#set_seller_rate'+id).css("border-color", "#ec4545");
                    }
                }

            });
        }
        function commissionCalculate(id, selling_price, seller_rate) {
            if(seller_rate > selling_price){
                $('#seller_rate'+id).val(selling_price);
                $('#seller_rate'+id).css("border-color", "#ec4545");
                $('#commissionStatus'+id).html('Product price must be less than {{ Config::get("siteSetting.currency_symble")}}'+ selling_price  );
            }else{
                $('#commissionStatus'+id).html('');
                $('#seller_rate'+id).css("border-color", "#e9ecef");
            }
        }
        //open offer modal
        $('#productModal').on('click', function(){
            $('#offerModel').modal('show');
            getAllProducts();
        });

        // get product by search
        function getAllProducts(page=null){
            $('#showAllProducts').html('<tr><td colspan="9"><div class="loadingData"></div></td></tr>');
            var  url = '{{route("vendor.affiliateGetAllProducts")}}';
            var brand = $('#brand').val();
            var category = $('#category').val();
            var product = $('#product').val();
            $.ajax({
                url:url,
                method:"get",
                data:{product:product,category:category,brand:brand,page:page},
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

        //single product added
        function addProduct(product_id) {
            var seller_rate = $('#seller_rate'+product_id).val();
            var day = $('#day'+product_id).val();
            $.ajax({
                url:'{{route("vendor.affiliateProductStore")}}',
                type:'get',
                data:{product_id:product_id,seller_rate:seller_rate,day:day,'_token':'{{csrf_token()}}'},
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
        // Enter form submit preventDefault
        $(document).on('keyup keypress', 'form input[type="text"]', function(e) {
          if(e.keyCode == 13) {
            e.preventDefault();
            return false;
          }
        });
        // if occur error open model
        @if($errors->any())
            $("#{{Session::get('submitType')}}").modal('show');
        @endif
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
@endsection
