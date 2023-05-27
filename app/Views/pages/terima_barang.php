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
                        <th>Penerima</th>
                        <th>Pemberi</th>
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

                if (data.penerima == null || data.penerima == '') {
                    btn = '<button type="button" id="hapusbtnlb" class="btn btn-sm shadow btn-danger mx-2" title="delete" data-idlb="' + data.lbid + '" ><i class="fas fa-check-square"></i></button>';

                } else {
                    btn = '';

                }

                return btn;
            }
        }, {
            'data': null,
            render: function(data, type, row) {

                if (data.pemberi == null || data.pemberi == '') {
                    btn = '<button type="button" id="hapusbtnlb" class="btn btn-sm shadow btn-danger mx-2" title="delete" data-idlb="' + data.lbid + '" ><i class="fas fa-check-square"></i></button>';

                } else {
                    btn = '';

                }
            }
        }, {
            'data': null,
            render: function(data, type, row) {

                if (data.penyedia == null || data.penyedia == '') {
                    btn = '<button type="button" id="hapusbtnlb" class="btn btn-sm shadow btn-danger mx-2" title="delete" data-idlb="' + data.lbid + '" ><i class="fas fa-check-square"></i></button>';

                } else {
                    btn = '';

                }
            }
        },
        {
            'data': null,
            render: function(data, type, row) {
                btn = '<button type="button" id="showbtnlb" data-target="#modLb" data-toggle="modal" class="btn btn-sm shadow btn-primary mx-2" title="edit" data-idlb="' + data.lbid + '" ><i class="fas fa-eye"></i></button>';

                return btn;
            }
        }
    ];

    $(document).ready(function() {


        $("#l_bar").dataTable({

            "ajax": {
                url: '<?= base_url(); ?>listb/new',
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
                $(".hd").html('');
            }
        })
    })
</script>
<?= $this->endSection(); ?>