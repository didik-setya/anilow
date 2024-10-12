<?php $data = $this->db->order_by('id', 'DESC')->get('category')->result() ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <table class="table table-sm table-bordered" id="table_default">
                <thead>
                    <tr class="table-dark">
                        <th>#</th>
                        <th>Category Name</th>
                        <th><i class="fa fa-cogs"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($data as $d) { ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $d->category_name ?></td>
                            <td>
                                <button class="btn btn-sm btn-danger" onclick="delete_data('<?= $d->id ?>', 'category')"><i class="fa fa-trash"></i></button>
                                <button class="btn btn-sm btn-success" onclick="edit_data('<?= $d->id ?>', '<?= $d->category_name ?>')"><i class="fa fa-edit"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal" id="mainModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('ajax/category', 'id="form_action"') ?>
            <input type="hidden" name="act" id="act">
            <input type="hidden" name="id" id="id_data">
            <div class="modal-body">
                <div class="form-group">
                    <label><b>Category Name</b></label>
                    <input type="text" name="category" id="category" required class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>