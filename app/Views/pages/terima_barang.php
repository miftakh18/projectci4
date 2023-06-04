<?= $this->extend('layout/main') ?>
<?= $this->section('content'); ?>
<style>
    .modal-lg {
        max-width: 90%;
    }
</style>
<h1>Terima Barang</h1>
<div class="row">
    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                </h6>
            </div>
            <div class="card-body table-responsive">
                <form>

                </form>
                <table class="table table-striped " width="100%" id="l_bar">
                    <thead>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Dari</th>
                        <th>Untuk</th>
                        <th>Penyedia</th>
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
<?= view_cell('ModalListBarang::viewModal'); ?>

<?= view_cell('PanggilPluginAll::pluginJS'); ?>


<script>
    kondisi_columnt = [{
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
                if (data.penerima != null) {
                    btn = (data.penyedia == null || data.penyedia == '') ? '<button type="button" id="apr" class="btn btn-sm  btn-info mx-2"  data-stts="penyedia" style="box-shadow: 5px 5px 5px lightblue" title="Apporve Penerima" data-idlb="' + data.lbid + '" ><i class="fas fa-check-square"></i></button>' : '<span class="badge badge-pill badge-success px-4 py-2"  style="box-shadow: 5px 5px 5px lightblue">Approved</span>';
                } else {
                    btn = '<span class="badge badge-pill badge-warning p-2 " style="box-shadow: 5px 5px 5px lightblue">Pending approve pemberi</span> ';
                }


                return btn;
            }
        },
        {
            'data': null,
            render: function(data, type, row) {
                if (data.pemberi != null && data.penerima != null && data.penyedia != null) {
                    btn = '<a href="<?= base_url() ?>report/' + data.lbid + '/bm" id="" class="btn btn-warning btn-sm text-dark" style="box-shadow: 5px 5px 5px lightblue" target="_blank"><i class="fas fa-print"></i></a>';
                } else {
                    btn = '<button type="button" id="showbtnlb" data-target="#modLb" data-toggle="modal" class="btn btn-sm shadow btn-primary mx-2" title="edit" data-idlb="' + data.lbid + '" ><i class="fas fa-eye"></i></button>';
                }

                return btn;
            }
        }
    ];

    $(document).ready(function() {


        $("#l_bar").dataTable({

            "ajax": {
                url: '<?= base_url(); ?>api/approve',
                type: 'GET',
                dataSrc: 'data'
            },
            columns: kondisi_columnt

        });
    })

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

    $(document).on("click", "#showbtnlb", function() {
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
                $(".hd").remove();
            }
        })
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