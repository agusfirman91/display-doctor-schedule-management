<div class="card">
    <div class="card-header">
        <div class="card-title">
            List Image Slide
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped datatables-basic" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Group Plasma</th>
                    <th>Description</th>
                    <th width="5%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($list_image_slide as $image_slide) {
                    ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td>
                        <a href="javascript:void(0);" data-id="<?= $image_slide->id; ?>" class="v_image">
                            <img style="width:50px;height:50px" src="<?= base_url('assets/images/uploads/') . $image_slide->name ?>" name="view-image" alt="image-files">
                        </a>
                    </td>
                    <td><?= $image_slide->plasma_name; ?></td>
                    <td><?= $image_slide->description; ?></td>
                    <td>
                        <a href="javascript:void(0);" class="e_image_slide" data-id="<?= $image_slide->id ?>" data-role="<?= $image_slide->name ?>" data-toggle="tooltip" data-placement="top" title="Edit image_slide">
                            <i class="align-middle" data-feather="edit"></i></a>
                        <a href="javascript:void(0);" class="d_image_slide" data-id="<?= $image_slide->id ?>" data-toggle="tooltip" data-placement="top" title="Delete image_slide">
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
        <button class='btn btn-primary btn-square t_image_slide' data-id='0'>Add Image Slide</button>
    </div>
</div>
<div class="modal fade" id="m_view_image" role="dialog">
    <div class="modal-dialog modal-sg">
        <div class="modal-body" id="image-body">
        </div>
    </div>
</div>

<div class="modal fade" id="m_image_slide" role="dialog">
    <div class="modal-dialog modal-sg">
        <form id="f_image_slide" class="form-horizontal" method="post" enctype="multipart/form-data">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center"></h4>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control input-sm" name="id">
                    <div class="form-group row">
                        <input type="hidden" class="form-control input-sm" name="id" value="">
                        <label class="col-sm-3 control-label">Slide Name</label>
                        <div class="col-sm-8">
                            <input type="file" class="input-sm" name="pic_name" size="20" value="" />
                            <input type="hidden" class="form-control input-sm" name="pic_old">
                            <small class="form-text text-muted">
                                Max Files 1 MB | 500x500.</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Deskripsi</label>
                        <div class="col-sm-8">
                            <input type="text" class="input-sm form-control" name="description" size="30" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Plasma Group</label>
                        <div class="col-sm-4">
                            <select name="plasma_id" class="form-control input-sm custom-select">
                                <option value="">== Please Select ==</option>
                                <?php
                                foreach ($list_plasma as $plasma) {
                                    ?>
                                <option value="<?= $plasma->id ?>"><?= $plasma->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-square" id="b_image_slide">Simpan</button>
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
        var description = $('input:text[name=description]');
        var pic_name = $('input:file[name=pic_name]');
        var pic_old = $('input:text[name=pic_old]');
        var plasma_id = $('select[name=plasma_id]');

        $('#b_image_slide').click(function(event) {
            var string = $("#f_image_slide").serialize();

            if (plasma_id.val().length == 0) {
                plasma_id.focus();
                return false;
            }
        });



        $(".v_image").click(function() {
            var id = $(this).attr("data-id");
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>main/req_data/image_slide/" + id,
                dataType: "JSON",
                success: function(data) {
                    $("#m_view_image").modal('show');
                    var gambar = data.name;
                    $("#image-body").html("<img src='<?= base_url() ?>assets/images/uploads/" + data.name + " '  />");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        });
        $(".t_image_slide,.e_image_slide").click(function() {
            var id = $(this).attr("data-id");
            judul(id);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>main/req_data/image_slide/" + id,
                dataType: "JSON",
                success: function(data) {
                    $("#m_image_slide").modal('show');
                    $('input:hidden[name=id]').val(data.id);
                    pic_old.val(data.name);
                    description.val(data.description);
                    plasma_id.val(data.plasma_id);
                    // alert(data.name);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        });


        $(".d_image_slide").click(function() {
            var id = $(this).attr("data-id");
            var pilih = confirm('Ar you sure ?');
            if (pilih == true) {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url() ?>main/delete/image_slide/" + id,
                    data: "id=" + id,
                    success: function(data) {
                        location.reload();
                    }
                });
            }
        });

        function judul(id) {
            if (id != 0) {
                $(".modal-title").text("Form Edit image_slide");
                $("#f_image_slide").attr('action', '<?= base_url() ?>main/update/image_slide');
            } else {
                $(".modal-title").text("Form Add image_slide ");
                $("#f_image_slide").attr('action', '<?= base_url() ?>main/add/image_slide');
            }
        }



    });
</script>