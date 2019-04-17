<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css"); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/bower_components/font-awesome/css/font-awesome.min.css"); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/bower_components/Ionicons/css/ionicons.min.css"); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/dist/css/AdminLTE.min.css"); ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/plugins/iCheck/square/blue.css"); ?>">

<!-- jQuery 3 -->
<script src="<?php echo base_url("assets/bootstrap/bower_components/jquery/dist/jquery.min.js"); ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url("assets/bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"); ?>"></script>
  
  
	<!-- jQuery validate-->
	<script type="text/javascript" src="<?php echo base_url("assets/js/general/general.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/general/jquery.validate.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/validate/login.js"); ?>"></script>
  
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">

  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
  
  <p class="login-box-msg">
    <a href="#" class="logo">
	  <img src="<?php echo base_url("images/logo_univ_sergioarboleda_login.png"); ?>" height="133" width="180">
    </a>
  </p>
    


  <div class="login-logo">
    <b>Tutorías</b>
  </div>
	
		<?php if(isset($msj)){?>
				<div class="alert alert-danger"><span class="glyphicon glyphicon-remove">&nbsp;</span>
					<?php echo $msj;//mensaje de error ?>
				</div>
		<?php } ?>	
	
	<form  name="form" id="form" role="form" method="post" action="<?php echo base_url("login/validateUser"); ?>" >
      <div class="form-group has-feedback">
        <input type="text" id="inputLogin" name="inputLogin" class="form-control" placeholder="Usuario">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Contraseña">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">

        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-info btn-block" id='btnSubmit' name='btnSubmit'>Ingresar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- /.social-auth-links -->
<br>
    <a href="https://geco.usergioarboleda.edu.co">¿Olvidó su nombre de usuario o contraseña?</a><br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

</body>
</html>
