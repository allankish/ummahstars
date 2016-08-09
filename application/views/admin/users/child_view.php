<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Child Details
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'usadmin';?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'usadmin/users';?>">Users</a></li>
            <li class="active">Child Details</li>
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
                                <b>Age</b> <a class="pull-right"><?php echo $user_details["age"]; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Age Group</b> <a class="pull-right"><?php echo $user_details["age_group_name"]; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Member Since</b> <a class="pull-right"><?php echo date('m/d/Y', strtotime($user_details["created_on"])); ?></a>
                            </li>
                        </ul>
                        <a href="<?php echo base_url();?>usadmin/users/view/<?php echo $user_details["parent_id"];?>" class="btn btn-primary btn-block"><b>Back</b></a>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1" data-toggle="tab">TAB 1</a></li>
                        <li><a href="#tab2" data-toggle="tab">TAB 2</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="tab1">
                            <p>Tab content goes here.</p>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab2">
                            {TAB Content goes here.}
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