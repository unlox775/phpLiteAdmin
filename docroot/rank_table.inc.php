<div id="<?= $view->id ?>" class="ranktable" <?= $view->active ? '' : 'style="display: none"' ?>>

	<table class="sortable tablesorter" width="100%">
		<thead>
			<th>Rank</th>
			<th>Team</th>
			<th>Win/Loss</th>
			<th>Conference Win/Loss</th>
			<th>Str. of Schedule</th>
			<th>Overall Rank</th>
		</thead>
		<tbody>
			<? foreach ( $view->ranking as $team ) { ?>
			    <?php
				  if ( $view->conference->conf_id !== 'all' && $view->conference->conf_id != $team['conf_id'] )
					  continue;
				?>
				<tr>
					<td><?= ( $view->conference->conf_id == 'all' ) ? $team['overall_rank'] : $team['conf_rank'] ?></td>
					<td><?= $team['team_name'] ?></td>
					<td><?= $team['win']     ?>&nbsp;/&nbsp;<?= $team['loss']     ?></td>
					<td><?= $team['conf_win'] ?>&nbsp;/&nbsp;<?= $team['conf_loss'] ?></td>
					<td><? printf('%.4f',$team['str_of_schedule']) ?></td>
					<td><?= $team['overall_rank'] ?></td>
				</tr>
			<? } ?>
		</tbody>
	</table>
</div>
