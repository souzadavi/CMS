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
        <div id="tit_menu_lateral">Poker Jogador</div>
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
              <div id="titulo_admin">Novo  Jogador</div>
            </div>
        <p class="observacao">Todos os campos são obrigatórios.</p>
        <!-- FIM TITULO PAGINA -->
        <form action="poker/inserirJogador" method="post" enctype="multipart/form-data">
              <table width="100%" style="margin-top:15px;" id="listagem">
            <tr>
                  <td height="63" style="padding-left:20px"><label for="nome">Nome ou Apelido do Jogador</label><br />
                <input name="nome" type="text" class="estilo_input input" id="nome" size="80" /></td>
                </tr>
            <tr>
                  <td height="63" style="padding-left:20px"><label for="codigo">Código do Cliente</label><br />
                <input name="codigo" type="text" class="estilo_input input" id="codigo" size="20" /> 
                verificar se o código não existe no banco.</td>
                </tr>
            <tr>
                  <td height="57" style="padding-left:20px"><label for="imagem">Foto ou Avatar do Jogador</label><br />
                <input name="imagem" type="file" class="estilo_input input" id="imagem" /></td>
                </tr>
            <tr>
              <td height="64" style="padding-left:20px"><input type="submit" class="botao_normal botao" name="botao4" id="botao4" value="Inserir novo Jogador" /></td>
            </tr>
          </table>
            </form>
        <?php } ?>
        <?php if($modo =="editar"){ ?>
        <!-- TITULO PAGINA -->
        <div id="topo_conteudo">
              <div id="titulo_admin">Editar  Jogador <?php echo $jogador->nome; ?></div>
            </div>
        <p class="observacao">Todos os campos são obrigatórios.</p>
        <!-- FIM TITULO PAGINA -->
        <form action="poker/jogadorAlterar/<?php echo $jogador->id; ?>" method="post" enctype="multipart/form-data">
              <table width="100%" style="margin-top:15px;" id="listagem">
            <tr>
                  <td height="63" style="padding-left:20px"><label for="nome">Nome ou Apelido do Jogador</label><br />
                <input name="nome" type="text" class="estilo_input input" id="nome" size="80" value="<?php echo $jogador->nome; ?>" /></td>
                </tr>
            <tr>
                  <td height="63" style="padding-left:20px"><label for="codigo">Código do Cliente</label><br />
                <input name="codigo" type="text" class="estilo_input input" id="codigo" size="20" value="<?php echo $jogador->codigo; ?>" readonly="readonly" /> 
                verificar se o código não existe no banco.</td>
                </tr>
            <tr>
                  <td height="57" style="padding-left:20px"><?php if($jogador->foto){ ?><img src="<?php echo base_url(); ?>upload/thumb.php?w=200&img=poker/<?php echo $jogador->foto; ?>" /><?php } ?><br />
                  <label for="imagem">Foto ou Avatar do Jogador</label><br />
                <input name="imagem" type="file" class="estilo_input input" id="imagem" />
                
                </td>
                </tr>
            <tr>
              <td height="64" style="padding-left:20px"><input type="submit" class="botao_normal botao" name="botao4" id="botao4" value="Atualizar Jogador" /></td>
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