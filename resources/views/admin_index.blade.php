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
                  <div class="col-md-4">
                    <div class="x_panel tile" style="height: 202px;">
                      
                      <div class="x_content">
                      <h4><b>Airport Concierge  Request Status</b></h4>
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
                                echo ($pending/count($airport_concierge)) * 100 ;?>%">
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
                                echo ($in_progress/count($airport_concierge)) * 100 ;?>%">
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
                                echo ($resolved/count($airport_concierge)) * 100 ;?>%">
                                <span class="sr-only">60% Complete</span>
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
                                echo ($unresolved/count($airport_concierge)) * 100 ;?>%">
                                <span class="sr-only">60% Complete</span>
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
                  <div class="col-md-4">
                    <div class="x_panel tile" style="height: 202px;">
                      
                      <div class="x_content">
                      <h4><b>Bespoke Product  Request Status</b></h4>
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
                                echo ($pending/count($bespoke_product_requests)) * 100 ;?>%">
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
                                echo ($in_progress/count($bespoke_product_requests)) * 100 ;?>%">
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
                              <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 
                              <?php
                                $resolved = 0;
                                foreach ($bespoke_product_requests as $my_bespoke_product_requests) {
                                  if($my_bespoke_product_requests->status == "Resolved"){
                                    $resolved++;
                                  }
                                }  
                                echo ($resolved/count($bespoke_product_requests)) * 100 ;?>%">
                                <span class="sr-only">60% Complete</span>
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
                                foreach ($bespoke_product_requests as $my_bespoke_product_requests) {
                                  if($my_bespoke_product_requests->status == "Unresolved"){
                                    $unresolved++;
                                  }
                                }  
                                echo ($unresolved/count($bespoke_product_requests)) * 100 ;?>%">
                                <span class="sr-only">60% Complete</span>
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
                            </span>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="x_panel tile" style="height: 202px;">
                      
                      <div class="x_content">
                      <h4><b>Bespoke Travel  Request Status</b></h4>
                        <div class="widget_summary">
                          <div class="w_left w_25">
                            <span>Pending</span>
                          </div>
                          <div class="w_center w_55">
                            <div class="progress">
                              <div class="progress-bar bg-blue" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: 
                              <?php
                                $pending = 0;
                                foreach ($bespoke_travel as $my_bespoke_travel) {
                                  if($my_bespoke_travel->status == 'Pending'){
                                    $pending++;
                                  }
                                }  
                                echo ($pending/count($bespoke_travel)) * 100 ;?>%">
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
                              <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 
                              <?php
                                $in_progress = 0;
                                foreach ($bespoke_travel as $my_bespoke_travel) {
                                  if($my_bespoke_travel->status == "In Progress"){
                                    $in_progress++;
                                  }
                                }  
                                echo ($in_progress/count($bespoke_travel)) * 100 ;?>%">
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
                            <span>Resolved</span>
                          </div>
                          <div class="w_center w_55">
                            <div class="progress">
                              <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 
                              <?php
                                $resolved = 0;
                                foreach ($bespoke_travel as $my_bespoke_travel) {
                                  if($my_bespoke_travel->status == "Resolved"){
                                    $resolved++;
                                  }
                                }  
                                echo ($resolved/count($bespoke_travel)) * 100 ;?>%">
                                <span class="sr-only">60% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $resolved = 0;
                                foreach ($bespoke_travel as $my_bespoke_travel) {
                                  if($my_bespoke_travel->status == "Resolved"){
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
                              <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 
                              <?php
                                $unresolved = 0;
                                foreach ($bespoke_travel as $my_bespoke_travel) {
                                  if($my_bespoke_travel->status == "Unresolved"){
                                    $unresolved++;
                                  }
                                }  
                                echo ($unresolved/count($bespoke_travel)) * 100 ;?>%">
                                <span class="sr-only">60% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $unresolved = 0;
                                foreach ($bespoke_travel as $my_bespoke_travel) {
                                  if($my_bespoke_travel->status == "Unresolved"){
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
                <div class="col-md-4">
                    <div class="x_panel tile" style="height: 202px;">
                      
                      <div class="x_content">
                      <h4><b>Flight Bookings  Request Status</b></h4>
                        <div class="widget_summary">
                          <div class="w_left w_25">
                            <span>Pending</span>
                          </div>
                          <div class="w_center w_55">
                            <div class="progress">
                              <div class="progress-bar bg-blue" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: 
                              <?php
                                $pending = 0;
                                foreach ($flight_bookings as $request) {
                                  if($request->status == 'Pending'){
                                    $pending++;
                                  }
                                }  
                                echo ($pending/count($flight_bookings)) * 100 ;?>%">
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
                                foreach ($flight_bookings as $request) {
                                  if($request->status == "Pending"){
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
                                foreach ($flight_bookings as $request) {
                                  if($request->status == "In Progress"){
                                    $in_progress++;
                                  }
                                }  
                                echo ($in_progress/count($flight_bookings)) * 100 ;?>%">
                                <span class="sr-only">50% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $in_progress = 0;
                                foreach ($flight_bookings as $request) {
                                  if($request->status == "In Progress"){
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
                                foreach ($flight_bookings as $request) {
                                  if($request->status == "Resolved"){
                                    $resolved++;
                                  }
                                }  
                                echo ($resolved/count($flight_bookings)) * 100 ;?>%">
                                <span class="sr-only">60% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $resolved = 0;
                                foreach ($flight_bookings as $request) {
                                  if($request->status == "Resolved"){
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
                              <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 
                              <?php
                                $unresolved = 0;
                                foreach ($flight_bookings as $request) {
                                  if($request->status == "Unresolved"){
                                    $unresolved++;
                                  }
                                }  
                                echo ($unresolved/count($flight_bookings)) * 100 ;?>%">
                                <span class="sr-only">60% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $unresolved = 0;
                                foreach ($flight_bookings as $request) {
                                  if($request->status == "Unresolved"){
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
                  <div class="col-md-4">
                    <div class="x_panel tile" style="height: 202px;">
                      
                      <div class="x_content">
                      <h4><b>Global VIP Event  Request Status</b></h4>
                        <div class="widget_summary">
                          <div class="w_left w_25">
                            <span>Pending</span>
                          </div>
                          <div class="w_center w_55">
                            <div class="progress">
                              <div class="progress-bar bg-blue" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: 
                              <?php
                                $pending = 0;
                                foreach ($events as $my_events) {
                                  if($my_events->status == 'Pending'){
                                    $pending++;
                                  }
                                }  
                                if(count($events > 0)){
                                  echo ($pending/count($events)) * 100 ;
                                }  ?>%">
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
                                foreach ($events as $my_events) {
                                  if($my_events->status == "Pending"){
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
                                foreach ($events as $my_events) {
                                  if($my_events->status == "In Progress"){
                                    $in_progress++;
                                  }
                                }
                                if(count($events > 0)){  
                                  echo ($in_progress/count($events)) * 100 ;
                                }  ?>%">
                                <span class="sr-only">50% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $in_progress = 0;
                                foreach ($events as $my_events) {
                                  if($my_events->status == "In Progress"){
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
                                foreach ($events as $my_events) {
                                  if($my_events->status == "Resolved"){
                                    $resolved++;
                                  }
                                }  
                                if(count($events > 0)){
                                  echo ($resolved/count($events)) * 100 ;
                                }  ?>%">
                                <span class="sr-only">60% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $resolved = 0;
                                foreach ($events as $my_events) {
                                  if($my_events->status == "Resolved"){
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
                                foreach ($events as $my_events) {
                                  if($my_events->status == "Unresolved"){
                                    $unresolved++;
                                  }
                                }  
                                if(count($events > 0)){
                                  echo ($unresolved/count($events)) * 100 ;
                                }  ?>%">
                                <span class="sr-only">60% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $unresolved = 0;
                                foreach ($events as $my_events) {
                                  if($my_events->status == "Unresolved"){
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
                  <div class="col-md-4">
                    <div class="x_panel tile" style="height: 202px;">
                      
                      <div class="x_content">
                      <h4><b>Private Parties  Request Status</b></h4>
                        <div class="widget_summary">
                          <div class="w_left w_25">
                            <span>Pending</span>
                          </div>
                          <div class="w_center w_55">
                            <div class="progress">
                              <div class="progress-bar bg-blue" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: 
                              <?php
                                $pending = 0;
                                foreach ($events as $my_events) {
                                  if($my_events->status == 'Pending'){
                                    $pending++;
                                  }
                                }  
                                if(count($events > 0)){
                                  echo ($pending/count($events)) * 100 ;
                                }  ?>%">
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
                                foreach ($events as $my_events) {
                                  if($my_events->status == "Pending"){
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
                                foreach ($events as $my_events) {
                                  if($my_events->status == "In Progress"){
                                    $in_progress++;
                                  }
                                } 
                                if(count($events > 0)){ 
                                  echo ($in_progress/count($events)) * 100 ;
                                }  ?>%">
                                <span class="sr-only">50% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $in_progress = 0;
                                foreach ($events as $my_events) {
                                  if($my_events->status == "In Progress"){
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
                                foreach ($events as $my_events) {
                                  if($my_events->status == "Resolved"){
                                    $resolved++;
                                  }
                                }  
                                if(count($events > 0)){
                                  echo ($resolved/count($events)) * 100 ;
                                }?>%">
                                <span class="sr-only">60% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $resolved = 0;
                                foreach ($events as $my_events) {
                                  if($my_events->status == "Resolved"){
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
                                foreach ($events as $my_events) {
                                  if($my_events->status == "Unresolved"){
                                    $unresolved++;
                                  }
                                }  
                                if(count($events > 0)){
                                  echo ($unresolved/count($events)) * 100 ;
                                }?>%">
                                <span class="sr-only">60% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $unresolved = 0;
                                foreach ($events as $my_events) {
                                  if($my_events->status == "Unresolved"){
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
                  <div class="col-md-4">
                    <div class="x_panel tile" style="height: 202px;">     
                      <div class="x_content">
                      <h4><b>Luxury Experience  Request Status</b></h4>
                        <div class="widget_summary">
                          <div class="w_left w_25">
                            <span>Pending</span>
                          </div>
                          <div class="w_center w_55">
                            <div class="progress">
                              <div class="progress-bar bg-blue" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: 
                              <?php
                                $pending = 0;
                                foreach ($requests as $request) {
                                  if($request->status == 'Pending'){
                                    $pending++;
                                  }
                                }  
                                if(count($requests > 0)){
                                  echo ($pending/count($requests)) * 100 ;
                                }  ?>%">
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
                                foreach ($requests as $request) {
                                  if($request->status == "Pending"){
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
                                foreach ($requests as $request) {
                                  if($request->status == "In Progress"){
                                    $in_progress++;
                                  }
                                } 
                                if(count($requests > 0)){ 
                                  echo ($in_progress/count($requests)) * 100 ;
                                }  ?>%">
                                <span class="sr-only">50% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $in_progress = 0;
                                foreach ($requests as $request) {
                                  if($request->status == "In Progress"){
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
                                foreach ($requests as $request) {
                                  if($request->status == "Resolved"){
                                    $resolved++;
                                  }
                                } 
                                if(count($requests > 0)){ 
                                  echo ($resolved/count($requests)) * 100 ;
                                }  ?>%">
                                <span class="sr-only">60% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $resolved = 0;
                                foreach ($requests as $request) {
                                  if($request->status == "Resolved"){
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
                                foreach ($requests as $request) {
                                  if($request->status == "Unresolved"){
                                    $unresolved++;
                                  }
                                } 
                                if(count($requests > 0)){ 
                                  echo ($unresolved/count($requests)) * 100 ;
                                }  ?>%">
                                <span class="sr-only">60% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $unresolved = 0;
                                foreach ($requests as $request) {
                                  if($request->status == "Unresolved"){
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
                  <div class="col-md-4">
                    <div class="x_panel tile" style="height: 202px;">
                      
                      <div class="x_content">
                      <h4><b>VPA Requests Status</b></h4>
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
                  <div class="col-md-4">
                    <div class="x_panel tile" style="height: 202px;">
                      
                      <div class="x_content">
                      <h4><b>Waitlised Product Requests Status</b></h4>
                        <div class="widget_summary">
                          <div class="w_left w_25">
                            <span>Pending</span>
                          </div>
                          <div class="w_center w_55">
                            <div class="progress">
                              <div class="progress-bar bg-blue" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: 
                              <?php
                                $pending = 0;
                                foreach ($waitlisted_product_requests as $my_waitlisted_product_requests) {
                                  if($my_waitlisted_product_requests->status == 'Pending'){
                                    $pending++;
                                  }
                                }  
                                if(count($waitlisted_product_requests > 0)){
                                  echo ($pending/count($waitlisted_product_requests)) * 100 ;
                                }  ?>%">
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
                                foreach ($waitlisted_product_requests as $my_waitlisted_product_requests) {
                                  if($my_waitlisted_product_requests->status == "Pending"){
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
                                foreach ($waitlisted_product_requests as $my_waitlisted_product_requests) {
                                  if($my_waitlisted_product_requests->status == "In Progress"){
                                    $in_progress++;
                                  }
                                }  
                                if(count($waitlisted_product_requests > 0)){
                                  echo ($in_progress/count($waitlisted_product_requests)) * 100 ;
                                }  ?>%">
                                <span class="sr-only">50% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $in_progress = 0;
                                foreach ($waitlisted_product_requests as $my_waitlisted_product_requests) {
                                  if($my_waitlisted_product_requests->status == "In Progress"){
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
                                foreach ($waitlisted_product_requests as $my_waitlisted_product_requests) {
                                  if($my_waitlisted_product_requests->status == "Resolved"){
                                    $resolved++;
                                  }
                                } 
                                if(count($waitlisted_product_requests > 0)){ 
                                echo ($resolved/count($waitlisted_product_requests)) * 100 ;
                                }?>%">
                                <span class="sr-only">60% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $resolved = 0;
                                foreach ($waitlisted_product_requests as $my_waitlisted_product_requests) {
                                  if($my_waitlisted_product_requests->status == "Resolved"){
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
                                foreach ($waitlisted_product_requests as $my_waitlisted_product_requests) {
                                  if($my_waitlisted_product_requests->status == "Unresolved"){
                                    $unresolved++;
                                  }
                                } 
                                if(count($waitlisted_product_requests > 0)){ 
                                echo ($unresolved/count($waitlisted_product_requests)) * 100 ;
                                }?>%">
                                <span class="sr-only">60% Complete</span>
                              </div>
                            </div>
                          </div>
                          <div class="w_right w_20">
                            <span>
                            <?php
                                $unresolved = 0;
                                foreach ($waitlisted_product_requests as $my_waitlisted_product_requests) {
                                  if($my_waitlisted_product_requests->status == "Unresolved"){
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