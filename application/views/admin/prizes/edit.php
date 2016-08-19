<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Prizes
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#"><i class="fa"></i>Prizes</a></li>
            <li class="active">Edit Prize</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">		  
            <div class="col-md-12">
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
                        <h3 class="box-title">Edit Prize</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" name="prize_form" action="<?php echo base_url(); ?>usadmin/prizes/edit/<?php echo $prize["prize_id"]; ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group col-xs-9">
                                <label for="prize_name">Prize Name</label>
                                <input type="text" class="form-control" id="prize_name" name="prize_name" value="<?php echo $prize["prize_name"]; ?>">
                            </div>
                            <div class="form-group col-xs-9">
                                <label for="background_image">Prize Image</label><br />
                                <?php if (isset($prize["prize_image"]) && $prize["prize_image"] != '') { ?>
                                <img width="200" src="<?php echo base_url() . $prize["prize_image"];?>" />
                                <input value="<?php echo base64_encode($prize["prize_image"]); ?>" type="hidden" name="prize_image_old" id="prize_image_old">
                                <?php } ?>
                                <input type="file" name="prize_image" id="prize_image">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <a href="<?php echo base_url();?>usadmin/prizes" class="btn btn-primary">Back</a>
                            <button type="submit" id="prize_submit" class="btn btn-primary">Update</button>
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