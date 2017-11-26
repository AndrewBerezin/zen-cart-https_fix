<?php
/**
 * https_fix
 *
 * @package initSystem
 * @copyright Copyright 2004-2017 Andrew Berezin eCommerce-Service.com
 * @copyright Copyright 2003-2017 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_https_fix.php, 1.1.2 26.11.2017 8:55:06 AndrewBerezin $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

if (substr(HTTP_SERVER, 0, 8) == 'https://' && $request_type != 'SSL') {

  function https_fix_ob_callback($content) {
    $http_server = str_replace('https://', 'http://', HTTP_SERVER);
    $content = str_replace(HTTP_SERVER, $http_server, $content);
    $content = str_replace('href="' . $http_server, 'href="' . HTTP_SERVER, $content);
    $content = str_replace('<base href="' . HTTP_SERVER, '<base href="' . $http_server, $content);
    return $content;
  }

  $ob_start = ob_start('https_fix_ob_callback');

}

// EOF