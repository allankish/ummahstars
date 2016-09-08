$(document).ready(function () {
    var left_side_menu_width = $(".left-slide-menu").outerWidth();

    $(".left-slide-arrow-toogle").click(function () {

        var left_side_menu_pos = $(".left-slide-menu").css('left');

        if (left_side_menu_pos == '0px')
        {

            $(".left-slide-menu").animate({left: -left_side_menu_width})

            $(".left-slide-arrow-toogle").removeClass("arrow-toogle-in").addClass("arrow-toogle-out");
        }
        else
        {

            $(".left-slide-menu").animate({left: 0})

            $(".left-slide-arrow-toogle").removeClass("arrow-toogle-out").addClass("arrow-toogle-in");
        }

    });

    // FORM VALIDATIONS
    $('#login_form').validate({
        rules:
                {
                    email_id:
                            {
                                required: true,
                                email: true,
                                lettersonly: true
                            },
                    password:
                            {
                                required: true
                            },
                },
        messages:
                {
                    email_id:
                            {
                                required: "Please Enter Username"
                            },
                    password:
                            {
                                required: "Please Enter Password"
                            },
                },
        submitHandler: function (form) {
            $("#submit").attr('disable', true).css({"pointer-events": "none", "cursor": "none"});
        }
    });

});