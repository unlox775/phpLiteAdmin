<? include($_SERVER['DOCUMENT_ROOT'].'/controller.inc.php'); ?>
<? include($_SERVER['DOCUMENT_ROOT'].$view->controller->SKIN_BASE.'/inc/browser_header.inc.php'); ?><ul>

<h2><?= $view->table ?> Columns</h2>
<table>
	<thead>
		<tr>
			<td>&nbsp;</td>
			<td>Column Name</td>
			<td>Data Definition</td>
			<td>Actions</td>
		</tr>
	</thead>
	<tbody>
		<? $i = 1; foreach ( $view->table_cols as $col => $info ) { ?>
			<tr>
				<td><?= $i++ ?>.</td>
				<td><?= $col ?></td>
				<td><?= $info['definition'] ?></td>
				<td><a href="/edit_col.php?<?= http_build_query(array( 'db' => $view->database, 'table' => $table, col => $col )) ?>">[Edit]</td>
			</tr>
		<? } ?>
	</tbody>
</table>

<h2><?= $view->table ?> Indexes</h2>
<table>
	<thead>
		<tr>
			<td>&nbsp;</td>
			<td>Index Name</td>
			<td>Data Definition</td>
		</tr>
	</thead>
	<tbody>
		<? $i = 1; foreach ( $view->table_indexes as $index => $info ) { ?>
			<tr>
				<td><?= $i++ ?>.</td>
				<td><?= $index ?></td>
				<td><?= $info['definition'] ?></td>
			</tr>
		<? } ?>
	</tbody>
</table>


<? include($_SERVER['DOCUMENT_ROOT'].$view->controller->SKIN_BASE.'/inc/browser_footer.inc.php'); ?>
