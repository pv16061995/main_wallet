<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo favicon_url();?>" type="image/ico" />

    <title><?php echo project_name();?></title>
    <link href="<?php echo asset_url() ?>css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo asset_url() ?>css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo asset_url() ?>css/nprogress/nprogress.css" rel="stylesheet">
    <link href="<?php echo asset_url() ?>css/animate.css/animate.min.css" rel="stylesheet">
    <link href="<?php echo asset_url() ?>css/build/custom.min.css" rel="stylesheet">

  </head>

 <body class="login" style="background-image: url('<?php echo login_bg();?>');">
    <div>
      <!-- <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a> -->

      <div class="login_wrapper">
        <div class="animate form login_form">

           <?php if($this->session->flashdata('success')){ ?>
            <div class="alert alert-block alert-success">
                <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
                <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php }else if($this->session->flashdata('error')){  ?>
            <div class="alert alert-block alert-danger">
                <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
                <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php } ?>
          <section class="login_content">
            <form action="<?php echo base_url()?>tfaotpverify/verify" method="POST"  id="otpform">
              <h1><img src="<?php echo logo_url() ?>"></h1>
              <h2 class="separator">Two-factor verify</h2>
              <div>
                <input type="text" class="form-control validate[required]" placeholder="TOtp" id="totp" name="totp" />
              </div>
              

              <div>
                <button type="submit" class="btn btn-success" onclick="return formbtn();">Submit</button>              
                <button class="btn btn-primary" type="reset" onclick="resetfun();">Reset</button>
                <!-- <a class="reset_pass" href="<?php echo base_url();?>forgetemail">Lost your password?</a> -->
             
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <!-- <p class="change_link">New to site?
                  <a href="<?php echo base_url();?>signup" class="to_register"> Create Account </a>
                </p>
 -->
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><!-- <i class="fa fa-paw"></i> --></h1>
                  <p>©2018 All Rights Reserved. <?php echo project_name();?></p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
 <script src="<?php echo asset_url() ?>css/jquery/dist/jquery.min.js"></script>
 <script type="text/javascript">

      $(document).ready(function(){
        $("#otpform").validationEngine('attach');
        
      });

      function resetfun()
       {
        window.location.reload();
       }

      function formbtn()
      {

          if ($('#otpform').validationEngine('validate')!='')   
          { 
            return true;
             
          }else{
            return false;
            
          }
      }
  </script>

<link href="<?php echo asset_url() ?>css/validation_engine/validationEngine.jquery.css" rel="stylesheet">
<script src="<?php echo asset_url() ?>css/validation_engine/jquery.validationEngine-en.js"></script>
<script src="<?php echo asset_url() ?>css/validation_engine/jquery.validationEngine.js"></script>