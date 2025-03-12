<!-- Content -->
<div class="content-wrapper">
<section class="content-header">
<!-- Content -->
<h1 style="color:#0099cc;"><i class="fa fa-user" aria-hidden="true"></i> Pessoa</h1>
<br>
<?php 
if(isset($this->singleUser)) { 
  $pagina = "pessoa/update/" . $this->singleUser['id'];
  $botao  = "Atualizar";
} else {
  $pagina = "pessoa/create";
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
        <div class="col-xs-12 col-md-4 col-lg-3 form-group">
          <label for="login">Nome</label>
              <input type="text" name="nome" class="form-control" value="<?php echo utf8_encode($this->singleUser['nome']); ?>" required/>
          </div>
          <div class="col-xs-12 col-md-4 col-lg-3 form-group">
            <label >CPF</label>
            <input type="text" name="cgc" class="form-control" value="<?php echo $this->singleUser['cgc']; ?>" />
          </div>
          
          <div class="col-xs-12 col-md-2 col-lg-2 form-group">
            <label >Estado</label>
            <select name="estado" class="form-control">            
                <option value="">Selecione</option>
                <option value="AC" <?php if($this->singleUser['estado'] == "AC") { ?> selected <?php } ?>>Acre</option>
                <option value="AL" <?php if($this->singleUser['estado'] == "AL") { ?> selected <?php } ?>>Alagoas</option>
                <option value="AP" <?php if($this->singleUser['estado'] == "AP") { ?> selected <?php } ?>>Amapá</option>
                <option value="AM" <?php if($this->singleUser['estado'] == "AM") { ?> selected <?php } ?>>Amazonas</option>
                <option value="BA" <?php if($this->singleUser['estado'] == "BA") { ?> selected <?php } ?>>Bahia</option>
                <option value="CE" <?php if($this->singleUser['estado'] == "CE") { ?> selected <?php } ?>>Ceará</option>
                <option value="DF" <?php if($this->singleUser['estado'] == "DF") { ?> selected <?php } ?>>Distrito Federal</option>
                <option value="ES" <?php if($this->singleUser['estado'] == "ES") { ?> selected <?php } ?>>Espirito Santo</option>
                <option value="GO" <?php if($this->singleUser['estado'] == "GO") { ?> selected <?php } ?>>Goiás</option>
                <option value="MA" <?php if($this->singleUser['estado'] == "MA") { ?> selected <?php } ?>>Maranhão</option>
                <option value="MS" <?php if($this->singleUser['estado'] == "MS") { ?> selected <?php } ?>>Mato Grosso do Sul</option>
                <option value="MT" <?php if($this->singleUser['estado'] == "MT") { ?> selected <?php } ?>>Mato Grosso</option>
                <option value="MG" <?php if($this->singleUser['estado'] == "MG") { ?> selected <?php } ?>>Minas Gerais</option>
                <option value="PA" <?php if($this->singleUser['estado'] == "PA") { ?> selected <?php } ?>>Pará</option>
                <option value="PB" <?php if($this->singleUser['estado'] == "PB") { ?> selected <?php } ?>>Paraíba</option>
                <option value="PR" <?php if($this->singleUser['estado'] == "PR") { ?> selected <?php } ?>>Paraná</option>
                <option value="PE" <?php if($this->singleUser['estado'] == "PE") { ?> selected <?php } ?>>Pernambuco</option>
                <option value="PI" <?php if($this->singleUser['estado'] == "PI") { ?> selected <?php } ?>>Piauí</option>
                <option value="RJ" <?php if($this->singleUser['estado'] == "RJ") { ?> selected <?php } ?>>Rio de Janeiro</option>
                <option value="RN" <?php if($this->singleUser['estado'] == "RN") { ?> selected <?php } ?>>Rio Grande do Norte</option>
                <option value="RS" <?php if($this->singleUser['estado'] == "RS") { ?> selected <?php } ?>>Rio Grande do Sul</option>
                <option value="RO" <?php if($this->singleUser['estado'] == "RO") { ?> selected <?php } ?>>Rondônia</option>
                <option value="RR" <?php if($this->singleUser['estado'] == "RR") { ?> selected <?php } ?>>Roraima</option>
                <option value="SC" <?php if($this->singleUser['estado'] == "SC") { ?> selected <?php } ?>>Santa Catarina</option>
                <option value="SP" <?php if($this->singleUser['estado'] == "SP") { ?> selected <?php } ?>>São Paulo</option>
                <option value="SE" <?php if($this->singleUser['estado'] == "SE") { ?> selected <?php } ?>>Sergipe</option>
                <option value="TO" <?php if($this->singleUser['estado'] == "TO") { ?> selected <?php } ?>>Tocantins</option>
            </select>
           </div>
          <div class="col-xs-12 col-md-4 col-lg-4 form-group">
            <label >Cidade</label>
            <input type="text" name="cidade" class="form-control" value="<?php echo $this->singleUser['cidade']; ?>" />
          </div>
          <div class="col-xs-12 col-md-5 col-lg-5 form-group">
            <label >Endereço</label>
            <input type="text" name="endereco" class="form-control" value="<?php echo $this->singleUser['endereco']; ?>" />
          </div>
          <div class="col-xs-12 col-md-4 col-lg-2 form-group">
          <label for="login">Profissão</label>    
            <?php echo Func::comboProfissoes($this->singleUser['idprofisssao'], "profissao", true, $this->instanceDB, "", false, false); ?>
         </div>
         
         <div class="col-xs-12 col-md-4 col-lg-2 form-group" style="display:none;">
          <label for="login">Frequência</label>    
            <?php echo Func::comboFrequencias($this->singleUser['idfrequencia'], "frequencia", true, $this->instanceDB, "", false, false); ?>
         </div>
         
         <div class="col-xs-12 col-md-4 col-lg-2 form-group">
          <label for="login">Tipo de Pessoa</label>    
            <?php echo Func::comboTipoPessoa($this->singleUser['idtipo_pessoa'], "tipo_pessoa", true, $this->instanceDB, "", false, false); ?>
         </div>
         
         <div class="col-xs-12 col-md-4 col-lg-2 form-group" style="display:none;">
          <label for="login">Turma</label>    
            <?php echo Func::comboTurma($this->singleUser['idturma'], "turma", true, $this->instanceDB, "", false, false); ?>
         </div>
         <div class="col-xs-12 col-md-4 col-lg-3 form-group">
          <label for="login">Celular</label>
              <input type="text" name="telefone2" class="form-control" value="<?php echo $this->singleUser['telefone2']; ?>" />
          </div>
          <div class="col-xs-12 col-md-4 col-lg-3 form-group">
          <label for="login">Telefone</label>
              <input type="text" name="telefone" class="form-control" value="<?php echo $this->singleUser['telefone']; ?>" />
          </div>
          <div class="col-xs-12 col-md-4 col-lg-3 form-group">
          <label for="login">E-mail</label>
              <input type="email" name="email" class="form-control" value="<?php echo $this->singleUser['email']; ?>" />
          </div>
          <div class="col-xs-12 col-md-4 col-lg-3 form-group">
          <label for="login">Curso</label>
              <input type="text" name="curso" class="form-control" value="<?php echo $this->singleUser['curso']; ?>" />
          </div>
          <div class="col-xs-12 col-md-4 col-lg-2 form-group" >
          <label for="login">Assistencial 1</label>    
            <?php echo Func::comboTurma($this->singleUser['idtipo_assistencial1'], "idtipo_assistencial1", true, $this->instanceDB, " AND idtipo_assistencial = 1", false, false); ?>
         </div>
         <div class="col-xs-12 col-md-4 col-lg-2 form-group" >
          <label for="login">Assistencial 2</label>    
            <?php echo Func::comboTurma($this->singleUser['idtipo_assistencial2'], "idtipo_assistencial2", true, $this->instanceDB, " AND idtipo_assistencial = 2", false, false); ?>
         </div>
         <div class="col-xs-12 col-md-4 col-lg-2 form-group" >
          <label for="login">Assistencial 3</label>    
            <?php echo Func::comboTurma($this->singleUser['idtipo_assistencial3'], "idtipo_assistencial3", true, $this->instanceDB, " AND idtipo_assistencial = 3", false, false); ?>
         </div>
         <div class="col-xs-12 col-md-4 col-lg-2 form-group" >
          <label for="login">Assistencial 4</label>    
            <?php echo Func::comboTurma($this->singleUser['idtipo_assistencial4'], "idtipo_assistencial4", true, $this->instanceDB, " AND idtipo_assistencial = 4", false, false); ?>
         </div>
         <div class="col-xs-12 col-md-4 col-lg-2 form-group" >
          <label for="login">Assistencial 5</label>    
            <?php echo Func::comboTurma($this->singleUser['idtipo_assistencial5'], "idtipo_assistencial5", true, $this->instanceDB, " AND idtipo_assistencial = 5", false, false); ?>
         </div>
         <div class="col-xs-12 col-md-4 col-lg-2 form-group" >
          <label for="login">Assistencial 6</label>    
            <?php echo Func::comboTurma($this->singleUser['idtipo_assistencial6'], "idtipo_assistencial6", true, $this->instanceDB, " AND idtipo_assistencial = 6", false, false); ?>
         </div>
          <div class="col-xs-12 col-md-4 col-lg-3 form-group" style="display:none;">
          <label for="login">Trabalho na rua</label>
              <input type="text" name="trabalho_rua" class="form-control" value="<?php echo $this->singleUser['trabalho_rua']; ?>" />
          </div>
          <div class="col-xs-12 col-md-4 col-lg-3 form-group" style="display:none;">
          <label for="login">Cesta Básica</label>
              <input type="text" name="cesta_basica" class="form-control" value="<?php echo $this->singleUser['cesta_basica']; ?>" />
          </div>
          <div class="col-xs-12 col-md-4 col-lg-3 form-group">
          <label for="login">Dia Trabalho</label>
              <input type="text" name="dia_trabalho" class="form-control" value="<?php echo $this->singleUser['dia_trabalho']; ?>" />
          </div>
          <div class="col-xs-12 col-md-4 col-lg-3 form-group">
          <label for="login">Data Inicio</label>
              <input type="date" name="data_inicio" class="form-control" value="<?php echo isset($this->singleUser['data_inicio']) ? $this->singleUser['data_inicio'] : date("Y-m-d"); ?>" />
          </div>
          <div class="col-xs-12 col-md-12 col-lg-12 form-group">
          <label for="login">Observação</label>
              <textarea name="observacao" class="form-control" style="resize:none; height:100px;" ><?php echo $this->singleUser['observacao']; ?></textarea>
          </div>
          
          <div class="col-xs-12 col-md-4 col-lg-3 form-group">
          <label for="login">Motivos</label>
              <input type="text" name="motivos" class="form-control" value="<?php echo $this->singleUser['motivos']; ?>" />
          </div>
          <div class="col-xs-12 col-md-4 col-lg-3 form-group">
          <label for="login">Liberados</label>
              <input type="text" name="liberados" class="form-control" value="<?php echo $this->singleUser['liberados']; ?>" />
          </div>   
          
          <div class="col-xs-12 col-md-12 col-lg-12 form-group">
          <hr />
          </div>    
          <div class="col-xs-12 col-md-4 col-lg-3 form-group">
            <input type="submit" class="btn btn-default" value="<?php echo $botao; ?>" />
          </div>
      </form>
      </div>
      <!-- Form -->

  </div>
  <!-- /.box -->

</div>




<!-- Content -->
</section>
</div>
<!-- Content -->



