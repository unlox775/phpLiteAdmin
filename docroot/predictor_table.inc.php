<div id="<?= $view->id ?>" class="predictortable" <?= $view->active ? '' : 'style="display: none"' ?>>

	<table class="sortable tablesorter" width="100%">
		<thead>
			<th>Team</th>
			<th>Score</th>
			<th>Playing</th>
			<th>Score</th>
			<th>Game Date</th>
			<th>On TV</th>
		</thead>
		<tbody>
			<? foreach ( $view->predictor as $team ) { ?>
			    <?php
				  if ( $view->conference->conf_id !== 'all' && $view->conference->conf_id != $team['conf_id'] )
					  continue;
				?>
				<tr>
					<td><?= $team['team_name'] ?></td>
					<td><?= $team['score'] ?></td>
					<td><?= $team['opp_team_name'] ?></td>
					<td><?= $team['opp_score'] ?></td>
					<td><?= date('m/d', strtotime($team['game_date'])) ?></td>
					<td>
						<? if ( $team['game_on_tv'] !== null ) { ?>
							<a href="<?= $team['game_on_tv'] ?>">Yes</a>
						<? } else { ?>
							No
						<? } ?>
					</td>
				</tr>
			<? } ?>
		</tbody>
	</table>
</div>
