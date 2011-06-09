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
        <?php if($modo =="novo"){ ?>
        <!-- TITULO PAGINA -->
        <div id="topo_conteudo">
          <div id="titulo_admin">Novo  Banner</div>
        </div>
        <p class="observacao">Todos os campos são obrigatórios.</p>
        <!-- FIM TITULO PAGINA -->
        <form action="banner/inserir" method="post" enctype="multipart/form-data">
          <table width="100%" style="margin-top:15px;" id="listagem">
            <tr>
              <td height="88" style="padding-left:20px"><label for="nome"><strong>Categoria:</strong></label>
                <br />
                <select name="categoria_id" id="categoria_id">
                  <?php foreach($categorias->result() as $categoria){ ?>
                  <option value="<?php echo $categoria->id; ?>" ><?php echo $categoria->nome; ?></option>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td height="88" style="padding-left:20px"><label><strong>Status do Banner</strong><br />
                  <br />
                  <input type="radio" name="status" id="status" value="1" />
                  Ativado</label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                  <input type="radio" name="status" id="status" value="0" />
                  Desativado</label></td>
            </tr>
            <tr>
              <td height="123" style="padding-left:20px"><label for="titulo"><strong>Título</strong></label>
                <br />
                <input name="titulo" type="text" class="estilo_input input" id="titulo" size="80" />
                <br />
                <br />
                Nome figurativo do banner que aparecerá na listagem.<br />
                Ex.: Campanha Agosto 2011 Seminovos.</td>
            </tr>
            <tr>
              <td height="123" style="padding-left:20px"><label for="link"><strong>Link</strong></label>
                <br />
                <input name="link" type="text" class="estilo_input input" id="link" value="http://" size="80" />
                <br />
                <br />
                Caminho de destino do banner, local aonde o usuário será redirecionado, ao clicar no Banner. <br />
                Ex.: http://www.seudominio.com/promocao </td>
            </tr>
            <tr>
              <td height="123" style="padding-left:20px"><label for="img_thumb"><strong>Imagem</strong></label>
                <br />
                <input name="imagem" type="file" class="estilo_input input" id="imagem" />
                <br />
                <br />
                Recomenda-se imagem inferior a 100Kb. <br />
                Extensões permitidas png, gif ou jpg. </td>
            </tr>
            <tr>
              <td height="123" style="padding-left:20px"><label for="img_big"><strong>Flash:</strong></label>
                <br />
                <input name="flash" type="file" class="estilo_input input" id="flash" />
                <br />
                <br />
                Sempre que inserir um banner em flash, colocar uma imagem no campo superior correspondente para que os dispositivos que não suportam flash visualizem a imagem. </td>
            </tr>
            <tr style="border:none;">
              <td height="29" align="center" style="padding-left:20px"><br />
                <br />
                <input type="submit" class="botao_normal botao" name="botao" id="botao" value="Inserir novo banner" /></td>
            </tr>
          </table>
        </form>
        <?php } ?>
        <?php if($modo =="editar"){ ?>
        <!-- TITULO PAGINA -->
        <div id="topo_conteudo">
          <div id="titulo_admin">Editar Banner - <?php echo $banner->titulo; ?></div>
        </div>
        <p class="observacao">Todos os campos são obrigatórios.</p>
        <!-- FIM TITULO PAGINA -->
        <form action="banner/alterar/<?php echo $banner->id; ?>" method="post" enctype="multipart/form-data">
          <table width="100%" style="margin-top:15px;" id="listagem">
            <tr>
              <td width="46%" height="88" style="padding-left:20px"><strong>Informações:</strong>
                <br />
                ClickTag:
                <a href="<?php echo base_url(); ?><?php echo base_cms(); ?>banner/clicktag/<?php echo $banner->id; ?>"><?php echo base_url(); ?><?php echo base_cms(); ?>banner/clicktag/<?php echo $banner->id; ?></a><br />
                Caminho do Banner (src):
                <a href="<?php echo base_url(); ?><?php echo base_cms(); ?>banner/view/<?php echo $banner->id; ?>"><?php echo base_url(); ?><?php echo base_cms(); ?>banner/view/<?php echo $banner->id; ?></a><br />
                Visualizações: <?php echo $bannerViews; ?>
                <br />
                Cliques: <?php echo $bannerCliques; ?>
                <br />
                
                </td>
            </tr>
            <tr>
              <td width="46%" height="88" style="padding-left:20px"><label for="nome"><strong>Categoria:</strong></label>
                <br />
                <select name="categoria_id" id="categoria_id">
                  <?php foreach($categorias->result() as $categoria){ ?>
                  <option value="<?php echo $categoria->id; ?>" <?php if($categoria->id == $banner->categoria_id) { ?>selected="selected"<?php } ?> ><?php echo $categoria->nome; ?></option>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td height="88" style="padding-left:20px"><label><strong>Status do Banner</strong><br />
                  <br />
                  <input type="radio" name="status" id="status" value="1" <?php if($banner->status == 1) { ?>checked="checked" <?php } ?> />
                  Ativado</label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                  <input type="radio" name="status" id="status" value="0" <?php if($banner->status == 0) { ?>checked="checked" <?php } ?> />
                  Desativado</label></td>
            </tr>
            <tr>
              <td height="123" style="padding-left:20px"><label for="titulo"><strong>Título</strong></label>
                <br />
                <input name="titulo" type="text" class="estilo_input input" id="titulo" size="80" value="<?php echo $banner->titulo; ?>" />
                <br />
                <br />
                Nome figurativo do banner que aparecerá na listagem.<br />
                Ex.: Campanha Agosto 2011 Seminovos.</td>
            </tr>
            <tr>
              <td height="123" style="padding-left:20px"><label for="link"><strong>Link</strong></label>
                <br />
                <input name="link" type="text" class="estilo_input input" id="link" value="<?php echo $banner->link; ?>" size="80" />
                <br />
                <br />
                Caminho de destino do banner, local aonde o usuário será redirecionado, ao clicar no Banner. <br />
                Ex.: http://www.seudominio.com/promocao </td>
            </tr>
            <tr>
              <td height="393" style="padding-left:20px"><a href="<?php echo base_url(); ?>upload/banner/<?php echo $banner->imagem; ?>" target="_blank">Abrir</a><br />       
                <img src="<?php echo base_url(); ?>upload/thumb.php?w=299&h=223&img=banner/<?php echo $banner->imagem; ?>" width="299" height="223" /> <br />
                <label for="img_thumb"><strong> Imagem</strong></label>
                <br />
                <input name="imagem" type="file" class="estilo_input input" id="imagem" />
                <br />
                <br />
                Recomenda-se imagem inferior a 100Kb. <br />
                Extensões permitidas png, gif ou jpg. </td>
            </tr>
            <tr>
              <td height="262" style="padding-left:20px">
              <?php if($banner->flash) { ?>
              <a href="<?php echo base_url(); ?>upload/banner/<?php echo $banner->flash; ?>" target="_blank">Abrir</a> | <a href="<?php echo base_url(); ?><?php echo base_cms(); ?>banner/deletarFlash/<?php echo $banner->id; ?>">Deletar Flash</a><br />
              <object type="application/x-shockwave-flash" data="<?php echo base_url(); ?>upload/banner/<?php echo $banner->flash; ?>" width="518" height="116">
                  <param name="movie" value="<?php echo base_url(); ?>upload/banner/<?php echo $banner->flash; ?>" />
                  <param name="wmode" value="transparent" />
                  <param name="menu" value="false" />
                </object>
                <br />
                <?php }else{ ?>Este banner não possui flash cadastrado. <br /><?php } ?>
                <label for="img_big"><strong>Flash:</strong></label>
                <br />
                <input name="flash" type="file" class="estilo_input input" id="flash" />
                <br />
                <br />
                Sempre que inserir um banner em flash, colocar uma imagem no campo superior correspondente para que os dispositivos que não suportam flash visualizem a imagem. </td>
            </tr>
            <tr style="border:none;">
              <td height="29" align="center" style="padding-left:20px"><br />
                <br />
                <input type="submit" class="botao_normal botao" name="botao" id="botao" value="Alterar banner" /></td>
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