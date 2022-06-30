<div class="content">
    <div class="container">
        <div class="list-data-header">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control data-search-btn" id="input-cari" placeholder="&#xF002;  Cari">
                </div>
                <div class="col-md-6 data-input-btn-section">
                    
                </div>
            </div>
        </div>
        <div class="list-data-table-sk">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">No Surat</th>
                        <th scope="col">Perihal</th>
                        <th scope="col">Tanggal Dibuat</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">File</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="list-data-table">
                    <?php
                    $no = 1; 
                    foreach ($data as $d):?>
                        <tr class="table-row-data" data-id="<?=$d["id_surat"]?>">
                            <td><?= $no ?></td>
                            <td><?= $d["no_surat"] ?></td>
                            <td><?= $d["perihal"] ?></td>
                            <td><?= $d["tgl_surat"] ?></td>
                            <td><?= $d["kategori"] ?></td>
                            <?php 
                            if (array_key_exists('file_surat',$d)) {
                                if ($d["file_surat"] != "") { ?>
                                    <td><p>Terupload</p></td>
                                <?php } else {?>
                                    <td>
                                        <label for="file-upload-<?= $no ?>" class="custom-file-upload file_surat">
                                            <a type="button" class="btn btn-disposisi btn-primary file_surat data-input-file">+</a>
                                        </label>
                                        <input id="file-upload-<?= $no ?>" class="file_surat" type="file" style="display: none;" name="file_surat" data-id="<?=$d["id_surat"]?>"/>
                                    </td>
                                <?php } ?>
                            <?php } else { ?>
                                    <td>
                                        <label for="file_surat" class="custom-file-upload file_surat">
                                            <a type="button" class="btn btn-disposisi btn-primary file_surat data-input-file">+</a>
                                        </label>
                                        <input id="file_surat" class="file_surat" type="file" style="display: none;" name="file_surat" data-id="<?=$d["id_surat"]?>"/>
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

        <!-- Modal Delete -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

        <!-- Modal Edit -->
        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content input-content">
                    <div class="modal-header pop-up-header" style="border-bottom: 0px;">
                        <h4 class="modal-title" id="exampleModalLabel">Ubah Surat Keluar</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form id="form-edit-sk" action="/admin/surat-keluar/edit" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="id_surat" value="">
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">Kategori</label>
                                        <select id="select-kategori" class="form-select input-box" aria-label="Default select example" name="kategori" required oninvalid="this.setCustomValidity('Kategori tidak boleh kosong')"
  oninput="this.setCustomValidity('')">
                                            <option selected disabled value=''>Pilih Kategori</option>
                                            <?php foreach ($kategori as $k): ?>
                                                <option value="<?= $k["id_kategori"] ?>"><?= $k["kategori"] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">Sub Kategori</label>
                                        <select id="select-sub-kategori" class="form-select input-box" aria-label="Default select example" name="sub_kategori" required>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Keterangan(Optional)</label>
                                <textarea class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="keterangan" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer pop-up-footer" style="border-top: 0px;">
                            <button type="submit" class="btn btn-success input-btn-save">Simpan</button>
                            <button type="button" class="btn btn-danger input-btn-cancel">Batalkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Detail Surat -->
        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <h6 style="font-weight:600">Kategori</h6>
                            <p id="data_kategori"></p>
                        </div>
                        <div class="mb-2">
                            <h6 style="font-weight:600">Sub Kategori</h6>
                            <p id="data_sub_kategori"></p>
                        </div>
                        <div class="mb-2">
                            <h6 style="font-weight:600">Perihal</h6>
                            <p id="data_perihal"></p>
                        </div>
                        <div class="mb-2">
                            <h6 style="font-weight:600">Tujuan Surat</h6>
                            <p id="data_tujuan"></p>
                        </div>
                        <div class="mb-2">
                            <h6 style="font-weight:600">Admin yang Membuat</h6>
                            <p id="data_admin"></p>
                        </div>
                        <div id="data_file" class="mb-2">
                            <h6 style="font-weight:600">File Surat</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.data-edit-btn').click(function () {
        var data_id = $(this).attr('data-id');
        $.ajax({
            url : "/admin/surat-keluar/"+data_id+"/detail",
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            type: "GET",
            data: null,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function(data)
            {
                $("#form-edit-sk input[name=perihal]").val(data.result.perihal);
                $("#form-edit-sk input[name=tujuan]").val(data.result.tujuan_surat);
                $("#form-edit-sk textarea[name=keterangan]").val(data.result.keterangan);
                $("#form-edit-sk input[name=id_surat]").val(data_id);
                $('#exampleModal1').modal('toggle');
                $('#exampleModal1').modal('show')
            },
            error: function (e)
            {
                console.log(e.responseJSON)
            }
        });
    });

    $('.data-delete-btn').click(function () {
        var data_id = $(this).attr('data-id');
        $("#btn-delete").attr('href', '/admin/surat-keluar/delete/'+data_id);
        $('#exampleModal2').modal('toggle');
        $('#exampleModal2').modal('show')
    });

    $('.table-row-data').click(function () {
        if ($(event.target).closest('.file_surat').length || $(event.target).closest('.data-delete-btn').length || $(event.target).closest('.btn-edit').length) {
            return
        }   
        var data_id = $(this).attr('data-id');
        $.ajax({
            url : "/admin/surat-keluar/"+data_id+"/detail",
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
                $('#data_kategori').text(data.result.kategori)
                $('#data_sub_kategori').text(data.result.sub_kategori)
                $('#data_perihal').text(data.result.perihal)
                $('#data_tujuan').text(data.result.tujuan_surat)
                $('#data_admin').text(data.result.nama)
                if(data.result.file_surat != null && data.result.file_surat != ''){
                    $('#data_file').append('<button id="data_file_surat" class="btn btn-primary btn-sm data-input-file" style="font-size:14px" data-id='+data.result.id_surat+'>Download</button>')
                } else {
                    $('#data_file').append('<p>File surat belum diupload</p>')
                }

                $('#exampleModal3').modal('toggle');
                $('#exampleModal3').modal('show')
            },
            error: function (e)
            {
                console.log(e.responseJSON)
            }
        });
    });

    $( "#select-kategori" ).change(function() {
        var id_kategori = this.value;
        $.ajax({
            url : "/admin/surat-keluar/sub-kategori/"+id_kategori,
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            type: "GET",
            data: null,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function(data)
            {
                $("#select-sub-kategori").empty();
                $.each(data.result, function(index, value) {
                    $("#select-sub-kategori").append("<option value="+value.id_sub_kategori+">"+value.sub_kategori+"</option>");
                });
            },
            error: function (e)
            {
                console.log(e.responseJSON)
            }
        });
    });

    $('#input-cari').change(function () {
        var value = $(this).val();
        $.ajax({
            url : "/admin/cari-sk?s="+value,
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
                    var html = "<tr class='table-row-data' data-id='"+value.id_surat+"'><td>"+no+"</td><td>"+value.no_surat+"</td><td>"+value.perihal+"</td><td>"+value.tgl_surat+"</td><td>"+value.kategori+"</td>"
                    if("file_surat" in value){
                        html = html + "<td>Terupload</td>"
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