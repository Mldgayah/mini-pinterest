<?php
/*
 * TP PHP
 * Vue alert
 *
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 *
 * alerts: http://www.w3schools.com/bootstrap/bootstrap_alerts.asp
 */

if(isset($alert))
{
?>
	<div class="alert alert-<?= isset($alert['classeAlert']) ? $alert['classAlert'] : 'danger' ?>">
		<strong><?= $alert['messageAlert'] ?></strong>
	</div>
<?php
}
