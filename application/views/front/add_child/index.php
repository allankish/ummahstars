<div class="wrapper-section BG_without_char">

    <div class="overlay-center-popup">				
        <div class="overlay-center-popup-inner clearfix">	
            <div class="shadow-layer clearfix account-creation-wrapper">
                <a href="<?php echo base_url(); ?>dashboard">
                    <span class="close-btn"><img src="<?php echo base_url(); ?>assets/front/images/Close_btn.png" alt="close-btn"></span>				
                </a>
                <div class="content mCustomScrollbar light login-wrapper" data-mcs-theme="minimal-dark">
                    <h2 class="popup-header">Add First Child</h2>
                    <div class="user-avatar-image">
                        <div class="user-avatar-image-circle">
                            <input type="file" id='upload' style='display:none;' onchange="previewFile()">
                            <img src="<?php echo base_url(); ?>assets/front/images/user.jpg" id='testimg'  alt="profile"/>
                        </div>
                    </div>
                    <form name="add_child_form" id="add_child_form" action="<?php echo base_url(); ?>add_child" method="post">
                        <?php if (validation_errors()) { ?>
                            <div class="error">
                                <?php echo validation_errors(); ?>
                            </div>
                        <?php } ?>
                        <?php if ($this->session->flashdata('Success')) { ?>
                            <div class="success">
                                <h4 style="font-weight:bold">
                                    Success!
                                </h4>
                                <p><?php echo $this->session->flashdata('Success'); ?></p>
                            </div>
                        <?php } ?>
                        <ul>
                            <li>
                                <label>Child’s Name</label>
                                <input name="uname" type="text" class="form-filed-style" placeholder="Enter your Child’s Name">
                                <input name="profile_img" id="profile_img" type="hidden" >
                            </li>
                            <li>
                                <label>Child’s Age</label>
                                <input name="age" type="text" class="form-filed-style" placeholder="Enter your Child’s Age"></li>

                            <li><label>Gender</label>
                                <form>
                                    <div class="gender-wrap-outer">
                                        <span class="gender-wrap"><input type="radio" name="gender" value="male" checked> Male</span>
                                        <span class="gender-wrap"><input type="radio" name="gender" value="female"> Female  </span>
                                    </div>
                                </form> 
                            </li>

                            <li><label>Age Group</label>
                                <div class="age-grp-wrap-outer">
                                    <?php foreach ($age_groups as $key => $age_group) { ?>
                                        <span class="age-grp-wrap">
                                            <input <?php echo ($key == '0') ? 'checked="checked" ' : ''; ?>type="radio" <?php if($age_group['password_required'] == 'true') { ?> class="passreq" <?php } else { ?> class="passnotreq" <?php } ?> name="age_group_id" value="<?php echo $age_group['age_group_id']; ?>"> <?php echo $age_group['age_group_name']; ?>
                                        </span>
                                    <?php } ?>
                                    <input name="password_required" id="password_required" type="hidden" >
                                </div>
                            </li>

                            <li class="passblock" style="display: none;">
                                <label>Password</label>
                                <input id="password" name="password" type="password" class="form-filed-style" placeholder="Enter your password"></li>

                            <li class="passblock" style="display: none;">
                                <label>Re-type Password</label>
                                <input id="retype_password" name="retype_password" type="password" class="form-filed-style" placeholder="Re-type your password"></li>


                            <li class="center-align"><a href="javascript:void(0);" id="add_more_child">Add more child</a></li>

                            <li class="center-align">
                                <input type="hidden" name="more_child" id="more_child" value=""/>
                                <button type="submit" name="submit" id="submit" class="red-btn sign-in-btn"> Create</button>
                                <a class="red-btn sign-in-btn" href="<?php echo base_url(); ?>dashboard">
                                    Back to Dashboard
                                </a>
                            </li>


                        </ul>
                    </form>
                </div>


            </div>
        </div>
    </div>
</div>

<script>
    $( "#add_more_child" ).on( "click", function() {
        $("#more_child").val(1);
        $( "#submit" ).trigger( "click" );
    });
</script>

<!-- Upload Profile Image -->
<script type='text/javascript'>
    function previewFile() {
        var preview = document.getElementById('testimg');
        var file    = document.querySelector('input[type=file]').files[0];
        var reader  = new FileReader();

        reader.addEventListener("load", function () {
            var extension = $('#upload').val().split('.').pop().toUpperCase();
            if (extension == "PNG" || extension == "JPG" || extension == "GIF" || extension == "JPEG"){
                //alert(extension);
                preview.src = reader.result;
                $( "#profile_img" ).val( reader.result );
            }
            else
            {
                alert('Invalid Image Uploaded. Please try again');
            }
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    $( "#testimg" ).on( "click", function() {
        $( "#upload" ).trigger( "click" );
    });

    $( ".passreq" ).on( "click", function() {
        $( ".passblock" ).show();
        $( "#password_required" ).val(1);
    });

    $( ".passnotreq" ).on( "click", function() {
        $( ".passblock" ).hide();
        $( "#password_required" ).val('');
    });
</script>