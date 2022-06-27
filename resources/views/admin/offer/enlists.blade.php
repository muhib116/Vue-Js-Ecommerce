@extends('layouts.admin-master')
@section('title', 'Offer Enlisted Products')

@section('css-top')

    <link href="{{asset('assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
   
@endsection
@section('css')
      <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
  
    <style type="text/css">
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
                        <h4 class="text-themecolor">Offer Enlisted Product</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript::void(0)">Offer</a></li>
                                <li class="breadcrumb-item active">list</li>
                            </ol>
                          
							
                            <button onclick="add_modal({{$pid}})" type="button" class="btn btn-info btn-sm d-lg-block m-l-15"><i class="ti-pin-alt"></i> Enlist Product</button>
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
                    <div class="col-lg-12">
                        <div class="card" style="margin-bottom: 2px;">

                            <form action="" method="get">

                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            
                                          

                                           

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    
                                                    <select name="stock_out" class="form-control">
                                                        <option value="all" {{ (Request::get('stock_out') == "all") ? 'selected' : ''}} disbled>Stock Status</option>
                                                        <option value="0" {{ (Request::get('stock_out') == '0') ? 'selected' : ''}}>In Stock</option>
                                                        <option value="1" {{ (Request::get('stock_out') == '1') ? 'selected' : ''}}>Stock Out</option>
                                                      
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                           
                                            <div class="col-md-2">
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
                                <table id="myTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Title</th>
                                            <th>Seller</th>
											<th>Reguler_Price</th>
                                            <th>Sale_Price</th>
										
                                            <th>Stock</th>
											
                                            <th>Actions</th>
                                        </tr>
                                    </thead> 
                                    <tbody id="positionSorting" data-table='offer_products'>
                                        @if(count($shop)>0)
                                        @foreach($shop as $offer_product)
                                            <tr id="item{{$offer_product->id}}">
                                                <td> <img src="{{asset('upload/images/product/thumb/'.$offer_product->enlists->products->feature_image)}}" alt="Image" width="50"> </td>
                                                <td>
                                                    <a target="_blank" href="{{ route('product_details', $offer_product->enlists->products->slug) }}"> {{Str::limit($offer_product->enlists->products->title, 40)}}</a>
                                                </td>
                                               
                                                <td><a target="_blank" href="{{ route('admin.vendor.profile', $offer_product->vendor->slug) }}" > {{ $offer_product->vendor->shop_name }}</a>
                                                </td>
                                                <td>{{Config::get('siteSetting.currency_symble')}}{{$offer_product->enlists->selling_price}} </td>
                                                 
												 
												 <td>{{Config::get('siteSetting.currency_symble')}}{{$offer_product->offer_price}} </td>
                                                 \
												 <td>{{Config::get('siteSetting.currency_symble')}}{{$offer_product->stock}} </td>
                                                
												
                                                <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ti-settings"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                       
                                                        <a class="dropdown-item" onclick="edit_modal({{$offer_product->id}})" title="Edit product" data-toggle="tooltip" href="javascript:void(0)"><i class="ti-pencil-alt"></i> Edit</a>
                                                       
                                                        <span title="Remove product" data-toggle="tooltip"><button   data-target="#delete" onclick='deleteConfirmPopup("{{route("admin.offerenlist.remove", $offer_product->id)}}")'  data-toggle="modal" class="dropdown-item" ><i class="ti-trash"></i> Remove Product</button></span>
                                                    </div>
                                                </div>                                                  
                                                </td>
                                            </tr>
                                         
                                            @endforeach
                                        @else <tr><td colspan="15">No Seller Found.</td></tr>@endif
                                        
                                    </tbody>
                                </table>
                            </div>
                        
                        </div>
                    </div>
                </div>

                 <div class="row">
                   <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                       {{$shop->appends(request()->query())->links()}}
                      </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $shop->firstItem() }} to {{ $shop->lastItem() }} of total {{$shop->total()}} entries ({{$shop->lastPage()}} Pages)</div>
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
      
		
		
		
		   <!-- update Modal -->
        <div class="modal fade" id="add_modal" role="dialog" style="display: none;">
            <div class="modal-dialog" style="width:80% !important;max-width:80%;">
                <form action="{{route('admin.offerProduct.addenlist')}}"  method="post">
                      {{ csrf_field() }}
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Shop</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                     <div class="modal-body form-row" id="add_form"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success">Submit</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
		
		
		
		
        <!-- update Modal -->
        <div class="modal fade" id="edit_modal" role="dialog" style="display: none;">
            <div class="modal-dialog" style="width:80% !important;max-width:80%;">
                <form action="{{route('admin.offerProduct.editenlist')}}"  method="post">
                      {{ csrf_field() }}
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Enlist</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row" id="edit_form"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                    </div>
                  </div>
                </form>
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


    

        //edit offer
        function edit_modal(id){
           
            $('#edit_form').html('<div class="loadingData"></div>');
            $('#edit_modal').modal('show');
            var  url = '{{route("admin.edit.enlist", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $("#edit_form").html(data);
                        $(".select2").select2();
                    }
                }
            });
        }

 //edit offer
        function add_modal(id){
           
            $('add_form').html('<div class="loadingData"></div>');
            $('#add_modal').modal('show');
            var  url = '{{route("offer.add.enlist", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $("#add_form").html(data);
                        $(".select2").select2();
                    }
                }
            });
        }
		
		
		
     
  
        function remove_product(id){
            $('#product'+id).remove();
        }   

        // if occur error open model
        @if($errors->any())
            $("#{{Session::get('submitType')}}").modal('show');
        @endif
    </script>

@endsection
