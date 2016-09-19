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
                    <h2 class="popup-header">Forgot Password?</h2>
                    <?php if ($this->session->flashdata('Success')) { ?>
                        <div class="sucess">
                            <h4>
                                Success!
                            </h4>
                            <p><?php echo $this->session->flashdata('Success'); ?></p>
                        </div>
                    <?php } ?>
                    <?php if ($this->session->flashdata('Error')) { ?>
                        <div class="error">
                            <h4>
                                Error!
                            </h4>
                            <p><?php echo $this->session->flashdata('Error'); ?></p>
                        </div>
                    <?php } ?>
                    <ul>
                        <form id="forgot_password_form" name="forgot_password_form" action="<?php echo base_url(); ?>forgot_password" method="post">
                            <li>
                                <label>Enter Parent Email Id</label>
                                <input id="email_id" name="email_id" type="text" class="form-filed-style" placeholder="Enter your Email Id">
                            </li>
                            <li class="center-align">
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