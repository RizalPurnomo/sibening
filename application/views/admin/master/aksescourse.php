<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>

<script type="text/javascript">

    function selectData(id){
        let idkategori = $("#" + id + " td")[1].innerHTML;
        let kategori = $("#" + id + " td")[2].innerHTML;

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>admin/aksescourse/getaksescoursebykategori/" + idkategori,
            success: function(result) {
                arr = JSON.parse(result);
                console.log(arr);
                txt="";
                txtjudul = kategori;
                txtupdate='<button onclick="updateaksescourse()" class="btn btn-info">Update</button>';      

                for (x in arr['bagian']) {
                    for (j in arr['aksescourse']) {
                        checked[j] = arr['bagian'][x]['bagian_id'] == arr['aksescourse'][j]['idbagian'] ? 'checked' : '';
                    }
                    txt +=`
                        <li>
                            <input class="custom-control-input" type="checkbox" id="customCheckbox${x}" value="${arr['bagian'][x]['bagian_id']}" >
                            <label for="customCheckbox${x}" class="custom-control-label">${arr['bagian'][x].bagian_nama}</label>
                        </li>`;
                }


                document.getElementById("divaksescourse").innerHTML = txt;
                document.getElementById("divjudul").innerHTML = txtjudul;
                document.getElementById("divupdate").innerHTML = txtupdate;


                return;
                if(arr['aksescourse'].length<1){
                    txt="";
                    txtjudul="";
                    txtupdate="";
                }else{
                    txt = "";
                            for (x in arr['bagian']) {
                                checked = "";
                                for (j in arr['aksescourse']) {
                                    // arr['bagian'][x]['bagian_id'] == arr['aksescourse'][j]['idbagian'] ? checked='checked' : checked='';
                                    if(arr['bagian'][x]['bagian_id'] == arr['aksescourse'][j]['idbagian']){
                                        checked='checked';
                                    }else{
                                        checked='';
                                    }
                                    
                                    txt +=`                                                    
                                        <li>
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox${x}" value="${arr['bagian'][x]['bagian_id']}" ${checked}>
                                            <label for="customCheckbox${x}" class="custom-control-label">${arr['bagian'][x].bagian_nama}</label>
                                        </li>`;
                                }
                            }
                    txtjudul = kategori;
                    txtupdate='<button onclick="updateaksescourse()" class="btn btn-info">Update</button>';
                }
                document.getElementById("divaksescourse").innerHTML = txt;
                document.getElementById("divjudul").innerHTML = txtjudul;
                document.getElementById("divupdate").innerHTML = txtupdate;
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
            <h1 class="m-0 text-dark">Akses Course</h1>
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

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Kategori</h4>
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
                                            <th style="display:none;">Id Kategori</th>
                                            <th>Kategory</th>
                                            <th style="width:15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($kategori)) {
                                            for ($a = 0; $a < count($kategori); $a++) { ?>
                                                <?php $idkategori = $kategori[$a]['idkategori']; ?>
                                                <tr id="kategori<?php echo $idkategori; ?>">
                                                    <td><?php echo $a + 1 ?></td>
                                                    <td style="display:none;"><?php echo $idkategori ?></td>
                                                    <td><?php echo $kategori[$a]['kategori'] ?></td>
                                                    <td>
                                                        <a class="btn btn-large btn-primary" href="javascript:selectData('kategori<?php echo $kategori[$a]['idkategori']; ?>')">Pilih</a>
                                                    </td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <th>No</th>
                                        <th style="display:none;">Id kategori</th>
                                        <th>Kategory</th>
                                        <th>Aksi</th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </div>
                    <!-- ./card-body -->
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div id="divjudul"></div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <div id="divaksescourse">

                                        </div>
                                    </div>
                                </div>
                            </ul>
                            <div class="card-footer" id="divupdate">
                                
                            </div>

                        </div>
                    </div>
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
