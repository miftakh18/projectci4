<?= $this->extend('layout/main') ?>
<?= $this->section('content'); ?>
<h1> Sub Menu</h1>
<div class="row">
    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">

                    <button type="button" class="btn btn-primary btn-icon-split" id="tambahmn" data-toggle="modal" data-target="#addsmenu">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus-circle"></i>
                        </span>
                        <span class="text text-bold"> Tambah</span>
                    </button>


                </h6>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped " width="100%" id="smenus">
                    <thead>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Header</th>
                        <th>Menu</th>
                        <th>Link</th>
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
<?= view_cell('CellModal::TarikModal', ["idhtml" => "addsmenu", "idform" => "addSMenu", "nama_modal" => "smenu", "tipeKiriman" => "add"]); ?>
<!-- tutup tambah Modal -->

<!-- edit Modal -->
<?= view_cell('CellModal::TarikModal', ["idhtml" => "editsmenu", "idform" => "editSMenu", "nama_modal" => "smenu", "tipeKiriman" => "edit"]); ?>
<!-- tutup edit Modal -->
<!-- celling plugin JS -->
<?= view_cell('PanggilPluginAll::pluginJS'); ?>

<script>
    $(document).ready(function() {
        isi = {
            'ajax': {
                url: '<?= base_url(); ?>smenu/show',
                dataSrc: 'data'
            },
            columns: [{
                    data: 'nomor'
                }, {
                    data: 'nama_submenu'
                },
                {
                    data: 'header'
                }, {
                    data: 'menu'
                },
                {
                    data: 'href'
                },
                {
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
                        btn = '<button type="button" id="editsmn" data-target="#editsmenu" data-toggle="modal" class="btn btn-sm shadow btn-primary mx-2" title="edit" data-idsmn="' + data.smid + '" data-idhid="' + data.hid + '" ><i class="far fa-edit" ></i></button>';

                        return btn;
                    }
                }
            ]
        }
        table = $("#smenus").DataTable(isi);

    })

    $("#addSMenu").submit(function(e) {
        e.preventDefault();
        var form = $(this).serialize();
        $.ajax({
            url: '<?= base_url(); ?>smenu/create',
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

                    $("#addsmenu").modal('hide');
                    $("#addSMenu")[0].reset();

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
    $(document).on('change', '.addSMenu', function() {
        vals = $(this).val();
        $.ajax({
            url: '<?= base_url(); ?>smenu/menus/' + vals,
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                $('.loadaddSMenu').html('Loading.....');
            },
            success: function(res) {
                $('.loadaddSMenu').html('');

                $('.midaddSMenu').html(res.html);
            }
        })
    })
    $(document).on('change', '.editSMenu', function() {
        vals = $(this).val();
        $.ajax({
            url: '<?= base_url(); ?>smenu/menus/' + vals,
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                $('.loadeditSMenu').html('Loading.....');
            },
            success: function(res) {
                $('.loadeditSMenu').html('');

                $('.mideditSMenu').html(res.html);
            }
        })
    })

    $(document).on("click", "#editsmn", function() {
        $("#addSMenu")[0].reset();
        id = $(this).data('idsmn');
        idh = $(this).data('idhid');
        $("#id_ed").val(id);
        $(".editSMenu").val(idh).trigger('change');
        $.ajax({
            url: '<?= base_url(); ?>smenu/edit/' + id,
            type: 'GET',
            dataType: 'json',

            success: function(res) {
                $(".mideditSMenu").val(res.data.mid);
                $("input#nama_submenu").val(res.data.nama_submenu);
                $("input#href").val(res.data.href);
                $("input#icon").val(res.data.icon);
                $("textarea#deskripsi").val(res.data.deskripsi);
                $("input#urutan[type='number']").val(res.data.urutan);
                $("input[type='radio'][name='active'][value=" + res.data.active + "]")[0].checked = true;
            }
        })
    })
    $(document).on("click", "#tambahmn", function() {
        $("#addSMenu")[0].reset();

    })


    $("#editSMenu").submit(function(e) {
        e.preventDefault();
        var form = $(this).serialize();
        $("#id_ed").val(id);

        $.ajax({
            url: '<?= base_url(); ?>smenu/update/' + id,
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

                    window.location.reload();


                    $("#editsmenu").modal('hide');
                    $("#editSMenu")[0].reset();

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