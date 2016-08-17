<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Categories
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#"><i class="fa fa-dashboard"></i>Categories</a></li>
            <li class="active">Edit</li>
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
                        <h3 class="box-title">Edit Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" name="category_form" action="<?php echo base_url(); ?>usadmin/categories/edit/<?php echo $category["category_id"]; ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group col-xs-9">
                                <label>Section</label>
                                <?php 
                                $section_id = $category["section_id"];
                                $parent_id = $category["parent_id"];
                                ?>
                                <select class="form-control" name="section_id">
                                    <?php foreach ($sections as $section): ?>
                                    <option value="<?php echo $section['section_id'];?>"<?php echo ($section_id == $section['section_id']) ? ' selected="selected"' :''; ?>><?php echo $section['section_name'];?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-xs-9">
                                <label>Parent Category</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">Top</option>
                                    <?php foreach ($root_categories as $root_category): ?>
                                    <option value="<?php echo $root_category['category_id']; ?>"<?php echo ($parent_id == $root_category['category_id']) ? ' selected="selected"' :''; ?>><?php echo $root_category['category_name'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="form-group col-xs-9">
                                <label for="category_name">Category Name</label>
                                <input type="text" class="form-control" id="category_name" name="category_name" value="<?php echo $category["category_name"]; ?>">
                            </div>
                            <div class="form-group col-xs-9">
                                <?php
                                $category_type = $category["category_type"];
                                ?>
                                <label>Category Type</label>
                                <select class="form-control" name="category_type">
                                    <option value="video"<?php echo ($category["category_type"] == 'video') ? ' selected="selected"':'';?>>Video</option>
                                    <option value="book"<?php echo ($category["category_type"] == 'book') ? ' selected="selected"':'';?>>Book</option>
                                </select>
                            </div>
                            <div class="form-group col-xs-9">
                                <?php $need_payment = $category["need_payment"]; ?>
                                <label>Paid Content</label>
                                <select class="form-control" name="need_payment">
                                    <option value="true"<?php echo ($category["need_payment"] === 'true') ? ' selected="selected"':'';?>>Yes</option>
                                    <option value="false"<?php echo ($category["need_payment"] === 'false') ? ' selected="selected"':'';?>>No</option>
                                </select>
                            </div>
                            <div class="form-group col-xs-9">
                                <label for="sort_order">Sort Order</label>
                                <input type="text" class="form-control" id="sort_order" name="sort_order"  value="<?php echo $category['sort_order']; ?>">
                            </div>
                            <div class="form-group col-xs-9">
                                <label for="background_image">Background Image</label>
                                <?php if ($category["background_image"] != '') { ?>
                                <br />
                                <img width="200" src="<?php echo base_url() . $category["background_image"];?>" />
                                <?php } ?>
                                <input type="file" name="background_image" id="background_image">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <a href="<?php echo base_url();?>usadmin/categories" class="btn btn-primary">Back</a>
                            <button type="submit" id="category_submit" class="btn btn-primary">Submit</button>
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

