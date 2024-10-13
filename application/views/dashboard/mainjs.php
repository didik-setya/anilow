<?php
$url = cek_url();
?>
<script>
    $('#table_default').dataTable();

    function loading() {
        Swal.fire({
            title: "Loading",
            html: "Please wait...",
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            },
        });
    }

    function error_alert(msg) {
        Swal.fire({
            title: "Error",
            text: msg,
            icon: "error"
        });
    }

    function delete_data(id, from) {
        Swal.fire({
            title: "Apakah anda yakin?",
            text: "Data akan di hapus secara permanen",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
        }).then((res) => {
            if (res.isConfirmed) {
                proccess_delete(id, from)
            }
        })
    }

    function proccess_delete(id, from) {
        loading();
        $.ajax({
            url: '<?= base_url('ajax/delete_data') ?>',
            data: {
                id: id,
                from: from
            },
            type: 'POST',
            dataType: 'JSON',
            success: function(d) {
                setTimeout(() => {
                    Swal.close()
                    if (d.status == false) {
                        error_alert(d.msg)
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: d.msg
                        }).then((res) => {
                            window.location.reload()
                        })
                    }
                }, 200);
            },
            error: function(xhr, status, error) {
                setTimeout(() => {
                    Swal.close()
                    error_alert(error)
                }, 200);
            }
        })
    }

    $('#form_action').submit(function(e) {
        e.preventDefault()
        loading()
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: 'POST',
            dataType: 'JSON',
            success: function(d) {
                setTimeout(() => {
                    Swal.close()
                    if (d.status == false) {
                        error_alert(d.msg)
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: d.msg
                        }).then((res) => {
                            window.location.reload()
                        })
                    }
                }, 200);
            },
            error: function(xhr, status, error) {
                setTimeout(() => {
                    Swal.close()
                    error_alert(error)
                }, 200);
            }
        })

    })

    <?php if ($url == 'dashboard/') { ?>
    <?php } else if ($url == 'dashboard/category/') { ?>

        function add_data() {
            $('#mainModal').modal('show')
            $('#mainModal .modal-title').html('Tambah Data')
            $('#id_data').val('')
            $('#act').val('add')
            $('#category').val('')
        }

        function edit_data(id, category) {
            $('#mainModal').modal('show')
            $('#mainModal .modal-title').html('Edit Data')
            $('#id_data').val(id)
            $('#act').val('edit')
            $('#category').val(category)
        }

    <?php } else if ($url == 'dashboard/season/') { ?>

        function add_data() {
            $('#mainModal').modal('show')
            $('#mainModal .modal-title').html('Tambah Data')
            $('#id_data').val('')
            $('#act').val('add')
            $('#season').val('')
        }

        function edit_data(id, season) {
            $('#mainModal').modal('show')
            $('#mainModal .modal-title').html('Edit Data')
            $('#id_data').val(id)
            $('#act').val('edit')
            $('#season').val(season)
        }
    <?php } else if ($url == 'dashboard/genre/') { ?>

        function add_data() {
            $('#mainModal').modal('show')
            $('#mainModal .modal-title').html('Tambah Data')
            $('#id_data').val('')
            $('#act').val('add')
            $('#genre').val('')
        }

        function edit_data(id, genre) {
            $('#mainModal').modal('show')
            $('#mainModal .modal-title').html('Edit Data')
            $('#id_data').val(id)
            $('#act').val('edit')
            $('#genre').val(genre)
        }
    <?php } else if ($url == 'dashboard/content/') { ?>
        let form = '<tr><td><button type="button" class="btn btn-sm btn-danger delete_form"><i class="fa fa-times"></i></button></td><td><input placeholder="about name" type="text" name="about_name[]" class="form-control" required></td><td><input placeholder="about value" type="text" name="about_value[]" class="form-control" required></td></tr>'

        $(document).ready(function() {

            $('#season, #genre').select2({
                dropdownParent: $('#mainModal')
            })
            load_data()
        })

        function load_data() {
            $('#table_content').DataTable().destroy();
            $('#table_content').dataTable({
                "processing": true,
                "serverSide": true,
                "order": [],

                "ajax": {
                    "url": "<?= base_url('ajax/datatable_content') ?>",
                    "type": "POST"
                },

                "scrollX": false,
                "searching": true,
                "ordering": true,
                "autoWidth": false,
                "columnDefs": [],
            })
        }

        function add_form() {
            $('#table_in_form tbody').append(form)
        }

        $(document).on('click', '.delete_form', function() {
            $(this).parent('td').parent('tr').remove()
        })


        function add_data() {
            $('#mainModal').modal('show')
            $('#mainModal .modal-title').html('Tambah Data')
            $('#id_data').val('')
            $('#act').val('add')

            $('#title').val('')
            $('#url').val('')
            $('#image').val('')
            $('#season').val('').trigger('change')
            $('#genre').val('').trigger('change')
            $('#category').val('')
            $('#desc').val('')
            $('#table_in_form tbody').html('')

        }

        function edit_content(id) {
            $('#mainModal .modal-title').html('Edit Data')
            $('#id_data').val(id)
            $('#act').val('edit')
            load_data_for_edit(id)
        }

        function load_data_for_edit(id) {
            loading()
            $.ajax({
                url: '<?= base_url('ajax/get_content_for_edit') ?>',
                data: {
                    id: id
                },
                type: 'POST',
                dataType: 'JSON',
                success: function(d) {
                    setTimeout(() => {
                        Swal.close()
                        $('#mainModal').modal('show')
                        // $('#season').val(d.season)


                        const get_genre = d.genre;
                        let i;
                        let append_genre = [];
                        for (i = 0; i < get_genre.length; i++) {
                            append_genre.push(get_genre[i].genre);
                        }

                        const get_about = d.about;
                        let a;
                        let html_about = '';
                        for (a = 0; a < get_about.length; a++) {
                            html_about += '<tr><td><button type="button" class="btn btn-sm btn-danger delete_form"><i class="fa fa-times"></i></button></td><td><input value="' + get_about[a].name + '" placeholder="about name" type="text" name="about_name[]" class="form-control" required></td><td><input value="' + get_about[a].value + '" placeholder="about value" type="text" name="about_value[]" class="form-control" required></td></tr>'
                        }

                        $('#genre').val(append_genre).trigger('change');
                        $('#season').val(d.season).trigger('change')
                        $('#title').val(d.title)
                        $('#url').val(d.url)
                        $('#image').val(d.image_url)
                        $('#category').val(d.category)
                        $('#desc').val(d.description)
                        $('#table_in_form tbody').html(html_about)








                    }, 200);
                },
                error: function(xhr, status, error) {
                    setTimeout(() => {
                        Swal.close()
                        error_alert(error)
                    }, 200);
                }
            })
        }

        function detail_data(id) {
            loading()
            $.ajax({
                url: '<?= base_url('ajax/get_content_for_edit') ?>',
                data: {
                    id: id
                },
                type: 'POST',
                dataType: 'JSON',
                error: function(xhr, status, error) {
                    setTimeout(() => {
                        Swal.close()
                        error_alert(error)
                    }, 200);
                },
                success: function(d) {
                    setTimeout(() => {
                        $('#modalDetail').modal('show')
                        Swal.close()
                        const about = d.about;
                        const genre = d.genre;
                        let i;

                        let show_genre = '';
                        for (i = 0; i < genre.length; i++) {
                            show_genre += '<span>' + genre[i].genre + ',</span>';
                        }

                        let show_about = '';
                        for (i = 0; i < about.length; i++) {
                            show_about += '<tr> <th>' + about[i].name + '</th> <td>' + about[i].value + '</td> </tr>';
                        }

                        let html = '<tr> <th>URL</th> <td>' + d.url + '</td> </tr> <tr> <th>Kategori</th> <td>' + d.kategori + '</td> </tr> <tr> <th>Release</th> <td>' + d.musim + '</td> </tr> </tr> <tr> <th>Genre</th> <td>' + show_genre + '</td> </tr>' + show_about;
                        $('#image_detail').attr('src', d.image_url)
                        $('#title_detail').html(d.title)
                        $('#desc_detail').html(d.description)
                        $('#table_detail tbody').html(html)

                    }, 200);
                }
            })
        }
    <?php } ?>
</script>