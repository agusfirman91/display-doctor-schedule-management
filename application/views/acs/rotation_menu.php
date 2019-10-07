<div class="card">
    <div class="card-header">
        <div class="card-title">
            List Rotations Menu
            <b><?= $list_rotations[0]->name; ?></b>
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
                foreach ($list_rotations_menu as $rotation_menu) {
                    ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><a href="<?= base_url('acs/rotation_menus/') . $rotation_menu->id ?>"> <?= $rotation_menu->name; ?></a></td>
                        <td><?= $rotation_menu->description; ?></td>
                        <td>
                            <a href="javascript:void(0);" class="e_rotation_menu" data-id="<?= $rotation_menu->id ?>" data-role="<?= $rotation_menu->name ?>" data-toggle="tooltip" data-placement="top" title="Edit rotation_menu">
                                <i class="align-middle" data-feather="edit"></i></a>
                            <a href="javascript:void(0);" class="d_rotation_menu" data-id="<?= $rotation_menu->id ?>" data-toggle="tooltip" data-placement="top" title="Delete rotation_menu">
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
        <button class='btn btn-primary btn-square t_rotation_menu' data-id='0'>Add Menu</button>
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
                    <div class="tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <?php
                            foreach ($list_category_menu as $cat) {
                                ?>
                                <li class="nav-item"><a class="nav-link" href="#tab-1" data-toggle="tab" role="tab" aria-selected="true"><?= $cat->name ?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-1" role="tabpanel">
                                <h4 class="tab-title">Default tabs</h4>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor tellus eget condimentum rhoncus. Aenean massa. Cum sociis natoque
                                    penatibus et magnis neque dis parturient montes, nascetur ridiculus mus.</p>
                                <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate
                                    eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>
                            </div>
                            <div class="tab-pane" id="tab-2" role="tabpanel">
                                <h4 class="tab-title">Another one</h4>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor tellus eget condimentum rhoncus. Aenean massa. Cum sociis natoque
                                    penatibus et magnis neque dis parturient montes, nascetur ridiculus mus.</p>
                                <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate
                                    eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>
                            </div>
                            <div class="tab-pane" id="tab-3" role="tabpanel">
                                <h4 class="tab-title">One more</h4>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor tellus eget condimentum rhoncus. Aenean massa. Cum sociis natoque
                                    penatibus et magnis neque dis parturient montes, nascetur ridiculus mus.</p>
                                <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate
                                    eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>
                            </div>
                        </div>
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

        $('#b_rotation_menu').click(function(event) {
            var string = $("#f_rotation_menu").serialize();

            if (name.val().length == 0) {
                name.focus();
                return false;
            }
        });


        $(".t_rotation_menu,.e_rotation_menu").click(function() {
            var id = $(this).attr("data-id");
            judul(id);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>acs/req_data/tblrotation_menus/" + id,
                dataType: "JSON",
                success: function(data) {
                    $("#m_rotation_menu").modal('show');
                    $('input:hidden[name=id]').val(data.id);
                    name.val(data.name);
                    description.val(data.description);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
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
        function judul(id) {
            if (id != 0) {
                $(".modal-title").text("Form Edit Menu");
                $("#f_rotation_menu").attr('action', '<?= base_url() ?>acs/update/tblrotation_menus');
            } else {
                $(".modal-title").text("Form Add Menu ");
                $("#f_rotation_menu").attr('action', '<?= base_url() ?>acs/add/tblrotation_menus');
            }
        }


    });
</script>