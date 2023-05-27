<div class="modal fade" id="modLb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="frmlb">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= (!empty($views)) ? 'View' : 'Formulir' ?> List Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="inputEmail4">Hari</label>
                                <?php $id = (!empty($this->getAIid('inventori', 'list_barang'))) ? $this->getAIid('inventori', 'list_barang') : '';
                                ?>
                                <input type="hidden" id="idEdit">
                                <select name="harilb" id="harilb" class="custom-select" <?php if (!empty($views)) echo 'disabled' ?>>
                                    <option value="">Pilih Hari</option>
                                    <?php
                                    $hari = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
                                    foreach ($hari as $h) : ?>
                                        <option value="<?= $h; ?>"> <?= ucfirst($h); ?></option>
                                    <?php endforeach ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="date" class="form-control" id="tgllb" name="tgllb" <?php if (!empty($views)) echo $views ?>>
                            </div>


                            <div class="form-group">
                                <label for="inputEmail4">Jam</label>
                                <div class="row">
                                    <div class="col-4"><select name="jamlb" id="jamlb" class="custom-select" <?php if (!empty($views)) echo 'disabled' ?>>
                                            <option value="">--</option>
                                            <?php for ($i = 0; $i < 24; $i++) : ?>
                                                <option value="<?= ($i < 10) ? '0' . $i : $i ?>"><?= ($i < 10) ? '0' . $i : $i ?></option>
                                            <?php endfor ?>
                                        </select></div>
                                    <div class=" col-4">
                                        <select name="menitlb" id="menitlb" class="custom-select" <?php if (!empty($views)) echo 'disabled' ?>>
                                            <option value="">--</option>
                                            <?php for ($i = 0; $i < 60; $i++) : ?>
                                                <option value="<?= ($i < 10) ? '0' . $i : $i ?>"><?= ($i < 10) ? '0' . $i : $i ?></option>
                                            <?php endfor ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputAddress2">Dari</label>
                                <textarea name="darilb" id="darilb" cols="30" class="form-control" <?php if (!empty($views)) echo $views ?>></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">Untuk</label>
                                <textarea name="untuklb" id="untuklb" cols="30" class="form-control" <?php if (!empty($views)) echo $views ?>></textarea>
                            </div>


                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="inputAddress2">Detail List</label>
                            </div>

                            <div>
                                <table class="table table-bordered dataTabs" id="dtbl" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th width="50%">Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th width="30%" class="hd">Aksi</th>
                                        </tr>
                                        <tr <?php if (!empty($views)) echo 'hidden' ?>>
                                            <td>#</td>
                                            <td>
                                                <input type="hidden" id="idEditD">
                                                <input type="text" name="nmdetail" class="form-control" id="nmdetail">
                                            </td>
                                            <td><input type="text" id="jmdetail" name="jmdetail" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>
                                            <td>
                                                <center><button type="button" id="lbDetail" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> </button></center>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody id="detailLb">
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="hidden" id="act">
                    <button type="submit" class="btn btn-primary" id="btnsv">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>