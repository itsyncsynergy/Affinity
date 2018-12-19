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
              <div class="col-md-8 col-sm-8 col-xs-12">
                  @if(Session::has('error'))
                      <div class="alert alert-danger"> {{Session::get('error')}} </div>
                  @endif
                  
                  @if(Session::has('success'))
                      <div class="alert alert-success"> {{Session::get('success')}} </div>
                  @endif
                <div class="x_panel">
                  <div class="x_title">
                    <h4>Offer <small>Edit</small></h4>
                    <ul class="nav navbar-right panel_toolbox">
                      </li>
                      <li class="dropdown">
                        <a href="../admin_merchants_offers"><i class="fa fa-group"></i> List Offers</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="../admin_offer_update">
                      @foreach ($offermerchant as $offer)
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Merchant</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" name="merchant_name" value="{!!$offer->name !!}" class="form-control" readonly>
                          <span class="fa fa-tag form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Offer Type</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <select class="select2_single form-control" id="offer_type"  name="offer_type" tabindex="-1">
                            <option>{!!$offer->offer_type !!}</option>
                            <option>Percentage discount</option> 
                            <option>Amount discount</option> 
                            <option>Complementary</option> 
                          </select>  
                          <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Offer(Number only</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="number" name="offer_name" value="{!!$offer->offer_name !!}" placeholder="Ex: 10 for 10% discount" class="form-control" required>
                          <span class="fa fa-tag form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>    
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Tagline</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" name="tagline" value="{!!$offer->tagline !!}" class="form-control" required>
                          <span class="fa fa-tag form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>    
                      
                      
                      <div class="form-group" > 
                        <div class="control-group">
                          <div class="controls">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Start & End Date</label>
                            <div class="input-prepend input-group col-md-9 col-sm-9 col-xs-9">
                              <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                              <input type="text" name="date" id="reservation-time" class="form-control"  value="{!!$offer->start_date !!} {!!$offer->end_date !!}" />
                            </div>
                          </div>
                        </div>
                      </div> 
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
                              <input type="checkbox" name="target_members[]" value="Premium"> Premium
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
                          <input type="file" class="form-control" name="avatar">
                          <span class="fa fa-file-image-o form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Details</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <textarea type="text" name="details" class="resizable_textarea form-control" required placeholder="Details here..."> {!!$offer->details !!}</textarea>
                        </div>
                      </div>
                      @endforeach
                      <input type="hidden" class="form-control"  value="{!!$offer->offer_id !!}" name="offer_id" required>
                      
                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                          <a href="../admin_merchants_offers" class="btn btn-default"> Cancel</a>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="row">
                   <div class="x_panel">
                        <div class="x_title">
                            <h2>Tags <small></small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                              </li>
                              <li class="dropdown">
                                <a href="../admin_merchants_offers"><i class="fa fa-group"></i> List Offers</a>
                              </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form method="post" action="../admin_offer_tag_store" class="form-horizontal">
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
                                <input type="hidden" class="form-control" name="offer_id" value="{!! $offer->offer_id !!}">
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
                              <a href="../admin_offer_tag_delete/{!! $tagged->group_id !!}/{!! $offer->offer_id !!}"><i class="fa fa-trash" style="color: rgb(224, 12, 16)"></i> {!! $tagged->name !!}</a>
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
    @include("includes.admin-absolute-index-footer-script")
  </body>
</html>