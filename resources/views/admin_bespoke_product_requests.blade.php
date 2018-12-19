<!DOCTYPE html>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin | The Affinity Club </title>

    @include("includes.admin-index-head")  

    <script>
      function updateAdmin(key){
        document.getElementById('updateAdmin'+key).submit();
      }

      function updateStatus(key){
        document.getElementById('updateStatus'+key).submit();
      }
      function openLink(data){
        location.href = "admin_comment/bespoke_products/"+data.id;
      } 
    </script>  
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"> <span>The Affinity Club</span></a>
            </div>

            <div class="clearfix"></div>

            @include("includes.admin-menu")

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                @if(Session::has('error'))
                    <div class="alert alert-danger"> {{Session::get('error')}} </div>
                @endif
                
                @if(Session::has('success'))
                    <div class="alert alert-success"> {{Session::get('success')}} </div>
                @endif

                <div class="row">
                  <div class="col-md-10">
                    <div class="x_panel tile" style="height: 202px;">
                      
                      <div class="x_content">
                      <h4><b>Requests Status</b></h4>
                        <div class="widget_summary">
                          <div class="w_left w_25">
                            <span>Pending</span>
                          </div>
                          <div class="w_center w_55">
                            <div class="progress">
                              <div class="progress-bar bg-blue" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: 
                              <?php
                                $pending = 0;
                                foreach ($bespoke_product_requests as $my_bespoke_product_requests) {
                                  if($my_bespoke_product_requests->status == 'Pending'){
                                    $pending++;
                                  }
                                }  
                                echo $pending == 0 ? 0 : ($pending/count($bespoke_product_requests)) * 100 ;?>%">
                                <span class="sr-only">
                                  0
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                              <?php
                                $pending = 0;
                                foreach ($bespoke_product_requests as $my_bespoke_product_requests) {
                                  if($my_bespoke_product_requests->status == "Pending"){
                                    $pending++;
                                  }
                                }  
                              ?>
                              {{ $pending }}  
                            </span>
                          </div>
                          <div class="clearfix"></div>
                        </div>

                        <div class="widget_summary">
                          <div class="w_left w_25">
                            <span>In Progress</span>
                          </div>
                          <div class="w_center w_55">
                            <div class="progress">
                              <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 
                              <?php
                                $in_progress = 0;
                                foreach ($bespoke_product_requests as $my_bespoke_product_requests) {
                                  if($my_bespoke_product_requests->status == "In Progress"){
                                    $in_progress++;
                                  }
                                }  
                                echo $in_progress == 0 ? 0 : ($in_progress/count($bespoke_product_requests)) * 100 ;?>%">
                                <span class="sr-only">50% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $in_progress = 0;
                                foreach ($bespoke_product_requests as $my_bespoke_product_requests) {
                                  if($my_bespoke_product_requests->status == "In Progress"){
                                    $in_progress++;
                                  }
                                }  
                              ?>
                              {{ $in_progress }} 
                            </span>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                        <div class="widget_summary">
                          <div class="w_left w_25">
                            <span>Resolved</span>
                          </div>
                          <div class="w_center w_55">
                            <div class="progress">
                              <div class="progress-bar bg-green" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 
                              <?php
                                $resolved = 0;
                                foreach ($bespoke_product_requests as $my_bespoke_product_requests) {
                                  if($my_bespoke_product_requests->status == "Resolved"){
                                    $resolved++;
                                  }
                                }  
                                echo $resolved == 0 ? 0 : ($resolved/count($bespoke_product_requests)) * 100 ;?>%">
                                <span class="sr-only">50% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $resolved = 0;
                                foreach ($bespoke_product_requests as $my_bespoke_product_requests) {
                                  if($my_bespoke_product_requests->status == "Resolved"){
                                    $resolved++;
                                  }
                                }  
                              ?>
                              {{ $resolved }} 
                            </span>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                        <div class="widget_summary">
                          <div class="w_left w_25">
                            <span>Unresolved</span>
                          </div>
                          <div class="w_center w_55">
                            <div class="progress">
                              <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 
                              <?php
                                $unresolved = 0;
                                foreach ($bespoke_product_requests as $my_bespoke_product_requests) {
                                  if($my_bespoke_product_requests->status == "Unresolved"){
                                    $unresolved++;
                                  }
                                }  
                                echo $unresolved == 0 ? 0 : ($unresolved/count($bespoke_product_requests)) * 100 ;?>%">
                                <span class="sr-only">50% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $unresolved = 0;
                                foreach ($bespoke_product_requests as $my_bespoke_product_requests) {
                                  if($my_bespoke_product_requests->status == "Unresolved"){
                                    $unresolved++;
                                  }
                                }  
                              ?>
                              {{ $unresolved }} 
                            </span>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                        
                        
                      </div>
                    </div>
                  </div>
                </div>  
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Bespoke product <small>Requests</small></h2>
                  </div>
                  <div class="x_content">
                    
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Avatar</th>
                          <th>Product</th>
                          <th>Price</th>
                          <th>Supplier Name</th>
                          <th>Date Requested</th>
                          <th>Member </th>
                          <th> In charge </th>
                          <th> Status </th>
                          <th></th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach ($bespoke_product_requests as $key => $bespoke_product_request) 
                        <tr>
                        <td>0000{!! $bespoke_product_request->id !!}</td>
                          <td>
                            <div class="profile_pic">
                              <img src="public/{!! $bespoke_product_request->avatar !!}"style="width:60px !important; height:60px;" alt="..." class="img-circle profile_img"/></td>
                            </div>  
                          <td>{!! $bespoke_product_request->name !!}</td>
                          <td>{!! $bespoke_product_request->price !!}</td>
                          <td>{!! $bespoke_product_request->supplier_name !!}</td>
                          <td>{!! $bespoke_product_request->created_at !!}</td>
                          <td>{!! $bespoke_product_request->customer_id !!}</td>
                          <td>
                            <form class="form-horizontal form-label-left" id="updateAdmin<?php echo $key; ?>" method="post" enctype="multipart/form-data" action="admin_bespoke_product_request_update_admin">
                              <select class="select2_single form-control" onchange="updateAdmin({{$key}})"  name="in_charge" tabindex="-1">
                                <option value="{{$bespoke_product_request->in_charge}}" disabled selected>{{$bespoke_product_request->in_charge}}</option> 
                                @foreach ($admins as $admin) 
                                <option value="{{$admin->name}}">{{$admin->name}}</option> 
                                @endforeach
                              </select>  
                              <input type="hidden" name="id" value="{{$bespoke_product_request->id}}" />
                            </form>
                          </td>
                          <td>
                            <form class="form-horizontal form-label-left" id="updateStatus<?php echo $key; ?>" method="post" enctype="multipart/form-data" action="admin_bespoke_product_request_update_status">
                              <select class="select2_single form-control" onchange="updateStatus({{$key}})"  name="status" tabindex="-1">
                                <option style="background: yellow !important;"disabled selected>{!! $bespoke_product_request->status !!}</option>
                                <option value="Pending">Pending</option> 
                                <option value="In Progress">In Progress</option> 
                                <option value="Resolved">Resolved</option>
                                <option value="Unresolved">Unresolved</option> 
                              </select>  
                              <input type="hidden" name="id" value="{{$bespoke_product_request->id}}" />
                            </form>
                          </td>
                          <td>
                            <button class="btn btn-default btn-success source" onclick='openLink(<?php echo json_encode($bespoke_product_request); ?>)' ><i class="fa fa-external-link"></i></button>
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
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            The AffinityClub
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    @include("includes.admin-index-footer-script")
    
  </body>
</html>