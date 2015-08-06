			<h3>Trial Ranking</h3>

			<form action="trial.php" method="GET">
				<?php
				  ///  Starting Values
				  $str_sched = 30;
				  $win_loss = 30;
				  $mgn_victory = 40;
				  
				  ///  array values: value, min, max, step
				  $home_field	= array(3.25, 3,  3.5, 0.01);
				  $low_division = array(0.2,  0,  0.3, 0.01);
				  $rank_mult	= array(70,	  50, 120, 1   );
				  $rank_expon	= array(1.5,  0,  3,   0.01);
				?>
				<script type="text/javascript">
					$(function() {
						$('body').append('<div id="hoverlabel" style="width:50px; border: 1px solid #ccc; text-align: center; position: absolute; background: white; display: none">0</div>');
						$('#primary_weights').slider({ values: [<?= $str_sched ?>, <?= $str_sched + $win_loss ?>],
													   min: 0,
													   max: 100,
													   change: function(event, ui) {
														   var index = $(ui.handle).index();
														   ///	Don't let handles cross
														   if ( index === 0 ) {
															   if ( $(this).slider('values',0) >= $(this).slider('values',1) )
																   $(this).slider('values',0,$(this).slider('values',1)-1);
														   } else if ( index === 1 ) {
															   if ( $(this).slider('values',1) <= $(this).slider('values',0) )
																   $(this).slider('values',1,$(this).slider('values',0)+1);
														   }
														   refresh_triad();
													   },
													   start: function(event, ui) {
														   var pos = $(ui.handle).offset();
														   $('#hoverlabel').css({top: (pos.top - 25) +'px', left: (pos.left -16) +'px'}).show()
														   .html( $('#primary_weights').slider('values', $(ui.handle).index()) - ($(ui.handle).index() == 1 ? $('#primary_weights').slider('values', 0) : 0) );
														   
														   var index = $(ui.handle).index();
													   },
													   slide: function(event, ui) {
														   var pos = $(ui.handle).offset();
														   $('#hoverlabel').css({top: (pos.top - 25) +'px', left: (pos.left -16) +'px'})
														   .html( $('#primary_weights').slider('values', $(ui.handle).index()) - ($(ui.handle).index() == 1 ? $('#primary_weights').slider('values', 0) : 0) );
														   refresh_triad();
													   },
													   stop: function(event, ui) {
														   $('#hoverlabel').hide();
														   refresh_triad();
													   }
													 });
						<? foreach( array('home_field','low_division','rank_mult','rank_expon') as $var ) { ?>
							$( '#<?= $var ?>' ).slider({ value: <?= ${ $var }[0] ?>,
														 min:	<?= ${ $var }[1] ?>,
														 max:	<?= ${ $var }[2] ?>,
														 step:	<?= ${ $var }[3] ?>,
														 change: function(event,ui) {
															 $( '#<?= $var ?>_input' ).val($( '#<?= $var ?>' ).slider('value'));
															 $( '#<?= $var ?>_value' ).html($( '#<?= $var ?>' ).slider('value'));
														 },
														 slide: function(event,ui) {
															 $( '#<?= $var ?>_input' ).val($( '#<?= $var ?>' ).slider('value'));
															 $( '#<?= $var ?>_value' ).html($( '#<?= $var ?>' ).slider('value'));
														 }
													   });
						<? } ?>
					});
				  function refresh_triad() {
					  $('#str_sched_input'	).val($('#primary_weights').slider('values',0));
					  $('#win_loss_input'	).val($('#primary_weights').slider('values',1) - $('#primary_weights').slider('values',0));
					  $('#mgn_victory_input').val(100 - $('#primary_weights').slider('values',1));

					  $('#str_sched_value'	).html($('#primary_weights').slider('values',0));
					  $('#win_loss_value'	).html($('#primary_weights').slider('values',1) - $('#primary_weights').slider('values',0));
					  $('#mgn_victory_value').html(100 - $('#primary_weights').slider('values',1));

					  $( '#str_sched_input'	  ).val($('#str_sched_value'  ).html());
					  $( '#win_loss_input'	  ).val($('#win_loss_value'	  ).html());
					  $( '#mgn_victory_input' ).val($('#mgn_victory_value').html());
				  }
				</script>

				<h4>Primary Weights</h4>
				<div id="primary_weights"></div>
				<div class="row">
					<input type="hidden" id="str_sched_input" name="str_sched" value="<?= $str_sched ?>">
					<div class="ten mobile-one columns">
						<label>Strength of Schedule: <span id="str_sched_value"><?= $str_sched ?></span>%</label>
					</div>
				</div>
				<div class="row">
					<input type="hidden" id="win_loss_input" name="win_loss" value="<?= $win_loss ?>">
					<div class="two mobile-one columns"></div>
					<div class="eight mobile-one columns">
						<label>Wins / Losses: <span id="win_loss_value"><?= $win_loss ?></span>%</label>
					</div>
				</div>
				<div class="row">
					<input type="hidden" id="mgn_victory_input" name="mgn_victory" value="<?= $mgn_victory ?>">
					<div class="eleven mobile-one columns">
						<label class="right">Margin of Victory: <span id="mgn_victory_value"><?= $mgn_victory ?></span>%</label>
					</div>
				</div>

				<h4>Home Field Factor</h4>
				<div class="row">
					<input type="hidden" id="home_field_input" name="home_field" value="<?= $home_field[0] ?>">
					<div class="nine columns slider_left">
						<div id="home_field"></div>
					</div>
					<div class="two columns slider_value" id="home_field_value">
						<?= $home_field[0] ?>
					</div>
				</div>
				<h4>Low Division Factor</h4>
				<div class="row">
					<input type="hidden" id="low_division_input" name="low_division" value="<?= $low_division[0] ?>">
					<div class="nine columns slider_left">
						<div id="low_division"></div>
					</div>
					<div class="two columns slider_value" id="low_division_value">
						<?= $low_division[0] ?>
					</div>
				</div>
				<h4>Rank Score Multiplier</h4>
				<div class="row">
					<input type="hidden" id="rank_mult_input" name="rank_mult" value="<?= $rank_mult[0] ?>">
					<div class="nine columns slider_left">
						<div id="rank_mult"></div>
					</div>
					<div class="two columns slider_value" id="rank_mult_value">
						<?= $rank_mult[0] ?>
					</div>
				</div>
				<h4>Rank Score Exponential</h4>
				<div class="row">
					<input type="hidden" id="rank_expon_input" name="rank_expon" value="<?= $rank_expon[0] ?>">
					<div class="nine columns slider_left">
						<div id="rank_expon"></div>
					</div>
					<div class="two columns slider_value" id="rank_expon_value">
						<?= $rank_expon[0] ?>
					</div>
				</div>
				
				<div class="row" style="margin-top: 15px;">
					<div class="right"><button type="submit" class="small blue button">Rank Teams</button></div>
				</div>
			</form> 
