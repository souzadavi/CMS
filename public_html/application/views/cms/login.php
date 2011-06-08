<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('includes/includeHeader.php'); ?>
<link rel="stylesheet" type="text/css" href="css/login.css" />

<style type="text/css">
.input{
	*margin-left:0;
}
</style>
</head>

<body>
<div id="base_login">
	<div id="topo_login">
		<div id="conteudo_logo">
			<img src="img/logo_cliente.png" alt="" />
		</div>
	</div>
	<div id="tit_login"><span id="titulo_login" class="district">Administrativo</span></div>
	<div id="centro_login">
		<div id="miolo_login">
			<div id="div_texto_login">
				<span id="texto_login">Acesse o sistema digitando os campos abaixo com os seus dados.</span>
			</div>
			<div id="form_login">
                        <?php echo form_open(base_url().base_cms().'auth/login'); ?>
			<table width="100%" border="0">
			  <tr>
			    <td align="right"><label for="email" class="tit_form">E-mail:</label></td>
			    <td>
			    	<div id="div_login" class="estilo_input">
			    		<input class="input" type="text" name="login" id="login" style="width:180px" />
			    	</div>
				</td>
			  </tr>
			  <tr>
			  	<td style="height:9px;"></td>
			  </tr>
			  <tr>
			    <td align="right"><label for="senha" class="tit_form">Senha:</label></td>
			    <td>
			    	<div id="div_senha" class="estilo_input">
			    		<input class="input" type="password" name="password" id="password" style="width:180px" />
			    	</div>
			    </td>
			  </tr>
			  <tr>
			  <td></td>
                          <td style="padding-left:7px; padding-top:10px"><a href="<?php echo base_url().base_cms(); ?>auth/forgot_password">Esqueci minha senha</a></td>
			  </tr>
			  <tr>
			    <td></td>
			    <td style="padding-left:7px; padding-top:10px"><input type="submit" value="Acessar" class="botao_normal botao" /></td>
		      </tr>
			</table>
			<?php echo form_close(); ?>
			</div>			
		</div>
	</div>
	<div id="rodape_login">
		Copyright © CMS. Todos os direitos reservados.
	</div>
</div>
</body>
</html>