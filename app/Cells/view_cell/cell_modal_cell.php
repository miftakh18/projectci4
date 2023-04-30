<?php if ($nama_modal == 'hmenu') : ?>

    <div class="modal fade " id="<?= $idhtml; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form id="<?= $idform; ?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <?php if (strtolower($tipe)  == 'edit') : ?>
                                Edit
                            <?php elseif (strtolower($tipe)  == 'add') : ?>
                                Tambah
                            <?php endif ?>
                            Header
                            <?php if (strtolower($tipe)  == 'edit') : ?>
                                <input type="hidden" id="id_<?= $idform; ?>">
                            <?php endif ?>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama Header </label>
                            <input type="text" class="form-control form-control-user" id="nmheader" name="nmheader">
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi </label>
                            <textarea name="deskheader" id="deskheader" class="form-control" rows="5" placeholder="Contoh: header"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Urutan </label>
                            <input type="number" class="form-control form-control-user" id="urutanheader" name="urutanheader">
                        </div>
                        <?php if (strtolower($tipe)  == 'edit') : ?>
                            <div class="form-group">
                                <label for="">Aktif </label>
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="aktif" id="ON" value="1">
                                        <label class="form-check-label" for="ON">ON</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="aktif" id="OFF" value="0">
                                        <label class="form-check-label" for="OFF">OFF</label>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <?php
                            if (strtolower($tipe)  == 'edit') echo 'Update';
                            else echo 'Save'; ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif ?>

<?php if ($nama_modal == 'menu') : ?>
    <div class="modal fade " id="<?= $idhtml; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form id="<?= $idform; ?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <?php if (strtolower($tipe)  == 'edit') : ?>
                                Edit
                            <?php elseif (strtolower($tipe)  == 'add') : ?>
                                Tambah
                            <?php endif ?>
                            Header
                            <?php if (strtolower($tipe)  == 'edit') : ?>
                                <input type="hidden" id="id_<?= $idform; ?>">
                            <?php endif ?>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Header </label>
                            <select name="hid" id="hid" class="custom-select">
                                <option value="">Pilih Header</option>
                                <?php foreach ($this->HeaderAll() as $key => $header) : ?>
                                    <option value="<?= $header['hid']; ?>"><?= $header['nama_head'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Menu </label>
                            <input type="text" class="form-control form-control-user" id="nama_menu" name="nama_menu">
                        </div>
                        <div class="form-group">
                            <label for="">Link </label>
                            <input type="text" class="form-control form-control-user" id="href" name="href">
                        </div>
                        <div class="form-group">
                            <label for="">Icon </label>
                            <input type="text" class="form-control form-control-user" id="icon" name="icon" placeholder="Contoh :fas fa-dashboard(Nama Class)">
                            <span><small>Search Font <a href="https://fontawesome.com/v5/search">FontAwesome5</a></small></span>
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi </label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5" placeholder="Contoh: header"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Urutan </label>
                            <input type="number" class="form-control form-control-user" id="urutan" name="urutan">
                        </div>
                        <?php if (strtolower($tipe)  == 'edit') : ?>
                            <div class="form-group">
                                <label for="">Aktif </label>
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="aktif" id="ON" value="1">
                                        <label class="form-check-label" for="ON">ON</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="aktif" id="OFF" value="0">
                                        <label class="form-check-label" for="OFF">OFF</label>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <?php
                            if (strtolower($tipe)  == 'edit') echo 'Update';
                            else echo 'Save'; ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>