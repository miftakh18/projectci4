<?= $this->extend('layout/main') ?>
<?= $this->section('content'); ?>
<style>
    .modal-lg {
        max-width: 90%;
    }
</style>
<h1>List Barang</h1>
<div class="row">
    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <button type="button" class="btn btn-primary btn-icon-split" id="tambahLb" data-toggle="modal" data-target="#modLb">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus-circle"></i>
                        </span>
                        <span class="text text-bold"> Tambah</span>
                    </button>


                </h6>
            </div>
            <div class="card-body table-responsive">
                <form>

                </form>
                <table class="table table-striped " width="100%" id="smenus">
                    <thead>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Dari</th>
                        <th>Untuk</th>
                        <th>Aksi</th>
                    <tbody>
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="modar">
    <?= view_cell('ModalListBarang::Modaladd'); ?>
</div>
<?php    ?>
<?= view_cell('PanggilPluginAll::pluginJS'); ?>
<script>
    $(document).ready(function() {
        // $(".dataTabs").dataTable({
        //     "ordering": false,
        //     "lengthMenu": [
        //         [5, 10, 25, 50, -1],
        //         [5, 10, 25, 50, "All"]
        //     ],
        //     "pageLength": '5'
        // });

        modalss();

    })

    function modalss() {
        string = <?= json_encode(view_cell('ModalListBarang::getAIid')) ?>;
        // alert(string);
    }

    function detailF(id) {
        $.ajax({
            url: '<?= base_url(); ?>list_barang/' + id,
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                $("#detailLb").html('<tr><td colspan="4"><center>Loading .....</center></td></tr>');
            },
            success: function(res) {
                $("#detailLb").html(res.html);
            }
        })
    }

    $(document).on("click", "#tambahLb", function() {
        // modalss();

        id = $('#idEdit').val();
        detailF(id);

    })

    $(document).on('click', '#lbDetail', function() {
        $.ajax({
            url: '<?= base_url(); ?>list_barang',
            type: 'POST',
            data: {
                mbid: $("#idEditD").val(),
                nama_barang: $('#nmdetail').val(),
                jumlah: $("#jmdetail").val()
            },
            beforeSend: function() {
                $("#detailLb").html('<tr><td colspan="4"><center>Loading .....</center></td></tr>');
            },
            dataType: 'json',
            success: function(res) {
                if (res.icon == 'success') {
                    detailF(id);

                } else {
                    alert('gagal');
                }

            }
        })

        // console.log('tess');
    })
    $(document).on("click", "#deditlb", function() {
        id = $(this).data('edit');
        $.ajax({
            url: '<?= base_url(); ?>list_barang/' + id + '/edit',
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                $("#satu" + res.data.dbid).html('<input type="text"   id="edm" nama="edm" class="form-control" value="' + res.data.nama_barang + '">');
                $("#dua" + res.data.dbid).html('<input type="text" id="edjm" nama="edjm"  class="form-control" onkeypress=" return event.charCode >= 48 && event.charCode <= 57" value="' + res.data.jumlah + '">');
                $("#tiga" + res.data.dbid).html('<center><button type="button" id="dupd" class="btn btn-info btn-sm" data-idm="' + res.data.mbid + '" data-update="' + res.data.dbid + '"><i class="fas fa-pen-square"></i></button><button type="button" class="btn btn-light text-danger btn-sm" onclick=" detailF(' + res.data.mbid + ')"><i class="fas fa-times"></i></button></center>');
            }
        })
    });
    $(document).on("click", "#dupd", function() {
        id = $(this).data('update');
        mid = $(this).data('idm');
        $.ajax({
            url: '<?= base_url(); ?>list_barang/' + id,
            type: 'PUT',
            data: {
                nama_barang: $("#edm").val(),
                jumlah: $("#edjm").val()
            },
            dataType: 'json',
            success: function(res) {
                detailF(mid);
            }

        })

    })

    $(document).on("click", "#dhapuslb", function() {
        id = $(this).data('hapus');
        mid = $(this).data('idmid');
        $.ajax({
            url: '<?= base_url(); ?>list_barang/' + id,
            type: 'DELETE',
            dataType: 'json',
            success: function(res) {
                detailF(mid);
            }
        })
    });
</script>
<?= $this->endSection(); ?>