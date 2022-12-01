<style>
    .carousel-item>img {
        object-fit: cover !important;
    }

    #carouselExampleControls .carousel-inner {
        height: 25em !important;
    }
</style>
<div class="container mt-1">
    <div class="content py-5 px-3 bg-info">
        <h3><b>Formulario de Solicitud de Servicios</b></h3>
    </div>
    <div class="row mt-lg-n4 mt-md-n4 justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12 mb-3">
            <div class="card rounded-0">
                <div class="card-body">
                    <form id="quote-form">
                        <input type="hidden" name="id" value="">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="fullname" class="control-label">Nombre Completo <small class="text-danger">*</small></label>
                                    <input type="text" name="fullname" id="fullname" class="form-control form-control-sm rounded-0" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="contact" class="control-label"># Contacto<small class="text-danger">*</small></label>
                                    <input type="text" name="contact" id="contact" class="form-control form-control-sm rounded-0" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="email" class="control-label">Correo</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-sm rounded-0">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="address" class="control-label">Dirección <small class="text-muted"><i>(¿Lugar donde se prestará el servicio a domicilio?)</i></small> <small class="text-danger">*</small></label>
                                    <textarea style="resize:none" rows="2" name="address" id="address" class="form-control form-control-sm rounded-0" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="service_ids" class="control-label">Servicio a Solicitar <small class="text-danger">*</small></label>
                                    <select name="service_ids[]" multiple id="service_ids" class="form-control form-control-sm rounded-0" required>
                                        <?php
                                        $services = $conn->query("SELECT * FROM `service_list` where `status` = 1 and delete_flag = 0 order by `name` asc");
                                        while ($row = $services->fetch_assoc()) :
                                        ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="schedule" class="control-label">Agendar Cita <small class="text-danger">*</small></label>
                                    <input type="date" name="schedule" id="schedule" class="form-control form-control-sm rounded-0" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="remarks" class="control-label">Observaciones <small class="text-muted"><i>Cualquier información adicional, favor indicarla en el campo a continuación</i></small> <small class="text-danger">*</small></label>
                                    <textarea style="resize:none" rows="5" name="remarks" id="remarks" class="form-control form-control-sm rounded-0" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                <button class="btn btn-primary border-0 btn-block rounded-pill btn-lg bg-info">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#service_ids').select2({
            placeholder: "Selecciona tu servicio aquí",
            width: '100%',
            containerCssClass: 'rounded-0'
        })
        $('#quote-form').submit(function(e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_quote",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: err => {
                    console.log(err)
                    alert_toast("Ocurrió un error", 'error');
                    end_loader();
                },
                success: function(resp) {
                    if (typeof resp == 'object' && resp.status == 'success') {
                        location.reload()
                    } else if (resp.status == 'failed' && !!resp.msg) {
                        var el = $('<div>')
                        el.addClass("alert alert-danger err-msg").text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                        $("html, body").scrollTop(0);
                        end_loader()
                    } else {
                        alert_toast("Ocurrió un error", 'error');
                        end_loader();
                        console.log(resp)
                    }
                }
            })
        })
    })
</script>