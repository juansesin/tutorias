  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url("images/user.png"); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Bienvenid@:<br><?php echo $this->session->firstname; ?><br><?php echo $this->session->lastname; ?></p>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVEGACIÓN PRINCIPAL</li>
		
        <li>
          <a href="<?php echo base_url("docente"); ?>">
            <i class="fa fa-dashboard"></i> <span>Tutorías</span>
          </a>
        </li>
		

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>