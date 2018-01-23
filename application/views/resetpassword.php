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
            <form action="<?php echo base_url()?>resetpassword/resetpass" method="POST"  id="forgetemailform">
              <h1><img src="<?php echo logo_url() ?>"></h1>
              <div>
                <input type="text" class="form-control" placeholder="OTP" id="otp" name="otp" required maxlength="6" 
 />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="New Password" id="newpassword" name="newpassword" required maxlength="16" />
              </div>

              <div>
                <input type="password" class="form-control" placeholder="Confirm Password" id="confirmpassword" name="confirmpassword" required maxlength="16" />
              </div>
              <div>
                <button type="submit" class="btn btn-success" id="save">Submit</button>
               <button class="btn btn-primary" type="reset" onclick="resetfun();">Reset</button>
               
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="<?php echo base_url();?>signup" class="to_register"> Create Account </a> </p>
                   <p><a href="<?php echo base_url();?>" class="to_register"> Want to login? </a>
                </p>

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
<script src="https://jqueryvalidation.org/files/lib/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
 <script>
   $.validator.setDefaults({
    submitHandler: function() {
      return true;
    }
  });
   function resetfun()
   {
    window.location.reload();
   }

    jQuery.validator.addMethod("numbersonly", function(value, element) {
  return this.optional(element) || /^[0-9]+$/i.test(value);
}, "Please enter numbers only"); 

  $(document).ready(function() {
    setTimeout(function(){ $(".alert").hide(); }, 5000);
    
    $("#forgetemailform").validate({
      rules: {
        
        otp: {
          required: true,
          minlength: 6,
          numbersonly:true
          
        },
        newpassword: {
          required: true,
          minlength: 5
        }, 
        confirmpassword: {
          required: true,
          minlength:5
        }
      },
      messages: {
        otp: {
          required: "Please enter OTP",
         
          minlength: "Your OTP must be at least 6 digit"
        },
        newpassword: {
          required: "Please enter Password",

          minlength: "Your Password must be at least 5 digit"
        },
        confirmpassword: {
          required: "Please enter Confirm Password",
          minlength: "Your Confirm Password must be at least 5 digit"
          
        }
      }
    }); 
  });
  </script>

  <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/css/screen.css">


<style>


  label.error
  {
    text-shadow:none !important;
    color: #7d1c1c !important;
    font-style : normal !important;
  }
  </style>
 <!-- <script src="<?php echo asset_url() ?>css/jquery/dist/jquery.min.js"></script>
 <script type="text/javascript">

      $(document).ready(function(){
        $("#forgetemailform").validationEngine('attach');
        setTimeout(function(){ $(".alert").hide(); }, 5000);
        
      });
      function resetfun()
   {
    window.location.reload();
   }

      function formbtn()
      {

          if ($('#forgetemailform').validationEngine('validate')!='')   
          { 
            return true;
             
          }else{
            return false;
            
          }
      }
  </script>

<link href="<?php echo asset_url() ?>css/validation_engine/validationEngine.jquery.css" rel="stylesheet">
<script src="<?php echo asset_url() ?>css/validation_engine/jquery.validationEngine-en.js"></script>
<script src="<?php echo asset_url() ?>css/validation_engine/jquery.validationEngine.js"></script> -->