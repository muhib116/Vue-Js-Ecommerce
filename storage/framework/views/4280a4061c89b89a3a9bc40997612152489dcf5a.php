<?php  
$categorySections = App\Models\CategorySection::with('category')->where('is_feature', 1)->where('status', 1)->get();
$firstSec = 1;
?>
<?php if(count($categorySections)>0): ?>



                            <section>
								<div class="container" style=" margin:10px auto;background:transparent;border-radius: 5px; padding:5px;">
								    
								    
									<div class="module so-listing-tabs-ltr home3_listingtab_style2"> <span class="title" style="color: <?php echo e($section->background_color); ?> !important;text-align: center;display: block;margin-bottom: 20px;font-size: 25px;font-weight: bold;"><?php echo e($section->title); ?></span> <div class="row">
											<div class="col-md-3 col-xs-12">
												<div class="row catSection" style="margin: 0; padding:10px;background: #8cb9c8 url('<?php echo e(asset('upload/images/homepage/'.$section->thumb_image)); ?>');">
												    
												    
												    
												   <?php $__currentLoopData = $categorySections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorySection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    	<?php 
                                    		$sectionSubcategory = explode(',', $categorySection->subcategory_id);
                                    	?>
                                    	<?php if($firstSec == 1): ?>  
												    
												    
													<div class="col-xs-12"> <a style="color: <?php echo e($section->background_color); ?>;padding-bottom:32px;display: block;" href="<?php echo e(route('home.category', $categorySection->category->slug)); ?>"> <strong class="cat-title" style="font-size: 18px;color: <?php echo e($section->background_color); ?>;"> <?php echo e($categorySection->title); ?></strong><?php if($categorySection->sub_title): ?><p><?php echo e($categorySection->sub_title); ?></p><?php endif; ?> </a> </div>
													
													
										 <?php for($i=0; $i < 3; $i++): ?>

                                            <?php 
                                            $sectionCategory_id =  $sectionSubcategory[$i];
                                            $sectionProduct = App\Models\Product::with(['get_subcategory', 'get_childcategory'])
                                            ->where(function($query) use ($sectionCategory_id){
                                                $query->where('subcategory_id', $sectionCategory_id )
                                                ->orWhere('childcategory_id', $sectionCategory_id);
                                            })->where('status', 'active')->first(); ?>
                                            <?php if($sectionProduct): ?>
                    	                        <?php if($i == 0): ?>			
													
													
													
													
													
													
													<div class="col-xs-8"> <a class="link exclick" title="<?php echo e($sectionProduct->title); ?>" href="<?php echo e(route('home.category', [$categorySection->category->slug, $sectionProduct->get_subcategory->slug, $sectionProduct->get_childcategory->slug])); ?>"> <img src="<?php echo e(asset('upload/images/product/thumb/'.$sectionProduct->feature_image)); ?>" style="width: 100%;height: 100%" alt="<?php echo e($sectionProduct->title); ?>"> </a> </div></div>
													
										<?php else: ?>			
													
													
													<div class="col-xs-4">
														<div class="row"> <a class="link exclick" title="<?php echo e($sectionProduct->title); ?>" href="<?php echo e(route('home.category', [$categorySection->category->slug, $sectionProduct->get_subcategory->slug, $sectionProduct->get_childcategory->slug])); ?>"> <div class="col-xs-12" style="margin-bottom: 10px;padding: 0"><img src="<?php echo e(asset('upload/images/product/thumb/'.$sectionProduct->feature_image)); ?>" alt="<?php echo e($sectionProduct->title); ?>"></div> </a> </div></div>
													
												 <?php endif; ?>
                            <?php endif; ?>
                        <?php endfor; ?>	
													
													
												
														
												
											</div>
											
											</div>
														
												
										
											
												<?php else: ?>
											<div class="col-md-3 col-xs-6">
												<div class="row catSection" style="background: <?php echo e($categorySection->background_color); ?>;margin-bottom: 5px;padding: 0 10px 10px;">
													<div class="col-xs-12"> <a style="color: <?php echo e($categorySection->text_color); ?>;" href="<?php echo e(route('home.category', $categorySection->category->slug)); ?>"> <strong class="cat-title" style="color: <?php echo e($categorySection->text_color); ?>;font-weight: 700;font-size: 16px;margin: 5px 0;display: block;"> <?php echo e($categorySection->title); ?></strong> </a> </div>
													
											<?php for($i=0; $i < 3; $i++): ?>

                                                    <?php if(isset($sectionSubcategory[$i])): ?>
                                                        <?php 
                                                         $sectionCategory_id =  $sectionSubcategory[$i];
                                                        $sectionProduct = App\Models\Product::with(['get_subcategory', 'get_childcategory'])
                                                            ->where(function($query) use ($sectionCategory_id){
                                                                $query->where('subcategory_id', $sectionCategory_id )
                                                                ->orWhere('childcategory_id', $sectionCategory_id);
                                                            })->where('status', 'active')->first(); ?>
                                                                                 <?php if($sectionProduct): ?>		
                                        													
                                        													
                                        													<div class="col-xs-4"> <a class="link exclick" title="<?php echo e($sectionProduct->title); ?>" href="#"> <img style="width: 100%; height:84px;display: block;overflow: hidden;" src="<?php echo e(asset('upload/images/product/thumb/'.$sectionProduct->feature_image)); ?>" alt="<?php echo e($sectionProduct->title); ?>"> </a> </div>
                                        													
                                        										<?php endif; ?>
                                                    <?php endif; ?>
                                        <?php endfor; ?>			
													
													
													
													</div>
												</div>
											</div>
											 <?php endif; ?>
                <?php $firstSec++; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</div>
									</div>
								</div>
							</section>




<?php endif; ?>
<?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/frontend/homepage/categories.blade.php ENDPATH**/ ?>