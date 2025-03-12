<!-- Content -->
<div class="content-wrapper">
  <section class="content-header"> 
    <!-- Content -->
    <h1 style="color:#0099cc;"><i class="fa fa-user" aria-hidden="true"></i> Pessoas</h1>
    <br>
    <div class="box box-Purple " >
      <div class="box-header with-border">
        <h3 class="box-title">Filtro</h3>
        <a class="btn btn-xl btn-warning pull-right" href="<?php echo URL . 'chave/impressao'; ?>" target="_blank" style="display:none;"><span class="fa fa-print"></span> Imprimir</a> </div>
      <div class="box-body"> 
        <!-- Table -->
        <form id="listagem" action="" method="post">
          <input type="hidden" name="pg" id="pg" value="1" />
          <div class="col-xs-12 col-md-4 col-lg-3 form-group">
            <label>Empresa</label>
            <select name="empresa" id="empresa" class="form-control" required>
              <!-- <option value="1">Fazenda</option>             
              <option value="2">Distribuidor</option>
              <option value="3">Premier</option>
               -->
               <option value="4">Brascorp</option>
            </select>
          </div>
        </form>
        
        <!-- Table --> 
      </div>
    </div>
    <!-- /.box -->
    
    <div class="box box-success">
      <div class="box-body">
        <div id="listRel"></div>
        <!-- Table --> 
      </div>
    </div>
    <!-- /.box --> 
    
    <!-- Content --> 
  </section>
</div>
<!-- Content --> 

