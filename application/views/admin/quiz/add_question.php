<!-- Content Wrapper. Contains page content -->
<script src="<?php echo base_url()?>assets/images/loadingoverlay.min.js"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           <?php echo $quiz_details[0]['quiz_title'];?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#"><i class="fa fa-dashboard"></i>Quiz</a></li>
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
                        <h3 class="box-title">Add Question</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" name="question_form" action="<?php echo base_url(); ?>usadmin/quiz/question/add/<?php echo $quiz_details[0]['quiz_id']?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group col-xs-9">
                                <label for="quiz_title">Question</label>
                                <textarea name="question" placeholder="Enter Question" class="form-control"><?php echo $this->session->flashdata('question') ?></textarea>
                            </div>
                            <div class="form-group col-xs-7" id="question_options">    
                                <div class="option-wrapper" id="option_wrapper_1">
                                <label class="opt-cls">Option1</label>
                                <input class="inpt-cls" type="text" size="50" name="option1" id="option1">                               
                          
                                <div class="radio radio-align">
                                <label>
                                <input type="radio" name="answer" value="option1">
                                Is Answer
                                </label>
                                </div> 
                                <div class="radio-align remove-quiz">
                                    <a id="remove_option_1" option_id="1" class="remove_options_val" href="javascript:void(0);">Remove</a>
                                </div>
                                </div>  
                                <div class="option-wrapper" id="option_wrapper_2">
                                <label class="opt-cls">Option2</label>
                                <input class="inpt-cls" type="text" size="50" name="option2" id="option2">                               
                          
                                <div class="radio radio-align">
                                <label>
                                <input type="radio" name="answer" value="option2">
                                Is Answer
                                </label>
                                </div> 
                                <div class="radio-align remove-quiz">
                                    <a id="remove_option_2" option_id="2" class="remove_options_val" href="javascript:void(0);">Remove</a>
                                </div>
                                </div>  
                            </div>
                            
                            <div class="form-group col-xs-9">
                            
                                <a href="javascript:void(0);" id="add_more_options">Add more options</a>
                            
                            </div>
                            
                            
                            <input type="hidden" id="total_options" name="total_options" value="2"/>
                            
                            <div class="form-group col-xs-9">
                                <label>Status</label>
                                <div class="radio">
                                <label>
                                    <input type="radio" checked="" value="active" id="status" name="status">
                                     Active
                                </label>
                                </div>
                                <div class="radio">
                                <label>
                                    <input type="radio" value="inactive" id="status" name="status">
                                     InActive
                                </label>
                                </div>
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
    
      $('.remove-quiz').hide();
   $('#add_more_options').click(function(){
       
     var curr_options = parseInt($('#total_options').val());
     var added_option = curr_options+1;
     
     $('#question_options').append('<div class="option-wrapper" id="option_wrapper_'+added_option+'"><label class="opt-cls">Option'+added_option+' </label>\n\
                                    <input class="inpt-cls" type="text" size="50" name="option'+added_option+'" id="option'+added_option+'">\n\
                                    <div class="radio radio-align"><label><input type="radio" name="answer" value="option'+added_option+'">Is Answer</label>\n\
                                    </div><div class="radio-align remove-quiz"><a href="javascript:void(0);" class="remove_options_val" option_id="'+added_option+'" id="remove_option_'+added_option+'">Remove</a></div></div>'); 
       
       $('#total_options').val(added_option);
       
        $('.remove-quiz').show();
      
      // $('#remove_option_'+curr_options).hide();
      
   });
   
   $(document).on('click','.remove_options_val',function(){
       
       var option_id = $(this).attr('option_id');
    
       var curr_options2 = parseInt($('#total_options').val());
          $('#option_wrapper_'+option_id).remove();
       var added_option2 = curr_options2-1;
       $('#total_options').val(added_option2);
      // $('#remove_option_'+added_option2).show();
      if(added_option2==2){
         $('.remove-quiz').hide();
      }
        var total_opt = $('#total_options').val();
         var i;
        for( i=0; i<total_opt; i++){ 
            $("#question_options").find(".option-wrapper .opt-cls").eq(i).text("Option"+(i+1));
            $("#question_options").find(".option-wrapper").eq(i).attr('id','option_wrapper_'+(i+1));
            $("#question_options").find(".option-wrapper .inpt-cls").eq(i).attr('id','option'+(i+1));
            $("#question_options").find(".option-wrapper .inpt-cls").eq(i).attr('name','option'+(i+1));
            $("#question_options").find(".option-wrapper .remove_options_val").eq(i).attr('id','remove_option_'+(i+1));
            $("#question_options").find(".option-wrapper .remove_options_val").eq(i).attr('option_id',(i+1));
        }
    });
  
    
});
    
</script>
