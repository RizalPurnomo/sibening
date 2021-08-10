<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>

<script type="text/javascript">

function approved(id) {
    Swal.fire({
        title: 'Masukan Jumlah JPL Yang Disetujui',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Approved',
        showLoaderOnConfirm: true
    }).then((result) => {
        console.log(result);
        if (result.isConfirmed) {
            var dataArray = {
                "competency": {
                    "jplapproved": result.value,
                    "statuscompetency" : "approved"
                }
            } 

            $.ajax({
              type: "POST",
              data: dataArray,
              url: "<?php echo base_url(); ?>admin/validasiCompetency/approved/" + id,
              success: function(html) {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Di Approved',
                    showConfirmButton: false,
                    timer: 1500
                })
                window.location.href = "<?php echo base_url(); ?>admin/validasiCompetency/";
              }
          })
        }
    })

}

function reject(id){
    Swal.fire({
            title: 'Apakah yakin data akan di tolak?',
            showCancelButton: true,
            confirmButtonText: `Reject`,
        }).then((result) => {
            if (result.isConfirmed) {
                var dataArray = {
                    "competency": {
                        "jplapproved": result.value,
                        "statuscompetency" : "reject"
                    }
                } 
                $.ajax({
                    type: "POST",
                    data: dataArray,
                    url: "<?php echo base_url(); ?>admin/validasiCompetency/reject/" + id,
                    success: function(html) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Data Berhasil Di Reject',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        window.location.href = "<?php echo base_url(); ?>admin/validasiCompetency/";
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
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Validasi Competency</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Validasi Competency</li>
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
                                            <th style="display:none;">Id</th>
                                            <th>Nama</th>
                                            <th>Tanggal</th>
                                            <th>Title</th>
                                            <th>Instance</th>
                                            <th>Files</th>
                                            <th>JPL Req</th>
                                            <th>JPL App</th>
                                            <th style="width:15%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($competency)) {
                                            for ($a = 0; $a < count($competency); $a++) { ?>
                                                <?php $idcompetency = $competency[$a]['idcompetency']; ?>
                                                <tr id="competency<?php echo $idcompetency; ?>">
                                                    <td><?php echo $a + 1 ?></td>
                                                    <td style="display:none;"><?php echo $idcompetency ?></td>
                                                    <td><?php echo $competency[$a]['nama_pegawai'] ?></td>
                                                    <td><?php echo $competency[$a]['date'] ?></td>
                                                    <td><?php echo $competency[$a]['title'] ?></td>
                                                    <td><?php echo $competency[$a]['instance'] ?></td>
                                                    <td><a href="<?php echo base_url('uploads/competency/') . $competency[$a]['files'] ; ?>" target="_blank" ><?php echo $competency[$a]['files']; ?></a></td>
                                                    <td><?php echo $competency[$a]['jplrequest'] ?></td>
                                                    <td><?php echo $competency[$a]['jplapproved'] ?></td>
                                                    <td>
                                                        <?php 
                                                            $id = $competency[$a]['idcompetency'];
                                                            $linkApproved ="javascript:approved($id)";
                                                            $linkReject ="javascript:reject($id)";
                                                            $pending = "
                                                                <a class='btn btn-success btn-sm' href='$linkApproved'>
                                                                    <i class='fa fa-check'>
                                                                    </i>
                                                                    Approved
                                                                </a>   
                                                                <a class='btn btn-danger btn-sm' href='$linkReject'>
                                                                    <i class='fa fa-times' aria-hidden='true'></i>
                                                                    </i>
                                                                    Reject
                                                                </a>        
                                                            ";    

                                                            $approved = ' 
                                                                <button class="btn btn-success btn-sm disabled">
                                                                    <i class="fa fa-check">
                                                                    </i>
                                                                    Approved
                                                                </button>        
                                                            ';       
                                                            
                                                            $reject = ' 
                                                                <button class="btn btn-danger btn-sm disabled">
                                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                                    </i>
                                                                    Rejected
                                                                </button>        
                                                            ';                                                             
                                                            
                                                            if($competency[$a]['statuscompetency']=='pending'){
                                                                echo $pending;
                                                            }else if($competency[$a]['statuscompetency']=='approved'){
                                                                echo $approved;
                                                            }else{
                                                                echo $reject;
                                                            }
                                                        
                                                        ?>

                                                    </td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <th>No</th>
                                        <th style="display:none;">Id</th>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Title</th>
                                        <th>Instance</th>
                                        <th>Files</th>
                                        <th>JPL Req</th>
                                        <th>JPL App</th>
                                        <th style="width:15%">Status</th>
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