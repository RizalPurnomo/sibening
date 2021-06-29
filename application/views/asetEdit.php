<?php $this->load->view('header'); ?>
<?php $this->load->view('sidebar'); ?>

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

    function saveData() {
        let today = new Date(),
            curr_hour = today.getHours(),
            curr_min = today.getMinutes(),
            curr_sec = today.getSeconds();

        tanggal = getDateTime(new Date($("#datepicker").val() + " " + curr_hour + ":" + curr_min + ":" + curr_sec));

        if ($("#jenis").val() == "" || $("#nama").val() == "" || $("#typeaset").val() == "" || $("#nilai").val() == "" || $("#kondisi").val() == "") {
            alert("Harap Lengkapi Data")

            return;
        }

        var dataArray = {
            "aset": {
                "id_aset": $("#idaset").val(),
                "tgl_perolehan": tanggal,
                "nilai_aset": $("#nilai").val(),
                "kondisi_aset": $("#kondisi").val(),
                "id_type": $("#typeaset").val(),
                "id_nama": $("#nama").val(),
                "id_jenis": $("#jenis").val()
            }
        }

        console.log(dataArray);
        // return;
        $.ajax({
            type: "POST",
            data: dataArray,
            url: '<?php echo base_url('aset/saveData'); ?>',
            success: function(result) {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Disimpan',
                    showConfirmButton: false,
                    timer: 1500
                })
                console.log(result);
                window.location = "<?php echo base_url(); ?>aset";
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
                    <h1 class="m-0 text-dark">Tambah aset</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url($this->uri->segment(1)); ?>"><?php echo $this->uri->segment(1); ?></a></li>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Input Data Aset
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Jenis Aset</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" style="width: 100%;" id="jenis">
                                            <option value="">-- Pilih Jenis--</option>
                                            <?php for ($a = 0; $a < count($jenis); $a++) {  ?>
                                                <option value="<?php echo $jenis[$a]['id_jenis'] ?>" <?php if ($jenis[$a]['id_jenis'] == $aset[0]['id_jenis']) {
                                                                                                            echo "selected";
                                                                                                        } ?>>
                                                    <?php echo $jenis[$a]['jenis_aset']  ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Nama Aset</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" style="width: 100%;" id="nama" <?php if ($nama[$a]['id_nama'] == $aset[0]['id_nama']) {
                                                                                                                echo "selected";
                                                                                                            } ?>>
                                            <option value="">-- Pilih Jenis--</option>
                                            <?php for ($a = 0; $a < count($nama); $a++) {  ?>
                                                <option value="<?php echo $nama[$a]['id_nama'] ?>">
                                                    <?php echo $nama[$a]['nama_aset']  ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Type Aset</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" style="width: 100%;" id="typeaset">
                                            <option value="">-- Pilih Type--</option>
                                            <?php for ($a = 0; $a < count($typeaset); $a++) {  ?>
                                                <option value="<?php echo $typeaset[$a]['id_type'] ?>" <?php if ($typeaset[$a]['id_type'] == $aset[0]['id_type']) {
                                                                                                            echo "selected";
                                                                                                        } ?>>
                                                    <?php echo $typeaset[$a]['type_aset']  ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ID Aset</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="idaset" placeholder="ID Aset">
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
                                    <label class="col-sm-2 col-form-label">Nilai Aset</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nilai" placeholder="Nilai Aset" value="<?php echo $aset[0]['nilai_aset'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Kondisi Aset</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" style="width: 100%;" id="kondisi">
                                            <option value="">-- Pilih Kondisi--</option>
                                            <option value="Berfungsi Dengan Baik">-- Berfungsi Dengan Baik--</option>
                                            <option value="Rusak Ringan">-- Rusak Ringan--</option>
                                            <option value="Rusak Berat">-- Rusak Berat--</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button onclick="" class="btn btn-info swalDefaultSuccess">Simpan</button>
                                <!-- <button class="btn btn-default float-right">Cancel</button> -->
                            </div>
                            <!-- /.card-footer -->
                        </div>
                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- /.card -->
            </div>



        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php $this->load->view('footer'); ?>