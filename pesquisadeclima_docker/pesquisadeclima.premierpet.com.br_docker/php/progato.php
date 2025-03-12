<?php
    $nome_empresa_form = "Progato";
?>

<nav class="navbar navbar-default" style="margin-top: -40px;">
    <div class="container" style="margin-top:5px; margin-bottom:10px; line-height:20px;">
        <div class="row">
            <div class="col-xs-12 col-md-8 col-lg-8">
                <img src="<?php echo URL; ?>img/logo_progato.png" class="img-responsive pull-left" style="max-height:100px; margin-top:0px;" />
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
                <li><a href="javascript:void(0)">Progato</a></li>
                <li><a href="javascript:void(0)">Setor</a></li>
                <li class="active">Pesquisa Progato</li>
            </ol>
        </div>
    </div>
</div>
<?php
    $db = new Conexao($banco);
    $rs = $db->sel("SELECT seguranca_trabalho, ti FROM premier_setor WHERE id = " . (int) $_SESSION['premier_setor'] . ";");
    $db = NULL;
    
    ?>
<form action="xhr/progato.php" id="form">
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
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="left">1 - Eu recomendaria aos meus parentes e amigos a Empresa como um excelente lugar para trabalhar.</td>
                                <td align="center"><input type="radio" required name="direcao1" id="direcao1" value="1" /></td>
                                <td align="center"><input type="radio" required name="direcao1" id="direcao1" value="2" /></td>
                                <td align="center"><input type="radio" required name="direcao1" id="direcao1" value="3" /></td>
                                <td align="center"><input type="radio" required name="direcao1" id="direcao1" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">2 - O ambiente de trabalho da Empresa facilita o relacionamento entre os colaboradores.</td>
                                <td align="center"><input type="radio" required name="direcao2" id="direcao2" value="1" /></td>
                                <td align="center"><input type="radio" required name="direcao2" id="direcao2" value="2" /></td>
                                <td align="center"><input type="radio" required name="direcao2" id="direcao2" value="3" /></td>
                                <td align="center"><input type="radio" required name="direcao2" id="direcao2" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">3 - Do ano passado para c&aacute; a empresa melhorou.</td>
                                <td align="center"><input type="radio" required name="direcao3" id="direcao3" value="1" /></td>
                                <td align="center"><input type="radio" required name="direcao3" id="direcao3" value="2" /></td>
                                <td align="center"><input type="radio" required name="direcao3" id="direcao3" value="3" /></td>
                                <td align="center"><input type="radio" required name="direcao3" id="direcao3" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">4 - A empresa faz voc&ecirc; se sentir importante no que faz.</td>
                                <td align="center"><input type="radio" required name="direcao4" id="direcao4" value="1" /></td>
                                <td align="center"><input type="radio" required name="direcao4" id="direcao4" value="2" /></td>
                                <td align="center"><input type="radio" required name="direcao4" id="direcao4" value="3" /></td>
                                <td align="center"><input type="radio" required name="direcao4" id="direcao4" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">5 - Os processos, procedimentos e rotinas de trabalho da Empresa s&atilde;o organizados e eficientes.</td>
                                <td align="center"><input type="radio" required name="direcao5" id="direcao5" value="1" /></td>
                                <td align="center"><input type="radio" required name="direcao5" id="direcao5" value="2" /></td>
                                <td align="center"><input type="radio" required name="direcao5" id="direcao5" value="3" /></td>
                                <td align="center"><input type="radio" required name="direcao5" id="direcao5" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">6 - Tenho confian&ccedil;a no Futuro da Empresa.</td>
                                <td align="center"><input type="radio" required name="direcao6" id="direcao6" value="1" /></td>
                                <td align="center"><input type="radio" required name="direcao6" id="direcao6" value="2" /></td>
                                <td align="center"><input type="radio" required name="direcao6" id="direcao6" value="3" /></td>
                                <td align="center"><input type="radio" required name="direcao6" id="direcao6" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">7 - Tenho orgulho e gosto de trabalhar na Empresa.</td>
                                <td align="center"><input type="radio" required name="direcao7" id="direcao7" value="1" /></td>
                                <td align="center"><input type="radio" required name="direcao7" id="direcao7" value="2" /></td>
                                <td align="center"><input type="radio" required name="direcao7" id="direcao7" value="3" /></td>
                                <td align="center"><input type="radio" required name="direcao7" id="direcao7" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">8 - Seus colegas de trabalho se sentem compromissados em, juntos desempenharem um trabalho com qualidade.</td>
                                <td align="center"><input type="radio" required name="direcao8" id="direcao8" value="1" /></td>
                                <td align="center"><input type="radio" required name="direcao8" id="direcao8" value="2" /></td>
                                <td align="center"><input type="radio" required name="direcao8" id="direcao8" value="3" /></td>
                                <td align="center"><input type="radio" required name="direcao8" id="direcao8" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">9 - Os objetivos da empresa s&atilde;o claros e divulgados a todos os colaboradores.</td>
                                <td align="center"><input type="radio" required name="direcao9" id="direcao9" value="1" /></td>
                                <td align="center"><input type="radio" required name="direcao9" id="direcao9" value="2" /></td>
                                <td align="center"><input type="radio" required name="direcao9" id="direcao9" value="3" /></td>
                                <td align="center"><input type="radio" required name="direcao9" id="direcao9" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">10 - A Empresa ouve e coloca em pr&aacute;tica as sugest&otilde;es de seus colaboradores.</td>
                                <td align="center"><input type="radio" required name="direcao10" id="direcao10" value="1" /></td>
                                <td align="center"><input type="radio" required name="direcao10" id="direcao10" value="2" /></td>
                                <td align="center"><input type="radio" required name="direcao10" id="direcao10" value="3" /></td>
                                <td align="center"><input type="radio" required name="direcao10" id="direcao10" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left"><strong>Justifique todas as respostas em que voc&ecirc; assinalou discordo totalmente ou parcialmente:</strong></td>
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
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5"><span class="text-primary">1 - Voc&ecirc; possui o plano de sa&uacute;de da empresa?</span> <input type="radio" name="beneficio_convenio_medico" onclick="showDiv('beneficio_convenio_medico',1)" required="required" value="1"> Sim <input type="radio" name="beneficio_convenio_medico" onclick="showDiv('beneficio_convenio_medico',0)" required="required" value="0"> N&atilde;o
                                </td>
                            </tr>
                            <tr id="beneficio_convenio_medico">
                                <td align="left">O plano de sa&uacute;de atende as minhas necessidades e da minha fam&iacute;lia.</td>
                                <td align="center"><input type="radio" name="beneficio1" id="beneficio1" value="1" /></td>
                                <td align="center"><input type="radio" name="beneficio1" id="beneficio1" value="2" /></td>
                                <td align="center"><input type="radio" name="beneficio1" id="beneficio1" value="3" /></td>
                                <td align="center"><input type="radio" name="beneficio1" id="beneficio1" value="4" /></td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <span class="text-primary">2 - Voc&ecirc; possui o plano odontol&oacute;gico da empresa?</span>
                                    <input type="radio" name="beneficio_odontologico"  onclick="showDiv('beneficio_odontologico',1)" required="required" value="1"> Sim
                                    <input type="radio" name="beneficio_odontologico"  onclick="showDiv('beneficio_odontologico',0)" required="required" value="0"> N&atilde;o
                                </td>
                            </tr>
                            <tr id="beneficio_odontologico">
                                <td align="left">O plano odontol&oacute;gico atende as minhas necessidades e da minha fam&iacute;lia.</td>
                                <td align="center"><input type="radio" name="beneficio2" id="beneficio2" value="1" /></td>
                                <td align="center"><input type="radio" name="beneficio2" id="beneficio2" value="2" /></td>
                                <td align="center"><input type="radio" name="beneficio2" id="beneficio2" value="3" /></td>
                                <td align="center"><input type="radio" name="beneficio2" id="beneficio2" value="4" /></td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <span class="text-primary">3 - Voc&ecirc; utiliza o Vale Combustível?</span>
                                    <input type="radio" name="beneficio_transporte" onclick="showDiv('beneficio_transporte',1)" required="required" value="1"> Sim
                                    <input type="radio" name="beneficio_transporte" onclick="showDiv('beneficio_transporte',0)" required="required" value="0"> N&atilde;o
                                </td>
                            </tr>
                            <tr id="beneficio_transporte">
                                <td align="left">O Vale combustível atende as necessidades dos colaboradores..</td>
                                <td align="center"><input type="radio" name="beneficio3" id="beneficio3" value="1" /></td>
                                <td align="center"><input type="radio" name="beneficio3" id="beneficio3" value="2" /></td>
                                <td align="center"><input type="radio" name="beneficio3" id="beneficio3" value="3" /></td>
                                <td align="center"><input type="radio" name="beneficio3" id="beneficio3" value="4" /></td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <span class="text-primary">4 - Voc&ecirc; utiliza o servi&ccedil;o de restaurante oferecido pela empresa?</span>
                                    <input type="radio" name="beneficio_vr" onclick="showDiv('beneficio_vr',1)" required="required" value="1"> Sim
                                    <input type="radio" name="beneficio_vr" onclick="showDiv('beneficio_vr',0)" required="required" value="0"> N&atilde;o
                                </td>
                            </tr>
                            <tr id="beneficio_vr">
                                <td align="left">O servi&ccedil;o do restaurante atende as necessidades dos colaboradores.</td>
                                <td align="center"><input type="radio" name="beneficio4" id="beneficio4" value="1" /></td>
                                <td align="center"><input type="radio" name="beneficio4" id="beneficio4" value="2" /></td>
                                <td align="center"><input type="radio" name="beneficio4" id="beneficio4" value="3" /></td>
                                <td align="center"><input type="radio" name="beneficio4" id="beneficio4" value="4" /></td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <span class="text-primary">5 - Você utiliza o cartão da Golden Farma?</span>
                                    <input type="radio" name="beneficio_golden" onclick="showDiv('beneficio_golden',1)" required="required" value="1"> Sim
                                    <input type="radio" name="beneficio_golden" onclick="showDiv('beneficio_golden',0)" required="required" value="0"> N&atilde;o
                                </td>
                            </tr>
                            <tr id="beneficio_golden">
                                <td align="left">O benefício da Golden Farma, atende as minhas necessidades.</td>
                                <td align="center"><input type="radio" required name="beneficio5" id="beneficio5" value="1" /></td>
                                <td align="center"><input type="radio" required name="beneficio5" id="beneficio5" value="2" /></td>
                                <td align="center"><input type="radio" required name="beneficio5" id="beneficio5" value="3" /></td>
                                <td align="center"><input type="radio" required name="beneficio5" id="beneficio5" value="4" /></td>
                            </tr>
                            <!-- <tr>
                                <td align="left">6 - Estou satisfeito com o  resultado do PPR - Programa de Participa&ccedil;&atilde;o nos Resultados.</td>
                                <td align="center"><input type="radio" required name="beneficio6" id="beneficio6" value="1" /></td>
                                <td align="center"><input type="radio" required name="beneficio6" id="beneficio6" value="2" /></td>
                                <td align="center"><input type="radio" required name="beneficio6" id="beneficio6" value="3" /></td>
                                <td align="center"><input type="radio" required name="beneficio6" id="beneficio6" value="4" /></td>
                            </tr> -->
                            <tr>
                                <td align="left"><strong>Justifique todas as respostas em que voc&ecirc; assinalou discordo totalmente ou parcialmente:</strong></td>
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
                                <td align="center"><input type="radio" required name="gestores1" id="gestores1" value="1" /></td>
                                <td align="center"><input type="radio" required name="gestores1" id="gestores1" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores1" id="gestores1" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores1" id="gestores1" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">2 - Recebo claramente de meu superior imediato todas as orienta&ccedil;&otilde;es que preciso para fazer bem o meu trabalho.</td>
                                <td align="center"><input type="radio" required name="gestores2" id="gestores2" value="1" /></td>
                                <td align="center"><input type="radio" required name="gestores2" id="gestores2" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores2" id="gestores2" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores2" id="gestores2" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">3 - Tenho um bom relacionamento com meu superior imediato.</td>
                                <td align="center"><input type="radio" required name="gestores3" id="gestores3" value="1" /></td>
                                <td align="center"><input type="radio" required name="gestores3" id="gestores3" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores3" id="gestores3" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores3" id="gestores3" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">4 - Meu superior imediato conhece profundamente sua &aacute;rea de atua&ccedil;&atilde;o.</td>
                                <td align="center"><input type="radio" required name="gestores4" id="gestores4" value="1" /></td>
                                <td align="center"><input type="radio" required name="gestores4" id="gestores4" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores4" id="gestores4" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores4" id="gestores4" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">5 - Sou reconhecido pelo meu superior imediato quando realizo um bom trabalho.</td>
                                <td align="center"><input type="radio" required name="gestores5" id="gestores5" value="1" /></td>
                                <td align="center"><input type="radio" required name="gestores5" id="gestores5" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores5" id="gestores5" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores5" id="gestores5" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">6 - Sinto-me estimulado pelo gestor a buscar novos conhecimentos fora da empresa.</td>
                                <td align="center"><input type="radio" required name="gestores6" id="gestores6" value="1" /></td>
                                <td align="center"><input type="radio" required name="gestores6" id="gestores6" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores6" id="gestores6" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores6" id="gestores6" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">7 - Sou sempre bem atendido quando pe&ccedil;o orienta&ccedil;&otilde;es ao meu superior imediato.</td>
                                <td align="center"><input type="radio" required name="gestores7" id="gestores7" value="1" /></td>
                                <td align="center"><input type="radio" required name="gestores7" id="gestores7" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores7" id="gestores7" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores7" id="gestores7" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">8 - Tenho a liberdade em recorrer ao meu superior imediato quando me sentir injusti&ccedil;ado.</td>
                                <td align="center"><input type="radio" required name="gestores8" id="gestores8" value="1" /></td>
                                <td align="center"><input type="radio" required name="gestores8" id="gestores8" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores8" id="gestores8" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores8" id="gestores8" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">9 - Meu superior imediato ouve e respeita a opini&atilde;o da sua equipe.</td>
                                <td align="center"><input type="radio" required name="gestores9" id="gestores9" value="1" /></td>
                                <td align="center"><input type="radio" required name="gestores9" id="gestores9" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores9" id="gestores9" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores9" id="gestores9" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">10 - Sempre que preciso, posso contar com meu superior imediato para assuntos pessoais.</td>
                                <td align="center"><input type="radio" required name="gestores10" id="gestores10" value="1" /></td>
                                <td align="center"><input type="radio" required name="gestores10" id="gestores10" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores10" id="gestores10" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores10" id="gestores10" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">11 - Tenho todo equipamento e material necess&aacute;rios para realizar bem o meu trabalho.</td>
                                <td align="center"><input type="radio" required name="gestores11" id="gestores11" value="1" /></td>
                                <td align="center"><input type="radio" required name="gestores11" id="gestores11" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores11" id="gestores11" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores11" id="gestores11" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">12 - Meu superior imediato &eacute; coerente, usa "o mesmo peso e a mesma medida" nas suas decis&otilde;es.</td>
                                <td align="center"><input type="radio" required name="gestores12" id="gestores12" value="1" /></td>
                                <td align="center"><input type="radio" required name="gestores12" id="gestores12" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores12" id="gestores12" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores12" id="gestores12" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">13 - Meu superior imediato ajuda a decidir o que devo fazer para aprender mais.</td>
                                <td align="center"><input type="radio" required name="gestores13" id="gestores13" value="1" /></td>
                                <td align="center"><input type="radio" required name="gestores13" id="gestores13" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores13" id="gestores13" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores13" id="gestores13" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">14 - Sinto-me livre para contribuir com cr&iacute;ticas e sugest&otilde;es ao meu superior imediato.</td>
                                <td align="center"><input type="radio" required name="gestores14" id="gestores14" value="1" /></td>
                                <td align="center"><input type="radio" required name="gestores14" id="gestores14" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores14" id="gestores14" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores14" id="gestores14" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">15 - Sou estimulado a sempre melhorar a forma como &eacute; feito o meu trabalho.</td>
                                <td align="center"><input type="radio" required name="gestores15" id="gestores15" value="1" /></td>
                                <td align="center"><input type="radio" required name="gestores15" id="gestores15" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores15" id="gestores15" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores15" id="gestores15" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">16 - Tenho confian&ccedil;a naquilo que meu superior imediato diz.</td>
                                <td align="center"><input type="radio" required name="gestores16" id="gestores16" value="1" /></td>
                                <td align="center"><input type="radio" required name="gestores16" id="gestores16" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores16" id="gestores16" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores16" id="gestores16" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">17 - Na Empresa todos os gestores agem de acordo com o que dizem.</td>
                                <td align="center"><input type="radio" required name="gestores17" id="gestores17" value="1" /></td>
                                <td align="center"><input type="radio" required name="gestores17" id="gestores17" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores17" id="gestores17" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores17" id="gestores17" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">18 - Os gestores sabem demonstrar como podemos contribuir com os objetivos da Empresa.</td>
                                <td align="center"><input type="radio" required name="gestores18" id="gestores18" value="1" /></td>
                                <td align="center"><input type="radio" required name="gestores18" id="gestores18" value="2" /></td>
                                <td align="center"><input type="radio" required name="gestores18" id="gestores18" value="3" /></td>
                                <td align="center"><input type="radio" required name="gestores18" id="gestores18" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left"><strong>Justifique todas as respostas em que voc&ecirc; assinalou discordo totalmente ou parcialmente:</strong></td>
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
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="left">1 - As a&ccedil;&otilde;es do RH s&atilde;o compat&iacute;veis &agrave; realidade dos colaboradores.</td>
                                <td align="center"><input type="radio" required name="recursos_humanos1" id="recursos_humanos1" value="1" /></td>
                                <td align="center"><input type="radio" required name="recursos_humanos1" id="recursos_humanos1" value="2" /></td>
                                <td align="center"><input type="radio" required name="recursos_humanos1" id="recursos_humanos1" value="3" /></td>
                                <td align="center"><input type="radio" required name="recursos_humanos1" id="recursos_humanos1" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">2 - O RH tem um trabalho de qualidade.</td>
                                <td align="center"><input type="radio" required name="recursos_humanos2" id="recursos_humanos2" value="1" /></td>
                                <td align="center"><input type="radio" required name="recursos_humanos2" id="recursos_humanos2" value="2" /></td>
                                <td align="center"><input type="radio" required name="recursos_humanos2" id="recursos_humanos2" value="3" /></td>
                                <td align="center"><input type="radio" required name="recursos_humanos2" id="recursos_humanos2" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">3 - O RH tem um trabalho na velocidade necess&aacute;ria ao colaborador.</td>
                                <td align="center"><input type="radio" required name="recursos_humanos3" id="recursos_humanos3" value="1" /></td>
                                <td align="center"><input type="radio" required name="recursos_humanos3" id="recursos_humanos3" value="2" /></td>
                                <td align="center"><input type="radio" required name="recursos_humanos3" id="recursos_humanos3" value="3" /></td>
                                <td align="center"><input type="radio" required name="recursos_humanos3" id="recursos_humanos3" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">4 - O RH presta um bom atendimento e aten&ccedil;&atilde;o aos colaboradores.</td>
                                <td align="center"><input type="radio" required name="recursos_humanos4" id="recursos_humanos4" value="1" /></td>
                                <td align="center"><input type="radio" required name="recursos_humanos4" id="recursos_humanos4" value="2" /></td>
                                <td align="center"><input type="radio" required name="recursos_humanos4" id="recursos_humanos4" value="3" /></td>
                                <td align="center"><input type="radio" required name="recursos_humanos4" id="recursos_humanos4" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left"><strong>Justifique todas as respostas em que voc&ecirc; assinalou discordo totalmente ou parcialmente:</strong></td>
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
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="left">1 - A comunica&ccedil;&atilde;o interna &eacute; clara e objetiva.</td>
                                <td align="center"><input type="radio" required name="comunicacao_interna1" id="comunicacao_interna1" value="1" /></td>
                                <td align="center"><input type="radio" required name="comunicacao_interna1" id="comunicacao_interna1" value="2" /></td>
                                <td align="center"><input type="radio" required name="comunicacao_interna1" id="comunicacao_interna1" value="3" /></td>
                                <td align="center"><input type="radio" required name="comunicacao_interna1" id="comunicacao_interna1" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">2 - A comunica&ccedil;&atilde;o interna realiza um trabalho de qualidade.</td>
                                <td align="center"><input type="radio" required name="comunicacao_interna2" id="comunicacao_interna2" value="1" /></td>
                                <td align="center"><input type="radio" required name="comunicacao_interna2" id="comunicacao_interna2" value="2" /></td>
                                <td align="center"><input type="radio" required name="comunicacao_interna2" id="comunicacao_interna2" value="3" /></td>
                                <td align="center"><input type="radio" required name="comunicacao_interna2" id="comunicacao_interna2" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left"><strong>Justifique todas as respostas em que voc&ecirc; assinalou discordo totalmente ou parcialmente:</strong></td>
                                <td colspan="4"><input type="text" class="form-control" name="comunicacao_interna_justificativa" id="comunicacao_interna_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12">
                <h3>Seguran&ccedil;a do Trabalho</h3>
                <p class="text-danger" style="display:none;">Somente colaboradores da f&aacute;brica preenchem</p>
                <div class="panel panel-default">
                    <div class="row">
                        <div style="padding: 15px; padding-top: 0;">
                            <div style="padding: 0px; background-color: #fff; box-shadow: #cccccc .1em .1em .3em;">
                                <table  class="table" style="box-shadow: none; border-right: 0px !important;">
                                    <tr>
                                        <td><span class="text-primary">1 - Utiliza os servi&ccedil;os da equipe de Seguran&ccedil;a do Trabalho?</span> <input type="radio" name="seguranca_trabalho" onclick="showDiv('seguranca_trabalho',1)" required="required" value="1"> Sim <input type="radio" name="seguranca_trabalho" onclick="showDiv('seguranca_trabalho',0)" required="required" value="0"> N&atilde;o</td>
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
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="left">1 - Existe uma orienta&ccedil;&atilde;o da equipe de seguran&ccedil;a do trabalho sobre a utiliza&ccedil;&atilde;o de EPI's.</td>
                                <td align="center"><input type="radio" name="seguranca_trabalho1" id="seguranca_trabalho1" value="1" /></td>
                                <td align="center"><input type="radio" name="seguranca_trabalho1" id="seguranca_trabalho1" value="2" /></td>
                                <td align="center"><input type="radio" name="seguranca_trabalho1" id="seguranca_trabalho1" value="3" /></td>
                                <td align="center"><input type="radio" name="seguranca_trabalho1" id="seguranca_trabalho1" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">2 - A seguran&ccedil;a do trabalho realiza um trabalho de qualidade.</td>
                                <td align="center"><input type="radio" name="seguranca_trabalho2" id="seguranca_trabalho2" value="1" /></td>
                                <td align="center"><input type="radio" name="seguranca_trabalho2" id="seguranca_trabalho2" value="2" /></td>
                                <td align="center"><input type="radio" name="seguranca_trabalho2" id="seguranca_trabalho2" value="3" /></td>
                                <td align="center"><input type="radio" name="seguranca_trabalho2" id="seguranca_trabalho2" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left"><strong>Justifique todas as respostas em que voc&ecirc; assinalou discordo totalmente ou parcialmente:</strong></td>
                                <td colspan="4"><input type="text" class="form-control" name="seguranca_trabalho_justificativa" id="seguranca_trabalho_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12">
                <h3>Tecnologia da Informa&ccedil;&atilde;o TI</h3>
                <p class="text-danger" style="display:none;">Somente colaboradores do escrit&oacute;rio e &aacute;reas administrativas preenchem</p>
                <div class="panel panel-default">
                    <div class="row">
                        <div style="padding: 15px; padding-top: 0;">
                            <div style="padding: 0px; background-color: #fff; box-shadow: #cccccc .1em .1em .3em;">
                                <table  class="table" style="box-shadow: none; border-right: 0px !important;">
                                    <tr>
                                        <td><span class="text-primary">1 - Utiliza os servi&ccedil;os da equipe de Tecnologia da Informa&ccedil;&atilde;o TI?</span> <input type="radio" name="tecnologia_informacao" onclick="showDiv('tecnologia_informacao',1)" required="required" value="1"> Sim <input type="radio" name="tecnologia_informacao" onclick="showDiv('tecnologia_informacao',0)" required="required" value="0"> N&atilde;o</td>
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
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="left">1 - O departamento de TI cumpre os prazos de atendimento aos colaboradores.</td>
                                <td align="center"><input type="radio" name="tecnologia_informacao1" id="tecnologia_informacao1" value="1" /></td>
                                <td align="center"><input type="radio" name="tecnologia_informacao1" id="tecnologia_informacao1" value="2" /></td>
                                <td align="center"><input type="radio" name="tecnologia_informacao1" id="tecnologia_informacao1" value="3" /></td>
                                <td align="center"><input type="radio" name="tecnologia_informacao1" id="tecnologia_informacao1" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">2 - Os sistemas utilizados na empresa atendem as necessidades gerais.</td>
                                <td align="center"><input type="radio" name="tecnologia_informacao2" id="tecnologia_informacao2" value="1" /></td>
                                <td align="center"><input type="radio" name="tecnologia_informacao2" id="tecnologia_informacao2" value="2" /></td>
                                <td align="center"><input type="radio" name="tecnologia_informacao2" id="tecnologia_informacao2" value="3" /></td>
                                <td align="center"><input type="radio" name="tecnologia_informacao2" id="tecnologia_informacao2" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">3 - O departamento de TI realiza um trabalho de qualidade.</td>
                                <td align="center"><input type="radio" name="tecnologia_informacao3" id="tecnologia_informacao3" value="1" /></td>
                                <td align="center"><input type="radio" name="tecnologia_informacao3" id="tecnologia_informacao3" value="2" /></td>
                                <td align="center"><input type="radio" name="tecnologia_informacao3" id="tecnologia_informacao3" value="3" /></td>
                                <td align="center"><input type="radio" name="tecnologia_informacao3" id="tecnologia_informacao3" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left"><strong>Justifique todas as respostas em que voc&ecirc; assinalou discordo totalmente ou parcialmente:</strong></td>
                                <td colspan="4"><input type="text" class="form-control" name="tecnologia_informacao_justificativa" id="tecnologia_informacao_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12">
                <h3>Tempo de empresa e coment&aacute;rios</h3>
                <div class="panel panel-default">
                    <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
                        <thead>
                            <tr>
                                <td align="left"><strong>1 - H&aacute; quanto tempo trabalha na empresa?</strong></td>
                                <td align="center"><input type="radio" required name="trabalho" id="trabalho" value="1" />
                                    Menos de um ano
                                </td>
                                <td align="center"><input type="radio" required name="trabalho" id="trabalho" value="2" />
                                    Mais de um ano
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="left" colspan="5">Coment&aacute;rios gerais:</td>
                            </tr>
                            <tr>
                                <td align="center" colspan="5"><textarea class="form-control" style="resize:none; height:100px;" placeholder="Informe aqui qualquer tipo de coment&aacute;rio" name="comentario" id="comentario" ></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php if(1==2){ ?>
            <div class="col-xs-12 col-md-12 col-lg-12">
                <h3>Outros</h3>
                <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
                    <thead>
                        <tr>
                            <td>&nbsp;</td>
                            <td align="center"><strong>Discordo Totalmente</strong></td>
                            <td align="center"><strong>Discordo Parcialmente</strong></td>
                            <td align="center"><strong>Concordo Parcialmente</strong></td>
                            <td align="center"><strong>Concordo Totalmente</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="left">1 - A Cesta de Natal seca &eacute; &oacute;tima, e atende toda minha fam&iacute;lia.</td>
                            <td align="center"><input type="radio" name="outros1" id="outros1" value="1" /></td>
                            <td align="center"><input type="radio" name="outros1" id="outros1" value="2" /></td>
                            <td align="center"><input type="radio" name="outros1" id="outros1" value="3" /></td>
                            <td align="center"><input type="radio" name="outros1" id="outros1" value="4" /></td>
                        </tr>
                        <tr>
                            <td align="left">2 - A Cesta de Natal congelada &eacute; &oacute;tima, e atende toda minha fam&iacute;lia.</td>
                            <td align="center"><input type="radio" name="outros2" id="outros2" value="1" /></td>
                            <td align="center"><input type="radio" name="outros2" id="outros2" value="2" /></td>
                            <td align="center"><input type="radio" name="outros2" id="outros2" value="3" /></td>
                            <td align="center"><input type="radio" name="outros2" id="outros2" value="4" /></td>
                        </tr>
                        <tr>
                            <td colspan="5"><span class="text-primary">3 - Tem filhos at&eacute; 10 anos e recebe os brinquedos no final do ano?</span> <input type="radio" name="outros_brinquedos_final_ano" onclick="showDiv('outros_brinquedos_final_ano',1)" required="required" value="1"> Sim <input type="radio" name="outros_brinquedos_final_ano" onclick="showDiv('outros_brinquedos_final_ano',0)" required="required" value="0"> N&atilde;o
                            </td>
                        </tr>
                        <tr id="outros_brinquedos_final_ano" class="esconde">
                            <td align="left">Meus filhos adoram os brinquedos que ganham da empresa.</td>
                            <td align="center"><input type="radio" name="outros3" id="outros3" value="1" /></td>
                            <td align="center"><input type="radio" name="outros3" id="outros3" value="2" /></td>
                            <td align="center"><input type="radio" name="outros3" id="outros3" value="3" /></td>
                            <td align="center"><input type="radio" name="outros3" id="outros3" value="4" /></td>
                        </tr>
                        <tr>
                            <td colspan="5"><span class="text-primary">4 - Tem filhos de 3 a 10 anos e recebe o aux&iacute;lio material escolar no final do ano?</span> <input type="radio" name="outros4_div" onclick="showDiv('outros4_div',1)" required="required" value="1"> Sim <input type="radio" name="outros4_div" onclick="showDiv('outros4_div',0)" required="required" value="0"> N&atilde;o
                            </td>
                        </tr>
                        <tr id="outros4_div" class="esconde">
                            <td align="left">O auxilio material escolar &eacute; bom e me ajuda muito com os gastos do in&iacute;cio do ano.</td>
                            <td align="center"><input type="radio" name="outros4" id="outros4" value="1" /></td>
                            <td align="center"><input type="radio" name="outros4" id="outros4" value="2" /></td>
                            <td align="center"><input type="radio" name="outros4" id="outros4" value="3" /></td>
                            <td align="center"><input type="radio" name="outros4" id="outros4" value="4" /></td>
                        </tr>
                        <tr>
                            <td colspan="5"><span class="text-primary">5 - Utiliza o Aux&iacute;lio Estacionamento como benef&iacute;cio?</span> <input type="radio" name="outros5_div" onclick="showDiv('outros5_div',1)" required="required" value="1"> Sim <input type="radio" name="outros5_div" onclick="showDiv('outros5_div',0)" required="required" value="0"> N&atilde;o
                            </td>
                        </tr>
                        <tr id="outros5_div" class="esconde">
                            <td align="left">O aux&iacute;lio estacionamento &eacute; &oacute;timo e atende as minhas necessidades</td>
                            <td align="center"><input type="radio" name="outros5" id="outros5" value="1" /></td>
                            <td align="center"><input type="radio" name="outros5" id="outros5" value="2" /></td>
                            <td align="center"><input type="radio" name="outros5" id="outros5" value="3" /></td>
                            <td align="center"><input type="radio" name="outros5" id="outros5" value="4" /></td>
                        </tr>
                        <tr>
                            <td colspan="5"><span class="text-primary">6 - Voc&ecirc; possui o plano de previd&ecirc;ncia privada da empresa?</span> <input type="radio" name="outros6_div" onclick="showDiv('outros6_div',1)" required="required" value="1"> Sim <input type="radio" name="outros6_div" onclick="showDiv('outros6_div',0)" required="required" value="0"> N&atilde;o
                            </td>
                        </tr>
                        <tr id="outros6_div" class="esconde">
                            <td align="left">O plano de previd&ecirc;ncia privada atende as minhas expectativas</td>
                            <td align="center"><input type="radio" name="outros6" id="outros6" value="1" /></td>
                            <td align="center"><input type="radio" name="outros6" id="outros6" value="2" /></td>
                            <td align="center"><input type="radio" name="outros6" id="outros6" value="3" /></td>
                            <td align="center"><input type="radio" name="outros6" id="outros6" value="4" /></td>
                        </tr>
                        <tr>
                            <td colspan="5"><span class="text-primary">7 - Voc&ecirc; se sentiu amparado pela empresa at&eacute; este momento da pandemia da COVID-19?</span> <input type="radio" name="outros7_div" onclick="showDiv('outros7_div',1)" required="required" value="1"> Sim <input type="radio" name="outros7_div" onclick="showDiv('outros7_div',0)" required="required" value="0"> N&atilde;o
                            </td>
                        </tr>
                        <tr id="outros7_div" class="esconde">
                            <td align="left">As medidas de preven&ccedil;&atilde;o da Covid 19 implantadas pela empresa, atendeu minhas expectativas.</td>
                            <td align="center"><input type="radio" name="outros7" id="outros7" value="1" /></td>
                            <td align="center"><input type="radio" name="outros7" id="outros7" value="2" /></td>
                            <td align="center"><input type="radio" name="outros7" id="outros7" value="3" /></td>
                            <td align="center"><input type="radio" name="outros7" id="outros7" value="4" /></td>
                        </tr>
                        <tr>
                            <td align="left"><strong>Justifique todas as respostas em que voc&ecirc; assinalou discordo totalmente ou parcialmente:</strong></td>
                            <td colspan="4"><input type="text" class="form-control" name="outros_justificativa" id="outros_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php } ?>
            <?php if(1==2){ ?>
            <div class="col-xs-12 col-md-12 col-lg-12">
                <h3>Home Office</h3>
                <div class="panel panel-default">
                    <div class="row">
                        <div style="padding: 15px; padding-top: 0;">
                            <div style="padding: 0px; background-color: #fff; box-shadow: #cccccc .1em .1em .3em;">
                                <table  class="table" style="box-shadow: none; border-right: 0px !important;">
                                    <tr>
                                        <td><span class="text-primary">1 - Voc&ecirc; atuou em Home Office durante a pandemia da COVID-19?</span> <input type="radio" name="home_office" onclick="showDiv('home_office',1)" required="required" value="1"> Sim <input type="radio" name="home_office" onclick="showDiv('home_office',0)" required="required" value="0"> N&atilde;o</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <table class="table table-hover table-condensed table-responsive table-bordered table-striped esconde" id="home_office">
                        <thead>
                            <tr>
                                <td>&nbsp;</td>
                                <td align="center"><strong>Discordo Totalmente</strong></td>
                                <td align="center"><strong>Discordo Parcialmente</strong></td>
                                <td align="center"><strong>Concordo Parcialmente</strong></td>
                                <td align="center"><strong>Concordo Totalmente</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="left">A minha experi&ecirc;ncia com o Home Office superou minhas expectativas.</td>
                                <td align="center"><input type="radio" name="home_office1" id="home_office1" value="1" /></td>
                                <td align="center"><input type="radio" name="home_office1" id="home_office1" value="2" /></td>
                                <td align="center"><input type="radio" name="home_office1" id="home_office1" value="3" /></td>
                                <td align="center"><input type="radio" name="home_office1" id="home_office1" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">A empresa me proporcionou toda infraestrutura necess&aacute;ria para o trabalho Home Office.</td>
                                <td align="center"><input type="radio" name="home_office2" id="home_office2" value="1" /></td>
                                <td align="center"><input type="radio" name="home_office2" id="home_office2" value="2" /></td>
                                <td align="center"><input type="radio" name="home_office2" id="home_office2" value="3" /></td>
                                <td align="center"><input type="radio" name="home_office2" id="home_office2" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">Levando em considera&ccedil;&atilde;o minhas atividades do dia-a-dia, acredito que o Home Office poderia ser parcial (50% empresa e 50% casa).</td>
                                <td align="center"><input type="radio" name="home_office3" id="home_office3" value="1" /></td>
                                <td align="center"><input type="radio" name="home_office3" id="home_office3" value="2" /></td>
                                <td align="center"><input type="radio" name="home_office3" id="home_office3" value="3" /></td>
                                <td align="center"><input type="radio" name="home_office3" id="home_office3" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left">Levando em considera&ccedil;&atilde;o minhas atividades do dia-a-dia, acredito que o Home Office poderia ser permanente (100% casa).</td>
                                <td align="center"><input type="radio" name="home_office4" id="home_office4" value="1" /></td>
                                <td align="center"><input type="radio" name="home_office4" id="home_office4" value="2" /></td>
                                <td align="center"><input type="radio" name="home_office4" id="home_office4" value="3" /></td>
                                <td align="center"><input type="radio" name="home_office4" id="home_office4" value="4" /></td>
                            </tr>
                            <tr>
                                <td align="left" colspan="5">
                                    Quais os principais benef&iacute;cios do trabalho Home Office para voc&ecirc;? (Escolha at&eacute; 2 op&ccedil;&otilde;es)<br /><br />
                                    <input type="checkbox" name="home_office_aumento" value="Aumento da produtividade"  /> Aumento da produtividade &nbsp;
                                    <input type="checkbox" name="home_office_flexibilidade" value="Maior flexibilidade de organiza&ccedil;&atilde;o"  /> Maior flexibilidade de organiza&ccedil;&atilde;o &nbsp;
                                    <input type="checkbox" name="home_office_qualidade" value="Qualidade de vida"  /> Qualidade de vida &nbsp;
                                    <input type="checkbox" name="home_office_possibilidade" value="Possibilidade de passar mais tempo com a fam&iacute;lia"  /> Possibilidade de passar mais tempo com a fam&iacute;lia &nbsp;
                                    <input type="checkbox" name="home_office_tempo" value="Menos tempo no tr&acirc;nsito"  /> Menos tempo no tr&acirc;nsito
                                </td>
                            </tr>
                            <tr>
                                <td align="left"><strong>Justifique todas as respostas em que voc&ecirc; assinalou discordo totalmente ou parcialmente:</strong></td>
                                <td colspan="4"><input type="text" class="form-control" name="home_office_justificativa" id="home_office_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php } ?>

            
          


            <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="alert alert-info sucesso" role="alert"></div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6">
                <button type="submit" id="botao_cadastrar" class="btn btn-lg btn-warning pull-right">Enviar Formul&aacute;rio</button>
            </div>
        </div>
    </div>
</form>