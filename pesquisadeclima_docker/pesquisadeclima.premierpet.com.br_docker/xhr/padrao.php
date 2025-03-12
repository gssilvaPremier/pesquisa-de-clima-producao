<?php
@session_start();

if(intval(@$_POST['padrao']) == 1){

    $chaveAlterada = 'c' . $_SESSION['chave'];
    $empresaAlterada = -1;

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao1', '".converte($_POST['padrao_questao1'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao2', '".converte($_POST['padrao_questao2'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao3', '".converte($_POST['padrao_questao3'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao4a', '".converte($_POST['padrao_questao4a'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao4b', '".converte($_POST['padrao_questao4b'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao4c', '".converte($_POST['padrao_questao4c'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao4d', '".converte($_POST['padrao_questao4d'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao4e', '".converte($_POST['padrao_questao4e'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao4f', '".converte($_POST['padrao_questao4f'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao4g', '".converte($_POST['padrao_questao4g'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao4_especifique', '".converte($_POST['padrao_questao4_especifique'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao5', '".converte($_POST['padrao_questao5'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao5_especifique', '".converte($_POST['padrao_questao5_especifique'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao6', '".converte($_POST['padrao_questao6'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao7', '".converte($_POST['padrao_questao7'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao8', '".converte($_POST['padrao_questao8'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao8_especifique', '".converte($_POST['padrao_questao8_especifique'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao9', '".converte($_POST['padrao_questao9'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao9_especifique', '".converte($_POST['padrao_questao9_especifique'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao10', '".converte($_POST['padrao_questao10'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao10_especifique', '".converte($_POST['padrao_questao10_especifique'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao11', '".converte($_POST['padrao_questao11'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao12a', '".converte($_POST['padrao_questao12a'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao12b', '".converte($_POST['padrao_questao12b'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao12_justificativa', '".converte($_POST['padrao_questao12_justificativa'])."'); ";


    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao13a', '".converte($_POST['padrao_questao13a'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao13b', '".converte($_POST['padrao_questao13b'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao13c', '".converte($_POST['padrao_questao13c'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao13_justificativa', '".converte($_POST['padrao_questao13_justificativa'])."'); ";


    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao14a', '".converte($_POST['padrao_questao14a'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao14b', '".converte($_POST['padrao_questao14b'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao14c', '".converte($_POST['padrao_questao14c'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao14_justificativa', '".converte($_POST['padrao_questao14_justificativa'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao15a', '".converte($_POST['padrao_questao15a'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao15b', '".converte($_POST['padrao_questao15b'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao15c', '".converte($_POST['padrao_questao15c'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao15_justificativa', '".converte($_POST['padrao_questao15_justificativa'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao16a', '".converte($_POST['padrao_questao16a'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao16b', '".converte($_POST['padrao_questao16b'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao16c', '".converte($_POST['padrao_questao16c'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao16_justificativa', '".converte($_POST['padrao_questao16_justificativa'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao17', '".converte($_POST['padrao_questao17'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao18a', '".converte($_POST['padrao_questao18a'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao18b', '".converte($_POST['padrao_questao18b'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao18c', '".converte($_POST['padrao_questao18c'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao18d', '".converte($_POST['padrao_questao18d'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao18e', '".converte($_POST['padrao_questao18e'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao18f', '".converte($_POST['padrao_questao18f'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao18g', '".converte($_POST['padrao_questao18g'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao18h', '".converte($_POST['padrao_questao18h'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao18i', '".converte($_POST['padrao_questao18i'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao18j', '".converte($_POST['padrao_questao18j'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao18k', '".converte($_POST['padrao_questao18k'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao18l', '".converte($_POST['padrao_questao18l'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao18_justificativa', '".converte($_POST['padrao_questao18_justificativa'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao19a', '".converte($_POST['padrao_questao19a'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao19b', '".converte($_POST['padrao_questao19b'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao19c', '".converte($_POST['padrao_questao19c'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao19d', '".converte($_POST['padrao_questao19d'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao19e', '".converte($_POST['padrao_questao19e'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao19f', '".converte($_POST['padrao_questao19f'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao19g', '".converte($_POST['padrao_questao19g'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao19h', '".converte($_POST['padrao_questao19h'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao19_especifique', '".converte($_POST['padrao_questao19_especifique'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao20', '".converte($_POST['padrao_questao20'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao21a', '".converte($_POST['padrao_questao21a'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao21b', '".converte($_POST['padrao_questao21b'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao21c', '".converte($_POST['padrao_questao21c'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao21d', '".converte($_POST['padrao_questao21d'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao21e', '".converte($_POST['padrao_questao21e'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao21f', '".converte($_POST['padrao_questao21f'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao21g', '".converte($_POST['padrao_questao21g'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao21h', '".converte($_POST['padrao_questao21h'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao21i', '".converte($_POST['padrao_questao21i'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao21j', '".converte($_POST['padrao_questao21j'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao21k', '".converte($_POST['padrao_questao21k'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao21l', '".converte($_POST['padrao_questao21l'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao21_justificativa', '".converte($_POST['padrao_questao21_justificativa'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao22a', '".converte($_POST['padrao_questao22a'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao22b', '".converte($_POST['padrao_questao22b'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao22c', '".converte($_POST['padrao_questao22c'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao22d', '".converte($_POST['padrao_questao22d'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao22e', '".converte($_POST['padrao_questao22e'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao22f', '".converte($_POST['padrao_questao22f'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao22g', '".converte($_POST['padrao_questao22g'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao22h', '".converte($_POST['padrao_questao22h'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao22_especifique', '".converte($_POST['padrao_questao22_especifique'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao23a', '".converte($_POST['padrao_questao23a'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao23b', '".converte($_POST['padrao_questao23b'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao23c', '".converte($_POST['padrao_questao23c'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao23d', '".converte($_POST['padrao_questao23d'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao23e', '".converte($_POST['padrao_questao23e'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao23f', '".converte($_POST['padrao_questao23f'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao23g', '".converte($_POST['padrao_questao23g'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao23h', '".converte($_POST['padrao_questao23h'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao23i', '".converte($_POST['padrao_questao23i'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao23_justificativa', '".converte($_POST['padrao_questao23_justificativa'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao24a', '".converte($_POST['padrao_questao24a'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao24b', '".converte($_POST['padrao_questao24b'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao24c', '".converte($_POST['padrao_questao24c'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao24d', '".converte($_POST['padrao_questao24d'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao24e', '".converte($_POST['padrao_questao24e'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao24_justificativa', '".converte($_POST['padrao_questao24_justificativa'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao25a', '".converte($_POST['padrao_questao25a'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao25b', '".converte($_POST['padrao_questao25b'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao25c', '".converte($_POST['padrao_questao25c'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao25d', '".converte($_POST['padrao_questao25d'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao25e', '".converte($_POST['padrao_questao25e'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao25_justificativa', '".converte($_POST['padrao_questao25_justificativa'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao26a', '".converte($_POST['padrao_questao26a'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao26b', '".converte($_POST['padrao_questao26b'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao26c', '".converte($_POST['padrao_questao26c'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao26d', '".converte($_POST['padrao_questao26d'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao26e', '".converte($_POST['padrao_questao26e'])."'); ";
    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao26_justificativa', '".converte($_POST['padrao_questao26_justificativa'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao27', '".converte($_POST['padrao_questao27'])."'); ";

    $insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .$empresaAlterada. ", '" . $chaveAlterada . "', 'padrao_questao28', '".converte($_POST['padrao_questao28'])."'); ";

}