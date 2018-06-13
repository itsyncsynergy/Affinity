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

      function deleteImage(id){
        console.log(id);
        $.confirm({
          title: '<i class="far fa-trash-alt" style="color: red;"></i> Confirm!',
          content: 'Are you sure you want to delete this image. This action cannot be reversed',
          buttons: {
              Confirm: function () {
                  location.href="../admin_delete_merchant_image/" +id
              },
              cancel: function () {
                  $.alert('Canceled!');
              }
          }
        });
      }

      
    </script>  
    <script>
      function getStates(){
        $('#state').empty();
        console.log(document.getElementById('country').value);
            $.post("../get_state",
            {
                country: document.getElementById('country').value
            },
            function(data, status){
              console.log(data);
              $.each(data.states, function(i, d) {
                $('#state').append('<option value="' + d.state + '">' + d.state + '</option>');
              });
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
              <a href="index.html" class="site_title"> <span>The Affinity Club</span></a>
            </div>

            <div class="clearfix"></div>

            @include("includes.admin-absolute-menu")

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            


            <div class="row">
              <div class="col-md-8 col-sm-8 col-xs-12">
                  @if(Session::has('error'))
                      <div class="alert alert-danger"> {{Session::get('error')}} </div>
                  @endif
                  
                  @if(Session::has('success'))
                      <div class="alert alert-success"> {{Session::get('success')}} </div>
                  @endif
                <div class="x_panel">
                  <div class="x_title">
                    <h4>Merchant <small>Edit</small></h4>
                    <ul class="nav navbar-right panel_toolbox">
                      </li>
                      <li class="dropdown">
                        <a href="../admin_merchants"><i class="fa fa-group"></i> List Partners</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="../admin_merchant_update">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Name</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" name="name" class="form-control" value="{!! $merchant->name !!}" required>
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div> 
                      </div>  
                      <div class="col-md-6">     
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Address</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" name="address" class="form-control" value="{!! $merchant->address !!}" required>
                            <span class="fa fa-address-book form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div> 
                      </div>  
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">latitude</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" name="latitude" class="form-control" value="{!! $merchant->latitude !!}" required>
                            <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div> 
                      </div>   
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">longitude</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" name="longitude" class="form-control" value="{!! $merchant->longitude !!}" required>
                            <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div>
                      </div>    
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Phone</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" name="contact" class="form-control" value="{!! $merchant->contact !!}" required>
                            <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div>  
                      </div>  
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Email</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="email" name="email" class="form-control" value="{!! $merchant->email !!}" required>
                            <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div>
                      </div>   
                      <div class="col-md-6"> 
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Category</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <select class="select2_single form-control"  name="category_id" tabindex="-1">
                            <option value="{{$merchant->category_id}}">{{$merchant->category_id}}</option>
                              @foreach ($categories as $category) 
                              <option value="{{$category->name}}">{{$category->name}}</option> 
                              @endforeach
                            </select>  
                            <span class="fa fa-tag form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div>
                      </div>  
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Country</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <select class="select2_single form-control" onchange="getStates()" id="country" name="country" tabindex="-1">
                            <option value="{{$merchant->country}}">{{$merchant->country}}</option> 
                              @foreach ($countries as $country) 
                              <option value="{{$country->country}}">{{$country->country}}</option> 
                              @endforeach
                            </select>  
                            <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div>
                      </div> 
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">State</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <select class="select2_single form-control"  name="state" tabindex="-1">
                            <option value="{{$merchant->state}}">{{$merchant->state}}</option> 
                              {{--@foreach ($states as $state) 
                              <option value="{{$state->state}}">{{$state->state}}</option> 
                              @endforeach --}}
                            </select>  
                            <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div>
                      </div>  
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">City</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" name="city" class="form-control" value="{!! $merchant->city !!}" required>
                            <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div>  
                      </div>  
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Avatar</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="file" class="form-control" name="avatar">
                            <span class="fa fa-file-image-o form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div>
                      </div>  
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Website</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" name="website" class="form-control" value="{!! $merchant->website !!}" required>
                            <span class="fa fa-tag form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div> 
                      </div>  
                      <div class="col-md-6">     
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Details</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" name="details" class="form-control" value="{!! $merchant->details !!}" required>
                            <span class="fa fa-address-book form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div> 
                      </div>  
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Type</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <select class="select2_single form-control"  name="type" tabindex="-1">
                              <option value="Privilege">Privilege</option> 
                              <option value="Service">Service</option> 
                            </select>  
                            <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div>
                      </div>  
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Bio</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <textarea type="text" name="bio" class="resizable_textarea form-control" required placeholder="Bio here...">{!! $merchant->bio !!}</textarea>
                            <span class="fa fa-tag form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div>
                      </div>  
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Need to know</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                          <textarea type="text" name="ntk" class="resizable_textarea form-control" required placeholder="Need to know here...">{!! $merchant->ntk !!}</textarea>
                            <span class="fa fa-tag form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div> 
                      </div>  
                      <input type="hidden" name="merchant_id" value="{!! $merchant->merchant_id !!}"/>
                      
                      
                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="submit" class="btn btn-primary">Cancel</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="x_panel" style="height: 440px;overflow: auto !important;">
                  <div class="x_title">
                    <h4>Gallery <small>{!! $merchant->name !!}</small></h4>
                    <ul class="nav navbar-right panel_toolbox">
                      </li>
                      <li class="dropdown">
                        <a href="../admin_merchants"><i class="fa fa-shopping-cart"></i> List Partnerss</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <form id="uploadForm" action="../admin_upload_merchant_gallery" method="post" enctype="multipart/form-data">
                        <input type="file" id="avatar" style="visibility: hidden;" onchange="submitGallery()" name="avatar">
                        <input type="hidden" class="form-control" value="{!! $merchant->id !!}" name="merchant_id" required>
                      </form>
                      @foreach ($gallery as $dGallery) 
                      <div class="col-md-6" style="margin-bottom: 10px;">
                        <img src="../public/{!! $dGallery->avatar !!}" style="border: 2px solid #ccc;" height="120px" onclick='deleteImage(<?php echo json_encode($dGallery->id); ?>)'/>
                      </div>
                      
                      @endforeach   
                    </div>  
                    <div id="new_image_button" onclick="openFolder()">
                      <i class="fa fa-plus add-icon"></i>
                    </div>  
                  </div>
                </div> 
              </div>  
              <div class="x_panel">
                <div class="x_title">
                  <h2>{!! $merchant->name !!} <small>Offers</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    </li>
                    <li class="dropdown">
                      <a href="../admin_offer_new/{!!$merchant->merchant_id !!}"><i class="fa fa-plus"></i> New Offer</a>
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
                        <th>Tag Line</th>
                        <th>Details</th>
                        <th>Start Date </th>
                        <th>End Date </th>
                        <th>Tartget Members </th>
                        <th>Action </th>
                      </tr>
                    </thead>


                    <tbody>
                    @foreach ($offers as $offer) 
                      <tr>
                        <td>
                          <div class="profile_pic">
                            <img src="../public/{{ $offer->avatar or 'images/profile.png'}}" style="width:60px !important; height:60px;" alt="..." class="img-circle profile_img">
                          </div>
                        </td>
                        <td>{!! $offer->offer_name !!}% discount</td>
                        <td>{!! $offer->tagline !!}</td>
                        <td>{!! $offer->details !!}</td>
                        <td>{!! $offer->start_date !!}</td>
                        <td>{!! $offer->end_date !!}</td>
                        <td>{!! $offer->target_members !!}</td>
                        <td><a class="btn btn-default btn-success source" href="../admin_offer_edit/{!! $offer->offer_id !!}"><i class="fa fa-pencil"></i>Edit</a></td>
                      </tr>
                    @endforeach  
                    </tbody>
                  </table>
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