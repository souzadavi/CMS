<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php include('includes/includeHeader.php'); ?>
	</head>
    <body>
    <?php include('includes/topoAdmin.php'); ?>
	
    <!-- INICIO BASE_ADMIN -->
	<div id="base_admin">
      <?php //include('includes/topo_admin.php'); ?>
      <?php include('includes/menu_admin.php'); ?>

      <!-- INICIO CORPO -->
      <div id="corpo">
      
        <!-- INICIO MIOLO CORPO -->
        <div id="miolo_corpo"> 
          
          <!-- MENU ESQUERDA -->
          <div id="menu_lateral">
            <div id="tit_menu_lateral">Usuários</div>
            <ul id="menu_lista" class="lista_menu">
              <?php foreach($menus as $menu){ ?>
              <li class="item_menu"><a href="<?php echo $menu->url; ?>"><?php echo $menu->nome; ?></a></li>
              <?php } ?>
            </ul>
          </div>
          <!-- FIM MENU ESQUERDA --> 
          
          <!-- INICIO CONTEUDO_CORPO -->
          <div id="conteudo_corpo">
            <!-- TITULO PAGINA -->
            <div id="topo_conteudo">
              <div id="titulo_admin">Usuários Cadastrados</div>
            </div>
            <!-- FIM TITULO PAGINA -->

            <table width="100%" border="0" cellspacing="3" cellpadding="5" id="listagem">
              <tr>
                <td width="32" style="padding-left:20px">
                  <a href="usuario/status/0" title="Desativar"><img src="img/publicado.png" alt="" width="16" height="16" /></a>
                </td>
                <td width="130"><a href="usuario/detalhes/"></a></td>
                <td width="270"> - IP: </td>
                <td width="180"></td>
                <td><a href="usuario/permissao/" class="botao_normal botao">Alterar</a></td>
              </tr>
            </table>
          </div>
          <!-- FIM CONTEUDO_CORPO -->
          
        </div>
        <!-- FIM MIOLO CORPO -->
        
      </div>
      <!-- FIM CORPO -->
      <?php include('includes/rodape_admin.php'); ?>
</div>
<!-- INICIO BASE_ADMIN -->
</body>
</html>