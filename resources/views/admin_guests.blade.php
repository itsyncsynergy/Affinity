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

    <style>
      p{
        font-weight: 400 !important;
      }  
    </style>  
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
                    <h2>Guests Users <small>Lists</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li class="dropdown">
                        <a href="admin_guests_new"><i class="fa fa-plus"></i> New Guest User</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @if ($user->admin_type != 'Customer Service' && $user->admin_type != 'Supervisor')
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Avatar</th>
                          <th>Name</th>
                          <th>Id</th>
                          <th>Email</th>
                          <th> Created </th>
                          <th>Status</th>
                          <th> Action </th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach ($customers as $customer) 
                        <tr>
                          <td>
                            <div class="profile_pic">
                              <img src="public/{{ $customer->avatar or 'images/profile.png'}}" style="width:60px !important; height:60px;" alt="..." class="img-circle profile_img">
                            </div>
                          </td>
                          <td>{!! $customer->firstname !!} {!! $customer->lastname !!}</td>
                          <td>{!! $customer->customer_id !!}</td>
                          <td>{!! $customer->email !!}</td>
                          <td>{!! $customer->created_at !!}</td>

                          @if($customer->status == 1)
                          <td style="color: #0f0;">Activated</td>
                          <td><a class="btn btn-default btn-danger source"  href="guest_deactivate_account/{!! $customer->id !!}">Deactivate</button></a>
                          <a class="btn btn-default btn-primary source" href="admin_subscription_create/{{$customer->customer_id}}"><i class="fa fa-pencil"></i></a>
                          <button class="btn btn-default btn-success source" onclick='openMyModal(<?php echo json_encode($customer); ?>)' ><i class="fa fa-eye"></i></button>

                            <a class="btn btn-default btn-danger source" href="admin_guests_delete/{{$customer->customer_id}}"><i class="fa fa-trash"></i></a>
                            
                          </td>
                          @endif
                          @if($customer->status != 1)
                          <td style="color: #f00;">Deactivated</td>
                          <td><a class="btn btn-default btn-success source" href="guest_activate_account/{!! $customer->id !!}">Activate</a>
                          <a class="btn btn-default btn-primary source" href="admin_subscription_create/{{$customer->customer_id}}"><i class="fa fa-pencil"></i></a>
                          <button class="btn btn-default btn-success source" onclick='openMyModal(<?php echo json_encode($customer); ?>)' ><i class="fa fa-eye"></i></button>

                            <a class="btn btn-default btn-danger source" href="admin_guests_delete/{{$customer->customer_id}}"><i class="fa fa-trash"></i></a>
                            
                            </td>
                          @endif
                          
                        </tr>
                      @endforeach  
                      </tbody>
                    </table>
                    @endif

                     @if ($user->admin_type == 'Customer Service')
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap">
                      <thead>
                        <tr>
                          <th>Avatar</th>
                          <th>Name</th>
                          <th>Id</th>
                        </tr>
                      </thead>

                      <tbody>
                      @foreach ($customers as $customer) 
                        <tr>
                          <td>
                            <div class="profile_pic">
                              <img src="public/{{ $customer->avatar or 'images/profile.png'}}" style="width:60px !important; height:60px;" alt="..." class="img-circle profile_img">
                            </div>
                          </td>
                          <td>{!! $customer->firstname !!} {!! $customer->lastname !!}</td>
                          <td>{!! $customer->customer_id !!}</td>
 
                        </tr>
                      @endforeach  
                      </tbody>
                    </table>
                    @endif

                     @if ($user->admin_type == 'Supervisor')
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap">
                      <thead>
                        <tr>
                          <th>Avatar</th>
                          <th>Name</th>
                          <th>Id</th>
                          <th>Phone</th>
                          <th>Email</th>
                        </tr>
                      </thead>

                      <tbody>
                      @foreach ($customers as $customer) 
                        <tr>
                          <td>
                            <div class="profile_pic">
                              <img src="public/{{ $customer->avatar or 'images/profile.png'}}" style="width:60px !important; height:60px;" alt="..." class="img-circle profile_img">
                            </div>
                          </td>
                          <td>{!! $customer->firstname !!} {!! $customer->lastname !!}</td>
                          <td>{!! $customer->customer_id !!}</td>
                          <td>{!! $customer->phone !!}</td>
                          <td>{!! $customer->email !!}</td>
 
                        </tr>
                      @endforeach  
                      </tbody>
                    </table>
                    @endif
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
        document.getElementById('title').innerHTML = data.firstname + '  ' +  data.lastname + '<span style="color: #b33857;font-size: 12px;font-weight: 600;"> '+data.customer_id+'</span> <p style="color: #b33857;font-size: 12px;font-weight: 600;">' + data.sex + '</p>';
        document.getElementById('body-1').innerHTML = '<img src="public/' + data.avatar + '"  style="width:100% !important; height:auto;" >';
        document.getElementById('body-2').innerHTML = data.address; 
        document.getElementById('body-3').innerHTML = data.phone;
        document.getElementById('body-4').innerHTML = data.email; 
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
                <h5><b>Address<b/></h4>
                <p id="body-2"></p>
                <h5><b>Phone<b/></h4>
                <p id="body-3"></p>
                <h5><b>Email<b/></h4>
                <p id="body-4"></p>
          </div>  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
</html>