
<?php $__env->startSection('title', 'Slider list'); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <link href="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .dropify_image{
            position: absolute;top: -12px!important;left: 12px !important; z-index: 9; background:#fff!important;padding: 3px;
        }
        .dropify-wrapper{
            height: 180px !important;
        }
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
                        <h4 class="text-themecolor">Slider List</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Slider</a></li>
                                <li class="breadcrumb-item active">list</li>
                            </ol>
                            <button data-toggle="modal" data-target="#add" class="btn btn-info d-none d-lg-block m-l-15"><i
                                    class="fa fa-plus-circle"></i> Add New Slider</button>
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
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Slider Image</th>
                                                <th>Title</th>
                                                <th>Sub Title</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead> 
                                        <tbody id="positionSorting" data-table="sliders">
                                            <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr id="item<?php echo e($slider->id); ?>">
                                                
                                                <td><img src="<?php echo e(asset('upload/images/slider/'. $slider->phato)); ?>" width="150"></td>
                                               
                                                <td><span style="color:<?php echo e($slider->title_color); ?>; font-family: <?php echo e($slider->title_style); ?>"><?php echo e($slider->title); ?></td>
                                                <td><?php echo e($slider->subtitle); ?></span></td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                      <input  name="status" onclick="satusActiveDeactive('sliders', <?php echo e($slider->id); ?>)"  type="checkbox" <?php echo e(($slider->status == 1) ? 'checked' : ''); ?>  type="checkbox" class="custom-control-input" id="status<?php echo e($slider->id); ?>">
                                                      <label style="padding: 5px 12px" class="custom-control-label" for="status<?php echo e($slider->id); ?>"></label>
                                                
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" onclick="edit('<?php echo e($slider->id); ?>')"  data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> Edit</button>
                                                    <button data-target="#delete" onclick="deleteConfirmPopup('<?php echo e(route("slider.delete", $slider->id)); ?>')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> Delete</button>
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
        <div class="modal fade" id="add" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Slider</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row">
                        <div class="card-body">
                            <form action="<?php echo e(route('slider.store')); ?>" enctype="multipart/form-data" data-parsley-validate method="POST" >
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="type" value="homepage">
                                <div class="form-body">
                                    <!--/row-->
                                    <div class="row justify-content-md-center">
                                        

                                        <div class="col-md-12">
                                            <div class="form-group"> 
                                                <label class="required dropify_image">Slider Image</label>
                                                <input required type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="2M"  name="phato" id="input-file-events">
                                                <p style="color:red">Homepage Image Size: 715px * 445px</p>
                                            </div>
                                            <?php if($errors->has('phato')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <?php echo e($errors->first('phato')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label  for="btn_text">Button Name</label>
                                                <input type="text" placeholder="Exm: Shop Now" id="btn_text" name="btn_text" class="form-control">
                                                   
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label  for="btn_link">Button Link</label>
                                                <input type="text" id="btn_link" name="btn_link" placeholder="Exp: <?php echo e(url('/shop')); ?>" class="form-control">
                                            </div>
                                        </div>
                                   
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label  for="text_position">Background Color</label>
                                                <input type="color" class="form-control" name="bg_color">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label  for="text_position">Text Position</label>
                                                <select class="form-control" name="text_position">
                                                    <option value="left">Left</option>
                                                    <option value="center">Center</option>
                                                    <option value="right">Right</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="title">Slider Title</label>
                                                <input name="title" id="title" value="<?php echo e(old('title')); ?>"  type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="title_style">Title Font Style</label>
                                                <input placeholder="Exp. arial" name="title_style" id="title_style" value="<?php echo e(old('title_style')); ?>"  type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="title_size">Title Font Size(px)</label>
                                                <input placeholder="Exp. 50" name="title_size" id="title_size" value="<?php echo e(old('title_size')); ?>"  type="number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="title_color">Title Font Color</label>
                                                <input placeholder="Exp. #00000" name="title_color" id="title_color" value="<?php echo e(old('title_color')); ?>" type="color" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="subtitle">Slider Sub Title</label>
                                                <input placeholder="Enter sub title" name="subtitle" id="subtitle" value="<?php echo e(old('subtitle')); ?>" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="subtitle_style">Font Style</label>
                                                <input placeholder="Exp. arial" name="subtitle_style" id="subtitle_style" value="<?php echo e(old('subtitle_style')); ?>"  type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="subtitle_size">Font Size(px)</label>
                                                <input placeholder="Exp. 50" name="subtitle_size" id="subtitle_size" value="<?php echo e(old('subtitle_size')); ?>"  type="number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="subtitle_color">Font Color</label>
                                                <input placeholder="Exp. #00000" name="subtitle_color" id="subtitle_color" value="<?php echo e(old('subtitle_color')); ?>"  type="color" class="form-control">
                                            </div>
                                        </div>
                                        
                                    </div>
                                   
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-12">
                                            <div class="head-label">
                                                <label class="switch-box">Status</label>
                                                <div  class="status-btn" >
                                                    <div class="custom-control custom-switch">
                                                        <input name="status" checked  type="checkbox" class="custom-control-input" <?php echo e((old('status') == 'on') ? 'checked' : ''); ?> id="status">
                                                        <label  class="custom-control-label" for="status">Publish/UnPublish</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Add New Slider</button>
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
        <!-- update Modal -->
        <div class="modal fade" id="edit" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <form action="<?php echo e(route('slider.update')); ?>" enctype="multipart/form-data"  method="post">
                      <?php echo e(csrf_field()); ?>

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update slider</h4>
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
          <?php echo $__env->make('admin.modal.delete-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
     
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/jqueryui/jquery-ui.min.js"></script>
    <!-- This is data table -->
    <script src="<?php echo e(asset('assets')); ?>/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
   <script>
        $(function () {
           $('#myTable').DataTable({"ordering": false});
        });

    </script>

    <script type="text/javascript">

      function edit(id){
            $('#edit_form').html('<div class="loadingData"></div>');
            var  url = '<?php echo e(route("slider.edit", ":id")); ?>';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $("#edit_form").html(data);
                        $('.dropify').dropify();
                    }
                }, 
                // $ID Error display id name
                <?php echo $__env->make('common.ajaxError', ['ID' => 'edit_form'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            });

    }

</script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/js/dropify.min.js"></script>
     <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

    });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/admin/slider/slider.blade.php ENDPATH**/ ?>