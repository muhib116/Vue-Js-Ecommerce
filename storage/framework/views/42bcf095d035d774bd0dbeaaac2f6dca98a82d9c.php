
<?php $__env->startSection('title', 'Register | '.Config::get('siteSetting.site_name')); ?>
<?php  

    $reCaptcha = App\Models\SiteSetting::where('type', 'google_recaptcha')->first(); 

    $socailLogins = App\Models\SiteSetting::where('type', 'facebook_login')->orWhere('type', 'google_login')->orWhere('type', 'twitter_login')->get(); 
   
?>
<?php $__env->startSection('css-top'); ?>
    <style type="text/css">
        @media (min-width: 1200px){
            .container {
                max-width: 1200px !important;
            }
        }
        .dropdown-toggle::after, .dropup .dropdown-toggle::after {
            content: initial !important;
        }
        .card-footer, .card-header {
            margin-bottom: 5px;
            border-bottom: 1px solid #ececec;
        }
        .error{color:red;}
    </style>
    <?php if($reCaptcha->status == 1): ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section>
    <div class="container">
        
        <div class="row justify-content-center" style="padding-top: 20px; ">
            <div class="col-md-6 col-12 hidden-xs hidden-sm" >
                <img src="<?php echo e(asset('upload/users/register-bg.png')); ?>">
            </div>
            <div class="col-md-6 col-12" style="background: rgb(239 239 239);padding: 5px 10px; padding: 5px 10px;">
                <div class="card">

                       <div class="card-body">

                            <form id="loginform" data-parsley-validate action="<?php echo e(route('userRegister')); ?>" method="post" >
                                <?php echo csrf_field(); ?>
                                <div class="card-header text-center"><h3>Sign Up</h3></div>
                                <?php if(Session::has('status')): ?>
                                <div class="alert alert-success">
                                  <strong>Success! </strong> <?php echo e(Session::get('status')); ?>

                                </div>
                                <?php endif; ?>
                                <?php if(Session::has('error')): ?>
                                <div class="alert alert-danger">
                                  <?php echo e(Session::get('error')); ?>

                                </div>
                                <?php endif; ?>
                                <div class="form-group">
                                  <label class="control-label required" for="name">Full Name</label>
                                  <input type="text" required name="name" value="<?php echo e(old('name')); ?>" placeholder="Enter Name" data-parsley-required-message = "Name is required" id="input-email" class="form-control">
                                  <?php if($errors->has('name')): ?>
                                        <span class="error" role="alert">
                                            <?php echo e($errors->first('name')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                  <label class="control-label required" for="mobile">Mobile Number</label>
                                  <input type="text" required name="mobile" value="<?php echo e(old('mobile')); ?>" pattern="/(01)\d{9}/" minlength="11" placeholder="Enter Mobile Number" id="mobile" data-parsley-required-message = "Mobile number is required" class="form-control">
                                  <?php if($errors->has('mobile')): ?>
                                        <span class="error" role="alert">
                                            <?php echo e($errors->first('mobile')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>

                                <!-- <div class="form-group">
                                  <label class="control-label" for="email">Email Address (optional)</label>
                                  <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-zA-Z]{2,4}"  name="email" value="<?php echo e(old('email')); ?>" placeholder="Enter Email Address" id="email" class="form-control">
                                  <?php if($errors->has('email')): ?>
                                        <span class="error" role="alert">
                                            <?php echo e($errors->first('email')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div> -->
                                <div class="form-group">
                                    <label class="control-label required" for="password">Password</label>
                                    <input type="password" name="password" placeholder="Password" required id="password" data-parsley-required-message = "Password is required" minlength="6" class="form-control">
                                    <?php if($errors->has('password')): ?>
                                        <span class="error" role="alert">
                                           <?php echo e($errors->first('password')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>

                                <?php if($reCaptcha->status == 1): ?>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="g-recaptcha" data-sitekey="<?php echo e($reCaptcha->public_key); ?>"></div>
                                            <span id="recaptcha-error" style="color: red"></span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div style=" display: flex!important;" class="d-flex no-block align-items-center">
                                            <div style="display: inline-flex;" class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="Remember"> 
                                                <label style="margin: 0 5px;" class="custom-control-label" for="Remember"> Remember me</label>
                                            </div> 
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                               
                                    <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Sign Up</button>
                                </div> 
                                </div>
                                <?php if(count($socailLogins)>0): ?>
                                <div id="column-login" style="margin:15px 0" class="col-sm-8 pull-right">
                                    <div class="row">
                                        <div class="social_login pull-right" >

                                        <?php $__currentLoopData = $socailLogins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socailLogin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($socailLogin->type == 'facebook_login' && $socailLogin->status): ?>
                                            <a href="<?php echo e(route('social.login', 'facebook')); ?>" class="btn btn-info btn-sm btn-facebook"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></a>
                                            <?php endif; ?>
                                            <?php if($socailLogin->type == 'google_login' && $socailLogin->status == 1): ?>
                                            <a style="background: red" href="<?php echo e(route('social.login', 'google')); ?>" class="btn btn-social-icon btn-sm btn-google-plus"><i class="fa fa-google fa-fw" aria-hidden="true"></i></a>
                                            <?php endif; ?>
                                            <?php if($socailLogin->type == 'twitter_login' && $socailLogin->status == 1): ?>
                                            <a href="<?php echo e(route('social.login', 'twitter')); ?>" class="btn btn-social-icon btn-sm btn-twitter"><i class="fa fa-twitter fa-fw" aria-hidden="true"></i></a>
                                            <?php endif; ?>
                                            <?php if($socailLogin->type == 'linkedin_login' && $socailLogin->status == 1): ?>
                                            <a href="<?php echo e(route('social.login', 'linkedin')); ?>" class="btn btn-social-icon btn-sm btn-linkdin"><i class="fa fa-linkedin fa-fw" aria-hidden="true"></i></a>
                                            <?php endif; ?>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?> 
                            </form>
                        </div>
                </div>
                
                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                        Already have an account?  <a href="<?php echo e(route('login')); ?>" class="text-info m-l-5"><b>Sign In</b></a>
                    </div>
                </div>  
                <div class="col-md-3 col-12"></div>     
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
    <?php if($reCaptcha->status == 1): ?>
        $("#loginform").submit(function(event) {

           var recaptcha = $("#g-recaptcha-response").val();
           if (recaptcha === "") {
              event.preventDefault();
              $("#recaptcha-error").html("Recaptcha is required");
           }
        });
    <?php endif; ?>
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/auth/register.blade.php ENDPATH**/ ?>