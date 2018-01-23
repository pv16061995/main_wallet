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
                            <h2>Transaction Request List</h2>
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
                            <th>Sr</th>
                              <th>Txn-id</th>
                              <th>Address</th>
                              <th>Amount</th>
                              <th>Name</th>
                              <th>Email</th>
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
      
      $.post("<?php echo admin_url();?>transactionreqlist/transactionreqlist",{
      },
      function(data){
     
      $('#txnlist').html(data);
       $('[data-toggle="tooltip"]').tooltip();   
      $('#datatable-checkbox').dataTable({
        
        });
      }
    ); 
   }

   function txnreqenabledisable(id,status)
   {
      
      $.post("<?php echo admin_url();?>transactionreqlist/txnreqenabledisable",{
        id:id,
        status:status
      },
      function(data){

        window.location.reload();
     
      }
    ); 
   }

 </script>



  <style type="text/css">
@media (min-width: 768px)
{
.modal-dialog {
    width: 90%;
    margin: 30px auto;
}  
}

  </style>
