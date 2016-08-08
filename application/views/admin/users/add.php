 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add User
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">		  
		<div class="col-md-12">
		  <div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">Add User</h3>
		    </div>
			<!-- /.box-header -->
			<!-- form start -->
            <form role="form" name="user_form" action="<?php echo base_url();?>usadmin/users/add" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group col-xs-9">
                  <label for="parent_name">Parent Name</label>
                  <input type="text" class="form-control" id="parent_name" placeholder="Enter parent name">
                </div>
				<div class="form-group col-xs-9">
                  <label for="parent_email">Email Id</label>
                  <input type="text" class="form-control" id="parent_email" placeholder="Enter parent email id">
                </div>
                <div class="form-group col-xs-9">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" placeholder="Enter Password">
                </div>
				<div class="form-group col-xs-9">
                  <label for="retype_password">Retype Password</label>
                  <input type="password" class="form-control" id="retype_password" placeholder="Enter Retype Password">
                </div>
				<div class="form-group col-xs-9">
                  <label>Gender</label>
                  <select class="form-control">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
                </div>
				
                <div class="form-group col-xs-9">
                  <label for="profile_image">Profile Image</label>
                  <input type="file" id="profile_image">
                </div>
                
				<div class="form-group">
                  
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
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
  
  <!-- DataTables -->
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
  $(function () {
    
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>