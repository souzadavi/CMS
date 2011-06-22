<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php include('includes/includeHeader.php'); ?>
    <script type="text/javascript" src="js/jquery.jeditable.mini.js"></script>
    <script type="text/javascript" >
	 $(document).ready(function() {
		 //$('.categoria').editable('<?php echo base_url(). base_cms(); ?>/produto/atualizarCategoria');
		 $(".categoria").editable('<?php echo base_url(). base_cms(); ?>/produto/atualizarCategoria', { 
			  indicator : "Salvando",
			  //loadurl   : "http://www.appelsiini.net/projects/jeditable/php/load.php",
			  //type      : "textarea",
			  //submit    : "OK",
			  //cancel    : "Cancel",
			  style  : "inherit",
			  tooltip   : "Clique para editar."
		  });
	 });
	</script>
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
            <div id="tit_menu_lateral">Produto</div>
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
              <div id="titulo_admin">Produtos Cadastrados</div>
            </div>
            <!-- FIM TITULO PAGINA -->
            <p class="observacao">Para editar o produto clique no nome do produto.</p>

            <table border="0" cellpadding="5" cellspacing="3" id="listagem">
              <?php foreach($produtos->result() as $produto){ ?>
              <tr>
                <td width="35" style="padding-left:20px">
                   <?php if($produto->status){ ?><a href="produto/status/<?php echo $produto->id; ?>/1" title="Desativar"><img src="img/publicado.png" alt="" width="16" height="16" /></a><?php }else{ ?><a href="produto/status/<?php echo $produto->id; ?>/0" title="Ativar"><img src="img/nao_publicado.png" alt="" width="16" height="16" /></a><?php } ?>
                </td>
                <td width="786"><a href="produto/detalhes/<?php echo $produto->id; ?>"><?php echo $produto->nome; ?></a></td>
              </tr>
              <?php } ?>
            </table>
            
            <!-- TITULO PAGINA -->
            <div id="topo_conteudo" style="margin-top:30px;">
              <div id="titulo_admin" class="titulo_admin">Categorias Cadastradas</div>
            </div>
            <!-- FIM TITULO PAGINA -->
            <table border="0" cellpadding="5" cellspacing="3" id="listagem">
              <?php foreach($categorias->result() as $categoria){ ?>
              <tr>
                <td width="615" style="padding-left:20px"><div class="categoria" id="<?php echo $categoria->id; ?>" style="width:200px;"><?php echo $categoria->nome; ?> </div></td>
                <td width="206" align="right"><a href="produto/categoria/<?php echo $categoria->id; ?>" title="Listar Produtos"><img src="img/lupa.jpg" width="18" height="24" alt="Listar Produtos" title="Listar Produtos" /></a></td>
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