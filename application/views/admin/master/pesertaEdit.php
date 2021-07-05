<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js" integrity="sha512-nOQuvD9nKirvxDdvQ9OMqe2dgapbPB7vYAMrzJihw5m+aNcf0dX53m6YxM4LgA9u8e9eg9QX+/+mPu8kCNpV2A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
    async function resetPassword() {
        const {
            value: password
        } = await Swal.fire({
            title: 'Reset Password',
            input: 'password',
            inputLabel: 'Password',
            inputPlaceholder: 'Reset Password',
            inputAttributes: {
                maxlength: 100,
                autocapitalize: 'off',
                autocorrect: 'off'
            }
        })

        if (password) {
            var dataArray = {
                "peserta": {
                    "password": CryptoJS.MD5(password).toString()
                }
            }

            console.log(dataArray);
            // return;
            $.ajax({
                type: "POST",
                data: dataArray,
                url: '<?php echo base_url('admin/peserta/resetPassword/'); ?>' + $("#idpeserta").val(),
                success: function(result) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Password berhasil di RESET',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    console.log(result);
                    window.location = "<?php echo base_url(); ?>admin/peserta";
                }
            })
        }
    }

    function updatePeserta() {
        if ($("#email").val() == "" || $("#password").val() == "" || $("#nama").val() == "") {
            Swal.fire({
                icon: 'warning',
                text: 'Harap Melengkapi Data!',
            })
            return;
        }

        var dataArray = {
            "peserta": {
                "email": $("#email").val(),
                "namapeserta": $("#nama").val()
            }
        }

        console.log(dataArray);
        // return;
        $.ajax({
            type: "POST",
            data: dataArray,
            url: '<?php echo base_url('admin/peserta/updateData/'); ?>' + $("#idpeserta").val(),
            success: function(result) {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Diupdate',
                    showConfirmButton: false,
                    timer: 1500
                })

                console.log(result);
                window.location = "<?php echo base_url(); ?>admin/peserta";
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
            <h1 class="m-0 text-dark">Peserta Add</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#"><?php echo $this->uri->segment(1); ?></a></li>
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
                        Input Data Peserta
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
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Id Peserta</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="idpeserta" value="<?php echo $peserta[0]['idpeserta']; ?>" disabled placeholder="User Id">
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email" placeholder="Email" value="<?php echo $peserta[0]['email']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama Peserta</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="nama" placeholder="Nama Peserta" value="<?php echo $peserta[0]['namapeserta']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <button type="button" class="col-sm-6 btn btn-block btn-primary" onclick="resetPassword()">Ganti Password</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button onclick="updatePeserta()" class="btn btn-info">Update</button>
                            <!-- <button class="btn btn-default float-right">Cancel</button> -->
                        </div>
                        <!-- /.card-footer -->
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
