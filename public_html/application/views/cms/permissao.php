<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php include('includes/includeHeader.php'); ?>
        <style type="text/css">
			#listagem td {
				padding-left:10px;
			}
			.campo1{
				width: 80px;
				overflow-x: hidden;
			}
			.campo2{
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
                        <div id="tit_menu_lateral">Usuários</div>
                        <ul id="menu_lista" class="lista_menu">
                        <?php foreach($menus as $menu){ ?>
                            <li class="item_menu"><a href="<?php echo $menu->url; ?>"><?php echo $menu->nome; ?></a></li>
                        <?php } ?>
                        </ul>
                    </div>
                    <!-- MENU ESQUEDA -->
                    <div id="conteudo_corpo">
                      <div id="topo_conteudo">
                       	<div id="titulo_admin">Permissões de <?php echo $usuario->username; ?></div>
                      </div>
                        <!-- input busca -->

                        <!-- Titulos da tabela -->
                        <ul id="titulos_tabela" class="round" style="margin-top:10px;">
                            <li class="margem_esq_tabela campo0"></li>
                            <li class="tit_tabela_topo campo1">Permissão</li>
                            <li class="tit_tabela_topo campo2">Área</li>
                        </ul>
                        <table width="100%" border="0" cellspacing="3" cellpadding="5" id="listagem">
						  <?php  $idPai = 0; foreach($permissoes as $permissao){ ?>
                            <?php 
									
									if($permissao->pai_id != $idPai){
										$idPai = $permissao->pai_id;
							?>
                            		<tr>
                                  		<td width="65" style="padding-left:25px"><?php if($permissao->habilitadaP){ ?><a href="usuario/permissao/<?php echo $usuario->id; ?>/<?php echo $permissao->pai_id; ?>/alterar" title="Desativar"><img src="img/publicado.png" alt="" width="16" height="16" /></a><?php }else{ ?><a href="usuario/permissao/<?php echo $usuario->id; ?>/<?php echo $permissao->pai_id; ?>/alterar" title="Ativar"><img src="img/nao_publicado.png" alt="" width="16" height="16" /></a><?php } ?></td>
                                  		<td><?php echo $permissao->pai_nome; ?></td>
                           		 </tr>
                            <?php } ?>
                            
							<?php if($permissao->filho1_nome){ ?>
                            <tr>
                              <td width="65" style="padding-left:25px"><?php if($permissao->habilitada){ ?><a href="usuario/permissao/<?php echo $usuario->id; ?>/<?php echo $permissao->filho1_id; ?>/alterar" title="Desativar"><img src="img/publicado.png" alt="" width="16" height="16" /></a><?php }else{ ?><a href="usuario/permissao/<?php echo $usuario->id; ?>/<?php echo $permissao->filho1_id; ?>/alterar" title="Ativar"><img src="img/nao_publicado.png" alt="" width="16" height="16" /></a><?php } ?></td>
                              <td style="padding-left:30px;"><?php echo $permissao->filho1_nome; ?></td>
                              </tr>
                              <?php } ?>
                              <?php if($permissao->filho2_nome){ ?>
                              <td width="65" style="padding-left:25px"><?php if($permissao->habilitada2){ ?><a href="usuario/permissao/<?php echo $usuario->id; ?>/<?php echo $permissao->filho2_id; ?>/alterar" title="Desativar"><img src="img/publicado.png" alt="" width="16" height="16" /></a><?php }else{ ?><a href="usuario/permissao/<?php echo $usuario->id; ?>/<?php echo $permissao->filho2_id; ?>/alterar" title="Ativar"><img src="img/nao_publicado.png" alt="" width="16" height="16" /></a><?php } ?></td>
                              <td style="padding-left:60px;"><?php echo $permissao->filho2_nome; ?></td>
                              </tr>
                              <?php } ?>
                              
                          <?php } ?>
                        </table>
                    </div>
                </div>
                
            </div><?php include('includes/rodape_admin.php'); ?>
        </div>
    </body>
</html>