<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="image/user/<?php echo $this->session->userdata('foto'); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('nama'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
        
        <li><a href="app"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        
        <?php 
        if ($this->session->userdata('level') == 1) {
          ?>
          <li><a href="Mubaligh"><i class="fa fa-keyboard-o"></i> <span>Mubaligh</span></a></li>
          <li class="treeview">
            <a href="#">
                <i class="fa fa-list"></i>
                <span>Master Data</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="Kecamatan"><i class="fa fa-angle-double-right"></i> Kecamatan</a></li>
                <li><a href="kelurahan"><i class="fa fa-angle-double-right"></i> Kelurahan</a></li>
                <li><a href="Masjid"><i class="fa fa-angle-double-right"></i> Masjid</a></li>
                <li><a href="kegiatan"><i class="fa fa-angle-double-right"></i> Kegiatan</a></li>
            </ul>
          </li>
          <li><a href="jadwal"><i class="fa fa-calendar"></i> <span>SET Jadwal</span></a></li>
          <li><a href="app/cetak"><i class="fa fa-print"></i> <span>Cetak</span></a></li>
          
          <li><a href="a_user"><i class="fa fa-users"></i> <span>Manajemen User</span></a></li>
          <?php
        } elseif ($this->session->userdata('level')=='2') {
          ?>
          <li><a href="app/jadwal_masjid/<?php echo $this->session->userdata('masjid'); ?>"><i class="fa fa-calendar"></i> <span>Jadwal Masjid</span></a></li>
          <?php
        }
         ?>

        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Faqs</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Tentang Aplikasi</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>