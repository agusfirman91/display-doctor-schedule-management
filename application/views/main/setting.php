<div class="card">
    <div class="card-header">
        <div class="card-title">
            Display Setting
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped datatables-basic" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Rumah Sakit</th>
                    <th>Icon</th>
                    <th>Image Display</th>
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
                                            <input type="checkbox" class="custom-control-input" name="toggle_setting" id=' . $id . ' class="info" data-toggle="' . $param_name . '" value="1">
                                            <span class="custom-control-label"></span>
                                        </label>';
                    } else {
                        $v_checkbox = '<label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="toggle_setting" id=' . $id . ' class="info" data-toggle="' . $param_name . '" value="0" checked>
                                            <span class="custom-control-label"></span>
                                        </label>';
                    }
                    return $v_checkbox;
                }
                $no = 1;
                foreach ($list_setting as $setting) {

                    ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $setting->name; ?></td>
                        <td>
                            <a href="javascript:void(0);" data-id="<?= $setting->id; ?>" class="v_image">
                                <img style="width:50px;height:50px" src="<?= base_url('assets/images/uploads/') . $setting->image_icon ?>" name="view-image" alt="image-files">
                            </a>
                        </td>
                        <td>
                            <a href="javascript:void(0);" data-id="<?= $setting->id; ?>" class="v_image">
                                <img style="width:50px;height:50px" src="<?= base_url('assets/images/uploads/') . $setting->image_display ?>" name="view-image" alt="image-files">
                            </a>
                        </td>
                        <td><?= v_checkbox($setting->id, 'is_active', $setting->is_active); ?></td>
                        <td>
                            <a href="javascript:void(0);" class="e_setting" data-id="<?= $setting->id ?>" data-toggle="tooltip" data-placement="top" title="Edit Setting">
                                <i class="align-middle" data-feather="edit"></i></a>
                            <a href="javascript:void(0);" class="d_setting" data-id="<?= $setting->id ?>" data-toggle="tooltip" data-placement="top" title="Delete Setting">
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
        <button class='btn btn-primary btn-square t_setting' data-id='0'>Add</button>
    </div>
</div>


<div class="modal fade" id="m_view_image" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-body text-center" id="image-body">
        </div>
    </div>
</div>

<div class="modal fade" id="m_setting" role="dialog">
    <div class="modal-dialog modal-sg">
        <form id="f_setting" class="form-horizontal" method="post" enctype="multipart/form-data">
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
                        <label class="col-sm-4 control-label">RS Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-sm" name="rs_name" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Image Icon</label>
                        <div class="col-sm-4">
                            <input type="file" class="input-sm" name="image_icon" size="20" />
                            <small class="form-text text-muted">
                                Recomended 50x50.</small>
                        </div>
                        <div class="col-sm-4">
                            <input type="hidden" class="input-sm" name="image_icon_old" size="20" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Image Display</label>
                        <div class="col-sm-4">
                            <input type="file" class="input-sm" name="image_display" size="20" />
                            <small class="form-text text-muted">
                                Recomended 270x80.</small>
                        </div>
                        <div class="col-sm-4">
                            <input type="hidden" class="input-sm" name="image_display_old" size="20" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-square" id="b_setting">Simpan</button>
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
        var rs_name = $('input:text[name=rs_name]');
        var image_icon_old = $('input:hidden[name=image_icon_old]');
        var image_display_old = $('input:hidden[name=image_display_old]');

        $('#b_setting').click(function(event) {
            var string = $("#f_setting").serialize();

            if (rs_name.val().length == 0) {
                rs_name.focus();
                return false;
            }
        });




        $(".v_image").click(function() {
            var id = $(this).attr("data-id");
            var src = $(this).children().attr("src");
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>main/req_data/setting/" + id,
                dataType: "JSON",
                success: function(data) {
                    // alert(src);
                    $("#m_view_image").modal('show');
                    $("#image-body").html("<img src='" + src + "'  />");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        });


        $(".t_setting,.e_setting").click(function() {
            var id = $(this).attr("data-id");
            judul(id);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>main/req_data/setting/" + id,
                dataType: "JSON",
                success: function(data) {
                    $("#m_setting").modal('show');
                    $('input:hidden[name=id]').val(data.id);
                    rs_name.val(data.name);
                    image_icon_old.val(data.image_icon);
                    image_display_old.val(data.image_display);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        });


        $(".d_setting").click(function() {
            var id = $(this).attr("data-id");
            var pilih = confirm('Data yang akan dihapus  = ' + id + '?');
            if (pilih == true) {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url() ?>main/delete/setting/" + id,
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
                $(".modal-title").text("Form Edit Setting");
                $("#f_setting").attr('action', '<?= base_url() ?>main/update/setting');
            } else {
                $(".modal-title").text("Form Add Setting ");
                $("#f_setting").attr('action', '<?= base_url() ?>main/add/setting');
            }
        }


        $('input[name=toggle_setting]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).attr('id');
            var toggle = $(this).attr('data-toggle');
            var value = $(this).attr('value');
            //   alert(id+'-'+value+'-'+toggle);
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: '<?= base_url() ?>main/do_switch_once/setting',
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