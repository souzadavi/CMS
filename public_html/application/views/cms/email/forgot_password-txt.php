Olá <?php if (strlen($username) > 0) { ?> <?php echo $username; ?><?php } ?>,

Esqueceu sua senha de acesso do <?php echo $site_name; ?>?
Para criar uma senha, acesse o link abaixo:

<?php echo site_url('/cms/auth/reset_password/'.$user_id.'/'.$new_pass_key); ?>


Você recebeu esse e-mail, porque foi solicitado por um usuário do <?php echo $site_name; ?>. Esse procedimento é uma parte do processo para configurar uma nova senha no sistema.

Caso NÃO TENHA solicitado uma nova senha, por favor ignore esse e-mail e sua senha não será alterada.


Obrigado,
<?php echo $site_name; ?>