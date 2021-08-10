<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <script>
        function kursorActive(x) {
            x.classList.toggle("active");
        }
    </script>

    <?php
        $master = ($this->uri->segment(2) == 'peserta' || $this->uri->segment(2) == 'course' || $this->uri->segment(2) == 'import' || $this->uri->segment(2) == 'syncron' ? 'menu-open' : '');
        $peserta = ($this->uri->segment(2) == 'peserta' ? 'active' : '');
        $course = ($this->uri->segment(2) == 'course' ? 'active' : '');      
        $import = ($this->uri->segment(2) == 'import' ? 'active' : '');        
        $syncron = ($this->uri->segment(2) == 'syncron' ? 'active' : '');        
        $report = ($this->uri->segment(2) == 'report' ? 'menu-open' : '');
        $aksescourse = ($this->uri->segment(2) == 'aksescourse' ? 'active' : '');
        $validasiCompetency = ($this->uri->segment(2) == 'validasiCompetency' ? 'active' : '');
        $progres = ($this->uri->segment(3) == 'progresPeserta' || $this->uri->segment(3)== 'progresDetail' ? 'active' : '');  
        $logCourse = ($this->uri->segment(3) == 'logCourse' ? 'active' : '');     
    ?>

    <?php
    $query = "SELECT * FROM rzl_m_profile WHERE id='1'";
    $appName = $this->db->query($query)->result_array()[0]['appname'];
    ?>

    <!-- Brand Logo -->
    <a href="<?php echo base_url(); ?>dashboard" class="brand-link">
        <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo $appName; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $this->session->userdata('nama_lengkap'); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview <?php echo $master; ?>">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>admin/peserta" class="nav-link <?php echo $peserta; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Peserta</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>admin/course" class="nav-link <?php echo $course; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Course</p>
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>admin/import" class="nav-link <?php echo $import; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Import Question</p>
                            </a>
                        </li>   
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>admin/syncron" class="nav-link <?php echo $syncron; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Syncron</p>
                            </a>
                        </li>                                                                        
                    </ul>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="<?php echo base_url(); ?>admin/aksescourse" class="nav-link <?php echo $aksescourse; ?>">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Akses Course</p>
                        </a>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="<?php echo base_url(); ?>admin/validasiCompetency" class="nav-link <?php echo $validasiCompetency; ?>">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Validasi Competency</p>
                        </a>
                </li>                
                <li class="nav-item has-treeview <?php echo $report; ?>">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            Report
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>admin/report/progresPeserta" class="nav-link <?php echo $progres; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Progres Peserta</p>
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>admin/report/logCourse" class="nav-link <?php echo $logCourse; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Log Course</p>
                            </a>
                        </li>                                                
                    </ul>
                </li>            
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>