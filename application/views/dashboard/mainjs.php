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

    <?php } ?>
</script>