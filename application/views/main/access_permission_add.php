<div class="card">
    <div class="card-header">
        <div class="card-title">Add Group Permission
            <form class="form-horizontal" method="post">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary btn-square">Simpan</button>
                    <button type="button" class="btn btn-danger btn-square" onclick="javascript:history.back()">Batal</button>
                </div>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label class="col-3 control-label">Permission Name</label>
            <div class="col-4">
                <input type="text" class="form-control input-sm" name="name" value="<?= set_value('name') ?>">
                <span class="text-danger"><?= form_error('name'); ?></span>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-3 control-label">Permission Role</label>
            <div class="col-8">
                <ul>
                    <?php foreach ($list_menus as $menu) : ?>
                        <li class="roleMenu">
                            <label class="custom-control custom-checkbox option">
                                <input type="checkbox" name="menus[]" class="custom-control-input" value="<?php echo $menu->id; ?>" <?= set_checkbox('menus[]', $menu->id); ?>>
                                <span class="custom-control-label">
                                    <?= ucwords($menu->name) ?></span>
                            </label>
                            <ul>
                                <?php foreach ($menu->parent_menu as $parent_menu) : ?>
                                    <li class="nested">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" name="menus[]" class="custom-control-input" value="<?php echo $parent_menu->id; ?>" <?= set_checkbox('menus[]', $menu->id); ?>>
                                            <span class="custom-control-label"><?= ucwords($parent_menu->name) ?></span>
                                        </label>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
        </form>
    </div>

    <?php //echo form_hidden($csrf); 
    ?>


</div>
<style>
    ul {
        list-style: none;
    }

    li.roleMenu {
        margin-top: 1em;
    }

    label {
        font-weight: bold;
    }
</style>
<script>
    $('li :checkbox').on('click', function() {
        var $chk = $(this),
            $li = $chk.closest('li'),
            $ul, $parent;
        if ($li.has('ul')) {
            $li.find(':checkbox').not(this).prop('checked', this.checked)
        }
        do {
            $ul = $li.parent();
            $parent = $ul.siblings(':checkbox');
            if ($chk.is(':checked')) {
                $parent.prop('checked', $ul.has(':checkbox:not(:checked)').length == 0)
            } else {
                $parent.prop('checked', false)
            }
            $chk = $parent;
            $li = $chk.closest('li');
        } while ($ul.is(':not(.someclass)'));
    });
</script>