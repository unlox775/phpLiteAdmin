<?php include(dirname(__FILE__).'/controller.inc.php'); ?>
<?php include($_SERVER['DOCUMENT_ROOT'].$view->controller->SKIN_BASE.'/inc/browser_header.inc.php'); ?><ul>

<table>
	<thead>
		<tr>
			<td>Database Name</td>
			<td>Actions</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ( $view->databases as $database => $data ) { ?>
			<tr>
				<td><a href="/table_list.php?<?php echo http_build_query(array( 'db' => $data['database'] )) ?>" target="browser"><?php echo $database ?></a></td>
				<td><?php echo $data['table_count'] ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<?php include($_SERVER['DOCUMENT_ROOT'].$view->controller->SKIN_BASE.'/inc/browser_footer.inc.php'); ?>
