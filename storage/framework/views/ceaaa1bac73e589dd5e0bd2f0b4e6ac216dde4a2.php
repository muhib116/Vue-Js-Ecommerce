
<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('assets/node_modules')); ?>/morrisjs/morris.css" rel="stylesheet">
    <!--Toaster Popup message CSS -->
    <link href="<?php echo e(asset('css')); ?>/pages/dashboard1.css" rel="stylesheet">
    <style type="text/css">.round{font-size:25px;}.display-5{font-size: 2rem !important;}</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
      <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid dashboard1"><br/>
                <?php if(Auth::guard('admin')->user()->role_id == 'admin' || Auth::guard('admin')->user()->username == 'mahin@woadi'): ?>
                
                 <div class="row">
                    <!-- Column -->
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body bg-success text-center">
                                <h1 class="font-light text-white"> ৳
                                <a href="<?php echo e(route('admin.orderList')); ?>" class="text-white"><?php echo e(number_format($amtorder)); ?></a></h1>
                                <h6 class="text-white">Total Order In Amount</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body bg-info text-center">
                                <h1 class="font-light text-white">  ৳
                                <a href="<?php echo e(route('admin.orderList')); ?>" class="text-white"><?php echo e(number_format($amtorderdeliver)); ?></a></h1>
                                <h6 class="text-white">Delivered Order In Amount</h6>
                            </div>
                        </div>
                    </div>
					
					
					
					 <div class="col-md-3">
                        <div class="card">
                            <div class="card-body bg-info text-center">
                                <h1 class="font-light text-white">  ৳
                                <a href="<?php echo e(route('admin.orderList')); ?>" class="text-white"><?php echo e(number_format($amtorderpend)); ?></a></h1>
                                <h6 class="text-white">Payment Received But To Be Delivered</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body bg-warning text-center">
                                <h1 class="font-light text-white"> ৳
                                <a href="<?php echo e(route('admin.orderList', 'pending')); ?>" class="text-white"><?php echo e($amtpending); ?></a></h1>
                                <h6 class="text-white">Order Placed But Unpaid In Amount</h6>
                            </div>
                        </div>
                    </div>

                  
                </div>
				
                
                
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body bg-success text-center">
                                <h1 class="font-light text-white"> <i class="fa fa-cart-plus"></i> 
                                <a href="<?php echo e(route('admin.product.list')); ?>" class="text-white"><?php echo e($allProducts); ?></a></h1>
                                <h6 class="text-white">Total Products</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body bg-info text-center">
                                <h1 class="font-light text-white"> <i class="fa fa-hourglass-half"></i> 
                                <a href="<?php echo e(route('admin.product.list', 'pending')); ?>" class="text-white"><?php echo e($pendingProducts); ?></a></h1>
                                <h6 class="text-white">UnApporve Products</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body bg-warning text-center">
                                <h1 class="font-light text-white"> <i class="fa fa-database"></i> 
                                <a href="<?php echo e(route('admin.product.list', 'stock-out')); ?>" class="text-white"><?php echo e($outOfStock); ?></a></h1>
                                <h6 class="text-white">Out Of Stock Products</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body bg-danger text-center">
                                <h1 class="font-light text-white"> <i class="fa fa-times"></i> 
                                <a href="<?php echo e(route('admin.product.list', 'cancel')); ?>" class="text-white"><?php echo e($outOfStock); ?></a></h1>
                                <h6 class="text-white">Reject Products</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Orders</h5>
                            <div class="d-flex no-block align-items-center">
                                <span class="display-5 text-primary"><i class="fa fa-shipping-fast"></i></span>
                                <a href="<?php echo e(route('admin.orderList')); ?>" class="link display-5 ml-auto"><?php echo e($allOrders); ?></a>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pending Orders</h5>
                            <div class="d-flex no-block align-items-center">
                                <span class="display-5 text-info"><i class="fa fa-hourglass-half"></i></span>
                                <a href="<?php echo e(route('admin.orderList', 'pending')); ?>" class="link display-5 ml-auto"><?php echo e($pendingOrders); ?></a>
                            </div>
                        </div>
                    </div>
                    </div>

                    
                    <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Complete Orders</h5>
                            <div class="d-flex no-block align-items-center">
                                <span class="display-5 text-success"><i class="fa fa-handshake"></i></span>
                                <a href="<?php echo e(route('admin.orderList', 'delivered')); ?>" class="link display-5 ml-auto"><?php echo e($completeOrders); ?></a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Reject Orders</h5>
                            <div class="d-flex no-block align-items-center">
                                <span class="display-5 text-danger"><i class="fa fa-times"></i></span>
                                <a href="<?php echo e(route('admin.orderList', 'cancel')); ?>" class="link display-5 ml-auto"><?php echo e($rejectOrders); ?></a>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-danger"><i class="fa fa-user"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"><?php echo e($pendingSeller); ?></h3>
                                        <h5 class="text-muted m-b-0">Pending Seller</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->

                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body ">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-info"><i class="icon-people"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"><?php echo e($allSeller); ?></h3>
                                        <h5 class="text-muted m-b-0">Total Seller</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-info"><i class="fa fa-user-plus"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"><?php echo e($newUser); ?></h3>
                                        <h5 class="text-muted m-b-0">Customer 7 Days</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->

                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success"><i class="fa fa-user"></i></div>
                                    <div class="m-l-10 align-self-center">
                                    <h3 class="m-b-0"><?php echo e($allUser); ?></h3>
                                    <h5 class="text-muted m-b-0">All Customer</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="d-flex flex-row">
                                <div class="p-10 bg-info">
                                    <h3 class="text-white box m-b-0"><i class="ti-wallet"></i></h3></div>
                                <div class="align-self-center m-l-20">
                                    <h3 class="m-b-0 text-info">0</h3>
                                    <h5 class="text-muted m-b-0">All Ticket</h5></div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="d-flex flex-row">
                                <div class="p-10 bg-success">
                                    <h3 class="text-white box m-b-0"><i class="ti-wallet"></i></h3></div>
                                <div class="align-self-center m-l-20">
                                    <h3 class="m-b-0 text-success">0</h3>
                                    <h5 class="text-muted m-b-0">Blog Post</h5></div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="d-flex flex-row">
                                <div class="p-10 bg-inverse">
                                    <h3 class="text-white box m-b-0"><i class="ti-wallet"></i></h3></div>
                                <div class="align-self-center m-l-20">
                                    <h3 class="m-b-0">0</h3>
                                    <h5 class="text-muted m-b-0">All Subscriber</h5></div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="d-flex flex-row">
                                <div class="p-10 bg-primary">
                                    <h3 class="text-white box m-b-0"><i class="ti-wallet"></i></h3></div>
                                <div class="align-self-center m-l-20">
                                    <h3 class="m-b-0 text-primary">0</h3>
                                    <h5 class="text-muted m-b-0">Withdraw Request</h5></div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                
                
                <div class="row">
                    <!-- Column -->
					
					
					<?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					
					<?php
					$tproduct = \App\Models\Product::where('category_id', $cat->id)->count();
					?>
                   <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($cat->name); ?></h5>
                            <div class="d-flex no-block align-items-center">
                                <span class="display-5 text-primary"><img width="20" src="<?php echo e(asset('upload/images/category/thumb/'.$cat->image)); ?>"></span>
                                <a href="<?php echo e(route('main.category', $cat->slug)); ?>" class="link display-5 ml-auto"><?php echo e($tproduct); ?></a>
                            </div>
                        </div>
                    </div>
                    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  

                  
                </div>
                
                
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Popular Product</h5>
                                <div class="table-responsive">
                                    <table class="table product-overview">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Stock</th>
                                                <th>Price</th>
                                                <th>#</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(count($popularProducts)>0): ?>
                                            <?php $__currentLoopData = $popularProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><a target="_blank" href="<?php echo e(route('product_details', $product->slug)); ?>"> <img src="<?php echo e(asset('upload/images/product/thumb/'.$product->feature_image)); ?>" alt="Image" width="42"> <?php echo e(Str::limit($product->title, 30)); ?></a> </td>
                                                 <td><?php echo e(($product->stock) ? $product->stock : 0); ?></td>
                                                <td><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($product->purchase_price); ?></td>
                                                 <td><a  href="<?php echo e(route('product_details', $product->slug)); ?>" class="text-inverse p-r-10"><i class="ti-eye"></i></a> </td>
                                            </tr>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?> <tr><td colspan="8"> <h1>No products found.</h1></td></tr> <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Recent Order</h5>
                                <div class="table-responsive ">
                                    <table class="table product-overview">
                                        <thead>
                                            <tr>
                                                <th>Order</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(count($recentOrders)>0): ?>
                                                <?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>#<?php echo e($order->order_id); ?><br/><?php echo e(\Carbon\Carbon::parse($order->created_at)->format(Config::get('siteSetting.date_format'))); ?>

                                                    
                                                   </td>
                                                   <td><?php echo e($order->total_qty); ?></td>
                                                    <td><?php echo e($order->currency_sign . ($order->total_price)); ?></td>

                                                    <td> 
                                                        <?php if($order->order_status == 'delivered'): ?>
                                                        <span class="label label-success"> <?php echo e(str_replace('-', ' ', $order->order_status)); ?> </span><?php elseif($order->order_status == 'accepted'): ?>
                                                        <span class="label label-warning"> <?php echo e(str_replace('-', ' ', $order->order_status)); ?> </span>
                                                        <?php elseif($order->order_status == 'cancel'): ?>
                                                        <span class="label label-danger"> <?php echo e(str_replace('-', ' ', $order->order_status)); ?> </span>
                                                        <?php elseif($order->order_status == 'ready-to-ship'): ?>
                                                        <span class="label label-primary"> <?php echo e(str_replace('-', ' ', $order->order_status)); ?> </span>
                                                        <?php else: ?>
                                                        <span class="label label-info"> Pending </span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td> <a target="_blank" href="<?php echo e(route('admin.orderInvoice', $order->order_id)); ?>" class="text-inverse" title="View Order Invoice" data-toggle="tooltip"><i class="ti-eye"></i></a></td>

                                                </tr>
                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?> <tr><td colspan="8"> <h1>No orders found.</h1></td></tr> <?php endif; ?>
                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <script src="<?php echo e(asset('assets/node_modules')); ?>/raphael/raphael-min.js"></script>
    <script src="<?php echo e(asset('assets/node_modules')); ?>/morrisjs/morris.min.js"></script>
    <script src="<?php echo e(asset('assets/node_modules')); ?>/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- Popup message jquery -->
    <script src="<?php echo e(asset('assets/node_modules')); ?>/toast-master/js/jquery.toast.js"></script>
    <!-- Chart JS -->
    <script src="<?php echo e(asset('js')); ?>/dashboard1.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>