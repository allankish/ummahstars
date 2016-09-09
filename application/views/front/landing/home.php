<!DOCTYPE html>
<html lang="en">
<head>
  <title>Umma Stars</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/style.css">
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     <script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bootstrap/css/bootstrap.min.css">
</head>
	<body>
		<div class="wrapper-section landing-bg">
			<!-- <img src="images/1.Landing Page_BG.png" /> -->
			<div class="right-align landing-pg-btn-wrap">				
					<button type="button" class="modalButton watch-video-btn" data-toggle="modal" data-src="<?php echo $content; ?>" data-width="640" data-height="360" data-target="#myModal" data-video-fullscreen="">Watch Video <br/>Demo </button> 
					<a class="orange-btn sign-in-up-btn" href="<?php echo base_url(); ?>login"> <span class="sing-in-icon"><img src="<?php echo base_url()?>assets/front/images/sign-in-icon.png" alt="sign-in-icon"/></span>Sing In/Sign Up</a>
					<a class="orange-btn try-me-btn" href="<?php echo base_url(); ?>tryme"> <span class="try-me-icon"><img src="<?php echo base_url()?>assets/front/images/try-me-icon.png" alt="sign-in-icon"/></span>Try me</a>				
                                        
			</div>
		</div>
            
		<div class="modal fade" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-body">
          
          <div class="close-button">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="embed-responsive embed-responsive-16by9">
					            <iframe class="embed-responsive-item" frameborder="0"></iframe>
          </div>
				</div>

			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

            
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
	<!--<script src="<?php //echo base_url()?>assets/front/js/main.js"></script>-->
        <script>
        ( function($) {
  
function iframeModalOpen(){

		// impostiamo gli attributi da aggiungere all'iframe es: data-src andrà ad impostare l'url dell'iframe
		$('.modalButton').on('click', function(e) {
			var src = $(this).attr('data-src');
			var width = $(this).attr('data-width') || 640; // larghezza dell'iframe se non impostato usa 640
			var height = $(this).attr('data-height') || 360; // altezza dell'iframe se non impostato usa 360

			var allowfullscreen = $(this).attr('data-video-fullscreen'); // impostiamo sul bottone l'attributo allowfullscreen se è un video per permettere di passare alla modalità tutto schermo
			
			// stampiamo i nostri dati nell'iframe
			$("#myModal iframe").attr({
				'src': src,
				'height': height,
				'width': width,
				'allowfullscreen':''
			});
		});

		// se si chiude la modale resettiamo i dati dell'iframe per impedire ad un video di continuare a riprodursi anche quando la modale è chiusa
		$('#myModal').on('hidden.bs.modal', function(){
			$(this).find('iframe').html("");
			$(this).find('iframe').attr("src", "");
		});
	}
  
  $(document).ready(function(){
		iframeModalOpen();
  });
  
  } ) ( jQuery );
        </script>
	</body>	
</html>