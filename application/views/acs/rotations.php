<div class="card">
    <div class="card-header">
        <div class="card-title">
            List Rotations
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped datatables-basic" style="width:100%">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Name</th>
                    <th>Repeat Date</th>
                    <th>Description</th>
                    <th width="5%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $no = 1;
                foreach ($list_rotations as $rotation) {
                    ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><a href="<?= base_url('acs/rotations/') . $rotation->id ?>"> <?= $rotation->name; ?></a></td>
                        <td><?= $rotation->repeat_date; ?></td>
                        <td><?= $rotation->description; ?></td>
                        <td>
                            <a href="javascript:void(0);" class="e_rotation" data-id="<?= $rotation->id ?>" data-role="<?= $rotation->name ?>" data-toggle="tooltip" data-placement="top" title="Edit rotation">
                                <i class="align-middle" data-feather="edit"></i></a>
                            <a href="javascript:void(0);" class="d_rotation" data-id="<?= $rotation->id ?>" data-toggle="tooltip" data-placement="top" title="Delete rotation">
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
        <button class='btn btn-primary btn-square t_rotation' data-id='0'>Add Rotation</button>
    </div>
</div>

<div class="modal fade" id="m_image" role="dialog">
    <div class="modal-dialog modal-sg">
        <div class="modal-body" id="image-body">
        </div>
    </div>
</div>

<div class="modal fade" id="m_rotation" role="dialog">
    <div class="modal-dialog modal-sg">
        <form id="f_rotation" class="form-horizontal" method="post" enctype="multipart/form-data">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center"></h4>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <input type="hidden" class="form-control input" name="id" value="">
                        <label class="col-3 control-label">Name</label>
                        <div class="col-8">
                            <input type="text" class="form-control input" name="name" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 control-label">Repeat Date</label>
                        <div class="col-8">
                            <select name="repeat_date[]" class="form-control select2 select-add-items" multiple="multiple">
                                <?php
                                for ($x = 1; $x <= 31; $x++) {
                                    ?>
                                    <option value="<?= $x ?>"><?= $x ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 control-label">Description</label>
                        <div class="col-8">
                            <input type="text" class="form-control input" name="description" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-square" id="b_rotation">Simpan</button>
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
        var name = $('input:text[name=name]');
        var description = $('input:text[name=description]');

        $('#b_rotation').click(function(event) {
            var string = $("#f_rotation").serialize();

            if (name.val().length == 0) {
                name.focus();
                return false;
            }
        });


        $(".t_rotation,.e_rotation").click(function() {
            var id = $(this).attr("data-id");
            judul(id);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>acs/req_data/tblrotations/" + id,
                dataType: "JSON",
                success: function(data) {
                    $("#m_rotation").modal('show');
                    $('input:hidden[name=id]').val(data.id);
                    name.val(data.name);
                    description.val(data.description);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        });


        $(".d_rotation").click(function() {
            var id = $(this).attr("data-id");
            var pilih = confirm('Data yang akan dihrotationus  = ' + id + '?');
            if (pilih == true) {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url() ?>acs/delete/tblrotations/" + id,
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
                $(".modal-title").text("Form Edit Menu");
                $("#f_rotation").attr('action', '<?= base_url() ?>acs/update/tblrotations');
            } else {
                $(".modal-title").text("Form Add Menu ");
                $("#f_rotation").attr('action', '<?= base_url() ?>acs/add/tblrotations');
            }
        }

    });
</script>