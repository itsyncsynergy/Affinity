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
      function updateAdmin(key){
        document.getElementById('updateAdmin'+key).submit();
      }

      function updateStatus(key){
        document.getElementById('updateStatus'+key).submit();
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
              <div class="col-md-8">
              @if(Session::has('error'))
                    <div class="alert alert-danger"> {{Session::get('error')}} </div>
                @endif
                
                @if(Session::has('success'))
                    <div class="alert alert-success"> {{Session::get('success')}} </div>
                @endif
              <div class="x_panel">
                  <div class="x_title">
                    <h2>{{$ticket->ticket_id}} - <small>{{$ticket->title}}</small></h2> 

                    <ul class="nav navbar-right panel_toolbox">
                      
                      <li class="dropdown">
                        <a href="../admin_contacts"><i class="fa fa-list-ol"></i> All Tickets</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>           
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="../admin_ticket_comment">
                        <p>Issue: {{$ticket->message}}</p>

                        <p>Admin In-charge: {{$ticket->in_charge}}</p>

                        @if($ticket->status == 'In Progress' || $ticket->status == 'Resolved')
                        <p>Status: <span class="label label-success">{{$ticket->status}}</span></p>
                        @endif

                        @if($ticket->status == 'Pending' || $ticket->status == 'UnResolved')
                        <p>Status: <span class="label label-danger">{{$ticket->status}}</span></p>
                        @endif
                        <p>Created On: {{$ticket->created_at}}</p>

                        <input type="hidden" name="ticket_id" value="{{$ticket->ticket_id}}" />

                        <input type="hidden" name="in_charge" value="{{$ticket->in_charge}}" />

                        <input type="hidden" name="email" value="{{$ticket->email}}" />

                      <div class="form-group">
                        
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <textarea class="form-control" name="post" rows="10" required></textarea> 
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-9 col-md-offset-0">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>

              

              <div class="col-md-4">
              <div class="x_panel">
                <div class="x_title">
                  <h5>Comments On <small>{{$ticket->ticket_id}}</small></h5>
                </div>
                <div class="x_content">
                  <ul class="list-unstyled msg_list">
                    @foreach ($ticket_comment as $comment)
                    <li>
                      <a>
                        <!-- <span class="image">
                          <img src="{{ URL::asset('images/1533329190.png') }}" alt="img" />
                        </span> -->
                        <span>
                          <span>{{$comment->in_charge}}</span>
                          <span class="time">{{substr(($comment->created_at), 0,10)}}</span>
                        </span>
                        <span class="message" style="word-break: break-all;">
                          {{$comment->post}} 
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