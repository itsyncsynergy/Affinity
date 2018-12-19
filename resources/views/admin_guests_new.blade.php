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
      function getCodes(){
        console.log(document.getElementById('country_id').value);
            $.post("get_code",
            {
                country_id: document.getElementById('country_id').value
            },
            function(data, status){
              console.log(data);

              $('#code').find('option').not(':first').remove();
              
              $.each(data.codes, function(i, d) {
                $('#code').append('<option value="' + d.phonecode + '">' + d.phonecode + '</option>');
               
              });

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
              <a href="index.html" class="site_title"> <span>The Affinity Club</span></a>
            </div>

            <div class="clearfix"></div>

            @include("includes.admin-menu")

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            


            <div class="row">
            <div class="col-md-9 col-sm-9 col-xs-12">
                  @if(Session::has('error'))
                      <div class="alert alert-danger"> {{Session::get('error')}} </div>
                  @endif
                  
                  @if(Session::has('success'))
                      <div class="alert alert-success"> {{Session::get('success')}} </div>
                  @endif
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Guest <small>Users</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      </li>
                      <li class="dropdown">
                        <a href="admin_guests"><i class="fa fa-group"></i> List Guest Users</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="admin_guests_store">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">First Name</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" name="firstname" class="form-control" required>
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Last Name</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" name="lastname" class="form-control" required>
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Password</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" name="password" class="form-control" required>
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Gender</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <select class="select2_single form-control"  name="sex" tabindex="-1" required>
                            <option>Male</option> 
                            <option>Female</option>
                          </select>  
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Membership</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <select class="select2_single form-control"  name="membership" tabindex="-1">
                            <option value="">Select Membership</option>
                            <option>Essence</option> 
                            <option>Premium</option>
                            <option>Luxe</option>
                          </select>  
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Country</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <select class="select2_single form-control" onchange="getCodes()" id="country_id"  name="country_id" tabindex="-1">
                            <option>Select Country</option>
                            @foreach ($countries as $country)
                            <option value="{{$country->id}}">{{$country->name}}</option> 
                            @endforeach
                            
                          </select>  
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">State</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <select class="select2_single form-control" id="state"  name="state" tabindex="-1">
                            <option> Select States </option>
                          </select> 
                          <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>

                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-6 col-sm-6 col-xs-6">Code</label>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                              <select class="select2_single form-control" id="code"  name="code" tabindex="-1">
                                <option>Country Code</option>
                              </select> 
                            </div>
                          </div>
                      </div>
                      
                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Phone</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                              <input type="number" name="phone" class="form-control" required>
                              <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                            </div>
                          </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Email</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="email"  name="email" class="form-control" required>
                          <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Address</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" name="address" class="form-control" required>
                          <span class="fa fa-address-book form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                    
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Profile Photo</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="file" class="form-control"  name="avatar" required>
                          <span class="fa fa-file-image-o form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                          <a href="admin_guests" class="btn btn-default"> Cancel</a>
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
    @include("includes.admin-index-footer-script")
  </body>
</html>