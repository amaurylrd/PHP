<?php
$title = 'e-Mento';
?>
<header>
    <div id="bar"></div>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  		<span class="navbar-brand mb-0 h1"><?=$title ?></span>
  		<div class="collapse navbar-collapse" id="navbarSupportedContent">
    		<ul class="navbar-nav mr-auto">
      			<li class="nav-item">
                    <?=anchor('#top', "Accueil", array('class' => 'nav-link')); ?>
                </li>
      			<li class="nav-item">
                    <?=anchor('welcome/load/contact_form', "Contact", array('class' => 'nav-link')); ?>
                </li>
      			<li class="nav-item">
                    <?php 
                        $css = 'nav-link '.$access;
                        if ($access === '')
                            echo anchor('welcome/load/param', "Paramètres Compte", array('class' => $css));
                        else
                            echo anchor('', "Paramètres Compte", array('class' => $css));
                         
                    ?>
                </li>
    		</ul>
    		<div class="my-2 my-lg-0">
                <?=anchor('#insert', "S'inscrire", array('class' => 'anchor')); ?>
                <?=anchor($action, $value); ?>
    		</div>
  		</div>
	</nav>
</header>
<style>
    .anchor {
        visibility:<?=$display ?>;
    }
</style>