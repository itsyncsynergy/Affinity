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
      function openFolder(){
        document.getElementById('avatar').click();
      }

      function submitGallery(){
        document.getElementById('uploadForm').submit();
      }

      function deleteImage(){
        document.getElementById('deleteForm').submit();
      }
       function deleteImage(id){
        console.log(id);
        $.confirm({
          title: '<i class="far fa-trash-alt" style="color: red;"></i> Confirm!',
          content: 'Are you sure you want to delete this image. This action cannot be reversed',
          buttons: {
              Confirm: function () {
                  location.href="../admin_delete_bespoke_image/" +id
              },
              cancel: function () {
                  $.alert('Canceled!');
              }
          }
        });
      }
    </script>  

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><span>The Affinity Club</span></a>
            </div>

            <div class="clearfix"></div>

            @include("includes.admin-absolute-menu")

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            


            <div class="row">
              <div class="col-md-7 col-sm-7 col-xs-12">
                  @if(Session::has('error'))
                      <div class="alert alert-danger"> {{Session::get('error')}} </div>
                  @endif
                  
                  @if(Session::has('success'))
                      <div class="alert alert-success"> {{Session::get('success')}} </div>
                  @endif
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit <small>{!! $bespoke_product->name !!}</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      </li>
                      <li class="dropdown">
                        <a href="../admin_bespoke_products"><i class="fa fa-group"></i> List bespoke_products</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="../admin_bespoke_product_update">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Name</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" name="name" value="{!! $bespoke_product->name !!}" class="form-control" required>
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div> 
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Currency</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <select name="curr" class="form-control">
                            <option value="{!! $bespoke_product->curr !!}">{!! $bespoke_product->curr !!}</option>
                             <option>USD</option>
                            <option>NGN</option>
                          </select>
                        </div>
                      </div> 

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Price</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" name="price" value="{!! $bespoke_product->price !!}" class="form-control number" required>
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div> 
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Supplier Name</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" name="supplier_name" value= "{!! $bespoke_product->supplier_name !!}" class="form-control" required>
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div> 
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Category</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <select class="select2_single form-control"  name="bespoke_product_category_id" tabindex="-1">
                            <option value="{{$bespoke_product->bespoke_product_category_id}}">{{$bespoke_product->category_name}}</option> 
                            @foreach ($categories as $category) 
                            <option value="{{$category->id}}">{{$category->name}}</option> 
                            @endforeach
                          </select>  
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Avatar</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="file" class="form-control"  name="avatar">
                          <span class="fa fa-file-image-o form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Details</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <textarea class="form-control" rows="10" name="details">{!! $bespoke_product->details !!}</textarea>
                        </div>
                      </div> 
                      <input type="hidden" class="form-control" value="{!! $bespoke_product->id !!}"  name="bespoke_product_id">
                      
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
              <div class="col-md-5">
                <div class="row">
                   <div class="x_panel">
                        <div class="x_title">
                            <h2>Tags <small></small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                              </li>
                              <li class="dropdown">
                                <a href="../admin_bespoke_products"><i class="fa fa-group"></i> List Bespoke Product</a>
                              </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form method="post" action="../admin_product_tag_store" class="form-horizontal">
                                <div class="form-group">   
                                  <label class="control-label col-md-3 col-sm-3 col-xs-3">Tags</label>                  
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                      @foreach ($tags as $tag)
                                      <div class="col-md-4">
                                        <div class="checkbox">
                                          <label>
                                            <input type="checkbox" name="tag_id[]" value="{{$tag->group_id}}"> {{$tag->name}}
                                          </label>
                                        </div>
                                      </div>
                                      @endforeach
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" name="bespoke_product_id" value="{!! $bespoke_product->id !!}">
                                <div class="form-group">
                                  <div class="col-md-9 col-md-offset-3">
                                    <button type="submit" class="btn btn-default">Add Tags</button>
                                  </div>
                                </div>
                            </form>
                            <br>
                      
                        </div>

                        <div class="footer">
                          <div class="row">
                            @foreach ($eventTag as $tagged)
                            <div class="col-md-4">
                              <a href="../admin_product_tag_delete/{!! $tagged->group_id !!}/{!! $bespoke_product->id !!}"><i class="fa fa-trash" style="color: rgb(224, 12, 16)"></i> {!! $tagged->name !!}</a>
                            </div>
                            @endforeach
                          </div>
                        </div> 
                   </div>
                </div>

                <div class="x_panel" style="height: 400px;overflow: auto !important;">
                  <div class="x_title">
                    <h2>Gallery <small>{!! $bespoke_product->name !!}</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      </li>
                      <li class="dropdown">
                        <a href="../admin_bespoke_product_categories"><i class="fa fa-group"></i> List bespoke_product_categories</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <form id="uploadForm" action="../admin_upload_bespoke_product_gallery" method="post" enctype="multipart/form-data">
                        <input type="file" id="avatar" style="visibility: hidden;" onchange="submitGallery()" name="avatar">
                        <input type="hidden" class="form-control" value="{!! $bespoke_product->id !!}" name="bespoke_product_id" required>
                      </form>
                      @foreach ($gallery as $dGallery) 
                      <div class="col-md-4" style="margin-bottom: 10px;">
                        <!--<a href="../../affinity/public/delete_group_gallery/{!! $dGallery->id !!}/{!! $dGallery->avatar !!}"><i class="fa fa-trash-alt" style="color: #666;"></i></a>-->
                        <img src="public/{!! $dGallery->avatar !!}" style="border: 2px solid #ccc;" height="120px" onclick='deleteImage(<?php echo json_encode($dGallery->id); ?>)'/>
                      </div>
                      
                      @endforeach   
                    </div>  
                    <div id="new_image_button" onclick="openFolder()">
                      <i class="fa fa-plus add-icon"></i>
                    </div>  
                  </div>
                </div>  
              </div>
            </div>
            {{--<div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Joined <small>Members</small></h2>
                    
                  </div>
                  <div class="x_content">
                    
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Avatar</th>
                          <th>Customer Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Date Joined</th>
                          
                        </tr>
                      </thead>


                      <tbody>
                      @foreach ($members_joined as $joined) 
                        <tr>
                          <td>
                            <div class="profile_pic">
                              <img src="public/{{ $joined->customer_avatar or 'images/profile.png'}}" style="width:60px !important; height:60px;" alt="..." class="img-circle profile_img">
                            </div>
                          </td>
                          <td>{!! $joined->firstname !!} {!! $joined->lastname !!}</td>
                          <td>{!! $joined->phone !!}</td>
                          <td>{!! $joined->email !!}</td>
                          <td>{!! $joined->created_at !!}</td>
                        </tr>
                      @endforeach  
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>  
            </div> --}}
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

  <script>
      var el = document.querySelector('input.number');

      el.addEventListener('keyup', function(event){
        if (event.which >= 37 && event.which <= 40) 
          return;

        this.value = this.value.replace(/\D/g,'').replace(/\B(?=(\d{3})+(?!\d))/g,',');
      });
    </script>
</html>