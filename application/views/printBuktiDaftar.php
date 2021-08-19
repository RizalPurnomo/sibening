<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Puskesmas Kecamatan Matraman</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/adminlte.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->

    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <address>
          <strong>Puskesmas Kecamatan Matraman</strong><br>
          Jl. Pisangan Baru Timur No. 2A RT/RW 004/009 <br>
          Kel. Pisangan Baru Kec. Matraman Jakarta Timur. Kode Pos : 13110<br>
          Phone: 0813-5054-6442<br>
          Email: puskesmas.matraman@jakarta.go.id
        </address>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
            <center>Bukti Pendaftaran Pelatihan</center>
        </h2>
      </div>
      <!-- /.col -->
    </div>

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>No</th>
            <th>Title</th>
            <th>JPL</th>
            <th>Tgl Praktek</th>
            <th>Trainer</th>
          </tr>
          </thead>
          <tbody>
            <?php for ($a = 0; $a < count($praktek); $a++) { ?>
                <tr>
                    <td><?php echo $a+1; ?></td>
                    <td><?php echo $praktek[$a]['title'] ?></td>
                    <td><?php echo $praktek[$a]['jpl'] ?></td>
                    <td><?php echo $praktek[$a]['tglpraktek'] ?></td>
                    <td><?php echo $praktek[$a]['trainer'] ?></td>
                </tr>
            <?php } ?>

          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
        <p class="lead">Keterangan :</p>

        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
          Harap datang ke Puskesmas Kecamatan Matraman tepat waktu
        </p>
      </div>
      <!-- /.col -->
      <div class="col-6">

      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->

<script type="text/javascript"> 
//   window.addEventListener("load", window.print());
</script>
</body>
</html>
