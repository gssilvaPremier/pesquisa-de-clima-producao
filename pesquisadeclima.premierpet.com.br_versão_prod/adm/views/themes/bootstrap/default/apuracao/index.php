<!-- Content -->
<div class="content-wrapper">
  <section class="content-header">
    <!-- Content -->
    <h1 style="color:#0099cc;">Parciais</h1>
    <br>
    <!-- DONUT CHART -->
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title">Apuração Parcial</h3></div>
      <div class="box-body">

        <!-- Form -->
        <div class="row">
            <div class="col-xs-12 col-md-4 col-lg-3 form-group">
            <div class='loader' style="display:none;"></div>
              <input type="button" onclick="obterParciais();" class="btn btn-padrao" value="Obter parciais" />
            </div>
        </div>
        <!-- Form -->

      </div>
      <!-- /.box -->

    </div>


    <!-- DONUT CHART -->
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Resultado Parcial</h3>
      </div>
      <div class="box-body" id="list">

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

      </div>
      <!-- /.box -->

    </div>

    <!-- Content -->
  </section>
</div>
<!-- Content -->

