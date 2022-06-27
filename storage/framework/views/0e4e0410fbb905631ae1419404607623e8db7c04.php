
<?php $__env->startSection('title', 'Edit product'); ?>

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
    .dropify_image{ position: absolute;top: -14px!important;left: 12px !important; z-index: 9; background:#fff!important;padding: 3px;}
    .dropify-wrapper{
        height: 100px !important;
    }

    .bootstrap-tagsinput{ width: 100% !important;padding: 5px;}
    .closeBtn{position: absolute;right: 0;bottom: 10px;}
    form label{font-weight: 600;}
    form span{font-size: 12px;}
    #main-wrapper{overflow: visible !important;}
    .shipping-method label{font-size: 13px; font-weight:500; margin-left: 15px; }
    #shipping-field{padding: 0 15px;margin-bottom: 10px; }
    .form-control{padding-left: 5px;  overflow: hidden;}
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
                    <h4 class="text-themecolor">Add New product</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Product</a></li>
                            <li class="breadcrumb-item active">create</li>
                        </ol>
                        <a href="<?php echo e(route('admin.product.list')); ?>" class="btn btn-info btn-sm d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Product List</a>
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

                    <form action="<?php echo e(route('admin.product.update', $product->id)); ?>" data-parsley-validate enctype="multipart/form-data" method="post" id="product">
                        <?php echo csrf_field(); ?>

                        <div class="form-body">
                            <div class="row" style="align-items: flex-start; overflow: visible;">
                                <div class="col-md-9 divrigth_border sticky-conent">

                                    <div class="row">
                                        <div class="col-md-12 title_head">
                                            Product Basic Information
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="title">Product Title</label>
                                                <input type="text" value="<?php echo e($product->title); ?>" name="title" required="" id="title" placeholder = 'Enter title' class="form-control" >
                                                <?php if($errors->has('title')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <?php echo e($errors->first('title')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="category">Select category</label>
                                                <select required=""  onchange="get_subcategory(this.value)" name="category" id="category" class="select2 form-control custom-select">
                                                   <option value="">Select category</option>
                                                   <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                   <option <?php echo e($product->category_id == $category->id ? 'selected' : ''); ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php if($errors->has('category')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <?php echo e($errors->first('category')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="subcategory">Select subcategory</label>
                                                <select onchange="get_subchild_category(this.value)" required name="subcategory" id="subcategory" class="select2 form-control custom-select">
                                                    <option value="">Select Subcategory</option>
                                                    <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if($subcategory->id == $product->subcategory_id): ?> selected <?php endif; ?> value="<?php echo e($subcategory->id); ?>"><?php echo e($subcategory->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                               
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="subchildcategory">Select Child Category</label>
                                                <select onchange="getAttributeByCategory(this.value, 'getAttributesByChildcategory')" name="childcategory"  id="subchildcategory" class="select2 form-control custom-select">
                                                    <option value="">Select Child Category</option>
                                                   <?php $__currentLoopData = $childcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php echo e($product->childcategory_id == $childcategory->id ? 'selected' : ''); ?>  value="<?php echo e($childcategory->id); ?>"><?php echo e($childcategory->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                               
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="purchase_price">Purchase Price</label>
                                                <input type="number" value="<?php echo e($product->purchase_price); ?>" min="0" name="purchase_price" id="purchase_price" placeholder = 'Enter purchase price' class="form-control" >
                                                <?php if($errors->has('purchase_price')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <?php echo e($errors->first('purchase_price')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="selling_price">Selling Price</label>
                                                <input required type="number" value="<?php echo e($product->selling_price); ?>" min="0" name="selling_price" id="selling_price" placeholder = 'Enter selling price' class="form-control" >
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-9">
                                            <div class="form-group">
                                                <label for="discount">Discount</label>
                                                <input type="number" min="0" value="<?php echo e($product->discount); ?>"  name="discount" id="discount" placeholder = 'Enter discount' class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-3" style="padding-left: 0">
                                            <div class="form-group">
                                                <label for="discount_type">Type</label>
                                                <select name="discount_type" class="form-control">
                                                    <option <?php if($product->discount_type == Config::get('siteSetting.currency_symble')): ?> selected <?php endif; ?> value="<?php echo e(Config::get('siteSetting.currency_symble')); ?>"><?php echo e(Config::get('siteSetting.currency_symble')); ?></option>
                                                    <option  <?php if($product->discount_type == '%'): ?> selected <?php endif; ?>  value="%">%</option>
                                                </select>
                                            </div>
                                        </div>

                                       <div class="col-md-12 title_head">
                                            Product Variation & Features
                                        </div>
                                        <div class="col-md-12">
                                          
                                        <?php $__currentLoopData = $product->get_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                            //set attribute name for js variable & function
                                            $attribute_fields = str_replace('', '_', $variation->attribute_name);
                                            ?>
                                            <span id="feature<?php echo e($variation->id); ?>">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="checkbox2">
                                                            <input style="display: none;" checked type="checkbox" id="check<?php echo e($variation->id); ?>" name="featureUpdate[<?php echo e($variation->attribute_id); ?>]" value="<?php echo e($variation->id); ?>">
                                                            <label  for="check<?php echo e($variation->id); ?>">Product <?php echo e($variation->attribute_name); ?> <i onclick="deleteVariation(<?php echo e($variation->id); ?>)" title="Delete this attribute" style="color: red" class="ti-trash"></i> 
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php $i = 1; ?>
                                                <?php $__currentLoopData = $variation->get_variationDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variationDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-md-12" id="product_variation_details<?php echo e($variationDetail->id); ?>">
                                                <div class="row">
                                                    <div class="col-sm-2 nopadding">
                                                        <div class="form-group">
                                                            <?php if($i==1): ?>
                                                            <span class="required">Name</span>
                                                            <?php endif; ?>
                                                            <select class="select2 form-control" name="attributeValueUpdate[<?php echo e($variation->attribute_id); ?>][]">
                                                                <option value="<?php echo e($variationDetail->attributeValue_name); ?>"><?php echo e($variationDetail->attributeValue_name); ?></option>
                                                              
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- check qty weather set or not -->
                                                    <div class="col-sm-2 nopadding">
                                                        <div class="form-group">
                                                            <?php if($i==1): ?><span>SKU</span><?php endif; ?>
                                                            <input type="text" value="<?php echo e($variationDetail->sku); ?>" class="form-control" name="skuUpdate[<?php echo e($variation->attribute_id); ?>][]" placeholder="Enter SKU">
                                                        </div>
                                                    </div> 
                                                    <!-- check qty weather set or not -->
                                                    <div class="col-sm-1 nopadding">
                                                        <div class="form-group">
                                                            <?php if($i==1): ?><span>Quantity</span><?php endif; ?>
                                                            <input type="text" value="<?php echo e($variationDetail->quantity); ?>" class="form-control" name="qtyUpdate[<?php echo e($variation->attribute_id); ?>][]" placeholder="Enter Qty">
                                                        </div>
                                                    </div>
                                                    <!-- check price weather set or not -->
                                                    <div class="col-sm-2 nopadding">
                                                        <div class="form-group">
                                                           <?php if($i==1): ?> <span>Price</span><?php endif; ?>
                                                            <input type="number" value="<?php echo e($variationDetail->price); ?>" class="form-control" name="priceUpdate[<?php echo e($variation->attribute_id); ?>][]" placeholder="Enter price">
                                                        </div>
                                                    </div>
                                                    <?php if($variationDetail->color != null): ?>
                                                    <div class="col-sm-2 nopadding"><div class="form-group">
                                                        <?php if($i==1): ?><span>Select Color</span><?php endif; ?>
                                                        <input onfocus="(this.type='color')" placeholder="Pick Color" class="form-control" value="<?php echo e($variationDetail->color); ?>" name="colorUpdate[<?php echo e($variation->attribute_id); ?>][]"></div>
                                                    </div>
                                                    <?php endif; ?>
                                                    <!-- check image weather set or not -->
                                                    <?php if($variationDetail->image != null): ?>
                                                    <div class="col-sm-2 nopadding">
                                                        <div class="form-group">
                                                            <?php if($i==1): ?><span>Upload Image</span><?php endif; ?>

                                                            <div class="input-group">
                                                                <input type="file" class="form-control" name="imageUpdate[<?php echo e($variation->attribute_id); ?>][]">
                                                                <img width="40" src="<?php echo e(asset('upload/images/product/varriant-product/thumb/'. $variationDetail->image)); ?>" alt="">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                    <div class="col-1"  <?php if($i==1): ?> style="padding-top: 20px;" <?php endif; ?>><button class="btn btn-danger" type="button" onclick="deleteDataCommon('product_variation_details', '<?php echo e($variationDetail->id); ?>')"><i class="fa fa-times"></i></button></div>
                                                </div>
                                                </div>
                                                <?php $i++; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <div id="<?php echo e($attribute_fields); ?>_fields"></div>
                                                <div class="row justify-content-md-center"><div class="col-md-4"> <span style="cursor: pointer;" class="btn btn-info btn-sm" onclick="<?php echo e($attribute_fields); ?>_fields()"><i class="fa fa-plus"></i> Add More</span></div></div> <hr>
                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <div id="productVariationField">
                                             <!-- //get un use attribute variation -->
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

                                                                        <select class="form-control select2" name="attributeValue[<?php echo e($attribute->id); ?>][]">
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

                                                                <!-- check price weather set or not -->
                                                                <?php if($attribute->price): ?>
                                                                <div class="col-sm-<?php echo e($col); ?> nopadding">
                                                                    <div class="form-group">
                                                                        <span>Price</span>
                                                                        <input type="text" class="form-control" name="price[<?php echo e($attribute->id); ?>][]"  placeholder="price">
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
                                            </div>
                                           
                                            <div id="getAttributesByCategory"></div>
                                            <div id="getAttributesBySubcategory"></div>
                                            <div id="getAttributesByChildcategory"></div>
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
                                                    <input <?php if($feature->is_required): ?> required <?php endif; ?> type="text" name="featureValue[<?php echo e($feature->id); ?>]" value="<?php echo e(($feature->featureValue) ? $feature->featureValue->value : null); ?>" class="form-control" placeholder="Input value here">
                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            
                                            <div id="PredefinedFeatureBycategory"></div>
                                            <div id="PredefinedFeatureBySubcategory"></div>
                                            <div id="PredefinedFeatureByChildcategory"></div>

                                            <!-- <div class="form-group row"><span class="col-4 col-sm-2 text-right col-form-label">Feature name</span> <div class="col-8 col-sm-4"> <input type="text" class="form-control"  name="extraFeatureName[]"  placeholder="Feature name"> </div><span class="col-4 col-sm-2 text-right col-form-label">Feature Value</span> <div class="col-7 col-sm-3"> <input type="text" name="extraFeatureValue[]" class="form-control"  placeholder="Input value here"> </div> <div class="col-1"><button class="btn btn-success" type="button" onclick="extraPredefinedFeature();"><i class="fa fa-plus"></i></button></div></div>
                                            <div id="extraPredefinedFeature"></div>
                                            <div class="row justify-content-md-center"><div class="col-md-4"> <span  style="cursor: pointer;" class="btn btn-info btn-sm" onclick="extraPredefinedFeature()"><i class="fa fa-plus"></i> Add More Feature </span></div></div> <hr/> -->
            
                                        </div>
                                        
                                        <div class="col-md-12">
                                        	<div class="form-group">
                                        		<label class="required" >Short Summery</label>
	                                           <textarea style="resize: vertical;" rows="3" name="summery" class="summernote form-control"><?php echo e($product->summery); ?></textarea>
	                                       </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required">Product Description</label>
                                               <textarea required name="description" class="summernote form-control"><?php echo e($product->description); ?></textarea>
                                           </div>
                                        </div>
                                          
                                        <div class="col-md-12">
                                            <div class="row">
                                                <?php if(config('siteSetting.shipping_method') == 'product_wise_shipping'): ?>
                                                <div class="col-md-12 title_head">
                                                    Shipping & Delivery
                                                </div>
                                               
                                                <!-- <div class="col-md-12">
                                                   <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="required" >Product Package</label>
                                                        </div>
                                                        <div class="col-sm-4 nopadding">
                                                           <div class="form-group">
                                                                <span>Package Weight (kg)</span>
                                                                <input type="number" min="1" class="form-control" value="<?php echo e($product->weight); ?>" name="weight"  placeholder="Enter weight">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-12 nopadding">
                                                             <label class="required">Package Dimensions (cm) </label>
                                                        </div>
                                                        <div class="col-md-3 nopadding">
                                                            <div class="form-group">
                                                                <span class="required">Length (cm)</span>
                                                                <input type="number" min="1" class="form-control" value="<?php echo e($product->length); ?>" name="length"  placeholder="Enter Length">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 nopadding">
                                                            <div class="form-group">
                                                                <span class="required">Width (cm)</span>
                                                                <input required type="number" min="1" class="form-control" value="<?php echo e($product->width); ?>" name="width"  placeholder="Enter Width">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 nopadding">
                                                            <div class="form-group">
                                                                <span>Height (cm)</span>
                                                                <input required type="number" min="1" class="form-control" value="<?php echo e($product->height); ?>" name="height"  placeholder="Enter Height">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="checkbox2 shipping-method">
                                                            <label  for="free_shipping">
                                                                <input type="radio" <?php if($product->shipping_method == 'free'): ?> checked <?php endif; ?> name="shipping_method" id="free_shipping" required value="free"> 
                                                            Free Shipping</label>

                                                            <label for="flate_shipping"><input type="radio" <?php if($product->shipping_method == 'flate'): ?> checked <?php endif; ?> name="shipping_method" id="flate_shipping" required value="flate"> 
                                                            Flate Shipping</label>
                                                            <label for="location_shipping">
                                                            <input type="radio" <?php if($product->shipping_method == 'location'): ?> checked <?php endif; ?> name="shipping_method" id="location_shipping" required value="location"> 
                                                            Location-based shipping</label>

                                                           
                                                        </div>
                                                    </div>
                                                    <div class="row" id="shipping-field"></div>
                                                </div>
                                                <?php endif; ?>
                                                <div class="col-md-12">
                                                    
                                                    
                                                    	
												<div class="form-group">
                                                            <span class="required">Product Tags( <span style="font-size: 12px;color: #777;font-weight: initial;">Write tags Separated by Comma[,] <?php echo e($product->keyword); ?></span> )</span>

                                                             <div class="tags-default">
                                                                <select type="text" name="keywords[]" class="itemName" multiple>
																 <?php
																$keytags = explode(', ', $product->keyword);
																?>
																
																<?php $__currentLoopData = $keytags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<option val="<?php echo e($keyword); ?>" selected><?php echo e($keyword); ?></option>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
																
																</select>
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
                                                   <option <?php if($product->product_type == $cartButton->slug): ?> selected <?php endif; ?>  value="<?php echo e($cartButton->slug); ?>"><?php echo e($cartButton->btn_name); ?></option>
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
                                                <input type="text" value="<?php echo e($product->stock); ?>"  name="stock" id="stock" placeholder = 'Example: 100'class="form-control" >
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="stock">SKU</label>
                                                <input type="text" value="<?php echo e($product->sku); ?>"  name="sku" id="sku" placeholder = 'Example: sku-120' class="form-control" >
                                            </div>
                                        </div>

                                        
                                       
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="brand">Brand </label>
                                                <select name="brand" id="brand" style="width:100%" id="brand" class="form-control select2 custom-select">

                                                   <option value="">Select Brand</option>
                                                   <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                   <option <?php if($product->brand_id == $brand->id): ?> selected <?php endif; ?> value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option>
                                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                               </select>
                                           </div>
                                        </div>

                                    	<div class="col-md-12">
                                            <div class="form-group"> 
                                                <label class="dropify_image required">Feature Image</label>
                                                <input type="file" data-default-file="<?php echo e(asset('upload/images/product/thumb/'.$product->feature_image)); ?>" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg svg jpeg png gif"  data-max-file-size="5M"  name="feature_image" id="input-file-events">
                                            </div>
                                            <?php if($errors->has('feature_image')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <?php echo e($errors->first('feature_image')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>

                                    
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="vendor">Vendor </label>
                                                <select name="vendor_id" required id="vendor" style="width:100%" id="vendor" class="select2 form-control custom-select">
                                                   <option value="">Select Vendor</option>
                                                   <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                   <option  <?php if($product->vendor_id == $vendor->id): ?> selected <?php endif; ?>   value="<?php echo e($vendor->id); ?>"><?php echo e($vendor->shop_name); ?></option>
                                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                               </select>
                                           </div>
                                        </div>
                                        

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                
                                                <div class="checkbox2">
                                                  <input  <?php if(count($product->videos)>0): ?> checked <?php endif; ?> name="product_video" type="checkbox" id="product_video" value="1"> 
                                                  <label for="product_video">Add Video</label>
                                                </div>
                                                          
                                            </div>
                                            <?php if(count($product->videos)>0): ?>
                                           
                                            <?php $__currentLoopData = $product->videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="row" id="product_videos<?php echo e($video->id); ?>" style="align-items: center">
                                                <div class="col-10">
                                                    <div class="form-group">
                                                        <span for="video_provider" class="required">Provider</span>
                                                        <select required name="video_provider[]" id="video_provider" class="form-control custom-select">
                                                            <option <?php if($video->provider == 'youtube'): ?> selected <?php endif; ?> value="youtube">Youtube</option> 
                                                            <option <?php if($video->provider == 'vimeo'): ?> selected <?php endif; ?> value="vimeo">Vimeo</option>
                                                        </select>
                                                        <span class="required">Video link</span>
                                                        <input class="form-control" required name="video_link[]" id="video_link" placeholder="Exm: https://www.youtube.com" value="<?php echo e($video->link); ?>" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-1">
                                                    <button class="btn btn-danger" type="button" onclick="deleteDataCommon('product_videos', '<?php echo e($video->id); ?>')"><i class="fa fa-times"></i></button>
                                                </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                             <?php endif; ?>
                                            <div id="video_display"  style="display: <?php echo e((count($product->videos)>0) ? 'block' : 'none'); ?>;">
                                                <div id="extra_video_fields"></div>
                                                <div class="form-group" style="text-align: center;"><span  style="cursor: pointer;" class="btn btn-info btn-sm" onclick="extra_video_fields()"><i class="fa fa-plus"></i> Add More </span>
                                                </div>
                                            </div>
                                           
                                        </div>
                                        <!-- <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="manufacture_date">Manufacture date(Mfd)</label>
                                                <input type="date" value="<?php echo e($product->manufacture_date); ?>" placeholder = 'Enter manufacture date' name="manufacture_date" id="manufacture_date" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="expired_date">Expired date(Exd)</label>
                                                <input type="date" value="<?php echo e($product->expired_date); ?>" placeholder = 'Enter expired date' name="expired_date" id="expired_date" class="form-control" >
                                            </div>
                                        </div> -->
                                       
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                
                                                <label class="switch-box" style="top:-12px;">Status</label>
                                                    <div class="custom-control custom-switch">
                                                      <input name="status" <?php echo e(($product->status == 'active') ? 'checked' : ''); ?> type="checkbox" class="custom-control-input" id="status">
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
    <script>
        
            productType('<?php echo e($product->product_type); ?>');
            function productType(item) {
                if(item == 'add-to-download'){
                    $("#showProductType").html(`<div class="row" style="align-items: center">
                        <div class="col-12"><div class="form-group">
                        <span class="required">Attach File</span>
                        <select class="form-control" onchange="fileType(this.value)">
                        <option value="upload">Local Upload</option>
                        <option value="link">External Link</option>
                        </select>
                        <div id="showfileType"> </div>

                        </div>
                        </div>
                    </div>`);
                }else if(item == 'pre-order'){
                    $("#showProductType").html(`<div class="row" style="align-items: center">
                        <div class="col-12"><div class="form-group">
                        <span class="required">Availability Date</span>
                        <input type="datetime-local" value="<?php echo e(Carbon\Carbon::parse($product->availability_date)->format('Y-m-d\TH:i:s')); ?>" class="form-control" name="availability_date">
                       
                        <span class="required">Pre Order Fee</span>
                        <input name="pre_order_fee" value="<?php echo e($product->pre_order_fee); ?>" required placeholder="Enter price" type="number" class="form-control">
                        </div>
                        </div>
                    </div>`);
                }else{
                    $("#showProductType").html('');
                }
            }
            fileType("<?php echo e($product->file ? 'upload' : 'link'); ?>");
            function fileType(item) {
            if(item == 'upload'){
                $("#showfileType").html(`
                    <span class="required">Attach File</span>
                    <input <?php if(!$product->file): ?> required <?php endif; ?> name="file" type="file" class="form-control">
                    <?php if($product->file): ?><a target="_blank" href="<?php echo e(asset('upload/file/product/'.$product->file)); ?>">View Attach File </a><?php endif; ?>
                `);
            }else{
                $("#showfileType").html('<span class="required">External File link</span><input class="form-control" <?php if(!$product->file_link): ?> required <?php endif; ?> name="file_link" value="<?php echo e($product->file_link); ?>" id="video_link" placeholder="Exm: https://drive.google.com" type="text">');
            }
            }
        
    </script>
    <script type="text/javascript">
        //check required fieled is filled or not
        $('#uploadBtn').on("click", function(){
          let valid = true;
          $('[required]').each(function() {
            if ($(this).is(':invalid') || !$(this).val()) valid = false;
          })
          if (valid){  document.getElementById('pageLoading').style.display = 'block';  };
        })

        function get_subcategory(id=''){
            if(id){
            document.getElementById('pageLoading').style.display ='block';
        
        	//get attribute by category
                getAttributeByCategory(id, 'getAttributesByCategory');
          	//when main category change reset attribute fields
                $('#getAttributesBySubcategory').html(' ');
                $('#getAttributesByChildcategory').html(' ');
                $('#productVariationField').html(' ');

         
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
        }
        }        
        
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
                    }else{
                        $("#"+category).html('');
                    }
                    document.getElementById('pageLoading').style.display ='none';
                }
            });
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

        // delete product feature 
        function deleteVariation(id){
            if(confirm('Are you sure delete.?')) {
                var route = '<?php echo e(route("deleteVariation", ":id")); ?>';
                route = route.replace(":id", id);
                $.ajax({
                    url:route,
                    method:"get",
                    success:function(data){
                        if(data.status){
                            $("#feature"+id).remove();
                            toastr.success(data.msg);
                        }else{
                            toastr.error(data.msg);
                        }
                    }
                });
            }else{
                return false;
            }
        }  
    </script>

    <!-- //add extra attribute value -->
    <?php $__currentLoopData = $product->get_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($variation->get_attribute): ?>
        <?php
            //column divited by attribute field
            if($variation->get_attribute->qty && $variation->get_attribute->price && $variation->get_attribute->color && $variation->get_attribute->image){
                $col = 2;
            }else{
                $col = 2;
            }

            //set attribute name for js variable & function
            $attribute_fields = str_replace('', '_', $variation->get_attribute->name);
        ?>

        <script type="text/javascript">


        var <?php echo e($attribute_fields); ?> = 1;
        //add dynamic attribute value fields by attribute
        function <?php echo e($attribute_fields); ?>_fields() {

            <?php echo e($attribute_fields); ?>++;
            var objTo = document.getElementById('<?php echo e($attribute_fields); ?>_fields')
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "form-group removeclass" + <?php echo e($attribute_fields); ?>);
            var rdiv = 'removeclass' + <?php echo e($attribute_fields); ?>;
            divtest.innerHTML = '<div class="row" style="margin:0"> <div class="col-sm-2 nopadding"> <div class="form-group"> <select required class="select2 form-control" name="attributeValueUpdate[<?php echo e($variation->get_attribute->id); ?>][]"> <?php if(count($variation->get_attribute->get_attrValues)>0): ?> <option value="">Select <?php echo e($attribute_fields); ?></option> <?php $__currentLoopData = $variation->get_attribute->get_attrValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option value="<?php echo e($value->name); ?>"><?php echo e($value->name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php else: ?> <option value="">Value Not Found</option> <?php endif; ?> </select> </div> </div> <div class="col-sm-2 nopadding"><div class="form-group"><input type="text" class="form-control" name="skuUpdate[<?php echo e($variation->get_attribute->id); ?>][]" placeholder="SKU"> </div></div>  <?php if($variation->get_attribute->qty): ?>  <div class="col-sm-1 nopadding"> <div class="form-group"><input type="text" class="form-control"  name="qtyUpdate[<?php echo e($variation->get_attribute->id); ?>][]"  placeholder="Qty"></div></div><?php endif; ?>  <?php if($variation->get_attribute->price): ?>  <div class="col-sm-<?php echo e($col); ?> nopadding"><div class="form-group"><input type="number" class="form-control" name="priceUpdate[<?php echo e($variation->get_attribute->id); ?>][]"  placeholder="price"></div></div><?php endif; ?> <?php if($variation->get_attribute->color): ?><div class="col-sm-<?php echo e($col); ?> nopadding"><div class="form-group"><input onfocus="(this.type=\'color\')" placeholder="Pick Color" class="form-control" name="colorUpdate[<?php echo e($variation->get_attribute->id); ?>][]"  ></div></div><?php endif; ?> <?php if($variation->get_attribute->image): ?> <div class="col-sm-<?php echo e($col); ?> nopadding"><div class="form-group"><div class="input-group"><input type="file" class="form-control" name="imageUpdate[<?php echo e($variation->get_attribute->id); ?>][]"></div></div></div><?php endif; ?><div class="col-1"><button class="btn btn-danger" type="button" onclick="remove_<?php echo e($attribute_fields); ?>_fields(' + <?php echo e($attribute_fields); ?> + ');"><i class="fa fa-times"></i></button></div></div>';

            objTo.appendChild(divtest);
            $(".select2").select2();
        }
        //remove dynamic extra field
        function remove_<?php echo e($attribute_fields); ?>_fields(rid) {
            $('.removeclass' + rid).remove();
        }

        //Allow checkbox check/uncheck handle
        $("#check"+<?php echo e($variation->get_attribute->id); ?>).change(function() {
            if(this.checked) {
                $("#attribute"+<?php echo e($variation->get_attribute->id); ?>).show();
            }else
            {
                $("#attribute"+<?php echo e($variation->get_attribute->id); ?>).hide();

            }
        });

        </script>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 

    <script>
    $(document).ready(function() {
        //select current shipping method field
        $("#"+"<?php echo e($product->shipping_method); ?>"+"_shipping").change();
        // Basic
        $('.dropify').dropify();
    });

 
    <?php if(config('siteSetting.shipping_method') == 'product_wise_shipping'): ?>
  
    $("#free_shipping").change(function() {
        if(this.checked) { $("#shipping-field").html('<div class="col-md-3"><span>Estimated Shipping Time</span><input class="form-control" name="shipping_time" value="<?php echo e($product->shipping_time); ?>" placeholder="Exm: 3-4 days" type="text"></div>'); }
        else { $("#shipping-field").html(''); }
       
    });

    $("#flate_shipping").change(function() {
        if(this.checked) { $("#shipping-field").html('<div class="col-md-3"><span class="required">Shipping Cost</span><input class="form-control" name="shipping_cost" value="<?php echo e($product->shipping_cost); ?>" placeholder="Exm: 50" min="1" type="number"></div><div class="col-md-3"><span>Estimated Shipping Time</span><input class="form-control" name="shipping_time" value="<?php echo e($product->shipping_time); ?>" placeholder="Exm: 3-4 days" type="text"></div>'); }
        else { $("#shipping-field").html(''); }
    });     
  
    $("#location_shipping").change(function() {
        if(this.checked) { $("#shipping-field").html('<div class="col-md-3"><span class="required">Select Specific Region</span><select required name="ship_region_id" id="ship_region_id" class="select2 form-control custom-select"> <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option <?php echo e(($product->ship_region_id == $region->id) ? "selected" : null); ?> value="<?php echo e($region->id); ?>"><?php echo e($region->name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select></div><div class="col-md-2"><span class="required">Shipping Cost</span><input class="form-control" name="shipping_cost" value="<?php echo e($product->shipping_cost); ?>" placeholder="Exm: 50" min="1" type="number"></div></div><div class="col-md-3"><span>Others region shipping cost</span><input class="form-control" name="other_region_cost" value="<?php echo e($product->other_region_cost); ?>" placeholder="Exm: 55" min="1" type="number"></div><div class="col-md-3"><span>Estimated Shipping Time</span><input class="form-control" name="shipping_time" value="<?php echo e($product->shipping_time); ?>" placeholder="Exm: 3-4 days" type="text"></div>'); }
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
        divtest.innerHTML = '<div class="form-group row"><span class="col-4 col-sm-2 text-right col-form-label">Feature name</span> <div class="col-8 col-sm-4"> <input type="text" class="form-control"  name="FeatureName[]"  placeholder="Feature name"> </div><span class="col-4 col-sm-2 text-right col-form-label">Feature Value</span> <div class="col-7 col-sm-3"> <input type="text" name="FeatureValue[]" class="form-control"  placeholder="Input value here"> </div> <div class="col-1"><button class="btn btn-danger" type="button" onclick="remove_extraPredefinedFeature(' + extraAttribute + ');"><i class="fa fa-times"></i></button></div></div>';

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
        divtest.setAttribute("class", "removeclass" + product_video);
        var rdiv = 'removeclass' + product_video;
        divtest.innerHTML = '<div class="row" style="align-items: center"><div class="col-10"><div class="form-group"><span for="video_provider" class="required">Video Type</span><select required name="video_provider[]" id="video_provider" class="form-control custom-select"><option value="youtube">Youtube</option> <option value="vimeo">Vimeo</option></select><span class="required">Video link</span><input class="form-control" required name="video_link[]" id="video_link" placeholder="Exm: https://www.youtube.com" value="" type="text"></div></div><div class="col-1"><button class="btn btn-danger" type="button" onclick="remove_extra_video_fields(' + product_video + ');"><i class="fa fa-times"></i></button></div></div>';

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
    </script>

 <!--     //get un use attribute variation -->
    <script type="text/javascript">
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
            divtest.innerHTML = '<div class="row"> <div class="col-sm-2 nopadding"> <div class="form-group"> <select class="select2 form-control" name="attributeValue[<?php echo e($attribute->id); ?>][]"> <?php if($attribute->get_attrValues): ?> <?php if(count($attribute->get_attrValues)>0): ?> <option value=""><?php echo e($attribute_fields); ?></option> <?php $__currentLoopData = $attribute->get_attrValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option value="<?php echo e($value->name); ?>"><?php echo e($value->name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php else: ?> <option value="">Value Not Found</option> <?php endif; ?> <?php endif; ?> </select> </div> </div> <div class="col-sm-<?php echo e($col); ?> nopadding"><div class="form-group"><input type="text" class="form-control" name="sku[<?php echo e($attribute->id); ?>][]"  placeholder="SKU"></div></div> <?php if($attribute->qty): ?>  <div class="col-sm-1 nopadding"> <div class="form-group"><input type="text" class="form-control"  name="qty[<?php echo e($attribute->id); ?>][]"  placeholder="Qty"></div></div><?php endif; ?>  <?php if($attribute->price): ?>  <div class="col-sm-<?php echo e($col); ?> nopadding"><div class="form-group"><input type="number" class="form-control" name="price[<?php echo e($attribute->id); ?>][]"  placeholder="price"></div></div><?php endif; ?> <?php if($attribute->color): ?><div class="col-sm-<?php echo e($col); ?> nopadding"><div class="form-group"><input onfocus="(this.type=\'color\')" placeholder="Pick Color" class="form-control" name="color[<?php echo e($attribute->id); ?>][]"  ></div></div><?php endif; ?> <?php if($attribute->image): ?> <div class="col-sm-<?php echo e($col); ?> nopadding"><div class="form-group"><div class="input-group"><input type="file" class="form-control" name="image[<?php echo e($attribute->id); ?>][]"></div></div></div><?php endif; ?><div class="col-1"><button class="btn btn-danger" type="button" onclick="remove_<?php echo e($attribute_fields); ?>_fields(' + <?php echo e($attribute_fields); ?> + ');"><i class="fa fa-times"></i></button></div></div>';

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
            }
            else
            {
                $("#attribute"+<?php echo e($attribute->id); ?>).hide();

            }
        });
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


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


<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/admin/product/product-edit.blade.php ENDPATH**/ ?>