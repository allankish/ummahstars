<!--<div class="wrapper-section home-4-6-bg what-is-islam-bg" style="background: rgba(0, 0, 0, 0) url('<?php echo base_url().$bg_image;?>') no-repeat scroll 0 0 / cover">-->
	<div class="wrapper-section home-11-14-bg what-is-islam-bg-11-14">	
			
			<?php $this->load->view('front/common/leftsidemenu_11-14');?>
            
			<div class="right-side-section">
					<div class="read-more"><a href="#"><img src="<?php echo base_url(); ?>assets/front/images/11-14/read_more.png" alt="read-more-img"/></a></div>
					
			</div>
				<div class="footer-section">				
					<ul>
                                            <?php foreach($categories as $category){    ?>
						<li><a href="#" class="what-is-islam-option-bg-11-14"><?php echo $category['category_name'];?></a></li>
					
                                           <?php  }?>
					</ul>
                                    
                                    <div class="footer-nav-section">
                                  <div class="back-btn"><a href="#" onclick="history.go(-1);"><img src="<?php echo base_url(); ?>assets/front/images/back-btn.png" alt="back-btn"/></a></div>
                                    <div class="home-btn"><a href="<?php echo base_url();?>child"><img src="<?php echo base_url(); ?>assets/front/images/home-btn.png" alt="home-btn"/></a></div>			
                                    </div>
                                    
				</div>
			
			
			
		</div>