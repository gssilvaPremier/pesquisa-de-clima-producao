
<!-- Content -->
<div class="content-wrapper">
<section class="content-header">
<!-- Content -->
<h1 style="color:#0099cc;"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Frequencia</h1>
<br>

<?php 

if(isset($this->singleFreq)) { 
  $pagina = "frequencia/update/" . $this->singleFreq['id'];
  $botao  = "Atualizar";
} else {
  $pagina = "frequencia/create";
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
          <label for="login">Descrição</label>
              <input type="text" name="descricao" class="form-control" value="<?php echo $this->singleFreq['descricao']; ?>" required/>
          </div>

          <div class="col-xs-12 col-md-4 col-lg-3 form-group">
          <label>Função</label>
            <select name="status" class="form-control">
                <option value="1" <?php if($this->singleFreq['ativo'] == '1') { ?> selected <? } ?>>Ativo</option>
                  <option value="0" <?php if($this->singleFreq['ativo'] == '0') { ?> selected <? } ?>>Inativo</option>
              </select>
          </div>
          <label>&nbsp;</label><br>
          <div class="col-xs-12 col-md-4 col-lg-3 form-group">
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
    <table border="0" cellpadding="15" cellspacing="0"  class="table table-striped table-hover">
    <thead>
        <tr>
          <th>ID</th>
          <th>Descrição</th>
          <th>Ativo</th>
          <th class="text-right">Editar</th>
        </tr>
      </thead>
      <tbody>
    <?php
      if(isset($this->freqList)) {
        
        foreach($this->freqList as $frequencia) {
          echo '<tr>';
            echo '<td>' . $frequencia['id']     . '</td>';
            echo '<td>' . $frequencia['descricao']  . '</td>';
            echo '<td>' . Func::getAtivo($frequencia['ativo']) . '</td>';
            echo '<td align="right"><a class="btn btn-default  btn-xs" href="' . URL . 'frequencia/edit/' . $frequencia['id'] . '"><span class="glyphicon glyphicon-pencil text-info"></span> Editar</a> <a class="btn btn-default  btn-xs" href="' . URL . 'frequencia/delete/' . $frequencia['id'] . '"><span class="glyphicon glyphicon-trash text-danger"></span> Deletar</a> </td>';
          echo '</tr>';
        }   
      }
    ?>
    </tbody>
    </table>
      <!-- Table -->

  </div>
  <!-- /.box -->

</div>


<!-- Content -->
</section>
</div>
<!-- Content -->













