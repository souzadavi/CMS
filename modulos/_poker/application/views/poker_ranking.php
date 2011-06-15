<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ranking Poker - Lol Clube</title>
<link href="<?php echo base_url() ?><?php echo base_cms() ?>css/reset-min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url() ?><?php echo base_cms() ?>js/jquery-1.4.1.min.js" type="text/javascript"></script>
<style type="text/css">
body {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size:12px;
	color:#FFF;
	background-color:#000;
}
.ranking-poker{
	background-color:#000;
	padding:5px;
	height:525px;
	width:860px;
	overflow:auto;
}
.header{
	background-color:#1d1d1d;
	height:40px;
	width:843px;
	margin-bottom:5px;
	position:absolute;
	top:0;
	border-top: solid #000 4px;
}
.formTorneio{
	float:right;
	width:320px;
	padding:5px;
}
.labelTorneio{
	font-size:1.5em;
}
.table-ranking {
	width:843px;
	margin-top:45px;
}
.table-ranking th{
	background:url(<?php echo base_url() ?>images/ranking-bg.png) repeat-x;
	height:25px;
	padding-top:10px;
	margin:0px;
	color:#333;
	text-align:center;
	font-weight:bold;
}
.table-ranking td{
	background:url(<?php echo base_url() ?>images/ranking-bg-tabela.png) repeat-x;
	height:20px;
	padding:30px;
	text-align:center;
	border:3px solid #000;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$('#torneio').change(function() {
	  window.location = "<?php echo base_url() ?>poker/index/"+ $(this).val(); 
	});
});
</script>
</head>
<body>
<div class="ranking-poker">
	<div class="header">
   	<img src="<?php echo base_url() ?>images/ranking-poker.png" width="221" height="34" alt="Ranking de Torneios do Lol Clube Poker" style="float:left;" />
    <form class="formTorneio" action="<?php echo base_url() ?>poker/torneioAlterar" method="post">
      <label for="torneio" class="labelTorneio">Torneio </label>
       	    <select name="torneio" id="torneio">
            <?php foreach($torneios->result() as $torneio){ ?>
        	    <option value="<?php echo $torneio->id; ?>" <?php if($torneioID == $torneio->id){ ?> selected="selected"<?php } ?> > <?php echo $torneio->nome; ?> - <?php echo $torneio->realizada_etapas; ?>/<?php echo $torneio->total_etapas; ?></option>
            <?php } ?>
      	    </select>
    </form>    
  </div>
  <table class="table-ranking" cellpadding="0" border="0">
  	<tr>
    	<th>Posição</th>
    <th>Foto</th>
        <th>Nome</th>
        <th>Pontos</th>
        <th>Aproveitamento</th>
        <th>Etapas Jogadas</th>
    </tr>
    <?php $i=1; foreach($ranking->result() as $jogador){ ?>
    <tr>
    	<td><?php echo $i; $i++;?>º Lugar</td>
        <td><?php if($jogador->foto){ ?><img src="<?php echo base_url() ?>upload/thumb.php?img=poker/<?php echo $jogador->foto; ?>&w=80" style="margin:-30px;" /><?php } ?></td>
        <td><?php echo $jogador->nome; ?></td>
        <td><?php echo $jogador->pontos_total; ?></td>
        <td><?php echo ($jogador->coeficiente*$jogador->maximo_pontos); //MARGEM=(TOTAL ETAPAS DO TORNEIO / QUANTIDADE DE PARTICIPACAO DO JOGADOR NO TORNEIO) * Maximo Pontos do Torneio ?>%</td>
        <td><?php echo $jogador->total_etapas_jogadas; ?> Etapas</td>
    </tr>
    <?php } ?>
  </table>
</div>
</body>
</html>
