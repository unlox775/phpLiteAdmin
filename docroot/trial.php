<? include($_SERVER['DOCUMENT_ROOT'].'/controller.inc.php'); ?>
<? include($_SERVER['DOCUMENT_ROOT'].$view->controller->SKIN_BASE.'/inc/header.inc.php'); ?>

<?php

$view->fill(array('conf_id' => 'all'));

# ///  Temp data hack
# $view->conferences
# = array( (object) array('conf_id' => 'all', 'conference_name' => 'All Conferences' ),
# 		 (object) array('conf_id' => 1,     'conference_name' => 'East Conference' ),
# 		 (object) array('conf_id' => 2,     'conference_name' => 'Narnia Conference' ),
# 		 );
# 
# $view->ranking
# = array( array('team_id' => 2, 'conf_id' => 1, 'rank' => 1, 'team_name' => 'Werewolves',  'win_conf' => 1, 'loss_conf' => 3, 'win' => 1, 'loss' => 5, 'str_schedule' => 0.83, 'overall_rank' => 1 ),
# 		 array('team_id' => 3, 'conf_id' => 2, 'rank' => 1, 'team_name' => 'Pixies',      'win_conf' => 3, 'loss_conf' => 1, 'win' => 5, 'loss' => 3, 'str_schedule' => 0.52, 'overall_rank' => 2 ),
# 		 array('team_id' => 4, 'conf_id' => 1, 'rank' => 2, 'team_name' => 'Zombies',     'win_conf' => 2, 'loss_conf' => 2, 'win' => 4, 'loss' => 9, 'str_schedule' => 0.63, 'overall_rank' => 3 ),
# 		 array('team_id' => 5, 'conf_id' => 2, 'rank' => 3, 'team_name' => 'Baby Chicks', 'win_conf' => 1, 'loss_conf' => 3, 'win' => 2, 'loss' => 5, 'str_schedule' => 0.12, 'overall_rank' => 4 ),
# 		 array('team_id' => 8, 'conf_id' => 2, 'rank' => 2, 'team_name' => 'Fireflies',   'win_conf' => 3, 'loss_conf' => 1, 'win' => 1, 'loss' => 4, 'str_schedule' => 0.50, 'overall_rank' => 5 ),
# 		 );

$view->predictor
= array( array('team_id' => 2, 'conf_id' => 1, 'score' => 1, 'team_name' => 'Werewolves',  'opp_team_id' => 8, 'opp_team_name' => 'Fireflies',   'opp_score' => 4, 'game_date' => '2012-07-09', 'game_on_tv' => null               ),
		 array('team_id' => 3, 'conf_id' => 2, 'score' => 1, 'team_name' => 'Pixies',      'opp_team_id' => 4, 'opp_team_name' => 'Zombies',     'opp_score' => 2, 'game_date' => '2012-07-11', 'game_on_tv' => 'http://espn.com/' ),
		 array('team_id' => 4, 'conf_id' => 1, 'score' => 2, 'team_name' => 'Zombies',     'opp_team_id' => 2, 'opp_team_name' => 'Werewolves',  'opp_score' => 5, 'game_date' => '2012-07-08', 'game_on_tv' => null               ),
		 array('team_id' => 5, 'conf_id' => 2, 'score' => 3, 'team_name' => 'Baby Chicks', 'opp_team_id' => 3, 'opp_team_name' => 'Pixies',      'opp_score' => 1, 'game_date' => '2012-07-12', 'game_on_tv' => 'http://abc.com/'  ),
		 array('team_id' => 8, 'conf_id' => 2, 'score' => 2, 'team_name' => 'Fireflies',   'opp_team_id' => 5, 'opp_team_name' => 'Baby Chicks', 'opp_score' => 5, 'game_date' => '2012-07-11', 'game_on_tv' => 'http://espn.com/' ),
		 );

?>

<div class="row">
	<div class="twelve columns">
		<h3>Ranking Results</h3>

		The below ranking is generated by these factors: <a class="tiny blue button" href="javascript:void(null)" onclick="$('#use_factors').toggle()">show factors</a>
		<div id="use_factors" class="row" style="display: none; margin-bottom: 15px">
			<div class="ten columns centered">
				<b>Strength of Schedule:</b>   <?= $view->params['str_sched'] ?></br>
				<b>Win / Loss:</b>             <?= $view->params['win_loss'] ?></br>
				<b>Margin of Victory:</b>      <?= $view->params['mgn_victory'] ?></br>
				<b>Home Field:</b>             <?= $view->params['home_field'] ?></br>
				<b>Low Division:</b>           <?= $view->params['low_division'] ?></br>
				<b>Rank Score Multiplier:</b>  <?= $view->params['rank_mult'] ?></br>
				<b>Rank Score Exponential:</b> <?= $view->params['rank_expon'] ?></br>
			</div>
		</div>

		
		<dl class="tabs three-up contained">
			<dd><a href="#ranking" class="active">Ranking</a></dd>
			<dd><a href="#predictor">Predictor</a></dd>
		</dl>
		<ul class="tabs-content contained">
			<li class="active" id="rankingTab">
				<h3>Team Ranking</h3>
				
				<!--  Rank tables -->
				<?= $view->scoped_include('conference_select.inc.php',array('conferences', 'target_prefix' => 'ranktable')) ?>

				<? foreach ( $view->conferences as $conference ) { ?>
					<?= $view->scoped_include( 'rank_table.inc.php',
					                           array( 'id' => 'ranktable_'. $conference->conf_id,
					                                  'ranking',
													  'conference' => $conference,
													  'active' => ($view->get_fill_value('conf_id') == $conference->conf_id),
					                                  )
                                               ) ?>
				<? } ?>
			</li>
			<li id="predictorTab">
				<h3>Predictions for Games Next Week (starting July 10th)</h3>

				<?= $view->scoped_include('conference_select.inc.php',array('conferences', 'target_prefix' => 'predictortable')) ?>

				<? foreach ( $view->conferences as $conference ) { ?>
					<?= $view->scoped_include( 'predictor_table.inc.php',
					                           array( 'id' => 'predictortable_'. $conference->conf_id,
					                                  'predictor',
													  'conference' => $conference,
													  'active' => ($view->get_fill_value('conf_id') == $conference->conf_id),
					                                  )
                                               ) ?>
				<? } ?>

			</li>
		</ul>
	</div>
</div>

<? include($_SERVER['DOCUMENT_ROOT'].$view->controller->SKIN_BASE.'/inc/footer.inc.php'); ?>