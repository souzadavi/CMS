<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php include('includes/includeHeader.php'); ?>
        <link href="css/galeria.css" rel="stylesheet" type="text/css" />
        <link href="css/uploadify/default.css" rel="stylesheet" type="text/css" />
        <link href="css/uploadify/uploadify.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/uploadify/swfobject.js"></script>
        <script type="text/javascript" src="js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
        
        <script type="text/javascript">
			$(document).ready(function(){ 
			
				/// mostrar propriedades do arquivo
				$("#galeriaFotos li").click(function() {
						//$('#carregando').html('<img src="img/carregando.gif" />');
						//$('#arquivoPropriedade').hide();
						//$("#galeriaFotos li").removeClass('marcar');
						//$(this).addClass('marcar');
						getPropriedade($(this).attr('src'));
						
				});
				/// cancelar propriedades do arquivo
				$("#arquivoCancelar").click(function() {
					$('#arquivoPropriedade').slideUp(300);
					$("#galeriaFotos li").removeClass('marcar');
				});
					

				/// Editar link e legenda do arquivo
				$("#enviarPropriedades").click(function() {
					$.post("galeria/atualizarArquivo", {arquivoId : $('#arquivoId').val(), legenda : $('#legenda').val(), link : $('#link').val() },
								function(data){
									$('#arquivoPropriedade').slideUp(300);
									$("#galeriaFotos li").removeClass('marcar');
									mensagem(data);
								});
				});
				

				//$(function() {
					$("#galeriaFotos ul").sortable({
						opacity: 0.4,
						cursor: 'move',
						update: function() {
							//var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
							var order = $(this).sortable("serialize"); 
							$.post("galeria/ordenar", order, 
								function(theResponse){
									mensagem("Ordem atualizada com sucesso!");
								}); 															 
						},
						//remove: function(){ alert("foi"); }							  
					});
				//});

				$("#deleteArea").droppable({
					 accept: '#listaFotos > li',
					 hoverClass: 'deleteArea_over',
					 drop: function(event, ui) {
						deleteImage(ui.draggable,ui.helper);
					 },
				});

				function deleteImage($draggable,$helper){
					 params = 'src=' + $draggable.attr('src');
					 $.ajax({
						 url: 'galeria/deletar',
						 type: 'POST',
						 data: params
					 });
					 $helper.effect('transfer', { to: '#deleteArea', className: 'ui-effects-transfer' },500);
					 $draggable.remove();
					 mensagem("Arquivo deletado com sucesso!");
					 $('#arquivoPropriedade').slideUp(300);
				}
				
				//// Botao de upload multiplos
				var id = <?php echo $galeria->id_grupo; ?>;
				$("#upload").uploadify({
						uploader: '<?php echo base_url();?><?php echo base_cms();?>js/uploadify/uploadify.swf',
						script:'<?php echo base_url();?><?php echo base_cms();?>js/uploadify/uploadify.php?id='+id,
						cancelImg: '<?php echo base_url();?><?php echo base_cms();?>img/cancel.png',
						folder: '<?php echo $pastaTemp; ?>',
						scriptAccess: 'always',
						auto: true,
						method	: 'POST',
						hideButton: false,
						fileDesc: 'Imagens e Flash',
						fileExt : '*.swf;*.jpeg;*.jpg;*.png;*.gif;',
						multi: true,
						'onError' : function (a, b, c, d) {
							 if (d.status == 404)
								alert('O script de upload não foi encontrado.');
							 else if (d.type === "HTTP")
								alert('error '+d.type+": "+d.status);
							 else if (d.type ==="Tamanho do Arquivo")
								alert(c.name+' '+d.type+' Limite: '+Math.round(d.sizeLimit/1024)+'KB');
							 else
								alert('erro '+d.type+": "+d.text);
							},
						'onComplete'   : function (event, queueID, fileObj, response, data) {
											//Post response back to controller
												$.post('<?php echo base_url();?><?php echo base_cms(); ?>galeria/uploadify/'+id,{filearray: response},function(info){
												var jsonConArquivo = eval("["+info+"]");
												
												var html;
												// criando um thumbnail do flash em jpg
												if(jsonConArquivo[0].tipo == ".swf"){
													//$.get('flash/swf2jpg.php?arquivo='+jsonConArquivo[0].imagem+jsonConArquivo[0].tipo, function(data) {
														//alert(data);
														//$('#target').html(data+" Criando um jpg do Flash.");
													//});
													html = "<li id='recordsArray_"+jsonConArquivo[0].id+"' src='"+jsonConArquivo[0].imagem+jsonConArquivo[0].tipo+"' onclick=\"javascript:getPropriedade('"+jsonConArquivo[0].imagem+jsonConArquivo[0].tipo+"');\"><img src='<?php echo base_url();?><?php echo base_cms(); ?>img/flash.jpg' width='100' height='100' /></li>";
												//$('#target').append('criado com sucesso!');
												}else{
													html = "<li id='recordsArray_"+jsonConArquivo[0].id+"' src='"+jsonConArquivo[0].imagem+jsonConArquivo[0].tipo+"' onclick=\"javascript:getPropriedade('"+jsonConArquivo[0].imagem+jsonConArquivo[0].tipo+"');\"><img src='<?php echo base_url();?>upload/thumb.php?h=100&w=100&img=galeria/" +jsonConArquivo[0].imagem+jsonConArquivo[0].tipo+ "' width='100' height='100' /></li>";
												//$('#target').empty();
												}
												
												$("#listaFotos").prepend(html);
												mensagem("Imagem enviada com sucesso!");
											});						 			
						}
				});
			});

