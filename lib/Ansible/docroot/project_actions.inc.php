<?php

function get_relative_time($date) {
	$diff = time() - $date;
	if ($diff<60)
		return $diff . " sec" . ($diff != 1 ? 's' : '') . " ago";
	$diff = round($diff/60);
	if ($diff<60)
		return $diff . " min" . ($diff != 1 ? 's' : '') . " ago";
	$diff = round($diff/60);
	if ($diff<24)
		return $diff . " hr" . ($diff != 1 ? 's' : '') . " ago";
	$diff = round($diff/24);
	if ($diff<7)
		return $diff . " day" . ($diff != 1 ? 's' : '') . " ago";
	$diff = round($diff/7);
	if ($diff<4)
		return $diff . " wk" . ($diff != 1 ? 's' : '') . " ago";
	return "on " . date("F j, Y", strtotime($date));
}

?>

<!-- /////	Actions ///// -->
<table width="100%" border=0 cellspacing=0 cellpadding=0>
	<tr>
		<td align="left" valign="top">
			<?php if ( $stage->read_only_mode() ) { ?>
				<h3>Actions</h3>
				<i>You must log in as a privileged user to perform $repo->display_name actions.	 Sorry.</i>
			<?php } else { ?>
				<h3>Actions</h3>
				Update to: <a href="javascript: confirmAction('UPDATE','actions/update.php?<?php echo $view->project_url_params ?>&tag=Target')"	>Target</a>
							 | <a href="javascript: confirmAction('UPDATE','actions/update.php?<?php echo $view->project_url_params ?>&tag=HEAD')"		>HEAD</a>
							 | <a href="javascript: confirmAction('UPDATE','actions/update.php?<?php echo $view->project_url_params ?>&tag=PROD_TEST')">Production</a>
				<br>Tag as:	   <a href="javascript: confirmAction('TAG',   'actions/tag.php?<?php echo $view->project_url_params ?>&tag=PROD_TEST')"	  >Production</a>
			<?php } ?>
		</td>

		<td align="left" valign="top">
			<!-- /////	Rollout process for different phases  ///// -->
			<?php if ( $stage->onAlpha() ) { ?>
				<h3>Rollout Process</h3>
				When you are ready, review the below file list to make sure:
				<ol>
					<li>All needed code and display logic files are here</li>
					<li>Any needed database patch scripts are listed (if any)</li>
					<li>In the "Current Status" column everything is "Up-to-date"</li>
					<li>In the "Changes by" column, they are all ychanges</li>
				</ol>
				Then, tell QA and they will continue in the <a href="<?php echo $stage->get_area_url('beta','project.php') ?>">QA Staging Area</a>
			<?php } else if ( $stage->onBeta() ) { ?>
				<?php if ( $stage->read_only_mode() ) { ?>
					<h3>Rollout Process - QA STAGING PHASE</h3>
					<b>Step 1</b>: Once developer is ready, Update to Target<br>
					<b>Step 2</b>: <i> -- Perform QA testing -- </i><br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Step 2a</b>: For minor updates, Update to Target again<br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Step 2b</b>: If major problems, Roll back to Production Revisions<br>
					<b>Step 3</b>: When everything checks out, Create Rollout Point<br>
					<br>
					Then, <a href="<?php echo $stage->get_area_url('live','project.php') ?>">Switch to Live Production Area</a>
				<?php } else { ?>
					<h3>Rollout Process - QA STAGING PHASE</h3>
					<b>Step 1</b>: Once developer is ready, <a href="javascript: confirmAction('UPDATE','actions/update.php?<?php echo $view->project_url_params ?>&tag=Target&set_group=01_staging')"	  >Update to Target</a><br>
					<b>Step 2</b>: <i> -- Perform QA testing -- </i><br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Step 2a</b>: For minor updates, <a		 href="javascript: confirmAction('UPDATE','actions/update.php?<?php echo $view->project_url_params ?>&tag=Target')"   >Update to Target again</a><br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Step 2b</b>: If major problems, <a		 href="javascript: confirmAction('UPDATE','actions/update.php?<?php echo $view->project_url_params ?>&tag=PROD_TEST&set_group=00_none')">Roll back to Production Revisions</a><br>
					<b>Step 3</b>: When everything checks out, <a href="javascript: confirmAction('TAG',   'actions/tag.php?<?php echo $view->project_url_params ?>&tag=rollout&set_group=03_testing_done')"		>Create Rollout Point</a><br>
					<br>
					Then, <a href="<?php echo $stage->get_area_url('live','project.php') ?>">Switch to Live Production Area</a>
				<?php } ?>
			<?php } else if ( $stage->onLive() ) { ?>
				<?php if ( $stage->read_only_mode() ) { ?>
					<h3>Rollout Process - LIVE PRODUCTION PHASE</h3>
					Check that in the "Current Status" column there are <b><u>no <b>"Locally Modified"</b> or <b>"Needs Merge"</b> statuses</u></b>!!
					<br>
					<b>Step 5</b>: Then to roll it all out, Update to [CHOOSE ROLLBACK POINT]<br>
					<b>Step 6</b>: <i> -- Perform QA testing -- </i><br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Step 6a</b>: If any problems, Roll back to [CHOOSE ROLLBACK POINT]<br>
					Then, go back to the <a href="<?php echo $stage->get_area_url('beta','project.php') ?>">QA Staging Area</a> and continue with <b>Step 1</b> or <b>Step 2</b>.
				<?php } else { ?>
					<h3>Rollout Process - LIVE PRODUCTION PHASE</h3>
					Check that in the "Current Status" column there are <b><u>no <b>"Locally Modified"</b> or <b>"Needs Merge"</b> statuses</u></b>!!
					<br>
					<?php
					  ///  Rollback Steps
					  $ro_points = array(); foreach ( $view->roll_points as $point ) if ( $point->point_type == 'rollout' ) $ro_points[] = $point;
					?>
					<form onSubmit="confirmAction('UPDATE','actions/update.php?<?php echo $view->project_url_params ?>&tag='+ $('#step5_tag').val() +'&set_group=05_rolled_out'); return false;">
					<b>Step 5</b>:
					<?php if ( ! empty( $ro_points ) ) { ?>
					    Then to roll it all out, use
						<select name="tag" id="step5_tag">
							<?php foreach ( $ro_points as $point ) { ?>
								<option value="RP-<?php echo $point->rlpt_id ?>">
									<?php echo ( ($point->point_type == 'prod_rollback' ? 'Safe Rollback Point' : 'Rollout Point') .' ('. count($point->files) .' files) by '. $point->created_by ) ?>
									(<?php echo get_relative_time( $point->creation_date ) ?>)
								</option>
							<?php } ?>
						</select>
						<input type="submit" value="Go"/>
					<?php } else { ?>
						<i>No rollout points yet for these projects.</i>
					<?php } ?>
					</form><br>

					<b>Step 6</b>: <i> -- Perform QA testing -- </i><br>

					<?php
					  ///  Rollback Steps
					  $rb_points = array(); foreach ( $view->roll_points as $point ) if ( $point->point_type == 'prod_rollback' ) $rb_points[] = $point;
					?>
					<form onSubmit="confirmAction('UPDATE','actions/update.php?<?php echo $view->project_url_params ?>&tag='+ $('#step6a_tag').val() +'&set_group=03_testing_done'); return false;">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Step 6a</b>:
					<?php if ( ! empty( $rb_points ) ) { ?>
						If any problems, roll back to
						<select name="tag" id="step6a_tag">
							<?php foreach ( $rb_points as $point ) { ?>
								<option value="RP-<?php echo $point->rlpt_id ?>">
									<?php echo ( ($point->point_type == 'prod_rollback' ? 'Safe Rollback Point' : 'Rollout Point') .' ('. count($point->files) .' files) by '. $point->created_by ) ?>
									(<?php echo get_relative_time( $point->creation_date ) ?>)
								</option>
							<?php } ?>
						</select>
						<input type="submit" value="Go"/>
					<?php } else { ?>
						<i>No rollback points as these projects have not yet had a rollout.</i>
					<?php } ?>
					</form><br/>
					Then, go back to the <a href="<?php echo $stage->get_area_url('beta','project.php') ?>">QA Staging Area</a> and continue with <b>Step 1</b> or <b>Step 2</b>.
				<?php } ?>
			<?php } ?>
		</td>
	</tr>
</table>
