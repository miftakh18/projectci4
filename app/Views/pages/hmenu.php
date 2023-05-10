<?= $this->extend('layout/main') ?>
<?= $this->section('content'); ?>
<h1>Header Menu</h1>
<div class="row">
    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">

                    <button type="button" class="btn btn-primary btn-icon-split" id="tambahmn" data-toggle="modal" data-target="#addhmenus">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus-circle"></i>
                        </span>
                        <span class="text text-bold"> Tambah</span>
                    </button>


                </h6>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped " width="100%" id="hmenus">
                    <thead>
                        <th>No.</th>
                        <th>Nama</th>
                        <th width="50%">Deskripsi</th>
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
<?= view_cell('CellModal::TarikModal', ["idhtml" => "addhmenus", "idform" => "addHeader", "nama_modal" => "hmenu", "tipeKiriman" => "add"]); ?>
<!-- tutup tambah Modal -->

<!-- edit Modal -->
<?= view_cell('CellModal::TarikModal', ["idhtml" => "edithmenus", "idform" => "editHeader", "nama_modal" => "hmenu", "tipeKiriman" => "edit"]); ?>
<!-- tutup edit Modal -->
<!-- celling plugin JS -->
<?= view_cell('PanggilPluginAll::pluginJS'); ?>

<script>
    $(document).ready(function() {
        isi = {
            'ajax': {
                url: '<?= base_url(); ?>hmenu/show',
                dataSrc: 'data'
            },
            columns: [{
                    data: 'nomor'
                }, {
                    data: 'nama_head'
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
                        btn = '<button type="button" id="edithmn" data-target="#edithmenus" data-toggle="modal" class="btn btn-sm shadow btn-primary mx-2" title="edit" data-idhmn="' + data.hid + '" ><i class="far fa-edit" ></i></button>';

                        return btn;
                    }
                }
            ]
        }
        table = $("#hmenus").DataTable(isi);

    })

    $("#addHeader").submit(function(e) {
        e.preventDefault();
        var form = $(this).serialize();
        $.ajax({
            url: '<?= base_url(); ?>hmenu/create',
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

                    table.ajax.reload();

                    $("#addhmenus").modal('hide');
                    $("#addHeader")[0].reset();

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
        $("#addHeader")[0].reset();
        id = $(this).data('idhmn');
        $("#id_editHeader").val(id);
        $.ajax({
            url: '<?= base_url(); ?>hmenu/edit/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                // alert(res.data.nama_head);
                // $("#nmheader").val(res.data.nama_head);
                $("input#nmheader").val(res.data.nama_head);
                $("textarea#deskheader").val(res.data.deskripsi);
                $("input#urutanheader[type=number]").val(res.data.urutan);
                $("input[type='radio'][name='aktif'][value=" + res.data.active + "]")[0].checked = true;
            }
        })
    })
    $(document).on("click", "#tambahmn", function() {
        $("#addHeader")[0].reset();

    })


    $("#editHeader").submit(function(e) {
        e.preventDefault();
        var form = $(this).serialize();
        $("#id_editHeader").val(id);

        $.ajax({
            url: '<?= base_url(); ?>hmenu/update/' + id,
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

                    table.ajax.reload();

                    $("#edithmenus").modal('hide');
                    $("#editHeader")[0].reset();

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