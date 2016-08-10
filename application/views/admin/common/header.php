<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Ummah Stars Admin</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons --> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">
        <!-- jQuery 2.2.3 -->
        <script src="<?php echo base_url() ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>

        <!-- FastClick -->
        <script src="<?php echo base_url() ?>assets/plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url() ?>assets/dist/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <?php
    // CONSTANTS
    $second_segment = 2;
    $third_segment = 3;
    $fourth_segment = 4;

    // Dashboard menu
    $dashboard_menu_active = '';
    if (( $this->uri->uri_string() == '' ) || ( $this->uri->segment($second_segment) == 'dashboard' )) {
        $dashboard_menu_active = "active";
    }

    // Users menu
    $users_menu_active = '';
    $users_list_menu_active = '';
    $users_add_menu_active = '';

    if ($this->uri->segment($second_segment) == "users") {
        $users_menu_active = "active";
    }
    if (( $this->uri->segment($second_segment) == "users" ) && ( $this->uri->segment($third_segment) == "")) {
        $users_menu_active = "active";
        $users_list_menu_active = "active";
    }

    if (( $this->uri->segment($second_segment) == "users" ) && ( $this->uri->segment($third_segment) == "add")) {
        $users_menu_active = "active";
        $users_add_menu_active = "active";
    }
    if (( $this->uri->segment($second_segment) == "users" ) && ( $this->uri->segment($third_segment) == "edit")) {
        $users_menu_active = "active";
        $users_list_menu_active = "active";
    }

    // Age Groups menu
    $age_groups_menu_active = '';
    $age_groups_list_menu_active = '';
    $age_groups_add_menu_active = '';

    if ($this->uri->segment($second_segment) == "age-groups") {
        $age_groups_menu_active = "active";
        $age_groups_list_menu_active = "active";
    }
    if (( $this->uri->segment($second_segment) == "age-groups" ) && ( $this->uri->segment($third_segment) == "add")) {
        $age_groups_menu_active = "active";
        $age_groups_add_menu_active = "active";
    }
    if (( $this->uri->segment($second_segment) == "age-groups" ) && ( $this->uri->segment($third_segment) == "edit")) {
        $age_groups_menu_active = "active";
        $age_groups_list_menu_active = "active";
    }

    // Subscription Menu

    $subscription_menu_active = '';
    $subscription_list_menu_active = '';
    $subscription_add_menu_active = '';

    if ($this->uri->segment($second_segment) == "subscription") {
        $subscription_menu_active = "active";
        $subscription_list_menu_active = "active";
    }
    if (( $this->uri->segment($second_segment) == "subscription" ) && ( $this->uri->segment($third_segment) == "add")) {
        $subscription_menu_active = "active";
        $subscription_add_menu_active = "active";
        $subscription_list_menu_active = "";
    }

    if (( $this->uri->segment($second_segment) == "subscription" ) && ( $this->uri->segment($third_segment) == "edit")) {
        $subscription_menu_active = "active";
        $subscription_list_menu_active = "active";
    }
    ?>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="<?php echo base_url(); ?>usadmin" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>US</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Ummah Stars</b> Admin</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?php echo $admin_first_name; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo base_url(); ?><?php echo ($admin_profile_image != '')? $admin_profile_image : 'assets/dist/img/user2-160x160.jpg';?>" class="img-circle" alt="User Image">
                                        <p>
                                            <?php echo $admin_first_name . ' ' . $admin_last_name; ?>
                                            <small>Member since <?php echo date('M Y', strtotime($admin_created_on)); ?></small>
                                        </p>
                                    </li>

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?php echo base_url();?>usadmin/profile" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo base_url(); ?>usadmin/logout" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li <?php echo 'class="' . $dashboard_menu_active . '"'; ?>">
                            <a href="<?php echo base_url(); ?>usadmin/dashboard">
                                <i class="fa fa-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="treeview <?php echo $users_menu_active; ?>">
                            <a href="#">
                                <i class="fa fa-users"></i>
                                <span>Users</span>
                                <span class="pull-right-container">
                                    <span class="fa fa-angle-left pull-right"></span>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li <?php echo 'class="' . $users_list_menu_active . '"'; ?>><a href="<?php echo base_url() ?>usadmin/users/"><i class="fa fa-circle-o"></i>Users List</a></li>
                                <li <?php echo 'class="' . $users_add_menu_active . '"'; ?>><a href="<?php echo base_url() ?>usadmin/users/add"><i class="fa fa-circle-o"></i>Add New</a></li>
                            </ul>
                        </li>
                        <li class="treeview <?php echo $age_groups_menu_active; ?>">
                            <a href="#">
                                <i class="fa fa-th-large"></i>
                                <span>Age Groups</span>
                                <span class="pull-right-container">
                                    <span class="fa fa-angle-left pull-right"></span>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li <?php echo 'class="' . $age_groups_list_menu_active . '"'; ?>><a href="<?php echo base_url() ?>usadmin/age-groups/"><i class="fa fa-circle-o"></i>All Age Groups</a></li>
                                <li <?php echo 'class="' . $age_groups_add_menu_active . '"'; ?>><a href="<?php echo base_url() ?>usadmin/age-groups/add"><i class="fa fa-circle-o"></i>Add New</a></li>
                            </ul>
                        </li>
                        <li class="treeview <?php echo $subscription_menu_active; ?>">
                            <a href="#">
                                <i class="fa fa-th-large"></i>
                                <span>Subscription Plans</span>
                                <span class="pull-right-container">
                                    <span class="fa fa-angle-left pull-right"></span>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li <?php echo 'class="' . $subscription_list_menu_active . '"'; ?>><a href="<?php echo base_url() ?>usadmin/subscription/"><i class="fa fa-circle-o"></i>Plan List</a></li>
                                <li <?php echo 'class="' . $subscription_add_menu_active . '"'; ?>><a href="<?php echo base_url() ?>usadmin/subscription/add"><i class="fa fa-circle-o"></i>Add New</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-cog"></i>
                                <span>Settings</span>
                            </a>

                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>