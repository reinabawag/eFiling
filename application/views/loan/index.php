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
          /* min-height: 2000px; */
          padding-top: 5%;
        }

        tbody tr {
          cursor: pointer;
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
                <li class=""><a href="<?php echo site_url('main') ?>">Home</a></li>
                <li class=""><a href="<?php echo site_url('schedule') ?>">Change Shift</a></li>
                <li class=""><a href="<?php echo site_url('leave') ?>">Leave</a></li>
                <li class=""><a href="<?php echo site_url('main/overtime') ?>">Overtime</a></li>
				<li class="active"><a href="<?php echo site_url('loan') ?>">Loan</a></li>
                
                <?php if($this->session->is_hr || $this->session->empcode == '046417'): ?>

					<li class=""><a href="<?php echo site_url('main/employee') ?>">Employees</a></li>
					<li class=""><a href="<?php echo site_url('main/department') ?>">Departments</a></li>
                
                <?php endif; ?>
              </ul>
              <ul class="nav navbar-nav navbar-right">
				  <li><a href="#"><?php echo $this->session->name ? $this->session->name : 'Guest' ?></a></li>
                <li><a href="<?php echo $this->session->has_userdata('empcode') ? site_url('logout') : site_url('login') ?>"><?php echo $this->session->has_userdata('empcode') ? 'Logout' : 'Login' ?></a></li>
              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </nav>

        <div class="container">
<form class="form-horizontal">
  <fieldset>
    <legend>loan</legend>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="inputEmail" placeholder="Email">
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Password</label>
      <div class="col-lg-10">
        <input type="password" class="form-control" id="inputPassword" placeholder="Password">
        <div class="checkbox">
          <label>
            <input type="checkbox"> Checkbox
          </label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Textarea</label>
      <div class="col-lg-10">
        <textarea class="form-control" rows="3" id="textArea"></textarea>
        <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Radios</label>
      <div class="col-lg-10">
        <div class="radio">
          <label>
            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
            Option one is this
          </label>
        </div>
        <div class="radio">
          <label>
            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
            Option two can be something else
          </label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-default">Cancel</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </fieldset>
</form>

