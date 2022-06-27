@extends('layouts.admin-master')
@section('title', 'Search Reports')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/stylish-tooltip.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <style type="text/css">
        .payment-method, .customer{
            max-width: 150px !important; font-size: 12px;text-align: center;
        }
        .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn){max-width: 100px;}
    </style>

    <!-- page CSS -->
    <link href="{{asset('assets')}}/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    
@endsection
@section('content')

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
                        <h4 class="text-themecolor">Search Report</h4>
                    </div>
                    
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
   
                <div class="row">
                  
                    <!-- Column -->
                    <div class="col-lg-12">
                        <div class="card">
                            
                           
                            <div class="table-responsive">
                               <table id="example23" class="table display table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Keywords</th>
                                            <th>Total Search</th>
                                            <th>Product Added</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($key)>0)
											@php 
										$i = 0;
										@endphp
                                           @foreach($key as $index => $keywords)
										   @php
										   $i++;
										   @endphp
									   <tr>
									   <td>
                                                    {{$i}}
                                                   
                                                </td>
									   
									    <td>
                                                    {{$keywords->text}}
                                                   
                                                </td>
									    <td>
                                                    {{$keywords->search}}
                                                   
                                                </td>
									    <td>
                                                    {{$keywords->product}}
                                                   
                                                </td>
									   </tr>
									   @endforeach
                                        @else <tr><td colspan="8"> <h1>No keywords found.</h1></td></tr> @endif
                                    </tbody>
                                </table>
                            </div>
                        
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                  <div class="row">
                   <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                       
                    </div>
                        </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
     
    @endsection
    @section('js')


    <script src="{{asset('assets')}}/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets')}}/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>

        <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
        <script>
    // responsive table
        $('#config-table').DataTable({
            responsive: true, searching: false, paging: false, info: false, ordering: false
        });

        // add order info exm( shipping cost, comment) 
        function addedOrderInfo(field, order_id) {

            var link = '{{route("admin.addedOrderInfo")}}';
           
            $.ajax({
                url:link,
                method:"get",
                data:{field:field,order_id:order_id},
                success:function(data){
                    if(data.status){
                        toastr.success(data.message);
                    }else{
                        toastr.error(data.message);
                    }
                }

            });
        }
    </script>

    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
 
    <script src="{{asset('assets')}}/node_modules/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
 
    <script>
        $(function () {
      
            $('.selectpicker').selectpicker();
            
        });


        $('#example23').DataTable({
                dom: 'Bfrtip',paging: false, info: false, ordering: false,
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
            $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
    </script>
@endsection
