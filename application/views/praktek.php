<?php $this->load->view('header'); ?>

    <script type="text/javascript">
        function pilihTanggal(){
            Swal.fire({
                title: 'Apakah anda ingin memilih tanggal ini?',
                showCancelButton: true,
                confirmButtonText: `Pilih`,
            }).then((result) => {
                if (result.isConfirmed) {
                    var arrPraktek = {
                      "idcourse": $("#idcourse").val(),
                      "tglpraktek": $("#tglPraktek").val()
                    }
                    $.ajax({
                        type: "POST",
                        data: arrPraktek,
                        url: '<?php echo base_url('praktek/cekQuota'); ?>',
                        success: function(result) {
                          if(result >= $("#maxPeserta").val()){
                            Swal.fire({
                                icon: 'warning',
                                text: 'Tanggal Ini Sudah Melebihi Quota !',
                            })
                            return;                             
                          }else{
                            var dataArray = {
                                "praktek": {
                                    "idcourse": $("#idcourse").val(),
                                    "nip": $("#nip").val(),
                                    "tglpraktek": $("#tglPraktek").val()
                                }
                            }  

                            $.ajax({
                                type: "POST",
                                data: dataArray,
                                url: '<?php echo base_url('praktek/saveData'); ?>',
                                success: function(result) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Data Berhasil Disimpan',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })

                                    console.log(result);
                                    window.location = "<?php echo base_url(); ?>course/praktek/" + $("#idcourse").val();
                                }
                            })                            
                          }

                        }
                    })

                } else {
                    return;
                }
            })
        }
    </script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0 text-dark"> Top Navigation <small>Example 3.0</small></h1> -->
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Course</a></li>
              <li class="breadcrumb-item active">Praktek</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-12">

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">
                    PRAKTEK 
                </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                    <div class="container">

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Pilih Courses</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="idcourse" value="<?php echo $idCourse; ?>">
                                    <input type="hidden" class="form-control" id="nip" placeholder="NIP" value="<?php echo $this->session->userdata('nip'); ?>">
                                    <input type="text" class="form-control" id="maxPeserta" value="<?php echo $maxPeserta; ?>">
                                    <?php 
                                        if(empty($jadwalPraktek)){
                                            $tglPraktek ="";    
                                        }else{
                                            $tglPraktek = date("Y/m/d", strtotime($jadwalPraktek[0]['tglpraktek'])); 
                                        }
                                    ?>
                                    <select name='tglPraktek' id='tglPraktek' class="form-control select2" style="width: 100%;" <?php if($tglPraktek!=""){ echo 'disabled';} ?>>
                                        <option value=''>--Pilih Tanggal Praktek--</option>
                                        <?php for ($i=0; $i < count($praktek) ; $i++) { ?>
                                            <option value='<?php echo $praktek[$i] ?>' <?php if($praktek[$i]==$tglPraktek){echo "selected";} ?> ><?php echo $praktek[$i] ?></option>
                                        <?php } ?>
                                    </select>
                                    
                                </div>
                                <a href="#" class="btn btn-primary <?php if($tglPraktek!=""){ echo 'collapse';} ?>" onclick="pilihTanggal()">Pilih Tanggal</a>
                                <a href="<?php echo base_url('praktek/printBuktiDaftar/') . $idCourse; ?>" class="btn btn-success <?php if($tglPraktek==""){ echo 'collapse';} ?>">Cetak Bukti Pendaftaran</a>
                            </div>                          
                        </div>                     

                    </div>

                </div>
                <!-- /.card-body -->


              </form>
            </div>          

          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view('footer'); ?>
