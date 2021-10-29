<?php
spl_autoload_register(function($nomeClasse){
require_once("app".DIRECTORY_SEPARATOR.$nomeClasse.".php");
});

$conn = new Read();
$lerBanco = new Read();
$lerUsuario = new Read();

if (!$conn->getResult()){
  $conn->FullRead("SELECT doc.*, st.status FROM documentos doc INNER JOIN status_doc st on 
  doc.status_doc = st.id");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Usuários - Documentos</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
  <script src="scripts/jQuery.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">Grupo Tiradentes</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Grupo Tiradentes</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->

            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="dist/img/avatar5.png" class="img-circle" alt="User Image">

                <p>
                  Fulano Junior - Web Developer
                  <small>Membro desde Abr. 2018</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sair</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>
            <?php
            $lerUsuario->ExeRead("usuario");
            foreach ($lerUsuario->getResult() as $i):
              extract($i);
              $idUsuario = $id;
              echo $usuario;
            endforeach;
            ?>
          </p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="#"><i class="fa fa-users"></i> <span>Documentos</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Documentos
        <small>Gerenciamento de documentos</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Usuários</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <div class="row">
        <div class="col-md-8">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Lista de Documentos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table id="tabelaDados" class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">ID</th>
                    <th style="width: 10px">Doc.</th>
                    <th>Nome Arq.</th>
                    <th>Tipo Ativ.</th>
                    <th>Qtde Hora</th>
                    <th>Status</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                <?php     
                if ($conn->getResult() != null):
                  foreach ($conn->getResult() as $i):
                    extract($i); ?>
                <tr>
                <td><?=$id?></td>
                <td><img src="<?=$arquivo?>" alt="User Image" class="img-circle img-sm"></td>
                <td><?=$nome_arquivo?></td>
                <td><?=$tipo_atividade?></td>
                <td class="qtdeValor"><?=$qtde_horas?></td>
                <td><?=$status?></td>
                <td>
                <button type="button" class="btn btn-primary btn-xs btn-flat editaDados">Editar</button>
                <button type="button" class="btn btn-danger btn-xs btn-flat excluiDados">Excluir</button>
                </td>
                </tr>
                 <?php   
                  endforeach;
                endif;
                ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

        </div>
        <div class="col-md-4">

        <div class="row">
          
          <!-- ./col -->
          <div class="col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3 class="somar"></h3>
        
                <p>Horas</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php 
                        if($conn->getResult()): 
                         echo $conn->getRowCount();
                        else:
                          echo "0";
                        endif;
                        ?>
                </h3>       
                <p>Documentos</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>

          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Novo Documento</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="getDadosDocumentos" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputName">Nome do Arquivo</label>
                  <input type="text" class="form-control" id="nomeArquivo" placeholder="Digite o nome do arquivo" name="nome_arquivo">
                </div>
                <div class="form-group">
                  <label for="exampleInputName">Tipo de Atividade</label>
                  <input type="text" class="form-control" id="tipoAtividade" placeholder="Digite o tipo de atividade" name="tipo_atividade">
                </div>
                <div class="form-group">
                  <label for="exampleInputName">Quantidade de Horas</label>
                  <input type="text" class="form-control" id="qtdeHoras" placeholder="Digite a quantidade de horas" name="qtde_horas">
                </div>

                <div class="form-group">
                  <label for="statusDoc">Status Documento</label>
                  <select class="form-control" id="statusDoc" name="status_doc">
                    <option value="" selected="selected">Selecione o status</option>   
                    <?php	
											$lerBanco->ExeRead('status_doc');
											if($lerBanco->getResult()):
												foreach ($lerBanco->getResult() as $getStatus):
													extract($getStatus);
										?>
													<option value="<?=$id;?>"><?=$status;?></option>
                          
										<?php
												endforeach;
											endif;

										?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="arquivo">Arquivo</label>
                  <input type="file" id="arquivo" name="arquivo">
                </div>
                <input type="hidden" class="form-control" id="idDocumento" name="id">
                <input type="hidden" class="form-control" id="idUsuario" name="usuario" value="<?=$idUsuario?>">
              </div>
              <!-- /.box-body -->          
              <div class="box-footer">
                <button type="submit" class="btn btn-success">Salvar</button>
              </div>
            </form>
          </div>

        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<div id="resultadoEnviarPedido"></div>
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      <a target="_blank" href="#">Grupo Tiradentes</a>
    </div>
    <!-- Default to the left -->
    Projeto desenvolvido por Ivanildo Ferreira.
  </footer>
</div>
<script>
      $(document).ready(function(){			
        //Retorna a coluna da linha selecionada através do botão editar		
          $(".editaDados").click(function() {
            var $row = $(this).closest("tr"),
            $tds = $row.find("td:nth-child(1)");
            var idDoLocal;
            $.each($tds, function() {
              idDoLocal = $(this).text();
            });   
						$.ajax({
							url: 'controllers/processaDocumento.php',
							method: "post",	
							dataType: 'json',
							data: {'idLocal' : idDoLocal},
							
							success: function(data) {
                //Atualiza os campos com os valores da consulta.
                $("#idDocumento").val(data.id);
                $("#nomeArquivo").val(data.nomeArquivo);
                $("#tipoAtividade").val(data.tipoAtividade);
                $("#qtdeHoras").val(data.qtdeHoras);
                $("#statusDoc").val(data.statusDoc);
							}
						})

          });

          //Excluir dados	
          $(".excluiDados").click(function() {
            var $row = $(this).closest("tr"),
            $tds = $row.find("td:nth-child(1)");
            var idDoLocal;
            $.each($tds, function() {
              idDoLocal = $(this).text();
            });   
						$.ajax({
							url: 'controllers/excluiDocumento.php',
							method: "post",	
							dataType: 'json',
							data: {'idLocal' : idDoLocal},
							
							success: function(data) {
                //Atualiza os campos com os valores da consulta.

							}
						})

          });

          //Envia os dados do formulário para processamento
          $("#getDadosDocumentos").submit(function(event) {
            event.preventDefault();

            var formData = new FormData(this);
            $.ajax({
              url: 'controllers/addDocumento.php',
              type: 'POST',
              data: formData,
            success: function(data) {
              alert(data)
              },
            cache: false,
            contentType: false,
            processData: false,
            xhr: function() { 
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { 
                    myXhr.upload.addEventListener('progress', function() {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
                return myXhr;
            }
            });
          });

          //Função que cálcula o número de horas das atividades cirriculares
          $(function(){
            var valorCalculado = 0;
            $( ".qtdeValor" ).each(function() {
              valorCalculado += parseFloat($( this ).text());
            });
            $( ".somar" ).text(valorCalculado);

            });
				});
          
</script>
</body>
</html>