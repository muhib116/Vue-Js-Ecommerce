<div class="modal fade in" id="so_sociallogin">
<div class="modal-dialog block-popup-login">
<a href="javascript:void(0)" title="Close" class="close close-login fa fa-times-circle" data-dismiss="modal"></a>
<div class="col-reg registered-account">
<div class="block-content" style="padding:10px;">
<form class="form form-login" action="<?php echo e(route('userLogin')); ?>" method="post" id="loginForm">
<?php echo csrf_field(); ?>
<div class="card-header text-center"><h3>Login</h3></div>
<fieldset class="fieldset login" data-hasrequired="* Required Fields">
<div class="field email email-input">
<div class="control">
<input name="emailOrMobile" value="<?php if(Cookie::has('emailOrMobile')): ?><?php echo e(Cookie::get('emailOrMobile')); ?><?php else: ?><?php echo e(old('emailOrMobile')); ?><?php endif; ?>" autocomplete="off" id="email" type="text" required class="input-text" title="Enter Email or Mobile Number" placeholder="Enter Email or Mobile Number">
</div>
</div>
<div class="field password pass-input">
<div class="control">
<input value="<?php if(Cookie::has('password')): ?><?php echo e(Cookie::get('password')); ?><?php else: ?><?php echo e(old('password')); ?><?php endif; ?>" name="password" placeholder="Password"  type="password" autocomplete="off" class="input-text" required id="pass" title="Password">
</div>
</div>
<div class="form-group">
<div class="col-md-12">
<div style=" display: flex!important;" class="d-flex no-block align-items-center">
<div style="display: inline-flex;" class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input" id="Remember">
<label style="margin: 0 5px;" class="custom-control-label" for="Remember"> Remember me</label>
</div>
<div class="ml-auto" style="margin-left: auto!important;">
<a href="javascript:void(0)" id="recoverBtn" class="text-muted"><i class="fa fa-lock"></i> Forgot pwd?</a>
</div>
</div>
</div>
</div>
<div class="actions-toolbar">
<div class="primary">
<button type="submit" class="btn btn-primary" name="send" id="send2"><span>Login</span></button>
</div>
</div>
<div class="col-sm-12 text-center">
New member? <a href="javascript:void(0)" id="registerBtn" class="text-info m-l-5"><b>Register </b></a> here.</div>
<div class="col-sm-8 pull-right form-group text-right">
<label class="control-label">Login with your social account</label>
<div>
<a href="<?php echo e(route('social.login', 'google')); ?>" class="btn btn-social-icon btn-sm btn-google-plus"><i class="fa fa-google fa-fw" aria-hidden="true"></i></a>
<a href="<?php echo e(route('social.login', 'facebook')); ?>" class="btn btn-social-icon btn-sm btn-facebook"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></a>
</div>
</div>
</fieldset>
</form>
<form id="registerForm" style="display: none;" data-parsley-validate action="<?php echo e(route('userRegister')); ?>" method="post">
<?php echo csrf_field(); ?>
<div class="card-header text-center"><h3>Register</h3></div>
<div class="form-group">
<input type="text" required name="name" value="<?php echo e(old('name')); ?>" placeholder="Enter Name*" data-parsley-required-message = "Name is required" id="input-email" class="form-control">
                          <?php if($errors->has('name')): ?>
                                <span class="error" role="alert">
                                    <?php echo e($errors->first('name')); ?>

                                </span>
                            <?php endif; ?>
</div>
<div class="form-group">
<input type="text" required name="mobile" value="<?php echo e(old('mobile')); ?>" placeholder="Enter Mobile Number*" id="mobile" data-parsley-required-message = "Mobile number is required" class="form-control">
                          <?php if($errors->has('mobile')): ?>
                                <span class="error" role="alert">
                                    <?php echo e($errors->first('mobile')); ?>

                                </span>
                            <?php endif; ?>
</div>

<div class="form-group">
<input type="password" name="password" placeholder="Password*" required id="password" data-parsley-required-message = "Password is required" minlength="6" class="form-control">
                            <?php if($errors->has('password')): ?>
                                <span class="error" role="alert">
                                   <?php echo e($errors->first('password')); ?>

                                </span>
                            <?php endif; ?>
</div>
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
<div class="actions-toolbar">
<button class="action login primary" type="submit">Register Now</button>
</div>
<div class="col-sm-12 text-center m-l-5">Already have an account? <a href="javascript:void(0)" id="loginBtn" class="text-info"><b>Login</b></a></div>
<div class="col-sm-8 pull-right form-group text-right">
<label class="control-label">Login with your social account</label>
<div>
<a href="<?php echo e(route('social.login', 'google')); ?>" class="btn btn-social-icon btn-sm btn-google-plus"><i class="fa fa-google fa-fw" aria-hidden="true"></i></a>
<a href="<?php echo e(route('social.login', 'facebook')); ?>" class="btn btn-info btn-sm btn-facebook"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></a>
</div>
</div>
</form>
<form class="form-horizontal" style="display: none;" method="post" id="recoverform" action="<?php echo e(route('password.recover')); ?>">
<?php echo csrf_field(); ?>
<div class="form-group ">
<div class="col-xs-12">
<h3>Recover Password</h3>
<p class="text-muted">Enter your Mobile or Email and instructions will be sent to you! </p>
</div>
<div class="col-xs-12">
 <input class="form-control" id="reseField" name="emailOrMobile" type="text" required placeholder="Mobile or Email"> 
                                <?php if($errors->has('emailOrMobile')): ?>
                                <span class="error" role="alert">
                                   <?php echo e($errors->first('emailOrMobile')); ?>

                                </span>
                                <?php endif; ?>
</div>
</div>
<div class="actions-toolbar">
<div class="col-xs-12">
<button class="action login primary" id="resetBtn" style="margin: 20px;" type="submit">Reset Password</button>
</div>
</div>
</form>
</div>
<div style="clear:both;"></div>
</div>
</div>
</div><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/users/modal/login.blade.php ENDPATH**/ ?>