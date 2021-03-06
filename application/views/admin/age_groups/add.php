<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Age Groups
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'usadmin'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'usadmin/age-groups'; ?>"><i class="fa fa-dashboard"></i>Age Groups</a></li>
            <li class="active">Add New</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">		  
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Age Group</h3>
                        <?php if (validation_errors()) { ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                <?php echo validation_errors(); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" name="age_group_form" action="<?php echo base_url(); ?>usadmin/age-groups/add" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group col-xs-9">
                                <label for="age_group_name">Age Group Name</label>
                                <input type="text" name="age_group_name" class="form-control" id="age_group_name" placeholder="Enter Age Group Name">
                            </div>
                            <div class="form-group col-xs-9">
                                <label for="sort_order">Sort Order</label>
                                <input type="text" name="sort_order" class="form-control" id="sort_order" placeholder="Enter Sort Order">
                            </div>
                            <div class="form-group col-xs-9">
                                <div class="checkbox">
                                    <label for="password_required">
                                        <input checked="checked" type="checkbox" name="password_required" id="password_required" value="true" />
                                        Password required to login
                                    </label>
                                </div>
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