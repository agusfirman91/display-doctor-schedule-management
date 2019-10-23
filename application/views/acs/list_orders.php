<div class="card">
    <div class="card-header">
        <div class="card-title">
            List Orders
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped datatables-basic" style="width:100%">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>No RM</th>
                    <th>Nama Pasien</th>
                    <th>Menu Breakfast</th>
                    <th>Menu Lunch</th>
                    <th>Menu Dinner</th>
                    <th>Description</th>
                    <th width="5%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $no = 1;
                foreach ($list_orders as $order) {
                    ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $order->no_rm; ?></td>
                        <td><?= $order->nama; ?></td>
                        <td>
                            <?php foreach ($order->menu_1 as $menu) : ?>
                                <?= $menu->name ?>
                            <?php endforeach ?>
                        </td>
                        <td>
                            <?php foreach ($order->menu_2 as $menu) : ?>
                                <?= $menu->name ?>
                            <?php endforeach ?>
                        </td>
                        <td>
                            <?php foreach ($order->menu_3 as $menu) : ?>
                                <?= $menu->name ?>
                            <?php endforeach ?>
                        </td>
                        <td><?= $order->description; ?></td>
                        <td>
                            <a href="javascript:void(0);" class="d_order" data-id="<?= $order->id ?>" data-toggle="tooltip" data-placement="top" title="Delete order">
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
        <a class='btn btn-primary btn-square t_order' href="<?= base_url() ?>acs/create-orders">New Order</a>
    </div>


    <div class="modal fade" id="v_menu" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-sg">
            <div class="modal-body" id="image-body">
            </div>
        </div>
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
        var image_old = $('input:text[name=image_old]');

        $('#b_order').click(function(event) {
            var string = $("#f_order").serialize();

            if (name.val().length == 0) {
                name.focus();
                return false;
            }
        });

        $('.select2').select2();


        $(".v_menu").click(function() {
            var id = $(this).attr("data-id");
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>acs/req_data/tblmenus/" + id,
                dataType: "JSON",
                success: function(data) {
                    $("#m_image").modal('show');
                    var gambar = data.image;
                    $("#image-body").html("<img src='<?= base_url() ?>assets/images/uploads/orders/" + gambar + " '  />");
                    // console.log(gambar);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        });

        $(".t_order,.e_order").click(function() {
            var id = $(this).attr("data-id");
            judul(id);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>acs/req_data/tblorders/" + id,
                dataType: "JSON",
                success: function(data) {
                    $("#m_order").modal('show');
                    $('input:hidden[name=id]').val(data.id);
                    name.val(data.name);
                    image_old.val(data.image);
                    description.val(data.description);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        });


        $(".d_order").click(function() {
            var id = $(this).attr("data-id");
            var pilih = confirm('Data yang akan dihapus  = ' + id + '?');
            if (pilih == true) {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url() ?>acs/delete/tblorders/" + id,
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
                $("#f_order").attr('action', '<?= base_url() ?>acs/update/tblorders');
            } else {
                $(".modal-title").text("Form Add Menu ");
                $("#f_order").attr('action', '<?= base_url() ?>acs/add/tblorders');
            }
        }


    });
</script>