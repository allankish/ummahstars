<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sections
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Sections</li>
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
                        <h3 class="box-title">Section List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <a href="<?php echo base_url(); ?>usadmin/section/add" class="btn btn-primary pull-left">Add New</a>
                        <br /><br />
                        <table id="sections-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Section Name</th>
                                    <th>Background Image</th>
                                    <th>Sort Order</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($sections as $section) { ?>
                                    <tr>
                                        <td><?php echo $section['section_name'] ?></td>
                                        <td><a href="javascript:void(0)" class="sec_image" image_url="<?php echo base_url() . $section['background_image'] ?>" data-toggle="modal" data-target="#myModal"><img src="<?php echo base_url() . $section['background_image'] ?>" width="20" /></a></td>
                                        <td><?php echo $section['sort_order'] ?></td>
                                        <td><a href='<?php echo base_url() ?>usadmin/section/edit/<?php echo $section['section_id'] ?>'>Edit</a> | <a id="delete_section-<?php echo $section["section_id"]; ?>" data-id="<?php echo $section["section_id"]; ?>" href='#'>Delete</a></td>
                                    </tr>
                                <?php } ?>
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
                    <p>Are you sure want to delete this section?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-outline" id="confirm-delete-section">Yes</button>
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
                <img src="" id="section_image_pop" class="img-responsive">
            </div>
        </div>
    </div>
</div>


<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
    $(function () {

        $('#sections-table').DataTable({
            "paging": true,
            "deferRender": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });




        $('.sec_image').click(function () {


// Get the modal

            $('#section_image_pop').attr('src', $(this).attr('image_url'));



        });


        $('a[id^="delete_section-"]').on('click', function () {
            var section_id = $(this).attr('data-id');
            $('#confirm-modal').modal('toggle');
            $('#confirm-delete-section').on('click', function () {

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>usadmin/section/delete',
                    dataType: 'html',
                    data: 'section_id=' + section_id,
                    success: function (result) {
                        if (result == 'success') {
                            $('#confirm-modal').modal('hide');
                            window.location.href = "<?php echo base_url(); ?>usadmin/section/";
                        } else {
                            $('#confirm-modal').modal('hide');
                            alert(result);
                        }
                    }
                });
            });
        });

    });
</script>