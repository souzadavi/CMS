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
                        <div id="tit_menu_lateral">Galeria</div>
                        <ul id="menu_lista" class="lista_menu">
                        </ul>
                    </div>
                    <!-- MENU ESQUEDA -->
                    <div id="conteudo_corpo">
                      <div id="topo_conteudo">
                            <div id="titulo_admin">Galeria </div>
                      </div>
                      <div id="info">
                            <div id="qtde_cadastro"></div>
                        </div>
                        <!-- input busca -->

                        <!-- Titulos da tabela -->
                        <table width="100%" border="0" cellspacing="3" cellpadding="5" id="listagem">
                            <?php  foreach($galerias->result() as $galeria){ ?>
                            <tr>
                                <td width="80%">
                                   <a href="galeria/editar/<?php echo $galeria->id_grupo; ?>"><?php echo $galeria->nome; ?></a>
                                </td>
                                <td><?php echo $galeria->observacao; ?></td>
                          </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                
            </div><?php include('includes/rodape_admin.php'); ?>
        </div>
    </body>
</html>