<?php include($_SERVER['DOCUMENT_ROOT'].'/controller.inc.php'); ?>
<?php include($_SERVER['DOCUMENT_ROOT'].$view->controller->SKIN_BASE.'/inc/browser_header.inc.php'); ?><ul>

<table>
	<thead>
		<tr>
			<td>Table Name</td>
			<td>Rows</td>
			<td>Actions</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ( $view->tables as $table => $data ) { ?>
			<tr>
				<td><a href="/table/structure.php?<?php echo http_build_query(array( 'db' => $view->database, 'table' => $table )) ?>" target="browser"><?php echo $table ?></a></td>
				<td><?php echo $data['row_count'] ?></td>
				<td><a href="/table/browse.php?<?php echo    http_build_query(array( 'db' => $view->database, 'table' => $table )) ?>" target="browser">[B]</a></td>
				<td><a href="/table/structure.php?<?php echo http_build_query(array( 'db' => $view->database, 'table' => $table )) ?>" target="browser">[Structure]</a></td>
				<td><a href="/table/select.php?<?php echo    http_build_query(array( 'db' => $view->database, 'table' => $table )) ?>" target="browser">[Search]</a></td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<?php include($_SERVER['DOCUMENT_ROOT'].$view->controller->SKIN_BASE.'/inc/browser_footer.inc.php'); ?>
