
<?php $__env->startSection('title', 'Category section list'); ?>

<?php $__env->startSection('css-top'); ?>
    <link href="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets')); ?>/node_modules/jquery-asColorPicker-master/dist/css/asColorPicker.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets')); ?>/node_modules/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    
    <style type="text/css">
        .asColorPicker_open{z-index: 9999999}
       
    </style>
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
                        <h4 class="text-themecolor">Category section List</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Category</a></li>
                                <li class="breadcrumb-item active">list</li>
                            </ol>
                            <button data-toggle="modal" data-target="#add" class="btn btn-info d-none d-lg-block m-l-15"><i
                                    class="fa fa-plus-circle"></i> Add New</button>
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
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body">
                                 <i class="drag-drop-info">Drag & drop sorting position</i>
                                <div class="table-responsive">
                                    <table  class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Section Title</th>
                                                <th>Category</th>
                                                <th>Sub_Category</th>
                                                <th>Is Feature</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="positionSorting" data-table="category_sections">
                                            <?php $__currentLoopData = $categorySections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr style="background:<?php echo e($data->background_color); ?>;color: <?php echo e($data->text_color); ?>" id="item<?php echo e($data->id); ?>">
                                                <td>
                                                    <?php echo e($data->title); ?>

                                                    <?php if($data->sub_title): ?><p><?php echo e($data->sub_title); ?></p><?php endif; ?>
                                                </td>
                                                <td><?php if($data->category): ?> <?php echo e($data->category->name); ?> <?php endif; ?></td>
                                                <td>
                                                    <?php if($data->subcategory_id): ?> 
                                                        <?php $subcategories = App\Models\Category::whereIn('id', explode(',', $data->subcategory_id))->get();?>

                                                        <?php if($subcategories): ?>
                                                             <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <p style="line-height: 1"><?php echo e($subcategory->name); ?></p>
                                                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch" style="padding-left: 3.25rem;">
                                                      <input name="is_feature" onclick="satusActiveDeactive('category_sections', '<?php echo e($data->id); ?>', 'is_feature')"  type="checkbox" <?php echo e(($data->is_feature == 1) ? 'checked' : ''); ?> class="custom-control-input" id="status<?php echo e($data->id); ?>">
                                                      <label class="custom-control-label" for="status<?php echo e($data->id); ?>"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch" style="padding-left: 3.25rem;">
                                                      <input name="status" onclick="satusActiveDeactive('category_sections', <?php echo e($data->id); ?>)"  type="checkbox" <?php echo e(($data->status == 1) ? 'checked' : ''); ?> class="custom-control-input" id="status<?php echo e($data->id); ?>">
                                                      <label class="custom-control-label" for="status<?php echo e($data->id); ?>"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" onclick="edit('<?php echo e($data->id); ?>')"  data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> Edit</button>
                                                    <?php if($data->is_default != 1): ?>
                                                    <button title="Delete" data-target="#delete" onclick="deleteConfirmPopup('<?php echo e(route("admin.categorySection.delete", $data->id)); ?>')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> </button>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->

        <!-- update Modal -->
        <div class="modal fade" id="edit" role="dialog" style="display: none;">
            <div class="modal-dialog">
                <form action="<?php echo e(route('admin.categorySection.update')); ?>"  method="post">
                      <?php echo e(csrf_field()); ?>

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update category section</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row" id="edit_form"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
        <!-- add Modal -->
        <div class="modal fade" id="add">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create category section</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row">
                        <div class="card-body">
                            <form action="<?php echo e(route('admin.categorySection.store')); ?>" method="POST" >
                                <?php echo e(csrf_field()); ?>

                                <div class="form-body">
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="name">Section Title</label>
                                                <input placeholder="Enter Title" name="title" id="name" value="<?php echo e(old('title')); ?>" required="" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sub_title">Sub Title</label>
                                                <input  name="sub_title" placeholder="Enter sub title" id="sub_title" value="<?php echo e(old('sub_title')); ?>" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="category_id">Select category</label>
                                                <select required onchange="getSubcateogry(this.value)" name="category_id" id="category_id" class="select2 form-control custom-select">
                                                   <option value="">Select category</option>
                                                   <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                   <option <?php if(Session::get("category_id") == $category->id): ?> selected <?php endif; ?>  value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12" >
                                            <div class="form-group">
                                                <label class="required" for="category_id">Sub category</label>
                                                <select required  name="subcategory_id[]" id="showSubcateogry" multiple class="select2 m-b-10 select2-multiple" data-placeholder="Choose" style="width: 100%">
                                                   <option value="">Select first category</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="name">Bacground Color</label>
                                                <input type="text" name="background_color" value="#ccc" class="form-control gradient-colorpicker" >
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="required" for="name">Text Color</label>
                                                <input name="text_color" value="#000000" class="gradient-colorpicker form-control" >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="head-label">
                                                <label class="switch-box">Allow Feature</label>
                                                <div  class="status-btn" >
                                                    <div class="custom-control custom-switch">
                                                        <input name="is_feature" checked  type="checkbox" class="custom-control-input" <?php echo e((old('is_feature') == 'on') ? 'checked' : ''); ?> id="is_feature">
                                                        <label  class="custom-control-label" for="is_feature">Publish/UnPublish</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="head-label">
                                                <label class="switch-box">Status</label>
                                                <div  class="status-btn" >
                                                    <div class="custom-control custom-switch">
                                                        <input name="status" checked  type="checkbox" class="custom-control-input" <?php echo e((old('status') == 'on') ? 'checked' : ''); ?> id="status">
                                                        <label  class="custom-control-label" for="status">Publish/UnPublish</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row justify-content-md-center">
                                        <div class="col-md-12">
                                            <div class="modal-footer">
                                                <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                                <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- delete Modal -->
        <?php echo $__env->make('admin.modal.delete-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    
    <script src="<?php echo e(asset('assets')); ?>/node_modules/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
     <script type="text/javascript" src="<?php echo e(asset('assets')); ?>/node_modules/multiselect/js/jquery.multi-select.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="<?php echo e(asset('assets')); ?>/node_modules/jquery-asColor/dist/jquery-asColor.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    <script>

    // Colorpicker
  
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });

    $(".select2").select2();
    </script>

    <script type="text/javascript">

    function edit(id){
        $('#edit_form').html('<div class="loadingData"></div>');
        var  url = '<?php echo e(route("admin.categorySection.edit", ":id")); ?>';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#edit_form").html(data);
                    $(".select2").select2();

                    $(".gradient-colorpicker").asColorPicker({
                        mode: 'gradient'
                    });
                }
            },
            // $ID Error display id name
            <?php echo $__env->make('common.ajaxError', ['ID' => 'edit_form'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        });

    }

    // get category Sourch
    function getSubcateogry(category_id, edit=''){

        var  url = '<?php echo e(route("admin.getSubChildcategory")); ?>';
        if(category_id != ''){
            $.ajax({
                url:url,
                method:"get",
                data:{category_id:category_id},
                success:function(data){

                    if(data){
                        $("#"+edit+"showSubcateogry").html(data);
                        $(".select2").select2();
                    }else{
                        $("#"+edit+"showSubcateogry").html('<option>Category not found</option>');
                    }
                }
            });
        }else{
            $("#"+edit+"showSubcateogry").html('<option>Category not found</option>');
        }
    }


        // if occur error open model
        <?php if($errors->any()): ?>
            $("#<?php echo e(Session::get('submitType')); ?>").modal('show');
        <?php endif; ?>
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/admin/category_section/index.blade.php ENDPATH**/ ?>