<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <script type="text/javascript">!function () {
            var e, t, s = {
                basic: "data:image/webp;base64,UklGRjIAAABXRUJQVlA4ICYAAACyAgCdASoCAAEALmk0mk0iIiIiIgBoSygABc6zbAAA/v56QAAAAA==",
                lossless: "data:image/webp;base64,UklGRh4AAABXRUJQVlA4TBEAAAAvAQAAAAfQ//73v/+BiOh/AAA="
            };
            e = function (e) {
                if (!e) {
                    console.log("webp fix"), window.addEventListener("error", function (e, t) {
                        if ("IMG" === e.target.tagName && -1 != e.target.src.indexOf(".webp")) return e.target.src = e.target.src.replace(".webp", ""), e.target.srcset && (e.target.srcset = e.target.srcset.replace(".webp", "")), !0
                    }, !0), document.addEventListener("DOMContentLoaded", function () {
                        for (var e, t = 0; t < document.styleSheets.length; t++) if (e = document.styleSheets[t].cssRules) for (var s = 0; s < e.length; s++) if (e[s].style && e[s].style.backgroundImage && e[s].style.backgroundImage.indexOf(".webp") && (e[s].style.backgroundImage = e[s].style.backgroundImage.replace(".webp", "")), e[s].cssRules) for (var a = 0; a < e[s].cssRules.length; a++) e[s].cssRules[a].style && e[s].cssRules[a].style.backgroundImage && e[s].cssRules[a].style.backgroundImage.indexOf(".webp") && (e[s].cssRules[a].style.backgroundImage = e[s].cssRules[a].style.backgroundImage.replace(".webp", ""));
                        var r = document.querySelectorAll("[style]");
                        for (s = 0; s < r.length; s++) r[s].style["background-image"] && (r[s].style["background-image"] = r[s].style["background-image"].replace(".webp", ""));
                        console.log(r.length)
                    });
                    var t = CSSStyleSheet.prototype.insertRule;
                    CSSStyleSheet.prototype.insertRule = function (e, s) {
                        return e.style && e.style.backgroundImage && e.style.backgroundImage.indexOf(".webp") && (e.style.backgroundImage = e.style.backgroundImage.replace(".webp", "")), t.apply(this, [e, s])
                    }
                }
            }, (t = document.createElement("img")).onerror = function () {
                e(!1)
            }, t.onload = function () {
                2 === this.width && 1 === this.height ? e(!0) : e(!1)
            }, t.setAttribute("src", s.basic)
        }();</script>
    <script type="text/javascript">
        UPLOADCARE_PUBLIC_KEY = 'd09de7e6380498399359';
        UPLOADCARE_LOCALE = 'he';
        UPLOADCARE_TABS = 'url file facebook gdrive instagram';
    </script>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<!--    <script src="https://code.jquery.com/jquery-3.4.1.min.js" charset="utf-8"></script>-->
    <script src="https://ucarecdn.com/libs/widget/3.x/uploadcare.full.min.js"></script>
	<script src="https://ucarecdn.com/libs/widget-tab-effects/1.x/uploadcare.tab-effects.min.js" charset="utf-8"></script>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="wrapper">
    <header id="header">
        <div class="container"><strong class="logo"> <a href="<?php echo home_url(); ?>"> <img
                            src="<?php echo get_template_directory_uri() ?>/images/logo.svg" alt="Craza"/> </a>
            </strong> <a href="#" class="menu-opener" aria-haspopup="true">Menu Opener</a>
            <div class="menu-holder"><strong class="logo menu-logo"> <a href="#"> <img
                                src="<?php echo get_template_directory_uri() ?>/images/logo.svg" alt="Craza"/> </a>
                </strong>
                <?php wp_nav_menu(array(
                    'theme_location' => 'primary_menu',
                    'container' => false,
                    'container_class' => 'menu-holder',
                    'menu_class' => 'menu',
                    'menu_id' => 'main-navigation',
                    'walker'          => new Menu_With_Contact()
                )); ?>
                <?php get_template_part('blocks/social'); ?>
            </div>
        </div>
    </header>
    <div id="main">
        <div class="container">
