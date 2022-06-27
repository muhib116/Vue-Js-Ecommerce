@extends('layouts.admin-master')
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

                    <form action="{{route("admin.approvenow", $product->id)}}" data-parsley-validate enctype="multipart/form-data" method="post" id="product">
                        @csrf

                        <div class="form-body">
                            <div class="row" style="align-items: flex-start; overflow: visible;">
                                <div class="col-md-12 divrigth_border">
                                    <div class="row">
                                       
                                      
                                      

                                    
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
                                                <label for="stock">Minimum Selling Price</label>
                                                <input type="number" step="0.01" value="{{old('min_price')}}"  name="min_price" id="min_price" placeholder = "Minimum Price" class="form-control" >
                                            </div>
                                        </div>
										
										
										
										<div class="col-md-12">
                                            <div class="form-group">
                                                <label for="stock">Maximum Selling Price</label>
                                                <input type="number" step="0.01" value="{{old('max_price')}}"  name="max_price" id="max_price" placeholder = "Maximum Price" class="form-control" >
                                            </div>
                                        </div>
                                       
 <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="stock">Selling Price</label>
                                                <input type="number" step="0.01" value="{{old('selling_price')}}"  name="selling_price" id="selling_price" placeholder = "Enter Selling Price " value="{{$product->selling_price}}" class="form-control" >
                                            </div>
                                        </div>
  
                                    	

                                    
                                        
 
                                       


                                      

                                    </div>
                                </div>
                            </div>

                        </div><hr>
                        <div class="form-actions pull-right" style="float: right;">
                            <button type="submit" id="uploadBtn" name="submit" value="save" class="btn btn-success"> <i class="fa fa-save"></i> Approved Products </button>

                            <button type="reset" class="btn waves-effect waves-light btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
           
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->

@endsection


