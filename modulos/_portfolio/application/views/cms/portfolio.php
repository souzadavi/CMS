<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php include('includes/includeHeader.php'); ?>
	</head>
    <body>
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
            <!-- TITULO PAGINA -->
            <div id="topo_conteudo">
              <div id="titulo_admin">Portfólio</div>
            </div>
            <!-- FIM TITULO PAGINA -->
            <table width="100%" border="0" cellspacing="3" cellpadding="5"  id="listagem" style="margin-top:15px;">
            	<tr>
                	<td style="padding-left:20px"><a href="portfolio/" title="Listar todos trabalhos">Todas Categorias</a> | <?php foreach($categorias->result() as $categoria){ ?><a href="portfolio/categoria/<?php echo $categoria->id;  ?>" title="Listar os trabalhos da categoria <?php echo $categoria->nome;  ?>"><?php echo $categoria->nome;  ?></a>&nbsp;&nbsp;<a href="portfolio/categoriaEditar/<?php echo $categoria->id;  ?>"><img src="img/editar.jpg" height="9" width="9" alt="Editar Categoria" title="Editar Categoria" /></a>&nbsp; | <?php } ?></td>
                </tr>
            </table>
            
            <!-- TITULO PAGINA -->
            <div id="topo_conteudo" style="margin-top:35px;">
              <div id="titulo_admin" class="titulo_admin">Portfólio Trabalhos - <?php if($categoriaId){ ?><a href="portfolio/categoriaEditar/<?php echo $categoriaId;  ?>"> <?php echo $categoriaNome; ?> <img src="img/editar.jpg" height="9" width="9" alt="Editar Categoria" title="Editar Categoria" /></a><?php }else{ ?><?php echo $categoriaNome; ?><?php } ?></div>
            </div>
            <!-- FIM TITULO PAGINA -->
            
            <table width="100%" border="0" cellspacing="3" cellpadding="5" id="listagem" style="margin-top:10px;">
              <?php foreach($portfolios->result() as $portfolio){ ?>
              <tr>
                <td width="47" style="padding-left:20px">
                  <?php if($portfolio->status){ ?><a href="portfolio/status/<?php echo $portfolio->id; ?>/1" title="Desativar"><img src="img/publicado.png" alt="" width="16" height="16" /></a><?php }else{ ?><a href="portfolio/status/<?php echo $portfolio->id; ?>/0" title="Ativar"><img src="img/nao_publicado.png" alt="" width="16" height="16" /></a><?php } ?>
                </td>
                <td width="897"><a href="usuario/detalhes/"><?php echo $portfolio->titulo; ?></a></td>
                <td width="371" align="right">Publicado em: <?php echo $portfolio->publicacao; ?> <br />
                Inserido em: <?php echo $portfolio->data_add; ?></td>
                <td width="164" align="right"><a href="portfolio/alterar/" class="botao_normal botao">Alterar</a></td>
              </tr>
              <?php } ?>
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