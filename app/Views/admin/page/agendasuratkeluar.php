<div class="content">
    <div class="container">
        <div class="list-data-header">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control data-search-btn" id="input-cari" placeholder="&#xF002;  Cari">
                </div>
                <div class="col-md-6 data-input-btn-section">
                    <div class="dropdown">
                        <button class="btn btn-primary mb-3 data-filter-btn me-2 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Filter
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <form class="agenda-form-filter" id="agenda-form-filter" action="javascript:void(0)" method="POST">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">Dari Tanggal</label>
                                        <input type="date" class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="from_date">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">Sampai Tanggal</label>
                                        <input type="date" class="form-control input-box" id="exampleFormControlInput1" placeholder="" name="to_date">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Kategori</label>
                                    <select id="select-kategori" class="form-select input-box" aria-label="Default select example" name="kategori">
                                        <option selected disabled>Pilih Kategori</option>
                                        <?php foreach ($kategori as $k): ?>
                                            <option value="<?= $k["id_kategori"] ?>"><?= $k["kategori"] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="mb-3" style="text-align:right;">
                                    <button type="submit" class="btn btn-success input-upload-btn">Terapkan</button>
                                </div>
                            </form>
                        </div>
                        <button id="btn-download" type="button" class="btn btn-primary mb-3 data-input-btn">Download</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-data-table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">No Surat</th>
                        <th scope="col">Tanggal Dibuat</th>
                        <th scope="col">Tujuan</th>
                        <th scope="col">Perihal</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                </thead>
                <tbody id="table-data-list">
                    <?php 
                    $no = 1; 
                    foreach ($data as $d):?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $d["no_surat"] ?></td>
                            <td><?= date("d F Y", strtotime($d["tgl_keluar_surat"])) ?></td>
                            <td><?= $d["tujuan_surat"] ?></td>
                            <td><?= $d["perihal"] ?></td>
                            <td><?= $d["keterangan"] ?></td>
                        </tr>
                    <?php 
                    $no++;
                    endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
        $(document).ready(function(){
            $("#agenda-form-filter").submit(function (e) {
                e.preventDefault();    
                var formData = new FormData(this);
                $.ajax({
                    url : "/admin/agenda/surat-keluar/filter",
                    headers: {'X-Requested-With': 'XMLHttpRequest'},
                    type: "POST",
                    data: formData,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    success: function(data)
                    {
                        $("#table-data-list").empty();
                        let no = 1;
                        $.each(data.result, function(index, value) {
                            $("#table-data-list").append(
                                "<tr><td>"+no+"</td><td>"+value.no_surat+"</td><td>"+value.tgl_keluar_surat+"</td><td>"+value.tujuan_surat+"</td><td>"+value.perihal+"</td><td>"+value.keterangan+"</td></tr>"
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

            $("#btn-download").click(function (e) {
                var kategori = document.getElementById("select-kategori").value
                if(kategori == "Pilih Kategori"){
                    kategori = ""
                }
                var from_date = $("#agenda-form-filter input[name=from_date]").val()
                var to_date =  $("#agenda-form-filter input[name=to_date]").val()

                window.location="http://localhost:8080/admin/agenda/surat-keluar/download?kategori="+kategori+"&from_date="+from_date+"&to_date="+to_date
            });

            $('#input-cari').change(function () {
                var value = $(this).val();
                $.ajax({
                    url : "/admin/cari-ask?s="+value,
                    headers: {'X-Requested-With': 'XMLHttpRequest'},
                    type: "GET",
                    data: null,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    success: function(data)
                    {
                        $("#table-data-list").empty();
                        let no = 1;
                        $.each(data.result, function(index, value) {
                            $("#table-data-list").append(
                                "<tr><td>"+no+"</td><td>"+value.no_surat+"</td><td>"+value.tgl_keluar_surat+"</td><td>"+value.tujuan_surat+"</td><td>"+value.perihal+"</td><td>"+value.keterangan+"</td></tr>"
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
        });
</script>