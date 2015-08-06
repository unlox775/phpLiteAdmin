<? include($_SERVER['DOCUMENT_ROOT'].'/controller.inc.php'); ?>
<? include($_SERVER['DOCUMENT_ROOT'].$view->controller->SKIN_BASE.'/inc/browser_header.inc.php'); ?><ul>

<table>
	<thead>
		<tr>
			<td>&nbsp;</td>
			<? foreach( array_keys( $view->data[0] ) as $col ) { ?>
				<td style="padding: 8px"><?= $col ?></td>
			<? } ?>
		</tr>
	</thead>
	<tbody>
		<? foreach ( $view->data as $i => $data_row ) { ?>
			<tr>
				<td>
					<? if ( ! empty( $data_row['__select_info']['pkey'] ) ) { ?>
						<a href="/table/edit_row.php?<?=    http_build_query(array( 'db' => $data['database'], 'table' => $table, 'pkey' => $data_row['__select_info']['pkey'] )) ?>">[Edit]</a>
					<? } else { ?>
					    <?= $i+1 ?>.
					<? } ?>
				</td>
				<? foreach( $data_row as $col => $value ) { ?>
					<td class="data_<?= $col ?>"><?= $value ?></td>
				<? } ?>
			</tr>
		<? } ?>
	</tbody>
</table>

<? include($_SERVER['DOCUMENT_ROOT'].$view->controller->SKIN_BASE.'/inc/browser_footer.inc.php'); ?>
