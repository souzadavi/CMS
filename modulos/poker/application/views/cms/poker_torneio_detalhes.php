<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php include('includes/includeHeader.php'); ?>
    <script type="text/javascript" src="js/tiny_mce/jquery.tinymce.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
			<?php echo isset($script_head) ? $script_head : ''; ?>

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
			
			$('#etapaAtual').change(function() {
 				$('#jogadoresPontuacao').toggle();
			});
			<?php if($modo =="editar"){ ?>
			$('#abrir').click(function(){
				$('#formEditarTorneio').slideDown();
				$('#abrir').attr("src","img/fechado.png");
			});
			
			<?php $i = 0; foreach($jogadoresInscritos->result() as $jogadorInscrito){ ?>
			/// Definir Estatus para hidden
			$('#jogadorInput<?php echo $i; ?>').hide();
			$('#etapaAtual option:first').attr("selected","selected");
			$("#jogador<?php echo $i; ?>").attr('checked', false);
			$('#jogadorText<?php echo $i; ?>').val('');

			$('#jogador<?php echo $i; ?>').click(function(){
				if ($('#jogador<?php echo $i; ?>:checked').val() == undefined) {
  					$('#jogadorInput<?php echo $i; ?>').hide();
					$('#jogadorText<?php echo $i; ?>').val('');
				}else{
					$('#jogadorInput<?php echo $i; ?>').show();
					$("#jogadorText<?php echo $i; ?>").focus();
				}
				
			});
			<?php $i++; }} ?>
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
        <div id="tit_menu_lateral">Poker Torneios</div>
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
              <div id="titulo_admin">Novo  Torneio</div>
            </div>
        <p class="observacao">Todos os campos são obrigatórios.</p>
        <!-- FIM TITULO PAGINA -->
        <form action="poker/inserir" method="post" enctype="multipart/form-data">
              <table width="100%" style="margin-top:15px;" id="listagem">
            <tr>
                  <td height="63" style="padding-left:20px"><label>
                      <input type="radio" name="status" id="status" value="1" />
                      Ativado</label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                      <input type="radio" name="status" id="status" value="0" />
                      Desativado</label></td>
                </tr>
            <tr>
                  <td height="63" style="padding-left:20px"><label for="nome">Nome do Torneio</label>
                <br />
                <input name="nome" type="text" class="estilo_input input" id="nome" size="80" /></td>
                </tr>
            <tr>
                  <td height="63" style="padding-left:20px"><label for="total_etapas">Total de Etapas</label>
                <br />
                <input name="total_etapas" type="text" class="estilo_input input" id="total_etapas" size="20" /></td>
                </tr>
            <tr>
                  <td height="63" style="padding-left:20px"><label for="maximo_pontos">Máximo de Pontos no Torneio</label>
                <br />
                <input name="maximo_pontos" type="text" class="estilo_input input" id="maximo_pontos" /></td>
                </tr>
            <tr>
                  <td height="63" style="padding-left:20px"><label for="imagem">Imagem do Banner</label>
                <br />
                <input name="imagem" type="file" class="estilo_input input" id="imagem" /></td>
                </tr>
            <tr>
                  <td height="29" style="padding-left:20px"><br />
                <label for="descricao">Descrição</label>
                <br />
                <textarea name="descricao" id="descricao" cols="100" rows="15"></textarea>
                <br />
                <br />
                <input type="submit" class="botao_normal botao" name="botao" id="botao" value="Inserir novo torneio de poker" /></td>
                </tr>
          </table>
            </form>
        <?php } ?>
        <?php if($modo =="editar"){ ?>
        <!-- TITULO PAGINA -->
        <div id="topo_conteudo">
              <div id="titulo_admin">Atualizar  Torneio - <?php echo $torneio->nome; ?></div>
            </div>
        <table width="100%" style="margin-top:15px;" id="listagem">
              <tr>
                  <td height="43" style="padding-left:20px"><p class="observacao">Insira os participantes do torneio.</p></td>
                </tr>
              <tr style="border:none;">
            <td height="63" style="padding-left:20px"><label for="nome2">Nome jogador </label>
                  <form action="poker/inserirJogadorTorneio/<?php echo $torneio->id; ?>" method="post" >
                <select name="jogador_id" id="jogador_id" >
                      <?php foreach($jogadores->result() as $jogador){ ?>
                      <option value="<?php echo $jogador->id; ?>"><?php echo $jogador->nome; ?></option>
                      <?php  } ?>
                    </select>
                <input type="submit" class="botao_normal botao" name="botao3" id="botao3" value="Inserir novo jogador" />
              </form>
                  Jogadores no Torneio<br />
                  <ul class="listaColunas" id="listaJogadoresInscritos">
                <?php foreach($jogadoresInscritos->result() as $jogadorInscrito){ ?>
                <li><?php echo $jogadorInscrito->nome; ?> - <?php echo $jogadorInscrito->pontos_total; ?> &nbsp;&nbsp;<span><a href="poker/deletarJogadorTorneio/<?php echo $jogadorInscrito->id; ?>/<?php echo $torneio->id; ?>" class="botaoFechar" title="Deletar Jogador do Torneio">X</a></span></li>
                <?php $jogadorCadastrado = true; } ?>
              </ul>
                  <br /></td>
          </tr>
          </table>
          <form action="poker/etapasAtualizar/<?php echo $torneio->id; ?>/<?php echo $torneio->realizada_etapas++; ?>" method="post" enctype="multipart/form-data">
              <table width="100%" style="margin-top:15px;">
			<?php if(isset($jogadorCadastrado)){ ?>
              <?php if($torneio->realizada_etapas< $torneio->total_etapas){ ?>
              <tr>
                  <td height="43" style="padding-left:20px"><p class="observacao">Selecione a etapa abaixo.</p></td>
                </tr>
              <tr>
            <td height="63" style="padding-left:20px"><label for="nome2">Etapa Atual</label>
                  <br />
                  
                  <select id="etapaAtual" name="etapaAtual" >
                <?php //for($i=$torneio->realizada_etapas;$i<=$torneio->total_etapas;$i++){	 ?>
                <option value="<?php echo $torneio->realizada_etapas; ?>"><?php echo $torneio->realizada_etapas; ?></option>
                <option value="<?php echo $torneio->realizada_etapas++; ?>"><?php echo $torneio->realizada_etapas++; ?></option>
                <?php //} ?>
              </select>
            </td>
          </tr><?php }else{ ?>
            <tr>
                  <td height="43" style="padding-left:20px"><p class="observacao">Todas as etapas desse torneio já foram realizadas.</p></td>
                </tr>
              <?php } ?>
            </table>
            
         <table width="100%" style="display:none;" id="jogadoresPontuacao">
            <tr>
                  <td height="43" style="padding-left:20px"><p class="observacao">Selecione todos os jogadores que participaram dessa etapa e, em seguida, atualize a pontuação.</p></td>
                </tr>
			<?php $i=0; foreach($jogadoresInscritos->result() as $jogadorInscrito){ ?>
            
            <tr>
                  <td height="35" style="padding-left:20px"><label>
                      <input type="checkbox" name="jogador[<?php echo $i; ?>][selecionado]" id="jogador<?php echo $i; ?>" value="1" />
                      <?php echo $jogadorInscrito->nome; ?> - <?php echo $jogadorInscrito->pontos_total; ?></label>
                <br />
                <div id="jogadorInput<?php echo $i; ?>" >
                      <input name="jogador[<?php echo $i; ?>][pontos]" type="text" class="estilo_input input" id="jogadorText<?php echo $i; ?>" maxlength="11" />
                      &nbsp;&nbsp;Pontos
                      <input name="jogador[<?php echo $i; ?>][jogador_id]" type="hidden" id="jogador[<?php echo $i; ?>][jogador_id]" value="<?php echo $jogadorInscrito->jogador_id; ?>" />
                    </div></td>
                </tr>
            <?php $i++; } ?>
            <tr>
                  <td height="53" style="padding-left:20px"><input type="submit" class="botao_normal botao" name="botao2" id="botao2" value="atualizar pontuação" /></td>
                </tr>
			<?php }else{ ?>
            	<tr>
                  <td height="43" style="padding-left:20px"><p class="observacao">Torneio sem jogadores cadastrados. Selecione acima um jogador para cadastrar no torneio.</p></td>
                </tr>
            <?php } ?>
          </table>
            </form>
        <!-- TITULO PAGINA -->
        <div id="topo_conteudo" style="margin-top:35px;">
              <div id="titulo_admin" class="titulo_admin">Editar  Torneio - <?php echo $torneio->nome; ?><img src="img/aberto.png" alt="" width="30" height="30" style="float:right;" id="abrir" /></div>
            </div>
        <!-- FIM TITULO PAGINA -->
        <form action="poker/alterar/<?php echo $torneio->id; ?>" method="post" enctype="multipart/form-data" style="display:none;" id="formEditarTorneio">
              <table width="100%" style="margin-top:15px;" id="listagem">
            <tr>
                  <td height="63" style="padding-left:20px"><label>
                      <input type="radio" name="status" id="status" value="1" <?php if($torneio->status){ ?> checked="checked" <?php } ?> />
                      Ativado</label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                      <input type="radio" name="status" id="status" value="0" <?php if(!$torneio->status){ ?> checked="checked" <?php } ?>  />
                      Desativado</label></td>
                </tr>
            <tr>
                  <td height="63" style="padding-left:20px"><label for="nome">Nome do Torneio</label>
                <br />
                <input name="nome" type="text" class="estilo_input input" id="nome" size="80" value="<?php echo $torneio->nome; ?>" /></td>
                </tr>
            <tr>
                  <td height="63" style="padding-left:20px"><label for="total_etapas">Total de Etapas</label>
                <br />
                <input name="total_etapas" type="text" class="estilo_input input" id="total_etapas" size="20" value="<?php echo $torneio->total_etapas; ?>" /></td>
                </tr>
            <tr>
                  <td height="63" style="padding-left:20px"><label for="maximo_pontos">Máximo de Pontos no Torneio</label>
                <br />
                <input name="maximo_pontos" type="text" class="estilo_input input" id="maximo_pontos" value="<?php echo $torneio->maximo_pontos; ?>" /></td>
                </tr>
            <tr>
                  <td height="63" style="padding-left:20px"><label for="imagem">Imagem do Banner</label>
                <br />
                <img src="<?php echo base_url(); ?>upload/thumb.php?img=poker/<?php echo $torneio->imagem; ?>&w=200" /> <br />
                <input name="imagem" type="file" class="estilo_input input" id="imagem" /></td>
                </tr>
            <tr>
                  <td height="29" style="padding-left:20px"><br />
                <label for="descricao">Descrição</label>
                <br />
                <textarea name="descricao" id="descricao" cols="100" rows="15"><?php echo $torneio->descricao; ?></textarea>
                <br />
                <br />
                <input type="submit" class="botao_normal botao" name="botao" id="botao" value="Alterar o torneio de poker" /></td>
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