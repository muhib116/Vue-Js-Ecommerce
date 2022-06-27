
<?php $__env->startSection('title', 'Category list'); ?>
<?php $__env->startSection('css-top'); ?>
    <link href="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <link href="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets')); ?>/node_modules/bootstrap-switch/bootstrap-switch.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('css')); ?>/pages/bootstrap-switch.css" rel="stylesheet">

    <style type="text/css">
        .dropify_image{
            position: absolute;top: -12px!important;left: 12px !important; z-index: 9; background:#fff!important;padding: 3px;
        }
        .dropify-wrapper{
            height: 150px !important;
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
                        <h4 class="text-themecolor">Category List</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Category</a></li>
                                <li class="breadcrumb-item active">list</li>
								 <button data-toggle="modal" data-target="#add" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>
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
                    <div class="col-12">

                        <div class="card ">
                            <div class="card-body">
                                 <i class="drag-drop-info">Drag & drop sorting position</i>
                                <div class="table-responsive">
                                    <table id="config-table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Category Name</th>
                                                <th>Feature Image</th>
                                                <th>Notes</th>
                                                <th>Popular</th>
                                                <th>Status</th>
                                                
                                                <th>Action</th>
                                            </tr>
                                        </thead> 
                                        <tbody id="categoryPositionSorting">
                                            <?php $__currentLoopData = $get_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr id="item<?php echo e($data->id); ?>">
                                                <td><?php echo e($index+1); ?></td>
                                                <td><?php echo e($data->name); ?></td>
                                                <td><img src="<?php echo e(asset('upload/images/category/thumb/'. $data->image)); ?>" width="50"></td>
                                                <td><?php echo e($data->notes); ?></td>
                                                <td>
                                                    <div class="bt-switch">
                                                        <input  onchange="satusActiveDeactive('categories', '<?php echo e($data->id); ?>', 'popular')" type="checkbox" <?php echo e(($data->popular == 1) ? 'checked' : ''); ?> data-on-color="warning" data-off-color="danger" data-on-text="Enabled" data-off-text="Disabled"> 
                                                   
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                      <input  name="status" onclick="satusActiveDeactive('categories', <?php echo e($data->id); ?>)"  type="checkbox" <?php echo e(($data->status == 1) ? 'checked' : ''); ?>  type="checkbox" class="custom-control-input" id="status<?php echo e($data->id); ?>">
                                                      <label style="padding: 5px 12px" class="custom-control-label" for="status<?php echo e($data->id); ?>"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" onclick="getCategoryBanner('<?php echo e($data->slug); ?>')"  data-toggle="modal" data-target="#setBanner" class="btn btn-success btn-sm"><i class="ti-plus" aria-hidden="true"></i> Banner</button>
                                                    <button type="button" onclick="edit('<?php echo e($data->id); ?>')"  data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> Edit</button>
                                                    <button title="delete" data-target="#delete" onclick="deleteConfirmPopup('<?php echo e(route("category.delete", $data->id)); ?>')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i></button>
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
        <!-- add Modal -->
        <div class="modal fade" id="add" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create category</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row">
                        <div class="card-body">
                            <form action="<?php echo e(route('category.store')); ?>" enctype="multipart/form-data" method="POST" class="floating-labels">
                                <?php echo e(csrf_field()); ?>

                                <div class="form-body">
                                    <!--/row-->
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Category Name</label>
                                                <input  name="name" id="name" value="<?php echo e(old('name')); ?>" required="" type="text" class="form-control">
                                            </div>
                                        </div>
                                     
                                    </div>
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-12">
                                            <div class="form-group"> 
                                                <label class="dropify_image">Feature Image</label>
                                                <input  type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="2M"  name="phato" id="input-file-events">
                                            </div>
                                            <?php if($errors->has('phato')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <?php echo e($errors->first('phato')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="row justify-content-md-center">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label style="background: #fff;top:-10px;z-index: 1" for="notes">Details</label>
                                                <textarea name="notes" class="form-control" placeholder="Enter details" id="notes" rows="2"><?php echo e(old('notes')); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
									
									
									
									
									
									
									 <div class="row justify-content-md-center">
                                        <div class="col-md-12">
									<div class="form-group">
                                                            <span class="required">Category Tags( <span style="font-size: 12px;color: #777;font-weight: initial;">Write tags Separated by Comma[,]</span> )</span>

                                                             <div class="tags-default">
                                                                <select type="text" name="keywords[]" class="itemName" ></select>
                                                            </div>
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
        
        <!-- update Modal -->
        <div class="modal fade" id="edit" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <form action="<?php echo e(route('category.update')); ?>" enctype="multipart/form-data" method="post">
                <?php echo e(csrf_field()); ?>

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update category</h4>
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

        <!-- delete Modal -->
        <?php echo $__env->make('admin.modal.delete-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- banner modal -->
        <?php echo $__env->make('admin.category.category-banner-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;

        
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/jqueryui/jquery-ui.min.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/js/dropify.min.js"></script>
    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();
       
    });
    </script>
    <!-- This is data table -->
    <script src="<?php echo e(asset('assets')); ?>/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>

        <!-- bt-switch -->
    <script src="<?php echo e(asset('assets')); ?>/node_modules/bootstrap-switch/bootstrap-switch.min.js"></script>
	 <script src="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
 
    <script type="text/javascript">
    $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
    var radioswitch = function() {
        var bt = function() {
            $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioState")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
            })
        };
        return {
            init: function() {
                bt()
            }
        }
    }();
    $(document).ready(function() {
        radioswitch.init()
    });
    </script>

   <script>
       // responsive table
        $('#config-table').DataTable({
            responsive: true,
             ordering: false
        });
    </script>




    <script type="text/javascript">

$(document).ready(function(){
		$('.itemName').select2({
 placeholder: 'Select an item',
 tags:true,
 debug:true,
 multiple:true,
            ajax: {
                url: '/keyword',
                dataType: 'json',
                delay: 250,
                data: function (data) {
                    return {
                        searchTerm: data.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results:response
                    };
                },
                cache: true
            }
});


	});	





        function edit(id){
            $('#edit_form').html('<div class="loadingData"></div>');
            var  url = '<?php echo e(route("category.edit", ":id")); ?>';
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
    
    
    <script>
        $(document).ready(function(){
         $( "#categoryPositionSorting" ).sortable({
          placeholder : "ui-state-highlight",
          update  : function(event, ui)
          {

           var ids = new Array();
           $('#categoryPositionSorting tr').each(function(){
            ids.push($(this).attr("id"));
           });

           $.ajax({
            url:"<?php echo e(route('categorySorting')); ?>",
            method:"get",
            data:{ids:ids,operator:'=',operator2:'='},
            success:function(data)
            {
             toastr.success(data)
            }
           });
          }
         });

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/admin/category/category.blade.php ENDPATH**/ ?>