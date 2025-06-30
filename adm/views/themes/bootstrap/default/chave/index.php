<!-- Content -->

<div class="content-wrapper">
  <section class="content-header">
    <!-- Content -->
    <h1 style="color:#0099cc;">Profissão</h1>
    <br>
    <?php
		if(isset($this->singleProf)) {
		  $pagina = "chave/update/" . $this->singleProf['id'];
		  $botao  = "Atualizar Chaves";
		} else {
		  $pagina = "chave/create";
		  $botao  = "Gerar chaves";
		}
	?>

    <!-- DONUT CHART -->
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title">Geração de Chaves de Acesso</h3>

        <a class="btn btn-xl btn-warning pull-right" href="<?php echo URL . 'chave/impressao'; ?>" target="_blank" style="display:none;"><span class="fa fa-print"></span> Imprimir</a> </div>
      <div class="box-body">

        <!-- Form -->
        <div class="row">
          <form method="post" action="<?php echo URL . $pagina; ?>">
            <div class="col-md-3 form-group">
              <label>Empresa</label>
               <?php //echo Func::comboEmpresa(0, "empresa", false, $this->instanceDB, " AND id < 5", false, false); ?>
               <?php echo Func::comboEmpresa(0, "empresa", false, $this->instanceDB, " AND (id < 5 OR id = 12)", false, false); ?>

            </div>
            <div class="col-md-3 form-group">
              <label for="qtd">Qtd. chaves à gerar</label>
              <input type="number" name="qtd_chaves" class="form-control" min="1" value="1" required />
            </div>

            <div class="col-md-3 form-group">
              <label for="qtd" style="margin-bottom:10px;">Enviar e-mail</label><br />
              <input type="checkbox" name="enviar_email" value="1" /> Sim
            </div>

            <?php if (1==2) { ?>
              <input type="hidden" name="enviar_email" id="enviar_email" value="0" />
            <?php } ?>

            <label>&nbsp;</label>
            <br>
            <div class="col-md-3 form-group">
            <div class='loader' style="display:none;"></div>
              <input type="submit" class="btn btn-default some" value="<?php echo $botao; ?>" />
            </div>
          </form>
        </div>
        <!-- Form -->

      </div>
      <!-- /.box -->

    </div>


    <!-- DONUT CHART -->
    <div class="box box-success" style="display:none;">
      <div class="box-header with-border">
        <h3 class="box-title">Listagem</h3>
      </div>
      <div class="box-body">

        <!-- Table -->
        <table border="0" cellpadding="15" cellspacing="0"  class="table  table-striped table-hover">
          <thead>
            <tr>
              <td><strong>Empresa</strong></td>
              <td><strong>Chave</strong></td>
              <td align="right"><strong>Data</strong></td>
            </tr>
          </thead>
          <tbody>
            <?php
			/*
      if(isset($this->profissaoList)) {

        foreach($this->profissaoList as $type) {
          echo '<tr>';
          echo '<td>' . $type['empresa'] . '</td>';
          echo '<td><strong><i>' . $type['chave']   . '</i></strong></td>';
          echo '<td align="right">' . $type['data']    . '</td>';
          echo '</tr>';
        }
      } */
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

