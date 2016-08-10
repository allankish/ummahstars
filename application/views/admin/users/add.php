<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add User
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'usadmin';?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'usadmin/users';?>">Users</a></li>
            <li class="active">Add</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add User</h3>
                        <?php if (validation_errors()) { ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                <?php echo validation_errors(); ?>
                            </div>
                        <?php } ?>
                        <?php if ($this->session->flashdata('Error')) { ?>
                        <div class="alert alert-danger alert-dismissible">
                                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                <h4>
                                    <i class="icon fa fa-ban"></i>
                                    Error!
                                </h4>
                                <?php echo $this->session->flashdata('Error'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" name="user_form" action="<?php echo base_url(); ?>usadmin/users/add" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group col-xs-9">
                                <label for="parent_name">Parent Name</label>
                                <input type="text" class="form-control" name="parent_name" id="parent_name" placeholder="Enter parent name">
                            </div>
                            <div class="form-group col-xs-9">
                                <label for="parent_email">Email Id</label>
                                <input type="text" class="form-control" name="parent_email" id="parent_email" placeholder="Enter parent email id">
                            </div>
                            <div class="form-group col-xs-9">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                            </div>
                            <div class="form-group col-xs-9">
                                <label for="retype_password">Retype Password</label>
                                <input type="password" class="form-control" name="retype_password" id="retype_password" placeholder="Enter Retype Password">
                            </div>
                            <div class="form-group col-xs-9">
                                <label>Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>

                            <div class="form-group col-xs-9">
                                <label>Parent Type</label>
                                <select class="form-control" name="parent_type">
                                    <option value="active">Active</option>
                                    <option value="passive">Passive</option>
                                </select>
                            </div>
                            <div class="form-group col-xs-9">
                                <label for="child_allowed">Child Allowed</label>
                                <input type="text" class="form-control" name="child_allowed" id="child_allowed" value="4">
                            </div>

                            <div class="form-group col-xs-9">
                                <label for="profile_image">Profile Image</label>
                                <input type="file" id="profile_image" name="profile_image">
                                
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
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