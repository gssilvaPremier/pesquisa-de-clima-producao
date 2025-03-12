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
                    <td><input type="text" class="form-control" name="padrao_questao4_especifique" id="padrao_questao4_especifique" style="width:100%;" placeholder="Informe aqui sua especificação" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q5. Qual é a sua religião?</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody>
                <tr>
                    <td align="left">Católica</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Católica" /></td>
                </tr>
                <tr>
                    <td align="left">Evangélica</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Evangélica" /></td>
                </tr>
                <tr>
                    <td align="left">Espírita</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Espírita" /></td>
                </tr>
                <tr>
                    <td align="left">Umbanda</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Umbanda" /></td>
                </tr>
                <tr>
                    <td align="left">Candomblé</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Candomblé" /></td>
                </tr>
                <tr>
                    <td align="left">Sem religião</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Sem religião" /></td>
                </tr>
                <tr>
                    <td align="left">Pessoa agnóstica</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Pessoa agnóstica" /></td>
                </tr>
                <tr>
                    <td align="left">Hindu</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Hindu" /></td>
                </tr>
                <tr>
                    <td align="left">Mulçumana</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Mulçumana" /></td>
                </tr>
                <tr>
                    <td align="left">Budista</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Budista" /></td>
                </tr>
                <tr>
                    <td align="left">Judaísmo</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Judaísmo" /></td>
                </tr>
                <tr>
                    <td align="left">Prefiro não dizer</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Prefiro não dizer" /></td>
                </tr>
                <tr>
                    <td align="left">Outro (especifique)</td>
                    <td align="center"><input type="radio" required name="padrao_questao5" id="padrao_questao5" value="Outro (especifique)" data-trigger="padrao_questao5_especifique" /></td>
                </tr>
                <tr class="padrao_questao5_especifique" style="display:none;">
                    <td align="left"><strong>Especifique</strong></td>
                    <td><input type="text" class="form-control" name="padrao_questao5_especifique" id="padrao_questao5_especifique" style="width:100%;" placeholder="Informe aqui sua especificação" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q6. Você nasceu no Brasil?</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody>
                <tr>
                    <td align="left">Sim</td>
                    <td align="center"><input type="radio" required name="padrao_questao6" id="padrao_questao6" value="Sim" /></td>
                </tr>
                <tr>
                    <td align="left">Não</td>
                    <td align="center"><input type="radio" required name="padrao_questao6" id="padrao_questao6" value="Não" /></td>
                </tr>               
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q7. Em qual estado brasileiro você nasceu?</p>
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
                    <td align="left">Amapá</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Amapá" /></td>
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
                    <td align="left">Ceará</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Ceará" /></td>
                </tr>
                <tr>
                    <td align="left">Distrito Federal</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Distrito Federal" /></td>
                </tr>
                <tr>
                    <td align="left">Espírito Santo</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Espírito Santo" /></td>
                </tr>
                <tr>
                    <td align="left">Goiás</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Goiás" /></td>
                </tr>
                <tr>
                    <td align="left">Maranhão</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Maranhão" /></td>
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
                    <td align="left">Pará</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Pará" /></td>
                </tr>
                <tr>
                    <td align="left">Paraíba</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Paraíba" /></td>
                </tr>
                <tr>
                    <td align="left">Paraná</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Paraná" /></td>
                </tr>
                <tr>
                    <td align="left">Pernambuco</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Pernambuco" /></td>
                </tr>
                <tr>
                    <td align="left">Piauí</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Piauí" /></td>
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
                    <td align="left">Rondônia</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="Rondônia" /></td>
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
                    <td align="left">São Paulo</td>
                    <td align="center"><input type="radio" required name="padrao_questao7" id="padrao_questao7" value="São Paulo" /></td>
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
    <p>Q8. Você se identifica como:</p>
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
                    <td align="left">Não binário (pessoa que não se identifica nem com o gênero masculino, nem com o gênero feminino)</td>
                    <td align="center"><input type="radio" required name="padrao_questao8" id="padrao_questao8" value="Não binário (pessoa que não se identifica nem com o gênero masculino, nem com o gênero feminino)" /></td>
                </tr>
                <tr>
                    <td align="left">Outro (descreva)</td>
                    <td align="center"><input type="radio" required name="padrao_questao8" id="padrao_questao8" value="Outro (descreva)" data-trigger="padrao_questao8_especifique" /></td>
                </tr>
                <tr class="padrao_questao8_especifique" style="display:none;">
                    <td align="left"><strong>Descreva</strong></td>
                    <td><input type="text" class="form-control" name="padrao_questao8_especifique" id="padrao_questao8_especifique" style="width:100%;" placeholder="Informe aqui sua descrição" /></td>
                </tr>                
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q9. Ainda sobre identidade de gênero, você se definiria como:<br />
        <small>Observação: a pessoa transgênera é aquela que não se identifica com o gênero designado a ela no momento do nascimento.<br />
        Exemplo: quando nasceu disseram que era menino e, ao longo da vida, começou a se apresentar como mulher. De outro lado, a pessoa cisgênero é aquele que não é transgênero (simples assim).<br />Caso tenha dúvidas, veja esse vídeo: <a href="https://www.youtube.com/watch?v=_hoJg896LBw" target="_blank">https://www.youtube.com/watch?v=_hoJg896LBw</a></small></p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody>
                <tr>
                    <td align="left">Cisgênero (pessoas que se identificam com o gênero designado a elas em seu nascimento)</td>
                    <td align="center"><input type="radio" required name="padrao_questao9" id="padrao_questao9" value="Cisgênero (pessoas que se identificam com o gênero designado a elas em seu nascimento)" /></td>
                </tr>
                <tr>
                    <td align="left">Transgênero (pessoas que não se identificam com o gênero designado a elas em seu nascimento)</td>
                    <td align="center"><input type="radio" required name="padrao_questao9" id="padrao_questao9" value="Transgênero (pessoas que não se identificam com o gênero designado a elas em seu nascimento)" /></td>
                </tr>               
                <tr>
                    <td align="left">Prefiro não dizer</td>
                    <td align="center"><input type="radio" required name="padrao_questao9" id="padrao_questao9" value="Prefiro não dizer" /></td>
                </tr>
                <tr>
                    <td align="left">Outro (especifique)</td>
                    <td align="center"><input type="radio" required name="padrao_questao9" id="padrao_questao9" value="Outro (especifique)" data-trigger="padrao_questao9_especifique" /></td>
                </tr>
                <tr class="padrao_questao9_especifique" style="display:none;">
                    <td align="left"><strong>Especifique</strong></td>
                    <td><input type="text" class="form-control" name="padrao_questao9_especifique" id="padrao_questao9_especifique" style="width:100%;" placeholder="Informe aqui sua especificação" /></td>
                </tr>                
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q10. Qual sua orientação sexual?</p>
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
                    <td align="left">Prefiro não dizer</td>
                    <td align="center"><input type="radio" required name="padrao_questao10" id="padrao_questao10" value="Prefiro não dizer" /></td>
                </tr>
                <tr>
                    <td align="left">Outro (especifique)</td>
                    <td align="center"><input type="radio" required name="padrao_questao10" id="padrao_questao10" value="Outro (especifique)" data-trigger="padrao_questao10_especifique" /></td>
                </tr>
                <tr class="padrao_questao10_especifique" style="display:none;">
                    <td align="left"><strong>Especifique</strong></td>
                    <td><input type="text" class="form-control" name="padrao_questao10_especifique" id="padrao_questao10_especifique" style="width:100%;" placeholder="Informe aqui sua especificação" /></td>
                </tr>                
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q11. Há quanto tempo que você faz parte da empresa?</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody>
                <tr>
                    <td align="left">Até 3 meses</td>
                    <td align="center"><input type="radio" required name="padrao_questao11" id="padrao_questao11" value="Até 3 meses" /></td>
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
                    <td align="left">Entre 2 e 5 anos</td>
                    <td align="center"><input type="radio" required name="padrao_questao11" id="padrao_questao11" value="Entre 2 e 5 anos" /></td>
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
    <p>Q12. Classifique a empresa quanto às afirmações abaixo.</p>
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
                    <td align="left">A empresa é comprometida com diversidade e inclusão</td>
                    <td align="center"><input type="radio" required name="padrao_questao12a" id="padrao_questao12a" value="Discordo Totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao12a" id="padrao_questao12a" value="Discordo Parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao12a" id="padrao_questao12a" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao12a" id="padrao_questao12a" value="Concordo Parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao12a" id="padrao_questao12a" value="Concordo Totalmente" /></td>
                </tr>
                <tr>
                    <td align="left">Há esforço de toda a empresa em promover a diversidade</td>
                    <td align="center"><input type="radio" required name="padrao_questao12b" id="padrao_questao12b" value="Discordo Totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao12b" id="padrao_questao12b" value="Discordo Parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao12b" id="padrao_questao12b" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao12b" id="padrao_questao12b" value="Concordo Parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao12b" id="padrao_questao12b" value="Concordo Totalmente" /></td>
                </tr>
                <tr>
                    <td align="left"><strong>Fique à vontade para comentar suas respostas:</strong></td>
                    <td colspan="5"><input type="text" class="form-control" name="padrao_questao12_justificativa" id="padrao_questao12_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q13. Classifique quanto cada afirmativa abaixo descreve sua experiência na empresa.</p>
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
                    <td align="left">Sinto que meus valores estão alinhados aos valores da empresa</td>
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
                    <td align="left"><strong>Fique à vontade para comentar suas respostas:</strong></td>
                    <td colspan="5"><input type="text" class="form-control" name="padrao_questao13_justificativa" id="padrao_questao13_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q14. Termine as afirmações abaixo da forma como você acredita que melhor se aplica à sua experiência com a sua liderança.</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <thead>
                <tr>
                    <td>&nbsp;</td>
                    <td align="center"><strong>Nunca</strong></td>
                    <td align="center"><strong>Raramente</strong></td>
                    <td align="center"><strong>Algumas vezes</strong></td>
                    <td align="center"><strong>Com Frequência</strong></td>
                    <td align="center"><strong>Sempre</strong></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="left">Escuto comentários preconceituosos</td>
                    <td align="center"><input type="radio" required name="padrao_questao14a" id="padrao_questao14a" value="Nunca" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao14a" id="padrao_questao14a" value="Raramente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao14a" id="padrao_questao14a" value="Algumas vezes" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao14a" id="padrao_questao14a" value="Com Frequência" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao14a" id="padrao_questao14a" value="Sempre" /></td>
                </tr>
                <tr>
                    <td align="left">Sinto que minhas opiniões são consideradas</td>
                    <td align="center"><input type="radio" required name="padrao_questao14b" id="padrao_questao14b" value="Nunca" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao14b" id="padrao_questao14b" value="Raramente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao14b" id="padrao_questao14b" value="Algumas vezes" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao14b" id="padrao_questao14b" value="Com Frequência" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao14b" id="padrao_questao14b" value="Sempre" /></td>
                </tr>
                <tr>
                    <td align="left">Sinto que sou interrompido(a) excessivamente em reuniões</td>
                    <td align="center"><input type="radio" required name="padrao_questao14c" id="padrao_questao14c" value="Nunca" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao14c" id="padrao_questao14c" value="Raramente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao14c" id="padrao_questao14c" value="Algumas vezes" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao14c" id="padrao_questao14c" value="Com Frequência" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao14c" id="padrao_questao14c" value="Sempre" /></td>
                </tr>
                <tr>
                    <td align="left"><strong>Fique à vontade para comentar suas respostas:</strong></td>
                    <td colspan="5"><input type="text" class="form-control" name="padrao_questao14_justificativa" id="padrao_questao14_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q15. Termine as afirmações abaixo da forma como você acredita que melhor se aplica à sua experiência com seus colegas de trabalho.</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <thead>
                <tr>
                    <td>&nbsp;</td>
                    <td align="center"><strong>Nunca</strong></td>
                    <td align="center"><strong>Raramente</strong></td>
                    <td align="center"><strong>Algumas vezes</strong></td>
                    <td align="center"><strong>Com Frequência</strong></td>
                    <td align="center"><strong>Sempre</strong></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="left">Escuto comentários preconceituosos</td>
                    <td align="center"><input type="radio" required name="padrao_questao15a" id="padrao_questao15a" value="Nunca" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao15a" id="padrao_questao15a" value="Raramente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao15a" id="padrao_questao15a" value="Algumas vezes" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao15a" id="padrao_questao15a" value="Com Frequência" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao15a" id="padrao_questao15a" value="Sempre" /></td>
                </tr>
                <tr>
                    <td align="left">Sinto que minhas opiniões são consideradas</td>
                    <td align="center"><input type="radio" required name="padrao_questao15b" id="padrao_questao15b" value="Nunca" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao15b" id="padrao_questao15b" value="Raramente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao15b" id="padrao_questao15b" value="Algumas vezes" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao15b" id="padrao_questao15b" value="Com Frequência" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao15b" id="padrao_questao15b" value="Sempre" /></td>
                </tr>
                <tr>
                    <td align="left">Sinto que sou interrompido(a) excessivamente em reuniões</td>
                    <td align="center"><input type="radio" required name="padrao_questao15c" id="padrao_questao15c" value="Nunca" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao15c" id="padrao_questao15c" value="Raramente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao15c" id="padrao_questao15c" value="Algumas vezes" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao15c" id="padrao_questao15c" value="Com Frequência" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao15c" id="padrao_questao15c" value="Sempre" /></td>
                </tr>
                <tr>
                    <td align="left"><strong>Fique à vontade para comentar suas respostas:</strong></td>
                    <td colspan="5"><input type="text" class="form-control" name="padrao_questao15_justificativa" id="padrao_questao15_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q16. Termine as afirmações abaixo da forma como você acredita que melhor se aplica à sua experiência com outras lideranças (se você não tiver contato com outras lideranças, escolha a opção "nunca").</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <thead>
                <tr>
                    <td>&nbsp;</td>
                    <td align="center"><strong>Nunca</strong></td>
                    <td align="center"><strong>Raramente</strong></td>
                    <td align="center"><strong>Algumas vezes</strong></td>
                    <td align="center"><strong>Com Frequência</strong></td>
                    <td align="center"><strong>Sempre</strong></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="left">Escuto comentários preconceituosos</td>
                    <td align="center"><input type="radio" required name="padrao_questao16a" id="padrao_questao16a" value="Nunca" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao16a" id="padrao_questao16a" value="Raramente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao16a" id="padrao_questao16a" value="Algumas vezes" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao16a" id="padrao_questao16a" value="Com Frequência" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao16a" id="padrao_questao16a" value="Sempre" /></td>
                </tr>
                <tr>
                    <td align="left">Sinto que minhas opiniões são consideradas</td>
                    <td align="center"><input type="radio" required name="padrao_questao16b" id="padrao_questao16b" value="Nunca" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao16b" id="padrao_questao16b" value="Raramente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao16b" id="padrao_questao16b" value="Algumas vezes" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao16b" id="padrao_questao16b" value="Com Frequência" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao16b" id="padrao_questao16b" value="Sempre" /></td>
                </tr>
                <tr>
                    <td align="left">Sinto que sou interrompido(a) excessivamente em reuniões</td>
                    <td align="center"><input type="radio" required name="padrao_questao16c" id="padrao_questao16c" value="Nunca" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao16c" id="padrao_questao16c" value="Raramente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao16c" id="padrao_questao16c" value="Algumas vezes" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao16c" id="padrao_questao16c" value="Com Frequência" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao16c" id="padrao_questao16c" value="Sempre" /></td>
                </tr>
                <tr>
                    <td align="left"><strong>Fique à vontade para comentar suas respostas:</strong></td>
                    <td colspan="5"><input type="text" class="form-control" name="padrao_questao16_justificativa" id="padrao_questao16_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q17. Você já foi VÍTIMA de alguma situação de desrespeito na empresa? (Ex: comentários, retaliações, interrupções sucessivas...).</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody>
                <tr>
                    <td align="left">Sim</td>
                    <td align="center"><input type="radio" required name="padrao_questao17" id="padrao_questao17" value="Sim" /></td>
                </tr>
                <tr>
                    <td align="left">Não</td>
                    <td align="center"><input type="radio" required name="padrao_questao17" id="padrao_questao17" value="Não" /></td>
                </tr>               
                <tr>
                    <td align="left">Prefiro não dizer</td>
                    <td align="center"><input type="radio" required name="padrao_questao17" id="padrao_questao17" value="Prefiro não dizer" /></td>
                </tr>               
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q18. Marque se você vivenciou desrespeito relacionado a alguma(s) das características abaixo:</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody class="group-checkbox">                
                <tr>
                    <td align="left">Idade</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao18b" id="padrao_questao18b" value="Idade" /></td>
                </tr>               
                <tr>
                    <td align="left">Gênero</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao18c" id="padrao_questao18c" value="Gênero" /></td>
                </tr>
                 <tr>
                    <td align="left">Identidade de gênero</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao18d" id="padrao_questao18d" value="Identidade de gênero" /></td>
                </tr>
                 <tr>
                    <td align="left">Orientação sexual</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao18e" id="padrao_questao18e" value="Orientação sexual" /></td>
                </tr>
                 <tr>
                    <td align="left">Escolaridade</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao18f" id="padrao_questao18f" value="Escolaridade" /></td>
                </tr>
                 <tr>
                    <td align="left">Deficiência</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao18g" id="padrao_questao18g" value="Deficiência" /></td>
                </tr>
                 <tr>
                    <td align="left">Origem</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao18h" id="padrao_questao18h" value="Origem" /></td>
                </tr>
                 <tr>
                    <td align="left">Religião</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao18i" id="padrao_questao18i" value="Religião" /></td>
                </tr>
                 <tr>
                    <td align="left">Cor/raça/etnia</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao18j" id="padrao_questao18j" value="Cor/raça/etnia" /></td>
                </tr>
                 <tr>
                    <td align="left">Prefiro não dizer</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao18k" id="padrao_questao18k" value="Prefiro não dizer" /></td>
                </tr>
                <tr>
                    <td align="left">Não vivenciei situações de desrespeito</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao18l" id="padrao_questao18l" value="Não vivenciei situações de desrespeito" /></td>
                </tr>
                <tr>
                    <td align="left"><strong>Fique à vontade para adicionar outras características:</strong></td>
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
    <p>Q19. Qual(is) das opções abaixo melhor representa(m) a(s) pessoa(s) que reproduziram o desrespeito presenciado?</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody class="group-checkbox">
                <tr>
                    <td align="left">Colega(s) de trabalho</td>
                    <td align="center"><input type="checkbox" required name="padrao_questao19a" id="padrao_questao19a" value="Colega(s) de trabalho" /></td>
                </tr>
                <tr>
                    <td align="left">Liderança geral</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao19b" id="padrao_questao19b" value="Liderança geral" /></td>
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
                    <td align="left">Prefiro não dizer</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao19f" id="padrao_questao19f" value="Prefiro não dizer" /></td>
                </tr>                
                <tr>
                    <td align="left">Não vivenciei situações de desrespeito</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao19h" id="padrao_questao19h" value="Não vivenciei situações de desrespeito" /></td>
                </tr>
                <tr>
                    <td align="left">Outro (especifique)</td>
                    <td align="center"><input type="checkbox"  name="padrao_questao19g" id="padrao_questao19g" value="Outro (especifique)" data-trigger="padrao_questao19_especifique" /></td>
                </tr>
                <tr class="padrao_questao19_especifique" style="display:none;">
                    <td align="left"><strong>Especifique</strong></td>
                    <td><input type="text" class="form-control" name="padrao_questao19_especifique" id="padrao_questao19_especifique" style="width:100%;" placeholder="Informe aqui sua especificação" /></td>
                </tr>                
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q20. Você já PRESENCIOU alguma situação de desrespeito na empresa? (Ex: comentários, retaliações, interrupções sucessivas...).</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody>
                <tr>
                    <td align="left">Sim</td>
                    <td align="center"><input type="radio" required name="padrao_questao20" id="padrao_questao20" value="Sim" /></td>
                </tr>
                <tr>
                    <td align="left">Não</td>
                    <td align="center"><input type="radio" required name="padrao_questao20" id="padrao_questao20" value="Não" /></td>
                </tr>               
                <tr>
                    <td align="left">Prefiro não dizer</td>
                    <td align="center"><input type="radio" required name="padrao_questao20" id="padrao_questao20" value="Prefiro não dizer" /></td>
                </tr>               
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q21. Marque se você presenciou desrespeito relacionado a alguma(s) das características abaixo:</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody class="group-checkbox">                
                <tr>
                    <td align="left">Idade</td>
                    <td align="center"><input type="checkbox" name="padrao_questao21b" id="padrao_questao21b" value="Idade" /></td>
                </tr>               
                <tr>
                    <td align="left">Gênero</td>
                    <td align="center"><input type="checkbox" name="padrao_questao21c" id="padrao_questao21c" value="Gênero" /></td>
                </tr>
                 <tr>
                    <td align="left">Identidade de gênero</td>
                    <td align="center"><input type="checkbox" name="padrao_questao21d" id="padrao_questao21d" value="Identidade de gênero" /></td>
                </tr>
                 <tr>
                    <td align="left">Orientação sexual</td>
                    <td align="center"><input type="checkbox" name="padrao_questao21e" id="padrao_questao21e" value="Orientação sexual" /></td>
                </tr>
                 <tr>
                    <td align="left">Escolaridade</td>
                    <td align="center"><input type="checkbox" name="padrao_questao21f" id="padrao_questao21f" value="Escolaridade" /></td>
                </tr>
                 <tr>
                    <td align="left">Deficiência</td>
                    <td align="center"><input type="checkbox" name="padrao_questao21g" id="padrao_questao21g" value="Deficiência" /></td>
                </tr>
                 <tr>
                    <td align="left">Origem</td>
                    <td align="center"><input type="checkbox" name="padrao_questao21h" id="padrao_questao21h" value="Origem" /></td>
                </tr>
                 <tr>
                    <td align="left">Religião</td>
                    <td align="center"><input type="checkbox" name="padrao_questao21i" id="padrao_questao21i" value="Religião" /></td>
                </tr>
                 <tr>
                    <td align="left">Cor/raça/etnia</td>
                    <td align="center"><input type="checkbox" name="padrao_questao21j" id="padrao_questao21j" value="Cor/raça/etnia" /></td>
                </tr>
                 <tr>
                    <td align="left">Prefiro não dizer</td>
                    <td align="center"><input type="checkbox" name="padrao_questao21k" id="padrao_questao21k" value="Prefiro não dizer" /></td>
                </tr>
                 <tr>
                    <td align="left">Não presenciei situações de desrespeito</td>
                    <td align="center"><input type="checkbox" name="padrao_questao21l" id="padrao_questao21l" value="Não presenciei situações de desrespeito" /></td>
                </tr>
                <tr>
                    <td align="left"><strong>Fique à vontade para adicionar outras características:</strong></td>
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
    <p>Q22. Qual(is) das opções abaixo melhor representa(m) a(s) pessoa(s) que reproduziram o desrespeito presenciado?</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <tbody class="group-checkbox">
                <tr>
                    <td align="left">Colega(s) de trabalho</td>
                    <td align="center"><input type="checkbox" required name="padrao_questao22a" id="padrao_questao22a" value="Colega(s) de trabalho" /></td>
                </tr>
                <tr>
                    <td align="left">Liderança geral</td>
                    <td align="center"><input type="checkbox" name="padrao_questao22b" id="padrao_questao22b" value="Liderança geral" /></td>
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
                    <td align="left">Prefiro não dizer</td>
                    <td align="center"><input type="checkbox" name="padrao_questao22f" id="padrao_questao22f" value="Prefiro não dizer" /></td>
                </tr>                
                <tr>
                    <td align="left">Não presenciei situações de desrespeito</td>
                    <td align="center"><input type="checkbox" name="padrao_questao21h" id="padrao_questao21h" value="Não presenciei situações de desrespeito" /></td>
                </tr>
                <tr>
                    <td align="left">Outro (especifique)</td>
                    <td align="center"><input type="checkbox" name="padrao_questao22g" id="padrao_questao22g" value="Outro (especifique)" data-trigger="padrao_questao22_especifique" /></td>
                </tr>
                <tr class="padrao_questao22_especifique" style="display:none;">
                    <td align="left"><strong>Especifique</strong></td>
                    <td><input type="text" class="form-control" name="padrao_questao22_especifique" id="padrao_questao22_especifique" style="width:100%;" placeholder="Informe aqui sua especificação" /></td>
                </tr>               
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q23. Classifique quão confortável você estaria para falar (sobre assuntos profissionais ou pessoais) com pessoas dos grupos citados abaixo:</p>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed table-responsive table-bordered table-striped">
            <thead>
                <tr>
                    <td>&nbsp;</td>
                    <td align="center"><strong>Sinto que existe um bloqueio</strong></td>
                    <td align="center"><strong>Sinto algum receio</strong></td>
                    <td align="center"><strong>Não sinto receio mas não me sinto a vontade</strong></td>
                    <td align="center"><strong>Me sinto à vontade</strong></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="left">Pessoas de níveis hierárquicos diferentes</td>
                    <td align="center"><input type="radio" required name="padrao_questao23a" id="padrao_questao23a" value="Sinto que existe um bloqueio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23a" id="padrao_questao23a" value="Sinto algum receio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23a" id="padrao_questao23a" value="Não sinto receio mas não me sinto a vontade" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23a" id="padrao_questao23a" value="Me sinto à vontade" /></td>
                </tr>
                <tr>
                    <td align="left">Pessoas de gênero diferente</td>
                    <td align="center"><input type="radio" required name="padrao_questao23b" id="padrao_questao23b" value="Sinto que existe um bloqueio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23b" id="padrao_questao23b" value="Sinto algum receio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23b" id="padrao_questao23b" value="Não sinto receio mas não me sinto a vontade" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23b" id="padrao_questao23b" value="Me sinto à vontade" /></td>
                </tr>
                <tr>
                    <td align="left">Pessoas LGBTQIA+</td>
                    <td align="center"><input type="radio" required name="padrao_questao23c" id="padrao_questao23c" value="Sinto que existe um bloqueio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23c" id="padrao_questao23c" value="Sinto algum receio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23c" id="padrao_questao23c" value="Não sinto receio mas não me sinto a vontade" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23c" id="padrao_questao23c" value="Me sinto à vontade" /></td>
                </tr>
                <tr>
                    <td align="left">Pessoas de países diferentes</td>
                    <td align="center"><input type="radio" required name="padrao_questao23d" id="padrao_questao23d" value="Sinto que existe um bloqueio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23d" id="padrao_questao23d" value="Sinto algum receio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23d" id="padrao_questao23d" value="Não sinto receio mas não me sinto a vontade" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23d" id="padrao_questao23d" value="Me sinto à vontade" /></td>
                </tr>
                <tr>
                    <td align="left">Pessoas de áreas diferentes</td>
                    <td align="center"><input type="radio" required name="padrao_questao23e" id="padrao_questao23e" value="Sinto que existe um bloqueio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23e" id="padrao_questao23e" value="Sinto algum receio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23e" id="padrao_questao23e" value="Não sinto receio mas não me sinto a vontade" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23e" id="padrao_questao23e" value="Me sinto à vontade" /></td>
                </tr>
                <tr>
                    <td align="left">Pessoas com deficiência</td>
                    <td align="center"><input type="radio" required name="padrao_questao23f" id="padrao_questao23f" value="Sinto que existe um bloqueio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23f" id="padrao_questao23f" value="Sinto algum receio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23f" id="padrao_questao23f" value="Não sinto receio mas não me sinto a vontade" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23f" id="padrao_questao23f" value="Me sinto à vontade" /></td>
                </tr>
                <tr>
                    <td align="left">Pessoas de raça/etnia diferentes da sua</td>
                    <td align="center"><input type="radio" required name="padrao_questao23g" id="padrao_questao23g" value="Sinto que existe um bloqueio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23g" id="padrao_questao23g" value="Sinto algum receio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23g" id="padrao_questao23g" value="Não sinto receio mas não me sinto a vontade" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23g" id="padrao_questao23g" value="Me sinto à vontade" /></td>
                </tr>
                <tr>
                    <td align="left">Pessoas que falam uma língua nativa diferente da minha</td>
                    <td align="center"><input type="radio" required name="padrao_questao23h" id="padrao_questao23h" value="Sinto que existe um bloqueio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23h" id="padrao_questao23h" value="Sinto algum receio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23h" id="padrao_questao23h" value="Não sinto receio mas não me sinto a vontade" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23h" id="padrao_questao23h" value="Me sinto à vontade" /></td>
                </tr>
                <tr>
                    <td align="left">Pessoas de idades diferentes das minhas</td>
                    <td align="center"><input type="radio" required name="padrao_questao23i" id="padrao_questao23i" value="Sinto que existe um bloqueio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23i" id="padrao_questao23i" value="Sinto algum receio" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23i" id="padrao_questao23i" value="Não sinto receio mas não me sinto a vontade" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao23i" id="padrao_questao23i" value="Me sinto à vontade" /></td>
                </tr>
                <tr>
                    <td align="left"><strong>Fique à vontade para comentar ou adicionar outros motivos para haver receio:</strong></td>
                    <td colspan="4"><input type="text" class="form-control" name="padrao_questao23_justificativa" id="padrao_questao23_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q24. Classifique as afirmações abaixo pensando na relação com o(a) seu/sua líder.</p>
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
                    <td align="left">Estou aberto(a) a novas  ideias ou novas formas  de realizar minhas  funções</td>
                    <td align="center"><input type="radio" required name="padrao_questao24b" id="padrao_questao24b" value="Discordo totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24b" id="padrao_questao24b" value="Discordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24b" id="padrao_questao24b" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24b" id="padrao_questao24b" value="Concordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24b" id="padrao_questao24b" value="Concordo totalmente" /></td>
                </tr>
                <tr>
                    <td align="left">Compartilho ideias e  melhores práticas</td>
                    <td align="center"><input type="radio" required name="padrao_questao24c" id="padrao_questao24c" value="Discordo totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24c" id="padrao_questao24c" value="Discordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24c" id="padrao_questao24c" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24c" id="padrao_questao24c" value="Concordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao24c" id="padrao_questao24c" value="Concordo totalmente" /></td>
                </tr>
                <tr>
                    <td align="left">Sinto que compartilham  ideias e melhores  práticas comigo</td>
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
                    <td align="left"><strong>Fique à vontade para comentar sobre as respostas acima</strong></td>
                    <td colspan="5"><input type="text" class="form-control" name="padrao_questao24_justificativa" id="padrao_questao24_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q25. Classifique as afirmações abaixo pensando na relação com colegas de trabalho.</p>
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
                    <td align="left">Estou aberto(a) a novas  ideias ou novas formas  de realizar minhas  funções</td>
                    <td align="center"><input type="radio" required name="padrao_questao25b" id="padrao_questao25b" value="Discordo totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25b" id="padrao_questao25b" value="Discordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25b" id="padrao_questao25b" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25b" id="padrao_questao25b" value="Concordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25b" id="padrao_questao25b" value="Concordo totalmente" /></td>
                </tr>
                <tr>
                    <td align="left">Compartilho ideias e  melhores práticas</td>
                    <td align="center"><input type="radio" required name="padrao_questao25c" id="padrao_questao25c" value="Discordo totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25c" id="padrao_questao25c" value="Discordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25c" id="padrao_questao25c" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25c" id="padrao_questao25c" value="Concordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao25c" id="padrao_questao25c" value="Concordo totalmente" /></td>
                </tr>
                <tr>
                    <td align="left">Sinto que compartilham  ideias e melhores  práticas comigo</td>
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
                    <td align="left"><strong>Fique à vontade para comentar sobre as respostas acima</strong></td>
                    <td colspan="5"><input type="text" class="form-control" name="padrao_questao25_justificativa" id="padrao_questao25_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q26. Classifique as afirmações abaixo de acordo com a sua experiência.</p>
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
                    <td align="left">Acredito que todos têm iguais oportunidades de crescimento dentro da empresa, independente de cor/raça/etnia, gênero, orientação sexual ou outra característica pessoal</td>
                    <td align="center"><input type="radio" required name="padrao_questao26a" id="padrao_questao26a" value="Discordo totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26a" id="padrao_questao26a" value="Discordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26a" id="padrao_questao26a" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26a" id="padrao_questao26a" value="Concordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26a" id="padrao_questao26a" value="Concordo totalmente" /></td>
                </tr>
                <tr>
                    <td align="left">Planejo continuar minha carreira e assumir cargos mais altos dentro da empresa</td>
                    <td align="center"><input type="radio" required name="padrao_questao26b" id="padrao_questao26b" value="Discordo totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26b" id="padrao_questao26b" value="Discordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26b" id="padrao_questao26b" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26b" id="padrao_questao26b" value="Concordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26b" id="padrao_questao26b" value="Concordo totalmente" /></td>
                </tr>
                <tr>
                    <td align="left">Confio na forma como o meu desempenho é avaliado</td>
                    <td align="center"><input type="radio" required name="padrao_questao26c" id="padrao_questao26c" value="Discordo totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26c" id="padrao_questao26c" value="Discordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26c" id="padrao_questao26c" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26c" id="padrao_questao26c" value="Concordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26c" id="padrao_questao26c" value="Concordo totalmente" /></td>
                </tr>
                <tr>
                    <td align="left">Acredito que todos têm iguais oportunidades de aprendizado e acesso a treinamentos dentro da empresa</td>
                    <td align="center"><input type="radio" required name="padrao_questao26d" id="padrao_questao26d" value="Discordo totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26d" id="padrao_questao26d" value="Discordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26d" id="padrao_questao26d" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26d" id="padrao_questao26d" value="Concordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26d" id="padrao_questao26d" value="Concordo totalmente" /></td>
                </tr>
                <tr>
                    <td align="left">Acredito que sei/saberia como reportar alguma situação de assédio ou preconceito vivenciado na empresa</td>
                    <td align="center"><input type="radio" required name="padrao_questao26e" id="padrao_questao26e" value="Discordo totalmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26e" id="padrao_questao26e" value="Discordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26e" id="padrao_questao26e" value="Nem concordo, nem discordo" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26e" id="padrao_questao26e" value="Concordo parcialmente" /></td>
                    <td align="center"><input type="radio" required name="padrao_questao26e" id="padrao_questao26e" value="Concordo totalmente" /></td>
                </tr>                
                <tr>
                    <td align="left"><strong>Fique à vontade para comentar sobre essa resposta:</strong></td>
                    <td colspan="5"><input type="text" class="form-control" name="padrao_questao26_justificativa" id="padrao_questao26_justificativa" style="width:100%;" value="" placeholder="Informe aqui sua justificativa" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-xs-12 col-md-12 col-lg-12">
    <p>Q27. Quanto o tema de diversidade e inclusão é importante para você?</p>
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
        Q28. O censo de D&I é uma das etapas da estruturação do programa de diversidade e inclusão da <?php echo getNomeEmpresa($nome_empresa_form); ?>.<br />
        Você gostaria de deixar algum comentário, depoimento ou sugestão que nos ajudaria nas próximas etapas?
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