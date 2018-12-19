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
                    <div class="x_panel tile" style="height: 180px;">
                      
                      <div class="x_content">
                      <h4><b>Requests Status</b></h4>
                        <div class="widget_summary">
                          <div class="w_left w_25">
                            <span>Pending</span>
                          </div>
                          <div class="w_center w_55">
                            <div class="progress">
                              <div class="progress-bar bg-green" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: 
                              <?php
                                $pending = 0;
                                foreach ($bespoke_travel as $my_bespoke_travel) {
                                  if($my_bespoke_travel->status == 'Pending'){
                                    $pending++;
                                  }
                                }  
                                echo $pending == 0 ? 0 : ($pending/count($bespoke_travel)) * 100 ;?>%">
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
                                foreach ($bespoke_travel as $my_bespoke_travel) {
                                  if($my_bespoke_travel->status == "Pending"){
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
                              <div class="progress-bar bg-green" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 
                              <?php
                                $in_progress = 0;
                                foreach ($bespoke_travel as $my_bespoke_travel) {
                                  if($my_bespoke_travel->status == "In Progress"){
                                    $in_progress++;
                                  }
                                }  
                                echo $in_progress == 0 ? 0 : ($in_progress/count($bespoke_travel)) * 100 ;?>%">
                                <span class="sr-only">50% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $in_progress = 0;
                                foreach ($bespoke_travel as $my_bespoke_travel) {
                                  if($my_bespoke_travel->status == "In Progress"){
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
                            <span>Completed</span>
                          </div>
                          <div class="w_center w_55">
                            <div class="progress">
                              <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 
                              <?php
                                $completed = 0;
                                foreach ($bespoke_travel as $my_bespoke_travel) {
                                  if($my_bespoke_travel->status == "Completed"){
                                    $completed++;
                                  }
                                }  
                                echo $completed == 0 ? 0 : ($completed/count($bespoke_travel)) * 100 ;?>%">
                                <span class="sr-only">60% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $completed = 0;
                                foreach ($bespoke_travel as $my_bespoke_travel) {
                                  if($my_bespoke_travel->status == "Completed"){
                                    $completed++;
                                  }
                                }  
                              ?>
                              {{ $completed }} 
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
                    <h2>BespokeTravel <small>Requests</small></h2>
                  </div>
                  <div class="x_content">
                    
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Member</th>
                          <th>Occassion</th>
                          <th>Created</th>
                          <th>Duration</th>
                          <th>Group Size</th>
                          <th>Date</th>
                          <th>Destination </th>
                          <th>In charge </th>
                          <th>Status </th>
                          <th></th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach ($bespoke_travel as $key=> $bespoke_travel) 
                        <tr>
                          <td>{!! $bespoke_travel->id !!}</td>
                          <td>{!! $bespoke_travel->customer_id !!}</td>
                          <td>{!! $bespoke_travel->occassion !!}</td>
                          <td>{!! $bespoke_travel->created_at !!}</td>
                          <td>{!! $bespoke_travel->duration !!}</td>
                          <td>{!! $bespoke_travel->group_size !!}</td>
                          <td>{!! $bespoke_travel->date !!} {!! $bespoke_travel->time !!}</td>
                          <td>{!! $bespoke_travel->destination !!} </td>
                          <td>
                            <form class="form-horizontal form-label-left" method="post" id="updateAdmin<?php echo $key; ?>" enctype="multipart/form-data" action="admin_bespoke_travel_update_admin">
                              <select class="select2_single form-control" onchange="updateAdmin({{$key}})"  name="in_charge" tabindex="-1">
                                <option value="{{$bespoke_travel->in_charge}}">{{$bespoke_travel->in_charge}}</option> 
                                @foreach ($admins as $admin) 
                                <option value="{{$admin->name}}">{{$admin->name}}</option> 
                                @endforeach
                              </select>  
                              <input type="hidden" name="id" value="{{$bespoke_travel->id}}" />
                            </form>
                          </td>
                          <td>
                            <form class="form-horizontal form-label-left" method="post"  id="updateStatus<?php echo $key; ?>" enctype="multipart/form-data" action="admin_bespoke_travel_update_status">
                              <select class="select2_single form-control"  onchange="updateStatus({{$key}})" name="status" tabindex="-1">
                                <option style="color: yellow !important;">{!! $bespoke_travel->status !!}</option>
                                <option>Pending</option> 
                                <option>In Progress</option> 
                                <option>Completed</option> 
                              </select>  
                              <input type="hidden" name="id" value="{{$bespoke_travel->id}}" />
                            </form>
                          </td>
                          <td>
                            <button class="btn btn-default btn-success source" onclick='openLink(<?php echo json_encode($bespoke_travel); ?>)' ><i class="fa fa-external-link"></i></button>
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
          location.href = "admin_comment/bespoke_travels/"+data.id;
        }
    </script>    
  </body>
</html>