<!-- Content -->

<div class="content-wrapper">
  <section class="content-header"> 
    <!-- Content -->
    <h1 style="color:#0099cc;"><i class="fa fa-user" aria-hidden="true"></i> Faltas</h1>
    <br>
    <div class="box box-Purple " >
      <div class="box-header with-border">
        <h3 class="box-title">Filtro </h3><a class="btn btn-xl btn-warning pull-right" href="<?php echo URL . 'liberado/impressao'; ?>" target="_blank"><span class="fa fa-print"></span> Imprimir</a>
      </div>
      <div class="box-body"> 
        <!-- Table -->
        <form id="listagem" action="<?php echo URL . "liberado/xhrGetListings"; ?>" method="post">
          <input type="hidden" name="pg" id="pg" value="1" />
          
            <div class="col-xs-12 col-md-2 col-lg-2 form-group">
                <label for="login">Tipo Pessoa</label>
                <?php echo Func::comboTipoPessoa(0, "tipo_pessoa", true, $this->instanceDB, "", false, false); ?>
            </div>
            <div class="col-xs-12 col-md-5 col-lg-5 form-group">
                <label for="login">Motivo</label>
               <input type="text" name="motivo" id="motivo" class="form-control keyup" />
            </div>
            
            <div class="col-xs-12 col-md-2 col-lg-2 form-group">
              <label for="login">Iniciados em</label>
              <input type="text" name="data_de" id="data_de" class="form-control data" value="<?php echo date("d/m/Y", strtotime("-1 year")); ?>" readonly  />
            </div>
            
            <div class="col-xs-12 col-md-2 col-lg-2 form-group">
              <label for="login">até</label>
              <input type="text" name="data_ate" id="data_ate" class="form-control data" value="<?php echo date("d/m/Y"); ?>" readonly />
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

