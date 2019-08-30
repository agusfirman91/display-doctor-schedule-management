<div class="card">
    <div class="card-header">
        <div class="card-title">
            Display Management
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table mb-0 table-striped datatables-basic" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th width="10%">Name</th>
                        <th width="25%">Title Display</th>
                        <th>URL</th>
                        <th>Plasma Type</th>
                        <th>Dokter Jaga</th>
                        <th>Dokter Spesialis</th>
                        <th>Perawat</th>
                        <th>PJ Perawat</th>
                        <th>Slide</th>
                        <th>Active</th>
                        <th width="5%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    function v_checkbox($id = '', $param_name = '', $value = '')
                    {
                        if ($value != 1) {
                            $v_checkbox = '<label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="toggle_plasma" id=' . $id . ' class="info" data-toggle="' . $param_name . '" value="1">
                                            <span class="custom-control-label"></span>
                                        </label>';
                        } else {
                            $v_checkbox = '<label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="toggle_plasma" id=' . $id . ' class="info" data-toggle="' . $param_name . '" value="0" checked>
                                            <span class="custom-control-label"></span>
                                        </label>';
                        }
                        return $v_checkbox;
                    }
                    $no = 1;
                    foreach ($list_plasma as $plasma) {
                        if ($plasma->is_active == 1) {
                            $bgRow = "text-default";
                        } else {
                            $bgRow = "text-danger";
                        }
                        ?>
                    <tr class="<?= $bgRow ?>">
                        <td><?= $no; ?></td>
                        <td><?= $plasma->name; ?></td>
                        <td><?= $plasma->title; ?></td>
                        <td><?= $plasma->url; ?></td>
                        <td><?= ucwords($plasma->name_type); ?></td>
                        <td><?= v_checkbox($plasma->id, 'is_doctor_of_duty', $plasma->is_doctor_of_duty); ?></td>
                        <td><?= v_checkbox($plasma->id, 'is_specialist_doctor', $plasma->is_specialist_doctor); ?></td>
                        <td><?= v_checkbox($plasma->id, 'is_nurse', $plasma->is_nurse); ?></td>
                        <td><?= v_checkbox($plasma->id, 'is_pic_nurse', $plasma->is_pic_nurse); ?></td>
                        <td><?= v_checkbox($plasma->id, 'is_image_slide', $plasma->is_image_slide); ?></td>
                        <td><?= v_checkbox($plasma->id, 'is_active', $plasma->is_active); ?></td>
                        <td>
                            <a href="javascript:void(0);" class="e_plasma" data-id="<?= $plasma->id ?>" data-toggle="tooltip" data-placement="top" title="Edit Doctor Specialist">
                                <i class="align-middle" data-feather="edit"></i></a>
                        </td>
                    </tr>
                    <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer">
        <button class='btn btn-primary btn-square t_plasma' data-id='0'>Add Display</button>
    </div>
</div>


<div class="modal fade" id="m_plasma" role="dialog">
    <div class="modal-dialog modal-sg">
        <form id="f_plasma" class="form-horizontal" method="post">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center"></h4>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control input-sm" name="id" readonly>
                    <div class="form-group row">
                        <input type="hidden" class="form-control input-sm" name="id" value="">
                        <label class="col-sm-4 control-label">Display Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-sm" name="display_name" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Display Title</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-sm" name="display_title" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">URL</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-sm" name="url" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Plasma Type</label>
                        <div class="col-sm-4">
                            <select name="type_id" class="form-control input-sm custom-select">
                                <option value="">== Please Select ==</option>
                                <?php
                                foreach ($list_type as $type_plasma) {
                                    ?>
                                <option value="<?= $type_plasma->id ?>"><?= ucwords($type_plasma->name) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-square" id="b_plasma">Simpan</button>
                        <button type="button" class="btn btn-danger btn-square" data-dismiss="modal">Batal</button>
                    </div>
                </div>
        </form>
    </div>
</div>


<?php
$pesan = $this->session->userdata('message');
if ($pesan) {
    echo "<script>
    $(document).ready(function() {
        toastr.info('$pesan', 'Information', {timeOut: 3000});
    });
    </script>";
}
?>

<script>
    $(document).ready(function() {
        var display_name = $('input:text[name=display_name]');
        var display_title = $('input:text[name=display_title]');
        var url = $('input:text[name=url]');
        var type_id = $('select[name=type_id]');

        $('#b_plasma').click(function(event) {
            var string = $("#f_plasma").serialize();

            if (display_name.val().length == 0) {
                display_name.focus();
                return false;
            }
            if (display_title.val().length == 0) {
                display_title.focus();
                return false;
            }
            if (type_id.val().length == 0) {
                type_id.focus();
                return false;
            }
            if (url.val().length == 0) {
                url.focus();
                return false;
            }
        });



        $(".t_plasma,.e_plasma").click(function() {
            var id = $(this).attr("data-id");
            var role_name = $(this).attr("data-role");
            judul(id);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>main/req_data/plasma/" + id,
                dataType: "JSON",
                success: function(data) {
                    $("#m_plasma").modal('show');
                    $('input:hidden[name=id]').val(data.id);
                    display_name.val(data.name);
                    display_title.val(data.title);
                    url.val(data.url);
                    type_id.val(data.type_id);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        });


        $(".d_plasma").click(function() {
            var id = $(this).attr("data-id");
            Swal.fire({
                title: 'Are you sure?',
                text: "Data ini akan di hapus!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "delete/plasma/" + id,
                        data: "id=" + id,
                        success: function(data) {
                            Swal.fire(
                                data,
                                'Your file has been deleted.',
                                'success'
                            )
                            location.reload();
                        }
                    });
                }
            })
            // var id = $(this).attr("data-id");
            // var pilih = confirm('Data yang akan dihplasmaus  = ' + id + '?');
            // if (pilih == true) {
            //     $.ajax({
            //         type: "GET",
            //         url: "main/delete/plasma/" + id,
            //         data: "id=" + id,
            //         success: function(data) {
            //             location.reload();
            //         }
            //     });
            // }
        });

        //fungsi judul modal
        function judul(id) {
            if (id != 0) {
                $(".modal-title").text("Form Edit plasma");
                $("#f_plasma").attr('action', '<?= base_url() ?>main/update/plasma');
            } else {
                $(".modal-title").text("Form Add plasma ");
                $("#f_plasma").attr('action', '<?= base_url() ?>main/add/plasma');
            }
        }


        $('input[name=toggle_plasma]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).attr('id');
            var toggle = $(this).attr('data-toggle');
            var value = $(this).attr('value');
            //   alert(id+'-'+value+'-'+toggle);
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: '<?= base_url() ?>main/do_switch/plasma',
                data: {
                    mode: mode,
                    id: id,
                    value: value,
                    toggle: toggle
                },
                success: function(data) {
                    var data = eval(data);
                    // alert(id+'-'+value+'-'+toggle);
                    // alert(data.success);
                    location.reload();
                }
            });

        });


    });
</script>

<style>
    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: block;
        width: 45px;
        height: 20px;
        float: right;
    }

    /* Hide default HTML checkbox */
    .switch input {
        display: none;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 2px;
        bottom: 2px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input.default:checked+.slider {
        background-color: #444;
    }

    input.primary:checked+.slider {
        background-color: #2196F3;
    }

    input.success:checked+.slider {
        background-color: #8bc34a;
    }

    input.info:checked+.slider {
        background-color: #3de0f5;
    }

    input.warning:checked+.slider {
        background-color: #FFC107;
    }

    input.danger:checked+.slider {
        background-color: #f44336;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>