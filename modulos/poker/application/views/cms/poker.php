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
            <div id="tit_menu_lateral">Poker</div>
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
              <div id="titulo_admin">Torneios Cadastrados</div>
            </div>
            <!-- FIM TITULO PAGINA -->
            <p class="observacao">Gerencie um dos torneios de Poker clicando em um dos nomes abaixo.</p>

            <table width="850" border="0" cellpadding="5" cellspacing="3" id="listagem">
              <?php foreach($torneios->result() as $torneio){ ?>
              <tr>
                <td width="35" style="padding-left:20px">
                   <?php if($torneio->status){ ?><a href="poker/status/<?php echo $torneio->id; ?>/1" title="Desativar"><img src="img/publicado.png" alt="" width="16" height="16" /></a><?php }else{ ?><a href="poker/status/<?php echo $torneio->id; ?>/0" title="Ativar"><img src="img/nao_publicado.png" alt="" width="16" height="16" /></a><?php } ?>
                </td>
                <td width="786"><a href="poker/detalhes/<?php echo $torneio->id; ?>"><?php echo $torneio->nome; ?></a> - <a href="<?php echo base_url(); ?>poker/index/<?php echo $torneio->id; ?>" target="_blank">ranking</a></td>
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