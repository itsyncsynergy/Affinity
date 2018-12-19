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
                                foreach ($vpas as $vpa) {
                                  if($vpa->status == 'Pending'){
                                    $pending++;
                                  }
                                }  
                                echo ($pending/count($vpas)) * 100 ;?>%">
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
                                foreach ($vpas as $vpa) {
                                  if($vpa->status == "Pending"){
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
                                foreach ($vpas as $vpa) {
                                  if($vpa->status == "In Progress"){
                                    $in_progress++;
                                  }
                                }  
                                echo ($in_progress/count($vpas)) * 100 ;?>%">
                                <span class="sr-only">50% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $in_progress = 0;
                                foreach ($vpas as $vpa) {
                                  if($vpa->status == "In Progress"){
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
                              <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 
                              <?php
                                $resolved = 0;
                                foreach ($vpas as $vpa) {
                                  if($vpa->status == "Resolved"){
                                    $resolved++;
                                  }
                                }  
                                echo ($resolved/count($vpas)) * 100 ;?>%">
                                <span class="sr-only">60% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $resolved = 0;
                                foreach ($vpas as $vpa) {
                                  if($vpa->status == "Resolved"){
                                    $resolved++;
                                  }
                                }  
                              ?>
                              {{ $resolved }} 
                            </span>
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
                              <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 
                              <?php
                                $unresolved = 0;
                                foreach ($vpas as $vpa) {
                                  if($vpa->status == "Unresolved"){
                                    $unresolved++;
                                  }
                                }  
                                echo ($unresolved/count($vpas)) * 100 ;?>%">
                                <span class="sr-only">60% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $unresolved = 0;
                                foreach ($vpas as $vpa) {
                                  if($vpa->status == "Unresolved"){
                                    $unresolved++;
                                  }
                                }  
                              ?>
                              {{ $unresolved }} 
                            </span>
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
                    <h2>VPA <small>Lists</small></h2>
                  </div>
                  <div class="x_content">
                    
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Service</th>
                          <th>Created</th>
                          <th>Delivery Date</th>
                          <th>Delivery Time</th>
                          <th> Name </th>
                          <th> In charge </th>
                          <th> Status </th>
                          <th> Action </th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach ($vpas as $key => $vpa) 
                        <tr>
                          <td>0000{!! $vpa->id !!}</td>
                          <td>{!! $vpa->service !!}</td>
                          <td>{!! $vpa->created_at !!}</td>
                          <td>{!! $vpa->delivery_date !!}</td>
                          <td>{!! $vpa->delivery_time !!}</td>
                          <td>{!! $vpa->customer_id !!} </td>
                          <td>
                            <form class="form-horizontal form-label-left" id="updateAdmin<?php echo $key; ?>" method="post" enctype="multipart/form-data" action="admin_vpa_update_admin">
                              <select class="select2_single form-control" onchange="updateAdmin({{$key}})"  name="in_charge" tabindex="-1">
                                <option value="{{$vpa->in_charge}}" disabled selected>{{$vpa->in_charge}}</option> 
                                @foreach ($admins as $admin) 
                                <option value="{{$admin->name}}">{{$admin->name}}</option> 
                                @endforeach
                              </select>  
                              <input type="hidden" name="id" value="{{$vpa->id}}" />
                            </form>
                          </td>
                          <td>
                            <form class="form-horizontal form-label-left" id="updateStatus<?php echo $key; ?>" method="post" enctype="multipart/form-data" action="admin_vpa_update_status">
                              <select class="select2_single form-control" onchange="updateStatus({{$key}})"  name="status" tabindex="-1">
                                <option style="background: yellow !important;"disabled selected>{!! $vpa->status !!}</option>
                                <option value="Pending">Pending</option> 
                                <option value="In Progress">In Progress</option> 
                                <option value="Resolved">Resolved</option> 
                                <option value="Unresolved">Unresolved</option> 
                              </select>  
                              <input type="hidden" name="id" value="{{$vpa->id}}" />
                            </form>
                          </td>
                          <td>
                            <button class="btn btn-default btn-success source" onclick='openMyModal(<?php echo json_encode($vpa); ?>)' ><i class="fa fa-eye"></i></button>
                            <button class="btn btn-default btn-success source" onclick='openLink(<?php echo json_encode($vpa); ?>)' ><i class="fa fa-external-link"></i></button>
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
    <script>
      function openLink(data){
        location.href = "admin_comment/vpas/"+data.id;
      }  

      var myData;
      function openMyModal(data){
        console.log(data);
        document.getElementById('modal-button').click();
        document.getElementById('title').innerHTML = data.firstname + ' ' + data.lastname  +' - ' + data.customer_id +   ' <p style="color: #b33857;font-size: 12px;font-weight: 600;">Craeted ' + data.created_at +'</p>';
        document.getElementById('body-1').innerHTML = '<h5><b>Expected delivery date: </b></5>' + data.delivery_date + ' ' + data.delivery_time;
        document.getElementById('body-2').innerHTML = data.service;
        document.getElementById('body-12').innerHTML = data.phone;
        document.getElementById('body-3').innerHTML = data.description; 
      }
    </script>

    <button type="hidden" id="modal-button"  data-toggle="modal" data-target="#myModal">Open Modal</button>
  </body>

  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title" style="font-weight: 600;"> </h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <p id="body-1"></p>
              <h5><b>Phone</b></h5>
              <p id="body-12"></p>
              <h5><b>Service Requested</b></h5>
              <p id="body-2"></p>
              <h5><b>Description</b></h5>
              <p id="body-3"></p>
            </div>
          </div>  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
</html>