 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Subscription
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#"><i class="fa fa-dashboard"></i>Subscription Plans</a></li>
		<li class="active">Add New</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">		  
		<div class="col-md-12">
                    
                      <?php
            if(($this->session->flashdata('success')!=""))
            {
                ?>
               <div class="box box-success">
                <div class="box-header with-border">
                <h3 class="box-title"><?php echo $this->session->flashdata('success')?></h3>
                </div>
               </div>
                       
                       <?php
            }
            ?>
            
             <?php
            if(($this->session->flashdata('error')!=""))
            {
                ?>
               <div class="box box-danger">
                <div class="box-header with-border">
                <h3 class="box-title"><?php echo $this->session->flashdata('error')?></h3>
                </div>
               </div>
                       
                       <?php
            }
            ?>
                    
		  <div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">Add Subscription Plans</h3>
		    </div>
			<!-- /.box-header -->
			<!-- form start -->
            <form role="form" name="subscription_plan_form" action="<?php echo base_url();?>usadmin/subscription/save" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group col-xs-9">
                  <label for="plan_name">Plan Name</label>
                  <input type="text" class="form-control" id="plan_name" name="plan_name" value="<?php echo $this->session->flashdata('plan_name')?>" placeholder="Enter Plan Name">
                </div>
                  
                <div class="form-group col-xs-9">
                  <label for="duration">Duration</label>
                  <select class="form-control" id="duration" name="duration" placeholder="Duration">
                      <option <?php if($this->session->flashdata('duration') == 'monthly') echo 'selected';?> value="monthly">Monthly</option>
                      <option <?php if($this->session->flashdata('duration') == 'quarterly') echo 'selected';?> value="quarterly">Quarterly</option>
                      <option <?php if($this->session->flashdata('duration') == 'half-yearly') echo 'selected';?> value="half-yearly">Half-Yearly</option>
                      <option <?php if($this->session->flashdata('duration') == 'yearly') echo 'selected';?> value="yearly">Yearly</option>
                  </select>
                </div>  
                  
                <div class="form-group col-xs-9">
                  <label for="price">Price</label>
                  <input type="text" class="form-control" id="price" name="price" value="<?php echo $this->session->flashdata('price')?>" placeholder="Price">
                </div>  
                  
                <div class="form-group col-xs-9">
                  <label for="sort_order">Sort Order</label>
                  <input type="text" class="form-control" id="sort_order" name="sort_order"  value="<?php echo $this->session->flashdata('price')?>" placeholder="Enter Sort Order">
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
				<button type="submit" id="subscription_plan_submit" class="btn btn-primary">Submit</button>
			  </div>
            </form>
		  </div>		  
		  <!-- /.box -->
		</div>
        <!-- /.col -->		
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  