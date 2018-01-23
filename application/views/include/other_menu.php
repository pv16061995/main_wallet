<div class="x_panel">
  <div class="x_title">
  	<a href="<?php echo base_url();?>sendamount" class="btn btn-primary">Send <?php echo $this->session->userdata('currencyname');?> Amount</a>
  	<a href="<?php echo base_url();?>receiveamount" class="btn btn-info">Receive <?php echo $this->session->userdata('currencyname');?> Amount</a>
  	<!-- <a href="<?php echo base_url();?>deposit" class="btn btn-success">Deposit Amount</a>
  	<a href="<?php echo base_url();?>withdraw" class="btn btn-warning">Withdraw Amount</a> -->
  <a href="javascript:;" class="btn btn-success" style="cursor:default;float: right;">Balance : <?php echo $user_bal;?></a>
    <div class="clearfix"></div>
  </div>
</div>