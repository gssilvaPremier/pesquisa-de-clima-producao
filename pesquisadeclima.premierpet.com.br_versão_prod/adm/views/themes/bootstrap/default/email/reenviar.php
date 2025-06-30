<!-- Content -->
<div class="content-wrapper">
  <section class="content-header">
    <!-- Content -->
    <h1 style="color:#0099cc;">Email</h1>
    <br>
    <!-- DONUT CHART -->
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title">Reenviar E-mails</h3></div>
      <div class="box-body">

        <!-- Form -->
        <div class="row">
          <form id="envioEmail">
            <div class="col-xs-12 col-md-2 col-lg-2 form-group">
              <label for="qtd">Qtd. de email à enviar</label>
              <input type="number" name="qtd" class="form-control" min="1" value="1" required />
            </div>
            <div class="col-xs-12 col-md-4 col-lg-3 form-group">
              <input type="button" onclick="reenviarEmails();" class="btn btn-padrao" value="Reenviar" style="margin-top: 25px;" />
            </div>
          </form>
        </div>
        <!-- Form -->

      </div>
      <!-- /.box -->

    </div>


    <!-- DONUT CHART -->
    <div class="box box-success">
      <div class="box-body" id="list">


      </div>
      <!-- /.box -->

    </div>

    <!-- Content -->
  </section>
</div>
<!-- Content -->