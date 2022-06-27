
<?php $__env->startSection('title', 'Offer list'); ?>
<?php $__env->startSection('css-top'); ?>
    <link href="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets')); ?>/node_modules/jquery-asColorPicker-master/dist/css/asColorPicker.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <link href="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo e(asset('assets')); ?>/node_modules/summernote/dist/summernote-bs4.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .asColorPicker_open{z-index: 9999999;border:1px solid #ccc;}
       
        .dropify-wrapper{  height: 120px !important; }
        #showProductArea{max-height: 450px; overflow-y: auto;}
        .discount_type{padding: 8px 3px; border: 1px solid #ccc; border-radius: 5px;}
        .image_size{font-size: 11px;}
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
                        <h4 class="text-themecolor">Offer List</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Offer</a></li>
                                <li class="breadcrumb-item active">list</li>
                            </ol>
                            <?php if(Auth::guard('admin')->user()->role_id == 'admin'): ?>
                            <button data-toggle="modal" data-target="#offerModel" type="button" class="btn btn-info m-l-15"><i class="fa fa-plus-circle"></i> Create New Offer</button>
                            <?php endif; ?>
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
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body">
                                <?php if(Session::has('error')): ?>
                                <div class="alert alert-danger">
                                  <strong>Error! </strong> <?php echo e(Session::get('error')); ?>

                                </div>
                                <?php endif; ?>
                                <i class="drag-drop-info">Drag & drop sorting position</i>
                            
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Thumbnail</th>
                                                <th>Title</th>
                                                <th>Views</th>
                                                <?php if(Auth::guard('admin')->user()->role_id == 'admin'): ?>
                                                <th>Products</th>
                                                <?php endif; ?>
                                                <th>Orders</th>
                                                <th>Offer_Type</th>
                                                <th>Discount</th>
                                                <th>Type</th>
                                                <th style="min-width: 100px;">Start Date</th>
                                                <th style="min-width: 100px;">End Date</th>
                                                <?php if(Auth::guard('admin')->user()->role_id == 'admin'): ?>
                                                <th>Featured</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead> 
                                        <tbody id="positionSorting" data-table='offers'>
                                            <?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr  id="item<?php echo e($offer->id); ?>">
                                                <td><img src="<?php echo e(asset('upload/images/offer/thumbnail/'.$offer->thumbnail)); ?>" width="50px"> </td>
                                                <td><a href="<?php echo e(route('offer.details', $offer->slug)); ?>"> <?php echo e($offer->title); ?> </a></td>
                                                <td><i class="ti-eye"></i> <?php echo e($offer->offer_views); ?></td>
                                                <?php if(Auth::guard('admin')->user()->role_id == 'admin'): ?>
                                                <td><a class="dropdown-item" title="Added New Products" href="<?php echo e(route('admin.offerProducts', $offer->slug)); ?>"><span class="label label-info">Products( <?php echo e($offer->offer_products_count); ?>) </span></a> </td>
                                                <?php endif; ?>
                                                <td><a href="<?php echo e(route('admin.offerOrder', $offer->slug)); ?>"><span class="label label-success">View Orders</span></a>  </td>
                                                <td><?php echo e($offer->offer_type); ?> </td>
                                                <td><?php echo e($offer->discount); ?> </td>
                                                <td><?php echo e($offer->discount_type); ?> </td>
                                                <td><?php echo e(Carbon\Carbon::parse($offer->start_date)->format('d M, Y')); ?> <br/>
                                                <?php echo e(Carbon\Carbon::parse($offer->start_date)->format('h:i:s A')); ?></td>
                                                <td><?php echo e(Carbon\Carbon::parse($offer->end_date)->format('d M, Y')); ?>

                                                <br/>
                                                <?php echo e(Carbon\Carbon::parse($offer->end_date)->format('h:i:s A')); ?></td>
                                                <?php if(Auth::guard('admin')->user()->role_id == 'admin'): ?>
                                               <td>
                                                   <div class="custom-control custom-switch">
                                                      <input  name="featured" onclick="satusActiveDeactive('offers', '<?php echo e($offer->id); ?>', 'featured')"  type="checkbox" <?php echo e(($offer->featured == 1) ? 'checked' : ''); ?>  type="checkbox" class="custom-control-input" id="featured<?php echo e($offer->id); ?>">
                                                      <label style="padding: 5px 12px" class="custom-control-label" for="featured<?php echo e($offer->id); ?>"></label>
                                                    </div>
                                               </td>

                                                <td>
                                                    <div class="custom-control custom-switch" >
                                                      <input name="status" onclick="satusActiveDeactive('offers', <?php echo e($offer->id); ?>)"  type="checkbox" <?php echo e(($offer->status == 1) ? 'checked' : ''); ?> class="custom-control-input" id="status<?php echo e($offer->id); ?>">
                                                      <label class="custom-control-label" for="status<?php echo e($offer->id); ?>"></label>
                                                    </div>
                                                </td>
                                               
                                                <td>
                                                 
                                                     <div class="btn-group">
                                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="ti-settings"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                        	<a class="dropdown-item" title="Added New Products" href="<?php echo e(route('admin.offerProducts', $offer->slug)); ?>"><i class="ti-pin-alt"></i> View Product</a>
                                                	
                                                            <a class="dropdown-item" target="_blank" class="dropdown-item text-inverse" title="View product" data-toggle="tooltip" href="<?php echo e(route('offer.details', $offer->slug)); ?>"><i class="ti-eye"></i> View Offer</a>

                                                            <a class="dropdown-item" title="Edit product" data-toggle="tooltip" href="javascript:void(0)" onclick="edit_offer('<?php echo e($offer->id); ?>')" ><i class="ti-pencil-alt"></i> Edit Offer</a>
                                                           
                                                            <!-- <?php if(Auth::guard('admin')->user()->role_id == 'admin'): ?>
                                                            <span title="Delete" data-toggle="tooltip"><button   data-target="#delete" onclick="deleteConfirmPopup('<?php echo e(route("admin.offer.delete", $offer->id)); ?>')"  data-toggle="modal" class="dropdown-item" ><i class="ti-trash"></i> Delete Offer</button></span>
                                                            <?php endif; ?> -->
                                                        </div>
                                                    </div>
                                                </td>
                                                 <?php endif; ?>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
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
                        <h4 class="modal-title">Create offer</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row">
                        <div class="card-body">
                            <form action="<?php echo e(route('admin.offer.store')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <div class="form-body">
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="title">Offer Title</label>
                                                <input  name="title" placeholder="Offer title" id="title" value="<?php echo e(old('title')); ?>" required="" type="text" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="required" for="offer_type">Offer Type</label>
                                                <select required name="offer_type" class="form-control">
                                                    <option value="">Select Offer Type</option>
                                                    <?php $__currentLoopData = $offerTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offerType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($offerType->slug); ?>"><?php echo e($offerType->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6">
                                            <div class="form-group">
                                                <label class="required" for="discount">Discount</label>
                                                <input type="text" required value="<?php echo e(old('discount')); ?>"  name="discount" id="discount" placeholder = 'Enter discount' class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6" style="padding-left: 0">
                                            <div class="form-group">
                                                <label class="required" for="discount_type">Type</label>
                                                <select name="discount_type" required class="form-control">
                                                    <option value="fixed">Fixed Price <?php echo e(Config::get('siteSetting.currency_symble')); ?></option>
                                                    <option value="%">Percentage %</option>
                                                    <option value="<?php echo e(Config::get('siteSetting.currency_symble')); ?>"> Discount Price %</option>
                                                    
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="name">Prefix Id</label>
                                                <input name="prefix_id" required class="form-control" type="text" placeholder="Example: WK, WM" value="<?php echo e(old('prefix_id')); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="name">Start Date</label>
                                                <input name="start_date" required class="form-control" type="datetime-local" value="<?php echo e(now()); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="name">End Date</label>
                                                <input name="end_date" required class="form-control" type="datetime-local" value="<?php echo e(now()); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Bacground Color</label>
                                                <input name="background_color" type="text" value="#ccc" class="gradient-colorpicker form-control ">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Text Color</label>
                                                <input name="text_color" value="#000000" class="gradient-colorpicker form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-4"><span>Estimated Shipping Time</span><input class="form-control" name="shipping_time" placeholder="Exm: 3-4 days" type="number"></div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="details">Details</label>
                                                <textarea name="details" id="details" placeholder="Describe Offer Details" class="summernote form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-6">
                                            <div class="form-group"> 
                                                <label class="dropify_image">Thumbnail Image</label>
                                                <input type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="5M"  name="thumbnail" id="input-file-events">
                                                <i class="image_size">Image Size:600px * 250px </i>
                                            </div>
                                            <?php if($errors->has('thumbnail')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <?php echo e($errors->first('thumbnail')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            <div class="form-group"> 
                                                <label class="dropify_image">Banner Image</label>
                                                <input  type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="banner" id="input-file-events">
                                                <i class="image_size">Image Size:1200px * 300px </i>
                                            </div>
                                            <?php if($errors->has('banner')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <?php echo e($errors->first('banner')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                       
                                        <div class="col-md-3 col-6">
                                            <div class="form-group">
                                                <div class="checkbox2">
                                                  <input type="radio" checked required name="allow_item" id="allProducts" value="all">
                                                  <label class="required" for="allProducts">Not Specific Products</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6">
                                            <div class="form-group">
                                                <div class="checkbox2">
                                                  <input type="radio" required name="allow_item" id="specific_offer" value="specific">
                                                  <label class="required" for="specific_offer">Allow Specific Offer Items</label>
                                                </div>
                                            </div>
                                        </div>
                                   
                                        <div class="col-md-12" id="specific_offer_item" style="display: none;">
                                        	<div class="row">
		                                        <div class="col-md-4">
		                                            <div class="form-group">
		                                               	<label>Select Seller</label>
		                                                <select multiple name="seller[]" id="seller" class="form-control select2 custom-select">
		                                                    <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                                                    <option value="<?php echo e($seller->id); ?>"> <?php echo e($seller->shop_name); ?></option>
		                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		                                                </select>
		                                            </div>
		                                        </div>
		                                        
		                                        <div class="col-md-4">
		                                            <div class="form-group">
		                                            	<label>Select Category</label>
		                                                <select multiple name="category[]" id="category" class="form-control custom-select select2">
		                                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                                                    <option value="<?php echo e($category->id); ?>"> <?php echo e($category->name); ?></option>
		                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		                                                </select>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-2">
		                                            <div class="form-group">
		                                               	<label>Select Brand</label>
		                                                <select multiple name="brand[]" id="brand" class="form-control custom-select select2">
		                                                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                                                    <option value="<?php echo e($brand->id); ?>"> <?php echo e($brand->name); ?></option>
		                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		                                                </select>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-2"><label >Allow location</label><select multiple name="allow_location[]" id="allow_location" class="select2 form-control custom-select"><?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option  value="<?php echo e($region->id); ?>"><?php echo e($region->name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select></div>
	                                        </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="checkbox2">
                                                  <input type="checkbox" id="ship_time" value="1">
                                                  <label  for="ship_time">Allow Shipping Charge</label>
                                                </div>
                                            </div>
                                            <div id="ship_time_display"  style="display: none;">

                                                <div class="form-group">
                                                    <div class="checkbox2 shipping-method">
                                                        <label for="free_shipping"><input data-parsley-required-message = "Shipping is required" type="radio" name="shipping_method" id="free_shipping" value="free">
                                                        Free Shipping</label>

                                                        <label for="Flate_shipping"><input type="radio" name="shipping_method" id="Flate_shipping" value="flate">
                                                        Flate Shipping</label>
                                                        <label for="Location_shipping">
                                                        <input type="radio" name="shipping_method" id="Location_shipping" value="location">
                                                        Location-based shipping</label>

                                                        <label for="qunatity_shipping">
                                                        <input type="radio" name="shipping_method" id="qunatity_shipping" value="qunatity">
                                                        Quantity-based shipping</label>
                                                    </div>
                                                </div>
                                                <div class="row" id="shipping-field"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="link" >Custom Link</label>
                                                <input name="link" placeholder="Redirect Another Page link" id="link" class="form-control" type="url">
                                            </div>
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
            <div class="modal-dialog modal-lg">
                <form action="<?php echo e(route('admin.offer.update')); ?>"  method="post" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Update offer</h4>
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
    <script src="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/js/dropify.min.js"></script>

    <!-- end - This is for export functionality only -->
    <script>
        $(".select2").select2();

        $(function () {
            $('#myTable').dataTable({
                "ordering": false
            });
        });
         // Basic
        $('.dropify').dropify();

    </script>

    <script type="text/javascript">

        //edit offer
        function edit_offer(id){
            $('#edit_form').html('<div class="loadingData"></div>');
            $('#edit_modal').modal('show');
            var  url = '<?php echo e(route("admin.offer.edit", ":id")); ?>';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $("#edit_form").html(data);
                        $(".select2").select2();
                         $('.dropify').dropify();
                        
                        $(".gradient-colorpicker").asColorPicker({
                            mode: 'gradient'
                        });
                        $('.summernote').summernote();

                    }
                }
            });
        }

        // if occur error open model
        <?php if($errors->any()): ?>
            $("#<?php echo e(Session::get('submitType')); ?>").modal('show');
        <?php endif; ?>
    </script>

    <script type="text/javascript">

    	$("#allProducts").change(function() {
	        if(this.checked) { $("#specific_offer_item").hide(); }
	        else { $("#specific_offer_item").show(); }
	    });

	    $("#specific_offer").change(function() {
	        if(this.checked) { $("#specific_offer_item").show(); }
	        else { $("#specific_offer_item").hide(); }
	    });

	    //shipping 

    	$("#ship_time").change(function() {
	        if(this.checked) { $("#ship_time_display").show(); }
	        else { $("#ship_time_display").hide(); $("#shipping-field").html('');}
	    });

	    $("#free_shipping").change(function() {
	        if(this.checked) { $("#shipping-field").html('<div class="col-md-3"><span>Estimated Shipping Time</span><input class="form-control" name="shipping_time" placeholder="Exm: 3-4 days" type="number"></div>'); }
	        else { $("#shipping-field").html(''); }

	    });
	   $("#Flate_shipping").change(function() {
	        if(this.checked) { $("#shipping-field").html('<div class="col-md-3"><span class="required">Shipping Cost</span><input class="form-control" name="shipping_cost" placeholder="Exm: 50" min="1" value="<?php echo e(Session::get("shipping_cost")); ?>" type="number"></div><div class="col-md-3"><span>Estimated Shipping Time</span><input class="form-control" value="<?php echo e(Session::get("shipping_time")); ?>" name="shipping_time" placeholder="Exm: 3-4 days" type="number"></div>'); }
	        else { $("#shipping-field").html(''); }
	    });

	    $("#qunatity_shipping").change(function() {
	        if(this.checked) { $("#shipping-field").html('<div class="col-md-3"><span class="required">Shipping cost</span><input class="form-control" required name="shipping_cost" placeholder="Exm: 60" min="1" type="number"></div><div class="col-md-3"><span class="required">Quantity</span><input class="form-control" required name="order_qty_above" placeholder="Exm: 2" min="1" type="number"></div><div class="col-md-3"><span>Discount shipping cost</span><input class="form-control" name="discount_shipping_cost" placeholder="Exm: 30" type="text"></div><div class="col-md-3"><span>Estimated Shipping Time</span><input class="form-control" name="shipping_time" placeholder="Exm: 3-4 days" type="number"></div>'); }
	        else { $("#shipping-field").html(''); }
	    });

	    $("#Location_shipping").change(function() {
	        if(this.checked) { $("#shipping-field").html('<div class="col-md-3"><span class="required">Select Specific Region</span><select required name="ship_region_id" id="ship_region_id" class="select2 form-control custom-select"><option value="">select Region</option> <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option <?php if(Session::get("ship_region_id") == $region->id): ?> selected <?php endif; ?> value="<?php echo e($region->id); ?>"><?php echo e($region->name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select></div><div class="col-md-2"><span class="required">Shipping Cost</span><input class="form-control" name="shipping_cost" value="<?php echo e(Session::get("shipping_cost")); ?>" placeholder="Exm: 50" min="1" type="number"></div></div><div class="col-md-3"><span>Others region cost</span><input class="form-control" value="<?php echo e(Session::get("other_region_cost")); ?>" name="other_region_cost" placeholder="Exm: 55" min="1" type="number"></div><div class="col-md-3"><span>Estimated Shipping Time</span><input class="form-control" name="shipping_time" placeholder="Exm: 3-4 days" value="<?php echo e(Session::get("shipping_time")); ?>" type="number"></div>');
	            
	            $(".select2").select2();

	        }
	        else { $("#shipping-field").html(''); }
	    });

    </script>


    <script src="<?php echo e(asset('assets')); ?>/node_modules/summernote/dist/summernote-bs4.min.js"></script>
    <script>
        $(function() {

            $('.summernote').summernote({
                height: 100, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: false // set focus to editable area after initializing summernote
            });

            $('.inline-editor').summernote({
                airMode: true
            });

        });

        window.edit = function() {
            $(".click2edit").summernote()
        },
        window.save = function() {
            $(".click2edit").summernote('destroy');
        }
</script>

 
    <!-- Color Picker Plugin JavaScript -->
    <script src="<?php echo e(asset('assets')); ?>/node_modules/jquery-asColor/dist/jquery-asColor.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    <script>
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/admin/offer/index.blade.php ENDPATH**/ ?>