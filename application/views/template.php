<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
	<meta name="author" content="Bootlab">
	<title>Main Applications</title>
	<link rel="shortcut icon" src="<?= base_url('assets/images/uploads/') . $setting->image_icon; ?>" type="image/x-icon" />
	<link href="<?= base_url('assets/css/app.css') ?>" rel="stylesheet">

	<link href="<?php echo base_url() ?>assets/css/sweetalert2.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/font-awesome.css">

	<script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
	<script src="<?= base_url() ?>assets/js/sweetalert2.js"></script>
	<script src="<?= base_url() ?>assets/treeview/simTree.js"></script>
</head>

<body>
	<div class="wrapper">
		<nav class="sidebar">
			<div class="sidebar-content">
				<a class="sidebar-brand" href="<?= base_url() ?>home" target="_blank">
					<img src="<?= base_url('assets/images/uploads/') . $setting->image_icon; ?>" alt="" style="width:50px;height:50px">
					<span class="align-middle">Display Apps</span>
				</a>
				<ul class="sidebar-nav">
					<?php foreach ($list_menus_access as $menu) : ?>
						<li class="sidebar-item">
							<a href="#<?= $menu->link; ?>" data-toggle="collapse" class="sidebar-link collapsed">
								<i class="align-middle" data-feather="<?= $menu->icon  ?>"></i> <span class="align-middle"><?= ucwords($menu->name); ?></span>
							</a>
							<ul id="<?= $menu->link; ?>" class="sidebar-dropdown list-unstyled collapse ">

								<?php foreach ($menu->parent_menu as $parent_menu) : ?>
									<li class="sidebar-item">
										<a class="sidebar-link" href="<?= base_url() . $parent_menu->link ?>"><?= ucwords($parent_menu->name) ?></a>
									</li>
								<?php endforeach ?>
							</ul>
						</li>
					<?php endforeach ?>
				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light bg-white">
				<a class="sidebar-toggle d-flex mr-2">
					<i class="hamburger align-self-center"></i>
				</a>
				<div class="navbar-collapse collapse">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
								<i class="align-middle" data-feather="settings"></i>
							</a>
							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
								<span class="text-dark"><?= ucwords($this->session->userdata('user_name')); ?></span>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="<?= base_url() ?>main/change-password">Ganti Password </a>
								<a class="dropdown-item" href="<?= base_url() ?>main/logout">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">
					<?= $contents; ?>
				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-12 text-right">
							<p class="mb-0">
								&copy; 2019 - <a href="#" class="text-muted">Display Apps System Management</a>
							</p>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="<?= base_url('assets/js/app.js') ?>"></script>

	<script src="<?= base_url() ?>assets/js/dataTables.rowGroup.min.js"></script>
	<script src="<?= base_url('assets/js/dataTables.bootstrap4.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/dataTables.buttons.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/buttons.bootstrap4.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/jszip.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/pdfmake.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/vfs_fonts.js') ?>"></script>
	<script src="<?= base_url('assets/js/buttons.html5.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/buttons.print.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/buttons.colVis.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/dataTables.buttons.min.js') ?>"></script>

	<script>
		// (function() {
		// 	$(document).ready(function() {
		// 		$('#navbox-trigger').click(function() {
		// 			return $('#navigation-bar').toggleClass('navbox-open');
		// 		});
		// 		return $(document).on('click', function(e) {
		// 			var $target;
		// 			$target = $(e.target);
		// 			if (!$target.closest('.navbox').length && !$target.closest('#navbox-trigger').length) {
		// 				return $('#navigation-bar').removeClass('navbox-open');
		// 			}
		// 		});
		// 	});
		// }.call(this));

		$(function() {
			$(".datatables-basic").DataTable({
				responsive: true
			});

			$('.datatables-menu').DataTable({
				order: [
					[0, 'asc'],
					[1, 'asc']
				],
				rowGroup: {
					dataSrc: [0, 1]
				},
				columnDefs: [{
					targets: [0, 1],
					visible: false
				}]
			});

			$(".select2").each(function() {
				$(this)
					.wrap("<div class=\"position-relative\"></div>")
					.select2({
						placeholder: "Silahkan Pilih",
						dropdownParent: $(this).parent()
					});
			});


			$(".select-add-items").select2({
				tags: true,
				placeholder: "Silahkan Input",
				tokenSeparators: [',', ' ']
			});

		});
	</script>
</body>

</html>