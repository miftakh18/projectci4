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
                                <input type="text" id="id_<?= $idform; ?>">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif ?>