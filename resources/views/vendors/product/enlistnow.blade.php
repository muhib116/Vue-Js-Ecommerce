@extends('vendors.partials.vendor-master')
@section('title', 'Enlist Product')

@section('css-top')
    <link href="{{asset('assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('css')
<link href="{{asset('assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('assets')}}/node_modules/summernote/dist/summernote-bs4.css" rel="stylesheet" type="text/css" />
<link href="{{asset('assets')}}/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
<style type="text/css">
    @media screen and (min-width: 640px) {
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
@endsection

@section('content')

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
                    <h4 class="text-themecolor">Enlist Product</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Product</a></li>
                                <li class="breadcrumb-item active">Enlist</li>
                            </ol>
                        
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

                    <form action="{{route('vendor.enlist.store', $pid)}}" data-parsley-validate enctype="multipart/form-data" method="post" id="product">
                        @csrf

                        <div class="form-body">
                            <div class="row" style="align-items: flex-start; overflow: visible;">
                                <div class="col-md-12 divrigth_border">
                                    <div class="row">
                                       
                                      
                                      

                                        <div class="col-md-12 title_head">
                                            Product Variation & Features
                                        </div>
                                        @foreach($attributes as $attribute)

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
                                                    <input type="checkbox" id="check{{$attribute->id}}" name="attribute[{{$attribute->id}}]" value="{{$attribute->name}}">
                                                    <label for="check{{$attribute->id}}">Allow Product {{$attribute->name}}</label>
                                                </div>
                                            </div>
                                            <!--Value fields show & hide by allow checkbox -->
                                            <div id="attribute{{$attribute->id}}" style="display: none;">

                                                <div class="row">
                                                    <div class="col-sm-2 nopadding">
                                                        <div class="form-group">
                                                            <span class="required">{{$attribute->name}} Name</span>

                                                            <select class="form-control" name="attributeValue[{{$attribute->id}}][]">
                                                                @if($attribute->get_attrValues)
                                                                    @if(count($attribute->get_attrValues)>0)
                                                                        <option value="">Select {{$attribute_fields}}</option>
                                                                        @foreach($attribute->get_attrValues as $value)
                                                                            <option value="{{$value->name}}">{{$value->name}}</option>
                                                                        @endforeach
                                                                    @else
                                                                        <option value="">Value Not Found</option>
                                                                    @endif
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-{{$col}} nopadding">
                                                        <div class="form-group">
                                                            <span>SKU</span>
                                                            <input type="text" class="form-control" name="sku[{{$attribute->id}}][]"  placeholder="SKU">
                                                        </div>
                                                    </div>
                                                    <!-- check qty weather set or not -->
                                                    @if($attribute->qty)
                                                    <div class="col-sm-1 nopadding">
                                                        <div class="form-group">
                                                            <span>Quantity</span>
                                                            <input type="text" class="form-control"  name="qty[{{$attribute->id}}][]"  placeholder="Qty">
                                                        </div>
                                                    </div>
                                                    @endif

                                                    <!-- check price weather set or not -->
                                                    @if($attribute->price)
                                                    <div class="col-sm-{{$col}} nopadding">
                                                        <div class="form-group">
                                                            <span>Price</span>
                                                            <input type="text" class="form-control" name="price[{{$attribute->id}}][]"  placeholder="price">
                                                        </div>
                                                    </div>
                                                    @endif

                                                    @if($attribute->color)<div class="col-sm-{{$col}} nopadding"><div class="form-group"><span>Select Color</span><input onfocus="(this.type='color')" placeholder="Pick Color" class="form-control"  name="color[{{$attribute->id}}][]" ></div></div>@endif

                                                    <!-- check image weather set or not -->
                                                    @if($attribute->image)
                                                    <div class="col-sm-{{$col}} nopadding">
                                                        <div class="form-group">
                                                            <span>Upload Image</span>

                                                            <div class="input-group">
                                                                <input type="file" class="form-control" name="image[{{$attribute->id}}][]">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="col-1 nopadding" style="padding-top: 20px">
                                                        <button class="btn btn-success" type="button" onclick="{{$attribute_fields}}_fields();"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div id="{{$attribute_fields}}_fields"></div>
                                                <div class="row justify-content-md-center"><div class="col-md-4"> <span  style="cursor: pointer;" class="btn btn-info btn-sm" onclick="{{$attribute_fields}}_fields()"><i class="fa fa-plus"></i> Add More {{$attribute->name}}</span></div></div> <hr/>
                                            </div>

                                        </div>

                                        @endforeach
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
                                                @foreach($features as $feature)
                                                <div style="margin-bottom:10px;" class="col-4 @if($feature->is_required) required @endif col-sm-2 text-right col-form-label">{{$feature->name}}
                                                <input type="hidden" value="{{$feature->name}}" class="form-control" name="features[{{$feature->id}}]"></div>
                                                <div class="col-8 col-sm-4">
                                                    <input @if($feature->is_required) required @endif type="text" name="featureValue[{{$feature->id}}]" value="" class="form-control" placeholder="Input value here">
                                                </div>
                                                @endforeach
                                            </div>

                                            <div id="PredefinedFeatureBycategory"></div>
                                            <div id="PredefinedFeatureBySubcategory"></div>
                                            <div id="PredefinedFeatureByChildcategory"></div>
                                           <!--  <div class="form-group row"><span class="col-4 col-sm-2 text-right col-form-label">Feature name</span> <div class="col-8 col-sm-4"> <input type="text" class="form-control"  name="extraFeatureName[]"  placeholder="Feature name"> </div><span class="col-4 col-sm-2 text-right col-form-label">Feature Value</span> <div class="col-7 col-sm-3"> <input type="text" name="extraFeatureValue[]" class="form-control"  placeholder="Input value here"> </div> <div class="col-1"><button class="btn btn-success" type="button" onclick="extraPredefinedFeature();"><i class="fa fa-plus"></i></button></div></div>
                                            <div id="extraPredefinedFeature"></div>
                                            <div class="row justify-content-md-center"><div class="col-md-4"> <span  style="cursor: pointer;" class="btn btn-info btn-sm" onclick="extraPredefinedFeature()"><i class="fa fa-plus"></i> Add More Feature </span></div></div> <hr/> -->

                                        </div>

                                      
                                                    
                                                  
                                                   
                                                </div>
                                            </div>
                                   
                                    
                                 <div class="col-md-12 title_head">
                                            Pricing & Stocks
                                        </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        
                                        <div class="col-md-12">
                                            <div id="showProductType"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="stock">Product Stock</label>
                                                <input type="text" value="{{old('stock')}}"  name="stock" id="stock" placeholder = 'Example: 100' class="form-control" >
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="stock">SKU</label>
                                                <input type="text" value="{{old('sku')}}"  name="sku" id="sku" placeholder = 'Example: sku-120' class="form-control" >
                                            </div>
                                        </div>

                                       
                                       
 <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="stock">Selling Price</label>
                                                <input type="number" step="0.01" min="{{$product->min_price}}" max="{{$product->max_price}}" value="{{old('selling_price')}}"  name="selling_price" id="selling_price" placeholder = "Enter Selling Price . Min {{$product->min_price}} To {{$product->max_price}}" class="form-control" >
                                            </div>
                                        </div>
  
                                    	

                                    
                                     
 
                                        </div>
                                       
                                         <!-- <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="manufacture_date">Manufacture date(Mfd)</label>
                                                <input type="date" value="{{old('manufacture_date')}}" placeholder = 'Enter manufacture date' name="manufacture_date" id="manufacture_date" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="expired_date">Expired date(Exd)</label>
                                                <input type="date" value="{{old('expired_date')}}" placeholder = 'Enter expired date' name="expired_date" id="expired_date" class="form-control" >
                                            </div>
                                        </div> -->


                                      

                                    </div>
                                </div>
                            </div>

                        </div><hr>
                        <div class="form-actions pull-right" style="float: right;">
                            <button type="submit" id="uploadBtn" name="submit" value="save" class="btn btn-success"> <i class="fa fa-save"></i> Enlist Products </button>

                            <button type="reset" class="btn waves-effect waves-light btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->

@endsection

@section('js')
    <script src="{{asset('assets')}}/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
  
    <script type="text/javascript">
      

       
       

      
        // get Attribute by Category
        function getAttributeByCategory(id, category){
            if(id){
            //enable loader
            document.getElementById('pageLoading').style.display ='block';

            //get product feature by child category
            if(category == 'getAttributesByChildcategory'){
                getFeature(id, 'PredefinedFeatureByChildcategory');
            }

            var  url = '{{route("getAttributeByCategory", ":id")}}';
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

            var  url = '{{route("getFeature", ":id")}}';
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
        @foreach($attributes as $attribute)

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
        var {{$attribute_fields}} = 1;
        //add dynamic attribute value fields by attribute
        function {{$attribute_fields}}_fields() {

            {{$attribute_fields}}++;
            var objTo = document.getElementById('{{$attribute_fields}}_fields')
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "removeclass" + {{$attribute_fields}});
            var rdiv = 'removeclass' + {{$attribute_fields}};
            divtest.innerHTML = '<div class="row"> <div class="col-sm-2 nopadding"> <div class="form-group"> <select required class="select2 form-control" name="attributeValue[{{$attribute->id}}][]"> @if($attribute->get_attrValues) @if(count($attribute->get_attrValues)>0) <option value="">{{$attribute_fields}}</option> @foreach($attribute->get_attrValues as $value) <option value="{{$value->name}}">{{$value->name}}</option> @endforeach @else <option value="">Value Not Found</option> @endif @endif </select> </div> </div> <div class="col-sm-{{$col}} nopadding"><div class="form-group"><input type="text" class="form-control" name="sku[{{$attribute->id}}][]"  placeholder="SKU"></div></div> @if($attribute->qty)  <div class="col-sm-1 nopadding"> <div class="form-group"><input type="text" class="form-control"  name="qty[{{$attribute->id}}][]"  placeholder="Qty"></div></div>@endif  @if($attribute->price)  <div class="col-sm-{{$col}} nopadding"><div class="form-group"><input type="number" class="form-control" name="price[{{$attribute->id}}][]"  placeholder="price"></div></div>@endif @if($attribute->color)<div class="col-sm-{{$col}} nopadding"><div class="form-group"><input onfocus="(this.type=\'color\')" placeholder="Pick Color" class="form-control" name="color[{{$attribute->id}}][]"  ></div></div>@endif @if($attribute->image) <div class="col-sm-{{$col}} nopadding"><div class="form-group"><div class="input-group"><input type="file" class="form-control" name="image[{{$attribute->id}}][]"></div></div></div>@endif<div class="col-1"><button class="btn btn-danger" type="button" onclick="remove_{{$attribute_fields}}_fields(' + {{$attribute_fields}} + ');"><i class="fa fa-times"></i></button></div></div>';

            objTo.appendChild(divtest)
        }
        //remove dynamic extra field
        function remove_{{$attribute_fields}}_fields(rid) {
            $('.removeclass' + rid).remove();
        }

        //Allow checkbox check/uncheck handle
        $("#check"+{{$attribute->id}}).change(function() {
            if(this.checked) {
                $("#attribute"+{{$attribute->id}}).show();
                
            } else {
                $("#attribute"+{{$attribute->id}}).hide();
            }
        });
        @endforeach
        
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


   

    </script>

 
  

@endsection

