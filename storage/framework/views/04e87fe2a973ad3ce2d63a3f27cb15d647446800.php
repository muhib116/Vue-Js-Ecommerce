
<?php $__env->startSection('title', 'General Setting'); ?>
<?php $__env->startSection('css-top'); ?>
  <link href="<?php echo e(asset('assets')); ?>/node_modules/jquery-asColorPicker-master/dist/css/asColorPicker.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<link href="<?php echo e(asset('css')); ?>/pages/tab-page.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    #generalSetting input, #generalSetting textarea{color: #797878!important}
    .asColorPicker_open{z-index: 9999999;border:1px solid #ccc;}

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
                
                <div class="col-md-12 align-self-center ">
                    <div class="d-fl ">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">General</a></li>
                            <li class="breadcrumb-item active">Setting</li>
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
            <div class="row">
               
                <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="title_head">  General Setting </div>
                                <h6 class="card-subtitle">Set the basic configuration settings for your site.</h6>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"> <a class="nav-link  active" data-toggle="tab" href="#generalSetting" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">General Setting</span></a> </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <div class="tab-pane active" id="generalSetting" role="tabpanel">
                                        <div class="p-20">
                                            <form action="<?php echo e(route('generalSettingUpdate', $setting->id)); ?>"  method="post" data-parsley-validate id="generalSetting">
                                                <?php echo csrf_field(); ?>
                                                <div class="form-body">
                                                    
                                                    <div class="">
                                                            <div class="form-group row">
                                                                <label class="col-md-2 text-right col-form-label required" for="site_name">Site Name</label>
                                                                <div class="col-md-3">
                                                                    <input type="text" value="<?php echo e($setting->site_name); ?>" placeholder="Enter site name" name="site_name" required="" id="site_name" class="form-control" >
                                                                </div>

                                                                <label class="col-md-2 text-right col-form-label" for="site_owner">Site Owner Name</label>
                                                                <div class="col-md-3">
                                                                    <input type="text" value="<?php echo e($setting->site_owner); ?>" placeholder="Enter site owner" name="site_owner" id="site_owner" class="form-control" >
                                                                </div>
                                                            </div>
                                                       
                                                            <div class="form-group row">
                                                                <label class="col-md-2 text-right col-form-label required" for="phone">Phone</label>
                                                                 <div class="col-md-3">
                                                                    <input type="text" value="<?php echo e($setting->phone); ?>" placeholder="Enter phone number" name="phone" required="" id="phone" class="form-control" >
                                                                </div>
                                                            
                                                                <label class="col-md-2 text-right col-form-label required" for="email">Email</label>
                                                                 <div class="col-md-3">
                                                                    <input type="text" value="<?php echo e($setting->email); ?>" placeholder="Enter email number" name="email" required="" id="email" class="form-control" >
                                                                </div>
                                                            </div>
                                                           
                                                            <div class="form-group row">
                                                                
                                                                <label class="col-md-2 text-right col-form-label" for="currency">Currency</label>
                                                                <div class="col-md-3">
                                                                    <input type="text" value="<?php echo e($setting->currency); ?>" placeholder="Enter currency" name="currency" required="" id="currency" class="form-control" >
                                                                </div>
                                                                <label class="col-md-2 text-right col-form-label" for="currency_symble">Currency Symble</label>
                                                                 <div class="col-md-3">
                                                                    <input type="text" value="<?php echo e($setting->currency_symble); ?>" placeholder="Enter Symble" name="currency_symble" required="" id="currency_symble" class="form-control" >
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                            
                                                            
                                                            <div class="form-group row">
                                                                
                                                                <label class="col-md-2 text-right col-form-label" for="fbpixel">Pixel ID</label>
                                                                <div class="col-md-3">
                                                                    <input type="text" value="<?php echo e($setting->fbpixel); ?>" placeholder="Enter FB Pixel Data" name="fbpixel" required="" id="fbpixel" class="form-control" >
                                                                </div>
                                                                <label class="col-md-2 text-right col-form-label" for="fbpixel">COD Pre Pay  In %</label>
                                                                 <div class="col-md-3">
                                                                    <input type="number" step="0.01" value="<?php echo e($setting->cod); ?>" placeholder="Enter COD Pre Payment Percentage" name="cod" required="" id="cod" class="form-control" >
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                            
                                                            <div class="form-group row">
                                                                <label class="col-md-2 text-right col-form-label required" for="date_format ">Date Format</label>
                                                                <div class="col-md-2">
                                                                    <select class="form-control custom-select" name="date_format" id="date_format" required="required">
                                                                        <option value="<?php echo e($setting->date_format); ?>"><?php echo e(Carbon\Carbon::parse(now())->format($setting->date_format)); ?></option>
                                                                        <option value="Y-m-d"><?php echo e(Carbon\Carbon::parse(now())->format('Y-m-d')); ?></option>
                                                                        <option value="d-m-Y"><?php echo e(Carbon\Carbon::parse(now())->format('d-m-Y')); ?></option>
                                                                        <option value="d/m/Y"><?php echo e(Carbon\Carbon::parse(now())->format('d/m/Y')); ?> </option>
                                                                        <option value="m/d/Y"><?php echo e(Carbon\Carbon::parse(now())->format('m/d/Y')); ?> </option>
                                                                        <option value="m.d.Y"><?php echo e(Carbon\Carbon::parse(now())->format('m.d.Y')); ?> </option>
                                                                        <option value="j, n, Y"><?php echo e(Carbon\Carbon::parse(now())->format('j, n, Y')); ?> </option>
                                                                        <option value="F j, Y"><?php echo e(Carbon\Carbon::parse(now())->format('F j, Y')); ?> </option>
                                                                        <option value="M j, Y"><?php echo e(Carbon\Carbon::parse(now())->format('M j, Y')); ?></option>
                                                                        <option value="j M, Y"><?php echo e(Carbon\Carbon::parse(now())->format('j M, Y')); ?></option>
                                                                    </select>
                                                                </div>
                                                                <label class="col-md-1 text-right col-form-label" for="bg_color">BG color</label>
                                                                <div class="col-md-2">
                                                                    <input name="bg_color" value="<?php echo e(($setting->bg_color) ? $setting->bg_color : '#fff'); ?>" type="text" value="#fff" class="gradient-colorpicker form-control ">
                                                                </div>

                                                                <label class="col-md-1 text-right col-form-label" for="text_color">Text color</label>
                                                                <div class="col-md-2">
                                                                    <input name="text_color" value="<?php echo e($setting->text_color); ?>" class="gradient-colorpicker form-control" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-md-2 text-right col-form-label" style="background: #fff;top:-10px;z-index: 1" for="about">About</label>
                                                                <div class="col-md-8">
                                                                    <textarea rows="2" placeholder="Write about" name="about" class=" form-control" id="about" ><?php echo e($setting->about); ?></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                            <label class="col-md-2 text-right col-form-label" style="background: #fff;top:-10px;z-index: 1" for="address">Office Address</label>
                                                            <div class="col-md-8">
                                                                <textarea  rows="2" placeholder="Exm. House, Road, Uttara, Dhaka, Bangladesh" name="address" class=" form-control" id="address" ><?php echo e($setting->address); ?></textarea>
                                                            </div>
                                                        </div>
                                                            
                                                    </div><hr>
                                                    <div class="form-actions pull-right">
                                                        <button type="submit" name="updateTab" value="generalSetting" class="btn btn-success"> <i class="fa fa-save"></i> Update General Setting</button>
                                                       
                                                        <button type="reset" class="btn waves-effect waves-light btn-secondary">Reset</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>


    <!-- Color Picker Plugin JavaScript -->
    <script src="<?php echo e(asset('assets')); ?>/node_modules/jquery-asColor/dist/jquery-asColor.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    
    <script>
  
   
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });
   

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/admin/setting/general-setting.blade.php ENDPATH**/ ?>