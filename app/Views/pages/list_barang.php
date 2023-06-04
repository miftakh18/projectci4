<?= $this->extend('layout/main') ?>
<?= $this->section('content'); ?>
<style>
    .modal-lg {
        max-width: 90%;
    }
</style>
<h1>List Barang Di Terima</h1>
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
                <table class="table  " align="center" width="100%" id="l_bar">
                    <thead>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Dari</th>
                        <th>Untuk</th>
                        <th>Approve Pemberi</th>
                        <th>Approve Penerima</th>
                        <th>Aksi</th>
                    </thead>
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

        $("#l_bar").dataTable({

            "ajax": {
                url: '<?= base_url(); ?>listb/new',
                type: 'GET',
                dataSrc: 'data'
            },
            columns: [{
                    'data': 'nomor'
                },
                {
                    'data': 'tanggal'
                },
                {
                    'data': 'dari'
                },
                {
                    'data': 'untuk'
                }, {
                    'data': null,
                    render: function(data, type, row) {
                        if (data.pemberi == null || data.pemberi == '') {
                            btn = '<button type="button" id="apr" class="btn btn-sm shadow btn-info mx-2" title="Aprrove Pemberi" data-stts="pemberi"  style="box-shadow: 5px 5px 5px lightblue"  data-idlb="' + data.lbid + '" ><i class="fas fa-check-square"></i></button>';
                        } else {
                            btn = '<span class="badge badge-pill badge-success px-4 py-2"  style="box-shadow: 5px 5px 5px lightblue">Approved</span>';
                        }
                        return btn;
                    }
                }, {
                    'data': null,
                    render: function(data, type, row) {
                        if (data.pemberi != null) {
                            btn = (data.penerima == null || data.penerima == '') ? '<button type="button" id="apr" class="btn btn-sm  btn-info mx-2"  data-stts="penerima" style="box-shadow: 5px 5px 5px lightblue" title="Apporve Penerima" data-idlb="' + data.lbid + '" ><i class="fas fa-check-square"></i></button>' : '<span class="badge badge-pill badge-success px-4 py-2"  style="box-shadow: 5px 5px 5px lightblue">Approved</span>';
                        } else {
                            btn = '<span class="badge badge-pill badge-warning p-2 " style="box-shadow: 5px 5px 5px lightblue">Pending approve pemberi</span> ';
                        }


                        return btn;
                    }
                },
                {
                    'data': null,
                    render: function(data, type, row) {
                        if (data.penerima == null || data.penerima == '') {
                            btn = '<button type="button" id="editbtnlb" data-target="#modLb" data-toggle="modal" class="btn btn-sm shadow btn-primary mx-2" title="edit"  style="box-shadow: 5px 5px 5px lightblue" data-idlb="' + data.lbid + '" ><i class="far fa-edit" ></i></button>';
                            btn += '<button type="button" id="hapusbtnlb" class="btn btn-sm shadow btn-danger mx-2"  style="box-shadow: 5px 5px 5px lightblue" title="delete" data-idlb="' + data.lbid + '" ><i class="fas fa-trash" ></i></button>';
                        } else {
                            btn = ''
                        };
                        return btn;
                    }
                }
            ]

        });
        modalss();

    })

    function modalss() {
        string = <?= json_encode(view_cell('ModalListBarang::getAIid')) ?>;
        // alert(string);
        $('#idEdit').val(string);
        $("#idEditD").val(string);
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
        modalss();

        id = $('#idEdit').val();
        detailF(id);

        $("#btnsv").html('Save');
        $("#act").val('input');
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
    $(document).on("click", "#editbtnlb", function() {
        $("#btnsv").html('Update');
        $("#act").val('update');

        id = $(this).data('idlb');
        $('#idEdit').val(id);
        $("#idEditD").val(id);
        detailF(id);
        $.ajax({
            url: '<?= base_url(); ?>listb/' + id + '/edit',
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                $("#harilb").val(res.data.hari);
                $("#tgllb").val(res.data.tanggal);
                $("#jamlb").val(res.data.jam);
                $("#menitlb").val(res.data.menit);
                $("#darilb").val(res.data.dari);
                $("#untuklb").val(res.data.untuk);
            }
        })
    })

    $(document).on("submit", "#frmlb", function(e) {
        e.preventDefault();
        form = $(this).serialize();
        console.log(form);
        actionss = $("#act").val();
        ids = $("#idEdit").val();
        if (actionss == 'update') {
            alamat = '<?= base_url(); ?>listb/' + ids;
            types = 'PUT';

        } else if (actionss == 'input') {
            types = 'POST';
            alamat = '<?= base_url(); ?>listb';
        }
        $.ajax({
            url: alamat,
            type: types,
            data: form,
            dataType: 'json',
            success: function(res) {
                if (res.icon == 'success') {
                    Swal.fire({
                        icon: res.icon,
                        title: res.msg,
                        focusConfirm: true,
                        allowOutsideClick: false,
                    });
                    $("#modLb").modal('hide');
                    window.location.reload();
                    modalss();
                } else {
                    Swal.fire({
                        icon: res.icon,
                        title: res.msg,
                        focusConfirm: true,
                        allowOutsideClick: false,
                    });
                }
            }
        })
    })


    $(document).on("click", "#hapusbtnlb", function() {
        ids = $(this).data('idlb');
        swal.fire({
            title: 'Apakah Anda Ingin Menghapus?',
            icon: 'question',
            showCloseButton: true,
            allowOutsideClick: false

        }).then(function(hapus) {
            if (hapus.isConfirmed) {
                $.ajax({
                    url: '<?= base_url(); ?>listb/' + ids,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(res) {
                        if (res.icon == 'success') {

                            Swal.fire({
                                icon: res.icon,
                                title: res.msg,
                                focusConfirm: true,
                                allowOutsideClick: false,
                            });
                            $("#frmlb")[0].reset();

                        } else {
                            Swal.fire({
                                icon: res.icon,
                                title: res.msg,
                                focusConfirm: true,
                                allowOutsideClick: false,
                            });
                        }
                    }
                }).done(function() {
                    window.location.reload();
                })
            }
        });
        // alert(id);
    })

    $(document).on("click", "#apr", function() {
        ids = $(this).data('idlb');
        status = $(this).data('stts');
        swal.fire({
            title: 'Nama approve ' + status,
            html: `<input type="text" id="nama" class="swal2-input" placeholder="Nama">
  <input type="text" id="nomorhp" class="swal2-input" placeholder="0812" onkeypress="return event.charCode >= 48 && event.charCode <= 57">`,
            focusConfirm: false,
            preConfirm: () => {
                const nama = Swal.getPopup().querySelector('#nama').value
                const nohp = Swal.getPopup().querySelector('#nomorhp').value
                if (!nama) {
                    Swal.showValidationMessage(`Please enter Nama `)
                } else if (!nohp) {
                    Swal.showValidationMessage(`Please enter No Hp `)
                } else if (!nama && !nohp) {
                    Swal.showValidationMessage(`Please enter Data`)

                }
                return {
                    nama: nama,
                    nohp: nohp
                }
            },
            icon: 'question',
            showCloseButton: true,
            allowOutsideClick: false

        }).then(function(appr) {
            if (appr.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>api/' + ids + '/' + appr.value.nama + '/' + appr.value.nohp + '/' + status + '/approve',
                    type: 'POST',
                    dataType: 'json',
                    success: function(res) {
                        if (res.icon == 'success') {

                            Swal.fire({
                                icon: res.icon,
                                title: res.msg,
                                focusConfirm: true,
                                allowOutsideClick: false,
                            });
                        } else {
                            Swal.fire({
                                icon: res.icon,
                                title: res.msg,
                                focusConfirm: true,
                                allowOutsideClick: false,
                            });
                        }
                    }
                }).done(function() {
                    window.location.reload();
                })
            }
        });
    })
</script>
<?= $this->endSection(); ?>