
<?php $__env->startSection('title', 'Loyal Order List'); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/pages/stylish-tooltip.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <style type="text/css">
        .payment-method, .customer{ max-width: 150px !important; font-size: 12px; }
        .label-return{background: #ff6226;}
        .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn){max-width: 100px;}
        #orerControll .form-control{padding: 3px;}
        .clockdiv{margin-bottom: 0px;}
        .count{ display: inline-flex; margin: 0 auto; text-align: center; align-items: center;}
        .count_d {position: relative;padding: 0px 4px 0px;margin: 0px 3px;border-radius: 5px;background: #00000078;overflow: hidden;}
        .count_d:before{ content: '';  position: absolute;top: 0;left: 0;width: 100%;height: 50%;}
        .count_d span { display: block; text-align: center; font-size: 12px; font-weight: 800;color: #fff;}
        .count_d h2 { display: block; text-align: center;color: #fff; font-size: 7px; font-weight: 600; text-transform: uppercase; margin: 0;}
        .irotate {  text-align: center;  margin: 0 auto; display: block;}
        .thisis { display: inline-block; vertical-align: middle; }
        .slidem { text-align: center; min-width: 90px;}
    </style>
    <!-- page CSS -->
    <link href="<?php echo e(asset('assets')); ?>/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor"> Total Consumer (<?php echo e($orders->total()); ?>)</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <a class="btn btn-info btn-sm d-none d-lg-block m-l-15" href="<?php echo e(route('toporder')); ?>"><i class="fa fa-eye"></i> Order lists</a>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
         
		 
		 
		 
		 
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="margin-bottom: 2px;">
                        <form action="<?php echo e(route('toporder')); ?>" id="orerControll" method="get">
                            <div class="form-body">
                                <div class="card-body" style="padding-bottom: 0;">
                                    <div class="row">
                                        <div class="col-md-2 col-6">
                                            <div class="form-group ">
							<span class="required">Select Your Region</span>
							<select name="region" onchange="get_city(this.value)" required id="input-payment-country" class="form-control select2">
								<option value=""> Please Select  </option>
								<option value="0"> All Region  </option>
								<?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($state->id); ?>"> <?php echo e($state->name); ?> </option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
                                        </div>
                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
								<span class="required">City</span>
								<select name="city" onchange="get_area(this.value)"  required id="show_city" class="form-control select2">
									
									
									<option  value="0"> All City </option>
									
								</select>
							</div>
                                        </div>
                                                                                  
                                        <div class="col-md-2 col-6">
                                         <div class="form-group ">
							<span class="required">Area</span>
							<select name="area" required id="show_area" class="form-control select2">
									<option  value="0"> All Area </option>
							</select>
						</div>
                                        </div>
                                  
                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label class="control-label">From Amount</label>
                                                <input name="start" value="<?php echo e($smt); ?>" type="number" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label class="control-label">To Amount</label>
                                                <input name="end" value="<?php echo e($emt); ?>" type="number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-6">
                                            <div class="form-group">
                                                <label class="control-label">.</label>
                                               <button type="submit" class="form-control btn btn-success"><i style="color:#fff; font-size: 20px;" class="ti-search"></i> </button>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-1 col-6">
                                            <div class="form-group">
                                                <label class="control-label">.</label>
                                               <button data-toggle="modal" data-target="#sms" class="form-control btn btn-warning"><i class="fa fa-comment-alt"></i> </button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Column -->
                 <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                        <h3>
                           
                                Total Record: (<?php echo e($orders->total()); ?>)
                        
                        </h3>
                        <div class="table-responsive">
                            <table class="table display table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                       
                                        <th>Name</th>
                                        <th style="min-width: 100px;">Amount Order</th>
                                        <th>Billing Phone</th>
                                        <th>Shipping Phone</th>
                                         <th>State</th>
                                         <th>City</th>
                                         <th>Area</th>
										<th>Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($orders)>0): ?>
                                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        
                                        <tr id="<?php echo e($order->order_id); ?>">
                                            <td><?php echo e((($orders->perPage() * $orders->currentPage() - $orders->perPage()) + ($index+1) )); ?></td>
                                           
                                           <td><?php echo e($order->customer->name); ?>    </td>
                                            <td><?php echo e(config('siteSetting.currency_symble')); ?><?php echo e($order->amount); ?></td>
                                            <td>
                                                <?php if(!empty($order->billing_phone)): ?>
                                                <?php echo e($order->billing_phone); ?> <?php else: ?>
												<?php echo e($order->customer->mobile); ?>	
												<?php endif; ?>
                                                
                                            </td>
											<td>
											<?php echo e($order->shipping_phone); ?>

											</td>
											
											
											
											 <td>
											     <?php if(\App\Models\State::where('id', $order->billing_region)->first() != null): ?>
										   <?php echo e(\App\Models\State::where('id', $order->billing_region)->first()->name); ?>

										   <?php endif; ?>
                                            </td>
                                            	 <td>
                                            	     <?php if(\App\Models\City::where('id', $order->billing_city)->first() != null): ?>
										   	<?php echo e(\App\Models\City::where('id', $order->billing_city)->first()->name); ?>

										   <?php endif; ?>
                                            </td>		 <td>
										   <?php if(\App\Models\Area::where('id', $order->billing_area)->first() != null): ?>
										   	<?php echo e(\App\Models\Area::where('id', $order->billing_area)->first()->name); ?>

										   	<?php endif; ?>
                                            </td>
											
											
                                           <td>
										   <?php echo e($order->billing_address); ?>

										   
                                            </td>
                                        </tr>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?> <tr><td colspan="8"> <h1>No Consumer found.</h1></td></tr> <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
               
                <!-- Column -->
            </div> 
            <div class="row">
               <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                   <?php echo e($orders->appends(request()->query())->links()); ?>

                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing <?php echo e($orders->firstItem()); ?> to <?php echo e($orders->lastItem()); ?> of total <?php echo e($orders->total()); ?> entries (<?php echo e($orders->lastPage()); ?> Pages)</div>
            </div>
     
            <!-- ============================================================== -->
            <!-- End PAge Content -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
 
   <!-- add Modal -->
        <div class="modal fade" id="sms" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Send Sms</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row">
                        <div class="card-body">
                            <form action="<?php echo e(route('smstoporder')); ?>" data-parsley-validate method="POST" >
                                <?php echo e(csrf_field()); ?>

                                <div class="form-body">
                                    <div class="row">
                                        
                                        
                                        
                                        <input type="hidden" name="start" value="<?php echo e($smt); ?>">
                                        <input type="hidden" name="end" value="<?php echo e($emt); ?>">
                                        
                                        <?php if(request()->has('region')): ?>
                                        <input type="hidden" name="region" value="<?php echo e(request()->region); ?>">
                                        <?php endif; ?>
                                        
                                         <?php if(request()->has('city')): ?>
                                        <input type="hidden" name="city" value="<?php echo e(request()->city); ?>">
                                        <?php endif; ?>
                                        
                                         <?php if(request()->has('area')): ?>
                                        <input type="hidden" name="area" value="<?php echo e(request()->area); ?>">
                                        <?php endif; ?>
                                        <div class="col-md-12">
                                          
                                                    <div class="form-group">
                                                        <textarea name="details" class="form-control " required placeholder="Write your details" id="details" rows="3"><?php echo e(old('details')); ?></textarea>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="col-md-12">
                                           <div class="modal-footer">
                                                        <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Send message</button>
                                                        <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancel</button>
                                                    </div>
                                                    </div>
                                    </div>
                                    <hr/>
                                    <div id="showCustomerDetails"> </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

   
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script type="text/javascript">
	function get_city(id, type=''){
       
        var  url = '<?php echo e(route("sms.get_city", ":id")); ?>';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
               
                    $("#show_city"+type).html(data.allcity);
                    $("#show_city"+type).focus();
                
            }
        });
    }  	 

    function get_area(id, type=''){
           
        var  url = '<?php echo e(route("sms.get_area", ":id")); ?>';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#show_area"+type).html(data);
                    $("#show_area"+type).focus();
                }else{
                    $("#show_area"+type).html('<option value="0">All Area</option>');
                }
            }
        });
    }  
