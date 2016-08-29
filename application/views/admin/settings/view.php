<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Settings
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Settings</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">		  
            <div class="col-md-12">
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
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Settings</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" name="settings_form" action="<?php echo base_url(); ?>usadmin/settings" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <?php foreach($setting_vars as $setting_var) { ?>
                            <div class="form-group col-xs-9">
                                <label for="<?php echo $setting_var['key']; ?>"><?php echo $setting_var['label']; ?></label>
                                <input type="text" class="form-control" id="<?php echo $setting_var['key']; ?>" name="<?php echo $setting_var['key']; ?>" value="<?php echo $settings[$setting_var['key']]; ?>">
                            </div>
                            <?php } ?>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" id="settings_submit" class="btn btn-primary">Update</button>
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

