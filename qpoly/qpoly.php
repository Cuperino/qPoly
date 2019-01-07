<?php
/*
Plugin Name: qPoly
Plugin URI: https://javiercordero.info/software/qpoly
Version: 1.2
Description: Polylang extension allows using Polylang similar to how you use qTranslate.
Author: Javier O. Cordero Pérez
Author URI: https://javiercordero.info
License: GPLv2 or later
*/
/*
 * Copyright 2015-2019 Javier Oscar Cordero Pérez
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 *
 */

function qpoly_language_shortcode( $atts, $content = null )
{
    // Get shortcode attribute.
    $a = shortcode_atts( array(
        'lang' => 'en'  // Defaults to English.
    ), $atts );

    // If Polylang is active, get the page's language in slug form.
    $pageLang = '';
    if( function_exists( 'pll_current_language' ) )
        $pageLang = pll_current_language();
    else
        echo('Error: qPoly needs Polylang to be active in order to work.');

    // If pageLang matches the lang argument, show content.
    if( $pageLang == $a['lang'] )
        return do_shortcode( $content );

    // Otherwise show nothing.
    return '';
}
add_shortcode( 'qpoly', 'qpoly_language_shortcode' );

function qpoly_display_dependency_alert()
{
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php _e( 'You must activate the Polylang plugin for qPoly to work!', 'activate-polylang' ); ?></p>
    </div>
    <?php
}

function qpoly_test_for_polylang_dependency() 
{
    if( ! is_plugin_active('polylang/polylang.php') )
        add_action( 'admin_notices', 'qpoly_display_dependency_alert' );
}
add_action( 'admin_init', 'qpoly_test_for_polylang_dependency' );

?>
