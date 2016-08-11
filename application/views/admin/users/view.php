<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'usadmin'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'usadmin/users'; ?>">User</a></li>
            <li class="active">View</li>
        </ol>
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
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">		  
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url() . $user_details["profile_image"]; ?>" alt="User profile picture">

                        <h3 class="profile-username text-center"><?php echo ucwords($user_details["uname"]); ?></h3>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Gender</b> <a class="pull-right"><?php echo ucwords($user_details["gender"]); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Child Allowed</b> <a class="pull-right"><?php echo $user_details['child_allowed']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Child Added</b> <a class="pull-right"><?php echo $total_childs; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Parent Type</b> <a class="pull-right"><?php echo ucwords($user_details["parent_type"]); ?></a>
                            </li>
                        </ul>

                        <a href="<?php echo base_url(); ?>usadmin/users/edit/<?php echo $user_details["user_id"]; ?>" class="btn btn-primary btn-block"><b>Edit</b></a>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <div class="box box-primary">
                    <div class="box-body box-profile">

                        <h3 class="profile-username text-center">Membership Details</h3>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Member Since</b> <a class="pull-right"><?php echo date('m/d/Y', strtotime($user_details["created_on"])); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Membership Type</b> <a class="pull-right">{PREMIUM/GUEST}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Membership Start</b> <a class="pull-right"><?php echo date('m/d/Y', strtotime($user_details["created_on"])); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Membership End</b> <a class="pull-right"><?php echo date('m/d/Y', strtotime($user_details["created_on"])); ?></a>
                            </li>
                        </ul>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#childs" data-toggle="tab">All Child</a></li>
                        <li><a href="#transactions" data-toggle="tab">Transactions</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="childs">
                            <a href="<?php echo base_url(); ?>usadmin/child/add/<?php echo $user_details["user_id"]; ?>" class="btn btn-primary pull-left">Add New</a>
                            <br /><br />
                            <table id="child_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Age</th>
                                        <th>Age Group</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($all_child as $child) { ?>
                                        <tr>
                                            <td><?php echo ucwords($child['uname']); ?></td>
                                            <td><?php echo ucwords($child['gender']); ?></td>
                                            <td><?php echo $child['age']; ?></td>
                                            <td><?php echo $child['age_group_name']; ?></td>
                                            <td><a href='<?php echo base_url() ?>usadmin/child/view/<?php echo $child['user_id'] ?>'>View</a> | <a href='<?php echo base_url() ?>usadmin/child/edit/<?php echo $child['user_id'] ?>'>Edit</a> | <a id="delete_child-<?php echo $child["user_id"]; ?>" data-parent-id="<?php echo $child["parent_id"]; ?>" data-id="<?php echo $child["user_id"]; ?>" href='#'>Delete</a></td>
                                        </tr>
                                    <?php } ?>               
                                </tbody>
                            </table>
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
                    <p>Are you sure want to delete this Child?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-outline" id="confirm-delete-child">Yes</button>
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

        $('#child_table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });

    $(document).ready(function () {
        $('a[id^="delete_child-"]').on('click', function () {
            var child_id = $(this).attr('data-id');
            var parent_id = $(this).attr("data-parent-id");
            $('#confirm-modal').modal('toggle');
            $('#confirm-delete-child').on('click', function () {

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>usadmin/child/delete',
                    dataType: 'html',
                    data: 'child_id=' + child_id,
                    success: function (result) {
                        if (result == 'success') {
                            $('#confirm-modal').modal('hide');
                            window.location.href = "<?php echo base_url(); ?>usadmin/users/view/" + parent_id;
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