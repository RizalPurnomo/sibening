<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>

<script type="text/javascript">

    function getDateTime($tgl) {
        if ($tgl == "now") {
            var now = new Date();
        } else {
            var now = $tgl;
        }
        var year = now.getFullYear();
        var month = now.getMonth() + 1;
        var day = now.getDate();
        var hour = now.getHours();
        var minute = now.getMinutes();
        var second = now.getSeconds();
        if (month.toString().length == 1) {
            var month = '0' + month;
        }
        if (day.toString().length == 1) {
            var day = '0' + day;
        }
        if (hour.toString().length == 1) {
            var hour = '0' + hour;
        }
        if (minute.toString().length == 1) {
            var minute = '0' + minute;
        }
        if (second.toString().length == 1) {
            var second = '0' + second;
        }
        var dateTime = year + '/' + month + '/' + day + ' ' + hour + ':' + minute + ':' + second;
        return dateTime;
    }

    async function saveCompetency() {
        let today = new Date(),
            curr_hour = today.getHours(),
            curr_min = today.getMinutes(),
            curr_sec = today.getSeconds();

        tanggal = getDateTime(new Date($("#datepicker").val() + " " + curr_hour + ":" + curr_min + ":" + curr_sec));


        if ($("#datepicker").val() == "" || $("#instance").val() == "" || $("#title").val() == "" || $("#jpl").val() == "" ) {
            Swal.fire({
                icon: 'warning',
                text: 'Harap Melengkapi Data!',
            })
            return;
        }
        if($("#fileupload").val()==""){
            var dataArray = {
                "competency": {
                    "nip": $("#nip").val(),
                    "date": tanggal,
                    "title": $("#title").val(),
                    "instance" : $("#instance").val(),
                    "jplapproved" : $("#jpl").val(),
                    "statuscompetency" : 'approved',
                    'iddiklat' : $("#iddiklat").val(),
                    'idjenisdiklat' : $("#idjenis").val()
                }
            }            
        }else{
            upload = $("#nama").val() + " - " + fileupload.files[0].name;
            let formData = new FormData(); 
            formData.append("file", fileupload.files[0]);
            await fetch('upload', {
                method: "POST", 
                body: formData
            });       
            var dataArray = {
                "competency": {
                    "nip": $("#nip").val(),
                    "date": tanggal,
                    "title": $("#title").val(),
                    "instance" : $("#instance").val(),
                    "jplapproved" : $("#jpl").val(),
                    "files" : upload,
                    "statuscompetency" : 'approved',
                    'iddiklat' : $("#iddiklat").val(),
                    'idjenisdiklat' : $("#idjenis").val()
                }
            }              
        }
        // return;


        console.log(dataArray);
        // return;
        $.ajax({
            type: "POST",
            data: dataArray,
            url: '<?php echo base_url('admin/validasicompetency/saveData'); ?>',
            success: function(result) {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Disimpan',
                    showConfirmButton: false,
                    timer: 1500
                })

                console.log(result);
                window.location = "<?php echo base_url(); ?>admin/validasicompetency";
            }
        })

    }



</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tambah Competency</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Competency</li>
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
                            <!-- <a href="<?php echo base_url(); ?>admin/validasiCompetency/add" class="btn btn-app">
                                <i class="fa fa-book" aria-hidden="true"></i> Tambah Competency
                            </a> -->
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">

                            <!-- <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kode Diklat</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="kodeDiklat" placeholder="Kode Diklat">
                                </div>
                                <div class="col-sm-1">
                                    <button type="submit" class="btn btn-primary" onclick="browseDiklat()">. . .</button>
                                </div>
                            </div>  -->
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Pegawai</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <select name='nip' id='nip' class="form-control select2" style="width: 100%;">
                                            <option value=''>--Pilih Pegawai--</option>
                                            <?php for ($i=0; $i < count($peserta) ; $i++) { ?>
                                                <option value='<?php echo $peserta[$i]['nip'] ?>'><?php echo $peserta[$i]['nama_pegawai'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Kode Diklat</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <select name='iddiklat' id='iddiklat' class="form-control select2" style="width: 100%;">
                                            <option value=''>--Pilih Kode Diklat--</option>
                                            <?php for ($i=0; $i < count($diklat) ; $i++) { ?>
                                                <option value='<?php echo $diklat[$i]['iddiklat'] ?>'><?php echo $diklat[$i]['jenisdiklat'] ." || " . $diklat[$i]['detailjenisdiklat'];  ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis Diklat</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <select name='idjenis' id='idjenis' class="form-control select2" style="width: 100%;">
                                            <option value=''>--Pilih Jenis Diklat--</option>
                                            <?php for ($i=0; $i < count($jenis) ; $i++) { ?>
                                                <option value='<?php echo $jenis[$i]['idjenisdiklat'] ?>'><?php echo $jenis[$i]['kelompok'] ." || " . $jenis[$i]['jenisdiklat'];  ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>                                                        
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" id="nama" placeholder="Nama" value="<?php echo $this->session->userdata('nama_lengkap'); ?>">
                                    <input type="hidden" class="form-control" id="nip" placeholder="NIP" value="<?php echo $this->session->userdata('nip'); ?>">
                                    <input type="text" class="form-control" id="title" placeholder="Title">
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Instance</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="instance" placeholder="Instance">
                                </div>
                            </div>                                        
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">JPL</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jpl" placeholder="JPL">
                                </div>
                            </div>   
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker">
                                    </div>
                                </div>
                            </div>                    
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Upload</label>
                                <div class="col-sm-10">
                                    <input  id="fileupload" type="file" size="40px" name="fileupload" />
                                </div>
                            </div>  
                                        
                        </div>
                                   
                        <div class="card-footer">
                            <button onclick="saveCompetency()" class="btn btn-info">Simpan</button>
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