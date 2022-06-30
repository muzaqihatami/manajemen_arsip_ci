<div class="content">
    <div class="container">
        <div class="list-data-header">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control data-search-btn" id="input-cari" placeholder="&#xF002;  Cari">
                </div>
                <div class="col-md-6 data-input-btn-section">
                    <button type="button" class="btn btn-primary mb-3 data-input-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Input</button>
                </div>
            </div>
        </div>
        <div class="list-data-table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">No Masuk Surat</th>
                        <th scope="col">Perihal</th>
                        <th scope="col">Tanggal Masuk</th>
                        <th scope="col">Disposisi</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="list-data-table">
                    <?php
                    $no = 1; 
                    foreach ($data as $d): ?>
                        <tr class="table-row-data" data-id="<?=$d["id_surat"]?>">
                            <td><?= $no ?></td>
                            <td><?= $d["no_msk_surat"] ?></td>
                            <td><?= $d["perihal"] ?></td>
                            <td><?= $d["tgl_surat"] ?></td>
                                <?php if (array_key_exists('id_disposisi',$d)) {
                                    if ($d["id_disposisi"] != "") { ?>
                                    <td><button type="button" class="btn btn-lihat-disposisi btn-primary data-lihat-detail" data-id="<?=$d["id_disposisi"]?>">Lihat</button></td>
                                    <?php } else {?>
                                    <td>
                                        <button type="button" class="btn btn-disposisi btn-primary data-input-file" data-id="<?=$d["id_surat"]?>">+</button>
                                    </td>
                                <?php } ?>
                                <?php } else { ?>
                                    <td>
                                        <button type="button" class="btn btn-disposisi btn-primary data-input-file" data-id="<?=$d["id_surat"]?>">+</button>
                                    </td>
                                <?php } ?>
                                <td>
                                    <button type="button" class="btn btn-edit btn-warning data-edit-btn" data-id="<?=$d["id_surat"]?>">
                                        <img class="data-edit-btn-img" src="/assets/image/icon-edit.png" />
                                    </button>
                                    <button type="button" class="btn btn-danger data-delete-btn" data-id="<?=$d["id_surat"]?>">X</button>
                                </td>
                        </tr>
                    <?php 
                    $no++;
                    endforeach ?>
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content input-content">
                    <div class="modal-header pop-up-header" style="border-bottom: 0px;">
                        <h4 class="modal-title" id="exampleModalLabel">Input Surat Masuk</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form id="form-surat" action="javascript:void(0)" method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tanggal Surat</label>
                                <input type="date" class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="tanggal_surat" required oninvalid="this.setCustomValidity('Tanggal Surat tidak boleh kosong')"
  oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">No. Surat</label>
                                <input type="text" class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="no_surat" required oninvalid="this.setCustomValidity('No Surat tidak boleh kosong')"
  oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Pengirim</label>
                                <input type="text" class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="pengirim" required oninvalid="this.setCustomValidity('Pengirim Surat tidak boleh kosong')"
  oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Perihal</label>
                                <input type="text" class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="perihal" required oninvalid="this.setCustomValidity('Perihal Surat tidak boleh kosong')"
  oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tujuan</label>
                                <input type="text" class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="tujuan" required oninvalid="this.setCustomValidity('Tujuan Surat tidak boleh kosong')"
  oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">File Surat</label><br/>
                                <label for="formFile" class="form-label">
                                    <a class="btn btn-primary btn-sm input-upload-btn" rel="nofollow">+ Upload</a>
                                </label>
                                <input class="form-control input-file" type="file" id="formFile" style="opacity:0" name="file" required oninvalid="this.setCustomValidity('File Surat tidak boleh kosong')"
  oninput="this.setCustomValidity('')">
                            </div>
                            <p id="error_surat_masuk" style="color:red;"></p>
                        </div>
                        <div class="modal-footer pop-up-footer" style="border-top: 0px;">
                            <button type="submit" class="btn btn-success input-btn-save">Simpan</button>
                            <button type="button" class="btn btn-danger input-btn-cancel" data-bs-dismiss="modal">Batalkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Disposisi -->
        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content input-content">
                    <div class="modal-header pop-up-header" style="border-bottom: 0px;">
                        <h4 class="modal-title" id="exampleModalLabel">Input Disposisi Surat</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form id="form-disposisi" action="javascript:void(0)" method="PUT">
                        <div class="modal-body">
                            <input type="hidden" name="id_surat" value="">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Diteruskan Kepada</label>
                                <input type="text" name="diteruskan_kpd" class="form-control input-box" id="exampleFormControlInput1" placeholder="" required oninvalid="this.setCustomValidity('Diteruskan Kepada tidak boleh kosong')"
  oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Catatan</label>
                                <input type="text" name="catatan" class="form-control input-box" id="exampleFormControlInput1" placeholder="" required oninvalid="this.setCustomValidity('Catatan tidak boleh kosong')"
  oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3">
                                <label for="formFile1" class="form-label">File Disposisi</label><br/>
                                <label for="formFile1" class="form-label">
                                    <a class="btn btn-primary btn-sm input-upload-btn" rel="nofollow">+ Upload</a>
                                </label>
                                <input name="file_disposisi" class="form-control input-file" type="file" id="formFile1" style="display:none">
                            </div>
                            <p id="error_disposisi" style="color:red;"></p>
                        </div>
                        <div class="modal-footer pop-up-footer" style="border-top: 0px;">
                            <button type="submit" class="btn btn-success input-btn-save">Simpan</button>
                            <button type="button" class="btn btn-danger input-btn-cancel" data-bs-dismiss="modal">Batalkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content input-content">
                    <div class="modal-header pop-up-header" style="border-bottom: 0px;">
                        <h4 class="modal-title" id="exampleModalLabel">Ubah Surat Masuk</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form id="form-surat-edit" action="javascript:void(0)" method="PUT">
                        <input type="hidden" name="id_surat" value="">
                        <div class="modal-body">
                            <input type="hidden" name="id_surat" value>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tanggal Surat</label>
                                <input type="date" class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="tanggal_surat" required oninvalid="this.setCustomValidity('Tanggal Surat tidak boleh kosong')"
  oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">No. Surat</label>
                                <input type="text" class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="no_surat" required oninvalid="this.setCustomValidity('No Surat tidak boleh kosong')"
  oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Pengirim</label>
                                <input type="text" class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="pengirim" required oninvalid="this.setCustomValidity('Pengirim tidak boleh kosong')"
  oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Perihal</label>
                                <input type="text" class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="perihal" required oninvalid="this.setCustomValidity('Perihal tidak boleh kosong')"
  oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tujuan</label>
                                <input type="text" class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="tujuan" required oninvalid="this.setCustomValidity('Tujuan tidak boleh kosong')"
  oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3">
                                <label for="formFile2" class="form-label">File Surat</label><br/>
                                <label for="formFile2" class="form-label">
                                    <a class="btn btn-primary btn-sm input-upload-btn" rel="nofollow">+ Upload</a>
                                </label>
                                <input class="form-control input-file" type="file" id="formFile2" style="opacity:0" name="file">
                            </div>
                            <p id="error_edit_surat_masuk" style="color:red;"></p>
                        </div>
                        <div class="modal-footer pop-up-footer" style="border-top: 0px;">
                            <button type="submit" class="btn btn-success input-btn-save">Simpan</button>
                            <button type="button" class="btn btn-danger input-btn-cancel" data-bs-dismiss="modal">Batalkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Detail Surat -->
        <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content input-content">
                    <div class="modal-header pop-up-header" style="border-bottom: 0px;">
                        <h4 class="modal-title" id="exampleModalLabel">Data Surat Masuk</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <h6 style="font-weight:600">Tanggal Surat</h6>
                            <p id="data_tgl_surat"></p>
                        </div>
                        <div class="mb-2">
                            <h6 style="font-weight:600">No Surat</h6>
                            <p id="data_no_surat"></p>
                        </div>
                        <div class="mb-2">
                            <h6 style="font-weight:600">Pengirim</h6>
                            <p id="data_pengirim"></p>
                        </div>
                        <div class="mb-2">
                            <h6 style="font-weight:600">Perihal</h6>
                            <p id="data_perihal"></p>
                        </div>
                        <div class="mb-2">
                            <h6 style="font-weight:600">Tanggal Masuk Surat</h6>
                            <p id="data_tgl_msk_surat"></p>
                        </div>
                        <div class="mb-2">
                            <h6 style="font-weight:600">No Masuk Surat</h6>
                            <p id="data_no_msk_surat"></p>
                        </div>
                        <div class="mb-2">
                            <h6 style="font-weight:600">Admin yang menginput</h6>
                            <p id="data_admin"></p>
                        </div>
                        <div class="mb-2">
                            <h6 style="font-weight:600">File Surat</h6>
                            <button id="data_file_surat" class="btn btn-primary btn-sm data-lihat-detail" style="font-size:14px" data-id="">Download</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Detail Disposisi -->
        <div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content input-content">
                    <div class="modal-header pop-up-header" style="border-bottom: 0px;">
                        <h4 class="modal-title" id="exampleModalLabel">Data Disposisi</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <h6 style="font-weight:600">Diteruskan Kepada</h6>
                            <p id="data_dsp_diteruskan_kpd"></p>
                        </div>
                        <div class="mb-3">
                            <h6 style="font-weight:600">Catatan</h6>
                            <p id="data_dsp_catatan"></p>
                        </div>
                        <div class="mb-3">
                            <h6 style="font-weight:600">File Disposisi</h6>
                            <button id="data_file_disposisi" class="btn btn-primary btn-sm data-lihat-detail" style="font-size:14px" data-id="">Download</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Delete -->
        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content input-content">
                    <div class="modal-body mt-4">
                        <div style="text-align:center;">
                            <img src="/assets/image/icon_delete.png" class="mb-2">
                            <h2 style="color:#444444">Apakah Kamu Yakin?</h2>
                            <p class="mt-3" style="color:#B3B3B3">Apakah kamu yakin ingin menghapus kategori ini? Proses ini tidak dapat dibatalkan</p>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 0px;justify-content: center;">
                        <a id="btn-delete" href="#" class="btn btn-danger input-btn-cancel">Hapus</a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $('.btn-edit').click(function () {
        var data_id = $(this).attr('data-id');
        $.ajax({
            url : "/admin/surat-masuk/"+data_id+"/detail",
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            type: "GET",
            data: null,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function(data)
            {
                $('#form-surat-edit input[name=tanggal_surat]').val(data.result.tgl_surat)
                $('#form-surat-edit input[name=no_surat]').val(data.result.no_surat)
                $('#form-surat-edit input[name=pengirim]').val(data.result.pengirim)
                $('#form-surat-edit input[name=perihal]').val(data.result.perihal)
                $('#form-surat-edit input[name=tujuan]').val(data.result.tujuan)
                $("#form-surat-edit input[name=id_surat]").val(data_id);
                
                $('#exampleModal2').modal('toggle');
                $('#exampleModal2').modal('show')
            },
            error: function (e)
            {
                console.log(e.responseJSON)
            }
        });
    });

    $('.table-row-data .btn-disposisi').click(function () {
        var data_id = $(this).attr('data-id');
        $("#form-disposisi input[name=id_surat]").val(data_id);
        $('#exampleModal1').modal('toggle');
        $('#exampleModal1').modal('show');
    });

    $('.data-delete-btn').click(function () {
        var data_id = $(this).attr('data-id');
        $("#btn-delete").attr('href', '/admin/surat-masuk/'+data_id+'/delete');
        $('#exampleModal3').modal('toggle');
        $('#exampleModal3').modal('show')
    });

    $('.table-row-data').click(function () {
        if ($(event.target).closest('.btn-disposisi').length || $(event.target).closest('.data-delete-btn').length || $(event.target).closest('.btn-edit').length || $(event.target).closest('.btn-lihat-disposisi').length) {
            return
        }   
        var data_id = $(this).attr('data-id');
        $.ajax({
            url : "/admin/surat-masuk/"+data_id+"/detail",
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            type: "GET",
            data: null,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function(data)
            {
                $('#data_tgl_surat').text(data.result.tgl_surat)
                $('#data_no_surat').text(data.result.no_surat)
                $('#data_pengirim').text(data.result.pengirim)
                $('#data_perihal').text(data.result.perihal)
                $('#data_tgl_msk_surat').text(data.result.tgl_msk_surat)
                $('#data_no_msk_surat').text(data.result.no_msk_surat)
                $('#data_admin').text(data.result.nama)
                $('#data_file_surat').attr('data-id', data.result.id_surat)

                $('#exampleModal4').modal('toggle');
                $('#exampleModal4').modal('show')
            },
            error: function (e)
            {
                console.log(e.responseJSON)
            }
        });
    });

    $('.btn-lihat-disposisi').click(function () {
        var data_id = $(this).attr('data-id');
        $.ajax({
            url : "/admin/disposisi/"+data_id,
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            type: "GET",
            data: null,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function(data)
            {
                $('#data_dsp_diteruskan_kpd').text(data.result.diteruskan_kpd)
                $('#data_dsp_catatan').text(data.result.catatan)
                $('#data_file_disposisi').attr('data-id', data.result.id_disposisi)

                $('#exampleModal5').modal('toggle');
                $('#exampleModal5').modal('show')
            },
            error: function (e)
            {
                console.log(e.responseJSON)
            }
        });
    });

    $('#data_file_surat').click(function () {
        var data_id = $(this).attr('data-id');
        window.location="http://localhost:8080/admin/download/file-sm/"+data_id;
    });

    $('#data_file_disposisi').click(function () {
        var data_id = $(this).attr('data-id');
        window.location="http://localhost:8080/admin/download/file-dsp/"+data_id;
    });

    $('#input-cari').change(function () {
        var value = $(this).val();
        $.ajax({
            url : "/admin/cari-sm?s="+value,
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            type: "GET",
            data: null,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function(data)
            {
                $("#list-data-table").empty();
                let no = 1;
                $.each(data.result, function(index, value) {
                    var html = "<tr class='table-row-data' data-id='"+value.id_surat+"'><td>"+no+"</td><td>"+value.no_msk_surat+"</td><td>"+value.perihal+"</td><td>"+value.tgl_surat+"</td>"
                    if("disposisi" in value){
                        html = html + "<td><button type='button' class='btn btn-primary data-input-btn'>Lihat</button></td>"
                    } else {
                        html = html + "<td><button type='button' class='btn btn-disposisi btn-primary data-input-file'  data-id="+value.id_surat+">+</button></td>"
                    }
                    html = html + "<td><button type='button' class='btn btn-edit btn-warning data-edit-btn' data-id='"+value.id_surat+"'><img class='data-edit-btn-img' src='/assets/image/icon-edit.png' /></button><button type='button' class='btn btn-danger data-delete-btn'>X</button></td></tr>"
                    $("#list-data-table").append(
                        html
                    );
                    no++;
                });
            },
            error: function (e)
            {
                console.log(e.responseJSON)
            }
        });
    });
