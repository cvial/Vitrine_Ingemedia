<?php

    require 'includes/master.inc.php';

    $categorie = Categorie::find('all');
    $formation = Formation::find('all');


    $tpl->assign('categorie', $categorie);
    $tpl->assign('formation', $formation);

    $tpl->assign('title', 'Accueil');
    $tpl->display('home.tpl');

?>
