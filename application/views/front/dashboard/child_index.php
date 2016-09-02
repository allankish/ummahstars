<div class="wrapper-section BG_without_char">
    <div class="overlay-center-popup">				
        <div class="overlay-center-popup-inner clearfix">	
            <div class="shadow-layer-child-sign-in-outer">
                <?php
                foreach ($age_groups as $age_group):
                    if (count($childs[$age_group['age_group_id']]) > 0) {
                        foreach ($childs[$age_group['age_group_id']] as $child) {
                            ?>
                            <div class="shadow-layer shadow-layer-child-sign-in clearfix sign-in-wrapper">

                                <span class="close-btn"><img src="<?php echo base_url(); ?>assets/front/images/Close_btn.png" alt="close-btn"></span>				
                                <div class="login-wrapper">

                                    <div class="user-avatar-image">
                                        <div class="user-avatar-image-circle"><img src="<?php echo ($child['profile_image'] != '') ? base_url() . $child['profile_image'] : base_url() . 'assets/front/images/user.jpg'; ?>" alt="profile"/></div>
                                        <div><?php echo $child['uname']; ?></div>
                                    </div>


                                    <ul>
                                        <form name="child_form-<?php echo $child["user_id"]; ?>" action="<?php echo base_url('dashboard'); ?>" method="post">
                                            <?php if ($age_group['password_required'] === 'true'): ?>
                                                <li>
                                                    <label>Password</label>
                                                    <input name="password" type="password" class="form-filed-style" placeholder="Enter your password">
                                                </li>
                                            <?php endif; ?>
                                            <li class="center-align">
                                                <input type="hidden" name="child_id" value="<?php echo $child['user_id']; ?>" />
                                                <input type="hidden" name="passkey" value="<?php echo $child['password']; ?>" />
                                                <input type="hidden" name="pass_req" value="<?php echo $age_group['password_required']; ?>" />
                                                <button type="submit" class="red-btn sign-in-btn" >Sign In</button>
                                            </li>
                                        </form> 
                                        <li class="center-align"><a href="#">Forgot password?</a></li>

                                    </ul>

                                </div>
                            </div>

                            <?php
                        }
                    } else {
                        ?>
                        <div class="shadow-layer shadow-layer-child-sign-in clearfix sign-in-wrapper">

                            <span class="close-btn"><img src="<?php echo base_url(); ?>assets/front/images/Close_btn.png" alt="close-btn"></span>				
                            <div class="login-wrapper">

                                <div class="user-avatar-image">
                                    <div class="user-avatar-image-circle"><img src="<?php echo base_url(); ?>assets/front/images/user.jpg" alt="profile"/></div>
                                    <div><?php echo $age_group['age_group_name']; ?></div>
                                </div>
                                <ul>
                                    <li>
                                        <label>Password</label>
                                        <input type="password" class="form-filed-style" placeholder="Enter your password"></li>
                                    <li class="center-align"><a class="red-btn sign-in-btn" href="#"> Sign In</a></li>

                                    <li class="center-align"><a href="#">Forgot password?</a></li>

                                </ul>
                            </div>
                        </div>
                        <?php
                    }
                endforeach;
                ?>
            </div>
        </div>
    </div>
</div>