@extends('layouts.admin-master')
@section('title', 'Affiliate Product list')

@section('css-top')

    <link href="{{asset('assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
   
@endsection
@section('css')

    <style type="text/css">
        .commissionStatus{font-size: 10px;color: red;line-height: normal;margin: 0;}
        .dropify-wrapper{  height: 100px !important; }
        #showProductArea{max-height: 400px; overflow-y: auto;}
        .discount_type{padding: 8px 3px; border: 1px solid #ccc; border-radius: 5px;}
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
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            
                            <a href="{{route('admin.affiliateConfigure')}}" class="btn btn-info btn-sm d-lg-block m-l-15"><i class="fa fa-cogs"></i> Affiliate Configure</a>
                           
                        </div>
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
                                <a href="{{route('admin.affiliateProducts', 'pending')}}" class="link display-5 ml-auto">{{$pending_products}}</a>
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
                                <a href="{{route('admin.affiliateProducts', 'active')}}" class="link display-5 ml-auto">{{$active_products}}</a>
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
                                <a href="{{route('admin.affiliateProducts', 'deactive')}}" class="link display-5 ml-auto">{{$deactive_products}}</a>
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
                                <a href="{{route('admin.affiliateProducts', 'stock-out')}}" class="link display-5 ml-auto">{{$stockout_products}}</a>
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
                            <h5 class="card-title">Add More Affiliate Product</h5>
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
                                            
                                            <div class="col-md-2 col-6">
                                                <div class="form-group">
                                                    <select name="seller" required style="width:100%"   class="select2 form-control custom-select">
                                                       <option value="all">Seller All</option>
                                                       @foreach($sellers as $seller)
                                                       <option  @if(Request::get('seller') == $seller->id) selected @endif value="{{$seller->id}}">{{$seller->shop_name}}</option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                            </div>

                                            <div class="col-md-2 col-6">
                                                <div class="form-group">
                                                    <select name="brand" required style="width:100%"  class="select2 form-control custom-select">
                                                       <option value="all">All Brand</option>
                                                       @foreach($brands as $brand)
                                                       <option @if(Request::get('brand') == $brand->id) selected @endif value="{{$brand->id}}">{{$brand->name}}</option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                            </div>

                                            <div class="col-md-2 col-6">
                                                <div class="form-group">
                                                    
                                                    <select name="status" class="form-control">
                                                        <option value="all" {{ (Request::get('status') == "all") ? 'selected' : ''}}>All Status</option>
                                                        <option value="active" {{ (Request::get('status') == 'active') ? 'selected' : ''}}>Active</option>
                                                        <option value="pending" {{ (Request::get('status') == 'pending') ? 'selected' : ''}}>Inactive</option>
                                                        
                                                        <option value="sold-out" {{ (Request::get('status') == 'sold-out') ? 'selected' : ''}}>Sold out</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-6">
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
                                            <th>Product</th>
                                            <th>Seller</th>
                                            <th>MRP</th>
                                            <th>Seller_Price</th>
                                            <th>Set_Woadi_Price</th>
                                            <th>Commission</th>
                                            <th>Duration</th>
                                            <th>Agent</th>
                                            <th>Order</th>
                                            <th>Stock</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        @if(count($affiliate_products)>0)
                                        @foreach($affiliate_products as $affiliate_product)
                                            
                                            <tr id="item{{$affiliate_product->id}}">
                                                <td> <img src="{{asset('upload/images/product/thumb/'.$affiliate_product->feature_image)}}" alt="Image" width="50"> 
                                                <a target="_blank" href="{{ route('product_details', $affiliate_product->slug) }}"> {{Str::limit($affiliate_product->title, 40)}}</a>
                                                </td>
                                               
                                                <td><a target="_blank" @if($affiliate_product->vendor) href="{{ route('admin.vendor.profile', $affiliate_product->vendor->slug) }}" @endif> {{ ($affiliate_product->vendor) ? $affiliate_product->vendor->shop_name : '' }}</a>
                                                </td>
                                                <td>{{Config::get('siteSetting.currency_symble')}}{{$affiliate_product->selling_price}} </td>
                                                <td>{{Config::get('siteSetting.currency_symble')}}{{$affiliate_product->seller_rate}} </td>
                                                <td>
                                                    <p class="commissionStatus" id="setCommissionStatus{{$affiliate_product->id}}"></p>
                                                    <input onkeyup="setProductPrice('{{$affiliate_product->id}}')" type="number" min="1" class="form-control" value="{{  $affiliate_product->office_rate }}" id="office_rate{{$affiliate_product->id}}" placeholder="Price">
                                                <p style="font-size:10px;color: #616060;">Price >=  {{Config::get('siteSetting.currency_symble') . round($affiliate_product->seller_rate) }}   And <=   {{ Config::get('siteSetting.currency_symble') . round($affiliate_product->selling_price)}}</p>
                                                </td>
                                                <td id="setCommission{{$affiliate_product->id}}">{{ Config::get('siteSetting.currency_symble') . ($affiliate_product->selling_price - $affiliate_product->office_rate)}}</td>
                                                <td>@php $current_date = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', date('Y-m-d'. ' 00:00:00')); 

                                                    $duration = Carbon\Carbon::parse($affiliate_product->created_at)->addDays($affiliate_product->day)->format('Y-m-d'. ' 11:59:59');

                                                    $end_date = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $duration)->format('Y-m-d'. ' 00:00:00'); 
                                                    $diff_in_days = $current_date->diffInDays($end_date);

                                                    @endphp
                                                    @if($diff_in_days > 0) {{$diff_in_days}} days left @else <span style="color:red;text-align: center;">Time Expired</span> @endif</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>{!!($affiliate_product->stock > 0) ? $affiliate_product->stock : '<span style="width: 68px" class="label label-danger">Stock Out</span>' !!}</td>
                                                
                                                <td>
                                                    @if($affiliate_product->approved == '1')
                                                    <div class="custom-control custom-switch">
                                                      <input  name="status" onclick="satusActiveDeactive('affiliate_products', {{$affiliate_product->id}})"  type="checkbox" {{($affiliate_product->status == 'active') ? 'checked' : ''}}  type="checkbox" class="custom-control-input" id="status{{$affiliate_product->id}}">
                                                      <label style="padding: 5px 12px" class="custom-control-label" for="status{{$affiliate_product->id}}"></label>
                                                    </div>
                                                    @else
                                                        <span class="label label-warning"> Pending </span>
                                                    @endif
                                                </td>
                                                
                                                <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ti-settings"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                    
                                                        <span title="Remove product" data-toggle="tooltip"><button   data-target="#delete" onclick='deleteConfirmPopup("{{route("admin.affiliateProductRemove", $affiliate_product->id)}}")'  data-toggle="modal" class="dropdown-item" ><i class="ti-trash"></i> Remove Product</button></span>
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
        <div class="modal fade" id="affiliateModal" style="display: none;">
            <div class="modal-dialog modal-lg">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Added Product</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row">
                        <div class="card-body">
                                <form action="{{route('admin.affiliateProductStore')}}" id="checkMarkProducts" method="post">
                                @csrf
                               
                                <div class="form-body">
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" id="product" class="form-control" placeholder="Product name">
                                        </div>
                                        <div class="col-md-3 col-4">
                                            <div class="form-group">
                                               
                                                <select onchange="getAllProducts()" id="seller" class="form-control select2 custom-select">
                                                    <option value="">Seller All</option>
                                                    @foreach($sellers as $seller)
                                                    <option value="{{$seller->id}}" {{ (old('seller') == $seller->id) ? 'selected' : '' }}> {{$seller->shop_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-4">
                                            <div class="form-group">
                                               
                                                <select onchange="getAllProducts()" id="brand" class="form-control custom-select select2">
                                                    <option value="all">All brand</option>
                                                    @foreach($brands as $brand)
                                                    <option value="{{$brand->id}}"> {{$brand->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-4">
                                            <div class="form-group">
                                               
                                                <select onchange="getAllProducts()" id="category" class="form-control custom-select select2">
                                                    <option value="all">All category</option>
                                                    @foreach($categories as $category)
                                                    <option value="{{$category->id}}" {{ (old('category') == $category->id) ? 'selected' : '' }}> {{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-1 col-12">
                                            <div class="form-group"><button type="button" onclick="getAllProducts()" class="btn btn-info"><i class="fa fa-search"></i></button></div>
                                        </div>

                                        <div class="col-md-12" id="showProductArea">
                                            <div class="table-responsive">
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
    <!-- end - This is for export functionality only -->
    <script>
        $(".select2").select2();
    </script>

    <script type="text/javascript">
        // set seller price rate for offer 
        function setProductPrice(id) {
          
            var link = '{{route("admin.setAffiliateProductPrice")}}';
            var office_rate = $('#office_rate'+id).val();
            $.ajax({
                url:link,
                method:"get",
                data:{office_rate:office_rate,id:id},
                success:function(data){
                    if(data.status){
                        toastr.success(data.msg);
                        $('#setCommission'+id).html("{{Config::get('siteSetting.currency_symble')}}"+data.commission);
                        $('#setCommissionStatus'+id).html('');
                        $('#office_rate'+id).css("border-color", "#ccc");
                    }else{
                        $('#setCommissionStatus'+id).html(data.msg);
                        $('#office_rate'+id).css("border-color", "#ec4545");
                    }
                }

            });
        }
         function commissionCalculate(id, selling_price, seller_rate) {
            if(seller_rate > selling_price){
                $('#seller_rate'+id).css("border-color", "#ec4545");
                $('#commissionStatus'+id).html('Product price must be less than {{ Config::get("siteSetting.currency_symble")}}'+ selling_price  );
            }else{
                $('#commissionStatus'+id).html('');
                $('#seller_rate'+id).css("border-color", "#e9ecef");
            }
        }

        //open offer modal
        $('#productModal').on('click', function(){
            $('#affiliateModal').modal('show');
            getAllProducts();
        });

        // get product by search
        function getAllProducts(page=null){
            $('#showAllProducts').html('<tr><td colspan="9"><div class="loadingData"></div></td></tr>');
            var  url = '{{route("admin.affiliateGetAllProducts")}}';
            var seller = $('#seller').val();
            var brand = $('#brand').val();
            var category = $('#category').val();
            var product = $('#product').val();
       
            $.ajax({
                url:url,
                method:"get",
                data:{product:product,category:category,brand:brand,seller:seller,page:page},
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
                url:'{{route("admin.affiliateProductStore")}}',
                type:'get',
                data:{product_id:product_id,day:day,seller_rate:seller_rate,'_token':'{{csrf_token()}}'},
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

        // if occur error open model
        @if($errors->any())
            $("#{{Session::get('submitType')}}").modal('show');
        @endif
    </script>

@endsection
