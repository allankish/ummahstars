<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'usadmin'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Users</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Users List</h3>
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
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="user_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email Id</th>
                                    <th>Gender</th>
                                    <th>Parent Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $usobj) { ?>
                                    <tr>
                                        <td><?php echo ucwords($usobj['uname']); ?></td>
                                        <td><?php echo $usobj['email_id']; ?></td>
                                        <td><?php echo ucwords($usobj['gender']); ?></td>
                                        <td><?php echo ucwords($usobj['parent_type']); ?></td>
                                        <td><a href='<?php echo base_url() ?>usadmin/users/view/<?php echo $usobj['user_id'] ?>'>View</a> | <a href='<?php echo base_url() ?>usadmin/users/edit/<?php echo $usobj['user_id'] ?>'>Edit</a> | <a id="delete_user-<?php echo $usobj["user_id"]; ?>" data-id="<?php echo $usobj["user_id"]; ?>" href='#'>Delete</a></td>
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
                    <p>Are you sure want to delete this user?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-outline" id="confirm-delete-user">Yes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
<!-- /.confirm-modal -->

<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
    $(function () {

        $('#user_table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });

    $(document).ready(function () {
        $('a[id^="delete_user-"]').on('click', function () {
            var user_id = $(this).attr('data-id');
            $('#confirm-modal').modal('toggle');
            $('#confirm-delete-user').on('click', function () {

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>usadmin/users/delete',
                    dataType: 'html',
                    data: 'user_id=' + user_id,
                    success: function (result) {
                        if (result == 'success') {
                            $('#confirm-modal').modal('hide');
                            window.location.href = "<?php echo base_url(); ?>usadmin/users/";
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