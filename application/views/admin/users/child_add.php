<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'usadmin'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'usadmin/users/' . $parent_id; ?>">All Child</a></li>
            <li class="active">Add</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Child</h3>
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
                    <form role="form" name="child_form" action="<?php echo base_url(); ?>usadmin/child/add/<?php echo $parent_id; ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group col-xs-9">
                                <label for="child_name">Child Name</label>
                                <input type="text" class="form-control" name="child_name" id="child_name" placeholder="Enter child name">
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
                                <label for="age">Age</label>
                                <input type="text" class="form-control" name="age" id="age" placeholder="Enter child age">
                            </div>

                            <div class="form-group col-xs-9">
                                <label>Age Group</label>
                                <select class="form-control" name="age_group">
                                    <?php foreach ($age_groups as $age_group): ?>
                                        <option value="<?php echo $age_group["age_group_id"]; ?>"><?php echo $age_group["age_group_name"]; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-xs-9">
                                <label for="profile_image">Profile Image</label>
                                <input type="file" id="profile_image" name="profile_image">

                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
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