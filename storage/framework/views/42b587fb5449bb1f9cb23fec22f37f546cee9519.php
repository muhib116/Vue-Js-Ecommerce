
<?php $__env->startSection('title', $category->name . ' | Category' ); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/jquery.range.css')); ?>">
    <style type="text/css">
        .ratting label{font-size: 18px;}
        .slider-container{margin-top: 12px;}
        .pagination>li>a, .pagination>li>span{padding: 6px 10px;}
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Main Container  -->
    <div class="breadcrumbs">
        <div class="container">
            <ul class="breadcrumb-cate">
                <li><a href="<?php echo e(url('/')); ?>"><i class="fa fa-home"></i> </a></li>
                <?php if(Request::route('catslug')): ?>
                <li><a href="<?php echo e(route('home.category', Request::route('catslug') )); ?>"><?php echo e(Request::route('catslug')); ?></a></li>
                <?php endif; ?>
                <?php if(Request::route('subslug')): ?>
                <li><a href="<?php echo e(route('home.category', [Request::route('catslug'), Request::route('subslug')] )); ?>"><?php echo e(Request::route('subslug')); ?></a></li>
                <?php endif; ?>
                <?php if(Request::route('childslug')): ?>
                <li><?php echo e(Request::route('childslug')); ?></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    
    <div class="container product-detail">
        <div class="row">
            <aside class="col-md-3 col-sm-4 col-xs-12 content-aside left_column sidebar-offcanvas sticky-content">
                <span id="close-sidebar" class="fa fa-times"></span>
                <div class="module so_filter_wrap filter-horizontal">
                    <h3 class="modtitle"><span>Filter By</span> 
                        <a data-toggle="tooltip"  data-original-title="Clear all filter" title="" style="float: right;text-transform: none;padding: 0px 5px; font-size: 12px;color: red" id="resetAll">
                            Clear All <i class="fa fa-times"></i>
                        </a>
                    </h3>
                    <div class="modcontent">
                        <ul>
						
						
						
						
						 <li class="so-filter-options" data-option="Brand">
                                <div class="so-filter-heading">
                                    <div class="so-filter-heading-text">
                                      <input class="common_selector b2b" value="1" id="b2b" type="checkbox" />  <span>B2B Products Only</span>
                                    </div>
                                  
                                </div>
                               
                            </li>
						
						
						
						
						
						
                            <li class="so-filter-options" data-option="Size">
                                <div class="so-filter-heading">
                                    <div class="so-filter-heading-text">
                                        <span>Related Categories</span>
                                    </div>
                                    <i class="fa fa-chevron-down"></i>
                                </div>
                                <div class="so-filter-content-opts" style="display: block;">
                                    <div class="mod-content box-category">
                                        <ul class="accordion" id="accordion-category">
                                            <li class="panel">
                                                <?php if($category): ?><a href="#"><?php echo e($category->name); ?></a><?php endif; ?>
                                                <div style="clear:both">
                                                    <ul>
                                                      <?php $__currentLoopData = $filterCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filterCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php 
                                                        $parent_category = $subcategory = $childcategory = '';
                                                        if(Request::route('catslug')){
                                                            $parent_category = Request::route('catslug');
                                                            $subcategory = $filterCategory->slug;
                                                        }
                                                        if(Request::route('subslug')){
                                                            $parent_category = Request::route('catslug');
                                                            $subcategory = Request::route('subslug');
                                                            $childcategory = $filterCategory->slug;
                                                        }
                                                          ?>
                                                         <li>
                                                            <a href="<?php echo e(route('home.category', [$parent_category, $subcategory, $childcategory])); ?>"> <?php echo e($filterCategory->name); ?></a>
                                                        </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <?php if(count($brands)>0): ?>
                            <li class="so-filter-options" data-option="Brand">
                                <div class="so-filter-heading">
                                    <div class="so-filter-heading-text">
                                        <span>Brand</span>
                                    </div>
                                    <i class="fa fa-chevron-down"></i>
                                </div>
                                <div class="so-filter-content-opts" style="display: block;padding-left: 10px;">
                                  <ul>
                                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <input <?php if(in_array($brand->id , explode(',', Request::get('brand')))): ?> checked <?php endif; ?> class="common_selector brand" value="<?php echo e($brand->id); ?>" id="brand<?php echo e($brand->id); ?>" type="checkbox" />
                                        <label style="margin: 0px;" for="brand<?php echo e($brand->id); ?>" ><?php echo e($brand->name); ?></label> 
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </li>
                            <?php endif; ?>

                            <li class="so-filter-options" data-option="Ratting">
                                <div class="so-filter-heading">
                                  <div class="so-filter-heading-text">
                                    <span>Avg. Ratting</span>
                                  </div>
                                  
                                </div>
                                <div class="so-filter-content-opts" style="display: block;padding-left: 20px;">
                                    <ul class="ratting">
                                        <?php for($r=5; $r>=1; $r--): ?>
                                        <li>
                                            <input style="display: none;" <?php if(Request::get('ratting') == $r): ?> checked <?php endif; ?> class="common_selector ratting" type="radio" name="ratting" id="ratting<?php echo e($r); ?>" value="<?php echo e($r); ?>">
                                            <label for="ratting<?php echo e($r); ?>">
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                           
                                            <span class="fa fa-stack"><i class="fa fa-star<?php echo e(($r<=1) ? '-o' : ''); ?> fa-stack-2x"></i></span>
                                            <span class="fa fa-stack"><i class="fa fa-star<?php echo e(($r<=2) ? '-o' : ''); ?> fa-stack-2x"></i></span>
                                            <span class="fa fa-stack"><i class="fa fa-star<?php echo e(($r<=3) ? '-o' : ''); ?> fa-stack-2x"></i></span>
                                            <span class="fa fa-stack"><i class="fa fa-star<?php echo e(($r<=4) ? '-o' : ''); ?> fa-stack-2x"></i></span>

                                            </label>
                                        </li>
                                        <?php endfor; ?>
                                    </ul>
                                </div>
                            </li>

                            <?php $__currentLoopData = $product_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <!-- check weather value set or not -->
                            <?php if(count($product_variation->allVariationValues)>0): ?>
                            <li class="so-filter-options" data-option="<?php echo e($product_variation->attribute_name); ?>">
                                <div class="so-filter-heading">
                                  <div class="so-filter-heading-text">
                                    <span><?php echo e($product_variation->attribute_name); ?></span>
                                  </div>
                                  <i class="fa fa-chevron-down"></i>
                                </div>
                                <div class="so-filter-content-opts" style="display: block;padding-left: 20px;">
                                  <ul>
                                    <?php $__currentLoopData = $product_variation->allVariationValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variationValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <input <?php if(in_array(strtolower($variationValue->attributeValue_name) , explode(',', Request::get(strtolower($product_variation->attribute_name)))) ): ?> checked <?php endif; ?> value="<?php echo e(strtolower($variationValue->attributeValue_name)); ?>" class=" <?php echo e(str_replace(' ', '', $product_variation->attribute_name)); ?> common_selector" id="attr<?php echo e($variationValue->id); ?>" type="checkbox" />
                                        <label style="margin: 0px;" for="attr<?php echo e($variationValue->id); ?>" ><?php echo e($variationValue->attributeValue_name); ?></label>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </li>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <li class="so-filter-options" data-option="Price">
                                <div class="so-filter-heading">
                                  <div class="so-filter-heading-text">
                                    <span>Price</span>
                                  </div>
                                </div>
                                <div class="so-filter-content-opts" style="display: block;padding-left: 10px;">
                                  <ul>
                                    <li>
                                        <input  type="hidden" id="price-range"  class="price-range-slider tertiary" value="<?php if(Request::get('price')): ?> <?php echo e(Request::get('price')); ?> <?php else: ?> 999999 <?php endif; ?>" form="shop_search_form"><br/>
                                        <button id="+'&price='+price" class="btn btn-info btn-sm common_selector">Update your Search</button>
                                    </li>
                                    
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <div class="clear_filter" style="text-align: right;padding: 5px">
                            <button type="reset" id="resetAll" class="btn btn-danger inverse">
                                 Reset All
                            </button>
                        </div>
                    </div>
                </div>
            </aside>
            <div id="content" class="col-md-9 col-sm-12 col-xs-12 sticky-content" >
                <div id="dataLoading"></div>

                <a href="javascript:void(0)" class="open-sidebar hidden-lg hidden-md"><i class="fa fa-bars"></i>Filter By</a>
                <?php if($banners): ?>
                   <?php echo $__env->make('frontend.sliders.slider2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
                <div id="filter_product" class="products-category">   
                    <?php echo $__env->make('frontend.products.filter_products', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
 <script type="text/javascript" src="<?php echo e(asset('frontend')); ?>/js/themejs/noui.js"></script>

<script src="<?php echo e(asset('frontend/js/jquery.range.min.js')); ?>"></script>

<script type="text/javascript">
    (function($) {
        /*-----------
            RANGE
        -----------*/
        $('.price-range-slider').jRange({
            from: 0,
            to: 999999,
            step: 1,
            format: '<?php echo e(Config::get('siteSetting.currency_symble')); ?>%s',
            width: 250,
            showLabels: true,
            showScale: false,
            isRange : true,
            theme: "theme-edragon"
        });
    })(jQuery);
    
    function filter_data(page)
    {
        //enable loader
        document.getElementById('dataLoading').style.display ='block';
        
        var category = "<?php echo str_replace(' ', '', Request::route('catslug')); ?>" ;
        var subcategory = "<?php echo (Request::route('subslug')) ? '/'. str_replace(' ', '', Request::route('subslug')) : ''; ?>";
        var childcategory = "<?php echo (Request::route('childslug')) ? '/'. str_replace(' ', '', Request::route('childslug')) : ''; ?>";

        var concatUrl = '?';
        
        var searchKey = $("#searchKey").val();
        if(searchKey != '' ){
            concatUrl += 'q='+searchKey;
        }
        <?php $__currentLoopData = $product_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            var filterValue = get_filter('<?php echo e(str_replace(' ', '', $product_variation->attribute_name)); ?>');
            if(filterValue != ''){
                concatUrl += '&<?php echo e(strtolower(str_replace(' ', '', $product_variation->attribute_name))); ?>='+filterValue;
            }
            
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       
        var brand = get_filter('brand');
        if(brand != '' ){
            concatUrl += '&brand='+brand;
        }      


var b2b = get_filter('b2b');
        if(b2b != '' ){
            concatUrl += '&b2b='+b2b;
        }    

		
        var ratting = get_filter('ratting');
        if(ratting != '' ){
            concatUrl += '&ratting='+ratting;
        }

        var price = document.getElementById('price-range').value;
        if(price != '' ){
            concatUrl += '&price='+price;
        }

        var perPage = null;
        var showItem = $("#perPage :selected").val();
        if(typeof showItem != 'undefined' || showItem != null){
           perPage = showItem;
           //check weather page null or set 
            if(page == null){
                //var active = $('.active .page-link').html();
                var page = 1;
            }
        }

        var sortby = $("#sortby :selected").val();
        if(typeof sortby != 'undefined' && sortby != ''){
            concatUrl += '&sortby='+sortby;
            //check weather page null or set 
            if(page == null){
                //var active = $('.active .page-link').html();
                var page = 1;
            }
        }

        if(page != null){concatUrl += '&page='+page;}
     
        var  link = '<?php echo URL::to("category");?>/'+category+subcategory+childcategory+concatUrl;
            history.pushState({id: 'category'}, category +' '+subcategory, link);

        $.ajax({
            url:link,
            method:"get",
            data:{
                filter:'filter',perPage:showItem
            },
            success:function(data){
                document.getElementById('dataLoading').style.display ='none';
        
                if(data){
                    $('#filter_product').html(data);
               }else{
                    $('#filter_product').html('Not Found');
               }
            },
            error: function() {
                document.getElementById('dataLoading').style.display ='none';
                $('#filter_product').html('<span class="ajaxError">Internal server error.!</span>');
            }

        });
    }

    function get_filter(class_name)
    {

        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
       
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    function sortproduct(){
        filter_data();
    }
    function showPerPage(){
        filter_data();
    }

    function searchItem(value){
        if(value != ''){ filter_data(); }
    }

    $(document).on('click', '.pagination a', function(e){
        e.preventDefault();

        var page = $(this).attr('href').split('page=')[1];

        filter_data(page);
    });

    $('#resetAll').click(function(){
        $('input:checkbox').removeAttr('checked');
        $('input[type=checkbox]').prop('checked', false);
        $("#searchKey").val('');
        $('input:radio').removeAttr('checked');
         $("#price-range").val('0,999999');
        //call function
        filter_data();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/frontend/products/category.blade.php ENDPATH**/ ?>