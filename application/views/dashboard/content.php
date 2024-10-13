<?php
$data_season = $this->db->order_by('season_name', 'ASC')->get('season')->result();
$data_genre = $this->db->order_by('genre_name', 'ASC')->get('genre')->result();
$data_category = $this->db->order_by('category_name', 'ASC')->get('category')->result();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-sm" id="table_content">
                        <thead>
                            <tr class="table-dark">
                                <th>#</th>
                                <th>Title</th>
                                <th>Url</th>
                                <th><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
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
            <?= form_open('ajax/content', 'id="form_action"') ?>
            <input type="hidden" name="act" id="act">
            <input type="hidden" name="id" id="id_data">
            <div class="modal-body">
                <div class="form-group my-1">
                    <label><b>Title</b></label>
                    <input type="text" name="title" id="title" required class="form-control">
                </div>

                <div class="form-group my-1">
                    <label><b>Url</b></label>
                    <input type="text" name="url" id="url" required class="form-control">
                </div>
                <div class="form-group my-1">
                    <label><b>Url Image</b></label>
                    <input type="text" name="image" id="image" required class="form-control">
                </div>

                <div class="form-group my-1">
                    <label><b>Release at</b></label>
                    <br>
                    <select required name="season" id="season" style="width: 100%">
                        <option value="">--pilih--</option>
                        <?php foreach ($data_season as $ds) { ?>
                            <option value="<?= $ds->id ?>"><?= $ds->season_name ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group my-1">
                    <label><b>Genre</b></label>
                    <br>
                    <select required name="genre[]" multiple="multiple" id="genre" style="width: 100%;" class="form-control">
                        <?php foreach ($data_genre as $dg) { ?>
                            <option value="<?= $dg->genre_name ?>"><?= $dg->genre_name ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group my-1">
                    <label><b>Category</b></label>
                    <br>
                    <select required name="category" id="category" class="form-control">
                        <option value="">--pilih--</option>
                        <?php foreach ($data_category as $dc) { ?>
                            <option value="<?= $dc->id ?>"><?= $dc->category_name ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group my-1">
                    <label><b>Description</b></label>
                    <textarea name="desc" id="desc" class="form-control" required></textarea>
                </div>

                <table class="table table-bordered table-sm my-3" id="table_in_form">
                    <thead>
                        <tr class="table-dark">
                            <th class="text-center"><button onclick="add_form()" type="button" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button></th>
                            <th>About Name</th>
                            <th>About Value</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>



            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>


<div class="modal" id="modalDetail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-4 col-sm-4 col-md-3 col-lg-3">
                        <img src="" id="image_detail" alt="image" class="w-100">
                    </div>

                    <div class="col-12">
                        <h5 id="title_detail" class="text-center my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. </h5>
                        <p id="desc_detail">Lorem, ipsum dolor sit amet consectetur adipisicing elit. A vero iusto necessitatibus quos hic eum voluptatibus fugit quisquam velit vitae deserunt neque dignissimos ut perferendis doloribus, quod nemo cumque dolorem? Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum temporibus ab magnam pariatur consequuntur quas ducimus dicta adipisci odio? Doloribus eligendi, omnis nemo facere commodi ea eos maiores similique saepe!</p>
                    </div>

                    <div class="col-12">
                        <table class="table table-sm table-bordered" id="table_detail">
                            <thead>
                                <tr class="table-dark">
                                    <th colspan="2" class="text-center">About</th>
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
            </div>
        </div>
    </div>
</div>