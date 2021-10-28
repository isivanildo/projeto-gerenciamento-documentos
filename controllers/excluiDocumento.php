<?php
spl_autoload_register(function($nomeClasse){
    require_once("..\app".DIRECTORY_SEPARATOR.$nomeClasse.".php");
});

$excluiBanco = new Delete();

$PegaId = $_POST['idLocal'];

$excluiBanco->ExeDelete('documentos', "where id = :f", "f={$PegaId}");
if (!$lerbanco->getResult()):
	echo '<script type="text/javascript">alert("Ocorreu um erro ao localizar endereço!")</script>';
else:
	foreach($excluiBanco->getResult() as $i):
		extract($i);
	endforeach;

$LocalEmjason = array();
$LocalEmArray['id'] = $id;
$LocalEmArray['nomeArquivo'] = $nome_arquivo;
$LocalEmArray['tipoAtividade'] = $tipo_atividade;
$LocalEmArray['qtdeHoras'] = $qtde_horas;
$LocalEmArray['statusDoc'] = $status_doc;

echo(json_encode($LocalEmArray));
 
endif;