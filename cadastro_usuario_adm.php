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
  <title>Cadastro - Usuário</title>
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

<body>
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
                  <h4 class="card-title">Usuário</h4>
                  <p class="card-description">
                    Cadastrar usuário
                  </p>
                     <form class="form-horizontal" method="post" id="salvar_usuario" name="salvar_usuario">
                    <fieldset>


                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-1 control-label" for="nome">Nome</label>  
                      <div class="col-md-5">
                        <input id="nome" name="nome" type="text" placeholder="Insira o nome do usuário" class="form-control input-md" required="">    
                      </div>
                    </div>
                    <div class="form-group">
                    <label class="col-md-3 control-label" for="tipo_usuario">Tipo de usuário</label>        
                        <div class="col-md-4">              
                            <select id="tipo_usuario" name="tipo_usuario" class="form-control" required="" data-style="btn-info" class="selectpicker show-tick">
                              <option value="1">Professor</option>
                              <option value="2">Coordenador</option>
                              <option value="3">Aluno</option>
                              <option value="4">Outros</option>
                              <option value="5">Administrador</option>
                            </select>         
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-1 control-label" for="login">Email</label>  
                      <div class="col-md-5">
                        <input id="login" name="login" type="text" placeholder="Insira o email" class="form-control input-md" required="">    
                      </div>
                    </div>      
                    <div class="form-group">
                      <label class="col-md-1 control-label" for="password">Senha</label>  
                      <div class="col-md-3">
                        <input type="password" id="password" name="password" class="form-control" data-toggle="password">    
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-1 control-label"></label>
                      <div class="col-md-3">
                          <div name="save_result" id="save_result"></div><br>
                          <input type="submit" id="btsalvar_usuario" value="Gravar" name="btsalvar_usuario" class="btn btn-success pull-center"/>
                      </div>
                    </div>
                    </fieldset>
                    </form>  
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
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
    <script type="application/javascript">
            $("#senha").password('toggle');         

            jQuery(document).ready(function(){        
                jQuery('#salvar_usuario').submit(function(){      
                    $("#btsalvar_usuario").prop("disabled", true);          
                    var dados = jQuery( this ).serialize();     
                    jQuery.ajax({
                        type: "POST",
                        url: "insere_usuario.php",
                        data: dados,
                        success: function( data )       
                        {                                       
                            $("#btsalvar_usuario").prop("disabled", false);       
                            if (data > 0){
                                $("#btsalvar_usuario").prop("disabled", false);
                                var html1 = "<div><div class=\"col-lg-12\"><div class=\"alert alert-info alert-dismissable\" style=\"color:#0C0;\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><i class=\"fa fa-info-circle\"></i>  <strong>Dados gravados com sucesso!</strong></div></div></div>";                      
                                $('#save_result').append(html1);
                                document.getElementById("salvar_usuario").reset();            
                            } else {                      
                                $("#btsalvar_usuario").prop("disabled", false);                     
                                var html2 = "<div><div class=\"col-lg-12\"><div class=\"alert alert-info alert-dismissable\" style=\"color:#F00;\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><i class=\"fa fa-info-circle\"></i>  <strong>Dados incorretos!</strong></div></div></div>";          
                                $('#save_result').append(html2);            
                            }         
                        }
                    });

                    return false;
                });
            }); 
    </script>  
</body>

</html>
