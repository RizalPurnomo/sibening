<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>

<script type="text/javascript">

</script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Peserta</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin"><?php echo $this->uri->segment(1); ?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->uri->segment(2); ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- <a href="<?php echo base_url(); ?>admin/peserta/add" class="btn btn-app">
                                <i class="fas fa-user"></i> Tambah User
                            </a> -->
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="box-body table-responsive">
                                <?php echo form_open('admin/syncron/saveSyncronUser'); ?>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Id</th>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Tempat</th>
                                            <th>Tanggal</th>
                                            <th>JK</th>
                                            <th>Tlp</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Agama</th>
                                            <th>Jabatan</th>
                                            <th>Bagian</th>
                                            <th>Pendidikan</th>
                                            <th>Status</th>
                                            <th>Rumpun</th>
                                            <th>Pajak</th>
                                            <th>KTP</th>
                                            <th>NPWP</th>
                                            <th>Norek DKI</th>
                                            <th>Status PNS</th>
                                            <th>BPJS KS</th>
                                            <th>BPJS JKK</th>
                                            <th>BPJS IJHT</th>
                                            <th>BPJS JP</th>
                                            <th>PJ Cuti</th>
                                            <th>Foto URL</th>
                                            <th>Tgl Masuk</th>
                                            <th>TMT Gaji</th>
                                            <th>Is Active</th>
                                            <th>Tempat Tugas</th>
                                            <th>Tempat Tugas Ket</th>
                                            <th>Shift Status</th>
                                            <th>Golongan</th>
                                            <th>NRK</th>
                                            <th>Gelar Depan</th>
                                            <th>Gelar Belakang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            for ($a = 0; $a < count($server); $a++) { 
                                                $id_pegawai = "";
                                                $nip = "";
                                                $nama_pegawai = "";
                                                $tempat_lahir = "";
                                                $tgl_lahir = "";
                                                $jenis_kelamin = "";
                                                $no_tlp = "";
                                                $email = "";
                                                $alamat = "";
                                                $agama = "";
                                                $jabatan = "";
                                                $bagian = "";
                                                $pendidikan = "";
                                                $status = "";
                                                $rumpun = "";
                                                $pajak = "";
                                                $no_ktp = "";
                                                $npwp = "";
                                                $norek_dki = "";
                                                $status_pns = "";
                                                $bpjs_ks = "";
                                                $bpjs_jkk = "";
                                                $bpjs_ijht = "";
                                                $bpjs_jp = "";
                                                $pj_cuti = "";
                                                $foto_url = "";
                                                $tgl_masuk = "";
                                                $tmt_gaji = "";
                                                $is_active = "";
                                                $tempat_tugas = "";
                                                $tempat_tugas_ket = "";
                                                $shift_status = "";
                                                $golongan = "";
                                                $nrk = "";
                                                $gelar_depan = "";
                                                $gelar_belakang = "";
                                        ?>
                                                <tr>
                                                    <td rowspan="2" style='text-align: center; vertical-align: middle;'><?php echo $a + 1 ?></td>
                                                    <td <?php 
                                                            if ($server[$a]['id_pegawai']!=$lokal[$a]['id_pegawai']) {
                                                                $id_pegawai = "bgcolor='red'";
                                                                echo $id_pegawai;
                                                            }
                                                        ?> 
                                                    >
                                                        <input name="id_pegawai[]" type="hidden" value="<?php echo $server[$a]['id_pegawai'] ?>"/>
                                                        <?php echo $server[$a]['id_pegawai'] ?>
                                                    </td>

                                                    <td <?php 
                                                            if ($server[$a]['nip']!=$lokal[$a]['nip']) {
                                                                $nip = "bgcolor='red'";
                                                                echo $nip;
                                                            }
                                                        ?> 
                                                    >
                                                        <input name="nip[]" type="hidden" value="<?php echo $server[$a]['nip'] ?>"/>
                                                        <?php echo $server[$a]['nip'] ?>
                                                    </td>

                                                    <td <?php 
                                                            if ($server[$a]['nama_pegawai']!=$lokal[$a]['nama_pegawai']) {
                                                                $nama_pegawai = "bgcolor='red'";
                                                                echo $nama_pegawai;

                                                            }
                                                        ?> 
                                                    >
                                                        <input name="nama_pegawai[]" type="hidden" value="<?php echo $server[$a]['nama_pegawai'] ?>"/>
                                                        <?php echo $server[$a]['nama_pegawai'] ?>
                                                    </td>    

                                                    <td <?php 
                                                            if ($server[$a]['tempat_lahir']!=$lokal[$a]['tempat_lahir']) {
                                                                $tempat_lahir = "bgcolor='red'";
                                                                echo $tempat_lahir;
                                                            }
                                                        ?> 
                                                    >
                                                        <input name="tempat_lahir[]" type="hidden" value="<?php echo $server[$a]['tempat_lahir'] ?>"/>
                                                        <?php echo $server[$a]['tempat_lahir'] ?>
                                                    </td> 

                                                    <td <?php 
                                                            if ($server[$a]['tgl_lahir']!=$lokal[$a]['tgl_lahir']) {
                                                                $tgl_lahir = "bgcolor='red'";
                                                                echo $tgl_lahir;
                                                            }
                                                        ?> 
                                                    >
                                                        <input name="tgl_lahir[]" type="hidden" value="<?php echo $server[$a]['tgl_lahir'] ?>"/>
                                                        <?php echo $server[$a]['tgl_lahir'] ?>
                                                    </td> 

                                                    <td <?php 
                                                            if ($server[$a]['jenis_kelamin']!=$lokal[$a]['jenis_kelamin']) {
                                                                $jenis_kelamin = "bgcolor='red'";
                                                                echo $jenis_kelamin;
                                                            }
                                                        ?> 
                                                    >
                                                        <input name="jenis_kelamin[]" type="hidden" value="<?php echo $server[$a]['jenis_kelamin'] ?>"/>
                                                        <?php echo $server[$a]['jenis_kelamin'] ?>
                                                    </td> 

                                                    <td <?php 
                                                            if ($server[$a]['no_tlp']!=$lokal[$a]['no_tlp']) {
                                                                $no_tlp = "bgcolor='red'";
                                                                echo $no_tlp;
                                                            }
                                                        ?> 
                                                    >
                                                        <input name="no_tlp[]" type="hidden" value="<?php echo $server[$a]['no_tlp'] ?>"/>
                                                        <?php echo $server[$a]['no_tlp'] ?>
                                                    </td> 

                                                    <td <?php 
                                                            if ($server[$a]['email']!=$lokal[$a]['email']) {
                                                                $email = "bgcolor='red'";
                                                                echo $email;
                                                            }
                                                        ?> 
                                                    >
                                                        <input name="email[]" type="hidden" value="<?php echo $server[$a]['email'] ?>"/>
                                                        <?php echo $server[$a]['email'] ?>
                                                    </td>    
                                                    
                                                    <td <?php 
                                                            if ($server[$a]['alamat']!=$lokal[$a]['alamat']) {
                                                                $alamat = "bgcolor='red'";
                                                                echo $alamat;
                                                            }
                                                        ?> 
                                                    >
                                                        <input name="alamat[]" type="hidden" value="<?php echo $server[$a]['alamat'] ?>"/>
                                                        <?php echo $server[$a]['alamat'] ?>
                                                    </td>  
                                                    
                                                    <td <?php 
                                                            if ($server[$a]['agama']!=$lokal[$a]['agama']) {
                                                                $agama = "bgcolor='red'";
                                                                echo $agama;
                                                            }
                                                        ?> 
                                                    >
                                                        <input name="agama[]" type="hidden" value="<?php echo $server[$a]['agama'] ?>"/>
                                                        <?php echo $server[$a]['agama'] ?>
                                                    </td>  
                                                    
                                                    <td <?php 
                                                            if ($server[$a]['jabatan']!=$lokal[$a]['jabatan']) {
                                                                $jabatan = "bgcolor='red'";
                                                                echo $jabatan;
                                                            }
                                                        ?> 
                                                    >
                                                        <input name="jabatan[]" type="hidden" value="<?php echo $server[$a]['jabatan'] ?>"/>
                                                        <?php echo $server[$a]['jabatan'] ?>
                                                    </td>  
                                                    
                                                    <td <?php 
                                                            if ($server[$a]['bagian']!=$lokal[$a]['bagian']) {
                                                                $bagian = "bgcolor='red'";
                                                                echo $bagian;
                                                            }
                                                        ?> 
                                                    >
                                                        <input name="bagian[]" type="hidden" value="<?php echo $server[$a]['bagian'] ?>"/>
                                                        <?php echo $server[$a]['bagian'] ?>
                                                    </td>  
                                                    
                                                    <td <?php 
                                                            if ($server[$a]['pendidikan']!=$lokal[$a]['pendidikan']) {
                                                                $pendidikan = "bgcolor='red'";
                                                                echo $pendidikan;
                                                            }
                                                        ?> 
                                                    >
                                                        <input name="pendidikan[]" type="hidden" value="<?php echo $server[$a]['pendidikan'] ?>"/>
                                                        <?php echo $server[$a]['pendidikan'] ?>
                                                    </td>  
                                                    
                                                    <td <?php 
                                                            if ($server[$a]['status']!=$lokal[$a]['status']) {
                                                                $status = "bgcolor='red'";
                                                                echo $status;
                                                            }
                                                        ?> 
                                                    >
                                                        <input name="status[]" type="hidden" value="<?php echo $server[$a]['status'] ?>"/>
                                                        <?php echo $server[$a]['status'] ?>
                                                    </td>  
                                                    
                                                    <td <?php 
                                                            if ($server[$a]['rumpun']!=$lokal[$a]['rumpun']) {
                                                                $rumpun = "bgcolor='red'";
                                                                echo $rumpun;
                                                            }
                                                        ?> 
                                                    >
                                                        <input name="rumpun[]" type="hidden" value="<?php echo $server[$a]['rumpun'] ?>"/>
                                                        <?php echo $server[$a]['rumpun'] ?>
                                                    </td>  
                                                    
                                                    <td <?php 
                                                            if ($server[$a]['pajak']!=$lokal[$a]['pajak']) {
                                                                $pajak = "bgcolor='red'";
                                                                echo $pajak;
                                                            }
                                                        ?> 
                                                    >
                                                        <input name="pajak[]" type="hidden" value="<?php echo $server[$a]['pajak'] ?>"/>
                                                        <?php echo $server[$a]['pajak'] ?>
                                                    </td>  
                                                    
                                                    <td <?php 
                                                            if ($server[$a]['no_ktp']!=$lokal[$a]['no_ktp']) {
                                                                $no_ktp = "bgcolor='red'";
                                                                echo $no_ktp;
                                                            }
                                                        ?> 
                                                    >
                                                        <input name="no_ktp[]" type="hidden" value="<?php echo $server[$a]['no_ktp'] ?>"/>
                                                        <?php echo $server[$a]['no_ktp'] ?>
                                                    </td>                                  
                                                </tr>

                                                <tr>
                                                    <td <?php echo $id_pegawai; ?> ><?php echo $lokal[$a]['id_pegawai'] ?></td>
                                                    <td <?php echo $nip; ?> ><?php echo $lokal[$a]['nip'] ?></td>
                                                    <td <?php echo $nama_pegawai; ?> ><?php echo $lokal[$a]['nama_pegawai'] ?></td>
                                                    <td <?php echo $tempat_lahir; ?>><?php echo $lokal[$a]['tempat_lahir'] ?></td>
                                                    <td <?php echo $tgl_lahir; ?>><?php echo $lokal[$a]['tgl_lahir'] ?></td>
                                                    <td <?php echo $jenis_kelamin; ?>><?php echo $lokal[$a]['jenis_kelamin'] ?></td>
                                                    <td <?php echo $no_tlp; ?>><?php echo $lokal[$a]['no_tlp'] ?></td>
                                                    <td <?php echo $email; ?>><?php echo $lokal[$a]['email'] ?></td>
                                                    <td <?php echo $alamat; ?>><?php echo $lokal[$a]['alamat'] ?></td>
                                                    <td <?php echo $agama; ?>><?php echo $lokal[$a]['agama'] ?></td>
                                                    <td <?php echo $jabatan; ?>><?php echo $lokal[$a]['jabatan'] ?></td>
                                                    <td <?php echo $bagian; ?>><?php echo $lokal[$a]['bagian'] ?></td>
                                                    <td <?php echo $pendidikan; ?>><?php echo $lokal[$a]['pendidikan'] ?></td>
                                                    <td <?php echo $status; ?>><?php echo $lokal[$a]['status'] ?></td>
                                                    <td <?php echo $rumpun; ?>><?php echo $lokal[$a]['rumpun'] ?></td>
                                                    <td <?php echo $pajak; ?>><?php echo $lokal[$a]['pajak'] ?></td>
                                                    <td <?php echo $no_ktp; ?>><?php echo $lokal[$a]['no_ktp'] ?></td>
                                                </tr>   
                                        <?php
                                            } 
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Id</th>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Tempat</th>
                                            <th>Tanggal</th>
                                            <th>JK</th>
                                            <th>Tlp</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Agama</th>
                                            <th>Jabatan</th>
                                            <th>Bagian</th>
                                            <th>Pendidikan</th>
                                            <th>Status</th>
                                            <th>Rumpun</th>
                                            <th>Pajak</th>
                                            <th>KTP</th>
                                            <th>NPWP</th>
                                            <th>Norek DKI</th>
                                            <th>Status PNS</th>
                                            <th>BPJS KS</th>
                                            <th>BPJS JKK</th>
                                            <th>BPJS IJHT</th>
                                            <th>BPJS JP</th>
                                            <th>PJ Cuti</th>
                                            <th>Foto URL</th>
                                            <th>Tgl Masuk</th>
                                            <th>TMT Gaji</th>
                                            <th>Is Active</th>
                                            <th>Tempat Tugas</th>
                                            <th>Tempat Tugas Ket</th>
                                            <th>Shift Status</th>
                                            <th>Golongan</th>
                                            <th>NRK</th>
                                            <th>Gelar Depan</th>
                                            <th>Gelar Belakang</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>                        

                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- /.card -->
            </div>
        <!-- /.row -->
        <!-- Main row -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <?php $this->load->view('admin/footer'); ?>
