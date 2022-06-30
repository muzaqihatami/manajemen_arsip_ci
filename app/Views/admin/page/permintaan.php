<div class="content">
    <div class="container">
        <div class="list-data-header">
            <div class="row">
                <div class="col-md-12">
                    <input type="text" class="form-control data-search-btn" id="exampleFormControlInput1" placeholder="&#xF002;  Cari">
                </div>
            </div>
        </div>
        <div class="list-data-table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Id Permintaan</th>
                        <th scope="col">Pemohon</th>
                        <th scope="col">Tujuan Surat</th>
                        <th scope="col">Perihal</th>
                        <th scope="col">Catatan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach ($data as $d): ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $d["id_permintaan"] ?></td>
                            <td><?= $d["pemohon"] ?></td>
                            <td><?= $d["tujuan_surat"] ?></td>
                            <td><?= $d["perihal"] ?></td>
                            <td><?= $d["catatan"] ?></td>
                            <td>
                                <button type="button" id="btn-add" class="btn btn-primary data-input-file btn-buat-surat-keluar" data-id="<?=$d["id_permintaan"]?>">
                                    +
                                </button>
                                <button type="button" class="btn btn-danger data-delete-btn" data-id="<?=$d["id_permintaan"]?>">X</button>
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
                        <h4 class="modal-title" id="exampleModalLabel">Buat Surat Keluar</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form id="form-buat-surat-keluar" action="/admin/surat-keluar" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="id_permintaan" value="">
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
                                        <select id="select-kategori" class="form-select input-box" aria-label="Default select example" name="kategori" required oninvalid="this.setCustomValidity('Kategori harus dipilih')"
  oninput="this.setCustomValidity('')">
                                            <option selected disabled value=''>Pilih Kategori</option>
                                            <?php foreach ($kategori as $k): ?>
                                                <option value="<?= $k["id_kategori"] ?>"><?= $k["kategori"] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">Sub Kategori</label>
                                        <select id="select-sub-kategori" class="form-select input-box" aria-label="Default select example" name="sub_kategori" required oninvalid="this.setCustomValidity('Sub Kategori harus dipilih')"
  oninput="this.setCustomValidity('')">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Keterangan (Optional)</label>
                                <textarea class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="keterangan" rows="3"></textarea>
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
                            <p class="mt-3" style="color:#B3B3B3">Apakah kamu yakin ingin menghapus Permintaan ini? Proses ini tidak dapat dibatalkan</p>
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
    $('.btn-buat-surat-keluar').click(function () {
        var data_id = $(this).attr('data-id');
        $.ajax({
            url : "/admin/surat-keluar/init/"+data_id,
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            type: "GET",
            data: null,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function(data)
            {
                $("#form-buat-surat-keluar input[name=tujuan]").val(data.result.tujuan_surat);
                $("#form-buat-surat-keluar input[name=perihal]").val(data.result.perihal);
                $("#form-buat-surat-keluar input[name=id_permintaan]").val(data.result.id_permintaan);
                $('#exampleModal').modal('toggle');
                $('#exampleModal').modal('show')
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

    $('.data-delete-btn').click(function () {
        var data_id = $(this).attr('data-id');
        $("#btn-delete").attr('href', '/admin/permintaan/'+data_id+'/delete');
        $('#exampleModal2').modal('toggle');
        $('#exampleModal2').modal('show')
    });
</script>