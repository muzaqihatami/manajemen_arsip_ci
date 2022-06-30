<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    
    <!--CSS-->
    <link href="/assets/css/style.css" rel="stylesheet">

    <!--FONT-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400;600;700&display=swap" rel="stylesheet"> 

    <title>Manajemen Arsip - Permintaan Surat Keluar</title>
</head>
<body class="login-body">
    <div class="permintaan-box">
        <div class="permintaan-box-inside">
            <form action="/permintaan" method="POST">
                <h3 class="modal-title mb-4">Permintaan Pembuatan Surat</h3>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Pemohon</label>
                    <input type="text" class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="pemohon" required oninvalid="this.setCustomValidity('Nama Pemohon tidak boleh kosong')"
  oninput="this.setCustomValidity('')">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tujuan Surat</label>
                    <input type="text" class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="tujuan_surat" required oninvalid="this.setCustomValidity('Tujuan Surat tidak boleh kosong')"
  oninput="this.setCustomValidity('')">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Perihal</label>
                    <input type="text" class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="perihal" required oninvalid="this.setCustomValidity('Perihal tidak boleh kosong')"
  oninput="this.setCustomValidity('')">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Catatan</label>
                    <textarea class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="catatan" rows="4" required oninvalid="this.setCustomValidity('Catatan tidak boleh kosong')"
  oninput="this.setCustomValidity('')"></textarea>
                </div>
                <?php if (isset($_SESSION['error'])): ?>
                    <p style="color:red;"><?= $_SESSION['error']; ?></p>
                <?php endif;?>
                <div class="mt-5" style="text-align:right;">
                    <button type="submit" class="btn btn-success input-btn-save me-2">Simpan</button>
                    <a href="/" class="btn btn-danger input-btn-cancel">Batalkan</a>
                </div>
            </form>
        </div>
    </div>
    
    <!--BOOTSTRAP--> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>