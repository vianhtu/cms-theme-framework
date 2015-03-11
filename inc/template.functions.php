<?php

add_action('cmssuperheroes-page-title', 'cmssuperheroes_page_title');
function cmssuperheroes_page_title(){
    global $smof_data;
    
    if($smof_data['page_title_layout']){
        ?>
        <div id="page-title" class="page-title">
            <div class="container">
            <div class="row">
            <?php switch ($smof_data['page_title_layout']){
                case '1':
                    ?>
                    <div id="page-title-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><h1><?php CMSSuperHeroes_Base::getPageTitle(); ?></h1></div>
                    <div id="breadcrumb-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php CMSSuperHeroes_Base::getBreadCrumb(); ?></div>
                    <?php
                    break;
                case '2':
                    ?>
                    <div id="breadcrumb-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php CMSSuperHeroes_Base::getBreadCrumb(); ?></div>
                    <div id="page-title-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><h1><?php CMSSuperHeroes_Base::getPageTitle(); ?></h1></div>
                    <?php          
                    break;
                case '3':
                    ?>
                    <div id="page-title-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><h1><?php CMSSuperHeroes_Base::getPageTitle(); ?></h1></div>
                    <div id="breadcrumb-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php CMSSuperHeroes_Base::getBreadCrumb(); ?></div>
                    <?php
                    break;
                case '4':
                    ?>
                    <div id="breadcrumb-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php CMSSuperHeroes_Base::getBreadCrumb(); ?></div>
                    <div id="page-title-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><h1><?php CMSSuperHeroes_Base::getPageTitle(); ?></h1></div>
                    <?php
                    break;
                case '5':
                    ?>
                    <div id="page-title-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><h1><?php CMSSuperHeroes_Base::getPageTitle(); ?></h1></div>
                    <?php
                    break;
                case '6':
                    ?>
                    <div id="breadcrumb-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php CMSSuperHeroes_Base::getBreadCrumb(); ?></div>
                    <?php
                    break;
            } ?>
            </div>
            </div>
        </div>
        <?php
    }
}