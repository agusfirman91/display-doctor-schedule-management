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
                <ul class="menuList">
                    <?php foreach ($list_menus as $menu) : ?>
                        <li class="roleMenu">
                            <a href="#access_<?= $menu->link; ?>" class="collapsed menu" data-toggle="collapse">
                                <i class="fas fa-plus-circle"></i>
                            </a>
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

                            <input type="checkbox" name="menus[]" value="<?php echo $menu->id; ?>" <?php echo $checked; ?> <?= set_checkbox('menus[]', $menu->id); ?>>
                            <label class="control-label">
                                <?= ucwords($menu->name) ?></label>
                            <ul id="access_<?= $menu->link; ?>" class="sidebar-dropdown list-unstyled collapse submenu">
                                <?php foreach ($menu->parent_menu as $parent_menu) : ?>
                                    <li class="nested">
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
                                        <input type="checkbox" name="menus[]" class="control-input" value="<?php echo $parent_menu->id; ?>" <?php echo $checked; ?> <?= set_checkbox('menus[]', $menu->id); ?>>
                                        <label class="control-label"><?= ucwords($parent_menu->name) ?>
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

    /* li.roleMenu {
        margin-top: 1em;
    } */

    label {
        font-weight: bold;
    }

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
<script>
    // const form = document.querySeletor('form');
    // const checkbox = document.querySeletor('input:[type:checkbox]');
    // checkbox.indeterminate = true;
    // checkbox.value = 'indeterminate';
    // form.addEventListener('submit', () => {
    //     if (checkbox.indeterminate) {
    //         checkbox.checked = true;
    //     } else {
    //         checkbox.value = 'on'
    //     }
    // }, false);

    $(document).ready(function() {
        $('ul.menuList input[type="checkbox"]').change(function(e) {

            var checked = $(this).prop("checked"),
                container = $(this).parent(),
                siblings = container.siblings();

            container.find('input[type="checkbox"]').prop({
                indeterminate: false,
                checked: checked
            });

            function checkSiblings(el) {

                var parent = el.parent().parent(),
                    all = true;

                el.siblings().each(function() {
                    let returnValue = all = ($(this).children('input[type="checkbox"]').prop("checked") === checked);
                    return returnValue;
                });

                if (all && checked) {

                    parent.children('input[type="checkbox"]').prop({
                        indeterminate: false,
                        checked: checked
                    });

                    checkSiblings(parent);

                } else if (all && !checked) {

                    parent.children('input[type="checkbox"]').prop("checked", checked);
                    parent.children('input[type="checkbox"]').prop("indeterminate", (parent.find('input[type="checkbox"]:checked').length > 0));
                    checkSiblings(parent);

                } else {

                    el.parents("li").children('input[type="checkbox"]').prop({
                        indeterminate: true,
                        checked: false
                    });

                }

            }

            checkSiblings(container);
        });
    });

    jQuery('.menu').click(function() {
        var icon = jQuery(this).find('svg');
        if (icon.attr('data-icon') == 'plus-circle') {
            icon.attr('data-icon', 'minus-circle');
        } else {
            icon.attr('data-icon', 'plus-circle');
        }
    });
</script>