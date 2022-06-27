@if(count($offer_products)>0)
<div class="products-list grid row ">
                            @if($offer->offer_type == 'kanamachi')
                            @include('frontend.offer.kanamachi-product')
                            @else
                            @include('frontend.offer.products')
                            @endif
                        </div>
@else
<div style="text-align: center;">
    <h3>Search Result Not Found.</h3>
    <p>We're sorry. We cannot find any matches for your search term</p>
    <i style="font-size: 10rem;" class="fa fa-search"></i>
</div>
@endif