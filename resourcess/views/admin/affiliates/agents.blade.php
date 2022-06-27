@extends('layouts.admin-master')
@section('title', 'Affiliate agent list')
@section('css')
    <link href="{{asset('assets')}}/node_modules/bootstrap-switch/bootstrap-switch.min.css" rel="stylesheet">
    <link href="{{asset('css')}}/pages/bootstrap-switch.css" rel="stylesheet">

    <style type="text/css">
        .dropify_image{
            position: absolute;top: -12px!important;left: 12px !important; z-index: 9; background:#fff!important;padding: 3px;
        }
        .dropify-wrapper{
            height: 100px !important;
        }
    </style>
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
                    <h4 class="text-themecolor">agent List</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">agent</a></li>
                            <li class="breadcrumb-item active">list</li>
                        </ol>
                        <button data-toggle="modal" data-target="#add" class="btn btn-info d-none d-lg-block m-l-15"><i
                                class="fa fa-plus-circle"></i> Create New</button>
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
                <div class="col-lg-12">
                    <div class="card" style="margin-bottom: 2px;">

                        <form action="{{route('admin.affiliateAgentList')}}" method="get">

                            <div class="form-body">
                                <div class="card-body">
                                    <div class="row">
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" value="{{ Request::get('name')}}" placeholder="agent name or mobile or email" name="name" class="form-control">
                                           </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="location" required id="location" style="width:100%" id="location"  class="select2 form-control custom-select">
                                                   <option value="all">All Location</option>
                                                   @foreach($locations as $location)
                                                   <option @if(Request::get('location') == $location->id) selected @endif value="{{$location->id}}">{{$location->name}}</option>
                                                   @endforeach
                                               </select>
                                           </div>
                                        </div>


                                        <div class="col-md-2">
                                            <div class="form-group">
                                                
                                                <select name="status" class="form-control">
                                                    <option value="all" {{ (Request::get('status') == "all") ? 'selected' : ''}}>All Status</option>
                                                    <option value="pending" {{ (Request::get('status') == 'pending') ? 'selected' : ''}} >Pending</option>
                                                    <option value="active" {{ (Request::get('status') == 'active') ? 'selected' : ''}}>Active</option>
                                                    <option value="deactive" {{ (Request::get('status') == 'deactive') ? 'selected' : ''}}>Deactive</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                            <div class="form-group">
                                               
                                               <button type="submit" class="form-control btn btn-success"><i style="color:#fff; font-size: 20px;" class="ti-search"></i> </button>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <div class="card ">
                        <div class="card-body">
                           
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Orders</th>
                                            <th>Products</th>
                                            <th>Wallet</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        @foreach($agents as $index => $agent)
                                        <tr id="item{{$agent->id}}">
                                            <td>{{(($agents->perPage() * $agents->currentPage() - $agents->perPage()) + ($index+1) )}}</td>
                                            <td><img src="{{asset('upload/users')}}/{{( $agent->photo) ? $agent->photo : 'default.png'}}" width="40"> {{$agent->name}}</td>
                                            
                                            <td>{{$agent->mobile}}</td>
                                            <td>{{$agent->email}}</td>
                                            <td>{{count($agent->agentProducts)}}</td>
                                            <td>0</td>
                                            <td>{{Config::get('siteSetting.currency_symble') . $agent->wallet_balance}}</td>
                                            <td>
                                                <div class="bt-switch">
                                                    <input  onchange="satusActiveDeactive('affiliate_agents', '{{$agent->agent_id}}')" type="checkbox" {{($agent->agent_status == 'active') ? 'checked' : ''}} data-on-color="success" data-off-color="danger" data-on-text="Active" data-off-text="Deactive"> 
                                                </div>
                                            </td>
                                          
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ti-settings"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                       
                                                        <a class="dropdown-item" title="View agent Profile" data-toggle="tooltip" href="{{ route('customer.profile', $agent->username) }}"><i class="ti-eye"></i> View Profile</a>
                                                        @if(Auth::guard('admin')->user()->role_id ==  'admin'  || in_array(Auth::guard('admin')->id(), [23]))
                                                        <a class="dropdown-item" target="_blank" title="Secret login in the agent pannel" data-toggle="tooltip" href="{{route('admin.customerSecretLogin', encrypt($agent->id))}}"><i class="ti-lock"></i> Agent panel</a>
                                                        @endif
                                                        @if(Auth::guard('admin')->user()->role_id ==  'admin')
                                                      
                                                        <span title="Delete" data-toggle="tooltip"><button   data-target="#delete" onclick='deleteConfirmPopup()'  data-toggle="modal" class="dropdown-item" ><i class="ti-trash"></i> Delete agent</button></span>

                                                        <button title="Password Reset" data-toggle="tooltip" onclick='PasswordReset("{{ $agent->id }}")' class="dropdown-item" ><i class="fa fa-retweet"></i> Password Reset</button>
                                                        @endif
                                                    </div>
                                                </div>                                          
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
               <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                   {{$agents->appends(request()->query())->links()}}
                  </div>
                <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $agents->firstItem() }} to {{ $agents->lastItem() }} of total {{$agents->total()}} entries ({{$agents->lastPage()}} Pages)</div>
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

    <!-- reset password Modal -->
    <div class="modal fade" id="PasswordReset" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <form action="{{route('admin.resetPassword')}}" enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
            <input type="hidden" id="userId" name="id">
            <input type="hidden" name="table" value="users">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Password Reset</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body form-row">
                    <div class="col-md-12">
                        <label for="password"><span style="font-weight: bold">Enter new password</span></label>
                        <input type="text" required id="password" name="password" placeholder="Enter password" class="form-control">
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success">Password Reset</button>
                </div>
              </div>
            </form>
        </div>
    </div>

    <!-- delete Modal -->
    @include('admin.modal.delete-modal')

@endsection
@section('js')

    <!-- bt-switch -->
    <script src="{{asset('assets')}}/node_modules/bootstrap-switch/bootstrap-switch.min.js"></script>
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
    <script type="text/javascript">
    function PasswordReset(userId) {
       $('#PasswordReset').modal('show');
       $('#userId').val(userId);
    }
</script>


@endsection
