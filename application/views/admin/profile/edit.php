<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'usadmin'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'usadmin/profile'; ?>">Profile</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">		  
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Profile</h3>
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
                    <!-- form start -->
                    <form role="form" name="user_form" action="<?php echo base_url(); ?>usadmin/profile" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group col-xs-9">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter first name" value="<?php echo $admin_details['first_name']; ?>">
                            </div>
                            <div class="form-group col-xs-9">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter last name" value="<?php echo $admin_details['last_name']; ?>">
                            </div>
                            <div class="form-group col-xs-9">
                                <label for="admin_email">Email Id</label>
                                <input type="text" class="form-control" name="admin_email" id="admin_email" placeholder="Enter admin email id" value="<?php echo $admin_details["admin_email"]; ?>">
                            </div>
                            <div class="form-group col-xs-9">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                            </div>
                            <div class="form-group col-xs-9">
                                <label for="retype_password">Retype New Password</label>
                                <input type="password" class="form-control" name="retype_password" id="retype_password" placeholder="Enter Retype Password">
                            </div>

                            <div class="form-group col-xs-9">
                                <label for="profile_image">Profile Image</label>
                                <?php if ($admin_details["profile_image"] != '') { ?>
                                    <br />
                                    <img src="<?php echo base_url() . $admin_details["profile_image"]; ?>" />
                                <?php } ?>
                                <input type="file" id="profile_image" name="profile_image">

                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <input type="hidden" name="admin_id" value="<?php echo $admin_details["admin_id"]; ?>" />
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