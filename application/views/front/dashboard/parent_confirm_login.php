<div class="wrapper-section BG_without_char">
    <div class="overlay-center-popup">				
        <div class="overlay-center-popup-inner clearfix">	
            <div class="shadow-layer-child-sign-in-outer">

                <div class="shadow-layer shadow-layer-child-sign-in clearfix sign-in-wrapper">
                    <a href="<?php echo base_url(); ?>dashboard">
                        <span class="close-btn">
                            <img src="<?php echo base_url(); ?>assets/front/images/Close_btn.png" alt="close-btn">
                        </span>
                    </a>
                    <div class="login-wrapper">
                        <div class="user-avatar-image">
                            <div class="user-avatar-image-circle">
                                <img src="<?php echo base_url(); ?><?php echo ($profile_image != '') ? $profile_image : 'assets/front/images/user.jpg'; ?>" alt="profile"/>
                            </div>
                            <div><?php echo $parent_name; ?></div>
                        </div>
                        <?php if ($this->session->flashdata('Error')) { ?>
                            <div class="error">
                                <h4 style="font-weight:bold">
                                    Error!
                                </h4>
                                <p><?php echo $this->session->flashdata('Error'); ?></p>
                            </div>
                        <?php } ?>
                        <?php if (validation_errors()) { ?>
                            <div class="error">
                                <h4 style="font-weight:bold">
                                    Error!
                                </h4>
                                <p><?php echo validation_errors(); ?></p>
                            </div>
                        <?php } ?>
                        <form name="confirm_parent_form" id="confirm_parent_form" action="<?php echo base_url('dashboard/confirm_parent'); ?>" method="post">
                            <ul>
                                <li>
                                    <label>Password</label>
                                    <input id="password" type="password" name="password" class="form-filed-style" placeholder="Enter your password"></li>
                                <li class="center-align"><button type="submit" name="submit" class="red-btn sign-in-btn">Confirm</button></li>
                            </ul>
                        </form>
                    </div>
                </div>

            </div>
            <div class="hover-child-btn-wrapper">
                <a href="<?php echo base_url(); ?>dashboard" class="hover-child-btn">Back</a>
            </div>
        </div>
    </div>
</div>