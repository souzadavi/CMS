<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php include('includes/includeHeader.php'); ?>
        <script type="text/javascript" src="js/jquery-1.4.1.min.js"></script>
        <script type="text/javascript" src="js/tiny_mce/jquery.tinymce.js"></script>
        <style type="text/css">
            #listagem td {
                padding-left:10px;
            }
            .campo1{
                width: 55%;
                overflow-x: hidden;
            }
            .campo2{
                width: 40%;
                *padding-left:5px !important;
            }
            .tit_tabela_topo{
                *padding-left:0;
            }
        </style>
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
					theme_advanced_buttons1 : "pasteword,undo,redo,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontsizeselect,|,table,removeformat,code,image",
					theme_advanced_buttons2 : "",
					theme_advanced_buttons3 : "",
					theme_advanced_buttons4 : "",
					theme_advanced_toolbar_location : "top",
					theme_advanced_toolbar_align : "left",
					theme_advanced_statusbar_location : "bottom",
					theme_advanced_resizing : true,
					
					// Example content CSS (should be your site CSS)
					content_css : "/<?php echo base_cms();?>css/conteudo.css",

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
        <style type="text/css">
			#listagem td {
				padding-left:10px;
			}
			.campo1{
				width: 79%;
				overflow-x: hidden;
			}
			.campo2{
				width: 15%;
				*padding-left:5px !important;
			}
			.tit_tabela_topo{
				*padding-left:0;
			}
		</style>
    </head>

    <body>
        <?php include('includes/topoAdmin.php'); ?>
        <div id="base_admin">
            <?php
            include('includes/topo_admin.php');
            ?>
            <?php include('includes/menu_admin.php'); ?>
            <div id="corpo">
                <div id="miolo_corpo">
                    <!-- MENU ESQUEDA -->
                    <div id="menu_lateral">
                        <div id="tit_menu_lateral">Conteúdos</div>
                        <ul id="menu_lista" class="lista_menu">
                            <li class="item_menu"><a href="conteudo">Listar Conteúdo</a></li>
                        </ul>
                    </div>
                    <!-- MENU ESQUEDA -->
                    <div id="conteudo_corpo">
                      <div id="topo_conteudo">
                            <div id="titulo_admin"><?php echo $conteudo->titulo; ?></div>
                      </div>
						<table width="725" border="0" cellspacing="0" cellpadding="0" style="margin-left:10px; margin-top:10px">
                        <tr>
                              <td>
                       <?php if($conteudo->imagem){ ?>
                       <h2>Imagem utilizada</h2>
                        <img src="<?php echo base_url();?>upload/conteudo/<?php echo $conteudo->imagem; ?>" style="max-width:705px; background-color:#176498; padding:10px; margin-bottom:10px" /><br />
                        <span style="float:left; line-height:25px; margin-right:5px">Link da imagem:</span>
                        <div id="div_login" class="estilo_input"><input type="text" value="<?php echo base_url();?>upload/conteudo/<?php echo $conteudo->imagem; ?>" size="85" id="img" name="img" readonly="readonly" class="input" /></div>
                       <br /><br />
                       <h2>Alterar imagem</h2>
                       <form method="post" action="<?php echo base_url();?><?php echo base_cms();?>conteudo/upload/<?php echo $conteudo->id; ?>" name="formAtualizar" id="formAtualizar"   enctype="multipart/form-data" >
                       		<input name="image" type="file" id="image" size="50" />
                            <input type="submit" name="bImagem" id="bImagem" value="Alterar Imagem" class="botao_normal botao" />
                       </form>
                       <br /><?php } ?>
                      <form action="<?php echo base_url();?><?php echo base_cms();?>conteudo/atualizar/<?php echo $conteudo->id; ?>" name="formAtualizar" method="post" >
                       			<input type="hidden" name="titulo" id="titulo" value="<?php echo $conteudo->titulo; ?>" />
                                <input type="hidden" name="imagem" id="imagem" value="<?php echo $conteudo->imagem; ?>" />
                                 <?php if($conteudo->imagem){ ?>
                                    <h2>Legenda da Imagem</h2>
                                    <input type="text" name="legenda" id="legenda" value="<?php echo $conteudo->legenda; ?>" size="85" class="estilo_input input" />
                                <?php } ?>
                                <?php 
							   /// Caso o campo texto estiver vazio o campo desaparece.
							   if($conteudo->texto){ ?>
                                <p>&nbsp;</p><p>&nbsp;</p>
                                <h2>Descrição</h2>
                               	<textarea name="texto" id="texto" cols="100" rows="15"><?php echo $conteudo->texto; ?></textarea>
                                <input type="submit" name="bSalvar" id="bSalvar" value="Salvar" class="botao_normal botao" style="margin-top:20px; clear:both" />
							   <?php } ?>
                       <!--
                       	<form action="<?php //echo base_url();?><?php // echo base_cms();?>preview" name="formAtualizar" method="post" >
                       	<input type="submit" name="bPreview" id="bPreview" value="Preview" />
                       -->
                       </form>
                       <?php if($conteudo->id_grupo){ ?>
                       <h2>Galeria de Imagens</h2>
                       <p>Esse conteúdo tem galeria habilitada, <a href="galeria/<?php echo $conteudo->id_grupo; ?>">clique aqui para gerenciar os arquivos</a></p>
                       <?php } ?>
                        </td>
                            </tr>
                      </table>
                    </div>
                </div>
                
            </div><?php include('includes/rodape_admin.php'); ?>
        </div>
    </body>
</html>