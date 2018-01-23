<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
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
            <form action="<?php echo base_url()?>/signup/registeration" method="POST"  id="signupform">
              <h1><img src="<?php echo asset_url() ?>images/logo.png"></h1>
              <div>
                <input type="text" class="form-control" placeholder="Name" id="name" name="name" required maxlength="32" />
              </div>
              <div>
                <input type="email" class="form-control" required placeholder="E-mail" id="username" name="username" />
              </div>
              <div>
                <input type="password" id="password" maxlength="16" name="password" required class="form-control" placeholder="Password"/>
              </div>

              <div>
                <input type="password" id="pin" name="pin" class="form-control" required placeholder="6 Digit Pin"   maxlength="6" />
              </div>

              <div>
                <button type="submit" id='save' class="btn btn-success">Submit</button>
                <button class="btn btn-primary" type="reset" onclick="resetfun();">Reset</button>
            
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already have account?
                  <a href="<?php echo base_url();?>" class="to_register"> Login Account </a>
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
//   function isNumberKeyOnly(evt){
//     var charCode = (evt.which) ? evt.which : event.keyCode
//     if (charCode < 48 || charCode > 57)
//         return false;
//     return true;
// }
   $.validator.setDefaults({
    submitHandler: function() {
      return true;
    }
  });
   function resetfun()
   {
    window.location.reload();
   }

  $(document).ready(function() {
    setTimeout(function(){ $(".alert").hide(); }, 5000);

    jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, "Please enter valid name"); 

     jQuery.validator.addMethod("numbersonly", function(value, element) {
  return this.optional(element) || /^[0-9]+$/i.test(value);
}, "Please enter numbers only"); 


   

    $("#signupform").validate({

      rules: {
        
        name: {
          required: true,
          minlength: 2,
          maxlength: 32,
          lettersonly: true
          
        },
        password: {
          required: true,
          minlength: 5
        }, 
        pin: {
          required: true,
          maxlength: 6,
          minlength:6,
          numbersonly: true
        },
        
        email: {
          required: true,
          email: true
        }
      },
      messages: {
        name: {
          required: "Please enter name",
          minlength: "Your name must have at least 2 characters",
          maxlength: "Your name must be at least 32 characters",

         
        },
        password: {
          required: "Please enter Password",
          minlength: "Your password must be at least 5 characters long",
        },pin: {
          required: "Please enter Pin",
          minlength: "Your pin must be at least 6 digit long",
          maxlength: "Your pin must be at long 6 digit",
        },email: {
          required: "Please enter Email-address",
          
        },
        
        email: "Please enter a valid email address",
        
      }
    }); });


 
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