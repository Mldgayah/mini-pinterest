<?php
/*
 * MODULE DE PHP
 * Controller page 404
 *
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

$alert = choixAlert('url_non_valide');

//appel de la vue
require_once(PATH_VIEWS.$page.'.php');
