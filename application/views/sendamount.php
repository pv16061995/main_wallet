<?php $this->load->view('include/header');
      $this->load->view('include/left_side_menu');
      $this->load->view('include/top_menu');?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <?php $this->load->view('include/other_menu')?>  
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Send <?php echo $this->session->userdata('currencyname');?> Amount</h2>
                   
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
                    <form action="<?php echo base_url()?>sendamount/transferamount" method="POST" id="sendform" class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Receiver Address <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="receive_address" name="receive_address"  class="form-control validate[required] col-md-7 col-xs-12" value="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Amount (Balance : <?php print_r($user_bal);?>) <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="amount" name="amount" class="form-control validate[required,custom[number],min[0]] col-md-7 col-xs-12" value="" onkeypress="return isNumberKey(event)">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Pin <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="pin" class="form-control validate[required,minSize[6],maxSize[6]] col-md-7 col-xs-12" type="password" name="pin" value="" maxlength="6"  >
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                         
                 
                          <button type="submit" class="btn btn-success" onclick="return formbtn();">Submit</button>
                            <button class="btn btn-primary" type="reset" onclick="resetfun();">Reset</button>
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
  <script type="text/javascript">

  
      $(document).ready(function(){
        $("#sendform").validationEngine('attach');
        setTimeout(function(){ $(".alert").hide(); }, 5000);
      });
      function resetfun()
   {
    window.location.reload();
   }

      function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 46 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}



      function formbtn()
      {

          if ($('#sendform').validationEngine('validate')!='')   
          { 
            return true;
             
          }else{
            return false;
            
          }
      }
  </script>

       
