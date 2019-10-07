<div class="card">
    <div class="card-header">
        <div class="card-title">
            Master Dokter
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped datatables-basic" id="datatables-doctor" style=" width:100%">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Dokter</th>
                    <th>Spesialis</th>
                    <th>Dokter Umum</th>
                    <th width="5%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                function v_checkbox($id = '', $param_name = '', $value = '')
                {
                    if ($value != 1) {
                        $v_checkbox = '<label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="toggle_doctor" id=' . $id . ' class="info" data-toggle="' . $param_name . '" value="1">
                                            <span class="custom-control-label"></span>
                                        </label>';
                    } else {
                        $v_checkbox = '<label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="toggle_doctor" id=' . $id . ' class="info" data-toggle="' . $param_name . '" value="0" checked>
                                            <span class="custom-control-label"></span>
                                        </label>';
                    }
                    return $v_checkbox;
                }
                $no = 1;
                foreach ($list_dokter as $dokter) {
                    ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $dokter->name; ?></td>
                        <td class="text-left"><?= v_checkbox($dokter->id, 'is_doctor_specialist', $dokter->is_doctor_specialist); ?></td>
                        <td><?= v_checkbox($dokter->id, 'is_doctor_of_duty', $dokter->is_doctor_of_duty); ?></td>
                        <td>
                            <a href="javascript:void(0);" class="e_dokter" data-id="<?= $dokter->id ?>" data-role="<?= $dokter->name ?>" data-toggle="tooltip" data-placement="top" title="Edit dokter">
                                <i class="align-middle" data-feather="edit"></i></a>
                            <a href="javascript:void(0);" class="d_dokter" data-id="<?= $dokter->id ?>" data-toggle="tooltip" data-placement="top" title="Delete dokter">
                                <i class="align-middle" data-feather="delete"></i></a>
                        </td>
                    </tr>
                <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <button class='btn btn-primary btn-square t_dokter' data-id='0'>Add Doctor</button>
    </div>
</div>


<div class="modal fade" id="m_dokter" role="dialog">
    <div class="modal-dialog modal-sg">
        <form id="f_dokter" class="form-horizontal" method="post">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center"></h4>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <input type="hidden" class="form-control input-sm" name="id" value="">
                        <label class="col-sm-3 control-label">Doctor Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-sm" name="doctorname" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-square" id="b_dokter">Simpan</button>
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
        var doctorname = $('input:text[name=doctorname]');

        $('#b_dokter').click(function(event) {
            var string = $("#f_dokter").serialize();

            if (doctorname.val().length == 0) {
                doctorname.focus();
                return false;
            }
        });


        // Datatables with Buttons
        var datatablesButtons = $("#datatables-doctor").DataTable({
            responsive: true,
            lengthChange: !1,
            buttons: ["copy", "print"]
        });


        $(".t_dokter,.e_dokter").click(function() {
            var id = $(this).attr("data-id");
            judul(id);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>main/req_data/doctor/" + id,
                dataType: "JSON",
                success: function(data) {
                    $("#m_dokter").modal('show');
                    $('input:hidden[name=id]').val(data.id);
                    doctorname.val(data.name);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        });


        $(".d_dokter").click(function() {
            var id = $(this).attr("data-id");
            var pilih = confirm('Data yang akan dihdokterus  = ' + id + '?');
            if (pilih == true) {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url() ?>main/delete/doctor/" + id,
                    data: "id=" + id,
                    success: function(data) {
                        location.reload();
                    }
                });
            }
        });

        //fungsi judul modal
        function judul(id) {
            if (id != 0) {
                $(".modal-title").text("Form Edit Dokter");
                $("#f_dokter").attr('action', '<?= base_url() ?>main/update/doctor');
            } else {
                $(".modal-title").text("Form Add Dokter ");
                $("#f_dokter").attr('action', '<?= base_url() ?>main/add/doctor');
            }
        }

        $('input[name=toggle_doctor]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).attr('id');
            var toggle = $(this).attr('data-toggle');
            var value = $(this).attr('value');
            //   alert(id+'-'+value+'-'+toggle);
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: '<?= base_url() ?>main/do_switch/doctor',
                data: {
                    mode: mode,
                    id: id,
                    value: value,
                    toggle: toggle
                },
                success: function(data) {
                    var data = eval(data);
                    location.reload();
                }
            });
        });

    });
</script>

<style>
    /* The switch - the box around the slider */
    .switch {
        position: absolute;
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