<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php include('includes/includeHeader.php'); ?>
	</head>
    <body>
    <div id="mensagem"></div>
	
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
            <div id="tit_menu_lateral">Banner</div>
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
              <div id="titulo_admin">Banner</div>
            </div>
            <!-- FIM TITULO PAGINA -->
            <table width="100%" border="0" cellspacing="3" cellpadding="5"  id="listagem" style="margin-top:15px;">
            	<tr>
                	<td style="padding-left:20px"><a href="banner/" title="Listar todos os banners">Todas Categorias</a> | <?php foreach($categorias->result() as $categoria){ ?><a href="banner/categoria/<?php echo $categoria->id;  ?>" title="Listar os banners da categoria <?php echo $categoria->nome;  ?>"><?php echo $categoria->nome;  ?></a>&nbsp;&nbsp;| <?php } ?></td>
                </tr>
            </table>
            
            <!-- TITULO PAGINA -->
            <div id="topo_conteudo" style="margin-top:35px;">
              <div id="titulo_admin" class="titulo_admin">Banners Lista - <?php if($categoriaId){ ?> <?php echo $categoriaNome; ?><?php }else{ ?><?php echo $categoriaNome; ?><?php } ?></div>
            </div>
            <!-- FIM TITULO PAGINA -->

            <table width="100%" border="0" cellspacing="3" cellpadding="5" id="listagem">
              <?php foreach($banners->result() as $banner){ ?>
              <tr>
                <td width="68" style="padding-left:20px">
                  <?php if($banner->status){ ?><a href="banner/status/<?php echo $banner->id; ?>/1" title="Desativar"><img src="img/publicado.png" alt="" width="16" height="16" /></a><?php }else{ ?><a href="banner/status/<?php echo $banner->id; ?>/0" title="Ativar"><img src="img/nao_publicado.png" alt="" width="16" height="16" /></a><?php } ?>
               </td>
                <td width="733"><a href="banner/detalhes/<?php echo $banner->id; ?>" title="Editar Banner"><?php echo $banner->titulo; ?></a></td>
                <td width="349"><?php echo $banner->nome; ?></td>
                <td width="329" align="right"><a href="banner/detalhes/<?php echo $banner->id; ?>" class="botao_normal botao">Alterar</a></td>
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