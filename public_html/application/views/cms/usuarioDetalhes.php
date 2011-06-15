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
                       	<div id="titulo_admin">Gerenciar Usuários</div>
                      </div>
                        <!-- input busca -->

                        <!-- Titulos da tabela -->
                       <?php if($modo == "novo"){ ?>
                       <form action="<?php echo base_url();?><?php echo base_cms();?>auth/register" method="post">
              <table width="725" border="0" cellspacing="0" cellpadding="0" style="margin-left:10px; margin-top:20px">
                            <tr>
                                <td width="100" height="30"><label for="email">E-mail:</label></td>
                              <td><div class="estilo_input"><input type="text" name="email" value="" id="email" maxlength="80" size="30" class="input" /></div></td>
                           	</tr>
                            <tr>
                            	<td height="30"><label for="password">Senha:</label></td>
                           	  <td><div class="estilo_input"><input type="password" name="password" value="" id="password" maxlength="20" size="30" class="input" /></div></td>
                           	</tr>
                            <tr>
                            	<td height="30"><label for="confirm_password">Confirmar Senha:</label></td>
                       		  <td><div class="estilo_input"><input type="password" name="confirm_password" value="" id="confirm_password" maxlength="20" size="30" class="input" /></div></td>
                           	</tr>
                            </table>
                            <input type="submit" name="register" value="Cadastrar Usuário" class="botao_normal botao" style="margin-top:20px; clear:both"  />
                      </form>
                        <?php } ?>
                       <?php if($modo == "senha"){ ?>
                      <form action="<?php echo base_url();?><?php echo base_cms();?>auth/change_password" method="post">
                            <table width="725" border="0" cellspacing="0" cellpadding="0" style="margin-left:10px; margin-top:20px">
                                <tr>
                                    <td width="130" height="30"><label for="old_password">Senha Antiga:</label></td>
                                  <td><div class="estilo_input"><input type="password" name="old_password" value="" id="old_password" size="30" class="input" /></div></td>
                                </tr>
                                <tr>
                                    <td height="30"><label for="new_password">Nova Senha:</label></td>
                                  <td><div class="estilo_input"><input type="password" name="new_password" value="" id="new_password" maxlength="20" size="30" class="input" /></div></td>
                                </tr>
                                <tr>
                                    <td height="30"><label for="confirm_new_password">Confirmar Nova Senha:</label></td>
                                  <td><div class="estilo_input"><input type="password" name="confirm_new_password" value="" id="confirm_new_password" maxlength="20" size="30" class="input" /></div></td>
                                </tr>
                            </table>
                        <input type="submit" name="change" value="Trocar Senha" class="botao_normal botao" style="margin-top:20px; clear:both"  />
                        </form>
                        <?php } ?>
                        <?php if($modo == "profile"){ ?>
                      <form action="<?php echo base_url();?><?php echo base_cms();?>usuario/profile" method="post">
                      <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <table width="725" border="0" cellspacing="0" cellpadding="0" style="margin-left:10px; margin-top:20px">
                                <tr>
                                    <td width="100"><label for="name">Nome Completo:</label></td>
                                    <td><div class="estilo_input"><input type="name" name="name" value="<?php if($usuario != ""){ echo $usuario->name; } ?>" id="name" maxlength="100" size="30" class="input" /></div></td>
                                </tr>
                            </table>
                        <input type="submit" name="change" value="Alterar Perfil do Usuário" class="botao_normal botao" style="margin-top:20px; clear:both"  />
                        </form>
                        <?php } ?>
                    </div>
                </div>
                
            </div><?php include('includes/rodape_admin.php'); ?>
        </div>
    </body>
</html>