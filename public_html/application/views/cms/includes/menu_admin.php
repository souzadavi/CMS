<div id="menu">
    <ul id="lista_menu">
        <?php if($this->uri->segment(2)=="inicial") { ?>
        <li><div id="item">
                <div class="item_esq"></div>
                <div class="item_centro"><span class="item_sel_titulo">Inicial</span></div>
                <div class="item_dir"></div>
            </div></li>
            <?php }else { ?>
        <li><a href="inicial" title="Inicial">Inicial</a></li>
            <?php } ?>
            
        <?php foreach($menuLinks as $menuLink){ ?>
			<?php $urlAtual = explode("/",$menuLink->url); if($this->uri->segment(2)== $urlAtual[0]) { ?>
            <li><div id="item">
                    <div class="item_esq"></div>
                    <div class="item_centro"><span class="item_sel_titulo"><a href="<?php echo $menuLink->url; ?>" title="<?php echo $menuLink->nome; ?>" style="color:#848484;"><?php echo $menuLink->nome; ?></a></span></div>
                    <div class="item_dir"></div>
                </div></li>
                <?php }else { ?>
            <li><a href="<?php echo $menuLink->url; ?>" title="<?php echo $menuLink->nome; ?>"><?php echo $menuLink->nome; ?></a></li>
            <?php } ?>
     	<?php } ?>
    </ul>
</div>