<?php include(dirname(__FILE__).'/controller.inc.php'); ?>
<?php include($_SERVER['DOCUMENT_ROOT'].$view->controller->SKIN_BASE.'/inc/nav_header.inc.php'); ?><ul>

<div>
	<label>Databases</label>
	<select name="database" onchange="location.href = '<?= $ctl->url_prefix ?>tables_nav.php?db='+ escape($(this).val());">
		<option value="">-- Choose a Database --</option>
		<?php foreach ( $view->databases as $database ) { ?>
			<option value="<?php echo $database ?>" <?php echo ( isset($view->database) && $view->database == $database ) ? 'selected="selected"' : '' ?>><?php echo $database ?></option>
		<?php } ?>
	</select>
</div>

<?php if ( isset($view->database) ) { ?>
	<ul>
		<?php foreach ( $view->tables as $table ) { ?>
			<li>
				<a href="<?= $ctl->url_prefix ?>table/browse.php?<?php echo    http_build_query(array( 'db' => $view->database, 'table' => $table )) ?>" target="browser">[B]</a>
				<a href="<?= $ctl->url_prefix ?>table/structure.php?<?php echo http_build_query(array( 'db' => $view->database, 'table' => $table )) ?>" target="browser"><?php echo $table ?></a>
			</li>
		<?php } ?>
	</ul>
<?php } ?>
<?php include($_SERVER['DOCUMENT_ROOT'].$view->controller->SKIN_BASE.'/inc/nav_footer.inc.php'); ?>
