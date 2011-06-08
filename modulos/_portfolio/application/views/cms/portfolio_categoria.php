<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php include('includes/includeHeader.php'); ?>
	</head>
    <body>
    <?php //include('includes/topoAdmin.php'); ?>
	
    <!-- INICIO BASE_ADMIN -->
	<div id="base_admin">
      <?php include('includes/topo_admin.php'); ?>
      <?php include('includes/menu_admin.php'); ?>

      <!-- INICIO CORPO -->
      <div id="corpo">
      
        <!-- INICIO MIOLO CORPO -->
        <div id="miolo_corpo"> 
          
          <!-- MENU ESQUERDA -->
          <div id="menu_lateral">
            <div id="tit_menu_lateral">Portfólio</div>
            <ul id="menu_lista" class="lista_menu">
              <?php foreach($menus as $menu){ ?>
              <li class="item_menu"><a href="<?php echo $menu->url; ?>"><?php echo $menu->nome; ?></a></li>
              <?php } ?>
            </ul>
          </div>
          <!-- FIM MENU ESQUERDA --> 
          
          <!-- INICIO CONTEUDO_CORPO -->
          <div id="conteudo_corpo">
            <?php if($modo =="novo"){ ?>
            <!-- TITULO PAGINA -->
            <div id="topo_conteudo">
              <div id="titulo_admin">Nova Categoria - Portfólio</div>
            </div>
            <!-- FIM TITULO PAGINA -->
            <form action="portfolio/categoriaNova" method="post">
            <table width="100%" border="0" cellspacing="3" cellpadding="5">
            	<tr>
                	<td width="9%" style="padding-left:20px"><label for="nome">Nome categoria:</label></td>
                </tr>
            	<tr>
            	  <td height="60" style="padding-left:20px"><input type="text" class="estilo_input input" name="nome" id="nome" /></td>
          	  </tr>
            	<tr>
            	  <td style="padding-left:20px"><input type="submit" class="botao_normal botao" name="botao" id="botao" value="Cadastrar nova categoria" /></td>
          	  </tr>
              </table>
            </form>
            <?php } ?>
            <?php if($modo =="editar"){ ?>
            <!-- TITULO PAGINA -->
            <div id="topo_conteudo">
              <div id="titulo_admin">Editar Categoria - <?php echo $categoriaNome; ?></div>
            </div>
            <!-- FIM TITULO PAGINA -->
            <form action="portfolio/categoriaEditar/<?php echo $categoriaId; ?>" method="post">
            <table width="100%" border="0" cellspacing="3" cellpadding="5">
            	<tr>
                	<td width="9%" style="padding-left:20px"><label for="nome">Nome categoria:</label></td>
                </tr>
            	<tr>
            	  <td height="60" style="padding-left:20px"><input type="text" class="estilo_input input" name="nome" id="nome" value="<?php echo $categoriaNome; ?>" /></td>
          	  </tr>
            	<tr>
            	  <td style="padding-left:20px"><input type="submit" class="botao_normal botao" name="botao" id="botao" value="Alterar categoria" /></td>
          	  </tr>
              </table>
            </form>
            <?php } ?>
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