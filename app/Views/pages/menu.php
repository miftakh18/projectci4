<?= $this->extend('layout/main') ?>
<?= $this->section('content'); ?>
<h1>Menu</h1>
<div class="row">
    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">

                    <button type="button" class="btn btn-primary btn-icon-split" id="tambahmn" data-toggle="modal" data-target="#addmenu">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus-circle"></i>
                        </span>
                        <span class="text text-bold"> Tambah</span>
                    </button>


                </h6>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped " width="100%" id="menus">
                    <thead>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Header</th>
                        <th>Link</th>
                        <th>Icon</th>
                        <th>Deskripsi</th>
                        <th>Urutan</th>
                        <th>Active</th>

                        <th>Aksi</th>
                    <tbody>
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<!-- tambah Modal -->
<!-- lokasi cek view_cell = app/Cells -->
<?= view_cell('CellModal::TarikModal', ["idhtml" => "addmenu", "idform" => "addMenu", "nama_modal" => "menu", "tipeKiriman" => "add"]); ?>
<!-- tutup tambah Modal -->

<!-- edit Modal -->
<?= view_cell('CellModal::TarikModal', ["idhtml" => "editmenu", "idform" => "editMenu", "nama_modal" => "menu", "tipeKiriman" => "edit"]); ?>
<!-- tutup edit Modal -->
<!-- celling plugin JS -->
<?= view_cell('PanggilPluginAll::pluginJS'); ?>

<script>
    $(document).ready(function() {
        isi = {
            'ajax': {
                url: '<?= base_url(); ?>menu/show',
                dataSrc: 'data'
            },
            columns: [{
                    data: 'nomor'
                }, {
                    data: 'nama_menu'
                },
                {
                    data: 'header'
                },
                {
                    data: 'href'
                },
                {
                    data: 'icon'
                }, {
                    data: 'deskripsi'
                }, {

                    data: 'urutan'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return data.active == 1 ? '<div class="bg-success rounded text-white text-center" style="width:50px">ON</div>' : '<div class="bg-danger rounded text-white text-center" style="width:50px">OFF</div>';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        btn = '<button type="button" id="edithmn" data-target="#editmenu" data-toggle="modal" class="btn btn-sm shadow btn-primary mx-2" title="edit" data-idmn="' + data.mid + '" ><i class="far fa-edit" ></i></button>';

                        return btn;
                    }
                }
            ]
        }
        table = $("#menus").DataTable(isi);

    })

    $("#addMenu").submit(function(e) {
        e.preventDefault();
        var form = $(this).serialize();
        $.ajax({
            url: '<?= base_url(); ?>menu/create',
            type: 'POST',
            data: form,
            dataType: 'json',
            beforeSend: function() {
                swal.fire({
                    title: 'Loading......',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                })
            },
            success: function(res) {
                if (res.icon == 'success') {
                    Swal.fire({
                        icon: res.icon,
                        title: res.msg,
                        focusConfirm: true,
                        allowOutsideClick: false,
                    });

                    window.localtion.reload();

                    $("#addmenu").modal('hide');
                    $("#addMenu")[0].reset();

                } else {
                    Swal.fire({
                        icon: res.icon,
                        title: res.msg,
                        focusConfirm: true,
                    });

                }
            }
        })
    })

    $(document).on("click", "#edithmn", function() {
        $("#addMenu")[0].reset();
        id = $(this).data('idmn');
        $("#id_ed").val(id);
        $.ajax({
            url: '<?= base_url(); ?>menu/edit/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                // alert(res.data.nama_head);
                // $("#nmheader").val(res.data.nama_head);
                $("select#hid").val(res.data.hid);
                $("input#nama_menu").val(res.data.nama_menu);
                $("input#href").val(res.data.href);
                $("input#icon").val(res.data.icon);
                $("textarea#deskripsi").val(res.data.deskripsi);
                $("input#urutan[type='number']").val(res.data.urutan);
                $("input[type='radio'][name='active'][value=" + res.data.active + "]")[0].checked = true;
            }
        })
    })
    $(document).on("click", "#tambahmn", function() {
        $("#addMenu")[0].reset();

    })


    $("#editMenu").submit(function(e) {
        e.preventDefault();
        var form = $(this).serialize();
        $("#id_ed").val(id);

        $.ajax({
            url: '<?= base_url(); ?>menu/update/' + id,
            type: 'POST',
            data: form,
            dataType: 'json',
            beforeSend: function() {
                swal.fire({
                    title: 'Loading......',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                })
            },
            success: function(res) {
                if (res.icon == 'success') {
                    Swal.fire({
                        icon: res.icon,
                        title: res.msg,
                        focusConfirm: true,
                        allowOutsideClick: false,
                    });

                    window.localtion.reload();


                    $("#editmenu").modal('hide');
                    $("#editMenu")[0].reset();

                } else {
                    Swal.fire({
                        icon: res.icon,
                        title: res.msg,
                        focusConfirm: true,
                    });

                }
            }
        })
    })
</script>
<?= $this->endSection(); ?>