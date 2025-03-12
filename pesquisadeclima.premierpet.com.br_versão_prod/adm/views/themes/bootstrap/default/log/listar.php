<!-- Content -->
<div class="content-wrapper">
  <section class="content-header">
    <!-- Content -->
    <h1 style="color:#0099cc;"><i class="fa fa-user" aria-hidden="true"></i> Pessoas</h1>
    <br>
    <div class="box box-Purple " >
      <div class="box-header with-border">
        <h3 class="box-title">Filtro</h3>
      </div>
      <div class="box-body">
        <!-- Table -->
        <form id="listagem" action="<?php echo URL . "chave/xhrGetListings"; ?>" method="post">
          <input type="hidden" name="pg" id="pg" value="1" />

          <div class="col-md-5 form-group">
              <label>Empresa</label>
               <?php echo Func::comboEmpresa(0, "empresa", false, $this->instanceDB, " AND (id < 5 OR id = 12)", false, false); ?>
            </div>

          <div class="col-md-7 form-group">
              <label>Descrição Log</label>
              <input type="text" name="descricao" id="descricao" class="form-control" />
          </div>
            
        </form>

        <!-- Table -->
      </div>
    </div>
    <!-- /.box -->

    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Listagem</h3>
      </div>
      <div class="box-body">
        <div id="list"></div>
        <!-- Table -->
      </div>
    </div>
    <!-- /.box -->

    <!-- Content -->
  </section>
</div>
<!-- Content -->

