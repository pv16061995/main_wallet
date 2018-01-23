<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
             <div class="navbar nav_title" style="border: 0;">
              <!-- <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a> -->
              
              <a href="<?php echo base_url()?>dashboard" class="site_title">
                <img src="<?php echo logo_url() ?>" alt="<?php echo project_name();?>" id="desklogo" class="img-circle profile_img" style="background: #2b3f54;">
                 </a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <!-- <div class="profile_pic">
                <img src="<?php // echo logo_url() ?>" alt="..." class="img-circle profile_img">
              </div> -->
              <div class="profile_info">
                <!-- <span>Welcome,<?php print_r($this->session->userdata['name']); ?></span> -->
                <h2>Welcome <?php print_r($this->session->userdata['name']); ?>,</h2>
              </div>
            </div>
            <br />
    
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Currency</h3>
                 <ul class="nav side-menu">
                   <?php 
                    $this->load->model('Auth_model');
                    $menu_list = $this->Auth_model->currencylist();
                    foreach ($menu_list as $menudetail) { ?>
                  
               <li><a href="<?php echo base_url()?>transactionlist?curr=<?php echo base64_encode($menudetail->id);?>"><i class="fa fa-money"></i> <?php echo $menudetail->name;?> (<?php echo $menudetail->short_name;?>)</a></li>
                <?php }?>
             </ul>
           </div>
             

            </div>

             <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Useful Links</h3>
                 <ul class="nav side-menu">
              <li><a href="<?php echo base_url();?>getvcn"><i class="fa fa-share"></i> Get VCN</a></li>     
              <li><a href="<?php echo base_url()?>changepassword"><i class="fa fa-key"></i> Change Password</a></li>
              <li><a href="<?php echo base_url()?>changepin"><i class="fa fa-key"></i> Change Pin</a></li>
              <li><a href="<?php echo base_url()?>support"><i class="fa fa-envelope-o"></i> Support</a></li>
              <li><a href="<?php echo base_url()?>twofactor"><i class="fa fa-lock"></i> 2-factor-Auth</a></li>
               <li><a href="<?php echo base_url()?>twofactor"><i class="fa fa-share"></i> Refer</a></li>
              <li><a href="<?php echo base_url();?>Logout"><i class="fa fa-sign-out"></i> Log Out</a></li>
             </ul>
           </div>
             

            </div>
            <!-- /sidebar menu -->
             <!-- /menu footer buttons -->
            <!-- <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div> -->
            <!-- /menu footer buttons -->
          </div>
        </div>
