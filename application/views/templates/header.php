<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>e-Filing</title>

    <!-- Bootstrap -->
    <!-- <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet"> -->
    <link href="<?php echo base_url('assets/css/bootstrap-lumen.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-datepicker3.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/datatables.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/toastr.min.css') ?>">
    <style>
        body {
          min-height: 2000px;
          padding-top: 70px;
        }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-datepicker.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/datatables.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/toastr.min.js') ?>"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
</head>
<body>
    <!-- Fixed navbar -->
        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?php echo site_url() ?>">e-Filing v0.1b</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="<?php echo 'home' == $active_page ? 'active' : '' ?>"><a href="<?php echo site_url('main') ?>">Home</a></li>
                <li class="<?php echo 'change_shift' == $active_page ? 'active' : '' ?>"><a href="<?php echo site_url('schedule') ?>">Change Shift</a></li>
                <li class="<?php echo 'leave' == $active_page ? 'active' : '' ?>"><a href="<?php echo site_url('main/leave') ?>">Leave</a></li>
                <li class="<?php echo 'overtime' == $active_page ? 'active' : '' ?>"><a href="<?php echo site_url('main/overtime') ?>">Overtime</a></li>
                <li class="<?php echo 'employees' == $active_page ? 'active' : '' ?>"><a href="<?php echo site_url('main/employee') ?>">Employees</a></li>
                <li class="<?php echo 'departments' == $active_page ? 'active' : '' ?>"><a href="<?php echo site_url('main/department') ?>">Departments</a></li>
                <!-- <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">For Approval <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li class="dropdown-header">Nav header</li>
                    <li><a href="#">Separated link</a></li>
                    <li><a href="#">One more separated link</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Report <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li class="dropdown-header">Nav header</li>
                    <li><a href="#">Separated link</a></li>
                    <li><a href="#">One more separated link</a></li>
                  </ul>
                </li> -->
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo $this->session->has_userdata('empcode') ? site_url('logout') : site_url('login') ?>"><?php echo $this->session->has_userdata('empcode') ? 'Logout' : 'Login' ?></a></li>
              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </nav>

        <div class="container">

          <!-- Main component for a primary marketing message or call to action -->
          <!-- <div class="jumbotron">
            <h1>American Wire & Cable Co., Inc.</h1>
            <p>e-Filing paperless filing of Leave and OT forms with delegation of approvers.</p>
            <?php if ($this->session->has_userdata('name')) {
              echo '<strong>Welcome</strong> ' . $this->session->name;
            } ?>
          </div> -->

        <h3 class="page-header"><?php echo ucwords(str_replace('_', ' ', $active_page)) ?></h3>
        <h3>Welcome <?php echo ucwords(strtolower($this->session->name)) ?></h3>
        <p>Today is <?php echo date('M. d, Y') ?></p>