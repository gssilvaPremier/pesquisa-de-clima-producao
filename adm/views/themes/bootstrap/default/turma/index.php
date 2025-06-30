<!-- Content -->
<div class="content-wrapper">
  <section class="content-header"> 
    <!-- Content -->
    <h1 style="color:#0099cc;"><i class="fa fa-users" aria-hidden="true"></i> Trabalho Assistêncial</h1>
    <br>
    <?php 

if(isset($this->singleTurma)) { 
    $pagina = "turma/update/" . $this->singleTurma['id'];
    $botao  = "Atualizar";
} else {
    $pagina = "turma/create";
    $botao  = "Cadastrar";
}

?>
    
    <!-- DONUT CHART -->
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title">Cadastro</h3>
      </div>
      <div class="box-body"> 
        
        <!-- Form -->
        <div class="row">
          <form method="post" action="<?php echo URL . $pagina; ?>">
            <div class="col-xs-12 col-md-2 col-lg-2 form-group">
              <label for="login">Nome</label>
              <input type="text" name="nome" class="form-control" value="<?php echo $this->singleTurma['nome']; ?>" required />
            </div>
            <div class="col-xs-12 col-md-2 col-lg-2 form-group">
              <label for="frequencia">Tipo</label>
              <?php echo Func::comboTipoAssistencial($this->singleTurma['idtipo_assistencial'], "idtipo_assistencial", true, $this->instanceDB, "", false, false); ?> </div>
            <div class="col-xs-12 col-md-2 col-lg-2 form-group">
              <label for="login">Descrição</label>
              <input type="text" name="descricao" class="form-control" value="<?php echo $this->singleTurma['descricao']; ?>" required />
            </div>
            <div class="col-xs-12 col-md-2 col-lg-2 form-group">
              <label for="frequencia">Frequência</label>
              <?php echo Func::combofrequencias($this->singleTurma['idfrequencia'], "idfrequencia", true, $this->instanceDB, "", false, false); ?> </div>
            <div class="col-xs-12 col-md-2 col-lg-2 form-group">
              <label for="login">Responsável</label>
              <?php echo Func::comboPessoas($this->singleTurma['idpessoa_responsavel'], "responsavel", true, $this->instanceDB, "", false, false); ?> </div>
            <div class="col-xs-12 col-md-1 col-lg-1 form-group">
              <label>Status</label>
              <select name="status" class="form-control" required>
                <option value="1" <?php if($this->singleTurma['ativo'] == '1') { ?> selected <? } ?>>Ativo</option>
                <option value="0" <?php if($this->singleTurma['ativo'] == '0') { ?> selected <? } ?>>Inativo</option>
              </select>
            </div>
            <label>&nbsp;</label>
            <br>
            <div class="col-xs-12 col-md-4 col-lg-2 form-group">
              <input type="submit" class="btn btn-default" value="<?php echo $botao; ?>" />
            </div>
          </form>
        </div>
        <!-- Form --> 
        
      </div>
      <!-- /.box --> 
      
    </div>
    
    <!-- DONUT CHART -->
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Listagem</h3>
      </div>
      <div class="box-body"> 
        
        <!-- Table -->
        <form id="listagem" action="<?php echo URL . "turma/xhrGetListings"; ?>" method="post">
          <input type="hidden" name="pg" id="pg" value="1" />
        </form>
        <div id="list"></div>
        <!-- Table --> 
        
      </div>
      <!-- /.box --> 
      
    </div>
    
    <!-- Content --> 
  </section>
</div>
<!-- Content --> 

