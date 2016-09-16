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
    // PARENT LOGIN FORM
    $('#login_form').validate({
        rules:
                {
                    email_id:
                            {
                                required: true,
                                email: true
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
                }
    });

    // REGISTER FORM
    $('#register_form').validate({
        rules:
                {
                    uname:
                            {
                                required: true
                            },
                    email_id:
                            {
                                required: true,
                                email: true
                            },
                    password:
                            {
                                required: true
                            },
                    retype_password:
                            {
                                required: true,
                                equalTo: '#password'
                            }
                },
        messages:
                {
                    uname:
                            {
                                required: 'Please enter parent name'
                            },
                    email_id:
                            {
                                required: 'Please enter parent email id'
                            },
                    password:
                            {
                                required: 'Please enter password'
                            },
                    retype_password:
                            {
                                required: 'Please retype your password'
                            }
                }
    });

    // FORGOT PASSWORD
    $('#forgot_password_form').validate({
        rules:
                {
                    email_id:
                            {
                                required: true,
                                email: true
                            }
                },
        messages:
                {
                    email_id:
                            {
                                required: 'Please enter your email id'
                            }
                }
    });

    // RESET PASSWORD
    $('#reset_password_form').validate({
        rules:
                {
                    password:
                            {
                                required: true
                            },
                    retype_password:
                            {
                                required: true,
                                equalTo: '#password'
                            }
                },
        messages:
                {
                    password:
                            {
                                required: 'Please enter your new password'
                            },
                    retype_password:
                            {
                                required: 'Please retype your new password.'
                            }
                }
    });

    // CONFIRM PARENT USER FORM
    $('#confirm_parent_form').validate({
        rules:
                {
                    password:
                            {
                                required: true
                            }
                },
        messages:
                {
                    password:
                            {
                                required: 'Please enter your password.'
                            }
                }
    });

    // ADD CHILD FORM
    $('#add_child_form').validate({
        rules:
                {
                    uname:
                            {
                                required: true,
                            },
                    age:
                            {
                                required: true
                            },
                    password:
                            {
                                required: true
                            },
                    retype_password:
                            {
                                required: true,
                                equalTo: '#password'
                            }
                },
        messages:
                {
                    uname:
                            {
                                required: 'Please enter child\'s name'
                            },
                    age:
                            {
                                required: 'Please enter child\'s age'
                            },
                    password:
                            {
                                required: 'Please enter password'
                            },
                    retype_password:
                            {
                                required: 'Please retype your password'
                            }
                }
    });
});