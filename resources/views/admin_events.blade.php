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
            <div class="col-md-12 col-sm-12 col-xs-12">
                @if(Session::has('error'))
                    <div class="alert alert-danger"> {{Session::get('error')}} </div>
                @endif
                
                @if(Session::has('success'))
                    <div class="alert alert-success"> {{Session::get('success')}} </div>
                @endif
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Events <small>Lists</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      </li>
                      <li class="dropdown">
                        <a href="admin_event_new"><i class="fa fa-plus"></i> New Event</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Avatar</th>
                          <th>Name</th>
                          <th>Type</th>
                          <th>Location</th>
                          <th>Group</th>
                          <th> Start Date </th>
                          <th> End Date </th>
                          <th> Action </th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach ($events as $event) 
                        <tr>
                          <td>
                            <div class="profile_pic">
                              <img src="{{ $event->avatar or 'images/profile.png'}}" style="width:60px !important; height:60px;" alt="..." class="img-circle profile_img">
                            </div>
                          </td>
                          <td>{!! $event->name !!}</td>
                          <td>{!! $event->event_type !!}</td>
                          <td>{!! $event->location !!}</td>
                          <td>{!! $event->group_name !!}</td>
                          <td>{!! $event->date !!}</td>
                          <td>{!! $event->end_date !!}</td>
                          <td>
                            <a class="btn btn-default btn-success source" href="admin_event_edit/{!! $event->event_id !!}"><i class="fa fa-pencil"></i></a>
                             <a class="btn btn-default btn-success source" href="admin_events_view/{!! $event->event_id !!}"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-default btn-danger source" href="admin_event_delete/{!! $event->event_id !!}"><i class="fa fa-trash"></i></a>
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