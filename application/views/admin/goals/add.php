<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Goals
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#"><i class="fa fa-dashboard"></i>Goals</a></li>
            <li class="active">Add New</li>
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
                        <h3 class="box-title">Add Goal</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" name="goal_form" action="<?php echo base_url(); ?>usadmin/goals/add" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group col-xs-9">
                                <label for="goal_description">Goal Description</label>
                                <input type="text" class="form-control" id="goal_description" name="goal_description" placeholder="Enter Goal Description">
                            </div>
                            <div class="form-group col-xs-9">
                                <label for="deed_amount">Deed Amount</label>
                                <input type="text" class="form-control" id="deed_amount" name="deed_amount" placeholder="Enter Deed Amount">
                            </div>
                            <div class="form-group col-xs-9">
                                <label>Prize</label>
                                <select class="form-control" name="prize_id">
                                    <?php foreach ($prizes as $prize): ?>
                                    <option value="<?php echo $prize['prize_id'];?>"><?php echo $prize['prize_name'];?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-xs-9">
                                <label>Age Group</label>
                                <select class="form-control" name="age_group">
                                    <option value="0">All</option>
                                    <?php foreach ($age_groups as $age_group): ?>
                                    <option value="<?php echo $age_group['age_group_id']; ?>"><?php echo $age_group['age_group_name'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="form-group col-xs-9">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" id="goal_submit" class="btn btn-primary">Submit</button>
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

