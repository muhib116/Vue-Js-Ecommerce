<script src="<?php echo e(mix('frontend/js/app.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('frontend/js/owl-carousel/owl.carousel.js')); ?>"></script>
<script type="text/javascript">
    $(document).ready(function ($) {
			    "use strict";
			    // Content slider
			   $('.yt-content-slider').each(function () {
        var $slider = $(this),
            $panels = $slider.children('div'),
            data = $slider.data();
        // Remove unwanted br's
        //$slider.children(':not(.yt-content-slide)').remove();
        // Apply Owl Carousel
        
        $slider.owlCarousel2({
            responsiveClass: true,
            mouseDrag: true,
            video:true,
        lazyLoad: (data.lazyload == 'yes') ? true : false,
            autoplay: (data.autoplay == 'yes') ? true : false,
            autoHeight: (data.autoheight == 'yes') ? true : false,
            autoplayTimeout: data.delay * 1000,
            smartSpeed: data.speed * 1000,
            autoplayHoverPause: (data.hoverpause == 'yes') ? true : false,
            center: (data.center == 'yes') ? true : false,
            loop: (data.loop == 'yes') ? true : false,
      dots: (data.pagination == 'yes') ? true : false,
      nav: (data.arrows == 'yes') ? true : false,
            dotClass: "owl2-dot",
            dotsClass: "owl2-dots",
      margin: data.margin,
        navText:  ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
            responsive: {
                0: {
                    items: data.items_column4 
                    },
                480: {
                    items: data.items_column3
                    },
                768: {
                    items: data.items_column2
                    },
                992: { 
                    items: data.items_column1
                    },
                1200: {
                    items: data.items_column0 
                    }
            }
        });
    });
    <?php if(\Route::current()->getName() == 'offer.prizeWinner'): ?> 
        $(document).ready(function(){ setTimeout(function() { $("#prizeLoading").fadeOut(); }, 7000); });
    <?php elseif(\Route::current()->getName() == 'offer.buyOffer'): ?>
        $(document).ready(function(){ setTimeout(function() { $("#typeheadsection").fadeOut(); },1000); }); 
    <?php else: ?> 
        $(document).ready(function(){ setTimeout(function() { $("#typeheadsection").fadeOut(); }, 1000); });
    <?php endif; ?>
    $(document).ready(function(){ setTimeout(function() { $("#typeheadsection").fadeOut(); }, 1000); });
        $(document).ready(function(){
        $(".topbar-close").click(function(){
            $(".coupon-code").slideToggle();
        });
        $(".button").on('click',function(){
                if($('.button').hasClass('active')){
                    $('.button').removeClass('active');
                }else{
                    $('.button').removeClass('active');
                    $('.button').addClass('active');
                }
         });
    });

    // Resonsive Sidebar aside
    $(document).ready(function(){
        $(".open-sidebar").click(function(e){
            e.preventDefault();
            $(".sidebar-overlay").toggleClass("show");
            $(".sidebar-offcanvas").toggleClass("active");
        });

        $(".open-usersidebar").click(function(e){
            e.preventDefault();
            $(".usersidebar").toggleClass("show");
            $(".usersidebar").toggleClass("active");
        });
        
        $(".sidebar-overlay").click(function(e){
            e.preventDefault();
            $(".sidebar-overlay").toggleClass("show");
            $(".sidebar-offcanvas").toggleClass("active");
        });
        $('.close-sidebar').click(function() {
            $('.sidebar-overlay').removeClass('show');
            $('.sidebar-offcanvas').removeClass('active');
            
        }); 
    });
    //mobile menu
    var navItems = document.querySelectorAll(".bottom-nav-item");
    navItems.forEach(function(e, i) {
      e.addEventListener("click", function(e) {
        navItems.forEach(function(e2, i2) {
          e2.classList.remove("active");
        });
        this.classList.add("active");
      });
    });
}); 
</script>
<?php echo $__env->yieldContent('js'); ?>

<?php echo Toastr::message(); ?>

<script>
    $(document).ready(function(){
    <?php if($errors->any()): ?>

    <?php if(Session::get('submitType')): ?>
        // if occur error open model
        $("#<?php echo e(Session::get('submitType')); ?>").modal('show');
    <?php endif; ?>

    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    toastr.error("<?php echo e($error); ?>");
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
});
</script>
<!--     <script>
    
    Echo.channel('postBroadcast')
    .listen('PostCreated', (e) => {
        toastr.info(e.post['title']);
    });
