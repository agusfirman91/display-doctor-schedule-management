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
                            <a href="#access_<?= $menu->link; ?>" class="collapsed menu-collapse" data-toggle="collapse">
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

                                <input type="checkbox" name="menus[]" value="<?php echo $menu->id; ?>" <?php echo $checked; ?> <?= set_checkbox('menus[]', $menu->id); ?> class="custom-control-input">
                                <span class="custom-control-label"><?= ucwords($menu->name) ?></span>
                            </label>
                            <ul id="access_<?= $menu->link; ?>" class="sidebar-dropdown list-unstyled collapse submenu">
                                <?php foreach ($menu->parent_menu as $parent_menu) : ?>
                                    <li class="nested">
                                        <label class="custom-control custom-checkbox option">
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
    <!-- simtreee  -->
    <div id="result"></div>

    <!-- end simtree  -->

    <input type="button" id="btnGet" value="Get" class="btn btn-primary" />
</div>



<style>
    ul {
        list-style: none;
    }

    .menu-collapse {
        margin-left: -15px;
        position: absolute
    }

    .submenu {
        margin-left: 20px
    }

    .option {
        margin-top: 5px
    }
</style>


<link href="<?= base_url() ?>assets/treeview/simTree.css">
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>assets/js/jquery.js"></script>
<script src="<?= base_url() ?>assets/treeview/simTree.js"></script>

<script>
    var list = [{
            "id": '1',
            "pid": '',
            "name": "JavaScript",
        },
        {
            "id": '11',
            "pid": '1', // parent ID
            "name": "Angular"
        },
        {
            "id": '12',
            "pid": '1',
            "name": "React"
        }, {
            "id": '13',
            "pid": '1',
            "name": "Vuejs"
        }, {
            "id": '14',
            "pid": '1',
            "name": "jQueryScript.Net"
        },
        {
            "id": '2',
            "pid": '',
            "name": "HTML5"
        },
        {
            "id": '3',
            "pid": '',
            "name": "CSS3"
        }
    ];
    var tree = simTree({
        el: '#tree',
        data: list,
        check: true,
        linkParent: true,
        //check: true,
        onClick: function(item) {
            console.log(item)
        },
        onChange: function(item) {
            console.log(item)
        }
    });
</script>
<script>
    $(document).ready(function() {
        $("#btnGet").click(function() {
            5
            var selected = new Array();
            $(function() {
                $('input[type="checkbox"]').change(function(e) {
                    var checked = $(this).prop("checked"),
                        container = $(this).closest("li"),
                        siblings = container.siblings();
                    selected.push(this.value);
                    container.find('input[type="checkbox"]').prop({
                        indeterminate: false,
                        checked: checked,

                    });

                    function checkSiblings(el) {
                        var parent = el.parent().parent(),
                            all = true,
                            parentcheck = parent.children("label");
                        el.siblings().each(function() {
                            return all = ($(this).find('input[type="checkbox"]').prop("checked") === checked);
                        });
                        if (all && checked) {
                            parentcheck.children('input[type="checkbox"]').prop({
                                indeterminate: false,
                                checked: checked
                            });
                            checkSiblings(parent);
                        } else if (all && !checked) {
                            parentcheck.children('input[type="checkbox"]').prop("checked", checked);
                            parentcheck.children('input[type="checkbox"]').prop("indeterminate", (parent.find('input[type="checkbox"]:checked').length > 0));
                            checkSiblings(parent);
                            // array.push(parseInt($(this).val()));
                        } else {
                            parentcheck.children('input[type="checkbox"]').prop({
                                indeterminate: true,
                                checked: false
                            });
                        }
                    }
                    checkSiblings(container);
                });
                if (selected.length > 0) {
                    alert("Selected values: " + selected.join(","));
                }
            });
        });
    });

    jQuery('.menu-collapse').click(function() {
        var icon = jQuery(this).find('svg');
        if (icon.attr('data-icon') == 'plus-circle') {
            icon.attr('data-icon', 'minus-circle');
        } else {
            icon.attr('data-icon', 'plus-circle');
        }
    });
</script>