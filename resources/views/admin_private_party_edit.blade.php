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

      function getStates(){
        console.log(document.getElementById('country_id').value);
            $.post("../get_state",
            {
                country_id: document.getElementById('country_id').value
            },
            function(data, status){
              console.log(data);

              $('#state').find('option').not(':first').remove();

              $.each(data.states, function(i, d) {
                $('#state').append('<option value="' + d.name + '">' + d.name + '</option>');
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
                    <h2>Edit <small>{!! $event->title !!}</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      </li>
                      <li class="dropdown">
                        <a href="../admin_events"><i class="fa fa-group"></i> List Events</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="../admin_private_party_update">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Title</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" name="title"  value="{!! $event->title !!}" class="form-control" required>
                          <span class="fa fa-bookmark form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div> 
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Category</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <select class="select2_single form-control" id="category_id" name="category_id" tabindex="-1">
                            <option value="{{$event->categoryID}}">{{$event->cate_title}}</option> 
                            @foreach ($categories as $category) 
                            <option value="{{$category->category_id}}">{{$category->cate_title}}</option> 
                            @endforeach
                          </select>  
                          <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Country</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <select class="select2_single form-control" onchange="getStates()" id="country_id" name="country" tabindex="-1">
                            <option value="{{$event->countryID}}">{{$event->countryName}}</option> 
                            @foreach ($countries as $country) 
                            <option value="{{$country->id}}">{{$country->name}}</option> 
                            @endforeach
                          </select>  
                          <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">State</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <select class="select2_single form-control" id="state"  name="state" tabindex="-1">
                            <option value="{{$event->state}}">{{$event->state}}</option> 
                            <option> Select States </option>
                          </select>  
                          <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">City</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" name="city"  value="{!! $event->city !!}" class="form-control" required>
                          <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>  
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Capacity</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="number" name="capacity" value="{!! $event->capacity !!}" class="form-control" required>
                          <span class="fa fa-tag form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>  
                      <fieldset>
                        <div class="control-group">
                          <div class="controls">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Start & End Date</label>
                            <div class="input-prepend input-group col-md-9 col-sm-9 col-xs-9">
                              <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                              <input type="text" name="date" id="reservation-time"  value="{!! $event->date !!} - {!! $event->end_date !!}" class="form-control" />
                            </div>
                          </div>
                        </div>
                      </fieldset> 
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
                          <textarea type="text" name="details"> {!! $event->details !!}</textarea>
                        </div>
                      </div>
                      <input type="hidden" class="form-control" value="{!! $event->id !!}" name="id" required>
                      
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
                <div class="x_panel" style="height: 534px;overflow: auto !important;">
                  <div class="x_title">
                    <h2>Gallery <small>{!! $event->title !!}</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      </li>
                      <li class="dropdown">
                        <a href="../admin_private_parties"><i class="fa fa-calendar"></i> List Private Parties</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <form id="uploadForm" action="../admin_upload_private_party_gallery" method="post" enctype="multipart/form-data">
                        <input type="file" id="avatar" style="visibility: hidden;" onchange="submitGallery()" name="avatar">
                        <input type="hidden" class="form-control" value="{!! $event->id !!}" name="event_id" required>
                      </form>
                      @foreach ($gallery as $dGallery) 
                      <div class="col-md-4" style="margin-bottom: 10px;">
                        {{--<a href="../../affinity/public/delete_group_gallery/{!! $dGallery->id !!}/{!! $dGallery->avatar !!}"><i class="fa fa-trash-alt" style="color: #666;"></i></a>--}}
                        <img src="../public/{!! $dGallery->image !!}" style="border: 2px solid #ccc;" height="120px"/>
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
                    <h2>Requests</h2>
                    
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
            </div>  --}}
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