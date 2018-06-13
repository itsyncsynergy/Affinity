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

            @include("includes.admin-absolute-menu")

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
                      @foreach ($group_posts as $key=>$group) 
                      @if($key == 0)
                      <h2>{{$group->group_name}} <small>Posts</small></h2>
                      @endif
                      @endforeach
                    <ul class="nav navbar-right panel_toolbox">
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Avatar</th>
                          <th>Title</th>
                          <th>Post</th>
                          <th>Created </th>
                          <th>Action </th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach ($group_posts as $group) 
                        <tr>
                          <td>
                            <div class="profile_pic">
                              <img src="../public/{{ $group->avatar or 'images/profile.png'}}" style="width:60px !important; height:60px;" alt="..." class="img-circle profile_img">
                            </div>
                          </td>
                          <td>{!! $group->title !!}</td>
                          <td>{!! $group->post !!}</td>
                          <td>{!! $group->created_at !!}</td>
                          <td><a class="btn btn-default btn-success source" href="../admin_group_post_delete/{!! $group->id !!}"><i class="fa fa-pencil"></i>Delete</a></td>
                        </tr>
                      @endforeach  
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-7">
              <div class="x_panel">
                  <div class="x_title">
                    <h2>Post <small>New</small></h2>
                    
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="../admin_group_post_store">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Title</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" name="title" class="form-control" required>
                          <span class="fa fa-tag form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>                      
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Avatar</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="file" class="form-control"  name="avatar" required>
                          <span class="fa fa-file-image-o form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Details</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <textarea type="text" name="post" class="resizable_textarea form-control" required placeholder="Details here..."></textarea>
                        </div>
                      </div>
                      <input type="hidden" name="group_id" class="form-control" value="{!! $id !!}" required>
                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                          <button type="submit" class="btn btn-primary">Cancel</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
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
    @include("includes.admin-absolute-index-footer-script")
    
  </body>
</html>