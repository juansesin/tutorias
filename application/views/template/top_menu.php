  <header class="main-header">
    <!-- Logo -->
	
	<?php 
	$rol = $this->session->userdata("rol");
	if($rol == 99){
		$enlace = base_url("dashboard"); 
	}elseif($rol == 2){
		$enlace = base_url("estudiante/buscar"); 
	}elseif($rol == 3){
		$enlace = base_url("docente"); 
	}elseif($rol == 4){
		$enlace = base_url("dashboard"); 
	}elseif($rol == 5){
		$enlace = base_url("dashboard"); 
	}
	?>
	
	<!-- Logo -->
    <a href="<?php echo $enlace; ?>" class="logo" style="height: 60px;">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="<?php echo base_url("images/favicon.png"); ?>"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="<?php echo base_url("images/logo-mini.png"); ?>" height="60" width="120"></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="height: 60px;">
        <span class="sr-only">Toggle navigation</span>
      </a>
	
		<!--<div class="pull-left info">
          <p style="color: #003865; font-size: 18px; font-weight: 600; padding-top: 5%;">Bienvenid@: <?php echo $this->session->firstname; ?> <?php echo $this->session->lastname; ?></p>
        </div>-->

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
		
			<li>
			  <a href="<?php echo base_url("menu/salir"); ?>" style="height: 60px;">
				<i class="fa fa-power-off"></i> <span>Salir</span>
			  </a>
			</li>
		
        </ul>
      </div>
    </nav>
  </header>