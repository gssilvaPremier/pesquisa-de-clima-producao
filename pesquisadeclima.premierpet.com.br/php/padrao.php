<div class="col-xs-12 col-md-12 col-lg-12">
    <input type="hidden" name="padrao" value="1" />
    <div class="row">
        <div class="col-lg-12">
            <h3>Censo de Diversidade e Inclus&atilde;o - <?php echo getNomeEmpresa($nome_empresa_form); ?></h3>
        </div>
    </div>
</div>
<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q1. Qual das op&ccedil;&otilde;es abaixo descreve o seu cargo na empresa?</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody>
                <tr>
                    <td align="left">Diretor/Presidente</td>
                    <td align="center"><input type="radio" required name="padrao_questao1" id="padrao_questao1" value="Diretor/Presidente" /></td>
                </tr>
                <tr>
                    <td align="left">Gerente</td>
                    <td align="center"><input type="radio" required name="padrao_questao1" id="padrao_questao1" value="Gerente" /></td>
                </tr>
                <tr>
                    <td align="left">Supervisor/Coordenador</td>
                    <td align="center"><input type="radio" required name="padrao_questao1" id="padrao_questao1" value="Supervisor/Coordenador" /></td>
                </tr>
                <tr>
                    <td align="left">T&eacute;cnico de n&iacute;vel superior (universit&aacute;rio/especialista)</td>
                    <td align="center"><input type="radio" required name="padrao_questao1" id="padrao_questao1" value="T&eacute;cnico de n&iacute;vel superior (universit&aacute;rio/especialista)" /></td>
                </tr>
                <tr>
                    <td align="left">T&eacute;cnico de n&iacute;vel m&eacute;dio (segundo grau)</td>
                    <td align="center"><input type="radio" required name="padrao_questao1" id="padrao_questao1" value="T&eacute;cnico de n&iacute;vel m&eacute;dio (segundo grau)" /></td>
                </tr>
                <tr>
                    <td align="left">Operacional/Auxiliar</td>
                    <td align="center"><input type="radio" required name="padrao_questao1" id="padrao_questao1" value="Operacional/Auxiliar" /></td>
                </tr>
                <tr>
                    <td align="left">Administrativo</td>
                    <td align="center"><input type="radio" required name="padrao_questao1" id="padrao_questao1" value="Administrativo" /></td>
                </tr>
                <tr>
                    <td align="left">Vendedor</td>
                    <td align="center"><input type="radio" required name="padrao_questao1" id="padrao_questao1" value="Vendedor" /></td>
                </tr>
                <tr>
                    <td align="left">Trainee</td>
                    <td align="center"><input type="radio" required name="padrao_questao1" id="padrao_questao1" value="Trainee" /></td>
                </tr>
                <tr>
                    <td align="left">Estagi&aacute;rio</td>
                    <td align="center"><input type="radio" required name="padrao_questao1" id="padrao_questao1" value="Estagi&aacute;rio" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q2. Qual &eacute; a sua idade?</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody>
                <tr>
                    <td style="display: flex;align-items: center;">
                        <input type="number" min="18" max="100" class="form-control mr-2" name="padrao_questao2" id="padrao_questao2" style="margin-right:10px; width:auto; max-width:100px" required />
                        <div>anos</div>
                    </td>                    
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q3. Adotando a classifica&ccedil;&atilde;o do IBGE, como voc&ecirc; se auto autodeclara?<br />Para mais informa&ccedil;&otilde;es sobre a classifica&ccedil;&atilde;o do IBGE <a href="https://encurtador.com.br/hmzR2" target="_blank">veja esse link</a>.</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody>
                <tr>
                    <td align="left">Branco(a)</td>
                    <td align="center"><input type="radio" required name="padrao_questao3" id="padrao_questao3" value="Branco(a)" /></td>
                </tr>
                <tr>
                    <td align="left">Preto(a)</td>
                    <td align="center"><input type="radio" required name="padrao_questao3" id="padrao_questao3" value="Preto(a)" /></td>
                </tr>
                <tr>
                    <td align="left">Pardo(a)</td>
                    <td align="center"><input type="radio" required name="padrao_questao3" id="padrao_questao3" value="Pardo(a)" /></td>
                </tr>
                <tr>
                    <td align="left">Ind&iacute;gena</td>
                    <td align="center"><input type="radio" required name="padrao_questao3" id="padrao_questao3" value="Ind&iacute;gena" /></td>
                </tr>
                <tr>
                    <td align="left">Amarelo(a)</td>
                    <td align="center"><input type="radio" required name="padrao_questao3" id="padrao_questao3" value="Amarelo(a)" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q4. Assinale a(s) resposta(s) que se aplica(m) caso tenha algum tipo de defici&ecirc;ncia.</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody class="group-checkbox">
                <tr>
                    <td align="left">Auditiva</td>
                    <td align="center"><input type="checkbox" required name="padrao_questao4a" id="padrao_questao4a" value="Auditiva" /></td>
                </tr>
                <tr>
                    <td align="left">Cognitiva</td>
                    <td align="center"><input type="checkbox" name="padrao_questao4b" id="padrao_questao4b" value="Cognitiva" /></td>
                </tr>
                <tr>
                    <td align="left">F&iacute;sica/motora</td>
                    <td align="center"><input type="checkbox" name="padrao_questao4c" id="padrao_questao4c" value="F&iacute;sica/motora" /></td>
                </tr>
                <tr>
                    <td align="left">Visual</td>
                    <td align="center"><input type="checkbox" name="padrao_questao4d" id="padrao_questao4d" value="Visual" /></td>
                </tr>
                <tr>
                    <td align="left">Nenhuma</td>
                    <td align="center"><input type="checkbox" name="padrao_questao4e" id="padrao_questao4e" value="Nenhuma" /></td>
                </tr>
                <tr>
                    <td align="left">Prefiro n&atilde;o dizer</td>
                    <td align="center"><input type="checkbox" name="padrao_questao4f" id="padrao_questao4f" value="Prefiro n&atilde;o dizer" /></td>
                </tr>
                <tr>
                    <td align="left">Outro (especifique)</td>
                    <td align="center"><input type="checkbox" name="padrao_questao4g" id="padrao_questao4" value="Outro (especifique)" data-trigger="padrao_questao4_especifique" /></td>
                </tr>
                <tr class="padrao_questao4_especifique" style="display:none;">
                    <td align="left"><strong>Especifique</strong></td>
                    <td><input type="text" class="form-control" name="padrao_questao4_especifique" id="padrao_questao4_especifique" style="width:100%;" placeholder="Informe aqui sua especifica��o" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q5. Qual � a sua religi�o?</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody>
                <tr>
                    <td align="left">Cat�lica</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Cat�lica" /></td>
                </tr>
                <tr>
                    <td align="left">Evang�lica</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Evang�lica" /></td>
                </tr>
                <tr>
                    <td align="left">Esp�rita</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Esp�rita" /></td>
                </tr>
                <tr>
                    <td align="left">Umbanda</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Umbanda" /></td>
                </tr>
                <tr>
                    <td align="left">Candombl�</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Candombl�" /></td>
                </tr>
                <tr>
                    <td align="left">Sem religi�o</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Sem religi�o" /></td>
                </tr>
                <tr>
                    <td align="left">Pessoa agn�stica</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Pessoa agn�stica" /></td>
                </tr>
                <tr>
                    <td align="left">Hindu</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Hindu" /></td>
                </tr>
                <tr>
                    <td align="left">Mul�umana</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Mul�umana" /></td>
                </tr>
                <tr>
                    <td align="left">Budista</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Budista" /></td>
                </tr>
                <tr>
                    <td align="left">Juda�smo</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Juda�smo" /></td>
                </tr>
                <tr>
                    <td align="left">Prefiro n�o dizer</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Prefiro n�o dizer" /></td>
                </tr>
                <tr>
                    <td align="left">Outro (especifique)</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Outro (especifique)" data-trigger="padrao_questao5_especifique" /></td>
                </tr>
                <tr class="padrao_questao5_especifique" style="display:none;">
                    <td align="left"><strong>Especifique</strong></td>
                    <td><input type="text" class="form-control" name="padrao_questao5_especifique" id="padrao_questao5_especifique" style="width:100%;" placeholder="Informe aqui sua especifica��o" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q6. Voc� nasceu no Brasil?</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody>
                <tr>
                    <td align="left">Sim</td>
                    <td align="center"><input type="radio" required name="padrao_questao6" id="padrao_questao6" value="Sim" /></td>
                </tr>
                <tr>
                    <td align="left">N�o</td>
                    <td align="center"><input type="radio" required name="padrao_questao6" id="padrao_questao6" value="N�o" /></td>
                </tr>               
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q7. Em qual estado brasileiro voc� nasceu?</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody>
                <tr>
                    <td align="left">Acre</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Acre" /></td>
                </tr>
                <tr>
                    <td align="left">Alagoas</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Alagoas" /></td>
                </tr>
                <tr>
                    <td align="left">Amap�</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Amap�" /></td>
                </tr>
                <tr>
                    <td align="left">Amazonas</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Amazonas" /></td>
                </tr>
                <tr>
                    <td align="left">Bahia</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Bahia" /></td>
                </tr>
                <tr>
                    <td align="left">Cear�</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Cear�" /></td>
                </tr>
                <tr>
                    <td align="left">Distrito Federal</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Distrito Federal" /></td>
                </tr>
                <tr>
                    <td align="left">Esp�rito Santo</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Esp�rito Santo" /></td>
                </tr>
                <tr>
                    <td align="left">Goi�s</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Goi�s" /></td>
                </tr>
                <tr>
                    <td align="left">Maranh�o</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Maranh�o" /></td>
                </tr>
                <tr>
                    <td align="left">Mato Grosso</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Mato Grosso" /></td>
                </tr>
                <tr>
                    <td align="left">Mato Grosso do Sul</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Mato Grosso do Sul" /></td>
                </tr>
                <tr>
                    <td align="left">Minas Gerais</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Minas Gerais" /></td>
                </tr>
                <tr>
                    <td align="left">Par�</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Par�" /></td>
                </tr>
                <tr>
                    <td align="left">Para�ba</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Para�ba" /></td>
                </tr>
                <tr>
                    <td align="left">Paran�</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Paran�" /></td>
                </tr>
                <tr>
                    <td align="left">Pernambuco</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Pernambuco" /></td>
                </tr>
                <tr>
                    <td align="left">Piau�</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Piau�" /></td>
                </tr>
                <tr>
                    <td align="left">Rio de Janeiro</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Rio de Janeiro" /></td>
                </tr>
                <tr>
                    <td align="left">Rio Grande do Norte</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Rio Grande do Norte" /></td>
                </tr>
                <tr>
                    <td align="left">Rio Grande do Sul</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Rio Grande do Sul" /></td>
                </tr>
                <tr>
                    <td align="left">Rond�nia</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Rond�nia" /></td>
                </tr>
                <tr>
                    <td align="left">Roraima</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Roraima" /></td>
                </tr>
                <tr>
                    <td align="left">Santa Catarina</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Santa Catarina" /></td>
                </tr>
                <tr>
                    <td align="left">S�o Paulo</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="S�o Paulo" /></td>
                </tr>
                <tr>
                    <td align="left">Sergipe</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Sergipe" /></td>
                </tr>
                <tr>
                    <td align="left">Tocantins</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Tocantins" /></td>
                </tr>                

            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q8. Voc� se�identifica como:</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody>
                <tr>
                    <td align="left">Homem</td>
                    <td align="center"><input type="radio" required name="padrao_questao8" id="padrao_questao8" value="Homem" /></td>
                </tr>
                <tr>
                    <td align="left">Mulher</td>
                    <td align="center"><input type="radio" required name="padrao_questao8" id="padrao_questao8" value="Mulher" /></td>
                </tr>               
                <tr>
                    <td align="left">N�o bin�rio (pessoa que n�o se identifica nem com o g�nero masculino, nem com o g�nero feminino)</td>
                    <td align="center"><input type="radio" required name="padrao_questao8" id="padrao_questao8" value="N�o bin�rio (pessoa que n�o se identifica nem com o g�nero masculino, nem com o g�nero feminino)" /></td>
                </tr>
                <tr>
                    <td align="left">Outro (descreva)</td>
                    <td align="center"><input type="radio" required name="padrao_questao8" id="padrao_questao8" value="Outro (descreva)" data-trigger="padrao_questao8_especifique" /></td>
                </tr>
                <tr class="padrao_questao8_especifique" style="display:none;">
                    <td align="left"><strong>Descreva</strong></td>
                    <td><input type="text" class="form-control" name="padrao_questao8_especifique" id="padrao_questao8_especifique" style="width:100%;" placeholder="Informe aqui sua descri��o" /></td>
                </tr>                
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q9. Ainda sobre identidade de g�nero, voc� se definiria como:<br />
        <small>Observa��o: a pessoa transg�nera � aquela que n�o se identifica com o g�nero designado a ela no momento do nascimento.<br />
        Exemplo: quando nasceu disseram que era menino e, ao longo da vida, come�ou a se apresentar como mulher. De outro lado, a pessoa cisg�nero � aquele que n�o � transg�nero (simples assim).<br />Caso tenha d�vidas, veja esse v�deo: <a href="https://www.youtube.com/watch?v=_hoJg896LBw" target="_blank">https://www.youtube.com/watch?v=_hoJg896LBw</a></small></p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody>
                <tr>
                    <td align="left">Cisg�nero (pessoas que se identificam com o g�nero designado a elas em seu nascimento)</td>
                    <td align="center"><input type="radio" required name="padrao_questao9" id="padrao_questao9" value="Cisg�nero (pessoas que se identificam com o g�nero designado a elas em seu nascimento)" /></td>
                </tr>
                <tr>
                    <td align="left">Transg�nero (pessoas que n�o se identificam com o g�nero designado a elas em seu nascimento)</td>
                    <td align="center"><input type="radio" required name="padrao_questao9" id="padrao_questao9" value="Transg�nero (pessoas que n�o se identificam com o g�nero designado a elas em seu nascimento)" /></td>
                </tr>               
                <tr>
                    <td align="left">Prefiro n�o dizer</td>
                    <td align="center"><input type="radio" required name="padrao_questao9" id="padrao_questao9" value="Prefiro n�o dizer" /></td>
                </tr>
                <tr>
                    <td align="left">Outro (especifique)</td>
                    <td align="center"><input type="radio" required name="padrao_questao9" id="padrao_questao9" value="Outro (especifique)" data-trigger="padrao_questao9_especifique" /></td>
                </tr>
                <tr class="padrao_questao9_especifique" style="display:none;">
                    <td align="left"><strong>Especifique</strong></td>
                    <td><input type="text" class="form-control" name="padrao_questao9_especifique" id="padrao_questao9_especifique" style="width:100%;" placeholder="Informe aqui sua especifica��o" /></td>
                </tr>                
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q10. Qual sua orienta��o sexual?</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody>
                <tr>
                    <td align="left">Heterossexual</td>
                    <td align="center"><input type="radio" required name="padrao_questao10" id="padrao_questao10" value="Heterossexual" /></td>
                </tr>
                <tr>
                    <td align="left">Homossexual</td>
                    <td align="center"><input type="radio" required name="padrao_questao10" id="padrao_questao10" value="Homossexual" /></td>
                </tr>               
                <tr>
                    <td align="left">Bissexual</td>
                    <td align="center"><input type="radio" required name="padrao_questao10" id="padrao_questao10" value="Bissexual" /></td>
                </tr>               
                <tr>
                    <td align="left">Assexual</td>
                    <td align="center"><input type="radio" required name="padrao_questao10" id="padrao_questao10" value="Assexual" /></td>
                </tr>               
                <tr>
                    <td align="left">Prefiro n�o dizer</td>
                    <td align="center"><input type="radio" required name="padrao_questao10" id="padrao_questao10" value="Prefiro n�o dizer" /></td>
                </tr>
                <tr>
                    <td align="left">Outro (especifique)</td>
                    <td align="center"><input type="radio" required name="padrao_questao10" id="padrao_questao10" value="Outro (especifique)" data-trigger="padrao_questao10_especifique" /></td>
                </tr>
                <tr class="padrao_questao10_especifique" style="display:none;">
                    <td align="left"><strong>Especifique</strong></td>
                    <td><input type="text" class="form-control" name="padrao_questao10_especifique" id="padrao_questao10_especifique" style="width:100%;" placeholder="Informe aqui sua especifica��o" /></td>
                </tr>                
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q11. H� quanto tempo que voc� faz parte da empresa?</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody>
                <tr>
                    <td align="left">At� 3 meses</td>
                    <td align="center"><input type="radio" required name="padrao_questao11" id="padrao_questao11" value="At� 3 meses" /></td>
                </tr>
                <tr>
                    <td align="left">Entre 1 e 3 meses</td>
                    <td align="center"><input type="radio" required name="padrao_questao11" id="padrao_questao11" value="Entre 1 e 3 meses" /></td>
                </tr>               
                <tr>
                    <td align="left">Entre 3 meses e 1 ano</td>
                    <td align="center"><input type="radio" required name="padrao_questao11" id="padrao_questao11" value="Entre 3 meses e 1 ano" /></td>
                </tr>               
                <tr>
                    <td align="left">Entre 1 ano e 2 anos</td>
                    <td align="center"><input type="radio" required name="padrao_questao11" id="padrao_questao11" value="Entre 1 ano e 2 anos" /></td>
                </tr>               
                <tr>
                    <td align="left">Entre�2 e 5 anos</td>
                    <td align="center"><input type="radio" required name="padrao_questao11" id="padrao_questao11" value="Entre�2 e 5 anos" /></td>
                </tr>                
                <tr>
                    <td align="left">Entre 5 e 10 anos</td>
                    <td align="center"><input type="radio" required name="padrao_questao11" id="padrao_questao11" value="Entre 5 e 10 anos" /></td>
                </tr>                
                <tr>
                    <td align="left">Mais de 10 anos</td>
                    <td align="center"><input type="radio" required name="padrao_questao11" id="padrao_questao11" value="Mais de 10 anos" /></td>
                </tr>               
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q12. Classifique a empresa�quanto �s afirma��es abaixo.</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <thead>
                <tr>
                    <td>&nbsp;</td>
                    <td align="center"><strong>Discordo Totalmente</strong></td>
                    <td align="center"><strong>Discordo Parcialmente</strong></td>
                    <td align="center"><strong>Nem concordo, nem discordo</strong></td>
                    <td align="center"><strong>Concordo Parcialmente</strong></td>
                    <td align="center"><strong>Concordo Totalmente</strong></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="left">A�empresa � comprometida com diversidade e inclus�o</td>
                    <td align="center"><input type="radio" required name="padrao_questao12a" id="padrao_questao12a" value="Discordo Totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao12a" id="padrao_questao12a" value="Discordo Parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao12a" id="padrao_questao12a" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao12a" id="padrao_questao12a" value="Concordo Parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao12a" id="padrao_questao12a" value="Concordo Totalmente" /></td>
                </tr>
                <tr>
                    <td align="left">H�esfor�o de toda a empresa em promover a diversidade</td>
                    <td align="center"><input type="radio" required name="padrao_questao12b" id="padrao_questao12b" value="Discordo Totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao12b" id="padrao_questao12b" value="Discordo Parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao12b" id="padrao_questao12b" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao12b" id="padrao_questao12b" value="Concordo Parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao12b" id="padrao_questao12b" value="Concordo Totalmente" /></td>
                </tr>
                <tr>
                    <td align="left"><strong>Fique � vontade para comentar suas respostas:</strong></td>
                    <td colspan="5"><input type="text" class="form-control" name="padrao_questao12_justificativa" id="padrao_questao12_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q13. Classifique quanto cada afirmativa abaixo descreve sua experi�ncia na empresa.</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <thead>
                <tr>
                    <td>&nbsp;</td>
                    <td align="center"><strong>Discordo Totalmente</strong></td>
                    <td align="center"><strong>Discordo Parcialmente</strong></td>
                    <td align="center"><strong>Nem concordo, nem discordo</strong></td>
                    <td align="center"><strong>Concordo Parcialmente</strong></td>
                    <td align="center"><strong>Concordo Totalmente</strong></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="left">Me sinto como uma pessoa "estranha" na empresa</td>
                    <td align="center"><input type="radio" required name="padrao_questao13a" id="padrao_questao13a" value="Discordo Totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao13a" id="padrao_questao13a" value="Discordo Parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao13a" id="padrao_questao13a" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao13a" id="padrao_questao13a" value="Concordo Parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao13a" id="padrao_questao13a" value="Concordo Totalmente" /></td>
                </tr>
                <tr>
                    <td align="left">Sinto que meus valores est�o alinhados aos valores da empresa</td>
                    <td align="center"><input type="radio" required name="padrao_questao13b" id="padrao_questao13b" value="Discordo Totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao13b" id="padrao_questao13b" value="Discordo Parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao13b" id="padrao_questao13b" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao13b" id="padrao_questao13b" value="Concordo Parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao13b" id="padrao_questao13b" value="Concordo Totalmente" /></td>
                </tr>
                <tr>
                    <td align="left">Sinto que posso ser quem sou dentro da empresa</td>
                    <td align="center"><input type="radio" required name="padrao_questao13c" id="padrao_questao13c" value="Discordo Totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao13c" id="padrao_questao13c" value="Discordo Parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao13c" id="padrao_questao13c" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao13c" id="padrao_questao13c" value="Concordo Parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao13c" id="padrao_questao13c" value="Concordo Totalmente" /></td>
                </tr>
                <tr>
                    <td align="left"><strong>Fique � vontade para comentar suas respostas:</strong></td>
                    <td colspan="5"><input type="text" class="form-control" name="padrao_questao13_justificativa" id="padrao_questao13_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q14. Termine as afirma��es abaixo da forma como voc� acredita que melhor se aplica � sua experi�ncia com a sua lideran�a.</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <thead>
                <tr>
                    <td>&nbsp;</td>
                    <td align="center"><strong>Nunca</strong></td>
                    <td align="center"><strong>Raramente</strong></td>
                    <td align="center"><strong>Algumas vezes</strong></td>
                    <td align="center"><strong>Com Frequ�ncia</strong></td>
                    <td align="center"><strong>Sempre</strong></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="left">Escuto�coment�rios preconceituosos</td>
                    <td align="center"><input type="radio" required name="padrao_questao14a" id="padrao_questao14a" value="Nunca" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao14a" id="padrao_questao14a" value="Raramente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao14a" id="padrao_questao14a" value="Algumas vezes" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao14a" id="padrao_questao14a" value="Com Frequ�ncia" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao14a" id="padrao_questao14a" value="Sempre" /></td>
                </tr>
                <tr>
                    <td align="left">Sinto que minhas opini�es s�o�consideradas</td>
                    <td align="center"><input type="radio" required name="padrao_questao14b" id="padrao_questao14b" value="Nunca" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao14b" id="padrao_questao14b" value="Raramente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao14b" id="padrao_questao14b" value="Algumas vezes" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao14b" id="padrao_questao14b" value="Com Frequ�ncia" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao14b" id="padrao_questao14b" value="Sempre" /></td>
                </tr>
                <tr>
                    <td align="left">Sinto que sou interrompido(a) excessivamente em reuni�es</td>
                    <td align="center"><input type="radio" required name="padrao_questao14c" id="padrao_questao14c" value="Nunca" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao14c" id="padrao_questao14c" value="Raramente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao14c" id="padrao_questao14c" value="Algumas vezes" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao14c" id="padrao_questao14c" value="Com Frequ�ncia" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao14c" id="padrao_questao14c" value="Sempre" /></td>
                </tr>
                <tr>
                    <td align="left"><strong>Fique � vontade para comentar suas respostas:</strong></td>
                    <td colspan="5"><input type="text" class="form-control" name="padrao_questao14_justificativa" id="padrao_questao14_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q15. Termine as afirma��es abaixo da forma como voc� acredita que melhor se aplica � sua experi�ncia com seus colegas de trabalho.</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <thead>
                <tr>
                    <td>&nbsp;</td>
                    <td align="center"><strong>Nunca</strong></td>
                    <td align="center"><strong>Raramente</strong></td>
                    <td align="center"><strong>Algumas vezes</strong></td>
                    <td align="center"><strong>Com Frequ�ncia</strong></td>
                    <td align="center"><strong>Sempre</strong></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="left">Escuto�coment�rios�preconceituosos</td>
                    <td align="center"><input type="radio" required name="padrao_questao15a" id="padrao_questao15a" value="Nunca" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao15a" id="padrao_questao15a" value="Raramente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao15a" id="padrao_questao15a" value="Algumas vezes" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao15a" id="padrao_questao15a" value="Com Frequ�ncia" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao15a" id="padrao_questao15a" value="Sempre" /></td>
                </tr>
                <tr>
                    <td align="left">Sinto que minhas opini�es s�o�consideradas</td>
                    <td align="center"><input type="radio" required name="padrao_questao15b" id="padrao_questao15b" value="Nunca" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao15b" id="padrao_questao15b" value="Raramente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao15b" id="padrao_questao15b" value="Algumas vezes" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao15b" id="padrao_questao15b" value="Com Frequ�ncia" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao15b" id="padrao_questao15b" value="Sempre" /></td>
                </tr>
                <tr>
                    <td align="left">Sinto que sou interrompido(a) excessivamente em reuni�es</td>
                    <td align="center"><input type="radio" required name="padrao_questao15c" id="padrao_questao15c" value="Nunca" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao15c" id="padrao_questao15c" value="Raramente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao15c" id="padrao_questao15c" value="Algumas vezes" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao15c" id="padrao_questao15c" value="Com Frequ�ncia" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao15c" id="padrao_questao15c" value="Sempre" /></td>
                </tr>
                <tr>
                    <td align="left"><strong>Fique � vontade para comentar suas respostas:</strong></td>
                    <td colspan="5"><input type="text" class="form-control" name="padrao_questao15_justificativa" id="padrao_questao15_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q16. Termine as afirma��es abaixo da forma como voc� acredita que melhor se aplica � sua experi�ncia com outras lideran�as (se voc� n�o tiver contato com outras lideran�as, escolha a op��o "nunca").</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <thead>
                <tr>
                    <td>&nbsp;</td>
                    <td align="center"><strong>Nunca</strong></td>
                    <td align="center"><strong>Raramente</strong></td>
                    <td align="center"><strong>Algumas vezes</strong></td>
                    <td align="center"><strong>Com Frequ�ncia</strong></td>
                    <td align="center"><strong>Sempre</strong></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="left">Escuto�coment�rios�preconceituosos</td>
                    <td align="center"><input type="radio" required name="padrao_questao16a" id="padrao_questao16a" value="Nunca" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao16a" id="padrao_questao16a" value="Raramente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao16a" id="padrao_questao16a" value="Algumas vezes" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao16a" id="padrao_questao16a" value="Com Frequ�ncia" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao16a" id="padrao_questao16a" value="Sempre" /></td>
                </tr>
                <tr>
                    <td align="left">Sinto que minhas opini�es s�o�consideradas</td>
                    <td align="center"><input type="radio" required name="padrao_questao16b" id="padrao_questao16b" value="Nunca" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao16b" id="padrao_questao16b" value="Raramente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao16b" id="padrao_questao16b" value="Algumas vezes" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao16b" id="padrao_questao16b" value="Com Frequ�ncia" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao16b" id="padrao_questao16b" value="Sempre" /></td>
                </tr>
                <tr>
                    <td align="left">Sinto que sou interrompido(a) excessivamente em reuni�es</td>
                    <td align="center"><input type="radio" required name="padrao_questao16c" id="padrao_questao16c" value="Nunca" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao16c" id="padrao_questao16c" value="Raramente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao16c" id="padrao_questao16c" value="Algumas vezes" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao16c" id="padrao_questao16c" value="Com Frequ�ncia" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao16c" id="padrao_questao16c" value="Sempre" /></td>
                </tr>
                <tr>
                    <td align="left"><strong>Fique � vontade para comentar suas respostas:</strong></td>
                    <td colspan="5"><input type="text" class="form-control" name="padrao_questao16_justificativa" id="padrao_questao16_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q17. Voc� j� foi V�TIMA de alguma situa��o de desrespeito na empresa? (Ex: coment�rios, retalia��es, interrup��es sucessivas...).</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody>
                <tr>
                    <td align="left">Sim</td>
                    <td align="center"><input type="radio" required name="padrao_questao17" id="padrao_questao17" value="Sim" /></td>
                </tr>
                <tr>
                    <td align="left">N�o</td>
                    <td align="center"><input type="radio" required name="padrao_questao17" id="padrao_questao17" value="N�o" /></td>
                </tr>               
                <tr>
                    <td align="left">Prefiro n�o dizer</td>
                    <td align="center"><input type="radio" required name="padrao_questao17" id="padrao_questao17" value="Prefiro n�o dizer" /></td>
                </tr>               
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q18. Marque se voc� vivenciou desrespeito relacionado a alguma(s) das caracter�sticas abaixo:</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody class="group-checkbox">                
                <tr>
                    <td align="left">Idade</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao18b" id="padrao_questao18b" value="Idade" /></td>
                </tr>               
                <tr>
                    <td align="left">G�nero</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao18c" id="padrao_questao18c" value="G�nero" /></td>
                </tr>
                 <tr>
                    <td align="left">Identidade de g�nero</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao18d" id="padrao_questao18d" value="Identidade de g�nero" /></td>
                </tr>
                 <tr>
                    <td align="left">Orienta��o sexual</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao18e" id="padrao_questao18e" value="Orienta��o sexual" /></td>
                </tr>
                 <tr>
                    <td align="left">Escolaridade</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao18f" id="padrao_questao18f" value="Escolaridade" /></td>
                </tr>
                 <tr>
                    <td align="left">Defici�ncia</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao18g" id="padrao_questao18g" value="Defici�ncia" /></td>
                </tr>
                 <tr>
                    <td align="left">Origem</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao18h" id="padrao_questao18h" value="Origem" /></td>
                </tr>
                 <tr>
                    <td align="left">Religi�o</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao18i" id="padrao_questao18i" value="Religi�o" /></td>
                </tr>
                 <tr>
                    <td align="left">Cor/ra�a/etnia</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao18j" id="padrao_questao18j" value="Cor/ra�a/etnia" /></td>
                </tr>
                 <tr>
                    <td align="left">Prefiro n�o dizer</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao18k" id="padrao_questao18k" value="Prefiro n�o dizer" /></td>
                </tr>
                <tr>
                    <td align="left">N�o vivenciei situa��es de desrespeito</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao18l" id="padrao_questao18l" value="N�o vivenciei situa��es de desrespeito" /></td>
                </tr>
                <tr>
                    <td align="left"><strong>Fique � vontade para adicionar outras caracter�sticas:</strong></td>
                    <td colspan="5"><input type="text" class="form-control" name="padrao_questao18_justificativa" id="padrao_questao18_justificativa" style="width:100%;" value="" placeholder="Informe aqui" /></td>
                </tr>
                <tr>
                    <td align="left">Nenhuma das anteriores</td>
                    <td align="center"><input type="checkbox" required  name="padrao_questao18a" id="padrao_questao18a" value="Nenhuma das anteriores" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q19. Qual(is) das op��es abaixo melhor representa(m) a(s) pessoa(s) que reproduziram o desrespeito presenciado?</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody class="group-checkbox">
                <tr>
                    <td align="left">Colega(s) de trabalho</td>
                    <td align="center"><input type="checkbox" required name="padrao_questao19a" id="padrao_questao19a" value="Colega(s) de trabalho" /></td>
                </tr>
                <tr>
                    <td align="left">Lideran�a geral</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao19b" id="padrao_questao19b" value="Lideran�a geral" /></td>
                </tr>               
                <tr>
                    <td align="left">Liderado(a/s)</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao19c" id="padrao_questao19c" value="Liderado(a/s)" /></td>
                </tr>               
                <tr>
                    <td align="left">Cliente(s)</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao19d" id="padrao_questao19d" value="Cliente(s)" /></td>
                </tr>               
                <tr>
                    <td align="left">Fornecedor(a/es)</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao19e" id="padrao_questao19e" value="Fornecedor(a/es)" /></td>
                </tr>
                <tr>
                    <td align="left">Prefiro n�o dizer</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao19f" id="padrao_questao19f" value="Prefiro n�o dizer" /></td>
                </tr>                
                <tr>
                    <td align="left">N�o vivenciei situa��es de desrespeito</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao19h" id="padrao_questao19h" value="N�o vivenciei situa��es de desrespeito" /></td>
                </tr>
                <tr>
                    <td align="left">Outro (especifique)</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao19g" id="padrao_questao19g" value="Outro (especifique)" data-trigger="padrao_questao19_especifique" /></td>
                </tr>
                <tr class="padrao_questao19_especifique" style="display:none;">
                    <td align="left"><strong>Especifique</strong></td>
                    <td><input type="text" class="form-control" name="padrao_questao19_especifique" id="padrao_questao19_especifique" style="width:100%;" placeholder="Informe aqui sua especifica��o" /></td>
                </tr>                
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q20. Voc� j� PRESENCIOU alguma situa��o de desrespeito na empresa? (Ex: coment�rios, retalia��es, interrup��es sucessivas...).</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody>
                <tr>
                    <td align="left">Sim</td>
                    <td align="center"><input type="radio" required name="padrao_questao20" id="padrao_questao20" value="Sim" /></td>
                </tr>
                <tr>
                    <td align="left">N�o</td>
                    <td align="center"><input type="radio" required name="padrao_questao20" id="padrao_questao20" value="N�o" /></td>
                </tr>               
                <tr>
                    <td align="left">Prefiro n�o dizer</td>
                    <td align="center"><input type="radio" required name="padrao_questao20" id="padrao_questao20" value="Prefiro n�o dizer" /></td>
                </tr>               
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q21. Marque se voc� presenciou desrespeito relacionado a alguma(s) das caracter�sticas abaixo:</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody class="group-checkbox">                
                <tr>
                    <td align="left">Idade</td>
                    <td align="center"><input type="checkbox" name="padrao_questao21b" id="padrao_questao21b" value="Idade" /></td>
                </tr>               
                <tr>
                    <td align="left">G�nero</td>
                    <td align="center"><input type="checkbox" name="padrao_questao21c" id="padrao_questao21c" value="G�nero" /></td>
                </tr>
                 <tr>
                    <td align="left">Identidade de g�nero</td>
                    <td align="center"><input type="checkbox" name="padrao_questao21d" id="padrao_questao21d" value="Identidade de g�nero" /></td>
                </tr>
                 <tr>
                    <td align="left">Orienta��o sexual</td>
                    <td align="center"><input type="checkbox" name="padrao_questao21e" id="padrao_questao21e" value="Orienta��o sexual" /></td>
                </tr>
                 <tr>
                    <td align="left">Escolaridade</td>
                    <td align="center"><input type="checkbox" name="padrao_questao21f" id="padrao_questao21f" value="Escolaridade" /></td>
                </tr>
                 <tr>
                    <td align="left">Defici�ncia</td>
                    <td align="center"><input type="checkbox" name="padrao_questao21g" id="padrao_questao21g" value="Defici�ncia" /></td>
                </tr>
                 <tr>
                    <td align="left">Origem</td>
                    <td align="center"><input type="checkbox" name="padrao_questao21h" id="padrao_questao21h" value="Origem" /></td>
                </tr>
                 <tr>
                    <td align="left">Religi�o</td>
                    <td align="center"><input type="checkbox" name="padrao_questao21i" id="padrao_questao21i" value="Religi�o" /></td>
                </tr>
                 <tr>
                    <td align="left">Cor/ra�a/etnia</td>
                    <td align="center"><input type="checkbox" name="padrao_questao21j" id="padrao_questao21j" value="Cor/ra�a/etnia" /></td>
                </tr>
                 <tr>
                    <td align="left">Prefiro n�o dizer</td>
                    <td align="center"><input type="checkbox" name="padrao_questao21k" id="padrao_questao21k" value="Prefiro n�o dizer" /></td>
                </tr>
                 <tr>
                    <td align="left">N�o presenciei situa��es de desrespeito</td>
                    <td align="center"><input type="checkbox" name="padrao_questao21l" id="padrao_questao21l" value="N�o presenciei situa��es de desrespeito" /></td>
                </tr>
                <tr>
                    <td align="left"><strong>Fique � vontade para adicionar outras caracter�sticas:</strong></td>
                    <td colspan="5"><input type="text" class="form-control" name="padrao_questao21_justificativa" id="padrao_questao21_justificativa" style="width:100%;" value="" placeholder="Informe aqui" /></td>
                </tr>
                <tr>
                    <td align="left">Nenhuma das anteriores</td>
                    <td align="center"><input type="checkbox" required name="padrao_questao21a" id="padrao_questao21a" value="Nenhuma das anteriores" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q22. Qual(is) das op��es abaixo melhor representa(m) a(s) pessoa(s) que reproduziram o desrespeito presenciado?</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody class="group-checkbox">
                <tr>
                    <td align="left">Colega(s) de trabalho</td>
                    <td align="center"><input type="checkbox" required name="padrao_questao22a" id="padrao_questao22a" value="Colega(s) de trabalho" /></td>
                </tr>
                <tr>
                    <td align="left">Lideran�a geral</td>
                    <td align="center"><input type="checkbox" name="padrao_questao22b" id="padrao_questao22b" value="Lideran�a geral" /></td>
                </tr>               
                <tr>
                    <td align="left">Liderado(a/s)</td>
                    <td align="center"><input type="checkbox" name="padrao_questao22c" id="padrao_questao22c" value="Liderado(a/s)" /></td>
                </tr>               
                <tr>
                    <td align="left">Cliente(s)</td>
                    <td align="center"><input type="checkbox" name="padrao_questao22d" id="padrao_questao22d" value="Cliente(s)" /></td>
                </tr>               
                <tr>
                    <td align="left">Fornecedor(a/es)</td>
                    <td align="center"><input type="checkbox" name="padrao_questao22e" id="padrao_questao22e" value="Fornecedor(a/es)" /></td>
                </tr>
                <tr>
                    <td align="left">Prefiro n�o dizer</td>
                    <td align="center"><input type="checkbox" name="padrao_questao22f" id="padrao_questao22f" value="Prefiro n�o dizer" /></td>
                </tr>                
                <tr>
                    <td align="left">N�o presenciei situa��es de desrespeito</td>
                    <td align="center"><input type="checkbox" name="padrao_questao21h" id="padrao_questao21h" value="N�o presenciei situa��es de desrespeito" /></td>
                </tr>
                <tr>
                    <td align="left">Outro (especifique)</td>
                    <td align="center"><input type="checkbox" name="padrao_questao22g" id="padrao_questao22g" value="Outro (especifique)" data-trigger="padrao_questao22_especifique" /></td>
                </tr>
                <tr class="padrao_questao22_especifique" style="display:none;">
                    <td align="left"><strong>Especifique</strong></td>
                    <td><input type="text" class="form-control" name="padrao_questao22_especifique" id="padrao_questao22_especifique" style="width:100%;" placeholder="Informe aqui sua especifica��o" /></td>
                </tr>               
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q23. Classifique qu�o confort�vel voc� estaria para falar (sobre assuntos profissionais ou pessoais) com pessoas dos grupos citados abaixo:</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <thead>
                <tr>
                    <td>&nbsp;</td>
                    <td align="center"><strong>Sinto que existe um bloqueio</strong></td>
                    <td align="center"><strong>Sinto�algum receio</strong></td>
                    <td align="center"><strong>N�o sinto receio mas n�o me sinto a vontade</strong></td>
                    <td align="center"><strong>Me sinto � vontade</strong></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="left">Pessoas de n�veis hier�rquicos diferentes</td>
                    <td align="center"><input type="radio" required name="padrao_questao23a" id="padrao_questao23a" value="Sinto que existe um bloqueio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23a" id="padrao_questao23a" value="Sinto�algum receio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23a" id="padrao_questao23a" value="N�o sinto receio mas n�o me sinto a vontade" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23a" id="padrao_questao23a" value="Me sinto � vontade" /></td>
                </tr>
                <tr>
                    <td align="left">Pessoas de g�nero diferente</td>
                    <td align="center"><input type="radio" required name="padrao_questao23b" id="padrao_questao23b" value="Sinto que existe um bloqueio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23b" id="padrao_questao23b" value="Sinto�algum receio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23b" id="padrao_questao23b" value="N�o sinto receio mas n�o me sinto a vontade" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23b" id="padrao_questao23b" value="Me sinto � vontade" /></td>
                </tr>
                <tr>
                    <td align="left">Pessoas LGBTQIA+</td>
                    <td align="center"><input type="radio" required name="padrao_questao23c" id="padrao_questao23c" value="Sinto que existe um bloqueio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23c" id="padrao_questao23c" value="Sinto�algum receio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23c" id="padrao_questao23c" value="N�o sinto receio mas n�o me sinto a vontade" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23c" id="padrao_questao23c" value="Me sinto � vontade" /></td>
                </tr>
                <tr>
                    <td align="left">Pessoas de pa�ses diferentes</td>
                    <td align="center"><input type="radio" required name="padrao_questao23d" id="padrao_questao23d" value="Sinto que existe um bloqueio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23d" id="padrao_questao23d" value="Sinto�algum receio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23d" id="padrao_questao23d" value="N�o sinto receio mas n�o me sinto a vontade" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23d" id="padrao_questao23d" value="Me sinto � vontade" /></td>
                </tr>
                <tr>
                    <td align="left">Pessoas de �reas diferentes</td>
                    <td align="center"><input type="radio" required name="padrao_questao23e" id="padrao_questao23e" value="Sinto que existe um bloqueio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23e" id="padrao_questao23e" value="Sinto�algum receio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23e" id="padrao_questao23e" value="N�o sinto receio mas n�o me sinto a vontade" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23e" id="padrao_questao23e" value="Me sinto � vontade" /></td>
                </tr>
                <tr>
                    <td align="left">Pessoas com defici�ncia</td>
                    <td align="center"><input type="radio" required name="padrao_questao23f" id="padrao_questao23f" value="Sinto que existe um bloqueio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23f" id="padrao_questao23f" value="Sinto�algum receio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23f" id="padrao_questao23f" value="N�o sinto receio mas n�o me sinto a vontade" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23f" id="padrao_questao23f" value="Me sinto � vontade" /></td>
                </tr>
                <tr>
                    <td align="left">Pessoas de ra�a/etnia diferentes da sua</td>
                    <td align="center"><input type="radio" required name="padrao_questao23g" id="padrao_questao23g" value="Sinto que existe um bloqueio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23g" id="padrao_questao23g" value="Sinto�algum receio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23g" id="padrao_questao23g" value="N�o sinto receio mas n�o me sinto a vontade" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23g" id="padrao_questao23g" value="Me sinto � vontade" /></td>
                </tr>
                <tr>
                    <td align="left">Pessoas que falam uma l�ngua nativa diferente da minha</td>
                    <td align="center"><input type="radio" required name="padrao_questao23h" id="padrao_questao23h" value="Sinto que existe um bloqueio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23h" id="padrao_questao23h" value="Sinto�algum receio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23h" id="padrao_questao23h" value="N�o sinto receio mas n�o me sinto a vontade" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23h" id="padrao_questao23h" value="Me sinto � vontade" /></td>
                </tr>
                <tr>
                    <td align="left">Pessoas de idades diferentes das minhas</td>
                    <td align="center"><input type="radio" required name="padrao_questao23i" id="padrao_questao23i" value="Sinto que existe um bloqueio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23i" id="padrao_questao23i" value="Sinto�algum receio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23i" id="padrao_questao23i" value="N�o sinto receio mas n�o me sinto a vontade" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23i" id="padrao_questao23i" value="Me sinto � vontade" /></td>
                </tr>
                <tr>
                    <td align="left"><strong>Fique � vontade para comentar ou adicionar outros motivos para haver receio:</strong></td>
                    <td colspan="4"><input type="text" class="form-control" name="padrao_questao23_justificativa" id="padrao_questao23_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q24. Classifique as afirma��es abaixo pensando na rela��o com o(a) seu/sua l�der.</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <thead>
                <tr>
                    <td>&nbsp;</td>
                    <td align="center"><strong>Discordo totalmente</strong></td>
                    <td align="center"><strong>Discordo parcialmente</strong></td>
                    <td align="center"><strong>Nem concordo, nem discordo</strong></td>
                    <td align="center"><strong>Concordo parcialmente</strong></td>
                    <td align="center"><strong>Concordo totalmente</strong></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="left">Sinto que posso propor  novas ideias ou tentar  novas formas de  desenvolver minhas  atividades</td>
                    <td align="center"><input type="radio" required name="padrao_questao24a" id="padrao_questao24a" value="Discordo totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24a" id="padrao_questao24a" value="Discordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24a" id="padrao_questao24a" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24a" id="padrao_questao24a" value="Concordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24a" id="padrao_questao24a" value="Concordo totalmente" /></td>
                </tr>
                <tr>
                    <td align="left">Estou aberto(a) a novas  ideias ou novas formas  de realizar minhas  fun��es</td>
                    <td align="center"><input type="radio" required name="padrao_questao24b" id="padrao_questao24b" value="Discordo totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24b" id="padrao_questao24b" value="Discordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24b" id="padrao_questao24b" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24b" id="padrao_questao24b" value="Concordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24b" id="padrao_questao24b" value="Concordo totalmente" /></td>
                </tr>
                <tr>
                    <td align="left">Compartilho ideias e  melhores pr�ticas</td>
                    <td align="center"><input type="radio" required name="padrao_questao24c" id="padrao_questao24c" value="Discordo totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24c" id="padrao_questao24c" value="Discordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24c" id="padrao_questao24c" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24c" id="padrao_questao24c" value="Concordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24c" id="padrao_questao24c" value="Concordo totalmente" /></td>
                </tr>
                <tr>
                    <td align="left">Sinto que compartilham  ideias e melhores  pr�ticas comigo</td>
                    <td align="center"><input type="radio" required name="padrao_questao24d" id="padrao_questao24d" value="Discordo totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24d" id="padrao_questao24d" value="Discordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24d" id="padrao_questao24d" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24d" id="padrao_questao24d" value="Concordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24d" id="padrao_questao24d" value="Concordo totalmente" /></td>
                </tr>
                <tr>
                    <td align="left">Acredito que confiam  na minha capacidade  de realizar meu  trabalho</td>
                    <td align="center"><input type="radio" required name="padrao_questao24e" id="padrao_questao24e" value="Discordo totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24e" id="padrao_questao24e" value="Discordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24e" id="padrao_questao24e" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24e" id="padrao_questao24e" value="Concordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24e" id="padrao_questao24e" value="Concordo totalmente" /></td>
                </tr>                
                <tr>
                    <td align="left"><strong>Fique � vontade para comentar sobre as respostas acima</strong></td>
                    <td colspan="5"><input type="text" class="form-control" name="padrao_questao24_justificativa" id="padrao_questao24_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q25. Classifique as afirma��es abaixo pensando na rela��o com colegas de trabalho.</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <thead>
                <tr>
                    <td>&nbsp;</td>
                    <td align="center"><strong>Discordo totalmente</strong></td>
                    <td align="center"><strong>Discordo parcialmente</strong></td>
                    <td align="center"><strong>Nem concordo, nem discordo</strong></td>
                    <td align="center"><strong>Concordo parcialmente</strong></td>
                    <td align="center"><strong>Concordo totalmente</strong></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="left">Sinto que posso propor  novas ideias ou tentar  novas formas de  desenvolver minhas  atividades</td>
                    <td align="center"><input type="radio" required name="padrao_questao25a" id="padrao_questao25a" value="Discordo totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25a" id="padrao_questao25a" value="Discordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25a" id="padrao_questao25a" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25a" id="padrao_questao25a" value="Concordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25a" id="padrao_questao25a" value="Concordo totalmente" /></td>
                </tr>
                <tr>
                    <td align="left">Estou aberto(a) a novas  ideias ou novas formas  de realizar minhas  fun��es</td>
                    <td align="center"><input type="radio" required name="padrao_questao25b" id="padrao_questao25b" value="Discordo totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25b" id="padrao_questao25b" value="Discordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25b" id="padrao_questao25b" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25b" id="padrao_questao25b" value="Concordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25b" id="padrao_questao25b" value="Concordo totalmente" /></td>
                </tr>
                <tr>
                    <td align="left">Compartilho ideias e  melhores pr�ticas</td>
                    <td align="center"><input type="radio" required name="padrao_questao25c" id="padrao_questao25c" value="Discordo totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25c" id="padrao_questao25c" value="Discordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25c" id="padrao_questao25c" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25c" id="padrao_questao25c" value="Concordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25c" id="padrao_questao25c" value="Concordo totalmente" /></td>
                </tr>
                <tr>
                    <td align="left">Sinto que compartilham  ideias e melhores  pr�ticas comigo</td>
                    <td align="center"><input type="radio" required name="padrao_questao25d" id="padrao_questao25d" value="Discordo totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25d" id="padrao_questao25d" value="Discordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25d" id="padrao_questao25d" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25d" id="padrao_questao25d" value="Concordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25d" id="padrao_questao25d" value="Concordo totalmente" /></td>
                </tr>
                <tr>
                    <td align="left">Acredito que confiam  na minha capacidade  de realizar meu  trabalho</td>
                    <td align="center"><input type="radio" required name="padrao_questao25e" id="padrao_questao25e" value="Discordo totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25e" id="padrao_questao25e" value="Discordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25e" id="padrao_questao25e" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25e" id="padrao_questao25e" value="Concordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25e" id="padrao_questao25e" value="Concordo totalmente" /></td>
                </tr>                
                <tr>
                    <td align="left"><strong>Fique � vontade para comentar sobre as respostas acima</strong></td>
                    <td colspan="5"><input type="text" class="form-control" name="padrao_questao25_justificativa" id="padrao_questao25_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q26. Classifique as afirma��es abaixo de acordo com a sua experi�ncia.</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <thead>
                <tr>
                    <td>&nbsp;</td>
                    <td align="center"><strong>Discordo totalmente</strong></td>
                    <td align="center"><strong>Discordo parcialmente</strong></td>
                    <td align="center"><strong>Nem concordo, nem discordo</strong></td>
                    <td align="center"><strong>Concordo parcialmente</strong></td>
                    <td align="center"><strong>Concordo totalmente</strong></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="left">Acredito que�todos t�m iguais oportunidades de crescimento dentro da empresa, independente de cor/ra�a/etnia, g�nero, orienta��o sexual ou outra caracter�stica pessoal</td>
                    <td align="center"><input type="radio" required name="padrao_questao26a" id="padrao_questao26a" value="Discordo totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26a" id="padrao_questao26a" value="Discordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26a" id="padrao_questao26a" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26a" id="padrao_questao26a" value="Concordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26a" id="padrao_questao26a" value="Concordo totalmente" /></td>
                </tr>
                <tr>
                    <td align="left">Planejo�continuar minha carreira e assumir cargos mais altos dentro da empresa</td>
                    <td align="center"><input type="radio" required name="padrao_questao26b" id="padrao_questao26b" value="Discordo totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26b" id="padrao_questao26b" value="Discordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26b" id="padrao_questao26b" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26b" id="padrao_questao26b" value="Concordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26b" id="padrao_questao26b" value="Concordo totalmente" /></td>
                </tr>
                <tr>
                    <td align="left">Confio na forma como o meu desempenho � avaliado</td>
                    <td align="center"><input type="radio" required name="padrao_questao26c" id="padrao_questao26c" value="Discordo totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26c" id="padrao_questao26c" value="Discordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26c" id="padrao_questao26c" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26c" id="padrao_questao26c" value="Concordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26c" id="padrao_questao26c" value="Concordo totalmente" /></td>
                </tr>
                <tr>
                    <td align="left">Acredito�que todos t�m iguais oportunidades de aprendizado e acesso a treinamentos dentro da empresa</td>
                    <td align="center"><input type="radio" required name="padrao_questao26d" id="padrao_questao26d" value="Discordo totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26d" id="padrao_questao26d" value="Discordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26d" id="padrao_questao26d" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26d" id="padrao_questao26d" value="Concordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26d" id="padrao_questao26d" value="Concordo totalmente" /></td>
                </tr>
                <tr>
                    <td align="left">Acredito que sei/saberia como reportar alguma situa��o de ass�dio ou preconceito vivenciado na empresa</td>
                    <td align="center"><input type="radio" required name="padrao_questao26e" id="padrao_questao26e" value="Discordo totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26e" id="padrao_questao26e" value="Discordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26e" id="padrao_questao26e" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26e" id="padrao_questao26e" value="Concordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26e" id="padrao_questao26e" value="Concordo totalmente" /></td>
                </tr>                
                <tr>
                    <td align="left"><strong>Fique � vontade para comentar sobre essa resposta:</strong></td>
                    <td colspan="5"><input type="text" class="form-control" name="padrao_questao26_justificativa" id="padrao_questao26_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q27. Quanto o tema de diversidade e inclus�o � importante para voc�?</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <thead>
                <tr>
                    <td align="center"><strong>0</strong></td>
                    <td align="center"><strong>1</strong></td>
                    <td align="center"><strong>2</strong></td>
                    <td align="center"><strong>3</strong></td>
                    <td align="center"><strong>4</strong></td>
                    <td align="center"><strong>5</strong></td>
                    <td align="center"><strong>6</strong></td>
                    <td align="center"><strong>7</strong></td>
                    <td align="center"><strong>8</strong></td>
                    <td align="center"><strong>9</strong></td>
                    <td align="center"><strong>10</strong></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="center"><strong><input type="radio" required name="padrao_questao27" id="padrao_questao27" value="0" /></strong></td>
                    <td align="center"><strong><input type="radio" required name="padrao_questao27" id="padrao_questao27" value="1" /></strong></td>
                    <td align="center"><strong><input type="radio" required name="padrao_questao27" id="padrao_questao27" value="2" /></strong></td>
                    <td align="center"><strong><input type="radio" required name="padrao_questao27" id="padrao_questao27" value="3" /></strong></td>
                    <td align="center"><strong><input type="radio" required name="padrao_questao27" id="padrao_questao27" value="4" /></strong></td>
                    <td align="center"><strong><input type="radio" required name="padrao_questao27" id="padrao_questao27" value="5" /></strong></td>
                    <td align="center"><strong><input type="radio" required name="padrao_questao27" id="padrao_questao27" value="6" /></strong></td>
                    <td align="center"><strong><input type="radio" required name="padrao_questao27" id="padrao_questao27" value="7" /></strong></td>
                    <td align="center"><strong><input type="radio" required name="padrao_questao27" id="padrao_questao27" value="8" /></strong></td>
                    <td align="center"><strong><input type="radio" required name="padrao_questao27" id="padrao_questao27" value="9" /></strong></td>
                    <td align="center"><strong><input type="radio" required name="padrao_questao27" id="padrao_questao27" value="10" /></strong></td>                    
                </tr>               
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>
        Q28. O censo de D&I � uma das etapas da estrutura��o do programa de diversidade e inclus�o da <?php echo getNomeEmpresa($nome_empresa_form); ?>.<br />
        Voc� gostaria de deixar algum coment�rio, depoimento ou sugest�o que nos ajudaria nas pr�ximas etapas?
    </p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody>
                <tr>
                    <td align="center" colspan="5"><textarea class="form-control" style="resize:none; height:100px;" placeholder="Informe aqui qualquer tipo de coment&aacute;rio" name="padrao_questao28" id="padrao_questao28" ></textarea></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>