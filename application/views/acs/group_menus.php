<div class="card">
    <div class="card-header">
        <div class="card-title">
            List Group Menu
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped datatables-basic" style="width:100%">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th width="5%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $no = 1;
                foreach ($list_groupMenus as $menu) {
                    ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $menu->name; ?></td>
                        <td><?= $menu->description; ?></td>
                        <td>
                            <a href="javascript:void(0);" class="e_menu" data-id="<?= $menu->id ?>" data-role="<?= $menu->name ?>" data-toggle="tooltip" data-placement="top" title="Edit menu">
                                <i class="align-middle" data-feather="edit"></i></a>
                            <a href="javascript:void(0);" class="d_menu" data-id="<?= $menu->id ?>" data-toggle="tooltip" data-placement="top" title="Delete menu">
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
        <button class='btn btn-primary btn-square t_menu' data-id='0'>Add Group Menu</button>
    </div>
</div>

<div class="modal fade" id="m_image" role="dialog">
    <div class="modal-dialog modal-sg">
        <div class="modal-body" id="image-body">
        </div>
    </div>
</div>

<div class="modal fade" id="m_menu" role="dialog">
    <div class="modal-dialog modal-sg">
        <form id="f_menu" class="form-horizontal" method="post" enctype="multipart/form-data">
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
                        <label class="col-3 control-label">Description</label>
                        <div class="col-8">
                            <textarea name="description" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-square" id="b_menu">Simpan</button>
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
        var description = $('textarea[name=description]');

        $('#b_menu').click(function(event) {
            var string = $("#f_menu").serialize();

            if (name.val().length == 0) {
                name.focus();
                return false;
            }
        });


        $(".t_menu,.e_menu").click(function() {
            var id = $(this).attr("data-id");
            judul(id);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>acs/req_data/tblgroupmenus/" + id,
                dataType: "JSON",
                success: function(data) {
                    $("#m_menu").modal('show');
                    $('input:hidden[name=id]').val(data.id);
                    name.val(data.name);
                    description.val(data.description);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        });


        $(".d_menu").click(function() {
            var id = $(this).attr("data-id");
            var pilih = confirm('Data yang akan dihmenuus  = ' + id + '?');
            if (pilih == true) {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url() ?>acs/delete/tblgroupmenus/" + id,
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
                $("#f_menu").attr('action', '<?= base_url() ?>acs/update/tblgroupmenus');
            } else {
                $(".modal-title").text("Form Add Menu ");
                $("#f_menu").attr('action', '<?= base_url() ?>acs/add/tblgroupmenus');
            }
        }


    });
</script>