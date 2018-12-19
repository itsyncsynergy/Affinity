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

            @include("includes.admin-menu")

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-8 col-sm-12 col-xs-12">
                @if(Session::has('error'))
                    <div class="alert alert-danger"> {{Session::get('error')}} </div>
                @endif
                
                @if(Session::has('success'))
                    <div class="alert alert-success"> {{Session::get('success')}} </div>
                @endif
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Offers <small>Lists</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      </li>
                      <li class="dropdown">
                        <a href="admin_offer_new"><i class="fa fa-plus"></i> New Offer</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                  @if($user->admin_type != 'Customer Service' && $user->admin_type != 'Supervisor')
                    
                  <table id="datatable-buttons" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Avatar</th>
                        <th>Partner</th>
                        <th>Offer</th>
                        <th>Tag Line</th>
                        <th>Details</th>
                        <th>Start Date </th>
                        <th>End Date </th>
                        <th>Target Members </th>
                        <th>Action </th>
                      </tr>
                    </thead>


                    <tbody>
                    @foreach ($offers as $offer) 
                      <tr>
                        <td>
                          <div class="profile_pic">
                            <img src="public/{{ $offer->avatar or 'images/profile.png'}}" style="width:60px !important; height:60px;" alt="..." class="img-circle profile_img">
                          </div>
                        </td>
                        <td>{!! $offer->merchant_name !!}</td>
                        <td>{!! $offer->offer_name !!} @if ($offer->offer_type == 'Percentage discount') % discount @endif @if ($offer->offer_type == 'Amount discount') Off @endif</td>
                        <td>{!! $offer->tagline !!}</td>
                        <td>{!! $offer->details !!}</td>
                        <td>{!! $offer->start_date !!}</td>
                        <td>{!! $offer->end_date !!}</td>
                        <td>{!! $offer->target_members !!}</td>
                        <td><a class="btn btn-default btn-success source" href="admin_offer_edit/{!! $offer->offer_id !!}"><i class="fa fa-pencil"></i></a>
                          <a class="btn btn-default btn-danger source" href="../admin_offer_delete/{!! $offer->offer_id !!}"><i class="fa fa-trash"></i></a>
                       </td>
                      </tr>
                    @endforeach  
                    </tbody>
                  </table>
                  @endif

                  @if($user->admin_type == 'Customer Service' || $user->admin_type == 'Supervisor')
                    
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"     cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Avatar</th>
                          <th>Partner</th>
                          <th>Offer</th>
                          <th>Tag Line</th>
                          <th>Details</th>
                          <th>Start Date </th>
                          <th>End Date </th>
                          <th>Target Members </th>
                          <th>Action </th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach ($offers as $offer) 
                        <tr>
                          <td>
                            <div class="profile_pic">
                              <img src="public/{{ $offer->avatar or 'images/profile.png'}}" style="width:60px !important; height:60px;" alt="..." class="img-circle profile_img">
                            </div>
                          </td>
                          <td>{!! $offer->merchant_name !!}</td>
                          <td>{!! $offer->offer_name !!} @if ($offer->offer_type == 'Percentage discount') % discount @endif @if ($offer->offer_type == 'Amount discount') Off @endif</td>
                          <td>{!! $offer->tagline !!}</td>
                          <td>{!! $offer->details !!}</td>
                          <td>{!! $offer->start_date !!}</td>
                          <td>{!! $offer->end_date !!}</td>
                          <td>{!! $offer->target_members !!}</td>
                          <td><a class="btn btn-default btn-success source" href="admin_offer_edit/{!! $offer->offer_id !!}"><i class="fa fa-pencil"></i></a>
                          @if ($user->admin_type != 'Customer Service')
                            <a class="btn btn-default btn-danger source" href="../admin_offer_delete/{!! $offer->offer_id !!}"><i class="fa fa-trash"></i></a>
                          @endif</td>
                        </tr>
                      @endforeach  
                      </tbody>
                    </table>
                  @endif
                  
                  </div>
                </div>
              </div>

              <div class="col-md-4">
              <div class="x_panel">
                <div class="x_title">
                  <h4 class="text-danger">Expiring Offers </h4>
                </div>
                <div class="x_content">
                  <ul class="list-unstyled msg_list">
                    @foreach ($expiry as $exp)
                    <li>
                      <a>
                        <span>
                          <span>{{$exp->merchant_name}}</span>
                        </span>
                        <span class="message">
                          <p class="label label-danger"> Expiry: {{$exp->end_date}}</p> 
                          <p class="label label-danger">Days Left: {{$exp->diff}}</p>
                        </span>
                      </a>
                    </li> 
                    @endforeach
                  </ul>
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