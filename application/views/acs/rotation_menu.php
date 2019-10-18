<div class="card">
    <div class="card-header">
        <div class="card-title">
            List Rotations Menu
            <b><?= $resRotation->name; ?></b>
            <button class="btn btn-warning btn-warning btn-square float-right" onclick="history.back()">Back</button>
        </div>
    </div>
    <div class="card-body">
        <div class="tab tab-vertical tab-default">
            <ul class="nav nav-tabs" role="tablist">
                <?php
                foreach ($list_category_menu as $cat) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link cat-menu" id="#cat_<?= $cat->id ?>" href="<?= base_url('acs/rotations/') . $resRotation->id . '/' . $cat->id ?>" data-cat="<?= $cat->id ?>" data-name="<?= $cat->name ?>"><?= $cat->name ?></a>
                    </li>
                <?php
                }
                ?>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="cat-1" role="tabpanel">
                    <h4 class="title"></h4>
                    <table class="table table-bordered datatables-basic" id="tableData">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kelas</th>
                                <th>Header Menu</th>
                                <th>Items</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($detailRotations as $rotation) {
                                $menu = explode(',', $rotation->menu);
                                ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $rotation->class ?></td>
                                    <td><?= $rotation->header ?></td>
                                    <td><?= $menu ?></td>
                                    <td> <a href="javascript:void(0);" title="Edit detail" onclick="edit_detail($rotation->id)">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                        <a href="javascript:void(0);" onclick="delete_detail($rotation->id )" title="Delete detail">
                                            <span class="fa fa-trash"></span>
                                        </a></td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>

                    </table>
                    <button class='btn btn-primary btn-square t_rotation_menu_br' data-id='0'>Add Menu Breakfast</button>
                </div>
            </div>
        </div>
    </div>


</div>
<div class="card-footer">
</div>
</div>

<div class="modal fade" id="m_image" role="dialog">
    <div class="modal-dialog modal-sg">
        <div class="modal-body" id="image-body">
        </div>
    </div>
</div>

<div class="modal fade" id="m_rotation_menu" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <form id="f_rotation_menu_br" class="form-horizontal" method="post">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center"></h4>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <input type="hidden" name="rotation_id" value="<?= $rotation_id; ?>">
                        <input type="hidden" name="cat_id">
                        <label class="col-3 control-label">Kelas</label>
                        <div class="col-8">
                            <select name="class_id" class="form-control select2">
                                <?php
                                foreach ($list_class as  $class) :
                                    ?>
                                    <option value="<?= $class->id; ?>"><?= $class->name ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div id="dy-menu">
                        <div class="form-group row">
                            <label class="col-3 control-label">Header</label>
                            <div class="col-8">
                                <input type="text" name="header" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 control-label">Items</label>
                            <div class="col-8">
                                <select name="menu_id[]" class="form-control select2" data-toggle="select2" multiple>
                                    <?php
                                    foreach ($list_menus as  $menu) :
                                        ?>
                                        <option value="<?= $menu->id; ?>"><?= $menu->name ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning btn-square" id="add-item">Add More...</button>
                    <button type="button" class="btn btn-primary btn-square" id="b_rotation_menu_br">Simpan</button>
                    <button type="button" class="btn btn-danger btn-square" data-dismiss="modal">Batal</button>
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

        var i = 1;
        $('#add-item').click(function() {
            i++;
            $('#dy-menu').append('<div id="row' + i + '"><div class="form-group row"><label class="col-3 control-label">Header</label><div class="col-8"><input type="text" name="header[' + i + ']" class="form-control"></div></div><div class="form-group row"><label class="col-3 control-label">Items</label><div class="col-8"><select name="menu_id[' + i + '][]" class="form-control select2" multiple><?php foreach ($list_menus as  $menu) { ?><option value="<?= $menu->id; ?>"><?= $menu->name ?></option><?php } ?></select></div><button type="button" class="btn btn-danger remove-item" id="' + i + '">X</button></div></div>');

            $(".select2").each(function() {
                $(this)
                    .wrap("<div class=\"position-relative\"></div>")
                    .select2({
                        placeholder: "Select value",
                        dropdownParent: $(this).parent()
                    });
            });
        });

        $(document).on('click', '.remove-item', function() {
            // alert('ÓK');
            var btn_id = $(this).attr('id');
            $('#row' + btn_id + '').remove();
        });

        $('.cat-menu').eq(0).click();


        $('.cat-menu').click(function() {
            var catId = $(this).attr('data-cat');
            var catName = $(this).attr('data-name');
            var rotation_id = $('input:hidden[name=rotation_id]').val();
            // alert(rotation_id);
            var url = "<?= base_url('acs/ajax_rotation_detail/') ?>" + rotation_id + '/' + catId;
            $('input:hidden[name=cat_id]').val(catId);
            $('.title').text('List Menu ' + catName);
            // $.ajax({
            //     "url": url,
            //     "type": "POST",
            //     success: function(data) {
            //         // alert(data);
            //         console.log(data);
            //     }
            // });
            table = $('#tableData').DataTable({

                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": url,
                    "type": "POST"
                },
                "columnDefs": [{
                    "targets": [-1], //last column
                    "orderable": false, //set not orderable
                }, ],
            });
        });

        $('#b_rotation_menu_br').click(function(e) {
            // e.preventDefault();
            var string = $("#f_rotation_menu_br").serialize();

            // alert("string");
            $.ajax({
                url: "<?= base_url('acs/save_rotations') ?>",
                method: "POST",
                dataType: "JSON",
                data: string,
                success: function(data) {
                    // alert(data);
                    if (data == "OK") {
                        $("#m_rotation_menu").modal('hide');
                    }
                }
            });

        });
        var name = $('input:text[name=name]');
        var description = $('input:text[name=description]');


        $('#b_rotation_menu').click(function(event) {
            var string = $("#f_rotation_menu").serialize();

            if (name.val().length == 0) {
                name.focus();
                return false;
            }
        });


        $(".t_rotation_menu_br").click(function() {
            // var id = $(this).attr("data-id");
            $("#m_rotation_menu").modal('show');
            // judul(id);
            // $.ajax({
            //     type: "GET",
            //     url: "<= echo base_url() ?>acs/req_data/tblrotation_menus/" + id,
            //     dataType: "JSON",
            //     success: function(data) {
            //         $('input:hidden[name=id]').val(data.id);
            //         name.val(data.name);
            //         description.val(data.description);
            //     },
            //     error: function(jqXHR, textStatus, errorThrown) {
            //         alert('Error get data from ajax');
            //     }
            // });
        });


        $(".d_rotation_menu").click(function() {
            var id = $(this).attr("data-id");
            var pilih = confirm('Data yang akan dihrotation_menuus  = ' + id + '?');
            if (pilih == true) {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url() ?>acs/delete/tblrotation_menus/" + id,
                    data: "id=" + id,
                    success: function(data) {
                        location.reload();
                    }
                });
            }
        });

        //fungsi judul modal
        // function judul(id) {
        //     if (id != 0) {
        //         $(".modal-title").text("Form Edit Menu");
        //         $("#f_rotation_menu").attr('action', '< base_url() ?>acs/update/tblrotation_menus');
        //     } else {
        //         $(".modal-title").text("Form Add Menu ");
        //         $("#f_rotation_menu").attr('action', '<= base_url() ?>acs/add/tblrotation_menus');
        //     }
        // }


    });
</script>