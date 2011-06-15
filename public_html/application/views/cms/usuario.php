<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php include('includes/includeHeader.php'); ?>
        <style type="text/css">
			#listagem td {
				padding-left:10px;
			}
			.campo0{
				width: 40px;
				*margin-right:3px;
			}
			.campo1{
				width: 130px;
				overflow-x: hidden;
				*margin-right:3px;
			}
			.campo2{
				width: 270px;
				*margin-right:3px;
			}
			.campo3{
				width: 180px;
				*margin-right:3px;
			}
			.campo4{
				width: 65px;
				*margin-right:3px;
			}
			.tit_tabela_topo{
				*padding-left:0;
			}
			#listagem tr {
				height:40px;
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
                       	<div id="titulo_admin">Usuários Cadastrados</div>
                      </div>
                        <!-- input busca -->

                        <!-- Titulos da tabela -->
                        <ul id="titulos_tabela" class="round" style="margin-top:10px;">
                            <li class="margem_esq_tabela campo0">Status</li>
                            <li class="tit_tabela_topo campo1">Usuário</li>
                            <li class="tit_tabela_topo campo2">Último Login</li>
                            <li class="tit_tabela_topo campo3">Alterado em</li>
                            <li class="tit_tabela_topo campo4">Permissões</li>
                        </ul>
                        <table width="100%" border="0" cellspacing="3" cellpadding="5" id="listagem">
						  <?php  foreach($usuarios->result() as $usuario){ ?>
                            <tr>
 	                          <td width="32" style="padding-left:20px"><?php if($usuario->activated){ ?><a href="usuario/status/<?php echo $usuario->id; ?>/0" title="Desativar"><img src="img/publicado.png" alt="" width="16" height="16" /></a>
                              <?php }else{ ?><a href="usuario/status/<?php echo $usuario->id; ?>/1" title="Ativar"><img src="img/nao_publicado.png" alt="" width="16" height="16" /></a><?php } ?></td>
                              <td width="130"><a href="usuario/detalhes/<?php echo $usuario->id; ?>"><?php echo $usuario->username; ?></a></td>
                              <td width="270"><?php echo $usuario->last_login; ?> - IP: <?php echo $usuario->last_ip; ?></td>
                              <td width="180"><?php echo $usuario->modified; ?></td>
							  <td><a href="usuario/permissao/<?php echo $usuario->id; ?>" class="botao_normal botao">Alterar</a></td>
                            </tr>
                          <?php } ?>
                        </table>
                    </div>
                </div>
                
            </div><?php include('includes/rodape_admin.php'); ?>
        </div>
    </body>
</html>