function getPropriedade(id){
	$('#carregando').html('<img src="img/carregando.gif" />');
	$('#arquivoPropriedade').hide();
	$("#galeriaFotos li").removeClass('marcar');
	$("#galeriaFotos li[src="+id+"]").addClass('marcar');

	$.ajax({ 
		url: "galeria/propriedade/"+id+"/", 
		context: "#arquivoPropriedade", 
		dataType: "json",
		success: function(data){
			$('#carregando').empty();
			$('#arquivoPropriedade').delay(400).slideDown(300);//
			$("#arquivoId").val(data.id);
			$("#arquivo").html(data.arquivo);
			$("#data").html(data.data);
			$("#link").val(data.link);
			$("#legenda").val(data.legenda);
		}
	});
}
		</script>


    </head>

    <body>
    <?php include("includes/mensagem.php"); ?>
        <?php include('includes/topoAdmin.php'); ?>
        <div id="base_admin">
            <?php
            include('includes/topo_admin.php');
            ?>
            <?php include('includes/menu_admin.php'); ?>
            <div id="corpo">
                <div id="miolo_corpo">
					<?php if($galeria->id_grupo == 10 || $galeria->id_grupo == 11){ ?>
                    <div id="menu_lateral">
                        <div id="tit_menu_lateral">Conteúdos</div>
                        <ul id="menu_lista" class="lista_menu">
                            <!-- <li class="item_menu"><a href="conteudo">Listar Conteúdo</a></li>-->
                           <li class="item_menu"><a href="/<?php echo base_cms();?>destaquehome">Destaques da Home</a></li>
                           <li class="item_menu"><a href="/<?php echo base_cms();?>conteudo/detalhes/3">Organograma OHL</a></li>
                           <li class="item_menu"><a href="/<?php echo base_cms();?>conteudo/detalhes/2">Organograma Ambient</a></li>
                           <li class="item_menu"><a href="/<?php echo base_cms();?>conteudo/detalhes/1">Qualidade/Certificação</a></li>
                           <li class="item_menu"><a href="/<?php echo base_cms();?>fotosete">Fotos da ETE</a></li> 
                        </ul>
                    </div>
                    <?php } ?>
                    <!-- MENU ESQUEDA -->
                    <div id="conteudo_corpo">
                      <div id="topo_conteudo">
                       	<div id="titulo_admin"><?php echo $galeria->nome; ?></div>
                      </div>
                        <!-- Titulos da tabela -->
                        <table width="725" border="0" cellspacing="0" cellpadding="0" style="margin-left:10px; margin-top:10px">
                        <tr>
                              <td>
                            <div id="containerUpload">
                                <div id="target"></div>
                                    <?php echo form_open_multipart('images/uploadify');?>
                                    <h2>Selecione uma imagem clicando no botão abaixo</h2>
                                    <p>
                                        <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload'));?>
                                        <label for="Filedata" class="observacao"><?php if($galeria->observacao != ""){ echo nl2br($galeria->observacao); } ?></label><br />
                                        <!--<a href="javascript:$('#upload').uploadifyUpload();">Subir Arquivos</a>-->
                                    </p>
                                    <?php echo form_close();?>
                                </div>
			                  <h2>Imagens da galeria</h2>
                              <div id="galeriaFotos">
                                    <ul id="listaFotos">
                                    <?php  foreach($imagens->result() as $image){ ?>
                                        <?php if($image->id_tipo == 2){ ?>
                                        <li id="recordsArray_<?php echo $image->id; ?>" src="<?php echo $image->src; ?>" ><img src="<?php echo base_url();?><?php echo base_cms(); ?>img/flash.jpg"  height="100" width="100" /></li>
                                        <?php }else{ ?>
                                        <li id="recordsArray_<?php echo $image->id; ?>" src="<?php echo $image->src; ?>"><img src="<?php echo base_url();?>upload/thumb.php?h=100&w=100&img=galeria/<?php echo $image->src; ?>"  height="100" width="100" /></li>
                                        <?php } ?>
                                    <?php } ?>
                                    </ul>
                                    <div id="sucesso"></div>
                                </div>
                                <div id="deleteArea" class="deleteArea_out"></div>
                                <p class="observacao" style="width:230px; margin-top:0; float:left">Arraste e solte a foto na lixeira para deletá-la da galeria.</p>
                                <div id="carregando"></div>
                                <div id="arquivoPropriedade">
                                    <h2>Propriedades do Arquivo</h2>
                                      <form method="post">
                                      <table width="350" border="0">
                                          <tr>
                                            <td width="59" height="30">Arquivo: </td>
                                            <td id="arquivo">erro</td>
                                        </tr>
                                          <tr>
                                            <td height="30">Enviado:</td>
                                            <td id="data">erro</td>
                                        </tr>
                                          <tr>
                                            <td height="30">Link: </td>
                                            <td><div class="estilo_input"><input name="link" type="text" class="input" id="link" size="40" /></div><input type="hidden" name="arquivoId" id="arquivoId" /></td>
                                        </tr>
                                          <tr>
                                            <td height="30">Legenda:                                                </td>
                                            <td><div class="estilo_input"><input name="legenda" type="text" class="input" id="legenda" size="40" /></div></td>
                                        </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td valign="bottom" style="padding-top:10px"><input type="button" id="enviarPropriedades" value="salvar" class="botao_normal botao" /> 
                                            <span id="arquivoCancelar" class="botao_normal botao">cancelar</span></td>
                                        </tr>
                                      </table>
                                  </form>
                                </div>
                        </td>
                            </tr>
                      </table>
                    </div>
                </div>
                
            </div><?php include('includes/rodape_admin.php'); ?>
        </div>
    </body>
</html>