</script>

<script>
        $(document).ready(function(){
            $("#form-surat").submit(function (e) {
                e.preventDefault();    
                var formData = new FormData(this);
                $.ajax({
                    url : "/admin/surat-masuk",
                    headers: {'X-Requested-With': 'XMLHttpRequest'},
                    type: "POST",
                    data: formData,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    success: function(data)
                    {
                        $('#exampleModal').modal('hide');
                        location.reload();
                    },
                    error: function (e)
                    {
                        $('#error_surat_masuk').html(e.responseJSON.message);
                        console.log(e.responseJSON)
                    }
                });
            });

            $("#form-surat-edit").submit(function (e) {
                e.preventDefault();    
                var formData = new FormData(this);
                $.ajax({
                    url : "/admin/surat-masuk/"+$("#form-surat-edit input[name=id_surat]").val()+"/edit",
                    headers: {'X-Requested-With': 'XMLHttpRequest'},
                    type: "POST",
                    data: formData,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    success: function(data)
                    {
                        $('#exampleModal2').modal('hide');
                        location.reload();
                    },
                    error: function (e)
                    {
                        $('#error_edit_surat_masuk').html(e.responseJSON.message);
                        console.log(e.responseJSON)
                    }
                });
            });

            $("#form-disposisi").submit(function (e) {
                e.preventDefault();    
                var formData = new FormData(this);
                $.ajax({
                    url : "/admin/disposisi",
                    headers: {'X-Requested-With': 'XMLHttpRequest'},
                    type: "POST",
                    data: formData,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    success: function(data)
                    {
                        $('#exampleModal1').modal('hide');
                        location.reload();
                    },
                    error: function (e)
                    {
                        $('#error_disposisi').html(e.responseJSON.message);
                        console.log(e.responseJSON)
                    }
                });
            });
        });
</script>