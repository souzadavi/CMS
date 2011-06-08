Olá <?php if (strlen($username) > 0) { ?> <?php echo $username; ?><?php } ?>,

Você alterou a sua senha com sucesso!
Por favor guarde sua senha em um lugar seguro para não esquecer.
<?php if (strlen($username) > 0) { ?>
Nome de usuário: <?php echo $username; ?>
<?php } ?>

E-mail: <?php echo $email; ?>

<?php /* Your new password: <?php echo $new_password; ?>

*/ ?>

<?php echo $site_name; ?>