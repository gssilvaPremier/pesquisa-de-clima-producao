<?php
    $nome_empresa_form = "GrandFood";
?>
<nav class="navbar navbar-default" style="margin-top: -40px;">
    <div class="container" style="margin-top:5px; margin-bottom:10px; line-height:20px;">
        <div class="row">
            <div class="col-xs-12 col-md-8 col-lg-8">
                <img src="<?php echo URL; ?>img/logo_granfood.png" class="img-responsive pull-left" style="max-height:50px; margin-top:25px;" />
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
                <li><a href="javascript:void(0)">PremieRpet<sup>&reg;</sup></a></li>
                <li><a href="javascript:void(0)">Setor</a></li>
                <li class="active">Pesquisa PremieRpet<sup>&reg;</sup></li>
            </ol>
        </div>
    </div>
</div>
<?php
    $db = new Conexao($banco);
    $rs = $db->sel("SELECT seguranca_trabalho, ti FROM premier_setor WHERE id = " . (int) $_SESSION['premier_setor'] . ";");
    $db = NULL;
    
    ?>
<form action="xhr/granfood.php" id="form">
    <div class="container"  style="margin-bottom:50px;">
        <div class="row desativartudoa">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <h3>Dire&ccedil;&atilde;o</h3>
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
                                <td align="left">1 - Eu recomendaria aos meus parentes e amigos a PremieRpet<sup>&reg;</sup> como um excelente lugar para trabalhar.</td>
                                <td align="center"><input type="radio" required name="direcao1" id="direcao1" value="1"  /></td>
                                <td align="center"><input type="radio" required name="direcao1" id="direcao1" value="2" /></td>
                                <td align="center"><input type="radio" required name="direcao1" id="direcao1" value="3" /></td>
                                <td align="center"><input type="radio" required name="direcao1" id="direcao1" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="direcao1" id="direcao1" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">2 - O ambiente de trabalho da PremieRpet<sup>&reg;</sup> facilita o relacionamento entre os colaboradores.</td>
                                <td align="center"><input type="radio" required name="direcao2" id="direcao2" value="1"  /></td>
                                <td align="center"><input type="radio" required name="direcao2" id="direcao2" value="2" /></td>
                                <td align="center"><input type="radio" required name="direcao2" id="direcao2" value="3" /></td>
                                <td align="center"><input type="radio" required name="direcao2" id="direcao2" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="direcao2" id="direcao2" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">3 - Do ano passado para c&aacute; a empresa melhorou.</td>
                                <td align="center"><input type="radio" required name="direcao3" id="direcao3" value="1"  /></td>
                                <td align="center"><input type="radio" required name="direcao3" id="direcao3" value="2" /></td>
                                <td align="center"><input type="radio" required name="direcao3" id="direcao3" value="3" /></td>
                                <td align="center"><input type="radio" required name="direcao3" id="direcao3" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="direcao3" id="direcao3" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">4 - A empresa faz voc&ecirc; se sentir importante no que faz.</td>
                                <td align="center"><input type="radio" required name="direcao4" id="direcao4" value="1"  /></td>
                                <td align="center"><input type="radio" required name="direcao4" id="direcao4" value="2" /></td>
                                <td align="center"><input type="radio" required name="direcao4" id="direcao4" value="3" /></td>
                                <td align="center"><input type="radio" required name="direcao4" id="direcao4" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="direcao4" id="direcao4" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">5 - Os processos, procedimentos e rotinas de trabalho da PremieRpet<sup>&reg;</sup> s&atilde;o organizados e eficientes.</td>
                                <td align="center"><input type="radio" required name="direcao5" id="direcao5" value="1"  /></td>
                                <td align="center"><input type="radio" required name="direcao5" id="direcao5" value="2" /></td>
                                <td align="center"><input type="radio" required name="direcao5" id="direcao5" value="3" /></td>
                                <td align="center"><input type="radio" required name="direcao5" id="direcao5" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="direcao5" id="direcao5" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">6 - Tenho confian&ccedil;a no Futuro da  PremieRpet<sup>&reg;</sup>.</td>
                                <td align="center"><input type="radio" required name="direcao6" id="direcao6" value="1"  /></td>
                                <td align="center"><input type="radio" required name="direcao6" id="direcao6" value="2" /></td>
                                <td align="center"><input type="radio" required name="direcao6" id="direcao6" value="3" /></td>
                                <td align="center"><input type="radio" required name="direcao6" id="direcao6" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="direcao6" id="direcao6" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">7 - Tenho orgulho e gosto de trabalhar na PremieRpet<sup>&reg;</sup>.</td>
                                <td align="center"><input type="radio" required name="direcao7" id="direcao7" value="1"  /></td>
                                <td align="center"><input type="radio" required name="direcao7" id="direcao7" value="2" /></td>
                                <td align="center"><input type="radio" required name="direcao7" id="direcao7" value="3" /></td>
                                <td align="center"><input type="radio" required name="direcao7" id="direcao7" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="direcao7" id="direcao7" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">8 - Seus colegas de trabalho se sentem compromissados em, juntos desempenharem um trabalho com qualidade.</td>
                                <td align="center"><input type="radio" required name="direcao8" id="direcao8" value="1"  /></td>
                                <td align="center"><input type="radio" required name="direcao8" id="direcao8" value="2" /></td>
                                <td align="center"><input type="radio" required name="direcao8" id="direcao8" value="3" /></td>
                                <td align="center"><input type="radio" required name="direcao8" id="direcao8" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="direcao8" id="direcao8" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">9 - Os objetivos da empresa s&atilde;o claros e divulgados a todos os colaboradores.</td>
                                <td align="center"><input type="radio" required name="direcao9" id="direcao9" value="1"  /></td>
                                <td align="center"><input type="radio" required name="direcao9" id="direcao9" value="2" /></td>
                                <td align="center"><input type="radio" required name="direcao9" id="direcao9" value="3" /></td>
                                <td align="center"><input type="radio" required name="direcao9" id="direcao9" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="direcao9" id="direcao9" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">10 - A PremieRpet<sup>&reg;</sup> ouve e coloca em pr&aacute;tica as sugest&otilde;es de seus colaboradores.</td>
                                <td align="center"><input type="radio" required name="direcao10" id="direcao10" value="1"  /></td>
                                <td align="center"><input type="radio" required name="direcao10" id="direcao10" value="2" /></td>
                                <td align="center"><input type="radio" required name="direcao10" id="direcao10" value="3" /></td>
                                <td align="center"><input type="radio" required name="direcao10" id="direcao10" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="direcao10" id="direcao10" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left"><strong>Justifique: "Discordo totalmente", "Discordo parcialmente":</strong></td>
                                <td colspan="4"><input type="text" class="form-control" name="direcao_justificativa" id="direcao_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12">
                <h3>Benef&iacute;cios</h3>
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
                                <td colspan="5"><span class="text-primary">Utiliza Conv&ecirc;nio M&eacute;dico?</span> <input type="radio" name="beneficio_convenio_medico" onclick="showDiv('beneficio_convenio_medico',1)" required="required" value="1"> Sim <input type="radio" name="beneficio_convenio_medico" onclick="showDiv('beneficio_convenio_medico',0)" required="required" value="0"> N&atilde;o
                                </td>
                            </tr>
                            <tr id="beneficio_convenio_medico">
                                <td align="left">O conv&ecirc;nio m&eacute;dico &eacute; bom para mim e para minha fam&iacute;lia.</td>
                                <td align="center"><input type="radio" name="beneficio1" id="beneficio1" value="1"  /></td>
                                <td align="center"><input type="radio" name="beneficio1" id="beneficio1" value="2" /></td>
                                <td align="center"><input type="radio" name="beneficio1" id="beneficio1" value="3" /></td>
                                <td align="center"><input type="radio" name="beneficio1" id="beneficio1" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="beneficio1" id="beneficio1" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <span class="text-primary">Utiliza Transporte?</span>
                                    <input type="radio" name="beneficio_transporte" onclick="showDiv('beneficio_transporte',1)" required="required" value="1"> Sim <input type="radio" name="beneficio_transporte" onclick="showDiv('beneficio_transporte',0)" required="required" value="0"> N&atilde;o
                                </td>
                            </tr>
                            <tr id="beneficio_transporte">
                                <td align="left">O transporte atende as necessidades dos colaboradores.</td>
                                <td align="center"><input type="radio" name="beneficio2" id="beneficio2" value="1"  /></td>
                                <td align="center"><input type="radio" name="beneficio2" id="beneficio2" value="2" /></td>
                                <td align="center"><input type="radio" name="beneficio2" id="beneficio2" value="3" /></td>
                                <td align="center"><input type="radio" name="beneficio2" id="beneficio2" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="beneficio2" id="beneficio2" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <span class="text-primary">Utiliza Restaurante?</span>
                                    <input type="radio" name="beneficio_restaurante" onclick="showDiv('beneficio_restaurante',1)" required="required" value="1"> Sim
                                    <input type="radio" name="beneficio_restaurante" onclick="showDiv('beneficio_restaurante',0)" required="required" value="0"> N&atilde;o
                                </td>
                            </tr>
                            <tr id="beneficio_restaurante">
                                <td align="left">Servi&ccedil;os do restaurante atendem as necessidades dos colaboradores.</td>
                                <td align="center"><input type="radio" name="beneficio3" id="beneficio3" value="1"  /></td>
                                <td align="center"><input type="radio" name="beneficio3" id="beneficio3" value="2" /></td>
                                <td align="center"><input type="radio" name="beneficio3" id="beneficio3" value="3" /></td>
                                <td align="center"><input type="radio" name="beneficio3" id="beneficio3" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="beneficio3" id="beneficio3" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <span class="text-primary">Utiliza VR?</span>
                                    <input type="radio" name="beneficio_vr" onclick="showDiv('beneficio_vr',1)" required="required" value="1"> Sim
                                    <input type="radio" name="beneficio_vr" onclick="showDiv('beneficio_vr',0)" required="required" value="0"> N&atilde;o
                                </td>
                            </tr>
                            <tr id="beneficio_vr">
                                <td align="left">Servi&ccedil;os de VR atendem as necessidades dos colaboradores.</td>
                                <td align="center"><input type="radio" name="beneficio4" id="beneficio4" value="1"  /></td>
                                <td align="center"><input type="radio" name="beneficio4" id="beneficio4" value="2" /></td>
                                <td align="center"><input type="radio" name="beneficio4" id="beneficio4" value="3" /></td>
                                <td align="center"><input type="radio" name="beneficio4" id="beneficio4" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="beneficio3" id="beneficio3" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <span class="text-primary">Utiliza conv&ecirc;nio Odontol&oacute;gico?</span>
                                    <input type="radio" name="beneficio_odontologico"  onclick="showDiv('beneficio_odontologico',1)" required="required" value="1"> Sim
                                    <input type="radio" name="beneficio_odontologico"  onclick="showDiv('beneficio_odontologico',0)" required="required" value="0"> N&atilde;o
                                </td>
                            </tr>
                            <tr id="beneficio_odontologico">
                                <td align="left">O conv&ecirc;nio odontol&oacute;gico &eacute; bom para mim e para minha fam&iacute;lia.</td>
                                <td align="center"><input type="radio" name="beneficio5" id="beneficio5" value="1"  /></td>
                                <td align="center"><input type="radio" name="beneficio5" id="beneficio5" value="2" /></td>
                                <td align="center"><input type="radio" name="beneficio5" id="beneficio5" value="3" /></td>
                                <td align="center"><input type="radio" name="beneficio5" id="beneficio5" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="beneficio4" id="beneficio4" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">Estou satisfeito com as campanhas como: Dia das M&atilde;es, Dia dos Pais, Final de Ano, entre outras.</td>
                                <td align="center"><input type="radio" required name="beneficio6" id="beneficio6" value="1"  /></td>
                                <td align="center"><input type="radio" required name="beneficio6" id="beneficio6" value="2" /></td>
                                <td align="center"><input type="radio" required name="beneficio6" id="beneficio6" value="3" /></td>
                                <td align="center"><input type="radio" required name="beneficio6" id="beneficio6" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="beneficio5" id="beneficio5" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">Estou satisfeito com o  resultado do PPR - Programa de Participa&ccedil;&atilde;o nos Resultados.</td>
                                <td align="center"><input type="radio" required name="beneficio7" id="beneficio7" value="1"  /></td>
                                <td align="center"><input type="radio" required name="beneficio7" id="beneficio7" value="2" /></td>
                                <td align="center"><input type="radio" required name="beneficio7" id="beneficio7" value="3" /></td>
                                <td align="center"><input type="radio" required name="beneficio7" id="beneficio7" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="beneficio6" id="beneficio6" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">8 - Utiliza conv&ecirc;nio m&eacute;dico.</td>
                                <td colspan="2" align="center"><input type="radio" required name="beneficio8" id="beneficio8" value="1"  /> <label for="beneficio8"> SIM</label></td>
                                <td colspan="2" align="center"><input type="radio" required name="beneficio8" id="beneficio8a" value="0" /> <label for="beneficio8a">N&Atilde;O</label></td>
                            </tr>
                            <tr>
                                <td align="left">9 - Utiliza transporte.</td>
                                <td colspan="2" align="center"><input type="radio" required name="beneficio9" id="beneficio9" value="1"  /> <label for="beneficio9">SIM</label></td>
                                <td colspan="2" align="center"><input type="radio" required name="beneficio9" id="beneficio9a" value="0" /> <label for="beneficio9a">N&Atilde;O</label></td>
                            </tr>
                            <tr>
                                <td align="left">10 - Utiliza servi&ccedil;os do restaurante/VR.</td>
                                <td colspan="2" align="center"><input type="radio" required name="beneficio10" id="beneficio10" value="1"  /> <label for="beneficio10">SIM</label></td>
                                <td colspan="2" align="center"><input type="radio" required name="beneficio10" id="beneficio10a" value="0" /> <label for="beneficio10a">N&Atilde;O</label></td>
                            </tr>
                            <tr>
                                <td align="left">11 - Utiliza conv&ecirc;nio odontol&oacute;gico.</td>
                                <td colspan="2" align="center"><input type="radio" required name="beneficio11" id="beneficio11" value="1"  /> <label for="beneficio11">SIM</label></td>
                                <td colspan="2" align="center"><input type="radio" required name="beneficio11" id="beneficio11a" value="0" /> <label for="beneficio11a">N&Atilde;O</label></td>
                            </tr>
                            <tr>
                                <td align="left"><strong>Justifique: "Discordo totalmente", "Discordo parcialmente":</strong></td>
                                <td colspan="4"><input type="text" class="form-control" name="beneficio_justificativa" id="beneficio_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12">
                <h3>Gestores</h3>
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
                                <td align="left">1 - O meu superior imediato &eacute; um l&iacute;der de respeito e credibilidade.</td>
                                <td align="center"><input type="radio" required name="gestores1" id="gestores1" value="1"  /></td>
                                <td align="center"><input type="radio" required name="gestores1" id="gestores1" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores1" id="gestores1" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores1" id="gestores1" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="gestores1" id="gestores1" value="4" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">2 - Recebo claramente de meu superior imediato todas as orienta&ccedil;&otilde;es que preciso para fazer bem o meu trabalho.</td>
                                <td align="center"><input type="radio" required name="gestores2" id="gestores2" value="1"  /></td>
                                <td align="center"><input type="radio" required name="gestores2" id="gestores2" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores2" id="gestores2" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores2" id="gestores2" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="gestores2" id="gestores2" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">3 - Tenho um bom relacionamento com meu superior imediato.</td>
                                <td align="center"><input type="radio" required name="gestores3" id="gestores3" value="1"  /></td>
                                <td align="center"><input type="radio" required name="gestores3" id="gestores3" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores3" id="gestores3" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores3" id="gestores3" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="gestores3" id="gestores3" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">4 - Meu superior imediato conhece profundamente sua &aacute;rea de atua&ccedil;&atilde;o.</td>
                                <td align="center"><input type="radio" required name="gestores4" id="gestores4" value="1"  /></td>
                                <td align="center"><input type="radio" required name="gestores4" id="gestores4" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores4" id="gestores4" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores4" id="gestores4" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="gestores4" id="gestores4" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">5 - Sou reconhecido pelo meu superior imediato quando realizo um bom trabalho.</td>
                                <td align="center"><input type="radio" required name="gestores5" id="gestores5" value="1"  /></td>
                                <td align="center"><input type="radio" required name="gestores5" id="gestores5" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores5" id="gestores5" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores5" id="gestores5" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="gestores5" id="gestores5" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">6 - Sinto-me estimulado pelo gestor a buscar novos conhecimentos fora da empresa.</td>
                                <td align="center"><input type="radio" required name="gestores6" id="gestores6" value="1"  /></td>
                                <td align="center"><input type="radio" required name="gestores6" id="gestores6" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores6" id="gestores6" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores6" id="gestores6" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="gestores6" id="gestores6" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">7 - Sou sempre bem atendido quando pe&ccedil;o orienta&ccedil;&otilde;es ao meu superior imediato.</td>
                                <td align="center"><input type="radio" required name="gestores7" id="gestores7" value="1"  /></td>
                                <td align="center"><input type="radio" required name="gestores7" id="gestores7" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores7" id="gestores7" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores7" id="gestores7" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="gestores7" id="gestores7" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">8 - Tenho a liberdade em recorrer ao meu superior imediato quando me sentir injusti&ccedil;ado.</td>
                                <td align="center"><input type="radio" required name="gestores8" id="gestores8" value="1"  /></td>
                                <td align="center"><input type="radio" required name="gestores8" id="gestores8" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores8" id="gestores8" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores8" id="gestores8" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="gestores8" id="gestores8" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">9 - Meu superior imediato ouve e respeita a opini&atilde;o da sua equipe.</td>
                                <td align="center"><input type="radio" required name="gestores9" id="gestores9" value="1"  /></td>
                                <td align="center"><input type="radio" required name="gestores9" id="gestores9" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores9" id="gestores9" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores9" id="gestores9" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="gestores9" id="gestores9" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">10 - Sempre que preciso, posso contar com meu superior imediato para assuntos pessoais.</td>
                                <td align="center"><input type="radio" required name="gestores10" id="gestores10" value="1"  /></td>
                                <td align="center"><input type="radio" required name="gestores10" id="gestores10" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores10" id="gestores10" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores10" id="gestores10" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="gestores10" id="gestores10" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">11 - Tenho todo equipamento e material necess&aacute;rios para realizar bem o meu trabalho.</td>
                                <td align="center"><input type="radio" required name="gestores11" id="gestores11" value="1"  /></td>
                                <td align="center"><input type="radio" required name="gestores11" id="gestores11" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores11" id="gestores11" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores11" id="gestores11" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="gestores11" id="gestores11" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">12 - Meu superior imediato &eacute; coerente, usa "o mesmo peso e a mesma medida" nas suas decis&otilde;es.</td>
                                <td align="center"><input type="radio" required name="gestores12" id="gestores12" value="1"  /></td>
                                <td align="center"><input type="radio" required name="gestores12" id="gestores12" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores12" id="gestores12" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores12" id="gestores12" value="4" /></td>
                                <!-- <td align="center"><input type="radio" required name="gestores12" id="gestores12" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">13 - Meu superior imediato ajuda a decidir o que devo fazer para aprender mais.</td>
                                <td align="center"><input type="radio" required name="gestores13" id="gestores13" value="1"  /></td>
                                <td align="center"><input type="radio" required name="gestores13" id="gestores13" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores13" id="gestores13" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores13" id="gestores13" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="gestores13" id="gestores13" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">14 - Sinto-me livre para contribuir com cr&iacute;ticas e sugest&otilde;es ao meu superior imediato.</td>
                                <td align="center"><input type="radio" required name="gestores14" id="gestores14" value="1"  /></td>
                                <td align="center"><input type="radio" required name="gestores14" id="gestores14" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores14" id="gestores14" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores14" id="gestores14" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="gestores14" id="gestores14" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">15 - Sou estimulado a sempre melhorar a forma como &eacute; feito o meu trabalho.</td>
                                <td align="center"><input type="radio" required name="gestores15" id="gestores15" value="1"  /></td>
                                <td align="center"><input type="radio" required name="gestores15" id="gestores15" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores15" id="gestores15" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores15" id="gestores15" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="gestores15" id="gestores15" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">16 - Tenho confian&ccedil;a naquilo que meu superior imediato diz.</td>
                                <td align="center"><input type="radio" required name="gestores16" id="gestores16" value="1"  /></td>
                                <td align="center"><input type="radio" required name="gestores16" id="gestores16" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores16" id="gestores16" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores16" id="gestores16" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="gestores16" id="gestores16" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">17 - Na PremieRpet<sup>&reg;</sup> todos os gestores agem de acordo com o que dizem.</td>
                                <td align="center"><input type="radio" required name="gestores17" id="gestores17" value="1"  /></td>
                                <td align="center"><input type="radio" required name="gestores17" id="gestores17" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores17" id="gestores17" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores17" id="gestores17" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="gestores17" id="gestores17" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">18 - Os gestores sabem demonstrar como podemos contribuir com os objetivos da PremieRpet<sup>&reg;</sup>.</td>
                                <td align="center"><input type="radio" required name="gestores18" id="gestores18" value="1"  /></td>
                                <td align="center"><input type="radio" required name="gestores18" id="gestores18" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores18" id="gestores18" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores18" id="gestores18" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="gestores18" id="gestores18" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left"><strong>Justifique: "Discordo totalmente", "Discordo parcialmente":</strong></td>
                                <td colspan="4"><input type="text" class="form-control" name="gestores_justificativa" id="gestores_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12">
                <h3>Recursos Humanos</h3>
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
                                <td align="left">1 - As a&ccedil;&otilde;es do RH s&atilde;o compat&iacute;veis &agrave; realidade dos colaboradores.</td>
                                <td align="center"><input type="radio" required name="recursos_humanos1" id="recursos_humanos1" value="1"  /></td>
                                <td align="center"><input type="radio" required name="recursos_humanos1" id="recursos_humanos1" value="2" /></td>
                                <td align="center"><input type="radio" required name="recursos_humanos1" id="recursos_humanos1" value="3" /></td>
                                <td align="center"><input type="radio" required name="recursos_humanos1" id="recursos_humanos1" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="recursos_humanos1" id="recursos_humanos1" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">2 - O RH tem um trabalho de qualidade.</td>
                                <td align="center"><input type="radio" required name="recursos_humanos2" id="recursos_humanos2" value="1"  /></td>
                                <td align="center"><input type="radio" required name="recursos_humanos2" id="recursos_humanos2" value="2" /></td>
                                <td align="center"><input type="radio" required name="recursos_humanos2" id="recursos_humanos2" value="3" /></td>
                                <td align="center"><input type="radio" required name="recursos_humanos2" id="recursos_humanos2" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="recursos_humanos2" id="recursos_humanos2" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">3 - O RH tem um trabalho na velocidade necess&aacute;ria ao colaborador.</td>
                                <td align="center"><input type="radio" required name="recursos_humanos3" id="recursos_humanos3" value="1"  /></td>
                                <td align="center"><input type="radio" required name="recursos_humanos3" id="recursos_humanos3" value="2" /></td>
                                <td align="center"><input type="radio" required name="recursos_humanos3" id="recursos_humanos3" value="3" /></td>
                                <td align="center"><input type="radio" required name="recursos_humanos3" id="recursos_humanos3" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="recursos_humanos3" id="recursos_humanos3" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">4 - O RH presta um bom atendimento e aten&ccedil;&atilde;o aos colaboradores.</td>
                                <td align="center"><input type="radio" required name="recursos_humanos4" id="recursos_humanos4" value="1"  /></td>
                                <td align="center"><input type="radio" required name="recursos_humanos4" id="recursos_humanos4" value="2" /></td>
                                <td align="center"><input type="radio" required name="recursos_humanos4" id="recursos_humanos4" value="3" /></td>
                                <td align="center"><input type="radio" required name="recursos_humanos4" id="recursos_humanos4" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="recursos_humanos4" id="recursos_humanos4" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left"><strong>Justifique: "Discordo totalmente", "Discordo parcialmente":</strong></td>
                                <td colspan="4"><input type="text" class="form-control" name="recursos_humanos_justificativa" id="recursos_humanos_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12">
                <h3>Comunica&ccedil;&atilde;o Interna</h3>
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
                                <td align="left">1 - A comunica&ccedil;&atilde;o interna &eacute; clara e objetiva.</td>
                                <td align="center"><input type="radio" required name="comunicacao_interna1" id="comunicacao_interna1" value="1"  /></td>
                                <td align="center"><input type="radio" required name="comunicacao_interna1" id="comunicacao_interna1" value="2" /></td>
                                <td align="center"><input type="radio" required name="comunicacao_interna1" id="comunicacao_interna1" value="3" /></td>
                                <td align="center"><input type="radio" required name="comunicacao_interna1" id="comunicacao_interna1" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="comunicacao_interna1" id="comunicacao_interna1" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">2 - A comunica&ccedil;&atilde;o interna realiza um trabalho de qualidade.</td>
                                <td align="center"><input type="radio" required name="comunicacao_interna2" id="comunicacao_interna2" value="1"  /></td>
                                <td align="center"><input type="radio" required name="comunicacao_interna2" id="comunicacao_interna2" value="2" /></td>
                                <td align="center"><input type="radio" required name="comunicacao_interna2" id="comunicacao_interna2" value="3" /></td>
                                <td align="center"><input type="radio" required name="comunicacao_interna2" id="comunicacao_interna2" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="comunicacao_interna2" id="comunicacao_interna2" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left"><strong>Justifique: "Discordo totalmente", "Discordo parcialmente":</strong></td>
                                <td colspan="4"><input type="text" class="form-control" name="comunicacao_interna_justificativa" id="comunicacao_interna_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php if($rs[0]['seguranca_trabalho'] == 1) { ?>
            <div class="col-xs-12 col-md-12 col-lg-12">
                <h3>Seguran&ccedil;a do Trabalho</h3>
                <p class="text-danger" style="display:none;">Somente colaboradores da f&aacute;brica preenchem</p>
                <div class="panel panel-default">
                    <div class="row">
                        <div style="padding: 15px; padding-top: 0;">
                            <div style="padding: 0px; background-color: #fff; box-shadow: #cccccc .1em .1em .3em;">
                                <table  class="table" style="box-shadow: none; border-right: 0px !important;">
                                    <tr>
                                        <td><span class="text-primary">Utiliza Seguran&ccedil;a do trabalho?</span></td>
                                        <td><img src="img/arrow_right.png" width="20"></td>
                                        <td><input type="radio" name="seguranca_trabalho" onclick="showDiv('seguranca_trabalho',1)" required="required" value="1"> Sim</td>
                                        <td><input type="radio" name="seguranca_trabalho" onclick="showDiv('seguranca_trabalho',0)" required="required" value="0"> N&atilde;o</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <table class="table table-hover table-condensed table-responsive table-bordered table-striped" id="seguranca_trabalho">
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
                                <td align="left">1 - Existe uma orienta&ccedil;&atilde;o da equipe de seguran&ccedil;a do trabalho sobre a utiliza&ccedil;&atilde;o de EPI's.</td>
                                <td align="center"><input type="radio" name="seguranca_trabalho1" id="seguranca_trabalho1" value="1"  /></td>
                                <td align="center"><input type="radio" name="seguranca_trabalho1" id="seguranca_trabalho1" value="2" /></td>
                                <td align="center"><input type="radio" name="seguranca_trabalho1" id="seguranca_trabalho1" value="3" /></td>
                                <td align="center"><input type="radio" name="seguranca_trabalho1" id="seguranca_trabalho1" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="seguranca_trabalho1" id="seguranca_trabalho1" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">2 - A seguran&ccedil;a do trabalho realiza um trabalho de qualidade .</td>
                                <td align="center"><input type="radio" name="seguranca_trabalho2" id="seguranca_trabalho2" value="1"  /></td>
                                <td align="center"><input type="radio" name="seguranca_trabalho2" id="seguranca_trabalho2" value="2" /></td>
                                <td align="center"><input type="radio" name="seguranca_trabalho2" id="seguranca_trabalho2" value="3" /></td>
                                <td align="center"><input type="radio" name="seguranca_trabalho2" id="seguranca_trabalho2" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="seguranca_trabalho2" id="seguranca_trabalho2" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left"><strong>Justifique: "Discordo totalmente", "Discordo parcialmente":</strong></td>
                                <td colspan="4"><input type="text" class="form-control" name="seguranca_trabalho_justificativa" id="seguranca_trabalho_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php } ?>
            <?php if($rs[0]['ti'] == 1) { ?>
            <div class="col-xs-12 col-md-12 col-lg-12">
                <h3>Tecnologia da Informa&ccedil;&atilde;o TI</h3>
                <p class="text-danger" style="display:none;">Somente colaboradores do escrit&oacute;rio e &aacute;reas administrativas preenchem</p>
                <div class="panel panel-default">
                    <div class="row">
                        <div style="padding: 15px; padding-top: 0;">
                            <div style="padding: 0px; background-color: #fff; box-shadow: #cccccc .1em .1em .3em;">
                                <table  class="table" style="box-shadow: none; border-right: 0px !important;">
                                    <tr>
                                        <td><span class="text-primary">Utiliza Tecnologia da Informa&ccedil;&atilde;o TI?</span></td>
                                        <td><img src="img/arrow_right.png" width="20"></td>
                                        <td><input type="radio" name="tecnologia_informacao" onclick="showDiv('tecnologia_informacao',1)" required="required" value="1"> Sim</td>
                                        <td><input type="radio" name="tecnologia_informacao" onclick="showDiv('tecnologia_informacao',0)" required="required" value="0"> N&atilde;o</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <table class="table table-hover table-condensed table-responsive table-bordered table-striped" id="tecnologia_informacao">
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
                                <td align="left">1 - O departamento de TI cumpre os prazos de atendimento aos colaboradores. </td>
                                <td align="center"><input type="radio" name="tecnologia_informacao1" id="tecnologia_informacao1" value="1"  /></td>
                                <td align="center"><input type="radio" name="tecnologia_informacao1" id="tecnologia_informacao1" value="2" /></td>
                                <td align="center"><input type="radio" name="tecnologia_informacao1" id="tecnologia_informacao1" value="3" /></td>
                                <td align="center"><input type="radio" name="tecnologia_informacao1" id="tecnologia_informacao1" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="tecnologia_informacao1" id="tecnologia_informacao1" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">2 - Os sistemas utilizados na empresa atendem as necessidades gerais.</td>
                                <td align="center"><input type="radio" name="tecnologia_informacao2" id="tecnologia_informacao2" value="1"  /></td>
                                <td align="center"><input type="radio" name="tecnologia_informacao2" id="tecnologia_informacao2" value="2" /></td>
                                <td align="center"><input type="radio" name="tecnologia_informacao2" id="tecnologia_informacao2" value="3" /></td>
                                <td align="center"><input type="radio" name="tecnologia_informacao2" id="tecnologia_informacao2" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="tecnologia_informacao2" id="tecnologia_informacao2" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">3 - O departamento de TI realiza um trabalho de qualidade.</td>
                                <td align="center"><input type="radio" name="tecnologia_informacao3" id="tecnologia_informacao3" value="1"  /></td>
                                <td align="center"><input type="radio" name="tecnologia_informacao3" id="tecnologia_informacao3" value="2" /></td>
                                <td align="center"><input type="radio" name="tecnologia_informacao3" id="tecnologia_informacao3" value="3" /></td>
                                <td align="center"><input type="radio" name="tecnologia_informacao3" id="tecnologia_informacao3" value="4" /></td>
                                <!--<td align="center"><input type="radio" required name="tecnologia_informacao3" id="tecnologia_informacao3" value="5" /></td>-->
                            </tr>
                            <tr>
                                <td align="left">4 - Uiliza TI.</td>
                                <td colspan="2" align="center"><input type="radio" required name="tecnologia_informacao4" id="tecnologia_informacao4" value="1"  /> <label for="tecnologia_informacao4">SIM</label></td>
                                <td colspan="2" align="center"><input type="radio" required name="tecnologia_informacao4" id="tecnologia_informacao4a" value="0" /> <label for="tecnologia_informacao4a">N&Atilde;O</label></td>
                            </tr>
                            <tr>
                                <td align="left"><strong>Justifique: "Discordo totalmente", "Discordo parcialmente":</strong></td>
                                <td colspan="4"><input type="text" class="form-control" name="tecnologia_informacao_justificativa" id="tecnologia_informacao_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php } ?>
            <div class="col-xs-12 col-md-12 col-lg-12">
                <h3>Outros</h3>
                <div class="panel panel-default">
                    <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
                        <thead>
                            <tr>
                                <td align="left"><strong>1 - H&aacute; quanto tempo trabalha na empresa?</strong></td>
                                <td align="center"><input type="radio" required name="trabalho" id="trabalho" value="1"  />
                                    Menos de um ano
                                </td>
                                <td align="center"><input type="radio" required name="trabalho" id="trabalho" value="2" />
                                    Mais de um ano
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="left" colspan="4">Coment&aacute;rios</td>
                            </tr>
                            <tr>
                                <td align="center" colspan="4"><textarea class="form-control" style="resize:none; height:100px;" placeholder="Informe aqui qualquer tipo de coment&aacute;rio" name="comentario" id="comentario" ></textarea></td>
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