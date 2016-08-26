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
            <li class="active">Edit Goal</li>
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
                        <h3 class="box-title">Edit Goal</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" name="goal_form" action="<?php echo base_url(); ?>usadmin/goals/edit/<?php echo $goal['goal_id']; ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group col-xs-9">
                                <label for="goal_description">Goal Description</label>
                                <input type="text" class="form-control" id="goal_description" name="goal_description" value="<?php echo $goal["goal_description"]; ?>">
                            </div>
                            <div class="form-group col-xs-9">
                                <label for="deed_amount">Deed Amount</label>
                                <input type="text" class="form-control" id="deed_amount" name="deed_amount" value="<?php echo $goal["deed_amount"];?>">
                            </div>
                            <div class="form-group col-xs-9">
                                <label>Prize</label>
                                <select class="form-control" name="prize_id">
                                    <?php foreach ($prizes as $prize): ?>
                                    <?php $prize_selected = ($prize['prize_id'] == $goal['prize_id']) ? " selected='selected'": "";?>
                                    <option value="<?php echo $prize['prize_id'];?>"<?php echo $prize_selected; ?>><?php echo $prize['prize_name'];?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-xs-9">
                                <label>Age Group</label>
                                <select class="form-control" name="age_group">
                                    <option value="0">All</option>
                                    <?php foreach ($age_groups as $age_group): ?>
                                    <?php $age_group_selected = ($age_group['age_group_id'] == $goal['age_group']) ? ' selected="selected"' : '';?>
                                    <option value="<?php echo $age_group['age_group_id']; ?>"<?php echo $age_group_selected; ?>><?php echo $age_group['age_group_name'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="form-group col-xs-9">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="active"<?php echo ($goal['status'] == 'active') ? "selected='selected'":'';?>>Active</option>
                                    <option value="inactive"<?php echo ($goal['status'] == 'inactive') ? "selected='selected'":'';?>>Inactive</option>
                                </select>
                            </div>
                            
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <a href="<?php echo base_url();?>usadmin/goals" class="btn btn-primary">Back</a>
                            <button type="submit" id="goal_submit" class="btn btn-primary">Update</button>
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

