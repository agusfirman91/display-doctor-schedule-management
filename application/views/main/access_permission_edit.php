<div class="card">
    <div class="card-header">
        <div class="card-title">Edit Group Permission
            <div class="float-right">
                <form class="form-horizontal" method="post">
                    <button type="submit" class="btn btn-primary btn-square">Simpan</button>
                    <button type="button" class="btn btn-danger btn-square" onclick="javascript:history.back()">Batal</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <input type="hidden" class="form-control input-sm" name="id" value="">
            <label class="col-3 control-label">Permission Name</label>
            <div class="col-4">
                <input type="text" class="form-control input-sm" name="name" value="<?= $currentGroup->name ?>">
                <span class="text-danger"><?= form_error('name'); ?></span>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-3 control-label">Permission Role</label>
            <div class="col-8">
                <ul>
                    <style>
                        .menu {
                            margin-left: -15px;
                            color: #333
                        }

                        .submenu {
                            margin-left: 20px
                        }

                        .option {
                            margin-top: -22px
                        }
                    </style>
                    <?php foreach ($list_menus as $menu) : ?>
                    <li class="roleMenu">
                        <a href="#access_<?= $menu->link; ?>" class="collapsed menu" data-toggle="collapse">
                            <i class="fas fa-plus-circle"></i>
                        </a>
                        <label class="custom-control custom-checkbox option">
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

                            <input type="checkbox" name="menus[]" class="custom-control-input" value="<?php echo $menu->id; ?>" <?php echo $checked; ?> <?= set_checkbox('menus[]', $menu->id); ?>>
                            <span class="custom-control-label">
                                <?= ucwords($menu->name) ?></span>
                        </label>
                        <ul id="access_<?= $menu->link; ?>" class="sidebar-dropdown list-unstyled collapse submenu">
                            <?php foreach ($menu->parent_menu as $parent_menu) : ?>
                            <li class="nested">
                                <label class="custom-control custom-checkbox">
                                    <?php
                                            $gID = $parent_menu->id;
                                            $checked = null;
                                            $item = null;
                                            foreach ($currentMenus as $pmn) {
                                                if ($gID == $pmn->id) {
                                                    $checked = ' checked="checked"';
                                                    break;
                                                }
                                            }
                                            ?>
                                    <input type="checkbox" name="menus[]" class="custom-control-input" value="<?php echo $parent_menu->id; ?>" <?php echo $checked; ?> <?= set_checkbox('menus[]', $menu->id); ?>>
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

    <?php echo form_hidden('id', $currentGroup->id); ?>
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
    $('.menu').click(function() {
        $(this).find("i").toggleClass("fa-truck");
        // $(this).find('i').toggleClass('fa-plus-circle fa-minus-circle')
    });
    // $('.menu').blur(function() {
    //     $(this).find('i').toggleClass('fa-plus-circle fa-minus-circle')
    // });
    // $('.menu').click(function() {
    //     icon = $(this).find("i");
    //     // icon.hasClass("fa-minus-circle");
    //     icon.toggleClass("fa-plus-circle fa-minus-circle");
    //     // } else {
    //     //     icon.addClass("fa-minus-circle ").removeClass("fa-plus-circle");

    //     // }
    //     // $('ul .sidebar-dropdown').toggle('1000');
    //     // $(this).toggleClass("fa-minus-circle");
    // });
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