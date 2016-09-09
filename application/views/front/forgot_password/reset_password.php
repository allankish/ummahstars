<div class="wrapper-section BG_without_char">

    <div class="overlay-center-popup">				
        <div class="overlay-center-popup-inner clearfix">	
            <div class="shadow-layer clearfix account-creation-wrapper">
                <span class="close-btn">
                    <a href="<?php echo base_url();?>login">
                    <img src="<?php echo base_url(); ?>assets/front/images/Close_btn.png" alt="close">
                    </a>
                </span>				
                <div class="login-wrapper forgot-wrapper">
                    <h2 class="popup-header">Reset Password</h2>
                    <?php if ($this->session->flashdata('Error')) { ?>
                        <div class="error">
                            <h4 style="font-weight:bold">
                                Error!
                            </h4><br />
                            <p><?php echo $this->session->flashdata('Error'); ?></p>
                        </div>
                    <?php } ?>
                    <ul>
                        <form id="reset_password_form" name="reset_password_form" action="<?php echo base_url(); ?>forgot_password/reset_password" method="post">
                            <li>
                                <label>New Password</label>
                                <input id="password" name="password" type="password" class="form-filed-style" placeholder="Enter your new password">
                            </li>
                            <li>
                                <label>Retype New Password</label>
                                <input id="retype_password" name="retype_password" type="password" class="form-filed-style" placeholder="Retype your new password">
                            </li>
                            <li class="center-align">
                                <input type="hidden" name="password_reset_key" value="<?php echo $password_reset_key; ?>" />
                                <button type="submit" name="submit" class="red-btn sign-in-btn">Submit</button> 
                                <button name="cancel" type="button" class="red-btn sign-in-btn">Cancel</button>
                            </li>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>