</script>
	
	

    <script src="<?php echo e(asset('assets')); ?>/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
        <script>
    // responsive table
        $('#config-table').DataTable({
            responsive: true, searching: false, paging: false, info: false, ordering: false
        });
    </script>

    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
 
    <script src="<?php echo e(asset('assets')); ?>/node_modules/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
 
    <script>
        function checkField(value, field){
            if(value != ""){
                $.ajax({
                    method:'get',
                    url:"<?php echo e(route('checkField')); ?>",
                    data:{table:'order_payments', field:field, value:value},
                    success:function(data){
                        if(data.status){
                            $('#'+field).html("");
                            
                            $('#submitBtn').removeAttr('disabled');
                            $('#submitBtn').removeAttr('style', 'cursor:not-allowed');
                            
                        }else{
                            $('#'+field).html("<span style='color:red'><i class='fa fa-times'></i> "+data.msg+"</span>");
                            
                            $('#submitBtn').attr('disabled', 'disabled');
                            $('#submitBtn').attr('style', 'cursor:not-allowed');
                            
                        }
                    },
                    error: function(jqXHR, exception) {
                        toastr.error('Unexpected error occur.');
                    }
                });
            }else{
                $('#'+field).html("<span style='color:red'>"+field +" is required</span>");
                $('#submitBtn').attr('disabled', 'disabled');
                $('#submitBtn').attr('style', 'cursor:not-allowed');   
            }
        }
        $(function () {
            $('.selectpicker').selectpicker();
        });
    </script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

    <script type="text/javascript">

    $(".select2").select2();
    </script>
 
    <script type="text/javascript">
        function reviewModal(order_id, product_id){
            $('#reviewModal').modal('show');
            $("#getReviewForm").html("<div class='loadingData-sm'></div>");
            $.ajax({
                url:'<?php echo e(route("adminGetReviewForm")); ?>',
                type:'get',
                data:{order_id:order_id,product_id:product_id},
                success:function(data){
                    if(data){
                       $('#getReviewForm').html(data);
                    }else{
                      toastr.error(data);
                    }
                }
            });
         }
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/admin/order/loyal.blade.php ENDPATH**/ ?>