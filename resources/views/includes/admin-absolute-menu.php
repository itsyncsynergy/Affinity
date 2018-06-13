<!-- menu profile quick info -->
<div class="profile clearfix">
              <div class="profile_pic">
                <img src="../images/<?php echo $user->avatar; ?>" width="60px" height="60px" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $user->name; ?> </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="../admin"><i class="fa fa-home"></i> Home </a>
                  </li>
                  <li><a href="../admin_admins"><i class="fa fa-user"></i> Admin Users </a>
                  </li>
                  <li><a href="../admin_customers"><i class="fa fa-user"></i> Members </a>
                  </li>
                  <li><a><i class="fa fa-shopping-cart"></i> Partners <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../admin_merchants">Merchants</a></li>
                      <li><a href="../admin_merchant_categories">Manage Category</a></li>
                      <li><a href="../admin_merchants_offers">Offers</a></li>
                    </ul>
                  </li>
                  <li><a href="../admin_groups"><i class="fa fa-group"></i> Interests </a>
                  </li>
                  <li><a href="../admin_events"><i class="fa fa-calendar"></i> Events </a>
                  </li>
                  <li><a href="../admin_experiences"><i class="fa fa-fire"></i> Experiences </a>
                  </li>
                  <li><a href="../admin_luxury_experiences"><i class="fa fa-fire"></i> Luxury Travels </a>
                  </li>
                  <li><a><i class="fa fa-shopping-cart"></i> Luxury Rentals <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../admin_rentals"><i class="fa fa-car"></i> Luxury Rentals & Charters </a></li>
                      <li><a href="../admin_rentals_requests"><i class="fa fa-car"></i> Luxury R & C Requests </a></li>
                    </ul>
                  </li>
                  <li><a href="../admin_vpas"><i class="fa fa-bookmark"></i> VPAs (Phoenix) </a>
                  </li>
                  <li><a href="../admin_contacts"><i class="fa fa-question-circle"></i> Tickets(Contact us) </a>
                  </li>
                  <li><a href="../admin_feeds"><i class="fa fa-file"></i> Feeds </a>
                  </li>
                  <li><a><i class="fa fa-credit-card"></i> Get involved <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../admin_donations"><i class="fa fa-credit-card"></i> Donations </a></li>
                      <li><a href="../admin_volunteers"><i class="fa fa-credit-card"></i> Volunteers </a></li>
                    </ul>
                  </li> 
                  <li><a><i class="fa fa-plane"></i> Travels Requests<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../admin_airport_concierge">Airport Concierge Requests</a></li>
                      <li><a href="../admin_bespoke_travel">Bespoke Travel</a></li>
                      <li><a href="../admin_luxury_experiences_requests">Luxury Travel Requests</a></li>
                      <li><a href="../admin_flight_booking_requests">Flight Bookings</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-calendar"></i> VIP Events<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../admin_global_vip_events">Global VIP Events</a></li>
                      <li><a href="../admin_private_parties">Private Parties</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-universal-access"></i> VIP Access Requests<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../admin_global_vip_events_requests">VIP Global Events Requests</a></li>
                      <li><a href="../admin_private_party_requests">Private party Requests</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-shopping-cart"></i> Procurement Requests<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../admin_waitlisted_product_requests">Waitlisted Products</a></li>
                      <li><a href="../admin_bespoke_product_requests">Bespoke Product Requests</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-female"></i> P. Styling Requests<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../admin_personal_shoppings">Personal Shopper</a></li>
                      <li><a href="../admin_wardrobe_stylings">Wardrobe Styling</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-product-hunt"></i> Bespoke Product <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../admin_bespoke_products">Bespoke Product</a></li>
                      <li><a href="../admin_bespoke_product_categories">Bespoke Product Categories</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-product-hunt"></i> Waitlisted Product <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../admin_waitlisted_products">Waitlisted Product</a></li>
                      <li><a href="../admin_waitlisted_product_categories">Waitlisted Product Categories</a></li>
                    </ul>
                  </li>
                  
                  
                  
                  
                    </ul>
                  </li>                  
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="../logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="../images/<?php echo $user->avatar; ?>" width="60px" height="60px" alt=""><?php echo $user->name; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="../logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->