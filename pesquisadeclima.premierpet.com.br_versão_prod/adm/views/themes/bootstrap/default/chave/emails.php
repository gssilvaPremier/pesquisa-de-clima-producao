<!-- Content -->
<div class="content-wrapper">
  <section class="content-header">
    <!-- Content -->
    <h1 style="color:#0099cc;"><i class="fa fa-user" aria-hidden="true"></i> Pessoas</h1>
    <br>
    <div class="box box-Purple " >
      <div class="box-header with-border">
        <h3 class="box-title">Cadastro</h3>
        <a class="btn btn-xl btn-success pull-right" data-toggle="modal" data-target="#modal-default"><span class="fa fa-file-excel-o"></span> Importar CSV</a>
      </div>
      <div class="box-body">
        <!-- Table -->
        <form id="listagem" action="<?php echo URL . "chave/gravamail"; ?>" method="post" onsubmit="return enviaEmail(this);">
          <input type="hidden" name="pg" id="pg" value="1" />
          <input type="hidden" name="idemail" id="idemail" value="0" />
          <input type="hidden" name="email_filtro" id="email_filtro" />
          <input type="hidden" name="situacao_filtro" id="situacao_filtro" />

          <div class="col-md-3 form-group">
              <label>Empresa</label>
              <!-- //ATUALIZADO -->
              <?php echo Func::comboEmpresa(0, "empresa", false, $this->instanceDB, " AND (id < 5 OR id = 12)", false, false); ?>
              <!-- //ATIGO -->
              <?php //echo Func::comboEmpresa(0, "empresa", false, $this->instanceDB, " AND id < 5", false, false); ?>

          </div>
          
          <div class="col-md-5 form-group">
              <label>E-mail</label>
              <input type="email" name="email" class="form-control" required />
          </div>

          <div class="col-md-2 text-right form-group">            
            <label>&nbsp;</label>
            <input type="submit" class="form-control btn btn-default" value="Salvar">            
          </div>

          <div class="col-md-2 text-right form-group btnCancelar" style="display: none;">
            <label>&nbsp;</label>
            <input type="button" class="form-control btn btn-danger" onclick="cancelarEdicao();" value="Cancelar">
          </div>          

        </form>

        <!-- Table -->
      </div>
    </div>
    <!-- /.box -->

    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Listagem</h3>
        <br /><br />

        <div class="col-md-4">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-search"></i></span>
            <input type="email" class="form-control" id="filtro_email" placeholder="Filtre pelo email">
          </div>
        </div>

        <div class="col-md-4 form-group">
          
          <select id="situacao" name="situacao" class="form-control">
              <option value="0" selected disabled>Filtre por situação</option>
              <option value="0" disabled>----</option>
              <option value="1">Todas</option>
              <option value="2">Chave não enviada</option>
              <option value="3">Chave não atrelada ao e-mail</option>
              <option value="4">Chave reenviada e já utilizada</option>
              <option value="5">Chave reenviada e não utilizada</option>
              <option value="6">Chave já utilizada</option>
              <option value="7">Chave enviada e não utilizada</option>              
          </select>

        </div>
        
          <div class="col-md-2">
          <button class="btn btn-success" onclick="reenviarTodosEmails()">Reenviar Todos os E-mails</button>

        </div>


      </div>
      <div class="box-body">
        <div id="listEmails"></div>
        <!-- Table -->
      </div>
      
       <div id="statusEnvios" style="padding: 10px 25px;">
        <h3 class="box-title" style="font-size: 18px;">Status dos Envios</h3>
          <ul id="listaStatus"></ul>
      </div>

    </div>
    <!-- /.box -->

    <!-- Content -->
  </section>
</div>
<!-- Content -->

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Importar CSV</h4>
      </div>
      <div class="modal-body">
        <input type="file" name="arquivo_importar" id="arquivo_importar" />
        <div id="listResultImport"></div>
      </div>
      <div class="modal-footer">        
        <button type="button" class="btn btn-primary" id="btnUploadArquivo" name="btnUploadArquivo" disabled onclick="gravaEmail(this);">Selecione o arquivo...</button>
      </div>
    </div>
  </div>
</div>