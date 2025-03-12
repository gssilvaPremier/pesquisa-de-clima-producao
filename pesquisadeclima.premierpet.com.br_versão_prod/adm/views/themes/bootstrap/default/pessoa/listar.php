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
        <form id="listagem" action="<?php echo URL . "pessoa/xhrGetListings"; ?>" method="post">
          <input type="hidden" name="pg" id="pg" value="1" />
          <div class="col-xs-12 col-md-3 col-lg-3 form-group">
            <label for="nome">Nome</label>
            <input type="text" name="nome" class="form-control keyup" />
          </div>
          <div class="col-xs-12 col-md-2 col-lg-2 form-group">
            <label for="tipo">Tipo</label>
            <?php echo Func::comboTipoPessoa(0, "tipo", true, $this->instanceDB, "", false, false); ?> </div>
          <div class="col-xs-12 col-md-3 col-lg-3 form-group">
            <label for="turma">Turma</label>
            <?php echo Func::comboTurma(0, "turma", true, $this->instanceDB, "", false, false); ?> </div>
          <div class="col-xs-12 col-md-3 col-lg-3 form-group">
            <label for="profissao">Profissão</label>
            <?php echo Func::comboProfissoes(0, "profissao", true, $this->instanceDB, "", false, false); ?> </div>
          <div class="col-xs-12 col-md-3 col-lg-3 form-group">
            <label for="frequencia">Frequência</label>
            <?php echo Func::combofrequencias(0, "frequencia", true, $this->instanceDB, "", false, false); ?> </div>
          <div class="col-xs-12 col-md-2 col-lg-2 form-group">
            <label for="ativo">Ativo</label>
            <select name="ativo" class="form-control change">
              <option value="2">Todos</option>
              <option value="0">Ativos</option>
              <option value="1">Inativos</option>
            </select>
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

