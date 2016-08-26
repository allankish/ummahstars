<link href="<?php echo base_url(); ?>assets/plugins/treeview/jquery.treegrid.css" rel="stylesheet">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Goals
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Goals</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php if ($this->session->flashdata('Success')) { ?>
                    <div class="alert alert-success alert-dismissible">
                        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                        <h4>
                            <i class="icon fa fa-check"></i>
                            Success!
                        </h4>
                        <?php echo $this->session->flashdata('Success'); ?>
                    </div>
                <?php } ?>

                <?php if (($this->session->flashdata('error') != "")) { ?>
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->session->flashdata('error') ?></h3>
                        </div>
                    </div>
                <?php } ?>

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Goals List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <a href="<?php echo base_url(); ?>usadmin/goals/add" class="btn btn-primary pull-left">Add New</a>
                        <br /><br />
                        <table id="goals-table" class="table table-bordered table-striped tree">
                            <thead>
                                <tr>
                                    <th>Goal Description</th>
                                    <th>Deed Amount</th>
                                    <th>Prize</th>
                                    <th>Age Group</th>
                                    <th>Created By</th>
                                    <th>Assigned To</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($goals as $goal) { ?>
                                    <tr>
                                        <td><?php echo $goal['goal_description']; ?></td>
                                        <td><?php echo $goal['deed_amount']; ?></td>
                                        <td><?php echo $goal['prize_name']; ?></td>
                                        <td><?php echo ($goal['age_group'] === '0') ? 'All' : $goal['age_group_name']; ?></td>
                                        <td><?php echo ($goal['created_by'] === '0') ? 'Admin' : $goal['uname']; ?></td>
                                        <td><?php echo ($goal['assigned_to'] === '0') ? 'All' : $goal['assigned_uname']; ?></td>
                                        <td><a href='<?php echo base_url() ?>usadmin/goals/edit/<?php echo $goal['goal_id'] ?>'>Edit</a> | <a id="delete_goal-<?php echo $goal["goal_id"]; ?>" data-id="<?php echo $goal["goal_id"]; ?>" href='#'>Delete</a></td>
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

<!-- /.content-wrapper -->
<div class="confirm-modal">
    <div class="modal modal-danger" id="confirm-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Warning!</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete this Goal?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-outline" id="confirm-delete-goal">Yes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
<!-- /.confirm-modal -->

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <img src="" id="category_image_pop" class="img-responsive">
            </div>
        </div>
    </div>
</div>


<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/treeview/jquery.treegrid.min.js"></script>

<script>
    $(function () {

        $('#goals-table').DataTable({
            "paging": true,
            "deferRender": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });

        $('a[id^="delete_goal-"]').on('click', function () {
            var goal_id = $(this).attr('data-id');
            $('#confirm-modal').modal('toggle');
            $('#confirm-delete-goal').on('click', function () {

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>usadmin/goals/delete',
                    dataType: 'html',
                    data: 'goal_id=' + goal_id,
                    success: function (result) {
                        if (result == 'success') {
                            $('#confirm-modal').modal('hide');
                            window.location.href = "<?php echo base_url(); ?>usadmin/goals/";
                        } else {
                            $('#confirm-modal').modal('hide');
                            alert(result);
                        }
                    }
                });
            });
        });
     
    });
</script>