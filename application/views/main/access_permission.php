<div class="card">
    <div class="card-header">
        <div class="card-title">
            List Access Permission
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped datatables-basic" style="width:100%">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="5%">Group</th>
                    <th>Role Permission</th>
                    <th width="5%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($list_groups as $group) {
                    ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $group->name; ?></td>
                        <td>
                            <?php foreach ($group->menus as $menu) : ?>
                                <div class="badge badge-primary"><?= $menu->name ?></div>
                            <?php endforeach ?>
                        </td>
                        <td>
                            <a href="<?= base_url() . 'main/edit-access-permission/' . $group->id ?>" class="" data-id="<?= $group->id ?>" data-toggle="tooltip" data-placement="top" title="Edit group">
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
    <div class="card-footer">
        <a class='btn btn-primary btn-square t_permission' data-id='0' href="<?= base_url() ?>main/add-access-permission">Add Access Permission</a>
    </div>
</div>


<div class="modal fade" id="m_permission" role="dialog">
    <div class="modal-dialog modal-sg">
        <form id="f_permission" class="form-horizontal" method="post">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center"></h4>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <input type="hidden" class="form-control input-sm" name="id" value="">
                        <label class="col-sm-3 control-label">Permission Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-sm" name="name" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="data"></div>
                        <label class="col-sm-3 control-label">Permission Role</label>
                        <div class="col-sm-8"> <?php foreach ($list_menus as $menu) : ?>
                                <label class="custom-control custom-checkbox col-2">
                                    <?php
                                    $gID = $menu->id;
                                    $checked = null;
                                    $item = null;
                                    foreach ($currentMenus as $mn) {
                                        if ($gID == $mn->id) {
                                            $checked = ' checked="checked"';
                                            break;
                                        }
                                    }
                                    ?>
                                    <input type="checkbox" name="menus[]" class="custom-control-input" value="<?php echo $menu->id; ?>" <?php echo $checked; ?>>
                                    <span class="custom-control-label"><?= $menu->name ?></span>
                                </label>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-square" id="b_permission">Simpan</button>
                        <button type="button" class="btn btn-danger btn-square" data-dismiss="modal">Batal</button>
                    </div>
                </div>
                <?php echo form_hidden('id', $group->id); ?>
                <?php echo form_hidden($csrf); ?>
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

        $('#b_permission').click(function(event) {
            var string = $("#f_permission").serialize();

            if (doctorname.val().length == 0) {
                doctorname.focus();
                return false;
            }
        });



        $(".t_permission,.e_permission").click(function() {
            var id = $(this).attr("data-id");
            judul(id);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>main/access_permission_edit/" + id,
                dataType: "JSON",
                success: function(data) {
                    // $("#m_permission").modal('show');
                    // $('input:hidden[name=id]').val(data.id);
                    // $('.data').html(data);
                    var obj = jQuery.parseJSON(data);
                    console.log(obj);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        });


    });
</script>