<?php  
$this->load->view('include/header');
$this->load->view('include/left_side_menu');
$this->load->view('include/top_menu'); 
?>

  <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
               <div class="col-md-12 col-sm-12 col-xs-12">
                <?php $this->load->view('include/other_menu');                
                ?>  
                <div class="x_panel">
                        <div class="x_title">
                            <h2>Transaction <?php echo $this->session->userdata('currencyname');?> List</h2>
                            <div class="title_right">
                            <div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right">

                              <select class="form-control" id="status" onchange="txnldatalist();">
                                <option value="all">All transactions</option>
                                <option value="send">Send transactions</option>
                                <option value="receive">Receive transactions</option>
                              </select>
                              
                            </div>
                          </div>
                      
                            <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                       <div id="txnlist">
                        <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
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
                </div>
              </div>

            </div>
          </div>
        </div>
        <!-- /page content -->

        

 <?php $this->load->view('include/footer');  ?>

 <script type="text/javascript">
   

   $(document).ready(function(){
        txnldatalist();
        
        
      });
   function txnldatalist()
   {
      var status=$('#status').val();
      $.post("<?php echo base_url();?>transactionlist/gettransactionlistdetail",{
      
      status:status
      },
      function(data){
      $('#txnlist').html(data);
      $('#datatable-checkbox').dataTable({
        
        });
      }
    ); 
   }
 </script>

