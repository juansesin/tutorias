<!DOCTYPE html>
<html style="height: auto;min-height: 100%;"><head>
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

<header class="main-header" style="background-color: white">
    <!-- Logo -->
     
    <a href="http://www.draco.com.co/tutorias/dashboard" class="logo" style="height: 60px;">
    <img src="http://www.draco.com.co/tutorias/images/logo-mini.png" height="60" width="120">
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
    </nav>
  </header>

<body class="hold-transition login-page" style="background-color: #f3f3f3; color: #00437a">
<div class="login-box">
  <div class="login-logo">

  </div>

 <div class="login-logo" style="margin-bottom: 15px;">
    <b style="font-weight: 500; font-size: 23px">Ingreso a Tutorías</b>
  </div>
  <!-- /.login-logo -->

<div class="box box-solid box-default">
    
    <div class="box-header" style=" color: #00437a; background-color: #f3f3f3; text-align: center;">
        <p class="box-title" style="text-align: center; font-size: 16px; font-weight: 600">Ingrese su usuario y contraseña</p>
    </div>

  <div class="box-body">
  
  <!-- <p class="login-box-msg">
    <a href="#" class="logo">
	  <img src="<?php echo base_url("images/logo_univ_sergioarboleda_login.png"); ?>" height="133" width="180">
    </a>
  </p>-->
  	
  		<?php if(isset($msj)){?>
  				<div class="alert alert-danger"><span class="glyphicon glyphicon-remove">&nbsp;</span>
  					<?php echo $msj;//mensaje de error ?>
  				</div>
  		<?php } ?>	
	
    	<form  name="form" id="form" role="form" method="post" action="<?php echo base_url("login/validateUser"); ?>" >
          <div class="form-group has-feedback">
            <label>Usuario</label>
            <input type="text" id="inputLogin" name="inputLogin" class="form-control">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <label>Contraseña</label>
            <input type="password" id="inputPassword" name="inputPassword" class="form-control">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
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
</div>

<footer class="main-footer" style="margin-left: 0px;background: #00437a;">
    
  <div class="container">
      <div class="col-md-2 col-sm-12 col-xs-12"></div>

      <div class="col-md-8 col-sm-12 col-xs-12" align="center" style="line-height: 1.1;">
          <span style="color: white;">SNIES 1728 - Resolución 16377 del 29 octubre de 1984 y 6423 del 05 de agosto de 2011 - Ministerio de Educación Nacional - Acreditación Institucional - Resolución 590 del 09 de enero de 2015 Vigencia 4 años Institución de Educación Superior sujeta a inspección y vigilancia por el Ministerio de Educación. </span>
      </div>

      <div class="col-md-2 col-sm-12 col-xs-12" style="padding: 0;">
       <a href="http://draco.com.co" style="margin-right: 5px;"><img style="margin-top: 10px;" src="https://ptd.usergioarboleda.edu.co/../../assets/img/draco.png" alt="Draco" height="25" class="pull-right"></a>
       <a href="https://www.usergioarboleda.edu.co/" style="margin-left:5px; "><img src="https://ptd.usergioarboleda.edu.co/../../assets/img/logoUSA-Footer.png" alt="Sergio" height="50" class="pull-right"></a>
      </div>

  </div>

</footer>

</body>
</html>
