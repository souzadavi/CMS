<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php include('includes/includeHeader.php'); ?>
     <script type="text/javascript" src="js/tiny_mce/jquery.tinymce.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){
			<?php echo isset($script_head) ? $script_head : ''; ?>

 			///INICIO DATA SELECT 	
			$("#publicacao").datepicker(
				{
					changeMonth: true,
					changeYear: true
				},$.datepicker.regional['pt-BR']
			);
			///FIM DATA SELECT 
			
            $('#descricao').tinymce({
                    language: "pt",
                    script_url : '<?php echo base_url();?><?php echo base_cms();?>js/tiny_mce/tiny_mce.js',
                    relative_urls: false,
                    //document_base_url : '',
                    theme_advanced_path : false,
                    theme : "advanced",
                    //plugins
                    //plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
                    // Theme options
                   // Theme options
					theme_advanced_buttons1 : "pasteword,undo,redo,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull",//styleselect,
					theme_advanced_buttons2 : "formatselect,fontsizeselect,|,table,removeformat,code,image",
					theme_advanced_buttons3 : "",
					theme_advanced_buttons4 : "",
					theme_advanced_toolbar_location : "top",
					theme_advanced_toolbar_align : "left",
					theme_advanced_statusbar_location : "bottom",
					theme_advanced_resizing : true,
					
					// Example content CSS (should be your site CSS)
					//content_css : "/<?php // echo base_cms();?>css/conteudo.css",

                    // Drop lists for link/image/media/template dialogs
                    template_external_list_url : "lists/template_list.js",
                    external_link_list_url : "lists/link_list.js",
                    external_image_list_url : "lists/image_list.js",
                    media_external_list_url : "lists/media_list.js"
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
              <div id="titulo_admin">Novo  Portfólio</div>
            </div>
            <p class="observacao">Todos os campos são obrigatórios.</p>
            <!-- FIM TITULO PAGINA -->
            <form action="portfolio/inserir" method="post" enctype="multipart/form-data">
  <table width="100%" style="margin-top:15px;" id="listagem">
            	<tr>
            	  <td height="95" style="padding-left:20px"><label for="nome">Categoria:</label><br />
				  <select name="categoria_id" id="categoria_id">
                  	<?php foreach($categorias->result() as $categoria){ ?><option value="<?php echo $categoria->id; ?>" ><?php echo $categoria->nome; ?></option><?php } ?>
                  </select><br />
                  <a href="categoriaNova" class="pequeno">adicionar nova categoria</a>
                  </td>
          	  </tr>
            	<tr>
            	  <td height="63" style="padding-left:20px">
            	    <label><input type="radio" name="status" id="status" value="1" />Ativado</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label><input type="radio" name="status" id="status" value="0" />Desativado</label>
               	  </td>
          	  </tr>
            	<tr>
            	  <td height="63" style="padding-left:20px"><label for="titulo">Título</label>
            	    <br />
           	      <input name="titulo" type="text" class="estilo_input input" id="titulo" size="80" /></td>
          	  </tr>
              <tr>
           	    <td height="63" style="padding-left:20px"><label for="publicacao">Publicação</label><br /><input name="publicacao" type="text" class="estilo_input input" id="publicacao" size="20"  readonly="readonly"/></td>
          	  </tr>
            	<tr>
            	  <td height="63" style="padding-left:20px"><label for="img_thumb">Imagem Pequena</label>
            	    <br />
       	          <input name="img_thumb" type="file" class="estilo_input input" id="img_thumb" /></td>
          	  </tr>
              <tr>
            	  <td height="63" style="padding-left:20px"><label for="img_big">Imagem Grande:</label>
            	    <br />
       	          <input name="img_big" type="file" class="estilo_input input" id="img_big" />
                  </td>
          	  </tr>
              <tr>
            	  <td height="29" style="padding-left:20px"><br /><label for="descricao">Descrição</label> 
           	        <br /><textarea name="descricao" id="descricao" cols="100" rows="15"></textarea>
                    <br /><br /><input type="submit" class="botao_normal botao" name="botao" id="botao" value="Inserir novo portfólio" />
       	          </td>
          	  </tr>
              </table>
            </form>
            <?php } ?>
            <?php if($modo =="editar"){ ?>
            ////////CONTEUDOOOOO
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