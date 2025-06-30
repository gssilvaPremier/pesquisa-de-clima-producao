<!-- Content -->

<div class="content-wrapper">
  <section class="content-header"> 
    <!-- Content -->
    <h1 style="color:#0099cc;"><i class="fa fa-user" aria-hidden="true"></i> Lançamento</h1>
    <br>
    <?php 
if(isset($this->singleUser)) { 
  $pagina = "lancamento/update/" . $this->singleUser['id'];
  $botao  = "Atualizar";
} else {
  $pagina = "lancamento/create";
  $botao  = "Cadastrar";
}
?>
    <form method="post" action="<?php echo URL . $pagina; ?>" class="lancamento">
      <!-- DONUT CHART -->
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Lançamento</h3>
        </div>
        <div class="box-body"> 
          
          <!-- Form -->
          <div class="row">
            <div class="col-xs-12 col-md-2 col-lg-2 form-group">
              <label for="frequencia">Freqência</label>
              <?php echo Func::comboFrequencias(0, "frequencia", true, $this->instanceDB, "", false, false); ?> </div>
            <div class="col-xs-12 col-md-2 col-lg-2 form-group">
              <label for="login">Tipo Assistencial</label>
              <select id="tipo_assistencial" name="tipo_assistencial" class="form-control" required>
                <option value="0"></option>
              </select>
            </div>
            <div class="col-xs-12 col-md-2 col-lg-2 form-group">
              <label for="login">Turma</label>
              <select id="turma" name="turma" class="form-control" required>
                <option value="0"></option>
              </select>
            </div>
            <div class="col-xs-12 col-md-4 col-lg-4 form-group">
              <label for="login">Descrição</label>
              <input type="text" name="descricao" id="descricao" class="form-control" required/>
            </div>
            <div class="col-xs-12 col-md-2 col-lg-2 form-group">
              <label for="login">Data Lançamento</label>
              <input type="text" name="data_lancamento" id="data_lancamento" class="form-control data" value="<?php echo date("d/m/Y"); ?>" readonly  required />
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6 form-group">
              <div for="login">Reposição</div>
              <div class="col-xs-12 col-md-6 col-lg-6 form-group">
                <label for="login">Nome</label>
                <input type="text" name="nome_reposicao_1" class="form-control" />
                <input type="text" name="nome_reposicao_2" class="form-control" />
                <input type="text" name="nome_reposicao_3" class="form-control" />
                <input type="text" name="nome_reposicao_4" class="form-control" />
                <input type="text" name="nome_reposicao_5" class="form-control" />
              </div>
              <div class="col-xs-12 col-md-6 col-lg-6 form-group">
                <label for="login">Dia de Trabalho</label>
                <input type="text" name="dia_trabalho_1" class="form-control" />
                <input type="text" name="dia_trabalho_2" class="form-control" />
                <input type="text" name="dia_trabalho_3" class="form-control" />
                <input type="text" name="dia_trabalho_4" class="form-control" />
                <input type="text" name="dia_trabalho_5" class="form-control" />
              </div>
            </div>
            <div class="col-xs-12 col-md-3 col-lg-3 form-group">
              <div for="login">Novo no Grupo</div>
              <div class="col-xs-12 col-md-12 col-lg-12 form-group">
                <label for="login">Nome</label>
                <input type="text" name="nome_grupo_1" class="form-control"  />
                <input type="text" name="nome_grupo_2" class="form-control"  />
                <input type="text" name="nome_grupo_3" class="form-control"  />
                <input type="text" name="nome_grupo_4" class="form-control"  />
                <input type="text" name="nome_grupo_5" class="form-control"  />
              </div>
            </div>
            <div class="col-xs-12 col-md-3 col-lg-3 form-group">
              <label for="login">Observação</label>
              <textarea name="observacao" class="form-control" style="resize:none; height:190px;" ></textarea>
            </div>
          </div>
          <!-- Form --> 
          
        </div>
        <!-- /.box --> 
        
      </div>
      
      <!-- DONUT CHART -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Relação de Lançamento</h3>
        </div>
        <div class="box-body"> 
          
          <!-- Form -->
          <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12 form-group listagem_lancamentos">
              <p class="text-danger">Selecione os filtros acima para que seja montada a relação de tarefeiros</p>
            </div>
          </div>
          <!-- Form --> 
          
        </div>
        <!-- /.box --> 
        
      </div>
    </form>
    <!-- Content --> 
  </section>
</div>
<!-- Content --> 

