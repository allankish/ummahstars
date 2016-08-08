 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Age Groups
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Age Groups</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Age Groups List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="age-groups-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Title</th>
                  <th>Sort Order</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($age_groups as $age_group) { ?>
                <tr>
                  <td><?php echo $age_group['age_group_name']?></td>
                  <td><?php echo $age_group['sort_order']?></td>
                  <td><a href='<?php echo base_url()?>usadmin/age-groups/edit/<?php echo $age_group['age_group_id']?>'>Edit</a> | <a href='#'>Delete</a></td>
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
    
    $('#age-groups-table').DataTable({
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