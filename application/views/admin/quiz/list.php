<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Quiz
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Quiz</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
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

                <?php if (($this->session->flashdata('error') != "")) { ?>
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->session->flashdata('error') ?></h3>
                        </div>
                    </div>
                <?php } ?>

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Quiz List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <a href="<?php echo base_url(); ?>usadmin/quiz/add" class="btn btn-primary pull-left">Add New</a>
                        <br /><br />
                        <table id="quiz-table" class="table table-bordered table-striped tree">
                            <thead>
                                <tr>
                                    <th>Quiz Title</th>
                                    <th>Section</th>
                                    <th>Category</th>
                                    <th>Age Group</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($quizes as $quiz) : 
                                        
                               ?>
                                <tr>
                                    <td><?php echo $quiz['quiz_title']?></td>
                                    <td><?php echo $quiz['section_name']?></td>
                                    <td><?php echo $quiz['category_name']?></td>
                                    <td><?php echo $quiz['age_group_name']?></td>
                                    <td><?php echo $quiz['created_date']?></td>
                                    <td><a href="<?php echo base_url().'usadmin/quiz/edit/'. $quiz['quiz_id']?>">Edit</a> | <a class="delete_quiz" href="<?php echo base_url().'usadmin/quiz/delete/'. $quiz['quiz_id']?>">Delete</a> | <a class="questions" href="<?php echo base_url().'usadmin/quiz/questions/list/'. $quiz['quiz_id']?>">Questions</a></td>
                                    
                                </tr>
                                    
                                <?php 
                                        endforeach;
                                    ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
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

<!-- /.content-wrapper -->
<div class="confirm-modal">
    <div class="modal modal-danger" id="confirm-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Warning!</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete this category?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-outline" id="confirm-delete-category">Yes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
<!-- /.confirm-modal -->

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <img src="" id="category_image_pop" class="img-responsive">
            </div>
        </div>
    </div>
</div>


<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/treeview/jquery.treegrid.min.js"></script>

<script>
    $(function () {

        $('#quiz-table').DataTable({
            "paging": true,
            "deferRender": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
       
        
       $('.delete_quiz').click(function(e){
       
        var r = confirm('Are you sure want to delete this Quiz?');
        
        if(r == false)
        {
        
        e.preventDefault();
        
        }    
        
        });

    });
</script>