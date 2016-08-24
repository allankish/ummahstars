<!-- Content Wrapper. Contains page content -->
<script src="<?php echo base_url()?>assets/images/loadingoverlay.min.js"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Quiz
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#"><i class="fa fa-dashboard"></i>Quiz</a></li>
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
                        <h3 class="box-title">Add Quiz</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" name="quiz_form" action="<?php echo base_url(); ?>usadmin/quiz/edit/<?php echo $quizes['quiz_id']?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group col-xs-9">
                                <label for="quiz_title">Quiz Title</label>
                                <input type="text" class="form-control" id="quiz_title" name="quiz_title" value="<?php echo $quizes['quiz_title']?>" placeholder="Enter Quiz Title">
                           </div>
                            <div class="form-group col-xs-9">
                                <label>Section</label>
                                <select class="form-control" id="section_id" name="section_id">
                                     <option value="">Select Section</option>
                                    <?php foreach ($sections as $section): ?>
                                    <option value="<?php echo $section['section_id'];?>" <?php if($quizes['section_id'] == $section['section_id']) echo 'selected' ?>><?php echo $section['section_name'];?></option>
                                    <?php endforeach; ?>
                                </select>
                                <img src="<?php echo base_url()?>assets/images/loader.gif" id="loader_img" style="display:none"/>
                            </div>
                            
                            <div class="form-group col-xs-9">
                                <label>Category</label>
                                <select class="form-control" id="category_id" name="category_id">
                                    <option value="">Select Category</option>
                                </select>
                            </div>
                            
                            <input type="hidden" id="category_old_value" name="category_old_value" value="<?php echo $quizes['category_id'] ?>"/>
                            
                            <div class="form-group col-xs-9">
                                <label>Age Group</label>
                                <select class="form-control" id="age_group_id" name="age_group_id">
                                     <option value="">Select Age Group</option>
                                    <?php foreach ($age_groups as $age_group): ?>
                                    <option value="<?php echo $age_group['age_group_id'];?>" <?php if($quizes['age_group_id'] == $age_group['age_group_id']) echo 'selected' ?>><?php echo $age_group['age_group_name'];?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                           <div class="form-group col-xs-9">
                                <label for="deeds">Deeds</label>
                                <input type="text" class="form-control" id="deed" name="deed" value="<?php echo $quizes['deed'] ?>" placeholder="Enter Number of Deeds">
                           </div>
                            
                           <div class="form-group col-xs-9">
                                <label for="no_questions">Number of Questions</label>
                                <input type="text" class="form-control" id="no_questions" name="no_questions" value="<?php echo $quizes['no_questions'] ?>" placeholder="Enter Number of Questions">
                           </div>
                            
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
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

<script type="text/javascript">
$(document).ready(function(){
    
   
   
  $('#section_id').change(function(){
      
      var old_cat_id = $('#category_old_value').val()
      $('#category_old_value').val('');
      
      
     $.LoadingOverlay("show");
    
     section_id = $(this).val();
     $.ajax({
        url: '<?php echo base_url()?>usadmin/content/get_categories_ajax/',
        type : 'POST',
        dataType: 'json',
        data: {section_id : section_id},
        success: function( resp ) {
      
       cathtml = '<option value="">Select Category</option>';
       for(var i=0;i<resp.categories.length; i++) {
       category_id = resp.categories[i].category_id;
       category_name = resp.categories[i].category_name;
       
       cathtml+='<option value="'+category_id+'">'+category_name+'</option>';
    
        }
        
        $('#category_id').html(cathtml);
        
        $('#category_id').val(old_cat_id);
        $.LoadingOverlay("hide");
        },
        error: function( req, status, err ) {
        $.LoadingOverlay("hide");
        alert("Something went Wrong. Pleaes try again");
        }
        });
      
        });
        
        $('#content_type').change(function(){
        
         $('#content_sec').hide();
         $('#video_sec').hide();
        
        if($(this).val() == 'text')
        $('#content_sec').show();
        
        if($(this).val() == 'video')
        $('#video_sec').show();
        
        
        
        });
        
        
    if($('#section_id').val()!="")  // If Section is chosen, and if validation fails, the category will be loaded for prefill the old values
    {
     $('#section_id').trigger('change'); 
    }
    
});
    
</script>
