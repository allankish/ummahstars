<div class="wrapper-section BG_without_char">
			<!-- <img src="images/BG_without_char.png" class="bg-no-character"/> -->
			<div class="overlay-center-popup">				
			<div class="overlay-center-popup-inner clearfix">	
	<div class="shadow-layer clearfix try-me-wrapper">
					<h2 class="popup-header">TRY ME</h2>
					<span class="close-btn cls-btn-tryme"><img src="<?php echo base_url()?>assets/front/images/Close_btn.png" alt="close-btn"></span>				
					<div class="age-group-wrapper">
					<div class="age-group-header">Age Group	</div>
						<ul>
                                                    <?php
                                                    $active_but = 'age-btn-active';
                                                    foreach($age_groups as $agg):?>
							<li><input type="button" class="age-btn <?php echo $active_but?>" value="<?php echo $agg['age_group_name']?>" age_group_id="<?php echo $agg['age_group_id']?>"></li>
                                                    <?php
                                                    $active_but = '';
                                                    endforeach;
                                                    ?>
							<li><input type="button" class="age-btn" value="ALL" age_group_id="All"></li>
						</ul>
					</div>
					<div class="videoslider-wrpper">
					<!-- <img src="images/slider.png" alt="slider-img"> -->
					
					<div class="slider-img-wrapper" id="slider-img">
                                        
                                        </div>
                                            
					</div>
					<div class="share-app-wrapper">
					<div class="share-app-header">Share app via</div>
						<ul class="share-app-icon-list">
                                                    <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A//ummahstars.com/"><img src="<?php echo base_url()?>assets/front/images/social-icon/fb_btn.png" alt="social-icon"/></a></li>
							<li><a target="_blank" href="https://plus.google.com/share?url=http%3A//ummahstars.com/"><img src="<?php echo base_url()?>assets/front/images/social-icon/g+_btn.png" alt="social-icon"/></a></li>
							<li><a target="_blank" href="https://twitter.com/home?status=http%3A//ummahstars.com/"><img src="<?php echo base_url()?>assets/front/images/social-icon/twitter_btn.png" alt="social-icon"/></a></li>
							<li><a target="_blank" href="https://pinterest.com/pin/create/button/?url=&media=http%3A//ummahstars.com/&description="><img src="<?php echo base_url()?>assets/front/images/social-icon/pintrest_btn.png" alt="social-icon"/></a></li>
							<!--<li><a href="#"><img src="<?php echo base_url()?>assets/front/images/social-icon/message_btn.png" alt="social-icon"/></a></li>-->
							<li><a href="mailto:?subject=Ummastars&amp;body=http://hummastars.com"><img src="<?php echo base_url()?>assets/front/images/social-icon/email_btn.png" alt="social-icon"/></a></li>
							<!--<li><a href="#"><img src="<?php echo base_url()?>assets/front/images/social-icon/whatsapp_btn.png" alt="social-icon"/></a></li>-->
							
						</ul>
					</div>
					
			</div>
			</div>
			</div>
		</div>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <span class="close-btn cls-pop-vid"><img alt="close-btn" src="<?php echo base_url()?>assets/front/images/Close_btn.png"></span>
                <iframe src="" id="video_frame" width="570" height="300"></iframe>
            </div>
        </div>
    </div>
</div>

	<script src="<?php echo base_url()?>assets/front/js/Carousel.js"></script>
	<script src="<?php echo base_url()?>assets/images/loadingoverlay.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        
       
    
      $('.age-btn,.age-btn-active').click(function(){
          $('.age-btn').removeClass('age-btn-active');
          $(this).addClass('age-btn-active');
        $('#slider-img').html('');
        $.LoadingOverlay("show");
    
     age_group_id = $(this).attr('age_group_id');
     $.ajax({
        url: '<?php echo base_url()?>tryme/getTryMeVideos/',
        type : 'POST',
        dataType: 'text',
        data: {age_group_id : age_group_id},
        success: function( resp ) {
      
       
        $('#slider-img').html(resp);
         $('#slider-img').carousel({
            num: 9,
            maxWidth: 120,
            maxHeight: 181,
            showTime: 1500,
			distance: 40,
			autoPlay: true,
			animationTime: 400,
             });
        $.LoadingOverlay("hide");
        },
        error: function( req, status, err ) {
        $.LoadingOverlay("hide");
        alert("Something went Wrong. Pleaes try again");
        }
        });
     
       
      });
      
      $('.age-btn-active').trigger('click');
      
       });
      
      $(document).on('click','.tryme_popup',function(){
     
        video_url = $(this).attr('video_url');
        $('#video_frame').attr("src",video_url);
        
        $('#myModal').modal('show');
        
        
      
      });
      
      $('#myModal').on('hidden.bs.modal', function () {
          $('#video_frame').attr("src",'');
        });
    
     $(document).on('click','.cls-btn-tryme',function(){
         window.location.href="<?php echo base_url();?>"
     });
    
      $(document).on('click','.cls-pop-vid',function(){
 $('#myModal').modal('hide');
      });
            </script>