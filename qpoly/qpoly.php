<?php
/*
Plugin Name: qPoly
Version: 1.1
Description: Polylang extension allows using Polylang similar to how you use qTranslate.
Author: Javier O. Cordero Pérez
Author URI: mailto:javier.cordero@upr.edu
*/

/*
 * Copyright 2015 Javier Oscar Cordero Pérez
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

function qpolylang_func( $atts, $content = null )
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
        echo('Error: qPolylang needs Polylang to be active in order to work.');

    // If pageLang matches the lang argument, show content.
    if( $pageLang == $a['lang'] )
        return do_shortcode( $content );

    // Otherwise show nothing.
    return '';
}
add_shortcode( 'qpoly', 'qpolylang_func' );
?>