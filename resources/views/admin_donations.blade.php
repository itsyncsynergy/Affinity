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
        document.getElementById('edit_title').innerHTML = 'Edit ' +data.title;
        document.getElementById('title_input').value = data.title;
        document.getElementById('website_input').value = data.website;
        document.getElementById('post_input').value = data.post;
        document.getElementById('phone_input').value = data.phone;
        document.getElementById('need_input').value = data.needtoknow;
        document.getElementById('category_input').value = data.cate_title;
        document.getElementById('donation_id').value = data.id;
      }

      function openViewModal(data){
        $('#view_modal').modal('show');
        document.getElementById('view_title').innerHTML = 'Details of ' +data.title;
        document.getElementById('title_view').value = data.title;
        document.getElementById('website_view').value = data.website;
        document.getElementById('post_view').value = data.post;
        document.getElementById('phone_view').value = data.phone;
        document.getElementById('need_view').value = data.needtoknow;
        document.getElementById('category_view').value = data.cate_title;
        document.getElementById('donation_id').value = data.id;
      }

      function openDeleteModal(data){
        $('#delete_modal').modal('show');
        document.getElementById('delete_title').innerHTML = 'Delete ' +data.title;
        document.getElementById('title_delete').value = data.title;
        document.getElementById('don_id').value = data.id;
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
                  <div class="x_title">Donation <small>Posts</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Avatar</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Created </th>
                          <th>Action </th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach ($results as $result) 
                        <tr>

                          <td>
                            <div class="profile_pic">
                              <img src="public/{{ $result->avatar or 'images/profile.png'}}" style="width:60px !important; height:60px;" alt="..." class="img-circle profile_img">
                            </div>
                          </td>
                          <td>{!! $result->title !!}</td>
                           <td>{!! $result->cate_title !!}</td>
                          <td>{!! $result->created_at !!}</td>

                         
                          
                          <td><a class="btn btn-default btn-success source" href="javascript:void(0)" onclick='openViewModal(<?php echo json_encode($result); ?>)'><i class="fa fa-eye"></i></a>
                            <a class="btn btn-default btn-success source" href="javascript:void(0)" onclick='openEditModal(<?php echo json_encode($result); ?>)'><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-default btn-danger source" href="admin_donation_delete/{{$result->id}}"><i class="fa fa-trash"></i></a>
                          
                          </td>
                        </tr>
                      @endforeach  
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <!-- Code for adding goes here -->
<div class="row">
              <div class="col-md-7">
              <div class="x_panel">
                  <div class="x_title">
                    <h2>Donation <small>New</small></h2>
                    
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="admin_donation_store">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Title</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" name="title" class="form-control" required>
                          <span class="fa fa-tag form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div> 
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Category</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <select name="category_id" class="form-control">
                            
                            <option>Select Category</option>
                            @foreach ($categories as $category)
                              <option value="{!! $category->category_id !!} ">{!! $category->cate_title !!} </option>
                            @endforeach
                          </select>
                        </div>
                      </div> 
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Website</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" name="website" class="form-control" required>
                          <span class="fa fa-map-tag form-control-feedback right" aria-hidden="true"></span>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Need to Know</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" name="needtoknow" class="form-control" required>
                          <span class="fa fa-tag form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Phone</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" name="phone" class="form-control" required>
                          <span class="fa fa-tag form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Details</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <textarea type="text" name="post" rows="8" class="resizable_textarea form-control" required placeholder="Details here..."></textarea>
                        </div>
                      </div>
                      {{--<input type="hidden" name="donation_id" class="form-control" value="{!! $id !!}" required>--}}
                      <div class="ln_solid"></div>

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
            <!-- Code for adding goes here -->

               
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

  <!-- Edit Modal -->
  <div id="edit_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="edit_title"> </h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="admin_donation_update">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-3">Title</label>
            <div class="col-md-9 col-sm-9 col-xs-9">
              <input type="text" name="title" id="title_input" class="form-control" required/>
              <span class="fa fa-tag form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div>                 
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-3">Website</label>
            <div class="col-md-9 col-sm-9 col-xs-9">
              <input type="text" id="website_input" name="website" class="form-control" required/>
              <span class="fa fa-map-tag form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div> 

          <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Category</label>
              <div class="col-md-9 col-sm-9 col-xs-9">
              <select name="category_id" class="form-control" id="category_input">
                  <option>Select Category </option>
                   @foreach ($categories as $category)
                        <option value="{!! $category->category_id !!} ">{!! $category->cate_title !!} </option>
                   @endforeach
              </select>
          </div>
          </div>   
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-3">Avatar</label>
            <div class="col-md-9 col-sm-9 col-xs-9">
              <input type="file" class="form-control"  name="avatar" />
              <span class="fa fa-file-image-o form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-3">Phone</label>
            <div class="col-md-9 col-sm-9 col-xs-9">
              <input type="text" id="phone_input" name="phone" class="form-control" required/>
              <span class="fa fa-map-tag form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div> 
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-3">Need to Know</label>
            <div class="col-md-9 col-sm-9 col-xs-9">
              <input type="text" id="need_input" name="needtoknow" class="form-control" required/>
              <span class="fa fa-map-tag form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div> 
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-3">Details</label>
            <div class="col-md-9 col-sm-9 col-xs-9">
              <textarea type="text" name="post"  id="post_input" class="resizable_textarea form-control" required placeholder="Details here..."></textarea>
            </div>
          </div>
          <input type="hidden" name="donation_id" id="donation_id" class="form-control">
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

   <!-- View Modal -->

   <div id="view_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="view_title"> </h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-3">Title</label>
            <div class="col-md-9 col-sm-9 col-xs-9">
              <input type="text" name="title" id="title_view" class="form-control" readonly />
              <span class="fa fa-tag form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div>                 
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-3">Website</label>
            <div class="col-md-9 col-sm-9 col-xs-9">
              <input type="text" id="website_view" name="website" class="form-control" readonly />
              <span class="fa fa-map-tag form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div> 

          <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Category</label>
              <div class="col-md-9 col-sm-9 col-xs-9">
              <input type="text" name="" class="form-control" id="category_view" readonly>
          </div>
          </div>   
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-3">Phone</label>
            <div class="col-md-9 col-sm-9 col-xs-9">
              <input type="text" id="phone_view" name="phone" class="form-control" readonly />
              <span class="fa fa-map-tag form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div> 
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-3">Need to Know</label>
            <div class="col-md-9 col-sm-9 col-xs-9">
              <input type="text" id="need_view" name="needtoknow" class="form-control" readonly />
              <span class="fa fa-map-tag form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div> 
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-3">Details</label>
            <div class="col-md-9 col-sm-9 col-xs-9">
              <textarea type="text" name="post" rows="8"  id="post_view" class="resizable_textarea form-control" readonly placeholder="Details here..."></textarea>
            </div>
          </div>
          <input type="hidden" name="donation_id" id="donation_id" class="form-control">
          <div class="ln_solid"></div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete Modal -->

  <div id="delete_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="delete_title"> </h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="admin_donation_delete">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-3">Title</label>
            <div class="col-md-9 col-sm-9 col-xs-9">
              <input type="text" name="title" id="title_delete" class="form-control" readonly />
              <span class="fa fa-tag form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div>   
         
          <input type="hidden" name="donation_id" id="don_id" class="form-control">
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