</script> -->
<script type="text/javascript">


$("document").ready(function($){
    var nav = $('#navbar_top');

    $(window).scroll(function () {
        if ($(this).scrollTop() > 500) {
            nav.addClass("fixed-top");
        } else {
            nav.removeClass("fixed-top");
        }
    });
});



    //get cart item in header
    function getCart(){
        var url =  window.location.origin+"/cart/view/header";
        $.ajax({
            method:'get',
            url:url,
            success:function(data){
                if(data){
                    $('#getCartHead').html(data);
                }else{
                    toastr.error('Your cart is empty.');
                }
            }
        });
    } 
</script>
<!-- quickview product -->
<script type="text/javascript">
    function quickview(id, type=''){
        $('#quickviewModal').modal('show');
        $('#quickviewProduct').html('<div class="loadingData-sm"></div>');
        var url =  "<?php echo e(route('quickview', ':id')); ?>";
        url = url.replace(':id',id)+'?type='+type;
        setTimeout(function() {
       $('#quickviewProduct').html('<iframe frameborder="0" width="100%" height="100%" src="'+url+'"></iframe>');
       }, 5000);
        // $.ajax({
        //     method:'get',
        //     url:url,
        //     success:function(data){
        //         if(data){
        //             $('#quickviewProduct').html(data);
        //         }else{
        //             $('#quickviewProduct').html('');
        //         }
        //     }
        // });
    } 
    $(document).on('hide.bs.modal','#quickviewModal', function () {
        $('#quickviewProduct').html('');
        $('.zoomContainer').html('');
        $(".zoomContainer").css("display", "none");
    });
</script>
<script>
    $(document).ready(function() {
        var bloodhound = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: '<?php echo e(route("search_keyword")); ?>?q=%QUERY%',
                wildcard: '%QUERY%'
            },
        });
        
        $('#searchKey').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'products',
            source: bloodhound,
            display: function(data) {
                return data.title  //Input value to be set when you select a suggestion. 
            },
            templates: {
                empty: [
                    '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                ],
                header: [
                    '<div class="list-group search-results-dropdown">'
                ],
                suggestion: function(data) {
                   if ("product" in data){
                         return '<a href="<?php echo e(url("product")); ?>/' + data.slug + '" style="font-weight:normal;white-space: nowrap; overflow: hidden;text-overflow: ellipsis; color:#007bff" class="list-group-item"><img alt="" width="50" src="<?php echo e(asset("upload/images/product/thumb")); ?>/' + data.image + '"> ' + data.product + '</div></a>';
                    }else if("category" in data){
                        return '<a href="<?php echo e(url("category")); ?>/' + data.slug + '" style="font-weight:normal;white-space: nowrap; overflow: hidden;text-overflow: ellipsis; color:#007bff" class="list-group-item"><img alt="" width="40" src="<?php echo e(asset("upload/images/category/thumb")); ?>/' + data.image + '"> ' + data.category + '</div></a>';
                    }else if("shop_name" in data){
                        return '<a href="<?php echo e(url("shop")); ?>/' + data.slug + '" style="font-weight:normal;white-space: nowrap; overflow: hidden;text-overflow: ellipsis; color:#007bff" class="list-group-item"><img alt="" width="40" src="<?php echo e(asset("upload/vendors/logo")); ?>/' + data.image + '"> ' + data.shop_name + '</div></a>';
                    }
                    else{
                        return false;
                    }
               
                }
            }
        });
    });
    $('#loginBtn').on("click", function() {
        $("#loginForm").fadeIn('fast');
        $("#registerForm").css("display","none");
        $("#recoverform").css("display","none");
    });   
    $('#recoverBtn').on("click", function() {
        $("#recoverform").fadeIn('fast');
        $("#loginForm").css("display","none");
       
    });   
    $('#registerBtn').on("click", function() {
        $("#loginForm").css("display","none");
        $("#registerForm").fadeIn('fast');
        
    });  
    $('#resetBtn').click('on', function(){
        var reseField = $('#reseField').val();
        if(reseField){
            $('#resetBtn').html('Sending...');
        }
    });
    
    
    
    
     function addToCart(product_id, offer=''){
        var url = window.location.origin;
        $.ajax({
            method:'get',
            url:url +'/cart/add',
            data:{
                product_id:product_id,offer:offer,
            },
            success:function(data){
                if(data.status == 'success'){
                  $('.cartCount').html(Number($('.cartCount').html())+1);
                  $('.cart_open').click();
                }else if(data.status == 'outlet_choose'){
                   getOutlet(data.status);
                }else if(data.status == 'dif_outlet'){
                  $('#removeCartItems').modal('show');
                  $('#removePreItems').html(data.cartItem);
                }else{
                  toastr.error(data.msg);
                }
            }
        });
    }  

    function getOutlet(product_id) {
        $('#outletModal').modal('show');
        $.ajax({
            method:'get',
            url: window.location.origin+"/shop",
            data:{
                outlets:'all',product_id:product_id,
            },
            success:function(data){
                if(data){
                   $('#showOutlet').html(data);
                }else{
                  $('#showOutlet').html('Outlet not found.');
                }
            }
        });
    }

    $('.cart_open').on('click', function(){
        var url =  window.location.origin+"/cart/view/header";
       
        $(".cart_body").html("<div style='height:135px' class='loadingData-sm'></div>");
        $.ajax({
            method:'get',
            url:url,
            success:function(data){
                if(data){
                    $('.cart_body').html(data);
                }else{
                  $('.cart_body').html(data);
                }
            } 
        });
       
        $('.cart_area').addClass('cart_menu__expanded'); 
        $('#main-nav').addClass('cart_menu__expanded');
    });

    $('.cart_menu__close').on('click', function(event){
        $('.cart_area').removeClass('cart_menu__expanded');
        $('#main-nav').removeClass('cart_menu__expanded');
    });
    function cartItemsUpdate(id,type){
       
        var qty = $('#cartQty'+id).val();
        
        if (type == 'minus') {
          qty--;
        } else {
          qty++;
        }
      
        if(parseInt(qty) && qty>0){
            $.ajax({
                url: window.location.origin+"/cart/items/update",
                method:"get",
                data:{ id:id,qty:qty,reqType:'qtyUpdate'},
                success:function(data){
                    console.log(data);
                    if(data.status){
                      qty = $('#cartQty'+id).val(qty);
                      $('#price'+id).html(data.price);
                      $('#total_amount').html(data.grand_total_amount);
                    }else{
                      toastr.error(data.msg);
                    }
                },
                error: function(jqXHR, exception) {
                    toastr.error('Internal server error.');                
                }
            });
        }
    }  

    // delete cart item
    function cartItemsDelete(id, page) {

        var link = window.location.origin+"/cart/item/remove/:id"
        link = link.replace(':id', id);
      
        $.ajax({
            url:link,
            method:"get",
            data:{page:page},
            success:function(data){
                if(data.status){
                  $('#carItem'+id).remove();
                  $('#total_amount').html(data.grand_total_amount);
                }else{
                    $('.cart_body').html(data);
                }
            }

        });
    }
