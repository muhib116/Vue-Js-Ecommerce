
<?php $__env->startSection('title', Request::get('q')); ?>
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
                <?php if(Request::get('cat')): ?>
                <li><a href="<?php echo e(route('home.category', Request::get('cat') )); ?>"><?php echo e(Request::get('cat')); ?></a></li>
                <?php endif; ?>
                <li>Search Results: <?php echo e(Request::get('q')); ?></li>
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
                                 
                                    <?php if($filterCategories): ?>
                                        <?php $__currentLoopData = $filterCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filterCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php
                                        $category = $subcategory = $childcategory = '';
                                        if($filterCategory->parent_id == null && $filterCategory->subcategory_id == null){
                                            $category = $filterCategory->slug;

                                        }
                                        if($filterCategory->parent_id != null && $filterCategory->subcategory_id == null){
                                            $category = $filterCategory->get_category->slug;
                                            $subcategory = $filterCategory->slug;

                                        }

                                        if($filterCategory->parent_id != null && $filterCategory->subcategory_id != null){
                                            
                                            if(isset($filterCategory->get_singleSubcategory->get_category->slug)){
                                            $category = $filterCategory->get_singleSubcategory->get_category->slug;
                                           
                                            $subcategory = $filterCategory->get_singleSubcategory->slug;
                                            
                                            $childcategory = $filterCategory->slug;
                                            }
                                        }

                                        ?>
                                        <li class="panel">
                                            <a href="<?php echo e(route('home.category', [$category, $subcategory, $childcategory])); ?>"><?php echo e($filterCategory->name); ?></a>
                                            
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
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

                        <li class="so-filter-options" data-option="Brand">
                            <div class="so-filter-heading">
                              <div class="so-filter-heading-text">
                                <span>Avg. Ratting</span>
                              </div>
                              
                            </div>
                            <div class="so-filter-content-opts" style="display: block;padding-left: 10px;">
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

                        <li class="so-filter-options" data-option="Brand">
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

                        <?php $__currentLoopData = $specifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!-- check weather value set or not -->
                        <?php if(count($specification->get_attrValues)>0): ?>
                        <li class="so-filter-options" data-option="<?php echo e($specification->name); ?>">
                            <div class="so-filter-heading">
                              <div class="so-filter-heading-text">
                                <span><?php echo e($specification->name); ?></span>
                              </div>
                              <i class="fa fa-chevron-down"></i>
                            </div>
                            <div class="so-filter-content-opts" style="display: block;padding-left: 10px;">
                              <ul>
                                <?php $__currentLoopData = $specification->get_attrValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attrValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <input <?php if(in_array($attrValue->id , explode(',', Request::get(strtolower($specification->name)))) ): ?> checked <?php endif; ?> value="<?php echo e($attrValue->id); ?>" class=" <?php echo e($specification->name); ?> common_selector" id="attr<?php echo e($attrValue->id); ?>" type="checkbox" />
                                    <label style="margin: 0px;" for="attr<?php echo e($attrValue->id); ?>" ><?php echo e($attrValue->name); ?></label> 
                                        
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </li>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
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
        
        var concatUrl = '';
        var category = "<?php echo (Request::get('cat')) ? 'cat='.Request::get('cat') : ''; ?>";

        var searchKey = $("#searchKey").val();
        if(searchKey != '' ){
            concatUrl += '&q='+searchKey;
        }

        <?php $__currentLoopData = $specifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            var filterValue = get_filter('<?php echo e($specification->name); ?>');
            if(filterValue != ''){
                concatUrl += '&<?php echo e(strtolower($specification->name)); ?>='+filterValue;
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

        var sortby = $("#sortby :selected").val();
        if(typeof sortby != 'undefined' && sortby != ''){
            concatUrl += '&sortby='+sortby;
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
     
        var  link = '<?php echo e(route("product.search")); ?>?'+category+concatUrl;
            history.pushState({id: 'category'}, category, link);

        var perPage = null;
        var showItem = $("#perPage :selected").val();
        if(typeof showItem != 'undefined'){
           perPage = showItem;
           
        }
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
        //call function
        filter_data();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/frontend/products/search_products.blade.php ENDPATH**/ ?>