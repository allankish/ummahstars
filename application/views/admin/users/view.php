<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Details
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'usadmin';?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'usadmin/users';?>">User</a></li>
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
                        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url() . $user_details["profile_image"]; ?>" alt="User profile picture">

                        <h3 class="profile-username text-center"><?php echo ucwords($user_details["uname"]); ?></h3>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Gender</b> <a class="pull-right"><?php echo ucwords($user_details["gender"]); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Child Added</b> <a class="pull-right"><?php echo $total_childs; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Parent Type</b> <a class="pull-right"><?php echo ucwords($user_details["parent_type"]); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Member Since</b> <a class="pull-right"><?php echo date('m/d/Y', strtotime($user_details["created_on"])); ?></a>
                            </li>
                        </ul>

                        <a href="<?php echo base_url();?>usadmin/users/edit/<?php echo $user_details["user_id"];?>" class="btn btn-primary btn-block"><b>Edit</b></a>
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
                                            <td><a href='<?php echo base_url() ?>usadmin/child/view/<?php echo $child['user_id'] ?>'>View</a></td>
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
</script>