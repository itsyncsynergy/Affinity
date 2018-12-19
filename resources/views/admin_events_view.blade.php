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
                  location.href="../admin_delete_event_image/" +id
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
              <div class="col-md-8">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Joined <small>Members</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      </li>
                      <li class="dropdown">
                        <a href="../admin_events"><i class="fa fa-group"></i> List Events</a>
                      </li>
                    </ul>
                    
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
                              <img src="../{{ $joined->customer_avatar or 'images/profile.png'}}" style="width:60px !important; height:60px;" alt="..." class="img-circle profile_img">
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

              <div class="col-md-4">
                   <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel">
                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <h4 class="panel-title">Events Gallery</h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                              @foreach ($gallery as $dGallery) 
                                <div class="col-md-6" style="margin-bottom: 10px;">
                                  <img src="{{ URL::asset($dGallery->avatar) }}" alt="image" style="border: 2px solid #ccc;" height="120px" onclick='deleteImage(<?php echo json_encode($dGallery->id); ?>)'/>
                                </div>                        
                              @endforeach 
                          </div>
                        </div>
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

  </div>

</div>

    @include("includes.admin-absolute-index-footer-script")
  </body>
</html>