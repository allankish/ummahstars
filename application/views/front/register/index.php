<div class="wrapper-section BG_without_char">
    <div class="overlay-center-popup">				
        <div class="overlay-center-popup-inner clearfix">	
            <div class="shadow-layer clearfix account-creation-wrapper">

                <a href="<?php echo base_url(); ?>"><span class="close-btn"><img src="<?php echo base_url(); ?>assets/front/images/Close_btn.png" alt="close-btn"></span></a>
                <div class="content mCustomScrollbar light login-wrapper" data-mcs-theme="minimal-dark">
                    <h2 class="popup-header">Create Your Account !</h2>
                    <div class="user-avatar-image">
                        <div class="user-avatar-image-circle"><img src="<?php echo base_url(); ?>assets/front/images/user.jpg" alt="profile"/></div>
                    </div>
                    <?php if (validation_errors()) { ?>
                        <div>                            
                            <?php echo validation_errors(); ?>
                        </div>
                    <?php } ?>
                    <ul>
                        <form name="register_form" action="<?php echo base_url(); ?>register" method="post">
                            <li>
                                <label>Parent Name</label>
                                <input name="uname" type="text" class="form-filed-style" placeholder="Enter Parent Name">
                            </li>
                            <li>
                                <label>Parent E-mail Id</label>
                                <input name="email_id" type="text" class="form-filed-style" placeholder="Enter Parent E-mail Id"></li>

                            <li><label>Gender</label>
                                <div class="gender-wrap-outer">
                                    <span class="gender-wrap male-radio"><input type="radio" name="gender" value="male" checked> Male</span>
                                    <span class="gender-wrap female-radio"><input type="radio" name="gender" value="female"> Female  </span>
                                </div>
                            </li>
                            <li>
                                <label>Password</label>
                                <input name="password" type="password" class="form-filed-style" placeholder="Enter your password"></li>

                            <li>
                                <label>Re-type Password</label>
                                <input name="retype_password" type="password" class="form-filed-style" placeholder="Re-type your password"></li>


                            <li class="center-align"><button type="submit" class="red-btn sign-in-btn"> Register</button></li>
                        </form>

                    </ul>
                </div>


            </div>
        </div>
    </div>
</div>