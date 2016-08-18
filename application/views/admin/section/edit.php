<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Section
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#"><i class="fa"></i>Section</a></li>
            <li class="active">Edit Section</li>
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
                        <h3 class="box-title">Edit Section</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" name="section_form" action="<?php echo base_url(); ?>usadmin/section/edit/<?php echo $section["section_id"]; ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group col-xs-9">
                                <label for="section_name">Section Name</label>
                                <input type="text" class="form-control" id="section_name" name="section_name" value="<?php echo $section["section_name"]; ?>">
                            </div>
                            <div class="form-group col-xs-9">
                                <label for="sort_order">Sort Order</label>
                                <input type="text" class="form-control" id="sort_order" name="sort_order"  value="<?php echo $section["sort_order"]; ?>">
                            </div>
                            <div class="form-group col-xs-9">
                                <label for="background_image">Background Image</label><?php 
                                foreach($age_groups as $age_group): 
                                    $background_images = unserialize($section["background_image"]);
                                ?>
                                <br />
                                <label for="background_image-<?php echo $age_group['age_group_id']; ?>">Age Group: <?php echo $age_group['age_group_name']; ?></label>
                                <?php if (isset($background_images[$age_group["age_group_id"]]) && $background_images[$age_group["age_group_id"]] != '') { ?>
                                <br />
                                <img width="200" src="<?php echo base_url() . $background_images[$age_group["age_group_id"]];?>" />
                                <input value="<?php echo base64_encode($background_images[$age_group["age_group_id"]]); ?>" type="hidden" name="background_image_old-<?php echo $age_group["age_group_id"];?>" id="background_image_old-<?php echo $age_group["age_group_id"];?>">
                                <?php } ?>
                                <input type="file" name="background_image-<?php echo $age_group["age_group_id"];?>" id="background_image-<?php echo $age_group["age_group_id"];?>">
                                
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <a href="<?php echo base_url();?>usadmin/section" class="btn btn-primary">Back</a>
                            <button type="submit" id="section_submit" class="btn btn-primary">Update</button>
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