<div class="wrapper-section BG_without_char parent_dashboard">

    <div class="left-slide-menu">
        <span class="left-slide-arrow-toogle arrow-toogle-in"></span>
        <div class="left-slide-top">
            <span class="how-to-wrapper"><a href="#" class="how-to-wrapper"><img src="<?php echo base_url(); ?>assets/front/images/how_to_btn.png" alt="how-to"/></a></span>
            <span class="user-name-wrapper">  <span class="username-profile-img"><img src="<?php echo ($parent_details['profile_image'] != '') ? base_url() . $parent_details['profile_image'] : base_url() . 'assets/front/images/user.jpg'; ?>" alt="<?php echo $parent_details['uname']; ?>"/></span> <span class="username-txt"><?php echo $parent_details['uname']; ?></span></span>
        </div>
        <ul class="left-slide-menu-list">
            <li><a href="#" class="home-btn-left yellow-btn-left">CHARACTERS</a></li>
            <li><a href="#" class="home-btn-left yellow-btn-left">DEED BANK</a></li>
            <li><a href="#" class="home-btn-left yellow-btn-left">PROGRESS</a></li>
            <li><a href="#" class="home-btn-left yellow-btn-left">PUZZLES</a></li>
            <li><a href="#" class="home-btn-left yellow-btn-left">SETTINGS</a></li>
            <li><a href="<?php echo base_url(); ?>logout" class="home-btn-left yellow-btn-left">LOG OFF</a></li>
        </ul>
    </div>

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
                                        <form name="child_form-<?php echo $child["user_id"]; ?>" class="child-signin-form" id="child_form-<?php echo $child["user_id"]; ?>" action="<?php echo base_url('dashboard'); ?>" method="post" >
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
                                                <button type="submit" class="red-btn sign-in-btn">Sign In</button>
                                            </li>
                                        </form>

                                        <?php if ($age_group['password_required'] === 'true'): ?>
                                            <li class="center-align"><a href="<?php echo base_url()."child_forgotpassword"; ?>">Forgot password?</a></li>
                                        <?php endif; ?>

                                    </ul>

                                </div>
                            </div>

                            <?php
                        }
                    } else {
                        ?>
                        <!--<div class="shadow-layer shadow-layer-child-sign-in clearfix sign-in-wrapper">

                            <span class="close-btn"><img src="<?php /*echo base_url(); */?>assets/front/images/Close_btn.png" alt="close-btn"></span>
                            <div class="login-wrapper">

                                <div class="user-avatar-image">
                                    <div class="user-avatar-image-circle"><img src="<?php /*echo base_url(); */?>assets/front/images/user.jpg" alt="profile"/></div>
                                    <div><?php /*echo $age_group['age_group_name']; */?></div>
                                </div>

                                <ul>
                                    <li>
                                        <label>Password</label>
                                        <input type="password" class="form-filed-style" placeholder="Enter your password"></li>
                                    <li class="center-align"><a class="red-btn sign-in-btn" href="#"> Sign In</a></li>

                                    <li class="center-align"><a href="#">Forgot password?</a></li>
                                </ul>

                            </div>
                        </div>-->
                        <?php
                    }
                endforeach;
                ?>
            </div>
            <div class="hover-child-btn-wrapper">
                <form name="child_mode_form" action="<?php echo base_url(); ?>dashboard/child_mode/update" method="post">
                    <input type="hidden" name="child_mode" value="true" />
                    <button name="submit" type="submit" class="hover-child-btn">Hand over to the Child</button>
                </form>
            </div>

            <?php if($nchilds < $parent_details['child_allowed']) { ?>
                <div class="hover-child-btn-wrapper">
                    <a href="<?php echo base_url(); ?>add_child" class="hover-child-btn">Add Child</a>
                </div>
            <?php } ?>
        </div>

    </div>

</div>