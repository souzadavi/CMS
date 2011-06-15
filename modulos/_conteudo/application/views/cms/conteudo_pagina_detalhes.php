<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php include('includes/includeHeader.php'); ?>
    <script type="text/javascript" src="js/jquery-1.4.1.min.js"></script>
    <script type="text/javascript" src="js/tiny_mce/jquery.tinymce.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#texto').tinymce({
                    language: "pt",
                    script_url : '<?php echo base_url();?><?php echo base_cms();?>js/tiny_mce/tiny_mce.js',
                    relative_urls: false,
                    //document_base_url : '',
                    theme_advanced_path : false,
                    theme : "advanced",
                    //plugins
                    plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
                    // Theme options
                   // Theme options
					theme_advanced_buttons1 : "pasteword,undo,redo,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontsizeselect,|,table,removeformat,code,image",
					theme_advanced_buttons2 : "",
					theme_advanced_buttons3 : "",
					theme_advanced_buttons4 : "",
					theme_advanced_toolbar_location : "top",
					theme_advanced_toolbar_align : "left",
					theme_advanced_statusbar_location : "bottom",
					theme_advanced_resizing : true,
					
					// Example content CSS (should be your site CSS)
					//content_css : "/css/conteudo.css",

                    // Drop lists for link/image/media/template dialogs
                    template_external_list_url : "lists/template_list.js",
                    external_link_list_url : "lists/link_list.js",
                    external_image_list_url : "lists/image_list.js",
                    media_external_list_url : "lists/media_list.js"
            });

			$("#img").click(function(){
				this.select();
			});

			
        });
    </script>
    </head>
    <body>
    <div id="mensagem"></div>
    <div id="base_admin">
      <?php include('includes/topo_admin.php'); ?>
      <?php include('includes/menu_admin.php'); ?>
      <div id="corpo">
        <div id="miolo_corpo"> 
          <!-- MENU ESQUEDA -->
          <div id="menu_lateral">
            <div id="tit_menu_lateral">Conteúdos</div>
            <ul id="menu_lista" class="lista_menu">
              	<?php foreach($menus as $menu){ ?>
          			<li class="item_menu"><a href="<?php echo $menu->url; ?>"><?php echo $menu->nome; ?></a></li>
          		<?php } ?>
            </ul>
          </div>
          <!-- MENU ESQUEDA -->
          <div id="conteudo_corpo">
            <div id="topo_conteudo">
              <div id="titulo_admin"><?php echo $conteudo->titulo; ?></div>
              <ul class="ferramenta">
            	<li><a href="conteudo/pagina">Listar Páginas</a></li>
              <?php if($conteudo->galeria_categoria_id){ ?>
            	<li><a href="conteudo/galeria/<?php echo $conteudo->galeria_categoria_id; ?>">Galeria de Imagens</a></li>
              <?php } ?>  
              </ul>
            </div>
            
            <table width="725" border="0" cellspacing="0" cellpadding="0" style="margin-left:10px; margin-top:10px" class="listagem">
              <?php if($conteudo->imagem){ ?>
                      <tr>
                        <td><label>Imagem utilizada</label><br />
                            <a href="<?php echo base_url();?>upload/conteudo/<?php echo $conteudo->imagem; ?>" target="_blank"><img src="<?php echo base_url();?>upload/conteudo/<?php echo $conteudo->imagem; ?>" style="max-width:705px; background-color:#176498; padding:5px; margin:10px" /></a><br />
                           <input type="text" value="<?php echo base_url();?>upload/conteudo/<?php echo $conteudo->imagem; ?>" size="85" id="img" name="img" readonly="readonly" class="estilo_input input" />
                            
                          </td>
                      </tr>
                      <tr>
                        <td><form method="post" action="<?php echo base_url();?><?php echo base_cms();?>conteudo/upload/<?php echo $conteudo->id; ?>" name="formAtualizar" id="formAtualizar"   enctype="multipart/form-data" >
                            <label for="image">Alterar imagem</label><br />
                            <input name="image" type="file" id="image" size="50" />
                            <input type="submit" name="bImagem" id="bImagem" value="Alterar Imagem" class="botao_normal botao" />
                          </form>
                        </td>
                      </tr>
              <?php } ?>
              <form action="<?php echo base_url();?><?php echo base_cms();?>conteudo/atualizar/<?php echo $conteudo->id; ?>" name="formAtualizar" method="post" >
                <input type="hidden" name="titulo" id="titulo" value="<?php echo $conteudo->titulo; ?>" />
                <input type="hidden" name="imagem" id="imagem" value="<?php echo $conteudo->imagem; ?>" />
                <?php if($conteudo->imagem){ ?>
                <tr>
                	<td>
                    	<label for="legenda">Legenda da Imagem</label><br />
                   		<input type="text" name="legenda" id="legenda" value="<?php echo $conteudo->legenda; ?>" size="85"  class="estilo_input input" style="margin-top:10px;" />
                	</td>
                </tr>
				<?php } ?>
				<?php if($conteudo->descricao){ /// Caso o campo texto estiver vazio o campo desaparece. ?>
                <tr>
                  <td>
                  	<label for="texto">Descrição</label>
                    <textarea name="texto" id="texto" cols="100" rows="15"><?php echo $conteudo->descricao; ?></textarea>
                  </td>
                </tr>
                <tr>
                  <td>
                  		<label for="resumo">Resumo</label><br />
               		<textarea name="resumo" id="resumo" cols="100" rows="5"  style="resize: none;"><?php echo $conteudo->resumo; ?></textarea>
                        
                          
				  </td>
                </tr>
                <?php } ?>
                <?php if($galeriaAtivada){ ?>
                <tr>
                	<td>
                      <label for="galeria_id">Galeria de Imagens</label><br />
                      <select name="galeria_id" id="galeria_id">
                        <option value="0">Sem Galeria definida</option>
                        <?php foreach($galeriaCategorias->result() as $categoria){ ?>
                            <option value="<?php echo $categoria->id; ?>" <?php if($categoria->id == $conteudo->galeria_categoria_id){ ?> selected="selected" <?php } ?>><?php echo $categoria->nome; ?></option>
                        <?php } ?>
                      </select>
                   </td>
             	</tr>
            	<?php } ?>
             	<tr style="border:none;">
                  <td align="right">
                    <input type="submit" name="bSalvar" id="bSalvar" value="Salvar Alterações" class="botao_normal botao" />
                  </td>
                </tr>
              </form>
            </table>
            <div id="topo_conteudo">
              <div id="titulo_admin" class="titulo_admin">Revisões</div>
            </div>
            <table width="725" style="margin-left:10px; margin-top:10px" class="listagem">
            <?php foreach($revisoes->result() as $revisao){ ?>
            	<tr>
                	<td>Página revisada em <?php echo $revisao->data_add; ?>  - Ip: <?php echo $revisao->ip; ?> 
                    </td>                    
                </tr>
            <?php } ?>
            </table>
          </div>
        </div>
      </div>
      <?php include('includes/rodape_admin.php'); ?>
    </div>
</body>
</html>