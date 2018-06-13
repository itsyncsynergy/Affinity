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
      function check(){
        var date = document.getElementById('mult').val();
        console.log(date);
      }  
      function openFolder(){
        document.getElementById('avatar').click();
      }

      function submitGallery(){
        document.getElementById('uploadForm').submit();
      }

      function deleteImage(){
        document.getElementById('deleteForm').submit();
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
                    <h2>{!! $merchant->name !!}<small>Add offer</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      </li>
                      <li class="dropdown">
                        <a href="../../affinity/admin_merchants_offers"><i class="fa fa-tag"></i> List Offers</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="../admin_offer_store">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Offer Type</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <select class="select2_single form-control" id="offer_type"  name="offer_type" tabindex="-1">
                            <option>Percentage discount</option> 
                            <option>Amount discount</option> 
                            <option>Complementary</option> 
                          </select>  
                          <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Offer</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" name="offer_name" class="form-control" required>
                          <span class="fa fa-tag form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>    
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Tagline</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" name="tagline" class="form-control" required>
                          <span class="fa fa-tag form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>    
                      
                      
                      <fieldset>
                        <div class="control-group">
                          <div class="controls">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Start & End Date</label>
                            <div class="input-prepend input-group col-md-9 col-sm-9 col-xs-9">
                              <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                              <input type="text" name="date" id="reservation-time" class="form-control" value="01/01/2016 - 01/25/2016" />
                            </div>
                          </div>
                        </div>
                      </fieldset> 
                      <div class="form-group" >   
                      <label class="control-label col-md-3 col-sm-3 col-xs-3">Target Members</label>                  
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="target_members[]" value="Essence"> Essence
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="target_members[]" value="Business Classic"> Business Classic
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="target_members[]" value="Premium"> Premium
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="target_members[]" value="Business X"> Business X
                            </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="target_members[]" value="Luxe"> Luxe
                            </label>
                          </div>
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
                          <textarea type="text" name="details" class="resizable_textarea form-control" required placeholder="Details here..."></textarea>
                        </div>
                      </div>
                      <input type="hidden" class="form-control" value="{!! $merchant->merchant_id !!}" name="merchant_id" required>
                      
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