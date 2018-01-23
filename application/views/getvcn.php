<?php $this->load->view('include/header');
      $this->load->view('include/left_side_menu');
      $this->load->view('include/top_menu');?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <?php //$this->load->view('include/other_menu')?>  
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Exchange Your BTC To VCN</h2>
                
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
                        <form action="<?php echo base_url()?>getvcn/transaction" method="POST" id="sendform" class="form-horizontal form-label-left">
                          <img src="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=1HSpKB2Xm4kuiurSeDiiqgqH5Q4p539M4c" class="img-responsive" style="width: 15%;margin-left: 35%;">

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">BTC Address <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" id="btcaddress" name="btcaddress" class="form-control col-md-7 col-xs-12" value="">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">BTC Amount <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="number" id="BTCamount" name="amount" class="form-control col-md-7 col-xs-12" min="0" onkeypress="return isNumberKey(event)">
                            </div>
                          </div>

                          
                          <div class="ln_solid"></div>
                          <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                             
                             
                              <button type="submit" class="btn btn-success" id="save">Submit</button>
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
  <script type="text/javascript">

      function resetfun()
       {
        window.location.reload();
       }



       $(document).ready(function() {
    setTimeout(function(){ $(".alert").hide(); }, 5000);
    
    $("#sendform").validate({
      rules: {
        
        btcaddress: {
        required: true
          
        },amount:{
          required: true
        }
      },
      messages: {
        subject: {
          required: "Please enter BTC address"
        },
        amount: {
          required: "Please enter amount",
         
        }
      }
    }); 
  });
  </script>

     
 <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/css/screen.css">

<style>
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}

  label.error
  {
    text-shadow:none !important;
    color: #7d1c1c !important;
    font-style : normal !important;
  }
  </style>

  <script type="text/javascript">

      $(document).ready(function(){
//         $("#sendform").validationEngine('attach');
        
//       });
//       function resetfun()
//    {
//     window.location.reload();
//    }

//       function isNumberKey(evt){
//     var charCode = (evt.which) ? evt.which : event.keyCode
//     if (charCode > 46 && (charCode < 48 || charCode > 57))
//         return false;
//     return true;
// }

//       function formbtn()
//       {

//           if ($('#sendform').validationEngine('validate')!='')   
//           { 
//             return true;
             
//           }else{
//             return false;
            
//           }
//       }

 
  </script>

       
