<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>

<script type="text/javascript">

function beriNilai(Praktek) {
    Swal.fire({
        title: 'Beri Nilai Untuk Praktek Ini',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Finish',
        showLoaderOnConfirm: true
    }).then((result) => {
        console.log(result);
        if (result.isConfirmed) {
            let idPraktek = $("#" + Praktek + " td")[1].innerHTML;
            let idcourse = $("#" + Praktek + " td")[2].innerHTML;
            let nip = $("#" + Praktek + " td")[3].innerHTML;
            var dataArray = {
                "praktek": {
                    "nilai": result.value
                },
                "getcourse" : {
                    "nip" : nip,
                    "idcourse" : idcourse
                },
                "updateFlag" : {
                    "flag" : "finish"
                }
            } 

            // console.log(dataArray);
            // return;
            $.ajax({
                type: "POST",
                data: dataArray,
                url: "<?php echo base_url(); ?>admin/validasipraktek/beriNilai/" + idPraktek,
                success: function(html) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Data Berhasil Di Approved',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    console.log(html);
                    window.location.href = "<?php echo base_url(); ?>admin/validasiPraktek/";
                }
            })
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
                    <h1 class="m-0 text-dark">Validasi Praktek</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Validasi Praktek</li>
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
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Id</th>
                                            <th style="display:none;">IdCourse</th>
                                            <th style="display:none;">NIP</th>
                                            <th>Nama</th>
                                            <th>Title</th>
                                            <th>JPL</th>
                                            <th>Tgl Praktek</th>
                                            <th>Trainer</th>
                                            <th>Status</th>
                                            <th>Nilai</th>
                                            <th style="width:15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($praktek)) {
                                            for ($a = 0; $a < count($praktek); $a++) { ?>
                                                <?php $idpraktek = $praktek[$a]['idpraktek']; ?>
                                                <tr id="praktek<?php echo $idpraktek; ?>">
                                                    <td><?php echo $a + 1 ?></td>
                                                    <td><?php echo $idpraktek ?></td>
                                                    <td style="display:none;"><?php echo $praktek[$a]['idcourse'] ?></td>
                                                    <td style="display:none;"><?php echo $praktek[$a]['nip'] ?></td>
                                                    <td><?php echo $praktek[$a]['nama_pegawai'] ?></td>
                                                    <td><?php echo $praktek[$a]['title'] ?></td>
                                                    <td><?php echo $praktek[$a]['jpl'] ?></td>
                                                    <td><?php echo $praktek[$a]['tglpraktek'] ?></td>
                                                    <td><?php echo $praktek[$a]['trainer'] ?></td>
                                                    <td>
                                                        <?php 
                                                            if ($praktek[$a]['flag'] == 'finish') {
                                                                echo  "<button class='btn btn-success btn-sm' >finish</button>";
                                                            }else{
                                                                echo $praktek[$a]['flag'];
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $praktek[$a]['nilai'] ?></td>
                                                    <td>
                                                        <a class='btn btn-info btn-sm' href='javascript:beriNilai("praktek<?php echo $idpraktek; ?>")'>
                                                            <i class='fa fa-check'>
                                                            </i>
                                                            Beri Nilai
                                                        </a>
                                                    </td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <th>No</th>
                                        <th>Id</th>
                                        <th style="display:none;">IdCourse</th>
                                        <th style="display:none;">NIP</th>
                                        <th>Nama</th>
                                        <th>Title</th>
                                        <th>JPL</th>
                                        <th>Tgl Praktek</th>
                                        <th>Trainer</th>
                                        <th>Status</th>
                                        <th>Nilai</th>
                                        <th style="width:15%">Aksi</th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
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