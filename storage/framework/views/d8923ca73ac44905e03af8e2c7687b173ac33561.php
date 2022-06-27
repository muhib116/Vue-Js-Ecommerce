<?php  
    $discount = null;
    $selling_price = $product->selling_price;
    $discount = ($product->discount) ? $product->discount : null;
    $discount_type = $product->discount_type;
    if($discount){
        $calculate_discount = App\Http\Controllers\HelperController::calculate_discount($selling_price, $discount, $discount_type );
    }
?>




<div class="product-item-container" style="padding-bottom: 5px;">
																		<div class="left-block ">
																			<div class="image product-image-container">
																			    
										<?php if($product->is_b2b == 0): ?>
										<a class="lt-image" href="<?php echo e(route('product_details', $product->slug)); ?>">
										<?php else: ?>
										<a class="lt-image" href="<?php echo e(route('b2bproduct_details', $product->slug)); ?>" >
										<?php endif; ?>
										    
										    
										    
										     <img src="<?php echo e(asset('upload/images/product/thumb/'. $product->feature_image)); ?>" class="img-1 img-responsive"> 
										     
										     <?php if($product->is_b2b == 0): ?>
                                            <?php if($discount): ?>
                                             <div class="box-label"> <span class="label-sale"><?php if($discount_type == '%'): ?>-<?php endif; ?><?php echo e($calculate_discount['discount']); ?>%</span> </div> 
                                			<?php endif; ?>
                                			<?php else: ?>
                                				<div class="box-label">
                                				<span class="label-sale">Wholesale(B2B)</span>
                                			</div>
                                			
                                			<?php endif; ?>
										     
										     </a>
										     <?php if($product->is_b2b == 0): ?>
                                            <span title="Quickview product details" data-toggle="tooltip" class="btn-button btn-quickview quickview quickview_handler" onclick="quickview('<?php echo e($product->slug); ?>')" href="javascript:void(0)"> <i class="fa fa-search"></i> </span>
                                           <?php endif; ?>
                                           </div>
										</div>
																		<div class="right-block">
																			<div class="caption">
																				<h4 style="height: 40px;font-size: 1em;line-height: 20px;text-overflow: ellipsis;border-bottom: 0;overflow: hidden;margin-bottom: 3px;">
																				    
											<?php if($product->is_b2b == 0): ?>									    <a style="color: black;float: left;text-align: left;" href="<?php echo e(route('product_details', $product->slug)); ?>"><?php echo e(\Illuminate\Support\Str::limit($product->title, 35,'..')); ?></a>
											<?php else: ?>
											<a style="color: black;float: left;text-align: left;" href="<?php echo e(route('b2bproduct_details', $product->slug)); ?>"><?php echo e(\Illuminate\Support\Str::limit($product->title, 35,'..')); ?></a>
											
											<?php endif; ?>
																				    
																				    </h4>
																				<div class="clearfix" style="display: block;">
											<?php if($product->is_b2b == 0): ?>
											<?php if($discount): ?>
											<div class="price"> <span class="price-new"><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($calculate_discount['price']); ?></span> <span class="price-old"><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($selling_price); ?></span> </div>
											<?php else: ?>
											<div class="price"><span class="price-new"><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($selling_price); ?></span> </div>
											<?php endif; ?>
											<?php else: ?>
											<?php
                        					$pricing = explode("-", $product->pricing);
                                            $start = $pricing[0];
                                            $end   = $pricing[1];
                                    		
                                    		
                                    		$nstart = $start+(($product->profit/100)*$start);
                                    		$nend = $end+(($product->profit/100)*$end);
                                            ?>
										<div class="price"><span class="price-new"><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($nstart); ?>-<?php echo e($nend); ?></span>  </div>	
											<?php endif; ?>
											</div>
																			</div>
																		</div>
																	</div>
<?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/frontend/homepage/products.blade.php ENDPATH**/ ?>