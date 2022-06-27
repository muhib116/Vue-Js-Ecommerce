@if($totalshop>0)
@foreach($shop as $vendor)

<div class="product-layout col-lg-2 col-md-2 col-sm-4 col-xs-6">
		
<div class="product-item-container">

<div class="left-block">
<div class="product-image-container">
<a href="{{ route('shop_details', $vendor->vendor->slug) }}" >

<img alt="{{ $vendor->vendor->shop_name }}" src="{{asset('upload/vendors/logo/'.($vendor->vendor->logo ? $vendor->vendor->logo : 'logo.png'))}}" height="120" width="120" class="img-1 img-responsive">
</a>
</div>
</div>
<div class="right-block">
<div class="caption">

<h3><a href="{{ route('shop_details', $vendor->vendor->slug) }}">{{Str::limit($vendor->vendor->shop_name, 40)}}</a></h3>


  Stock:{{$vendor->stock}}<br>
   <div style="display: inline-block;width: 100%;text-align: center;background: #ff5722;color: #fff;border-radius: 3px;cursor:pointer">
   
  <span style="display:block" onclick="addcart('{{$vendor->id}}')" data-toggle="tooltip" title="Add to cart" data-original-title="add to cart"> <i class="fa fa-shopping-cart"></i> Select Shop</span>
  </div>
   
   
   
	 
 

</div>
</div>
</div>
</div>



<script type="text/javascript">

     function addcart(id){
          
          $.ajax({
            url:'{{route("cart.add")}}',
            type:'get',
		  data: {offer_enlist: {{$vendor->id}}, enlist_id: {{$vendor->enlist_id}}, product_id: {{$vendor->enlists->product_id}}@if(!empty($offer)), offer: "{{$offer->slug}}"@endif},
            success:function(data){
                if(data.status == 'success'){
                    var url = window.location.origin;
                    addProductNotice(data.msg, '<img src="'+url+'/upload/images/product/thumb/'+data.image+'" alt="">', '<h3>'+data.title+'</h3>', 'success');
       
                    
                    $('.cartCount').html(Number($('.cartCount').html())+1);
                   
                }else{
                    toastr.error(data.msg);
                }
              }
          });
      }
</script>
@endforeach
@else
	
 <div class="product-layout col-lg-2 col-md-2 col-sm-4 col-xs-6">
		
   <div class="product-item-container">

<div class="left-block">
<div class="product-image-container">

<img src="{{asset('upload/vendors/logo/logo.png')}}" height="120" width="120" class="img-1 img-responsive">
</div>
</div>
<div class="right-block">
<div class="caption">

<h3>No Shop Found</h3>


 <br>
   <div style="display: inline-block;width: 100%;text-align: center;background: red;color: #fff;border-radius: 3px;cursor:pointer">
   
  <span style="display:block" data-toggle="tooltip" title="Add to cart" data-original-title="add to cart">  Out Of Stock</span>
  </div>
  

</div>
</div>
</div>
		</div>
  

@endif


