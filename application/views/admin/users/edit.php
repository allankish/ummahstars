<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit User
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'usadmin';?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'usadmin/users';?>">Users</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">		  
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit User</h3>
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
                    <form role="form" name="user_form" action="<?php echo base_url(); ?>usadmin/users/edit/<?php echo $user_details['user_id']; ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group col-xs-9">
                                <label for="parent_name">Parent Name</label>
                                <input type="text" class="form-control" name="parent_name" id="parent_name" placeholder="Enter parent name" value="<?php echo $user_details['uname']; ?>">
                            </div>
                            <div class="form-group col-xs-9">
                                <label for="parent_email">Email Id</label>
                                <input type="text" class="form-control" name="parent_email" id="parent_email" placeholder="Enter parent email id" value="<?php echo $user_details["email_id"]; ?>">
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
                                <label>Gender</label>
                                <?php
                                $gender = $user_details["gender"];
                                $male_selected = $female_selected = "";
                                ($gender == 'female') ? $female_selected = " selected='selected'" : $male_selected = " selected='selected'";
                                ?>
                                <select class="form-control" name="gender">
                                    <option value="male"<?php echo $male_selected; ?>>Male</option>
                                    <option value="female"<?php echo $female_selected; ?>>Female</option>
                                </select>
                            </div>

                            <div class="form-group col-xs-9">
                                <label>Parent Type</label>
                                <?php
                                $parent_type = $user_details["parent_type"];
                                $active_selected = $passive_selected = "";
                                ($parent_type == 'active') ? $active_selected = " selected='selected'" : $passive_selected = " selected='selected'";
                                ?>
                                <select class="form-control" name="parent_type">
                                    <option value="active"<?php echo $active_selected; ?>>Active</option>
                                    <option value="passive"<?php echo $passive_selected; ?>>Passive</option>
                                </select>
                            </div>

                            <div class="form-group col-xs-9">
                                <label for="profile_image">Profile Image</label>
                                <?php if ($user_details["profile_image"] != '') { ?>
                                <br />
                                <img src="<?php echo base_url() . $user_details["profile_image"];?>" />
                                <?php } ?>
                                <input type="file" id="profile_image" name="profile_image">
                                
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <input type="hidden" name="user_id" value="<?php echo $user_details["user_id"]; ?>" />
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