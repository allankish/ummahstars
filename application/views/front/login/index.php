<div class="wrapper-section BG_without_char">
    <div class="overlay-center-popup">				
        <div class="overlay-center-popup-inner clearfix">	
            <div class="shadow-layer clearfix sign-in-wrapper">

                <span class="close-btn"><img src="<?php echo base_url(); ?>assets/front/images/Close_btn.png" alt="close-btn"></span>				
                <div class="login-wrapper">

                    <div class="user-avatar-image">
                        <div class="user-avatar-image-circle"><img src="<?php echo base_url(); ?>assets/front/images/user.jpg" alt="profile"/></div>
                    </div>
                    <ul>
                        <form name="login_form" id="login_form" action="<?php echo base_url(); ?>login" method="post">
                        <li>
                            <label>Username</label>
                            <input name="email_id" type="text" class="form-filed-style" placeholder="Enter your username">
                        </li>
                        <li>
                            <label>Password</label>
                            <input name="password" type="password" class="form-filed-style" placeholder="Enter your password">
                        </li>
                        <li class="center-align"><button name="submit" id="submit" type="submit" class="red-btn sign-in-btn">Sign In</button></li>
                        </form>
                        <li class="center-align"><a href="<?php echo base_url();?>forgot_password">Forgot password?</a></li>
                        <li class="center-align"><span>Not a member?</span><a href="<?php echo base_url(); ?>register">Sign up</a></li>
                        <li class="center-align"><span>Sign up with social media</span></li>
                    </ul>
                </div>

                <div class="share-app-wrapper">					
                    <ul class="share-app-icon-list"> 
                        <li><a href="<?php echo base_url();?>fblogin"><img src="<?php echo base_url(); ?>assets/front/images/social-icon/fb_btn.png" alt="Facebook"/></a></li>
                        <li><a href="<?php echo base_url();?>gpluslogin"><img src="<?php echo base_url(); ?>assets/front/images/social-icon/g+_btn.png" alt="Google+"/></a></li>
                        <li><a href="<?php echo base_url();?>twitterapi"><img src="<?php echo base_url(); ?>assets/front/images/social-icon/twitter_btn.png" alt="Twitter"/></a></li>
                        <li><a href="<?php echo base_url();?>apiLinkedin"><img src="<?php echo base_url(); ?>assets/front/images/social-icon/linked-in.png" alt="LinkedIn"/></a></li>							

                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
