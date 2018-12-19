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
                 <h2 class="brief"><i>Customer Profile</i></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      </li>
                      <li class="dropdown">
                        <a href="../admin_customers"><i class="fa fa-experience"></i> List Customers</a>
                      </li>
                    </ul>
                  </div>
                  <div class="x_content">
                    <div class="col-md-12 col-sm-12 col-xs-12 profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                        
                            <div class="left col-xs-7">
                              <h4><strong>Name:</strong> {!! $customer->firstname !!} {!! $customer->lastname !!}</h4>
                              <p><strong>Email: </strong> {!! $customer->email !!}</p>
                              <p><strong>Address: </strong> {!! $customer->address !!}</p>
                              <p><strong>Phone: </strong> {!! $customer->phone !!}</p>
                              <p><strong>Membership: </strong> {!! $customer->membership !!}</p>

                            </div>
                            <div class="right col-xs-5 text-center">
                              <img src="../{{ $customer->avatar}}" alt="" class="img-circle img-responsive">
                            </div>
                          </div>
                          
                        </div>
                      </div> 
                  </div>
                </div>
              </div> 

              <div class="col-md-4">
                   <div class="row">
                        <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel">
                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <h4 class="panel-title">Redemption History</h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                             
                                <div class="col-md-12" style="margin-bottom: 10px;">
                                    <ul class="list-unstyled msg_list">
                                        @foreach ($redemptions as $redeem)
                                        <li>
                                        <a>
                                            <span>
                                            <span>{{$redeem->merchant_name}}</span>
                                            </span>
                                            <span class="message">
                                            <p class="label label-primary"> Date: {{$redeem->created_at}}</p> 
                                            <p class="label label-primary">Type: {{$redeem->transaction_type}}</p>
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

                   <div class="row">
                        <div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
                      <div class="panel">
                        <a class="panel-heading" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                          <h4 class="panel-title">Request History</h4>
                        </a>
                        <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                             
                                <div class="col-md-12" style="margin-bottom: 10px;">
                                    <ul class="list-unstyled msg_list">
                                        @foreach ($comb as $com)
                                        <li>
                                        <a>
                                            <span>
                                            <span>{{$com['customer_id']}}</span>
                                            </span>
                                            <span class="message">
                                            <p class="label label-primary"> Date: {{$com['details']}}</p> 
                                            
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