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
                    <ul>
                        <li>
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
                                    <h4 style="font-weight:bold">
                                        Error!
                                    </h4><br />
                                    <p><?php echo $this->session->flashdata('Error'); ?></p>
                                </div>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>