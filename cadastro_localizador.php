<?php   
  session_start(); 
  if(!isset ($_SESSION['nome'])) { 
    unset($_SESSION['idusuario']); 
    unset($_SESSION['nome']);
        unset($_SESSION['tipo_usuario']); 
    header("location: index.html"); 
  } 
    $usuario = $_SESSION['nome'];
    $idusuario = $_SESSION['idusuario'];
    $tipo_usuario = $_SESSION['tipo_usuario'];       
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Cadastro - Localizador</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link href="css/custom-checkbox.css" rel="stylesheet"> 
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.ico" />
</head>

<body onLoad="FiltraLocalizadores()">
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index.html"><img src="images/logo.svg" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <div class="search-field d-none d-md-block">
        </div>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <div class="nav-profile-text">
                <p class="mb-1 text-black"><?php echo $usuario ?></p>
              </div>
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="logout.php">
                <i class="mdi mdi-logout mr-2 text-primary"></i>
                Sair
              </a>
            </div>
          </li>
          <li class="nav-item d-none d-lg-block full-screen-link">
            <a class="nav-link">
              <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
            </a>
          </li>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
              <span class="menu-title">Dashboard</span>
              <i class="mdi mdi-home menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="info_localizador.php">
              <span class="menu-title">Informações</span>
              <i class="mdi mdi-chart-bar menu-icon"></i>
            </a>
          </li>
            <?php
                if ($tipo_usuario == 5){
                    echo '<li class="nav-item">
                              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                                <span class="menu-title">Cadastrar</span>
                                <i class="menu-arrow"></i>
                                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                              </a>
                              <div class="collapse" id="ui-basic">
                                  <ul class="nav flex-column sub-menu">
                                      <li class="nav-item"> <a class="nav-link" href="cadastro_usuario_adm.php">Usuário</a></li>
                                      <li class="nav-item"> <a class="nav-link" href="exibe_tag_cadastro.php">Equipamento</a></li>
                                      <li class="nav-item"> <a class="nav-link" href="cadastro_localizador.php">Localizador</a></li>
                                  </ul>
                              </div>
                          </li>';
                } 
            ?>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Localizador</h4>
                  <p class="card-description">
                    <i class="fa fa fa-search"></i> Cadastrar localizador
                  </p>
                    <form class="form-inline" method="post" id="salvar_localizador" name="salvar_localizador">
                      <!-- Text input-->
                      <div class="form-group mx-sm-3">
                        <div class="col-md-1">
                          <input id="nome_local" name="nome_local" type="text" placeholder="Insira o local" class="form-control input-md" required="">    
                        </div>
                      </div>
                      <div class="form-group mx-sm-3">
                        <div class="col-md-2">
                          <input id="descricao" name="descricao" type="text" placeholder="Insira uma descrição" class="form-control input-md">    
                        </div>
                      </div>
                      <div class="form-group mx-sm-3">
                        <div class="col-md-1">
                          <input id="setor_local" name="setor_local" type="text" placeholder="Insira o Setor" class="form-control input-md">    
                        </div>
                      </div>                                    

                      <div class="form-group mx-sm-3">
                        <label class="col-md-0 control-label"></label>
                        <div class="col-md-3">                      
                            <input type="submit" id="btsalvar_localizador" value="Gravar" name="btsalvar_localizador" class="btn btn-success pull-center"/>
                        </div>
                      </div>
                  </form>
                  <br>  
                <form name="radioFiltro">
                  <label class="radio-inline">
                    <input type="radio" name="optradio" class="optradio" onClick="FiltraLocalizadores()" value="2" checked>Todos
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="optradio" class="optradio" onClick="FiltraLocalizadores()" value="1">Ativos
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="optradio" class="optradio" onClick="FiltraLocalizadores()" value="0">Inativos
                  </label>
                </form>           
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><h6>Localizadores Cadastrados</h6></div>
                
                    <!-- List group -->                
                    <ul class="list-group">
                        <div id="list-localizadores"></div>
                    </ul>
                </div>  
                </div>
              </div>
            </div> 
          </div>         
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">

          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
    <script type="application/javascript">

            jQuery(document).ready(function(){        
                jQuery('#salvar_localizador').submit(function(){      
                    $("#btsalvar_localizador").prop("disabled", true);          
                    var dados = jQuery( this ).serialize();                    
                    jQuery.ajax({
                        type: "POST",
                        url: "insere_localizador.php",
                        data: dados,
                        success: function( data )       
                        {                               
                            $("#btsalvar_localizador").prop("disabled", false);       
                            if (data > 0){
                                $("#btsalvar_localizador").prop("disabled", false);
                                var html1 = "<div><div class=\"col-lg-12\"><div class=\"alert alert-info alert-dismissable\" style=\"color:#0C0;\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><i class=\"fa fa-info-circle\"></i>  <strong>Dados gravados com sucesso!</strong></div></div></div>";                      
                                $('#save_result').append(html1);
                                document.getElementById("salvar_localizador").reset();            
                            } else {                      
                                $("#btsalvar_localizador").prop("disabled", false);                     
                                var html2 = "<div><div class=\"col-lg-12\"><div class=\"alert alert-info alert-dismissable\" style=\"color:#F00;\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><i class=\"fa fa-info-circle\"></i>  <strong>Dados incorretos!</strong></div></div></div>";          
                                $('#save_result').append(html2);            
                            }         
                        }
                    });

                    return false;
                });
            }); 
            
            
            function FiltraLocalizadores(){            
                ListarLocalizadores($('.optradio:checked').val());    
            }
              
            
            //Ao clicar no checkbox, fazer um update em ativo do localizador
            
            function ListarLocalizadores(filtro){
                var dados = {'filtro': filtro};
                jQuery.ajax({
                    type: "POST",
                    url: "lista_localizador.php",
                    data: dados,
                    success: function( data )       
                    {  
                        var resultado = jQuery.parseJSON(data);
                        var flagChecked = "";
                        $('#list-localizadores').html(null);
                        $.each(resultado, function(i, item) {
                            if (resultado[i].ativo == 1) {flagChecked = "checked"} else {flagChecked = ""}
                             $('#list-localizadores').append(
                                '<li class="list-group-item">'
                                + '<b>ID - ' + resultado[i].cod_localizador + ' LOCAL - ' + resultado[i].nome_local 
                                + '</b><div class="material-switch">'
                                    + '<a href="#"><span class="fa fa-trash-o" id="del'+resultado[i].cod_localizador+'"></span></a><span> </span><input id="switchOption'+i+'" name="switchOption" value="'+i+'" class="switchOption" type="checkbox"' + flagChecked + '/>'
                                    + '<label for="switchOption'+i+'" class="label-success"></label></div></li>'
                            );
                        });

                    }
                    
                });
                
            };
            $(document).on('click', '.switchOption', function () {
                var dados = {'filtro': filtro};
                jQuery.ajax({
                    type: "POST",
                    url: "lista_localizador.php",
                    data: dados,
                    success: function( data )       
                    {  
                        var resultado = jQuery.parseJSON(data);
                        var flagChecked = "";
                        $('#list-localizadores').html(null);
                        $.each(resultado, function(i, item) {
                            if (resultado[i].ativo == 1) {flagChecked = "checked"} else {flagChecked = ""}
                             $('#list-localizadores').append(
                                '<li class="list-group-item">'
                                + '<b>ID - ' + resultado[i].cod_localizador + ' LOCAL - ' + resultado[i].nome_local 
                                + '</b><div class="material-switch pull-right">'
                                    + '<a href="#"><span class="fa fa-trash-o" id="del'+resultado[i].cod_localizador+'"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> </span><input id="switchOption'+i+'" name="switchOption" value="'+i+'" class="switchOption" type="checkbox"' + flagChecked + '/>'
                                    + '<label for="switchOption'+i+'" class="label-success"></label></div></li>'
                            );
                        });

                    }
                    
                });
                // Ja pego o codigo do checkbox do localizador e checo que ta ativando ou nao
                // Proximo passo criar metodo de update
                console.log($(this).val());
                console.log($(this).is(':checked'));
            }); 
    </script>  
</body>

</html>
