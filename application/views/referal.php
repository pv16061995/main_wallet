<?php $this->load->view('include/header');
       $this->load->view('include/left_side_menu');
       $this->load->view('include/top_menu');?>


       <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Referal & Earn</h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
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
                    <form action="<?php echo base_url()?>referal/savedetail" method="POST" id="referform" class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">E-mail <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                     
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                         
                          <button class="btn btn-primary" type="reset" onclick="funreset();">Reset</button>
                          <button type="submit" class="btn btn-success" onclick="return formbtn();">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

          
          </div>
        </div>
        <!-- /page content -->

 <?php $this->load->view('include/footer');  ?>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script> 
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
  $(document).ready(function() {
   setTimeout(function(){ $(".alert").hide(); }, 5000);
    
     $("#referform").validate({
      rules: {
        email: {
          required: true,
          email: true
        }
      },
      messages: {
        
        email: {
          required: "Please enter Email-address",
          
        },
        
        email: "Please enter a valid email address",
        
      }
    }); });
  </script>

  <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/css/screen.css">


<style>