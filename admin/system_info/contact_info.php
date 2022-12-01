<?php if ($_settings->chk_flashdata('success')) : ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<div class="content py-5 px-3 bg-info">
    <h2><b>Información de Contacto</b></h2>
</div>
<div class="row mt-lg-n4 mt-md-n4 justify-content-center">
    <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
        <div class="card rounded-0 shadow">
            <div class="card-body">
                <form action="" id="system-frm">
                    <div id="msg" class="form-group"></div>
                    <div class="form-group">
                        <label for="phone" class="control-label"># Teléfono</label>
                        <input type="text" class="form-control form-control-sm rounded-0" name="phone" id="phone" value="<?php echo $_settings->info('phone') ?>">
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="control-label"># Móvil</label>
                        <input type="text" class="form-control form-control-sm rounded-0" name="mobile" id="mobile" value="<?php echo $_settings->info('mobile') ?>">
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Correo</label>
                        <input type="email" class="form-control form-control-sm rounded-0" name="email" id="email" value="<?php echo $_settings->info('email') ?>">
                    </div>
                    <div class="form-group">
                        <label for="address" class="control-label">Dirección</label>
                        <textarea row="3" class="form-control form-control-sm rounded-0" name="address" id="address"><?php echo $_settings->info('address') ?></textarea>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="col-md-12">
                    <div class="row">
                        <button class="btn btn-sm btn-primary btn-flat  bg-info border-0" form="system-frm">Actualizar</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>

</script>