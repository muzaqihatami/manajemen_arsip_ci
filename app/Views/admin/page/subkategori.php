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
                        <th scope="col">Sub Kategori</th>
                        <th scope="col">Format File</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1; 
                    foreach ($data as $d): ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $d["sub_kategori"] ?></td>
                            <?php if (array_key_exists('format_file',$d)) {
                                if ($d["format_file"] != "") { ?>
                                <td>Terupload</td>
                                <?php } else {?>
                                <td>
                                    <button type="button" class="btn btn-disposisi btn-primary data-input-file" data-id="<?=$d["id_sub_kategori"]?>">+</button>
                                </td>
                            <?php } ?>
                            <?php } else { ?>
                                <td>
                                    <button type="button" class="btn btn-disposisi btn-primary data-input-file" data-id="<?=$d["id_sub_kategori"]?>">+</button>
                                </td>
                            <?php } ?>
                            <td>
                                <button type="button" class="btn btn-edit btn-warning data-edit-btn" data-id="<?=$d["id_sub_kategori"]?>">
                                    <img class="data-edit-btn-img" src="/assets/image/icon-edit.png" />
                                </button>
                                <button type="button" class="btn btn-danger data-delete-btn" data-id="<?=$d["id_sub_kategori"]?>">X</button>
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
                        <h4 class="modal-title" id="exampleModalLabel">Input Sub Kategori Surat</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form id="form-sub-kategori" action="javascript:void(0)" method="POST">
                        <input type="hidden" class="form-control" id="exampleFormControlInput1" name="kategori" 
                            value="<?php 
                            $uri_segments = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                            echo $uri_segments[2] ?>">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama Sub Kategori</label>
                                <input type="text" class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="sub_kategori" required oninvalid="this.setCustomValidity('Sub Kategori tidak boleh kosong')"
  oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Format File</label><br/>
                                <label for="formFile" class="form-label">
                                    <a class="btn btn-primary btn-sm input-upload-btn" rel="nofollow">+ Upload</a>
                                </label>
                                <input class="form-control input-file" type="file" id="formFile" style="display:none" name="file">
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

        <!-- Modal Edit -->
        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content input-content">
                    <div class="modal-header pop-up-header" style="border-bottom: 0px;">
                        <h4 class="modal-title" id="exampleModalLabel">Ubah Sub Kategori Surat</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form id="form-sub-kategori-edit" action="javascript:void(0)" method="POST">
                        <input type="hidden" name="id_sub_kategori" value>
                        <input type="hidden" class="form-control" id="exampleFormControlInput1" name="kategori" 
                            value="<?php 
                            $uri_segments = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                            echo $uri_segments[2] ?>">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama Sub Kategori</label>
                                <input type="text" class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="sub_kategori" required oninvalid="this.setCustomValidity('Sub Kategori tidak boleh kosong')"
  oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Format File</label><br/>
                                <label for="formFile" class="form-label">
                                    <a class="btn btn-primary btn-sm input-upload-btn" rel="nofollow">+ Upload</a>
                                </label>
                                <input class="form-control input-file" type="file" id="formFile" style="display:none" name="file">
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
    $('.btn-edit').click(function () {
        var data_id = $(this).attr('data-id');
        $("#form-sub-kategori-edit input[name=id_sub_kategori]").val(data_id);
        $.ajax({
            url : "/admin/sub-kategori/"+data_id+"/detail",
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            type: "GET",
            data: null,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function(data)
            {
                $("#form-sub-kategori-edit input[name=sub_kategori]").val(data.result.sub_kategori);
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
        $("#btn-delete").attr('href', '/admin/sub-kategori/'+data_id+'/delete');
        $('#exampleModal2').modal('toggle');
        $('#exampleModal2').modal('show')
    });
</script>

<script>
        $(document).ready(function(){
            $("#form-sub-kategori").submit(function (e) {
                e.preventDefault();    
                var formData = new FormData(this);
                $.ajax({
                    url : "/admin/sub-kategori",
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
        });
</script>