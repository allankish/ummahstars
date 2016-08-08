 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">User</a></li>
        <li class="active">View</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">		  
		<div class="col-md-3">
		  <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url();?>assets/dist/img/user4-128x128.jpg" alt="User profile picture">

              <h3 class="profile-username text-center">Nina Mcintire</h3>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Gender</b> <a class="pull-right">{GENDER}</a>
                </li>
                <li class="list-group-item">
                  <b>Child Added</b> <a class="pull-right">{##}</a>
                </li>
                <li class="list-group-item">
                  <b>User Type</b> <a class="pull-right">{USER TYPE}</a>
                </li>
				<li class="list-group-item">
                  <b>Parent Type</b> <a class="pull-right">{PARENT TYPE}</a>
                </li>
				<li class="list-group-item">
                  <b>Member Since</b> <a class="pull-right">{##-##-####}</a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Edit</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		</div>
		<!-- /.col -->
		<div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#childs" data-toggle="tab">Childs</a></li>
              <li><a href="#transactions" data-toggle="tab">Transactions</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="childs">
			  {CHILD LISTING TABLE}
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="transactions">
			  {TRANSACTION ITEMS}
              </div>
              <!-- /.tab-pane -->
              
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
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