<div class="card">
    <div class="card-header">
        <div class="card-title">
            Data Users
        </div>
        <div class="alert alert-primary alert-outline alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="alert-icon">
                <i class="far fa-fw fa-bell"></i>
            </div>
            <div class="alert-message">
                <strong>Klik Username!</strong> untuk reset password
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped datatables-basic" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Group</th>
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
                                            <input type="checkbox" class="custom-control-input" name="toggle_user" id=' . $id . ' class="info" data-toggle="' . $param_name . '" value="1">
                                            <span class="custom-control-label"></span>
                                        </label>';
                    } else {
                        $v_checkbox = '<label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="toggle_user" id=' . $id . ' class="info" data-toggle="' . $param_name . '" value="0" checked>
                                            <span class="custom-control-label"></span>
                                        </label>';
                    }
                    return $v_checkbox;
                }
                $no = 1;
                foreach ($list_user as $user) {
                    ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><a href="#" class="user_reset_password" data-id="<?= $user->id ?>"> <?= $user->username; ?></a> </td>
                    <td>
                        <?php foreach ($user->groups as $group) : ?>
                        <?= $group->name ?>
                        <?php endforeach ?>
                    </td>
                    <td><?= v_checkbox($user->id, 'is_active', $user->is_active); ?></td>
                    <td>
                        <a href="javascript:void(0);" class="e_user" data-id="<?= $user->id ?>" data-role="<?= $user->username ?>" data-toggle="tooltip" data-placement="top" title="Edit user">
                            <i class="align-middle" data-feather="edit"></i>
                        </a>
                        <a href="javascript:void(0);" class="d_user" data-id="<?= $user->id ?>" data-toggle="tooltip" data-placement="top" title="Delete user">
                            <i class="align-middle" data-feather="delete"></i>
                        </a>
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
        <button class='btn btn-primary btn-square t_user' data-id='0'>Add Users</button>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="m_user_reset" tabindex="-1" role="dialog" aria-labelledby="m_user_resetLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <form id="f_user_reset" class="form-horizontal" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Reset Password User</h4>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <input type="hidden" class="form-control input-sm" name="id_reset_user" value="">
                        <label class="col-sm-4 control-label">Password Baru</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control input-sm" name="passwordNew" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Konfirmasi Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control input-sm" name="passwordConfirm" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-square" id="b_user_reset">Simpan</button>
                    <button type="button" class="btn btn-danger btn-square" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="m_user" role="dialog">
    <div class="modal-dialog modal-sg">
        <form id="f_user" class="form-horizontal" method="post">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center"></h4>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <input type="hidden" class="form-control input-sm" name="id" value="">
                        <label class="col-sm-3 control-label">NIK</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control input-sm" name="nik" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Username</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-sm" name="username" value="">
                        </div>
                    </div>
                    <div class="form-group row" id="form-pasword">
                        <label class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control input-sm" name="password" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">User Role</label>
                        <div class="col-sm-4">
                            <select name="user_group" class="form-control input-sm">
                                <option value="">== Please Select ==</option>
                                <?php
                                foreach ($groups as $group) {
                                    ?>
                                <option value="<?= $group->id ?>"><?= $group->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-square" id="b_user">Simpan</button>
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
        var id = $('input:text[name=id]');
        var nik = $('input:text[name=nik]');
        var username = $('input:text[name=username]');
        var password = $('input:password[name=password]');
        var user_group = $('select[name=user_group]');

        $('#b_user').click(function(event) {
            var string = $("#f_user").serialize();

            if (nik.val().length == 0) {
                nik.focus();
                return false;
            }
            if (username.val().length == 0) {
                username.focus();
                return false;
            }
            if (user_group.val().length == 0) {
                user_group.focus();
                return false;
            }
        });


        $(".e_user").click(function() {
            $("#form-pasword").hide();
        });
        $(".t_user").click(function() {
            $("#form-pasword").show();
        });

        $(".t_user, .e_user").click(function() {
            var id = $(this).attr("data-id");
            var role_name = $(this).attr("data-role");
            $('input[name=role_name]').val(role_name);
            judul(id);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>main/req_data/user/" + id,
                dataType: "JSON",
                success: function(data) {
                    $("#m_user").modal('show');
                    // alert(data.nik);
                    $('input:hidden[name=id]').val(data.id);
                    nik.val(data.nik);
                    username.val(data.username);
                    user_group.val(data.group_id);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        });


        $(".user_reset_password").click(function() {
            $('input:password[name=passwordNew]').focus();
            $("#m_user_reset").modal('show');
            var id = $(this).attr("data-id");
            $("#f_user_reset").attr('action', '<?= base_url() ?>main/reset/user/' + id);

        });

        $(".d_user").click(function() {
            var id = $(this).attr("data-id");
            var pilih = confirm('Data yang akan dihuserus  = ' + id + '?');
            if (pilih == true) {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url() ?>main/delete/user/" + id,
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
                $(".modal-title").text("Form Edit User");
                $("#f_user").attr('action', '<?= base_url() ?>main/update/user');
            } else {
                $(".modal-title").text("Form Add User ");
                $("#f_user").attr('action', '<?= base_url() ?>main/add/user');
            }
        }

        $('input[name=toggle_user]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).attr('id');
            var toggle = $(this).attr('data-toggle');
            var value = $(this).attr('value');
            // alert(id+'-'+value+'-'+toggle);
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: '<?= base_url() ?>main/do_switch/user',
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