 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Subscription Plans
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Subscription Plans</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            
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
            
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Subscription Plan List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="subscription-plans-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Plan Name</th>
                  <th>Duration</th>
                  <th>Price</th>
                  <th>Sort Order</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($subscriptions as $plans) { ?>
                <tr>
                  <td><?php echo $plans['plan_name']?></td>
                  <td><?php echo $plans['duration']?></td>
                  <td><?php echo $plans['price']?></td>
                  <td><?php echo $plans['sort_order']?></td>
                  <td><a href='<?php echo base_url()?>usadmin/subscription/edit/<?php echo $plans['plan_id']?>'>Edit</a> | <a href='<?php echo base_url()?>usadmin/subscription/delete/<?php echo $plans['plan_id']?>'>Delete</a></td>
                </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
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
  
  <!-- DataTables -->
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
  $(function () {
    
    $('#subscription-plans-table').DataTable({
      "paging": true,
	  "deferRender": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>