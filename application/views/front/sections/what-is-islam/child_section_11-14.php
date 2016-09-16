<div class="wrapper-section home-4-6-bg what-is-islam-bg" style="background: rgba(0, 0, 0, 0) url('<?php echo base_url().$bg_image;?>') no-repeat scroll 0 0 / cover">
		
			<div class="left-slide-menu">
				<span class="left-slide-arrow-toogle arrow-toogle-in"></span>	
					<div class="left-slide-top">
							<span class="how-to-wrapper"><a href="#" class="how-to-wrapper"><img src="<?php echo base_url(); ?>assets/front/images/how_to_btn.png" alt="how-to"/></a></span>
							<span class="user-name-wrapper">  <span class="username-profile-img"><img src="<?php echo base_url(); ?>assets/front/images/user.jpg" alt="user-img"/></span> <span class="username-txt">Username</span></span>
					</div>
					<ul class="left-slide-menu-list">
						<li><a href="#" class="home-btn-left blue-btn-left">CHARACTERS</a></li>
						<li><a href="#" class="home-btn-left blue-btn-left">DEED BANK</a></li>
						<li><a href="#" class="home-btn-left blue-btn-left">PROGRESS</a></li>
						<li><a href="#" class="home-btn-left blue-btn-left">PUZZLES</a></li>
						<li><a href="#" class="home-btn-left blue-btn-left">SETTINGS</a></li>
						<li><a href="#" class="home-btn-left blue-btn-left">LOG OFF</a></li>
					</ul>
			</div>
			
			<div class="right-side-section">
					<div class="read-more"><a href="#"><img src="<?php echo base_url(); ?>assets/front/images/4-6_read-more.png" alt="read-more-img"/></a></div>
					
			</div>
				<div class="footer-section">				
					<ul>
                                            <?php foreach($categories as $category){    ?>
						<li><a href="#" class="what-is-islam-option-bg"><?php echo $category['category_name'];?></a></li>
					
                                           <?php  }?>
					</ul>
                                    
                                    <div class="footer-nav-section">
                                        
                                    <div class="back-btn"><a href="#"><img src="<?php echo base_url(); ?>assets/front/images/back-btn.png" alt="back-btn"/></a></div>
                                    <div class="home-btn"><a href="#"><img src="<?php echo base_url(); ?>assets/front/images/home-btn.png" alt="home-btn"/></a></div>				
                                    </div>
                                    
				</div>
			
			
			
		</div>