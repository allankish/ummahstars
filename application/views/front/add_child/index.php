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
                        <div class="user-avatar-image-circle"><img src="<?php echo base_url(); ?>assets/front/images/user.jpg" alt="profile"/></div>
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
                                            <input <?php echo ($key == '0') ? 'checked="checked" ' : ''; ?>type="radio" name="age_group_id" value="<?php echo $age_group['age_group_id']; ?>"> <?php echo $age_group['age_group_name']; ?>
                                        </span>
                                    <?php } ?>
                                </div>
                            </li>

                            <li class="center-align"><a href="#">Add more child</a></li>

                            <li class="center-align">
                                <button type="submit" name="submit" class="red-btn sign-in-btn"> Create</button>
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