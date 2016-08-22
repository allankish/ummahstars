<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Content
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#"><i class="fa"></i>Content</a></li>
            <li class="active">Edit Content</li>
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
                        <h3 class="box-title">Edit Content</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" name="content_form" action="<?php echo base_url(); ?>usadmin/content/edit/<?php echo $content[0]['content_id']?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group col-xs-9">
                                <label>Section</label>
                                <select class="form-control" id="section_id" name="section_id">
                                     <option value="">Select Section</option>
                                    <?php foreach ($sections as $section): ?>
                                    <option value="<?php echo $section['section_id'];?>" <?php if($content[0]['section_id'] == $section['section_id']) echo 'selected'?>><?php echo $section['section_name'];?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-xs-9">
                                <label>Category</label>
                                <select class="form-control" id="category_id" name="category_id">
                                    content_cats
                                     <?php foreach ($content_cats as $content_cat): ?>
                                    <option value="<?php echo $content_cat['category_id']?>" <?php if($content[0]['category_id'] == $content_cat['category_id']) echo 'selected'?>><?php echo $content_cat['category_name']?></option>
                                     <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-xs-9">
                                <label>Content Type</label>
                                <select class="form-control" name="content_type" id="content_type">
                                    <option value="">Select Type</option>
                                    <option value="text" <?php if($content[0]['content_type'] == 'text') echo 'selected'?>>Text</option>
                                    <option value="video" <?php if($content[0]['content_type'] == 'video') echo 'selected'?>>Video</option>
                                </select>
                            </div>
                            <?php
                            if($content[0]['video_url']!="")
                            {
                                ?>
                            
                            <div class="form-group col-xs-9">
                                <label>Video Link</label>
                                <div><a href="<?php echo base_url().$content[0]['video_url']?>" target="_blank">Video File</a></div>
                            </div>
                            <?php
                            }
                            ?>
                            <inpu type="hidden" name="video_url_val" value="<?php echo $content[0]['video_url']?>"/>
                            <div class="form-group col-xs-9" id="video_sec" <?php if($content[0]['content_type'] == 'text') echo 'style="display:none;"';?>>
                                <label for="background_image">Upload Video</label><br />
                                <input type="file" name="video_file" id="video_file">
                                
                            </div>
                            
                            <div class="form-group col-xs-9" id="content_sec" <?php if($content[0]['content_type'] == 'video') echo 'style="display:none;"';?>>
                                <label>Content</label>
                                <textarea class="form-control" rows="3" placeholder="Enter Content.." name="content"><?php echo $content[0]['content']?></textarea>
                            </div>
                            
                            <div class="form-group col-xs-9">
                                <label>Age Group</label>
                                <select class="form-control" id="age_group_id" name="age_group_id">
                                     <option value="">Select Age Group</option>
                                    <?php foreach ($age_groups as $age_group): ?>
                                    <option value="<?php echo $age_group['age_group_id'];?>" <?php if($content[0]['age_group_id'] == $age_group['age_group_id']) echo 'selected'?>><?php echo $age_group['age_group_name'];?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                             <div class="form-group col-xs-9">
                                <label for="sort_order">Sort Order</label>
                                <input type="text" class="form-control" id="sort_order" name="sort_order"  value="<?php echo $content[0]['sort_order'] ?>" placeholder="Enter Sort Order">
                            </div>
                            
                            
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" id="section_submit" class="btn btn-primary">Submit</button>
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
       
        },
        error: function( req, status, err ) {
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
    
});
    
</script>
