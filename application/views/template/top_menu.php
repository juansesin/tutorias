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
	}
	?>
	
	
    <a href="<?php echo $enlace; ?>" class="logo">
	  <img src="<?php echo base_url("images/logo-mini.png"); ?>" height="50" width="100">
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
		
			<li>
			  <a href="<?php echo base_url("menu/salir"); ?>">
				<i class="fa fa-power-off"></i> <span>Salir</span>
			  </a>
			</li>
		
        </ul>
      </div>
    </nav>
  </header>