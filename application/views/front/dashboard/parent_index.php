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
            <li><a href="#" class="home-btn-left yellow-btn-left">LOG OFF</a></li>
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
                                        <?php if ($age_group['password_required'] === 'true'): ?>
                                        <li>
                                            <label>Password</label>
                                            <input type="password" class="form-filed-style" placeholder="Enter your password"></li>
                                        <?php endif; ?>
                                        <li class="center-align"><a class="red-btn sign-in-btn" href="#"> Sign In</a></li>

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
            <div class="hover-child-btn-wrapper"><a href="#" class="hover-child-btn">Hand over to the Child</a></div>
        </div>

    </div>

</div>