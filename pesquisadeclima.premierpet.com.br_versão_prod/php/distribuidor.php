<nav class="navbar navbar-default" style="margin-top: -40px;">
    <div class="container" style="margin-top:5px; margin-bottom:10px; line-height:20px;">
    <div class="row">
      <div class="col-xs-12 col-md-8 col-lg-8">
      		<img src="<?php echo URL; ?>img/logo_premier.png" class="img-responsive pull-left" style="max-height:50px; margin-top:25px;" />
      </div>
      <div class="col-xs-12 col-md-4 col-lg-4">
      		<img src="<?php echo URL; ?>img/logo_clima.png" class="img-responsive pull-right" style="max-height:80px; margin-top:10px;" />
      </div>
    </div>
  </div>
</nav>
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-md-12 col-lg-12">
      <ol class="breadcrumb">
        <li><a href="javascript:void(0)">Distribuidora</a></li>
        <li><a href="javascript:void(0)">Setor</a></li>
        <li class="active">Pesquisa Distribuidoras</li>
      </ol>
    </div>
  </div>
</div>
<form action="xhr/distribuidor.php" id="form">
  <div class="container"  style="margin-bottom:50px;">
    <div class="row desativartudoa">
      <div class="col-xs-12 col-md-12 col-lg-12">
        <h3>Vis&atilde;o da Empresa</h3>
        <div class="panel panel-default">
          <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <thead>
              <tr>
                <td>&nbsp;</td>
                <td align="center"><strong>Discordo Totalmente</strong></td>
                <td align="center"><strong>Discordo Parcialmente</strong></td>
                <td align="center"><strong>Concordo Parcialmente</strong></td>
                <td align="center"><strong>Concordo Totalmente</strong></td>
                <!--<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>-->
              </tr>
            </thead>
            <tbody>
              <tr>
                <td align="left">1 - A PremieRpet<sup>&reg;</sup> &eacute; uma marca premium, que se diferencia dos concorrentes.</td>
                <td align="center"><input type="radio" required name="visao1" id="visao1" value="1"  /></td>
                <td align="center"><input type="radio" required name="visao1" id="visao1" value="2" /></td>
                <td align="center"><input type="radio" required name="visao1" id="visao1" value="3" /></td>
                <td align="center"><input type="radio" required name="visao1" id="visao1" value="4" /></td>
                <!--<td align="center"><input type="radio" required name="visao1" id="visao1" value="5" /></td>-->
              </tr>
              <tr>
                <td align="left">2 - A marca PremieRpet<sup>&reg;</sup> tem uma imagem positiva perante os clientes.</td>
                <td align="center"><input type="radio" required name="visao2" id="visao2" value="1"  /></td>
                <td align="center"><input type="radio" required name="visao2" id="visao2" value="2" /></td>
                <td align="center"><input type="radio" required name="visao2" id="visao2" value="3" /></td>
                <td align="center"><input type="radio" required name="visao2" id="visao2" value="4" /></td>
                <!--<td align="center"><input type="radio" required name="visao2" id="visao2" value="5" /></td>-->
              </tr>
              <tr>
                <td align="left">3 - Confio na qualidade dos produtos PremieRpet<sup>&reg;</sup>.</td>
                <td align="center"><input type="radio" required name="visao3" id="visao3" value="1"  /></td>
                <td align="center"><input type="radio" required name="visao3" id="visao3" value="2" /></td>
                <td align="center"><input type="radio" required name="visao3" id="visao3" value="3" /></td>
                <td align="center"><input type="radio" required name="visao3" id="visao3" value="4" /></td>
                <!--<td align="center"><input type="radio" required name="visao3" id="visao3" value="5" /></td>-->
              </tr>
              <tr>
                <td align="left">4 - A empresa faz voc&ecirc; se sentir importante no que faz.</td>
                <td align="center"><input type="radio" required name="visao4" id="visao4" value="1"  /></td>
                <td align="center"><input type="radio" required name="visao4" id="visao4" value="2" /></td>
                <td align="center"><input type="radio" required name="visao4" id="visao4" value="3" /></td>
                <td align="center"><input type="radio" required name="visao4" id="visao4" value="4" /></td>
                <!--<td align="center"><input type="radio" required name="visao4" id="visao4" value="5" /></td>-->
              </tr>
              <tr>
                <td align="left">5 - Voc&ecirc; tem abertura para dar ideias e sugest&otilde;es.</td>
                <td align="center"><input type="radio" required name="visao5" id="visao5" value="1"  /></td>
                <td align="center"><input type="radio" required name="visao5" id="visao5" value="2" /></td>
                <td align="center"><input type="radio" required name="visao5" id="visao5" value="3" /></td>
                <td align="center"><input type="radio" required name="visao5" id="visao5" value="4" /></td>
                <!--<td align="center"><input type="radio" required name="visao5" id="visao5" value="5" /></td>-->
              </tr>
              <tr>
                <td align="left">6 - Tenho confian&ccedil;a no Futuro da PremieRpet<sup>&reg;</sup>.</td>
                <td align="center"><input type="radio" required name="visao6" id="visao6" value="1"  /></td>
                <td align="center"><input type="radio" required name="visao6" id="visao6" value="2" /></td>
                <td align="center"><input type="radio" required name="visao6" id="visao6" value="3" /></td>
                <td align="center"><input type="radio" required name="visao6" id="visao6" value="4" /></td>
                <!--<td align="center"><input type="radio" required name="visao6" id="visao6" value="5" /></td>-->
              </tr>
              <tr>
                <td align="left">7 - Tenho orgulho e gosto de trabalhar para a PremieRpet<sup>&reg;</sup>.</td>
                <td align="center"><input type="radio" required name="visao7" id="visao7" value="1"  /></td>
                <td align="center"><input type="radio" required name="visao7" id="visao7" value="2" /></td>
                <td align="center"><input type="radio" required name="visao7" id="visao7" value="3" /></td>
                <td align="center"><input type="radio" required name="visao7" id="visao7" value="4" /></td>
                <!--<td align="center"><input type="radio" required name="visao7" id="visao7" value="5" /></td>-->
              </tr>
              <tr>
                <td align="left">8 - Seus colegas de trabalho se sentem compromissados em, juntos desempenharem um trabalho com qualidade.</td>
                <td align="center"><input type="radio" required name="visao8" id="visao8" value="1"  /></td>
                <td align="center"><input type="radio" required name="visao8" id="visao8" value="2" /></td>
                <td align="center"><input type="radio" required name="visao8" id="visao8" value="3" /></td>
                <td align="center"><input type="radio" required name="visao8" id="visao8" value="4" /></td>
                <!--<td align="center"><input type="radio" required name="visao8" id="visao8" value="5" /></td>-->
              </tr>
              <tr>
                <td align="left"><strong>Justifique todas as respostas em que voc&ecirc; assinalou discordo totalmente ou parcialmente:</strong></td>
                <td colspan="4"><input type="text" class="form-control" name="visao_justificativa" id="visao_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-xs-12 col-md-12 col-lg-12">
        <h3>Outros</h3>
        <div class="panel panel-default">
          <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody>
              <tr>
                <td align="left" colspan="5">Coment&aacute;rios gerais:</td>
              </tr>
              <tr>
                <td align="center" colspan="4"><textarea class="form-control" style="resize:none; height:100px;" placeholder="Informe aqui qualquer tipo de coment&aacute;rios" name="comentario" id="comentario" ></textarea></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>	  
	  
      <div class="col-xs-12 col-md-6 col-lg-6">
        <div class="alert alert-info sucesso" role="alert"></div>
      </div>
      <div class="col-xs-12 col-md-6 col-lg-6">
        <button type="submit" id="botao_cadastrar" class="btn btn-lg btn-warning pull-right">Enviar Formul&aacute;rio</button>
      </div>
    </div>
  </div>
</form>