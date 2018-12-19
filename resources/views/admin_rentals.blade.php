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
                    <h2>Luxury Rentals <small>Lists</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      </li>
                      <li class="dropdown">
                        <a href="admin_rental_new"><i class="fa fa-plus"></i> New Luxury Rental</a>
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
                          <th>Location</th>
                          <th>Price From</th>
                          <th>Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach ($rentals as $rental) 
                        <tr>
                          <td>
                            <div class="profile_pic">
                              <img src="{{ $rental->avatar or 'images/profile.png'}}" style="width:60px !important; height:60px;" alt="..." class="img-circle profile_img">
                            </div>
                          </td>
                          <td>{!! $rental->name !!}</td>
                          <td>{!! $rental->countryName !!} {!! $rental->state !!}</td>
                          <td>{!! $rental->price !!}</td>
                          <td>{!! $rental->start_date !!} to {!! $rental->end_date !!}</td>
                          <td>
                            <a class="btn btn-default btn-success source" href="admin_rental_edit/{!! $rental->id !!}"><i class="fa fa-pencil"></i></a>
                            <button class="btn btn-default btn-success source" onclick='openMyModal(<?php echo json_encode($rental); ?>)' ><i class="fa fa-eye"></i></button>
                            <button class="btn btn-default btn-danger" onclick='openDeleteModal(<?php echo json_encode($rental); ?>)' ><i class="fa fa-trash"></i></button>
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
      var myData;
      function openMyModal(data){
        document.getElementById('modal-button').click();
        document.getElementById('title').innerHTML = data.name + ' <p style="color: #b33857;font-size: 12px;font-weight: 600;">From ' + data.start_date + ' To ' + data.end_date +'</p>';
        document.getElementById('body-1').innerHTML = '<img src="public/' + data.avatar + '"  style="width:100% !important; height:auto;" >';
        document.getElementById('body-2').innerHTML = data.details;
        document.getElementById('body-3').innerHTML = data.overview; 
        document.getElementById('body-4').innerHTML = data.ntk;
        document.getElementById('body-5').innerHTML = data.venue + ', ' + data.state + ', ' + data.country;
        document.getElementById('body-6').innerHTML = '<p style="color: #b33857;">From N' + data.price + '</p>';
      }

      function openDeleteModal(data){
        $('#delete_modal').modal('show');
        document.getElementById('event_title').innerHTML = 'Delete ' +data.name;
        document.getElementById('event_delete').value = data.name;
        document.getElementById('event_id').value = data.id;
      }
    </script>

    <button type="hidden" id="modal-button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
    
  </body>

  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title"> </h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-3">
              <div id="body-1"></div>
            </div>
            <div class="col-md-9">
                <p id="body-6"></p>
                <h4>Location</h4>
                <p id="body-5"></p>
                <h4>Details</h4>
                <p id="body-2"></p>
                <h4>Overview</h4>
                <p id="body-3"></p>
                <h4>Need To Know</h4>
                <p id="body-4"></p>
            </div>
          </div>  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

  <div id="delete_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="event_title"> </h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="admin_rental_delete">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-3">Title</label>
            <div class="col-md-9 col-sm-9 col-xs-9">
              <input type="text" name="rental_title" id="event_delete" class="form-control" readonly />
              <span class="fa fa-tag form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div>   
         
          <input type="hidden" name="rental_id" id="event_id" class="form-control">
          <div class="ln_solid"></div>

          <div class="form-group">
            <div class="col-md-9 col-md-offset-3">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</html>