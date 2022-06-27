@extends('layouts.admin-master')
@section('title', 'SMS Panel')
@section('css-top')
	<link href="{{asset('assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
   <link href="{{asset('assets')}}/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
@endsection
@section('css')

    <style type="text/css">
    tbody p{padding: 0;margin: 0}
        .bootstrap-tagsinput{
            width: 100% !important;
            padding: 5px;
        }
    </style>
@endsection
@section('content')
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
                    <h4 class="text-themecolor">SMS Panel</h4>
                </div>
                
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="row">
                            <div class="col-xlg-6 col-lg-6 col-md-6">
                                <div class="card-body">
                                   
                                    <form method="GET">
                                        <div class="form-body">
                                            <!--/row-->
                                            <div class="row">
                                                

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                       <input type="number" placeholder="Minimum Number Of Order" class="form-control" required name="min">
                                                      </span>

                                                    </div>
                                                </div>

                                              <div class="col-md-12">
                                                    <div class="form-group">
                                                       <input type="number" placeholder="Maximum Number Of Order" class="form-control" required name="max">
                                                      </span>

                                                    </div>
                                                </div>
												
												
												
												
												
                                                
                                            </div> </div>
                                            <div class="row justify-content-md-center">
                                                <div class="col-md-12">
                                                    <div class="modal-footer">
                                                        <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Select User</button>
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
            </div>
            
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
@endsection
@section('js')
    <script src="{{asset('assets')}}/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

    <script src="{{asset('assets')}}/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script type="text/javascript">
        // Enter form submit preventDefault for tags
        $(document).on('keyup keypress', 'form input[type="text"]', function(e) {
          if(e.keyCode == 13) {
            e.preventDefault();
            return false;
          }
        });

        $(".select2").select2();
    </script>
@endsection
