<?php

/*
Plugin Name: merch.systems Storefront
Version: 1.0.0
Description: Fully integrates your merch.systems online store into your Wordpress website
Plugin URI: https://merch.systems
Author: anti-design.com GmbH & Co. KG
Author URI: http://anti-design.com

@package merchsys
@subpackage merchsys/public
 */

class MerchSysStore_Settings extends MerchSys_Settings
{

    const PLUGIN_NAME = 'merch-systems-store';
    const PLUGIN_VERSION = '1.0.0';

    /* Shortcodes definitions */
    const SHOP_SHORTCODE = 'merchsys_shop';
    const REGISTRATION_SHORTCODE = 'merchsys_registration';

    /* Strings definitions */
    const DEFAULT_TITLE = 'Online shop';

    const DEFAULT_MENU_ITEM_WRAPPER = '<li class="menu-item %c"><a href="%l">%t</a></li>'; // bookberlyn to add '<li class="menu-item"><a href="%l"><span class="text">%t</span> <span class="amount"><i class="fa fa-shopping-basket">%a</i></span></a></li>'
    const DEFAULT_BASKET_ITEM_WRAPPER = '<li class="menu-item %c"><a href="%l">%t (%a)</a></li>'; // bookberlyn to add '<li class="menu-item"><a href="%l"><span class="text">%t</span> <span class="amount"><i class="fa fa-shopping-basket">%a</i></span></a></li>'

    const CONTEXT_REGISTRATION_PAGE = 'registration';
    const CONTEXT_REGISTRATION = 're';
    const CONTEXT_SHOP_PAGE = 'browse';
    const CONTEXT_SHOP = 'sh';
}
