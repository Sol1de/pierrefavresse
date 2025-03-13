<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pierrefavresse
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

    <header id="masthead" class="header">

        <div class="header-content">
            
            <!-- Burger -->
            <input type="checkbox" id="menu_checkbox" class="header-content-button" onclick="manageNav()">
            <label for="menu_checkbox" id="label_checkbox">
                <div></div>
                <div></div>
                <div></div>
            </label>

            <?php wp_nav_menu([
                'theme_location' => 'header',
                'container' => 'nav',
                'container_class' => 'header-content-burger',
                'menu_class' => false,
            ]) ?>

            <!-- Logo -->
            <p class='header-content-logo'>Pierre Favresse</p>

            <!-- Navigation -->
            <?php wp_nav_menu([
                'theme_location' => 'header',
                'container' => 'nav',
                'container_class' => 'header-content-nav',
                'menu_class' => false,
            ]) ?>
        </div>
    </header><!-- #masthead -->