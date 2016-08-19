<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Contents
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Contents</li>
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
                        <h3 class="box-title">Content List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <a href="<?php echo base_url(); ?>usadmin/content/add" class="btn btn-primary pull-left">Add New</a>
                        <br /><br />
                        <table id="categories-table" class="table table-bordered table-striped tree">
                            <thead>
                                <tr>
                                    <th>Section</th>
                                    <th>Category</th>
                                    <th>Content Type</th>
                                    <th>Age Group</th>
                                    <th>Sort Order</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($contents as $content) : 
                                        
                               ?>
                                <tr>
                                    <td><?php echo $content['section_name']?></td>
                                    <td><?php echo $content['category_name']?></td>
                                    <td><?php echo $content['content_type']?></td>
                                    <td><?php echo $content['age_group_name']?></td>
                                    <td><?php echo $content['sort_order']?></td>
                                    <td><?php echo $content['created_date']?></td>
                                    <td><a href="<?php echo base_url().'usadmin/content/edit/'. $content['content_id']?>">Edit</a> | <a href="<?php echo base_url().'usadmin/content/delete/'. $content['content_id']?>">Delete</a></td>
                                    
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

        $('#categories-table1').DataTable({
            "paging": true,
            "deferRender": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
        $('.category_image').click(function () {
            // Get the modal
            $('#category_image_pop').attr('src', $(this).attr('image_url'));
        });

        $('a[id^="delete_category-"]').on('click', function () {
            var category_id = $(this).attr('data-id');
            $('#confirm-modal').modal('toggle');
            $('#confirm-delete-category').on('click', function () {

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>usadmin/category/delete',
                    dataType: 'html',
                    data: 'category_id=' + category_id,
                    success: function (result) {
                        if (result == 'success') {
                            $('#confirm-modal').modal('hide');
                            window.location.href = "<?php echo base_url(); ?>usadmin/category/";
                        } else {
                            $('#confirm-modal').modal('hide');
                            alert(result);
                        }
                    }
                });
            });
        });
        
        $('.tree').treegrid({
            initialState: 'collapsed',
            expanderExpandedClass: 'fa fa-minus-circle',
            expanderCollapsedClass: 'fa fa-plus-circle'
        });

    });
</script>