
<?php $__env->startSection('title', 'Product list'); ?>
<?php $__env->startSection('css-top'); ?>
    <link href="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

    <link href="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets')); ?>/node_modules/bootstrap-switch/bootstrap-switch.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('css')); ?>/pages/bootstrap-switch.css" rel="stylesheet">

    <style type="text/css">
        .dropify_image{
            position: absolute;top: -12px!important;left: 12px !important; z-index: 9; background:#fff!important;padding: 3px;
        }
        .dropify-wrapper{
            height: 100px !important;
        }
        svg{width: 20px}
     
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
                        <h4 class="text-themecolor">Total Product (<?php echo e($all_products); ?>)</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Product</a></li>
                                <li class="breadcrumb-item active">list</li>
                            </ol>
                            <a class="btn btn-info d-none d-lg-block m-l-15" href="<?php echo e(route('admin.product.upload')); ?>"><i class="fa fa-plus-circle"></i> Add New Product</a>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                
              
                <div class="row">
                    
                    <div class="col-md-2 col-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pending</h5>
                            <div class="d-flex no-block align-items-center">
                                <span class="display-5 text-info"><i class="fa fa-bolt"></i></span>
                                <a href="<?php echo e(route('admin.product.list', 'pending')); ?>" class="link display-5 ml-auto"><?php echo e($pending_products); ?></a>
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
                                <a href="<?php echo e(route('admin.product.list', 'active')); ?>" class="link display-5 ml-auto"><?php echo e($active_products); ?></a>
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
                                <a href="<?php echo e(route('admin.product.list', 'deactive')); ?>" class="link display-5 ml-auto"><?php echo e($deactive_products); ?></a>
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
                                <a href="<?php echo e(route('admin.product.list', 'stock-out')); ?>" class="link display-5 ml-auto"><?php echo e($stockout_products); ?></a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-2 col-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">SEO Missing</h5>
                            <div class="d-flex no-block align-items-center">
                                <span class="display-5 text-danger"><i class="fa fa-bug"></i></span>
                                <a href="<?php echo e(route('admin.product.list', 'seo-missing')); ?>" class="link display-5 ml-auto"><?php echo e($seo_missing); ?></a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-2 col-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Image Missing</h5>
                            <div class="d-flex no-block align-items-center">
                                <span class="display-5 text-danger"><i class="fa fa-file-image"></i></span>
                                <a href="<?php echo e(route('admin.product.list', 'image-missing')); ?>" class="link display-5 ml-auto"><?php echo e($image_missing); ?></a>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" style="margin-bottom: 2px;">

                            <form action="<?php echo e(route('admin.product.list')); ?>" method="get">

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
                                                    <input name="sku" placeholder="SKU" value="<?php echo e(Request::get('sku')); ?>" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <select name="seller" required id="seller" style="width:100%" id="seller"  class="select2 form-control custom-select">
                                                       <option value="all">Seller All</option>
                                                       <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                       <option value="<?php echo e($vendor->id); ?>"><?php echo e($vendor->shop_name); ?></option>
                                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                   </select>
                                               </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <select name="brand" required id="brand" style="width:100%" id="brand"  class="select2 form-control custom-select">
                                                       <option value="all">All Brand</option>
                                                       <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                       <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option>
                                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                   </select>
                                               </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    
                                                    <select name="status" class="form-control">
                                                        <option value="all" <?php echo e((Request::get('status') == "all") ? 'selected' : ''); ?>>All Status</option>
                                                        <option value="pending" <?php echo e((Request::get('status') == 'pending') ? 'selected' : ''); ?> >Pending</option>
                                                        <option value="active" <?php echo e((Request::get('status') == 'active') ? 'selected' : ''); ?>>Active</option>
                                                        <option value="deactive" <?php echo e((Request::get('status') == 'deactive') ? 'selected' : ''); ?>>Deactive</option>
                                                        <option value="reject" <?php echo e((Request::get('status') == 'reject') ? 'selected' : ''); ?>>Reject</option>
                                                        <option value="stock-out" <?php echo e((Request::get('status') == 'stock-out') ? 'selected' : ''); ?>>Stock out</option>
                                                        
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

                <!-- Start Page Content -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12">
 
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive" >
                                    <table  class="table table-striped" >
                                        <thead>
                                            <tr>
                                                <!-- <th><input type="checkbox" id="checkAll" name=""></th> -->
                                                <th>#</th>
                                                <th>Product</th>
                                                <th>Seller</th>
                                                <th>Sales</th>
                                                <th>Regular_Price</th>
                                                <th>Discount_Price</th>
                                                <th>Stock</th>
                                                <th>Upload_By</th>
                                                <th>Approved</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(count($products)>0): ?>
                                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr id="item<?php echo e($product->id); ?>">
                                                   
                                                    <!--  <td> <input type="checkbox" class="product_id" name="product_id[<?php echo e($product->id); ?>]"></td> -->
                                                    <td><?php echo e((($products->perPage() * $products->currentPage() - $products->perPage()) + ($index+1) )); ?></td>
                                                    <td> <img src="<?php echo e(asset('upload/images/product/thumb/'.$product->feature_image)); ?>" alt="Image" width="50"> <a target="_blank" href="<?php echo e(route('product_details', $product->slug)); ?>"> <?php echo e(Str::limit($product->title, 40)); ?></a></td>
                                                   
                                                    <td><?php if($product->vendor): ?><a target="_blank" href="<?php echo e(route('admin.vendor.profile', $product->vendor->slug)); ?>"> <?php echo e($product->vendor->shop_name); ?></a><?php else: ?> Seller not found. <?php endif; ?>
                                                    <br/>
                                                    <i style="font-size:10px"><?php echo e(Carbon\Carbon::parse($product->created_at)->format(Config::get('siteSetting.date_format'))); ?></i>
                                                    </td>
                                                    <td><?php echo e($product->sales); ?></td>
                                                    
                                                    <td><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($product->selling_price); ?></td>
                                                    <td>
                                                       <?php
                                                        if($product->discount > 0){
                                                            if ($product->discount_type == '%') {
                                                                $discount_price = $product->selling_price - ($product->discount * $product->selling_price) / 100;                                                            } else {
                                                                $selling_price = $product->selling_price;
                                                                $discount_price = $product->selling_price - $product->discount; 
                                                            }
                                                        }
                                                       ?>
                                                       <?php if($product->discount): ?>
                                                       <span <?php if($discount_price < 0): ?> style="color:red" <?php endif; ?>>
                                                       <?php echo e(Config::get('siteSetting.currency_symble') . $discount_price); ?></span>
                                                       <?php else: ?> N/A <?php endif; ?>
                                                    </td>

                                                    <td><?php echo ($product->stock > 0) ? $product->stock : '<span style="width: 68px" class="label label-danger">Stock Out</span>'; ?></td>
                                                    <td><p><?php echo e(($product->user) ? $product->user->name : 'seller'); ?> <?php if($product->updated_by): ?><br/><?php echo e(($product->updatedBy) ? $product->updatedBy->name : 'seller'); ?> <?php endif; ?></p></td>
                                                    <td>
                                                        <div class="bt-switch">
                                                            <input  onchange="approveUnapprove('products', '<?php echo e($product->id); ?>')" type="checkbox" <?php echo e(($product->status != 'pending') ? 'checked' : ''); ?> data-on-color="success" data-off-color="danger" data-on-text="Approved" data-off-text="Pending"> 
                                                       
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <?php if($product->status != 'pending'): ?>
                                                        <div class="custom-control custom-switch">
                                                          <input  name="status" onclick="satusActiveDeactive('products', <?php echo e($product->id); ?>)"  type="checkbox" <?php echo e(($product->status == 1 || $product->status == 'active') ? 'checked' : ''); ?>  type="checkbox" class="custom-control-input" id="status<?php echo e($product->id); ?>">
                                                          <label style="padding: 5px 12px" class="custom-control-label" for="status<?php echo e($product->id); ?>"></label>
                                                        </div>
                                                        <?php else: ?>
                                                            <span class="label label-warning">Pending </span>
                                                        <?php endif; ?>
                                                    </td>
                                                   
                                                    <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="ti-settings"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a target="_blank" class="dropdown-item text-inverse" title="View product" href="<?php echo e(route('product_details', $product->slug)); ?>"><i class="ti-eye"></i> View Product</a>
                                                            <a class="dropdown-item" title="Edit product" href="<?php echo e(route('admin.product.edit', $product->slug)); ?>"><i class="ti-pencil-alt"></i> Edit</a>
                                                            <span title="Highlight product (Ex. Best Seller, Top Rated etc.)" >
                                                            <a onclick="producthighlight(<?php echo e($product->id); ?>)" class="dropdown-item"  href="javascript:void(0)"><i class="ti-pin-alt"></i> Highlight</a></span>
                                                            <span title="Manage Gallery Images" >
                                                            <a onclick="setGallerryImage(<?php echo e($product->id); ?>)" data-toggle="modal" data-target="#GallerryImage" class="dropdown-item" href="javascript:void(0)"><i class="ti-image"></i> Gallery Images</a></span>
                                                            <span title="Delete"><button   data-target="#delete" onclick='deleteConfirmPopup("<?php echo e(route("admin.product.delete", $product->id)); ?>")'  data-toggle="modal" class="dropdown-item" ><i class="ti-trash"></i> Delete Product</button></span>
                                                        </div>
                                                    </div>                                                  
                                                    </td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?> <tr><td>No Products Found.</td></tr><?php endif; ?>
                                        </tbody>
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <div class="row">
                   <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                       <?php echo e($products->appends(request()->query())->links()); ?>

                      </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing <?php echo e($products->firstItem()); ?> to <?php echo e($products->lastItem()); ?> of total <?php echo e($products->total()); ?> entries (<?php echo e($products->lastPage()); ?> Pages)</div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- Gallery Modal -->
        <div class="modal fade" id="GallerryImage" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Upload Gallery Image</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row">
                        <div class="card-body">
                            <form action="<?php echo e(route('product.storeGalleryImage')); ?>" enctype="multipart/form-data" method="POST" class="floating-labels">
                                <?php echo e(csrf_field()); ?>

                               
                                <div class="form-body">
                                   
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-12">
                                            <div class="form-group"> 
                                                <label class="dropify_image">Select Multiple Image</label>
                                                <input  type="file" multiple class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="5M"  name="gallery_image[]" id="input-file-events">
                                            </div>
                                            <?php if($errors->has('gallery_image')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <?php echo e($errors->first('gallery_image')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-12" id="showGallerryImage"></div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Upload</button>
                                    <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        <!-- HightLight Modal -->
        <!-- Gallery Modal -->
        <div class="modal fade" id="producthighlight_modal" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Hightlight Product</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row">
                        <div class="card-body">
                            
                            <div class="form-body">
                               <div id="highlight_form"></div>
                               
                            </div>

                        </div>
                    </div>
                </div>
            </div>
          </div>
        <?php echo $__env->make('admin.modal.delete-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(".select2").select2();

    function setGallerryImage(id) {
       
        $('#showGallerryImage').html('<div class="loadingData"></div>');
        var  url = '<?php echo e(route("product.getGalleryImage", ":id")); ?>';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#showGallerryImage").html(data);
                }
            },
            // $ID = Error display id name
            <?php echo $__env->make('common.ajaxError', ['ID' => 'showGallerryImage'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        });
    }


    function deleteGallerryImage(id) {
       
        if (confirm("Are you sure delete this image.?")) {
           
            var url = '<?php echo e(route("product.deleteGalleryImage", ":id")); ?>';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $('#gelImage'+id).hide();
                        toastr.success(data.msg);
                    }else{
                        toastr.error(data.msg);
                    }
                }
            });
        }
        return false;
    }


    function producthighlight(id){
        $('#highlight_form').html('<div class="loadingData"></div>');
        $('#producthighlight_modal').modal('show');
        var  url = '<?php echo e(route("product.highlight", ":id")); ?>';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#highlight_form").html(data);
                }
            },
            // $ID = Error display id name
            <?php echo $__env->make('common.ajaxError', ['ID' => 'highlight_form'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        });
    }

        //change status by id
        function highlightAddRemove(section_id, product_id){
            var  url = '<?php echo e(route("highlightAddRemove")); ?>';
            $.ajax({
                url:url,
                method:"get",
                data:{section_id:section_id, product_id:product_id},
                success:function(data){
                    if(data.status){
                        toastr.success(data.msg);
                    }else{
                        toastr.error(data.msg);
                    }
                }
            });
        }

    </script>
   <script src="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/js/dropify.min.js"></script>
     <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();
    });
    </script>

        <!-- bt-switch -->
    <script src="<?php echo e(asset('assets')); ?>/node_modules/bootstrap-switch/bootstrap-switch.min.js"></script>
    <script type="text/javascript">
    $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
    var radioswitch = function() {
        var bt = function() {
            $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioState")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
            })
        };
        return {
            init: function() {
                bt()
            }
        }
    }();
    $(document).ready(function() {
        radioswitch.init()
    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/admin/product/product-lists.blade.php ENDPATH**/ ?>