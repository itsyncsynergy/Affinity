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
                    <div class="x_panel tile" style="height: 205px;">
                      
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
                                foreach ($airport_concierge as $my_airport_concierge) {
                                  if($my_airport_concierge->status == 'Pending'){
                                    $pending++;
                                  }
                                }  
                                echo $pending == 0 ? 0 : ($pending/count($airport_concierge)) * 100 ;?>%">
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
                                foreach ($airport_concierge as $my_airport_concierge) {
                                  if($my_airport_concierge->status == "Pending"){
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
                                foreach ($airport_concierge as $my_airport_concierge) {
                                  if($my_airport_concierge->status == "In Progress"){
                                    $in_progress++;
                                  }
                                }  
                                echo $in_progress == 0 ? 0 : ($in_progress/count($airport_concierge)) * 100 ;?>%">
                                <span class="sr-only">50% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $in_progress = 0;
                                foreach ($airport_concierge as $my_airport_concierge) {
                                  if($my_airport_concierge->status == "In Progress"){
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
                                foreach ($airport_concierge as $my_airport_concierge) {
                                  if($my_airport_concierge->status == "Resolved"){
                                    $resolved++;
                                  }
                                }  
                                echo $resolved == 0 ? 0 : ($resolved/count($airport_concierge)) * 100 ;?>%">
                                <span class="sr-only">60% Resolved</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $resolved = 0;
                                foreach ($airport_concierge as $my_airport_concierge) {
                                  if($my_airport_concierge->status == "Resolved"){
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
                                foreach ($airport_concierge as $my_airport_concierge) {
                                  if($my_airport_concierge->status == "Unresolved"){
                                    $unresolved++;
                                  }
                                }  
                                echo $unresolved == 0 ? 0 : ($unresolved/count($airport_concierge)) * 100 ;?>%">
                                <span class="sr-only">60% Unresolved</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $unresolved = 0;
                                foreach ($airport_concierge as $my_airport_concierge) {
                                  if($my_airport_concierge->status == "Unresolved"){
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
                    <h2>Airport Concierge <small>Lists</small></h2>
                  </div>
                  <div class="x_content">
                    
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Service</th>
                          {{--<th>Created</th>
                          <th>Airport</th>--}}
                          <th>Member Id</th>
                          <th>Class</th>
                          <th>No of Passengers</th>
                          <th>Date</th>
                          <th>Additional Service </th>
                          <th>In charge </th>
                          <th>Status </th>
                          <th></th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach ($airport_concierge as $key => $airport_concierge) 
                        <tr>
                          <td>0000{!! $airport_concierge->id !!}</td>
                          <td>{!! $airport_concierge->service !!}</td>
                          {{--<td>{!! $airport_concierge->created_at !!}</td>
                          <td>{!! $airport_concierge->airport !!}</td>--}}
                          <td>{!! $airport_concierge->customer_id !!}</td>
                          <td>{!! $airport_concierge->class !!}</td>
                          <td>{!! $airport_concierge->no_of_passengers !!}</td>
                          <td>{!! $airport_concierge->date !!} {!! $airport_concierge->time !!}</td>
                          <td>{!! $airport_concierge->additional_service !!}</td>
                          <td>
                            <form class="form-horizontal form-label-left" method="post" id="updateAdmin<?php echo $key; ?>" enctype="multipart/form-data" action="admin_airport_concierge_update_admin">
                              <select class="select2_single form-control" onchange="updateAdmin({{$key}})"  name="in_charge" tabindex="-1">
                                <option value="{{$airport_concierge->in_charge}}">{{$airport_concierge->in_charge}}</option> 
                                @foreach ($admins as $admin) 
                                <option value="{{$admin->name}}">{{$admin->name}}</option> 
                                @endforeach
                              </select>  
                              <input type="hidden" name="id" value="{{$airport_concierge->id}}" />
                            </form>
                          </td>
                          <td>
                            <form class="form-horizontal form-label-left" method="post"  id="updateStatus<?php echo $key; ?>" enctype="multipart/form-data" action="admin_airport_concierge_update_status">
                              <select class="select2_single form-control"  onchange="updateStatus({{$key}})" name="status" tabindex="-1">
                                <option style="color: yellow !important;">{!! $airport_concierge->status !!}</option>
                                <option>Pending</option> 
                                <option>In Progress</option> 
                                <option>Resolved</option> 
                                <option>Unresolved</option> 
                              </select>  
                              <input type="hidden" name="id" value="{{$airport_concierge->id}}" />
                            </form>
                          </td>
                          <td>
                          <button class="btn btn-default btn-success source" onclick='openLink(<?php echo json_encode($airport_concierge); ?>)' ><i class="fa fa-external-link"></i></button>
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
  <script>
    function openLink(data){
      location.href = "admin_comment/airport_concierges/"+data.id;
    }  
  </script>    
</html>