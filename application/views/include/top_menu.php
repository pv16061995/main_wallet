 <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                   <i class="fa fa-user"></i> <?php print_r($this->session->userdata['name']); ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                 <!--    <li><a href="<?php echo base_url()?>changepassword">Change Password</a></li>
                    <li><a href="<?php echo base_url()?>changepin">Change Pin</a></li>
                    <li><a href="<?php echo base_url()?>support">Support</a></li>
                    <li><a href="<?php echo base_url()?>twofactor">2-factor-Auth</a></li> -->
                    
                    <li><a href="<?php echo base_url();?>Logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

               
              </ul>
            </nav>
          </div>
        </div>
        
          