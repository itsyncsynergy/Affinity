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
      function openEditModal(data){
        $('#edit_modal').modal('show');
        document.getElementById('edit_title').innerHTML = 'Edit ' +data.cate_title;
        document.getElementById('title_input').value = data.cate_title;
        document.getElementById('category_id').value = data.category_id;
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
                <div class="x_panel">
                  <div class="x_title">VIP Event Ticket Categories <small>Lists</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>S/N</th>
                          <th>Category Name</th>
                          <th>Created </th>
                          <th>Action </th>
                        </tr>
                      </thead>


                      <tbody>
                            @foreach ($categories as $category) 
                        <tr>
                          <td>{!! $category->category_id !!}</td>
                          <td>{!! $category->cate_title !!}</td>
                          <td>{!! $category->created_at !!}</td>
                          <td><a class="btn btn-default btn-success source" href="javascript:void(0)" onclick='openEditModal(<?php echo json_encode($category); ?>)'><i class="fa fa-pencil"></i></a>
                          <a class="btn btn-default btn-danger source" href="admin_vipcategories_delete/{!! $category->category_id !!}"><i class="fa fa-trash"></i></a>
                          </td>
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
                    <h5>Add Category</h5>
                    
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="admin_vipcategories_store">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Title</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" name="title" class="form-control" required>
                          <span class="fa fa-tag form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>  

                      <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                          
                          <button type="submit" class="btn btn-success btn-block">Submit</button>
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

  <div id="edit_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="edit_title"> </h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="admin_vipcategories_update">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-3">Title</label>
            <div class="col-md-9 col-sm-9 col-xs-9">
              <input type="text" name="title" id="title_input" class="form-control" required/>
              <span class="fa fa-tag form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div>                 
          
          <input type="hidden" name="category_id" id="category_id" class="form-control">
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