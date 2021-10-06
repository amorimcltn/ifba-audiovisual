<?php   
  session_start(); 
  if(!isset ($_SESSION['nome'])) { 
    unset($_SESSION['idusuario']); 
    unset($_SESSION['nome']);
        unset($_SESSION['tipo_usuario']); 
    header("location: index.html"); 
  } 
    $usuario = $_SESSION['nome'];
        $tipo_usuario = $_SESSION['tipo_usuario'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.ico" />
</head>

<body onload="FiltraEquipamentos()">
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
                  <h4 class="card-title">Dashboard</h4>
                  <p class="card-description">
                    Equipamentos
                  </p>
                  <form class="form-inline" method="none" onkeypress="return event.keyCode != 13;">
                    <div class="form-group mx-sm-3">
                      <input class="form-control search-field" type="text" id="cpf" placeholder="Pesquisar">
                    </div>                    
                      <button id="bt_pesquisar" class="btn btn-success" onclick="pesquisa()" type="button">Buscar</button>
                  </form>
                  <br>                   
                  <form name="radioFiltro">
                    <label class="radio-inline">
                      <input type="radio" name="optradio" class="optradio" onClick="FiltraEquipamentos()" value="2" checked>Todos
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="optradio" class="optradio" onClick="FiltraEquipamentos()" value="1">Disponiveis
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="optradio" class="optradio" onClick="FiltraEquipamentos()" value="0">Indisponiveis
                    </label>
                  </form>                   

                  <div id="list-equipamentos"></div> 
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
            var userGlobalId;
            function FiltraEquipamentos(){ 
                ListarEquipamentos($('.optradio:checked').val());    
            }
                                  
            
            function ListarEquipamentos(filtro){
                var dados = {'filtro': filtro};
                jQuery.ajax({
                    type: "POST",
                    url: "lista_locacao_equip.php",
                    data: dados,
                    success: function( data )       
                    {  
                        var resultado = jQuery.parseJSON(data);
                        var flagButton, flagBgColor, flagStatus = "";                        
                        var contentTable = '<table class="table">'
                          +'<thead class="thead-light">'
                            +'<tr>'
                              +'<th scope="col">ID</th>'
                              +'<th scope="col">Equipamento</th>'
                              +'<th scope="col">Situação</th>'
                              +'<th scope="col">Responsável</th>'    
                              +'<th scope="col">Data</th>'
                              +'<th scope="col"></th>'        
                            +'</tr>'
                          +'</thead>'
                          +'<tbody>';
                        
                        $.each(resultado, function(i, item) {                            
                            if (resultado[i].dataLocacao == "") {
                                flagButton = '<button type="button" onclick=ReservaDevolucao("'+resultado[i].idEquipamento+'") class="btn btn-success btn-sm btn-block btreserva" value="'+resultado[i].idEquipamento+'">Reservar</button>';
                                flagBgColor = 'class="bg-success" style="color: #fff;"';
                                flagStatus = '<span class="label label-success">Disponivel</span>';
                            } else {
                                flagButton = '<button type="button" onclick=ReservaDevolucao("'+resultado[i].idEquipamento+'") class="btn btn-danger btn-sm btn-block btreserva" value="'+resultado[i].idEquipamento+'">Devolver</button>';
                                if (resultado[i].idResponsavelLocacao != userGlobalId){
                                    flagButton = '<button type="button" class="btn btn-danger btn-sm btn-block btreserva" value="'+resultado[i].idEquipamento+'" disabled>Devolver</button>';
                                }
                                flagBgColor = 'class="bg-danger" style="color: #fff;"';
                                flagStatus = '<span class="label label-danger">Indisponivel</span>';
                            }
                            contentTable +=
                            '<tr '+flagBgColor+'>'
                            +'<th scope="row">'+resultado[i].idEquipamento+'</th>'
                            +'<td>'+resultado[i].nomeEquipamento+'</td>'
                            +'<td>'+flagStatus+'</td>'
                            +'<td>'+resultado[i].responsavelLocacao+'</td>'    
                            +'<td>'+resultado[i].dataLocacao+'</td>'
                            +'<td align="right">'+flagButton+'</td>'    
                            +'</tr>';
                            
                        });
                        contentTable += '</tbody></table>';
                        $('#list-equipamentos').html(contentTable);
                    }
                });
            };        
        
            function ReservaDevolucao(codtag){
                var dados = {'idusuario': userGlobalId,'codtag': codtag};
                jQuery.ajax({
                    type: "POST",
                    url: "reserva_devolucao.php",
                    data: dados,
                    success: function( data )       
                    {
                        ListarEquipamentos(2); //Busca por todos equipamentos apos devolucao/reserva
                    }
                });
            }
        
            function getSessionUser(){
                jQuery.ajax({
                    type: "POST",
                    url: "sessao_usuario.php",
                    data: null,
                    success: function( data )       
                    {
                        userGlobalId = data;
                    }
                });
            }        
            
            getSessionUser();

    </script>  
</body>

</html>