</script>

<script type="text/javascript">
    $(document).on('click','.offerType_box a, .charity-fund a, .bottom-nav a, .navbar-logo a img, .vertical-wrapper a, a.offer_box, .product-item-container a, .buyNowBtn, .products-category a, .offer_section a', function () {
        $("#pageloaderOpend").css("display","block").fadeIn(3000);
         setTimeout(function () {
           $("#pageloaderOpend").css("display","none");
        }, 5000);
    });
  
  $(document).ready(function() {  
  // Gets the video src from the data-src on each button   
  $('.video-btn').click(function() {
    var videoType = $(this).data( "type" ); 
    var videoSrc = $(this).data( "src" );
    $("#video_pop").css("display","block")
    if(videoType == 'video'){
        $('#showVideoFrame').html('<video id="myVideo" width="100%" controls autoplay><source id="video" src="'+ videoSrc+'" type="video/mp4"></video>');
    }
    if(videoType == 'youtube'){
        $('#showVideoFrame').html( '<iframe width="100%" height="100%" src="'+ videoSrc+'?autoplay=1&rel=0'+'"  frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'); 
    }
  });

  $('.modal .close').click(function(){
  modal.style.display = "none";
  $('#showVideoFrame').html('');
  });

  var modal = document.getElementById('video_pop');
  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
  if (event.target == modal) {
  modal.style.display = "none";
  $('#showVideoFrame').html('');
  }
  }
  // stop playing the video when I close the modal
  $('#video_pop').on('hidden.bs.modal', function (e) {
  $('#showVideoFrame').html('');
  });
  }); 
  </script><?php /**PATH C:\xampp\htdocs\mv\resources\views/layouts/partials/frontend/scripts.blade.php ENDPATH**/ ?>