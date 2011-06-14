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
              <div id="titulo_admin">Jogadores Cadastrados</div>
            </div>
            <!-- FIM TITULO PAGINA -->
            <p class="observacao">Gerenciar Jogadores Cadastrados ou Cadastrar um novo jogador.</p>

            <table width="850" border="0" cellpadding="5" cellspacing="3" id="listagem">
              <tr>
              	<th>Nome</th>
                <th>Código Cliente</th>
              </tr>
			  <?php foreach($jogadores->result() as $jogador){ ?>
              <tr>
                <td width="282" style="padding-left:20px">
                   <a href="poker/jogadorDetalhes/<?php echo $jogador->id; ?>"><?php echo $jogador->nome; ?></a>
                </td>
                <td width="539"><?php echo $jogador->codigo; ?></td>
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