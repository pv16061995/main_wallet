<?php  
$this->load->view('adminpanel/include/header');
$this->load->view('adminpanel/include/left_side_menu');
$this->load->view('adminpanel/include/top_menu'); 
?>

<div class="right_col" role="main">
          <div class="">
               <div class="col-md-12 col-sm-12 col-xs-12">
                <?php //$this->load->view('include/other_menu');                
                ?>  
                <div class="x_panel">
                        <div class="x_title">
                            <h2>Users List</h2>
                            <div class="title_right">
                            <div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right">

                             <!--  <select class="form-control" id="status" onchange="txnldatalist();">
                                <option value="all">All transactions</option>
                                <option value="send">Send transactions</option>
                                <option value="receive">Receive transactions</option>
                              </select> -->
                              
                            </div>
                          </div>
                      
                            <div class="clearfix"></div>

            <?php 

            if($this->session->flashdata('success')){ ?>
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
                      </div>
                      <div class="x_content">
                       <div id="txnlist">
                        <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                           
                          </tbody>
                        </table>
                        </div>
                      </div>
                </div>
              </div>

            </div>
          </div>
        </div>


 <?php $this->load->view('adminpanel/include/footer');  ?>

  <script type="text/javascript">
   

   $(document).ready(function(){

        setTimeout(function(){ $(".alert").hide(); }, 5000);
        txnldatalist();       
        
      });
   function txnldatalist()
   {
      var status=$('#status').val();
      $.post("<?php echo admin_url();?>userdetail/userdata",{
      },
      function(data){
     
      $('#txnlist').html(data);
      $('#datatable-checkbox').dataTable({
        
        });
      }
    ); 
   }

   function userenabledisable(id,status)
   {
      
      $.post("<?php echo admin_url();?>userdetail/userenabledisable",{
        id:id,
        status:status
      },
      function(data){

        window.location.reload();
     
      }
    ); 
   }



   function usertfaenabledisable(id,status)
   {
      
      $.post("<?php echo admin_url();?>userdetail/usertfaenabledisable",{
        id:id,
        status:status
      },
      function(data){

        window.location.reload();
     
      }
    ); 
   }


   function usertransactionlist(email)
   {
     
    $('#user_email').val(email);
    setTimeout(function(){ gettxndetail(); }, 2000);
    
   }



   function gettxndetail()
   {
    var email=$('#user_email').val();
    var currency=$('#currencylist').val();
    var status=$('#liststatus').val();

    $.post("<?php echo admin_url();?>userdetail/usertransactionlist",{
      email:email,
      currency:currency,
      status:status
      },
      function(data){
      var dat=data.split('^');
      $('#transactionlist').html(dat[1]);
      $('#balances').html(dat[2]);
      $('#datatable-checkbox-txnlist').dataTable({
        
        });
      }
    ); 

   }
 </script>


 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Transaction List</h4>
        </div>
        <div class="modal-body">
          <div class="row">
           
            <div class="title_right">
              
               <div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right">
                <input type="hidden" name="user_email" id="user_email">
                              <select class="form-control" id="liststatus" onchange="gettxndetail();">
                                <option value="all">All transactions</option>
                                <option value="send">Sent transactions</option>
                                <option value="receive">Received transactions</option>
                              </select>
                              
                            </div>
              <div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right">

                              <select class="form-control" id="currencylist" onchange="gettxndetail();">
                                <?php 
                    $this->load->model('Auth_model');
                    $menu_list = $this->Auth_model->currencylist();
                    foreach ($menu_list as $menudetail) { ?>
                    <option value="<?php echo base64_encode($menudetail->id);?>"><?php echo $menudetail->name;?> (<?php echo $menudetail->short_name;?>)</option>
                    <?php }?>
                              </select>
                              
                            </div>
                            <div id="balances"></div>
                          </div>
          </div>

          <div id="transactionlist">
               <table id="datatable-checkbox-txnlist" class="table table-striped table-bordered bulk_action">
                          <thead>
                            <tr>
                              <th>Date</th>
                              <th>Address</th>
                              <th>Type</th>
                              <th>Amount</th>
                              <th>Confirmations</th>
                              <th>TX Id</th>
                            </tr>
                          </thead>
                          <tbody>
                           
                          </tbody>
                        </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <style type="text/css">
    @media (min-width: 768px)
{
.modal-dialog {
    width: 90%;
    margin: 30px auto;
}  
}

  </style>