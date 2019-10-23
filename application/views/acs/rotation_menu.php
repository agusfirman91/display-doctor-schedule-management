<div class="card">
    <div class="card-header">
        <div class="card-title">
            List Rotations Menu
            <b><?= $resRotation->name; ?></b>
            <button class="btn btn-warning btn-warning btn-square float-right backHistory">Back</button>
        </div>
    </div>
    <div class="card-body">
        <div class="tab tab-vertical tab-default">
            <ul class="nav nav-tabs" role="tablist">
                <?php
                foreach ($list_category_menu as $cat) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link cat-menu <?= $this->uri->segment(4) == $cat->id ? "active" : "" ?>" id="#cat_<?= $cat->id ?>" href="<?= base_url('acs/rotations/') . $resRotation->id . '/' . $cat->id ?>" data-cat="<?= $cat->id ?>" data-name="<?= $cat->name ?>"><?= $cat->name ?></a>
                    </li>
                <?php
                }
                ?>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="cat-1" role="tabpanel">
                    <h4 class="title"></h4>
                    <table class="table table-bordered datatables-menu" style="width:100%">
                        <thead>
                            <tr>
                                <th>Kelas</th>
                                <th>Header Menu</th>
                                <th>Items</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $ci = &get_instance();
                            foreach ($detailRotations as $rotation) {
                                $menus = explode(',', $rotation->menu);
                                ?>
                                <tr>
                                    <td><?= $rotation->class ?></td>
                                    <td><?= $rotation->header ?></td>
                                    <td>
                                        <?php
                                            foreach ($menus as $menuId) {
                                                $data = $ci->db->query("SELECT name from tblmenus where id= $menuId")->row();
                                                echo '=> ' . $data->name . '<br/>';
                                            }
                                            ?>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" data-id="<?= $rotation->id; ?>" class="v_image">
                                            <img style="width:50px;height:50px" src="<?= base_url('assets/images/uploads/detailmenusrotations/') . $rotation->image ?>" name="view-image" alt="image-files">
                                        </a>
                                    </td>
                                    <td> <a href="javascript:void(0);" title="Edit detail" class="e_rotation_menu" data-id="<?= $rotation->id ?>">
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
                    <?php
                    $url = $this->uri->segment(4);
                    if ($url == 1) {
                        $btnText = "Breakfast";
                        $btnClass = "_br";
                    } else if ($url == 2) {
                        $btnText = "Lunch";
                        $btnClass = "_lnc";
                    } else {
                        $btnText = "Dinner";
                        $btnClass = "_din";
                    }
                    ?>
                    <button class="btn btn-primary btn-square t_rotation_menu" data-id='0'>Add Menu <?= $btnText; ?></button>
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
        <form id="f_rotation_menu" class="form-horizontal" method="post" enctype="multipart/form-data">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center"></h4>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <input type="hidden" name="id">
                        <input type="hidden" name="rotation_id" value="<?= $rotation_id; ?>">
                        <input type="hidden" name="cat_id" value="<?= $this->uri->segment(4); ?>">
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
                                <select name="menu_id[]" id="select-menu" class="form-control select2" data-toggle="select2" multiple>
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

                        <div class="input-group row mb-3">
                            <label class="col-3 control-label">Image</label>
                            <div class="col-6 ml-4">
                                <input type="file" class="custom-file-input" name="image" size="20" value="" />
                                <label class="custom-file-label">Choose file</label>
                                <input type="hidden" class="form-control input-sm" name="image_old">
                                <small class="form-text text-muted">
                                    Max Files 1 MB | 500x500.</small>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-warning btn-square" id="add-item">Add More...</button> -->
                    <button type="submit" class="btn btn-primary btn-square" id="b_rotation_menu">Simpan</button>
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



        // $('.cat-menu').click(function() {
        //     var catId = $(this).attr('data-cat');
        //     var catName = $(this).attr('data-name');
        //     var rotation_id = $('input:hidden[name=rotation_id]').val();
        //     // alert(rotation_id);
        //     var url = "<= base_url('acs/ajax_rotation_detail/') ?>" + rotation_id + '/' + catId;
        //     $('input:hidden[name=cat_id]').val(catId);
        //     $('.title').text('List Menu ' + catName);
        //     // $.ajax({
        //     //     "url": url,
        //     //     "type": "POST",
        //     //     success: function(data) {
        //     //         // alert(data);
        //     //         console.log(data);
        //     //     }
        //     // });
        //     table = $('#tableData').DataTable({

        //         "processing": true, //Feature control the processing indicator.
        //         "serverSide": true, //Feature control DataTables' server-side processing mode.

        //         // Load data for the table's content from an Ajax source
        //         "ajax": {
        //             "url": url,
        //             "type": "POST"
        //         },
        //         "columnDefs": [{
        //             "targets": [-1], //last column
        //             "orderable": false, //set not orderable
        //         }, ],
        //     });
        // });

        $('#b_rotation_menu').click(function(e) {
            // e.preventDefault();
            var string = $("#f_rotation_menu").serialize();

            // alert(string);
            // $.ajax({
            //     url: "<= base_url('acs/save_rotations') ?>",
            //     method: "POST",
            //     dataType: "JSON",
            //     data: string,
            //     success: function(data) {
            //         // alert(data);
            //         if (data == "OK") {
            //             location.reload();
            //             $("#m_rotation_menu").modal('hide');
            //         }
            //     }
            // });

        });
        var name = $('input:text[name=name]');
        var description = $('input:text[name=description]');


        $('#b_rotation_menu').click(function(event) {
            var string = $("#f_rotation_menu").serialize();

        });


        var image_old = $('input:hidden[name=image_old]');

        $(".t_rotation_menu, .e_rotation_menu").click(function() {
            var id = $(this).attr("data-id");
            $("#m_rotation_menu").modal('show');
            judul(id);
            if (id != 0) {
                reqData(id);
            }

        });

        function reqData(id) {
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>acs/req_data/tbldetailrotations/" + id,
                dataType: "JSON",
                success: function(data) {
                    $('input:hidden[name=id]').val(data.id);
                    $('input:hidden[name=cat_id]').val(data.cat_id);
                    $('select[name=class_id]').select2('val', data.class_id);
                    $('input:text[name=header]').val(data.header);
                    $('select[name=menu_id]').trigger(data.menu);
                    var item = data.menu;
                    $.each(item.split(","), function(i, e) {
                        $("#select-menu option[value='" + e + "']").prop("selected", true).trigger('change');
                    });
                    image_old.val(data.image);
                    // console.log(data.image);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        }

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

        $('.backHistory').click(function() {
            location.href = "<?= base_url() ?>acs/rotations";
        });

        //fungsi judul modal
        function judul(id) {
            if (id != 0) {
                $(".modal-title").text("Form Edit Menu");
                $("#f_rotation_menu").attr('action', '<?= base_url() ?>acs/update/tbldetailrotations');
            } else {
                $(".modal-title").text("Form Add Menu ");
                $("#f_rotation_menu").attr('action', '<?= base_url() ?>acs/add/tbldetailrotations');
            }
        }

        $(".v_image").click(function() {
            var id = $(this).attr("data-id");
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>acs/req_data/tbldetailrotations/" + id,
                dataType: "JSON",
                success: function(data) {
                    $("#m_image").modal('show');
                    var gambar = data.image;
                    $("#image-body").html("<img src='<?= base_url() ?>assets/images/uploads/detailmenusrotations/" + gambar + " '  />");
                    console.log(gambar);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        });

    });
</script>

<style>
    tr.odd td:first-child,
    tr.even td:first-child {
        padding-left: 4em;
        font-weight: bold;
    }
</style>