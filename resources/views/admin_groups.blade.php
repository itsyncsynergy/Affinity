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
                    <h2>Group <small>Lists</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      </li>
                      <li class="dropdown">
                        <a href="admin_group_new"><i class="fa fa-plus"></i> New Group</a>
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
                          <th>Head</th>
                          <th> Created </th>
                          <th> Action </th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach ($groups as $group) 
                        <tr>
                          <td>
                            <div class="profile_pic">
                              <img src="public/{{ $group->avatar or 'images/profile.png'}}" style="width:60px !important; height:60px;" alt="..." class="img-circle profile_img">
                            </div>
                          </td>
                          <td>{!! $group->name !!}</td>
                          <td>{!! $group->admin_name !!}</td>
                          <td>{!! $group->created_at !!}</td>
                          <td>
                            <a class="btn btn-default btn-primary source" href="admin_group_edit/{!! $group->group_id !!}"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-default btn-success source" href="admin_group_view/{!! $group->group_id !!}"><i class="fa fa-eye"></i></a> 
                            <a class="btn btn-default btn-danger source" href="admin_group_delete/{!! $group->group_id !!}"><i class="fa fa-trash"></i></a>                          
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
        document.getElementById('title').innerHTML = data.name + '   <p style="color: #b33857;font-size: 12px;font-weight: 600;">Craeted ' + data.created_at +'</p>';
        document.getElementById('body-1').innerHTML = '<img src="public/' + data.avatar + '"  style="width:100% !important; height:auto;" >';
        document.getElementById('body-2').innerHTML = data.details; 
      }

    </script>


    <button type="hidden" id="modal-button" data-toggle="modal" data-target="#myModal">Open Modal</button>
    
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
                <h4>Details</h4>
                <p id="body-2"></p>
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