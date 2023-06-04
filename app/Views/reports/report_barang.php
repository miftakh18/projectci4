    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        <?= view_cell('PanggilPluginAll::pluginCss'); ?>

        <style>
            * {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 14pt;
            }

            table {
                width: 100%;
            }

            table tr td {
                padding-left: 5px;
                padding-right: 5px;
            }

            table tr th {
                padding-left: 5px;
                padding-right: 5px;
            }
        </style>
    </head>

    <body>




        <hr>
        <center>
            <h2><?= $title; ?></h2>
        </center>
        <table border="0">
            <tr>
                <td width="15%">Hari</td>
                <td width="2%">:</td>
                <td><?= $utama['hari']; ?></td>
                <td width="15%">Tanggal</td>
                <td width="2%">:</td>
                <td><?= date('d-m-Y', strtotime($utama['tanggal'])) ?></td>
            </tr>
            <tr>
                <td width="15%">Jam</td>
                <td width="2%">:</td>
                <td><?= $utama['jam'] . ':' . $utama['menit'] . '  WIB'; ?></td>
                <td width="15%">No</td>
                <td width="2%">:</td>
                <td>-</td>
            </tr>
            <tr>
                <td width="15%">Dari</td>
                <td width="2%">:</td>
                <td colspan="4"><?= $utama['dari']; ?></td>
            </tr>
            <tr>
                <td width="15%">Untuk</td>
                <td width="2%">:</td>
                <td colspan="4"><?= $utama['untuk']; ?></td>
            </tr>
        </table>
        <br>

        <table border="1" cellpadding="0" cellspacing="0">
            <tr>
                <th width="2%">No.</th>
                <th>Nama Barang</th>
                <th width="2%">Jumlah</th>
            </tr>
            <?php foreach ($detail as $key => $row) : ?>
                <tr>
                    <td> <?= $key + 1 ?></td>
                    <td> <?= $row['nama_barang'] ?></td>
                    <td> <?= $row['jumlah'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <br><br><br>
        <table>
            <tr>
                <td>
                    <?php if (!empty($utama['pemberi'])) : ?>
                        <center>
                            <img src="<?= $gambar_apr ?>" alt="" width="200px">
                        </center>
                    <?php endif ?>
                </td>
                <td>
                    <?php if (!empty($utama['penerima'])) : ?>
                        <center>
                            <img src="<?= $gambar_apr ?>" alt="" width="200px">
                        </center>
                    <?php endif ?>
                </td>
                <td>
                    <?php if (!empty($utama['penyedia'])) : ?>
                        <center>
                            <img src="<?= $gambar_apr ?>" alt="" width="200px">
                        </center>
                    <?php endif ?>
                </td>
            </tr>
            <tr>
                <td width="33.4%">
                    <center>(<?= $utama['pemberi']; ?>)</center>
                    <hr> No.Hp :<?= $utama['no_pemberi']; ?>
                </td>
                <td width="33.4%">
                    <center>(<?= $utama['penerima']; ?>)</center>
                    <hr> No.Hp :<?= $utama['no_penerima']; ?>
                </td>
                <td width="33.4%">
                    <center>
                        (<?= $utama['penyedia']; ?>)</center>
                    <hr> No.Hp :<?= $utama['no_penyedia']; ?>
                </td>
            </tr>
        </table>
    </body>

    </html>