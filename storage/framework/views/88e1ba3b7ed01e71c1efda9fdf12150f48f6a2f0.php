
<?php $__env->startSection('title', 'Offer Product list'); ?>

<?php $__env->startSection('css-top'); ?>

    <link href="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
   
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
      <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
  
    <style type="text/css">
        .dropify-wrapper{  height: 100px !important; }
        #showProductArea{max-height: 400px; overflow-y: auto;}
        .discount_type{padding: 8px 3px; border: 1px solid #ccc; border-radius: 5px;}
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
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
                        <h4 class="text-themecolor">Offer Product</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript::void(0)">Offer</a></li>
                                <li class="breadcrumb-item active">list</li>
                            </ol>
                            <?php if($offer->offer_type == 'quiz'): ?>
                            <a href="<?php echo e(route('quiz_list')); ?>" class="btn btn-info btn-sm d-lg-block m-l-15"><i class="fa fa-eye"></i> Quiz List</a>
                            <?php else: ?>
                            <a href="<?php echo e(route('admin.offer')); ?>" class="btn btn-info btn-sm d-lg-block m-l-15"><i class="fa fa-eye"></i> Offer List</a>
                            <?php endif; ?>
							
							<?php if($offer->offer_type == 'jowar-bhata'): ?>
								
							 <a href="<?php echo e(route('delivery.management')); ?>" class="btn btn-info btn-sm d-lg-block m-l-15"><i class="fa fa-cog"></i> Delivery Time Management</a>
							
							<?php endif; ?>
							
                            <button id="productModal" type="button" class="btn btn-info btn-sm d-lg-block m-l-15"><i class="ti-pin-alt"></i> Add More Product</button>
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
                                            
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input name="title" placeholder="Title" value="<?php echo e(Request::get('title')); ?>" type="text" class="form-control">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <select name="seller" required style="width:100%"  class="select2 form-control custom-select">
                                                       <option value="all">Seller All</option>
                                                       <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                       <option  <?php if(Request::get('seller') == $seller->id): ?> selected <?php endif; ?> value="<?php echo e($seller->id); ?>"><?php echo e($seller->shop_name); ?></option>
                                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                   </select>
                                               </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <select name="brand" required style="width:100%"   class="select2 form-control custom-select">
                                                       <option value="all">All Brand</option>
                                                       <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                       <option <?php if(Request::get('brand') == $brand->id): ?> selected <?php endif; ?> value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option>
                                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                   </select>
                                               </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    
                                                    <select name="status" class="form-control">
                                                        <option value="all" <?php echo e((Request::get('status') == "all") ? 'selected' : ''); ?>>All Status</option>
                                                        <option value="active" <?php echo e((Request::get('status') == 'active') ? 'selected' : ''); ?>>Active</option>
                                                        <option value="pending" <?php echo e((Request::get('status') == 'pending') ? 'selected' : ''); ?>>Inactive</option>
                                                        <option value="visible" <?php echo e((Request::get('status') == 'visible') ? 'selected' : ''); ?>>Visible</option>
                                                        <option value="invisible" <?php echo e((Request::get('status') == 'invisible') ? 'selected' : ''); ?>>Invisible</option>
                                                        <option value="sold-out" <?php echo e((Request::get('status') == 'sold-out') ? 'selected' : ''); ?>>Sold out</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <select class="form-control" name="show">
                                                        <option <?php if(Request::get('show') == 15): ?> selected <?php endif; ?> value="15">15</option>
                                                        <option <?php if(Request::get('show') == 25): ?> selected <?php endif; ?> value="25">25</option>
                                                        <option <?php if(Request::get('show') == 50): ?> selected <?php endif; ?> value="50">50</option>
                                                        <option <?php if(Request::get('show') == 100): ?> selected <?php endif; ?> value="100">100</option>
                                                        <option <?php if(Request::get('show') == 255): ?> selected <?php endif; ?> value="250">250</option>
                                                        <option <?php if(Request::get('show') == 500): ?> selected <?php endif; ?> value="500">500</option>
                                                        <option <?php if(Request::get('show') == 750): ?> selected <?php endif; ?> value="750">750</option>
                                                        <option <?php if(Request::get('show') == 1000): ?> selected <?php endif; ?> value="1000">1000</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
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
                                            <th>Sale_Price</th>
											
											
											
											<?php if($offer->offer_type != 'jowar-bhata'): ?>
                                            <th>Seller_Rate</th>
                                            <th>Order</th>
                                            <th>Total_Price</th>
											<?php endif; ?>
											
											
											<?php if($offer->offer_type == 'jowar-bhata'): ?>
                                            
										<th>%_Range</th>
										<th>Update_Limit</th>
										<th>Start_Time</th>
										<th>End_Time</th>
											<?php else: ?>
												<th>Offer_Price</th>
											<?php endif; ?>
											
											
											
											
                                            <th>Stock</th>
											<?php if($offer->offer_type != 'jowar-bhata'): ?>
                                            <th>Visible</th>
										<?php endif; ?>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead> 
                                    <tbody id="positionSorting" data-table='offer_products'>
                                        <?php if(count($offer->offer_products)>0): ?>
                                        <?php $__currentLoopData = $offer_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($offer_product->product): ?>

                                            <tr id="item<?php echo e($offer_product->id); ?>">
                                                <td> <img src="<?php echo e(asset('upload/images/product/thumb/'.$offer_product->product->feature_image)); ?>" alt="Image" width="50"> </td>
                                                <td>
                                                    <a target="_blank" href="<?php echo e(route('product_details', $offer_product->product->slug)); ?>"> <?php echo e(Str::limit($offer_product->product->title, 40)); ?></a>
                                                </td>
                                               
                                                <td><a target="_blank" <?php if($offer_product->product->vendor): ?> href="<?php echo e(route('admin.vendor.profile', $offer_product->product->vendor->slug)); ?>" <?php endif; ?>> <?php echo e(($offer_product->product->vendor) ? $offer_product->product->vendor->shop_name : ''); ?></a>
                                                </td>
                                                <td><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($offer_product->product->selling_price); ?> </td>
                                                
												<?php if($offer->offer_type != 'jowar-bhata'): ?>
												
												<td><input style="width: 70%;padding: 5px;" type="number" class="form-control" value="<?php echo e($offer_product->seller_rate); ?>" id="seller_rate<?php echo e($offer_product->id); ?>" placeholder="Price"><button style="padding: 9px 5px;" class="btn btn-sm btn-info" onclick="setProductPrice('<?php echo e($offer_product->id); ?>')" type="button"> Set </button></td>
                                                <td>
                                                    <?php 
                                                    $totalOrder = ($offer_product->offer_orders) ?  count($offer_product->offer_orders) : 0; ?>
                                                    <input type="hidden" id="totalOrder<?php echo e($offer_product->id); ?>" value="<?php echo e($totalOrder); ?>">
                                                    <a href="<?php echo e(route('admin.offerOrderProducts', [$offer->slug, $offer_product->product->slug])); ?>"><span style="font-size: 15px;" class="label label-success"> <?php echo e($totalOrder); ?></span></a>
                                                </td>
                                                <td><?php echo e(Config::get('siteSetting.currency_symble')); ?><span id="totalPrice<?php echo e($offer_product->id); ?>"><?php echo e($offer_product->seller_rate * $totalOrder); ?></span>
                                                </td>
<?php endif; ?>







<?php if($offer->offer_type == 'jowar-bhata'): ?>
<td><?php echo e($offer_product->percentstart); ?>-<?php echo e($offer_product->percentend); ?>%</td>
<td><?php echo e($offer_product->viewlimit); ?></td>
<td><?php echo e($offer_product->timestart); ?> Minutes</td>
<td><?php echo e($offer_product->timeend); ?> Minutes</td>
<?php else: ?>
<td><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($offer_product->offer_discount); ?></td>
	<?php endif; ?>											
												
												
												
												
												
												
												
												
												
												
												
												
												
												
                                                <td><?php echo ($offer_product->offer_quantity > 0) ? $offer_product->offer_quantity : '<span style="width: 68px" class="label label-danger">Stock Out</span>'; ?></td>
                                                <?php if($offer->offer_type != 'jowar-bhata'): ?>
                                                <td> 
                                                   <div class="custom-control custom-switch">
                                                      <input  name="invisible" onclick="satusActiveDeactive('offer_products', '<?php echo e($offer_product->id); ?>', 'invisible')"  type="checkbox" <?php echo e(($offer_product->invisible == 0) ? 'checked' : ''); ?>  type="checkbox" class="custom-control-input" id="invisible<?php echo e($offer_product->id); ?>">
                                                      <label style="padding: 5px 12px" class="custom-control-label" for="invisible<?php echo e($offer_product->id); ?>"></label>
                                                    </div>
                                                </td>
												<?php endif; ?>
                                                <td>
                                                    <?php if($offer_product->approved == '1'): ?>
                                                    <div class="custom-control custom-switch">
                                                      <input  name="status" onclick="satusActiveDeactive('offer_products', <?php echo e($offer_product->id); ?>)"  type="checkbox" <?php echo e(($offer_product->status == 1 || $offer_product->status == 'active') ? 'checked' : ''); ?>  type="checkbox" class="custom-control-input" id="status<?php echo e($offer_product->id); ?>">
                                                      <label style="padding: 5px 12px" class="custom-control-label" for="status<?php echo e($offer_product->id); ?>"></label>
                                                    </div>
                                                    <?php else: ?>
                                                        <span class="label label-warning"> Un Approved </span>
                                                    <?php endif; ?>
                                                </td>
                                                
                                                <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ti-settings"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                       
                                                        <a class="dropdown-item" onclick="edit_modal(<?php echo e($offer_product->id); ?>)" title="Edit product" data-toggle="tooltip" href="javascript:void(0)"><i class="ti-pencil-alt"></i> Edit Offer</a>
                                                       
                                                        <span title="Remove product" data-toggle="tooltip"><button   data-target="#delete" onclick='deleteConfirmPopup("<?php echo e(route("admin.offerProduct.remove", $offer_product->id)); ?>")'  data-toggle="modal" class="dropdown-item" ><i class="ti-trash"></i> Remove Product</button></span>
                                                    </div>
                                                </div>                                                  
                                                </td>
                                            </tr>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?> <tr><td colspan="15">No Products Found.</td></tr><?php endif; ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        
                        </div>
                    </div>
                </div>

                 <div class="row">
                   <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                       <?php echo e($offer_products->appends(request()->query())->links()); ?>

                      </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing <?php echo e($offer_products->firstItem()); ?> to <?php echo e($offer_products->lastItem()); ?> of total <?php echo e($offer_products->total()); ?> entries (<?php echo e($offer_products->lastPage()); ?> Pages)</div>
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
            <div class="modal-dialog" style="width:100% !important;max-width:100%;">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Added Product</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row">
                        <div class="card-body">
                                <form action="<?php echo e(route('admin.offerMultiProductStore')); ?>" id="checkMarkProducts" method="post">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" value="<?php echo e($offer->id); ?>" name="offer_id">
                                <div class="form-body">
                                    <!--/row-->
                                    <div class="row">
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                               
                                                <select onchange="getAllProducts()" id="seller" class="form-control select2 custom-select">
                                                    <option value="">Select seller</option>
                                                    <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($seller->id); ?>" <?php echo e((old('seller') == $seller->id) ? 'selected' : ''); ?>> <?php echo e($seller->shop_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                               
                                                <select onchange="getAllProducts()" id="brand" class="form-control custom-select select2">
                                                    <option value="all">All brand</option>
                                                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($brand->id); ?>"> <?php echo e($brand->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                               
                                                <select onchange="getAllProducts()" id="category" class="form-control custom-select select2">
                                                    <option value="all">All category</option>
                                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($category->id); ?>" <?php echo e((old('category') == $category->id) ? 'selected' : ''); ?>> <?php echo e($category->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" id="product" class="form-control" placeholder="Product name">
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group"><button type="button" onclick="getAllProducts()" class="btn btn-info"><i class="fa fa-search"></i></button></div>
                                        </div>

                                        
                                        <div class="col-md-12" id="showProductArea">
                                        
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th><input type="checkbox" id="checkAll" name=""></th>
                                                        <th>Product</th>
														
														
														
                                                        <th>Old_Price</th>
														<?php if($offer->offer_type != 'jowar-bhata'): ?>
														
														
                                                        <th>New_Price</th>
														 <th>Type</th>
														<?php else: ?>
														<th>%_Start</th>
														<th>%_End</th>
										<th>Daily_Limit</th>
										<th>Update_Min_Time</th>
										<th>Update_Max_Time</th>
														<?php endif; ?>
                                                       
                                                        <th>Quantity</th>
														<?php if($offer->offer_type != 'jowar-bhata'): ?>
                                                        <th>Invisible</th>
													<?php endif; ?>
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
                                                <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Add</button>
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
        <!-- update Modal -->
        <div class="modal fade" id="edit_modal" role="dialog" style="display: none;">
            <div class="modal-dialog">
                <form action="<?php echo e(route('admin.offerProduct.update')); ?>"  method="post">
                      <?php echo e(csrf_field()); ?>

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update offer product</h4>
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
        <?php echo $__env->make('admin.modal.delete-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/jqueryui/jquery-ui.min.js"></script>
    <!-- This is data table -->
    <script src="<?php echo e(asset('assets')); ?>/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

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
      
        var link = '<?php echo e(route("admin.setProductPrice", ":id")); ?>';
        var link = link.replace(":id", id);
        var seller_rate = $('#seller_rate'+id).val();
        var total_sale = $('#totalOrder'+id).val();
        var totalPrice = seller_rate * total_sale;
        $.ajax({
            url:link,
            method:"get",
            data:{seller_rate:seller_rate,id:id},
            success:function(data){
                if(data.status){
                    document.getElementById("totalPrice"+id).innerHTML = totalPrice;
                    toastr.success(data.message);
                }else{
                    toastr.error(data.message);
                }
            }

        });
    }

        //edit offer
        function edit_modal(id){
           
            $('#edit_form').html('<div class="loadingData"></div>');
            $('#edit_modal').modal('show');
            var  url = '<?php echo e(route("admin.offerProduct.edit", ":id")); ?>';
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


        //open offer modal
        $('#productModal').on('click', function(){
            $('#offerModel').modal('show');
            getAllProducts();
        });

        // get product by search
        function getAllProducts(page=null){
            $('#showAllProducts').html('<tr><td colspan="9"><div class="loadingData"></div></td></tr>');
            var  url = '<?php echo e(route("offer.getAllProducts")); ?>';
            var seller = $('#seller').val();
            var brand = $('#brand').val();
            var category = $('#category').val();
            var product = $('#product').val();
          
            var offer_id = '<?php echo e($offer->id); ?>';
            var offer_type = '<?php echo e($offer->offer_type); ?>';
           
            $.ajax({
                url:url,
                method:"get",
                data:{product:product,category:category,brand:brand,seller:seller,page:page,offer_id:offer_id,offer_type:offer_type},
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
            var offer_id = '<?php echo e($offer->id); ?>';
            // var discount_type = $('#discount_type'+product_id).val();
        
            var offer_discount = $('#discount'+product_id).val();
           
            var quantity = $('#quantity'+product_id).val();
			var percentstart = $('#percentstart'+product_id).val();
			var percentend = $('#percentend'+product_id).val();
			var viewlimit = $('#viewlimit'+product_id).val();
			var timestart = $('#timestart'+product_id).val();
			var timeend = $('#timeend'+product_id).val();
            var invisible = null;
            if ($('#invisible'+product_id).is(':checked')) {
                invisible = 'checked';
            }
          
            $.ajax({
                url:'<?php echo e(route("admin.offerSingleProductStore")); ?>',
                type:'get',
                data:{timeend:timeend,timestart:timestart,viewlimit:viewlimit,percentend:percentend,percentstart:percentstart,offer_id:offer_id,offer_discount:offer_discount,product_id:product_id,quantity:quantity,quantity,invisible:invisible,'_token':'<?php echo e(csrf_token()); ?>'},
                success:function(data){
                    if(data.status){
                        toastr.success(data.msg);
                    }else{
                        toastr.error(data.msg);
                    }
                }
            });
        }

        $('.checkMarkProducts').click(function(){
            $.ajax({
                url:'<?php echo e(route("admin.offerMultiProductStore")); ?>',
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
        <?php if($errors->any()): ?>
            $("#<?php echo e(Session::get('submitType')); ?>").modal('show');
        <?php endif; ?>
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/admin/offer/offer_products.blade.php ENDPATH**/ ?>