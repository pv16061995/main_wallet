<?php  
$this->load->view('include/header');
$this->load->view('include/left_side_menu');
$this->load->view('include/top_menu'); 
?>


       

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
           
               <div class="col-md-12 col-sm-12 col-xs-12">
                <?php $this->load->view('include/other_menu')?>          

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
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Receive <?php echo $this->session->userdata('currencyname');?> Address List</small></h2>
                   <!--  <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul> -->
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                 
                    <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <!-- <div class="x_title">
                    <h2>Generate New Address</h2>
                    
                    <div class="clearfix"></div>
                  </div> -->
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" action="<?php echo base_url();?>receiveamount/generatenewaddress" method="POST">

                      <div class="form-group">
                        <label class="col-sm-3 control-label">Generate New Address</label>

                        <div class="col-sm-9">
                        
                          <div class="input-group">
                            <input type="text" disabled="disabled" class="form-control">
                            <span class="input-group-btn">
                                  <button type="submit" class="btn btn-primary">Get Address <span class="fa fa-chevron-right"></span></button>
                              </span>
                          </div>
                        </div>
                      </div>
                     <!--  <div class="divider-dashed"></div> -->

                    </form>
                  </div>
                </div>
              </div>
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          
                          <th>Address</th>
                          <th>Qr Code</th>
                        </tr>
                      </thead>


                      <tbody>
                       
                          <?php 

                          $getallqr=$this->Auth_model->getalladdresslistByCurrency();
                          
                          foreach($getallqr as $qrdetail)
                          {
                          ?>
                           <tr>
                          <td style="width:50%"><?php echo $qrdetail->curr_address; ?></td>
                          <td style="width:50%">
                          	<a href="javascript:;" data-toggle="modal" data-target="#myModal" onclick="qrcodepop('<?php echo $qrdetail->curr_address;?>');"><img src="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=<?php echo $qrdetail->curr_address;?>" style="width:10%;"></td>
                          </tr>
                          <?php }?>

                       
                      </tbody>
                    </table>
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
        setTimeout(function(){ $(".alert").hide(); }, 5000);
      });
	function qrcodepop(qrcode)
	{
	   var getqrcode='<img src="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl='+qrcode+'" >';
	   $('#getqrcode').html(getqrcode);
	   $('#qrcoderead').html('<strong>'+qrcode+'</strong');

	}


</script>
<style type="text/css">
#getqrcode{
	    margin-left: 22%;
}
</style>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Qr Code</h4>
      </div>
      <div class="modal-body">
      
      	<div class="alert alert-info alert-dismissible fade in" id="qrcoderead"></div>
        <div id="getqrcode"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>