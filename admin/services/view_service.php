<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
	$qry = $conn->query("SELECT * from `service_list` where id = '{$_GET['id']}' and delete_flag = 0 ");
	if ($qry->num_rows > 0) {
		foreach ($qry->fetch_assoc() as $k => $v) {
			$$k = $v;
		}
	} else {
		echo '<script>alert("ID de Servicio Inválido"); location.replace("./?page=services")</script>';
	}
} else {
	echo '<script>alert("ID de Servicio es Requerido"); location.replace("./?page=services")</script>';
}
?>
<style>
	#service-img {
		max-width: 100%;
		max-height: 35em;
		object-fit: scale-down;
		object-position: center center;
	}
</style>
<div class="content py-5 px-3 bg-info">
	<h2><b>Información de Servicio</b></h2>
</div>
<div class="row mt-lg-n4 mt-md-n4 justify-content-center">
	<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
		<div class="card rounded-0">
			<div class="card-body">
				<div class="container-fluid">
					<center>
						<img src="<?= validate_image(isset($image_path) ? $image_path : '') ?>" alt="<?= isset($name) ? $name : '' ?>" class="img-thumbnail p-0 border" id="service-img">
					</center>
					<dl>
						<dt class="text-muted">Nombre</dt>
						<dd class="pl-4"><?= isset($name) ? $name : "" ?></dd>
						<dt class="text-muted">Descripción</dt>
						<dd class="pl-4"><?= isset($description) ? str_replace(["\n\r", "\n", "\r"], "<br>", htmlspecialchars_decode($description)) : '' ?></dd>
						<dt class="text-muted">Estado</dt>
						<dd class="pl-4">
							<?php if ($status == 1) : ?>
								<span class="badge badge-success px-3 rounded-pill">Activo</span>
							<?php else : ?>
								<span class="badge badge-danger px-3 rounded-pill">Inactivo</span>
							<?php endif; ?>
						</dd>
					</dl>
				</div>
			</div>
			<div class="card-footer py-1 text-center">
				<button class="btn btn-danger btn-sm bg-danger rounded-0" type="button" id="delete_data"><i class="fa fa-trash"></i> Eliminar</button>
				<a class="btn btn-primary btn-sm bg-info rounded-0" href="./?page=services/manage_service&id=<?= isset($id) ? $id : '' ?>"><i class="fa fa-edit"></i> Editar</a>
				<a class="btn btn-light btn-sm bg-light border rounded-0" href="./?page=services"><i class="fa fa-angle-left"></i> Volver</a>
			</div>
		</div>
	</div>
</div>
<script>
	$(function() {
		$('#delete_data').click(function() {
			_conf("¿Deseas eliminar este servicio de forma permanente?", "delete_service", ["<?= isset($id) ? $id : '' ?>"])
		})
	})

	function delete_service($id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=delete_service",
			method: "POST",
			data: {
				id: $id
			},
			dataType: "json",
			error: err => {
				console.log(err)
				alert_toast("Ocurrió un error", 'error');
				end_loader();
			},
			success: function(resp) {
				if (typeof resp == 'object' && resp.status == 'success') {
					location.replace("./?page=services");
				} else {
					alert_toast("Ocurrió un error", 'error');
					end_loader();
				}
			}
		})
	}
</script>