  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel" style="padding-top: 20px;">
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
								
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Tutorías</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url("dashboard"); ?>"><i class="fa fa-circle-o"></i> Todos</a></li>
            <li><a href="<?php echo base_url("tutorias/listado"); ?>"><i class="fa fa-circle-o"></i> Crear tutoría</a></li>
            <li><a href="<?php echo base_url("parametros/lugares"); ?>"><i class="fa fa-circle-o"></i> Lugares</a></li>
            <li><a href="<?php echo base_url("parametros/temas"); ?>"><i class="fa fa-circle-o"></i> Temas</a></li>
          </ul>
        </li>		

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>