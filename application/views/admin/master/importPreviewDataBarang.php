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
                    <h1 class="m-0 text-dark">Diklat</h1>
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
            <div class="card-header">
                <!-- <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    
                    <?php echo $sheetData[0]['1']; ?>
                </h3> -->

            </div>
            <div class="card-body">
                <div class="box-body table-responsive">
                    <?php echo form_open('admin/import/saveDataBarang'); ?>
                    <input name="idCourse" value="<?php echo $sheetData[0]['0']; ?>">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id Klasifikasi</th>
                                <th>Kategori</th>
                                <th>Nama Barang</th>
                                <th>Satuan</th>
                                <th>Barcode</th>
                                <th>Stock</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $jum = count($sheetData);
                            if (!empty($sheetData)) {
                                $no = 0;
                                for ($a = 0; $a < $jum; $a++) { ?>
                                    <?php
                                    if ($a == 0 || $a == 0) {
                                    } else {
                                        $no++;
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><input name='id_klasifikasi[]' value='<?php echo $sheetData[$a]['0']; ?>'></td>
                                            <td><input name='kategori[]' value='<?php echo $sheetData[$a]['1']; ?>'></td>
                                            <td><input name='nama_barang[]' value='<?php echo $sheetData[$a]['2']; ?>'></td>
                                            <td><input name='satuan_barang[]' value='<?php echo $sheetData[$a]['3']; ?>'></td>
                                            <td><input name='barcode[]' value='<?php echo $sheetData[$a]['4']; ?>'></td>
                                            <td><input name='stock[]' value='<?php echo $sheetData[$a]['5']; ?>'></td>
                                            <td><input name='nilai[]' value='<?php echo $sheetData[$a]['6']; ?>'></td>
                                        </tr>
                                    <?php } ?>
                            <?php }
                            }
                            ?>
                        </tbody>
                    </table>

                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php $this->load->view('admin/footer'); ?>