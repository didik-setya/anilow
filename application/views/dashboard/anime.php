<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <div class="row">
                        <div class="col-6">
                            <a href="<?= base_url('dashboard/content') ?>" class="btn btn-sm btn-warning"><i class="fa fa-arrow-left"></i></a>
                        </div>
                        <div class="col-6">
                            <h6 class="text-end"><?= $content->title ?></h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-sm" id="table_default">
                        <thead>
                            <tr class="table-dark">
                                <th>#</th>
                                <th>Title</th>
                                <th>Create at</th>
                                <th>Last Update</th>
                                <th><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($data as $d) {
                                $dt_create = date_create($d->create_at);
                                $dt_update = date_create($d->last_update);
                            ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $d->title ?></td>
                                    <td><?= date_format($dt_create, 'd F Y H:i'); ?></td>
                                    <td><?= date_format($dt_update, 'd F Y H:i'); ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="delete_data('<?= $d->id ?>', 'eps')"><i class="fa fa-trash"></i></button>
                                        <button class="btn btn-sm btn-success" onclick="edit_data('<?= $d->id ?>')"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal" id="mainModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('ajax/eps', 'id="form_action"') ?>
            <input type="hidden" name="act" id="act">
            <input type="hidden" name="id" id="id_data">
            <input type="hidden" name="id_content" value="<?= $id ?>">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label><b>Title</b></label>
                            <input type="text" name="title" id="title" required class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label><b>Cover Preload</b></label>
                            <input type="text" name="cover" id="cover" required class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <table class="table table-bordered table-sm my-3" id="form_table">
                            <thead>
                                <tr class="table-dark">
                                    <th colspan="6" class="text-center">Source</th>
                                </tr>
                                <tr class="table-info">
                                    <th>#</th>
                                    <th>Title Server</th>
                                    <th>Type</th>
                                    <th>Link</th>
                                    <th>Metadata</th>
                                    <th>Source</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick="add_form_source()"><i class="fa fa-plus"></i> Add Form Source</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>