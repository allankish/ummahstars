        <script src="<?php echo base_url(); ?>assets/front/js/jquery.mCustomScrollbar.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/front/js/main.js"></script>

        <script>
            $(document).ready(function () {
                var left_slide_menu_width = $(".left-slide-menu").width() + 50;

                var parent_dash_popup_width = $(window).width() - left_slide_menu_width;

                $(".parent_dashboard .overlay-center-popup").css({"width": parent_dash_popup_width});
            });
            $(window).resize(function () {
                var left_slide_menu_width = $(".left-slide-menu").width() + 50;

                var parent_dash_popup_width = $(window).width() - left_slide_menu_width;

                $(".parent_dashboard .overlay-center-popup").css({"width": parent_dash_popup_width});
            });
        </script>
    </body>
</html>