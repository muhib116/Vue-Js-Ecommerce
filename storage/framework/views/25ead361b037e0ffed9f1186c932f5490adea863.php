
<?php $__env->startSection('title', 'Upload B2B Products'); ?>

<?php $__env->startSection('css-top'); ?>
    <link href="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('assets')); ?>/node_modules/summernote/dist/summernote-bs4.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('assets')); ?>/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
<style type="text/css">
    @media  screen and (min-width: 640px) {
        .divrigth_border::after {
            content: '';
            width: 0;
            height: 100%;
            margin: -1px 0px;
            position: absolute;
            top: 0;
            left: 100%;
            margin-left: 0px;
            border-right: 3px solid #e5e8ec;
        }
    }
    .dropify_image{
            position: absolute;top: -14px!important;left: 12px !important; z-index: 9; background:#fff!important;padding: 3px;
        }
    .dropify-wrapper{
        height: 100px !important;
    }
    .bootstrap-tagsinput{
            width: 100% !important;
            padding: 5px;
        }
    .closeBtn{position: absolute;right: 0;bottom: 10px;}
    form label{font-weight: 600;}
    form span{font-size: 12px;}
    #main-wrapper{overflow: visible !important;}
    .shipping-method label{font-size: 13px; font-weight:500; margin-left: 15px; }
    #shipping-field{padding: 0 15px;margin-bottom: 10px; }

    .form-control{padding-left: 5px; overflow: hidden;}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Add New B2B Products</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Product</a></li>
                                <li class="breadcrumb-item active">Create</li>
                            </ol>
                        <a href="<?php echo e(route('admin.b2b.list')); ?>" class="btn btn-info btn-sm d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Product List</a>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->

            <div class="card">
                <div id="pageLoading"></div>
                <div class="card-body">

                    <form action="<?php echo e(route('admin.b2b.store')); ?>" data-parsley-validate enctype="multipart/form-data" method="post" id="product">
                        <?php echo csrf_field(); ?>

                        <div class="form-body">
                            <div class="row" style="align-items: flex-start; overflow: visible;">
                                <div class="col-md-9 divrigth_border">
                                    <div class="row">
                                        <div class="col-md-12 title_head">
                                            Product Basic Information
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="title">Product Title</label>
                                                <input type="text" onchange="getSlug(this.value)" data-parsley-required-message = "Product title is required" value="<?php echo e(old('title')); ?>" name="title" required="" id="title" placeholder = 'Enter title' class="form-control" >
                                                <?php if($errors->has('title')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <?php echo e($errors->first('title')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="slug">Product URL</label>
                                                <input name="slug" placeholder="Product url" id="product_slug" value="<?php echo e(old('slug')); ?>" required="" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="required" for="category">Select category</label>
                                                <select required  onchange="get_subcategory(this.value)" name="category" id="category" class="select2 form-control custom-select">
                                                   <option value="">Select category</option>
                                                   <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                   <option <?php if(Session::get("category_id") == $category->id): ?> selected <?php endif; ?>  value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?> </option>
                                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php if($errors->has('category')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <?php echo e($errors->first('category')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="required" for="subcategory">Select subcategory</label>
                                                <select onchange="get_subchild_category(this.value)" required name="subcategory" id="subcategory" class="form-control select2 custom-select">
                                                   <option value="">Select first category</option>
                                                </select>
                                                <?php if($errors->has('subcategory')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <?php echo e($errors->first('subcategory')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="subchildcategory">Select Child Category</label>
                                                <select onchange="getAttributeByCategory(this.value, 'getAttributesByChildcategory')" name="childcategory"  id="subchildcategory" class="select2 form-control custom-select">
                                                   <option value="">Select first sub category</option>

                                                </select>
                                                <?php if($errors->has('childcategory')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <?php echo e($errors->first('childcategory')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
										
										
										<div class="col-md-3">
                                            <div class="form-group">
                                                <label for="subchildcategory">Minimum Quantity</label>
                                                <input type="number" class="form-control" name="minqty" value="1" placeholder="Minimum Quantity">
                                                <?php if($errors->has('minqty')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <?php echo e($errors->first('minqty')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
										
										
<div class="col-md-12 title_head">
                                            Product Pricing
                                        </div>
										
										
										
										
										
										
										
										
										
										
										<div class="col-md-12">
										           <div id="pricing">

                                                <div class="row">
                                                   
                                                    <div class="col-sm-4 nopadding">
                                                        <div class="form-group">
                                                            <span>From Quantity</span>
                                                            <input type="number" class="form-control" name="start[]"  placeholder="From Quantitiy">
                                                        </div>
                                                    </div>
                                             
											 
											 
											 
                                                    <div class="col-sm-4 nopadding">
                                                        <div class="form-group">
                                                            <span>To Quantity</span>
                                                            <input type="number" class="form-control"  name="end[]"  placeholder="To Quantity">
                                                        </div>
                                                    </div>
                                                  

                                                
                                                    <div class="col-sm-3 nopadding">
                                                        <div class="form-group">
                                                            <span>Price</span>
                                                            <input type="number" class="form-control" name="amt[]"  placeholder="Price">
                                                        </div>
                                                    </div>
                                                   

                                                   
                                                    <div class="col-1 nopadding" style="padding-top: 20px">
                                                        <button class="btn btn-success" type="button" onclick="price_fields();"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div id="pricing"></div>
                                               
                                            </div>
 <div class="row justify-content-md-center"><div class="col-md-4"> <span  style="cursor: pointer;" class="btn btn-info btn-sm" onclick="price_fields()"><i class="fa fa-plus"></i> Add More Price Range</span></div></div> <hr/>
                                        </div>
										
										
										
										
										
										
										
										
										
										
										
										
										
										
										
										
                                    

                                        <div class="col-md-12 title_head">
                                            Product Variation & Features
                                        </div>
                                        <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php
                                            //column divited by attribute field
                                            if($attribute->qty && $attribute->price && $attribute->color && $attribute->image){
                                                $col = 2;
                                            }else{
                                                $col = 2;
                                            }

                                            //set attribute name for js variable & function
                                            $attribute_fields = str_replace('-', '_', $attribute->slug);
                                        ?>
                                        <div class="col-md-12">
                                            <!-- Allow attribute checkbox button -->
                                            <div class="form-group">
                                                <div class="checkbox2">
                                                    <input type="checkbox" id="check<?php echo e($attribute->id); ?>" name="attribute[<?php echo e($attribute->id); ?>]" value="<?php echo e($attribute->name); ?>">
                                                    <label for="check<?php echo e($attribute->id); ?>">Allow Product <?php echo e($attribute->name); ?></label>
                                                </div>
                                            </div>
                                            <!--Value fields show & hide by allow checkbox -->
                                            <div id="attribute<?php echo e($attribute->id); ?>" style="display: none;">

                                                <div class="row">
                                                    <div class="col-sm-2 nopadding">
                                                        <div class="form-group">
                                                            <span class="required"><?php echo e($attribute->name); ?> Name</span>

                                                            <select class="form-control" name="attributeValue[<?php echo e($attribute->id); ?>][]">
                                                                <?php if($attribute->get_attrValues): ?>
                                                                    <?php if(count($attribute->get_attrValues)>0): ?>
                                                                        <option value="">Select <?php echo e($attribute_fields); ?></option>
                                                                        <?php $__currentLoopData = $attribute->get_attrValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($value->name); ?>"><?php echo e($value->name); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php else: ?>
                                                                        <option value="">Value Not Found</option>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-<?php echo e($col); ?> nopadding">
                                                        <div class="form-group">
                                                            <span>SKU</span>
                                                            <input type="text" class="form-control" name="sku[<?php echo e($attribute->id); ?>][]"  placeholder="SKU">
                                                        </div>
                                                    </div>
                                                    <!-- check qty weather set or not -->
                                                    <?php if($attribute->qty): ?>
                                                    <div class="col-sm-1 nopadding">
                                                        <div class="form-group">
                                                            <span>Quantity</span>
                                                            <input type="text" class="form-control"  name="qty[<?php echo e($attribute->id); ?>][]"  placeholder="Qty">
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>

                                                 
                                                    <?php if($attribute->color): ?><div class="col-sm-<?php echo e($col); ?> nopadding"><div class="form-group"><span>Select Color</span><input onfocus="(this.type='color')" placeholder="Pick Color" class="form-control"  name="color[<?php echo e($attribute->id); ?>][]" ></div></div><?php endif; ?>

                                                    <!-- check image weather set or not -->
                                                    <?php if($attribute->image): ?>
                                                    <div class="col-sm-<?php echo e($col); ?> nopadding">
                                                        <div class="form-group">
                                                            <span>Upload Image</span>

                                                            <div class="input-group">
                                                                <input type="file" class="form-control" name="image[<?php echo e($attribute->id); ?>][]">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                    <div class="col-1 nopadding" style="padding-top: 20px">
                                                        <button class="btn btn-success" type="button" onclick="<?php echo e($attribute_fields); ?>_fields();"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div id="<?php echo e($attribute_fields); ?>_fields"></div>
                                                <div class="row justify-content-md-center"><div class="col-md-4"> <span  style="cursor: pointer;" class="btn btn-info btn-sm" onclick="<?php echo e($attribute_fields); ?>_fields()"><i class="fa fa-plus"></i> Add More <?php echo e($attribute->name); ?></span></div></div> <hr/>
                                            </div>

                                        </div>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-12">

                                            <div id="productVariationField" >
                                                <div id="getAttributesByCategory"></div>
                                                <div id="getAttributesBySubcategory"></div>
                                                <div id="getAttributesByChildcategory"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <!-- Allow attribute checkbox button -->
                                            <div class="form-group">
                                                <div class="checkbox2">
                                                    <label for="predefinedFeature">Product Features</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div style="margin-bottom:10px;" class="col-4 <?php if($feature->is_required): ?> required <?php endif; ?> col-sm-2 text-right col-form-label"><?php echo e($feature->name); ?>

                                                <input type="hidden" value="<?php echo e($feature->name); ?>" class="form-control" name="features[<?php echo e($feature->id); ?>]"></div>
                                                <div class="col-8 col-sm-4">
                                                    <input <?php if($feature->is_required): ?> required <?php endif; ?> type="text" name="featureValue[<?php echo e($feature->id); ?>]" value="" class="form-control" placeholder="Input value here">
                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>

                                            <div id="PredefinedFeatureBycategory"></div>
                                            <div id="PredefinedFeatureBySubcategory"></div>
                                            <div id="PredefinedFeatureByChildcategory"></div>
                                           <!--  <div class="form-group row"><span class="col-4 col-sm-2 text-right col-form-label">Feature name</span> <div class="col-8 col-sm-4"> <input type="text" class="form-control"  name="extraFeatureName[]"  placeholder="Feature name"> </div><span class="col-4 col-sm-2 text-right col-form-label">Feature Value</span> <div class="col-7 col-sm-3"> <input type="text" name="extraFeatureValue[]" class="form-control"  placeholder="Input value here"> </div> <div class="col-1"><button class="btn btn-success" type="button" onclick="extraPredefinedFeature();"><i class="fa fa-plus"></i></button></div></div>
                                            <div id="extraPredefinedFeature"></div>
                                            <div class="row justify-content-md-center"><div class="col-md-4"> <span  style="cursor: pointer;" class="btn btn-info btn-sm" onclick="extraPredefinedFeature()"><i class="fa fa-plus"></i> Add More Feature </span></div></div> <hr/> -->

                                        </div>

                                        <div class="col-md-12">
                                        	<div class="form-group">
                                        		<label class="required" >Short Summery</label>
	                                           <textarea data-parsley-required-message = "Summery is required" style="resize: vertical;" rows="3" name="summery" class=" summernote form-control"><?php echo e(old('summery')); ?></textarea>
	                                       </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required">Product Description</label>
                                               <textarea data-parsley-required-message = "Description is required" required="" name="description" class="summernote form-control"><?php echo e(old('description')); ?></textarea>
                                           </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <?php if(config('siteSetting.shipping_method') == 'product_wise_shipping'): ?>
                                                <div class="col-md-12 title_head">
                                                    Shipping & Delivery
                                                </div>

                                                <!-- 
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="required" >Product Package</label>
                                                        </div>
                                                        <div class="col-sm-4 nopadding">
                                                           <div class="form-group">
                                                                <span>Package Weight (kg)</span>
                                                                <input required type="number" min="1" class="form-control"  name="weight"  placeholder="Enter weight">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 nopadding">
                                                             <label class="required">Package Dimensions (cm) </label>
                                                        </div>
                                                        <div class="col-md-3 nopadding">
                                                            <div class="form-group">
                                                                <span class="required">Length (cm)</span>
                                                                <input required type="number" min="1" class="form-control"  name="length"  placeholder="Enter Length">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 nopadding">
                                                            <div class="form-group">
                                                                <span class="required">Width (cm)</span>
                                                                <input required type="number" min="1" class="form-control"  name="width"  placeholder="Enter Width">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 nopadding">
                                                            <div class="form-group">
                                                                <span>Height (cm)</span>
                                                                <input required type="number" min="1" class="form-control" name="height"  placeholder="Enter Height">
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                                -->
                                                
                                                <div class="col-md-12">
                                                    
                                                    <div class="form-group">
                                                        <div class="checkbox2 shipping-method">
                                                            <label for="free_shipping"><input data-parsley-required-message = "Shipping is required" type="radio" name="shipping_method" id="free_shipping" required value="free">
                                                            Free Shipping</label>

                                                            <label for="Flate_shipping"><input type="radio" name="shipping_method" id="Flate_shipping" required value="Flate">
                                                            Flate Shipping</label>
                                                            <label for="Location_shipping">
                                                            <input type="radio" name="shipping_method" id="Location_shipping" required value="location">
                                                            Location-based shipping</label>
                                                        </div>
                                                    </div>
                                                    <div class="row" id="shipping-field"></div>
                                                
                                                </div>
                                                <?php endif; ?>
                                                <div class="col-md-12">
                                                    
                                                    <div class="form-group">
                                                            <span class="required">Product Tags( <span style="font-size: 12px;color: #777;font-weight: initial;">Write tags Separated by Comma[,]</span> )</span>

                                                             <div class="tags-default">
                                                                <select type="text" name="keywords[]" class="itemName" ></select>
                                                            </div>
                                                        </div>
                                                    
                                                    
                                                  
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 sticky-conent">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="product_type">Cart Button</label>
                                                <select required onchange="productType(this.value)" name="product_type" id="product_type" class=" form-control">
                                                   <?php $__currentLoopData = $cartButtons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cartButton): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                   <option <?php if(Session::get("product_type") == $cartButton->slug): ?> selected <?php endif; ?>  value="<?php echo e($cartButton->slug); ?>"><?php echo e($cartButton->btn_name); ?></option>
                                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php if($errors->has('product_type')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <?php echo e($errors->first('product_type')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div id="showProductType"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="stock">Product Stock</label>
                                                <input type="text" value="<?php echo e(old('stock')); ?>"  name="stock" id="stock" placeholder = 'Example: 100' class="form-control" >
                                            </div>
                                        </div>


<div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="stock">Profit Percentage</label>
                                                <input type="number" step="0.01" value="<?php echo e(old('profit')); ?>"  name="profit" id="profit" placeholder = 'Example: 100' class="form-control" >
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="stock">SKU</label>
                                                <input type="text" value="<?php echo e(old('sku')); ?>"  name="sku" id="sku" placeholder = 'Example: sku-120' class="form-control" >
                                            </div>
                                        </div>

                                       
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="brand">Brand </label>
                                                <select name="brand" required id="brand" style="width:100%" id="brand" data-parsley-required-message = "Brand is required" class="select2 form-control custom-select">
                                                   <option value="">Select Brand</option>
                                                   <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                   <option  <?php if(Session::get("brand") == $brand->id): ?> selected <?php endif; ?>  value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option>
                                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                               </select>
                                           </div>
                                        </div>

                                    	<div class="col-md-12">
                                            <div class="form-group">
                                                <label class="dropify_image required">Feature Image</label>
                                                <input type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg svg png gif"  data-max-file-size="5M"  name="feature_image" id="input-file-events">
                                            </div>
                                            <?php if($errors->has('feature_image')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <?php echo e($errors->first('feature_image')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="dropify_image">Gallery Image</label>
                                                <input  type="file" multiple class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="2M"  name="gallery_image[]" id="input-file-events">
                                                <i style="color:red;font-size: 11px">Select Multiple Image(Press Ctrl + Mouse click)</i>
                                            </div>
                                            <?php if($errors->has('gallery_image')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <?php echo e($errors->first('gallery_image')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>

                                    
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="vendor">Vendor </label>
                                                <select name="vendor_id" required id="vendor" style="width:100%" id="vendor" data-parsley-required-message = "Please select vendor" class="select2 form-control custom-select">
                                                   <option disabled value="">Select Vendor</option>
                                                   <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                   <option  <?php if(Session::get("vendor_id") == $vendor->id): ?> selected <?php endif; ?>  value="<?php echo e($vendor->id); ?>"><?php echo e($vendor->shop_name); ?></option>
                                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                               </select>
                                           </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <div class="checkbox2">
                                                  <input name="product_video" type="checkbox" id="product_video" value="1">
                                                  <label for="product_video">Add Video</label>
                                                </div>

                                            </div>
                                            <div id="video_display"  style="display: none;">
                                                <div id="extra_video_fields"></div>
                                                <div style="text-align: center;"><span  style="cursor: pointer;" class="btn btn-info btn-sm" onclick="extra_video_fields()"><i class="fa fa-plus"></i> Add More </span>
                                                </div>

                                            </div>
                                        </div>
                                         <!-- <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="manufacture_date">Manufacture date(Mfd)</label>
                                                <input type="date" value="<?php echo e(old('manufacture_date')); ?>" placeholder = 'Enter manufacture date' name="manufacture_date" id="manufacture_date" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="expired_date">Expired date(Exd)</label>
                                                <input type="date" value="<?php echo e(old('expired_date')); ?>" placeholder = 'Enter expired date' name="expired_date" id="expired_date" class="form-control" >
                                            </div>
                                        </div> -->


                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <label class="switch-box" style="top:-12px;">Status</label>

                                                    <div class="custom-control custom-switch">
                                                      <input name="status" <?php echo e((old('status') == 'on') ? 'checked' : ''); ?> checked type="checkbox" class="custom-control-input" id="status">
                                                      <label style="padding: 5px 12px" class="custom-control-label" for="status">Publish/Unpublish</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div><hr>
                        <div class="form-actions pull-right" style="float: right;">
                            <button type="submit" id="uploadBtn" name="submit" value="save" class="btn btn-success"> <i class="fa fa-save"></i> Save Product </button>

                            <button type="reset" class="btn waves-effect waves-light btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/js/dropify.min.js"></script>

    <script type="text/javascript">
        function getSlug(slug) {
            var  url = '<?php echo e(route("slug")); ?>';
            $.ajax({
                url:url,
                method:"get",
                data:{slug:slug, field:'slug',table:'products'},
                success:function(slug){
                    if(slug){
                        document.getElementById('product_slug').value = slug;
                    }else{
                        document.getElementById('product_slug').value = "";
                    }
                }
            });
        }
        //check required fieled is filled or not
        $('#uploadBtn').on("click", function(){
          let valid = true;
          $('[required]').each(function() {
            if ($(this).is(':invalid') || !$(this).val()) valid = false;
          })
          if (valid){  document.getElementById('pageLoading').style.display = 'block';  };
        })


        <?php if(old('category')): ?>
            get_subcategory(<?php echo e(old('category')); ?>);
        <?php endif; ?>

        <?php if(Session::has("category_id")): ?> 
            get_subcategory(<?php echo e(Session::get("category_id")); ?>);
        <?php endif; ?>

        function get_subcategory(id=''){
            if(id){
            document.getElementById('pageLoading').style.display ='block';

            //get attribute by category
            getAttributeByCategory(id, 'getAttributesByCategory');
            //when main category change reset attribute fields
            $('#getAttributesBySubcategory').html(' ');
            $('#getAttributesByChildcategory').html(' ');

            //get product feature by sub category
            getFeature(id, 'PredefinedFeatureBycategory');
            //when category change reset feature
            $('#PredefinedFeatureBySubcategory').html(' ');
            $('#PredefinedFeatureByChildcategory').html(' ');

            var  url = '<?php echo e(route("getSubCategory", ":id")); ?>';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $("#subcategory").html(data);
                        $("#subcategory").focus();
                    }else{
                        $("#subcategory").html('<option value="">subcategory not found</option>');
                    }
                    document.getElementById('pageLoading').style.display ='none';
                }
            });
        }else{
            $("#subcategory").html(' <option value="">Select first category</option>');
        }
        }
        
        <?php if(Session::has("subcategory_id")): ?> 
            get_subchild_category(<?php echo e(Session::get("subcategory_id")); ?>);
        <?php endif; ?>
        function get_subchild_category(id=''){
            if(id){
            //enable loader
            document.getElementById('pageLoading').style.display ='block';

            //get product feature by sub category
            getFeature(id, 'PredefinedFeatureBySubcategory');
            //when sub category change reset feature
            $('#PredefinedFeatureByChildcategory').html(' ');

            //get attribute by sub category
            getAttributeByCategory(id, 'getAttributesBySubcategory');
            //when sub category change reset attribute fields
             $('#getAttributesByChildcategory').html(' ');

            var  url = '<?php echo e(route("getSubChildCategory", ":id")); ?>';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){

                    if(data){
                        $("#subchildcategory").html(data);
                        $("#subchildcategory").focus();
                    }else{
                        $("#subchildcategory").html('<option value="">Childcategory not found</option>');
                    }
                    document.getElementById('pageLoading').style.display ='none';

                }
            });
        }else{
            $("#subchildcategory").html(' <option value="">Select first subcategory</option>');
        }
        }

        // get Attribute by Category
        function getAttributeByCategory(id, category){
            if(id){
            //enable loader
            document.getElementById('pageLoading').style.display ='block';

            //get product feature by child category
            if(category == 'getAttributesByChildcategory'){
                getFeature(id, 'PredefinedFeatureByChildcategory');
            }

            var  url = '<?php echo e(route("getAttributeByCategory", ":id")); ?>';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){

                    if(data){
                        $("#"+category).html(data);
                        $(".select2").select2();
                    }else{
                        $("#"+category).html('');
                    }
                    document.getElementById('pageLoading').style.display ='none';
                }
            });
        }else{
            $("#"+category).html('');
        }
        }

        // get feature by Category
        function getFeature(id, category){

            var  url = '<?php echo e(route("getFeature", ":id")); ?>';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){

                    if(data){
                        $("#"+category).html(data);
                    }else{
                        $("#"+category).html('');
                    }
                }
            });
        }
    </script>

     <!--  //get  attribute variation -->
    <script type="text/javascript">
	
	
	
	
	
	
	 function price_fields() {

            pricing++;
            var objTo = document.getElementById('pricing')
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "removeclass" + price_fields);
            var rdiv = 'removeclass' + pricing;
            divtest.innerHTML = '<div class="row"><div class="col-sm-4 nopadding"><div class="form-group"><span>From Quantity</span><input type="number" class="form-control" name="start[]"  placeholder="From Quantity"></div></div><div class="col-sm-4 nopadding"><div class="form-group"><span>To Quantity</span><input type="number" class="form-control"  name="end[]"  placeholder="To Quantity"></div></div><div class="col-sm-3 nopadding"><div class="form-group"><span>Price</span><input type="number" class="form-control" name="amt[]"  placeholder="Price"></div></div><div class="col-1"><button class="btn btn-danger" type="button" onclick="remove_pricing_fields(' + pricing + ');"><i class="fa fa-times"></i></button></div></div>';

            objTo.appendChild(divtest)
        }
        //remove dynamic extra field
        function remove_pricing_fields(rid) {
            $('.removeclass' + rid).remove();
        }
	
	
	
        <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php
            //column divited by attribute field
            if($attribute->qty && $attribute->price && $attribute->color && $attribute->image){
                $col = 2;
            }else{
                $col = 2;
            }

            //set attribute name for js variable & function
            $attribute_fields = str_replace('-', '_', $attribute->slug);
        ?>
        var <?php echo e($attribute_fields); ?> = 1;
        //add dynamic attribute value fields by attribute
        function <?php echo e($attribute_fields); ?>_fields() {

            <?php echo e($attribute_fields); ?>++;
            var objTo = document.getElementById('<?php echo e($attribute_fields); ?>_fields')
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "removeclass" + <?php echo e($attribute_fields); ?>);
            var rdiv = 'removeclass' + <?php echo e($attribute_fields); ?>;
            divtest.innerHTML = '<div class="row"> <div class="col-sm-2 nopadding"> <div class="form-group"> <select required class="select2 form-control" name="attributeValue[<?php echo e($attribute->id); ?>][]"> <?php if($attribute->get_attrValues): ?> <?php if(count($attribute->get_attrValues)>0): ?> <option value=""><?php echo e($attribute_fields); ?></option> <?php $__currentLoopData = $attribute->get_attrValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option value="<?php echo e($value->name); ?>"><?php echo e($value->name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php else: ?> <option value="">Value Not Found</option> <?php endif; ?> <?php endif; ?> </select> </div> </div> <div class="col-sm-<?php echo e($col); ?> nopadding"><div class="form-group"><input type="text" class="form-control" name="sku[<?php echo e($attribute->id); ?>][]"  placeholder="SKU"></div></div> <?php if($attribute->qty): ?>  <div class="col-sm-1 nopadding"> <div class="form-group"><input type="text" class="form-control"  name="qty[<?php echo e($attribute->id); ?>][]"  placeholder="Qty"></div></div><?php endif; ?>  <?php if($attribute->color): ?><div class="col-sm-<?php echo e($col); ?> nopadding"><div class="form-group"><input onfocus="(this.type=\'color\')" placeholder="Pick Color" class="form-control" name="color[<?php echo e($attribute->id); ?>][]"  ></div></div><?php endif; ?> <?php if($attribute->image): ?> <div class="col-sm-<?php echo e($col); ?> nopadding"><div class="form-group"><div class="input-group"><input type="file" class="form-control" name="image[<?php echo e($attribute->id); ?>][]"></div></div></div><?php endif; ?><div class="col-1"><button class="btn btn-danger" type="button" onclick="remove_<?php echo e($attribute_fields); ?>_fields(' + <?php echo e($attribute_fields); ?> + ');"><i class="fa fa-times"></i></button></div></div>';

            objTo.appendChild(divtest)
        }
        //remove dynamic extra field
        function remove_<?php echo e($attribute_fields); ?>_fields(rid) {
            $('.removeclass' + rid).remove();
        }

        //Allow checkbox check/uncheck handle
        $("#check"+<?php echo e($attribute->id); ?>).change(function() {
            if(this.checked) {
                $("#attribute"+<?php echo e($attribute->id); ?>).show();
                
            } else {
                $("#attribute"+<?php echo e($attribute->id); ?>).hide();
            }
        });
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
    </script>



    <script>
        function productType(item) {
            if(item == 'add-to-download'){
                $("#showProductType").html(`<div class="row" style="align-items: center">
                    <div class="col-12"><div class="form-group">
                    <span class="required">Attach File</span>
                    <select class="form-control" onchange="fileType(this.value)">
                    <option value="upload">Local Upload</option>
                    <option value="link">External Link</option>
                    </select>
                    <div id="showfileType">
                    <span class="required">Attach File</span>
                    <input name="file" required type="file" class="form-control">
                    </div>

                    </div>
                    </div>
                </div>`);
            }else if(item == 'pre-order'){
                $("#showProductType").html(`<div class="row" style="align-items: center">
                    <div class="col-12"><div class="form-group">
                    <span class="required">Availability Date</span>
                    <input type="datetime-local" class="form-control" name="availability_date">
                   
                    <span class="required">Pre Order Fee</span>
                    <input name="pre_order_fee" required placeholder="Enter price" type="number" class="form-control">
                    </div>
                    </div>
                </div>`);
            }
            else{
                $("#showProductType").html('');
            }
        }

        function fileType(item) {
            if(item == 'upload'){
                $("#showfileType").html(`
                    <span class="required">Attach File</span>
                    <input required name="file" type="file" class="form-control">
                `);
            }else{
                $("#showfileType").html('<span class="required">External File link</span><input class="form-control" required name="file_link" id="video_link" placeholder="Exm: https://drive.google.com" type="text">');
            }
        }
    </script>

    <script>

    $(document).ready(function() {
        $(".select2").select2();
        // Basic
        $('.dropify').dropify();

    });

    <?php if(config('siteSetting.shipping_method') == 'product_wise_shipping'): ?>

    $("#free_shipping").change(function() {
        if(this.checked) { $("#shipping-field").html('<div class="col-md-3"><span>Estimated Shipping Time</span><input class="form-control" name="shipping_time" placeholder="Exm: 3-4 days" type="text"></div>'); }
        else { $("#shipping-field").html(''); }

    });
   $("#Flate_shipping").change(function() {
        if(this.checked) { $("#shipping-field").html('<div class="col-md-3"><span class="required">Shipping Cost</span><input class="form-control" name="shipping_cost" placeholder="Exm: 50" min="1" value="<?php echo e(Session::get("shipping_cost")); ?>" type="number"></div><div class="col-md-3"><span>Estimated Shipping Time</span><input class="form-control" value="<?php echo e(Session::get("shipping_time")); ?>" name="shipping_time" placeholder="Exm: 3-4 days" type="text"></div>'); }
        else { $("#shipping-field").html(''); }
    });


    $("#Location_shipping").change(function() {
        if(this.checked) { $("#shipping-field").html('<div class="col-md-3"><span class="required">Select Specific Region</span><select required name="ship_region_id" id="ship_region_id" class="select2 form-control custom-select"><option value="">select Region</option> <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option <?php if(Session::get("ship_region_id") == $region->id): ?> selected <?php endif; ?> value="<?php echo e($region->id); ?>"><?php echo e($region->name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select></div><div class="col-md-2"><span class="required">Shipping Cost</span><input class="form-control" name="shipping_cost" value="<?php echo e(Session::get("shipping_cost")); ?>" placeholder="Exm: 50" min="1" type="number"></div></div><div class="col-md-3"><span>Others region shipping cost</span><input class="form-control" value="<?php echo e(Session::get("other_region_cost")); ?>" name="other_region_cost" placeholder="Exm: 55" min="1" type="number"></div><div class="col-md-3"><span>Estimated Shipping Time</span><input class="form-control" name="shipping_time" placeholder="Exm: 3-4 days" value="<?php echo e(Session::get("shipping_time")); ?>" type="text"></div>');
            
            $(".select2").select2();

        }
        else { $("#shipping-field").html(''); }
    });

    <?php endif; ?>
    //allow seo fields
    $("#checkSeo").change(function() {
        if(this.checked) { $("#seoField").show(); }
        else { $("#seoField").hide(); }
    });


    </script>

    <script type="text/javascript">


    var extraAttribute = 1;
    //add dynamic attribute value fields by attribute
    function extraPredefinedFeature() {

        extraAttribute++;
        var objTo = document.getElementById('extraPredefinedFeature')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", " removeclass" + extraAttribute);
        var rdiv = 'removeclass' + extraAttribute;
        divtest.innerHTML = '<div class="form-group row"><span class="col-4 col-sm-2 text-right col-form-label">Feature name</span> <div class="col-8 col-sm-4"> <input type="text" class="form-control"  name="Features[]" placeholder="Feature name"> </div><span class="col-4 col-sm-2 text-right col-form-label">Feature Value</span> <div class="col-7 col-sm-3"> <input type="text" name="FeatureValue[]" class="form-control"  placeholder="Input value here"> </div> <div class="col-1"><button class="btn btn-danger" type="button" onclick="remove_extraPredefinedFeature(' + extraAttribute + ');"><i class="fa fa-times"></i></button></div></div>';

        objTo.appendChild(divtest)
    }
    //remove dynamic extra field
    function remove_extraPredefinedFeature(rid) {
        $('.removeclass' + rid).remove();
    }


    //Allow checkbox check/uncheck handle
    $("#product_video").change(function() {

        if(this.checked) {
            $("#video_display").show();
            extra_video_fields();
        }
        else {

            $("#extra_video_fields").html('');
            $("#video_display").hide();
        }
    });


    var product_video = 1;
    //add dynamic attribute value fields by attribute
    function extra_video_fields() {

        product_video++;
        var objTo = document.getElementById('extra_video_fields')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", " removeclass" + product_video);
        var rdiv = 'removeclass' + product_video;
        divtest.innerHTML = '<div class="row" style="align-items: center"><div class="col-10"><div class="form-group"><span for="video_provider" class="required">Video Type</span><select required name="video_provider[]" id="video_provider" class="form-control custom-select"><option value="youtube">Youtube</option> <option value="Vimeo">Vimeo</option></select><span class="required">Video link</span><input class="form-control" required name="video_link[]" id="video_link" placeholder="Exm: https://www.youtube.com" value="" type="text"></div></div><div class="col-1"><button class="btn btn-danger" type="button" onclick="remove_extra_video_fields(' + product_video + ');"><i class="fa fa-times"></i></button></div></div>';

        objTo.appendChild(divtest)
    }
    //remove dynamic extra field
    function remove_extra_video_fields(rid) {
        $('.removeclass' + rid).remove();
    }

    </script>

   <script src="<?php echo e(asset('assets')); ?>/node_modules/summernote/dist/summernote-bs4.min.js"></script>
    <script>
    $(function() {

        $('.summernote').summernote({
            height: 200, // set editor height
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
    <script src="<?php echo e(asset('assets')); ?>/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script type="text/javascript">
        // Enter form submit preventDefault for tags
        $(document).on('keyup keypress', 'form input[type="text"]', function(e) {
          if(e.keyCode == 13) {
            e.preventDefault();
            return false;
          }
        });

        $(".select2").select2();
        
        
        $(document).ready(function(){
		$('.itemName').select2({
 placeholder: 'Select an item',
 tags:true,
 debug:true,
 multiple:true,
            ajax: {
                url: '/keyword',
                dataType: 'json',
                delay: 250,
                data: function (data) {
                    return {
                        searchTerm: data.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results:response
                    };
                },
                cache: true
            }
});
	});	
        
        
    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/admin/product/b2b.blade.php ENDPATH**/ ?>