<div class="content">
    <div class="container">
        <div class="list-data-header">
            <div class="row">
                <div class="col-md-6">
                    
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
                        <th scope="col">Kategori</th>
                        <th scope="col">Sub Kategori</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach ($data as $d): ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $d["kategori"] ?></td>
                            <td>
                                <a href="/kategori/<?= $d["kategori"] ?>" class="btn btn-primary data-input-file">Kelola</a>
                            </td>
                            <td>
                                <button type="button" id="btn-edit" class="btn btn-warning data-edit-btn" data-id="<?=$d["id_kategori"]?>">
                                    <img class="data-edit-btn-img" src="/assets/image/icon-edit.png" />
                                </button>
                                <button type="button" class="btn btn-danger data-delete-btn" data-id="<?=$d["id_kategori"]?>">X</button>
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
                    <form id="form-kategori" action="/admin/kategori" method="POST">
                        <div class="modal-header pop-up-header" style="border-bottom: 0px;">
                            <h4 class="modal-title" id="exampleModalLabel">Input Kategori Surat</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="kategori" required oninvalid="this.setCustomValidity('Kategori tidak boleh kosong')"
  oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Inisial Kategori (3 huruf)</label>
                                <input type="text" class="form-control input-box" id="exampleFormControlInput1" placeholder="contoh: KGW" name="inisial" minlength="3" maxlength="3" required oninvalid="this.setCustomValidity('Inisial tidak boleh kosong')"
  oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Format No. Surat</label>
                                <input type="text" class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="format_no" required oninvalid="this.setCustomValidity('Format No Surat tidak boleh kosong')"
  oninput="this.setCustomValidity('')">
                            </div>
                        </div>
                        <p id="error_kategori" style="color:red;"></p>
                        <div class="modal-footer pop-up-footer" style="border-top: 0px;">
                            <button type="submit" class="btn btn-success input-btn-save">Simpan</button>
                            <button type="button" class="btn btn-danger input-btn-cancel" data-bs-dismiss="modal">Batalkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content input-content">
                    <form id="form-edit-kategori" action="javascript:void(0)" method="PUT">
                        <div class="modal-header pop-up-header" style="border-bottom: 0px;">
                            <h4 class="modal-title" id="exampleModalLabel">Ubah Kategori Surat</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_kategori">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="kategori">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Inisial (3 huruf)</label>
                                <input type="text" class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="inisial">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Format No. Surat</label>
                                <input type="text" class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="format_no">
                            </div>
                        </div>
                        <div class="modal-footer pop-up-footer" style="border-top: 0px;">
                            <button type="submit" class="btn btn-success input-btn-save">Simpan</button>
                            <button type="button" class="btn btn-danger input-btn-cancel" data-bs-dismiss="modal">Batalkan</button>
                        </div>
                    </form>
                </div>
            </div>
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
    </div>
</div>


<script>
    $('.data-edit-btn').click(function () {
        var data_id = $(this).attr('data-id');
        $.ajax({
            url : "/admin/kategori/"+data_id,
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            type: "GET",
            data: null,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function(data)
            {
                $("#form-edit-kategori input[name=kategori]").val(data.result.kategori);
                $("#form-edit-kategori input[name=inisial]").val(data.result.inisial);
                $("#form-edit-kategori input[name=format_no]").val(data.result.format_no);
                $("#form-edit-kategori input[name=id_kategori]").val(data_id);
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
        $("#btn-delete").attr('href', '/admin/kategori/'+data_id+'/delete');
        $('#exampleModal2').modal('toggle');
        $('#exampleModal2').modal('show')
    });

    $("#form-edit-kategori").submit(function (e) {
        e.preventDefault();    
        var formData = new FormData(this);
        $.ajax({
            url : "/admin/kategori/"+$("#form-edit-kategori input[name=id_kategori]").val()+"/update",
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
                console.log(e.responseJSON)
            }
        });
    });
</script>