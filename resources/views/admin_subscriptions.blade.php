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
            <div class="col-md-12 col-sm-12 col-xs-12">
                @if(Session::has('error'))
                    <div class="alert alert-danger"> {{Session::get('error')}} </div>
                @endif
                
                @if(Session::has('success'))
                    <div class="alert alert-success"> {{Session::get('success')}} </div>
                @endif
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Subscriptions <small>Lists</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      </li>
                      <li class="dropdown">
                        <a href="admin_subscriptions_new"><i class="fa fa-group"></i> New Subscription</a>
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
                          <th>Id</th>
                          <th>Phone</th>
                          <th>Email </th>
                          <th>Start Date </th>
                          <th>End Date </th>
                          <!-- <th>Amount </th> -->
                          <th>Membership </th>
                          <th>Status </th>
                          <th>Action </th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach ($subscriptions as $transaction) 
                        <tr>
                          <td>
                            <div class="profile_pic">
                              <img src="public/{{ $transaction->avatar or 'images/profile.png'}}" style="width:60px !important; height:60px;" alt="..." class="img-circle profile_img">
                            </div>
                          </td>
                          <td>{!! $transaction->firstname !!} {!! $transaction->lastname !!}</td>
                          <td>{!! $transaction->customer_id !!}</td>
                          <td>{!! $transaction->phone !!}</td>
                          <td>{!! $transaction->email !!}</td>
                          <td>{!! $transaction->start_date !!}</td>
                          <td>{!! $transaction->end_date !!}</td>
                          <!-- <td>{!! $transaction->amount !!}</td> -->
                          <td>{!! $transaction->membership !!}</td>
                          @if($transaction->status == 1)
                          <td style="color: #0f0;">Activated</td>
                          @else
                          <td style="color: #f00;">Inactive</td>
                          @endif
                          <td>
                            <button class="btn btn-default btn-success" onclick='openDeleteModal(<?php echo json_encode($transaction); ?>)' ><i class="fa fa-pencil"></i></button>
                          </td>
                          
                          
                          
                        </tr>
                      @endforeach  
                      </tbody>
                    </table>
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
  <div id="delete_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="event_title"> </h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="admin_sub_update">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-3">Full Name</label>
            <div class="input-prepend input-group col-md-9 col-sm-9 col-xs-9">
              <input type="text" name="rental_title" id="event_delete" class="form-control" readonly />
              <span class="fa fa-tag form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div> 

          <div class="form-group">
              <div class="control-group">
                  <div class="controls">
                      <label class="control-label col-md-3 col-sm-3 col-xs-3">Date</label>
                      <div class="input-prepend input-group col-md-9 col-sm-9 col-xs-9">
                        <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                        <input type="date" name="date" id="event_date" class="form-control" value="" />
                      </div>
                  </div>
              </div>
          </div>

          <div class="form-group">
              <div class="control-group">
                  <div class="controls">
                      <label class="control-label col-md-3 col-sm-3 col-xs-3">Membership</label>
                      <div class="input-prepend input-group col-md-9 col-sm-9 col-xs-9">
                        <select class="form-control" name="mem" id="event_mem">
                          <option>{!! $transaction->membership !!}</option>
                         
                          <option>Luxe</option>
                          <option>Essence</option>
                          <option>Premium</option>
                        </select>
                        
                      </div>
                  </div>
              </div>
          </div>  
         
         <div class="form-group">
              <div class="control-group">
                  <div class="controls">
                      <label class="control-label col-md-3 col-sm-3 col-xs-3">Period</label>
                      <div class="input-prepend input-group col-md-9 col-sm-9 col-xs-9">
                        <select class="form-control" name="period" id="event_period">
                          <option>{!! $transaction->Period !!}</option>
                          <option>Monthly</option>
                          <option>Yearly</option>
                        </select>
                        
                      </div>
                  </div>
              </div>
          </div>

          <div class="form-group">
              <div class="control-group">
                  <div class="controls">
                      <label class="control-label col-md-3 col-sm-3 col-xs-3">Status</label>
                      <div class="input-prepend input-group col-md-9 col-sm-9 col-xs-9">
                        <select class="form-control" name="status" id="event_status">
                          <option value="1">Activated</option>
                          <option value="0">Deactivated</option>
                        </select>
                        
                      </div>
                  </div>
              </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-3">Amount</label>
            <div class="input-prepend input-group col-md-9 col-sm-9 col-xs-9">
              <input type="text" name="amount" id="event_amount" class="form-control number" required="" />
              <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div>

          <input type="hidden" name="sub_id" id="event_id" class="form-control">
          <div class="ln_solid"></div>

          <div class="form-group">
            <div class="col-md-9 col-md-offset-3">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </div>

          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
      var myData;

      function openDeleteModal(data){
        $('#delete_modal').modal('show');
        document.getElementById('event_title').innerHTML = 'Update ' +data.firstname + ' Subscription';
        document.getElementById('event_delete').value = data.firstname + ' ' + data.lastname;
        document.getElementById('event_date').value = data.end_date;
        document.getElementById('event_mem').value = data.membership;
        document.getElementById('event_period').value = data.Period;
        document.getElementById('event_amount').value = data.amount;
        document.getElementById('event_status').value = data.status;
        document.getElementById('event_id').value = data.subscription_id;
      }
    </script>
    <script>
      
        var el = document.querySelector('input.number');

      el.addEventListener('keyup', function(event){
        if (event.which >= 37 && event.which <= 40) 
          return;

        this.value = this.value.replace(/\D/g,'').replace(/\B(?=(\d{3})+(?!\d))/g,',');
      });
     
      
    </script>
</html>