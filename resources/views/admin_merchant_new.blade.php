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
      function getStates(){
        console.log(document.getElementById('country_id').value);
            $.post("get_state",
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
              <a href="index.html" class="site_title"> <span>The Affinity Club</span></a>
            </div>

            <div class="clearfix"></div>

            @include("includes.admin-menu")

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            


            <div class="row">
            <div class="col-md-10 col-sm-10 col-xs-12">
                  @if(Session::has('error'))
                      <div class="alert alert-danger"> {{Session::get('error')}} </div>
                  @endif
                  
                  @if(Session::has('success'))
                      <div class="alert alert-success"> {{Session::get('success')}} </div>
                  @endif
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Merchant <small>Add</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      </li>
                      <li class="dropdown">
                        <a href="admin_merchants"><i class="fa fa-group"></i> List Partners</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="admin_merchant_store">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Name</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" name="name" class="form-control" required>
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div> 
                      </div>  
                      <div class="col-md-6">     
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Address</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" name="address" class="form-control" required>
                            <span class="fa fa-address-book form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div> 
                      </div>  
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">latitude</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" name="latitude" class="form-control" required>
                            <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div> 
                      </div>   
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">longitude</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" name="longitude" class="form-control" required>
                            <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div>
                      </div>    
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Line 1</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" name="contact" class="form-control" required>
                            <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div>  
                      </div> 

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Line 2</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" name="contact2" class="form-control">
                            <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div>  
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Line 3</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" name="contact3" class="form-control">
                            <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div>  
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Email</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="email" name="email" class="form-control" required>
                            <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div>
                      </div>   
                      <div class="col-md-6"> 
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Category</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <select class="select2_single form-control"  name="category_id" tabindex="-1">
                              @foreach ($categories as $category) 
                              <option value="{{$category->category_id}}">{{$category->name}}</option> 
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
                          <select class="select2_single form-control" onchange="getStates()" id="country_id" name="country" tabindex="-1">
                            <option>Select Country</option>
                            @foreach ($countries as $country) 
                            <option value="{{$country->id}}">{{$country->name}}</option> 
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
                          <select class="select2_single form-control" id="state"  name="state" tabindex="-1">
                            <option> Select States </option>
                          </select>  
                          <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                        </div>
                        </div>
                      </div>  
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">City</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" name="city" class="form-control" required>
                            <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div>  
                      </div>  
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Logo</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="file" class="form-control"  name="avatar" required>
                            <span class="fa fa-file-image-o form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div>
                      </div>  

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Image</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="file" class="form-control"  name="headerImage" required>
                            <span class="fa fa-file-image-o form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Website</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" name="website" class="form-control" required>
                            <span class="fa fa-tag form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div> 
                      </div>  
                      <div class="col-md-6">     
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Username</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" name="username" class="form-control" required>
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div> 
                      </div>  
                      <div class="col-md-9">
                        <div class="form-group">
                          <label class="control-label col-md-2 col-sm-3 col-xs-3">Type</label>
                          <div class="col-md-6 col-sm-9 col-xs-9">
                            <select class="select2_single form-control"  name="type" tabindex="-1">
                              <option value="Privilege">Privilege</option> 
                              <option value="Service">Service</option> 
                            </select>  
                            <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div>
                      </div>  
                      <div class="col-md-9">
                        <div class="form-group">
                          <label class="control-label col-md-2 col-sm-3 col-xs-3">Details</label>
                          <div class="col-md-10 col-sm-9 col-xs-9">
                            <textarea type="text" name="details" id="details"></textarea>
                            
                          </div>
                        </div> 
                      </div>  
                      <div class="col-md-9">
                        <div class="form-group">
                          <label class="control-label col-md-2 col-sm-3 col-xs-3">Bio</label>
                          <div class="col-md-10 col-sm-9 col-xs-9">
                            <textarea type="text" name="bio" id="bio"></textarea>
                            
                          </div>
                        </div>
                      </div>  
                      <div class="col-md-9">
                        <div class="form-group">
                          <label class="control-label col-md-2 col-sm-3 col-xs-3">Need to know</label>
                          <div class="col-md-10 col-sm-9 col-xs-9">
                          <textarea type="text" name="ntk" id="ntk"></textarea>
                            
                          </div>
                        </div> 
                      </div>  
                      
                      
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