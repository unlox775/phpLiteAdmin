<?php require(dirname($_SERVER['SCRIPT_FILENAME']) .'/ansible-controller.inc.php') ?>
<?php require( $_SERVER['DOCUMENT_ROOT'] . $ctl->SKIN_BASE .'/inc/header.inc.php' ); ?>

<!-- /////  Command output ///// -->
<?php if ( ! empty($view->previous_command ) ) { ?>
	<?php require($stage->extend->run_hook('command_output', 0)) ?>
	<font color=red>
        <h3>Command Output</h3>
        <xmp>> <?php echo $view->previous_command['cmd'] ?>
        <?php echo "\n".$view->previous_command['output'] ?></xmp>
	</font>
	<br><br><a href="project.php?<?php echo $view->project_url_params ?>" style="font-size:70%">&lt;&lt;&lt; Click here to hide Command output &gt;&gt;&gt;</a><br>
	<?php require($stage->extend->run_hook('command_output', 10)) ?>
<?php } ?>

<!-- /////  Actions  ///// -->
<?php /* $view->scoped_include( './project_actions.inc.php', array('project','project_url_params','roll_points') ) */ ?>

<!-- /////  Rollout Process  ///// -->
<h2>Rollout Process</h2>
<div id="rollout_pane">
	<table class="ansible_one">
		<thead>
			<tr>
				<td>Phase</td>
				<td>Current Stage</td>
				<td>Last Roll</td>
				<td>&nbsp;</td>
			</tr>
		</thead>
	
		<tbody>
			<tr id="rollout_dev">
				<td>Development Stage</td>
				<td>O</td>
				<td>2 days ago by dave</td>
				<td><a href="#" onclick="openDrawer('x',$(this).closest('tr'))">Roll</a> | <a href="#">Log</a></td>
			</tr>
			<tr>
				<td>QA Stage</td>
				<td>O</td>
				<td>2 hours ago by dave</td>
				<td><a href="#" onclick="openDrawer('x',$(this).closest('tr'))">Roll</a> | <a href="#">Log</a></td>
			</tr>
			<tr>
				<td>Production Stage</td>
				<td>O</td>
				<td>n/a</td>
				<td><a href="#" onclick="openDrawer('x',$(this).closest('tr'))">Roll</a> | <a href="#">Log</a></td>
			</tr>
		<tbody>
	</table>
	<div id="x" class="drawer" for="rollout_dev"><div class="inner">
		<div class="header_bar">
			<div class="actions">
				<ul>
					<li><label>AutoRoll:</label> <a href="#" class="toggle">ON</a></li>
					<li class="close"><a href="javascript:void(null)" onclick="closeDrawer(this)"><img src="<?php echo $ctl->SKIN_BASE ?>/images/white_close_x.png"/></a></li>
				</ul>
			</div>
			<label>Extracting Revisions from QA Staging: <span class="status">In Process</span></label>
			<span class="retry"><a href="#"><img src="<?php echo $ctl->SKIN_BASE ?>/images/white_retry.png"/></a></span>
		</div>
			
		<div class="output">
			Test Stuff...</br>
			Test Stuff...</br>
			Test Stuff...</br>
			Test Stuff...</br>
			Test Stuff...</br>
			Test Stuff...</br>
			Test Stuff...</br>
			Test Stuff...</br>
			Test Stuff...</br>
			Test Stuff...</br>
			Test Stuff...</br>
			Test Stuff...</br>
			Test Stuff...</br>
			Test Stuff...</br>
			Test Stuff...</br>
			Test Stuff...</br>
			Test Stuff...</br>
		</div>
	</div></div>
</div>

</div>

<?php foreach ($view->project_data as $pdata ) { ?>
	
		<h2>
			Project: <?php echo $pdata['project']->project_name ?> [<?= substr($pdata['project']->get_group(), 0, 2) ?>]
			<a href="project.php?<?php echo $pdata['remove_project_url'] ?>">[X]</a>
		</h2>

	<!-- /////  Affected Files  ///// -->
	<table class="ansible_one">
		<thead>
			<tr>
				<td width="30%">File Name</td>
				<td>Current Status</td>
				<td>Target</td>
				<td>HEAD</td>
				<td>Production</td>
				<td>Changes By</td>
				<td>Action</td>
			</tr>
		</thead>
	
		<tbody>
	    	<?php foreach ( $pdata['files'] as $file ) { ?>
				<tr>
					<td><a href="actions/full_log.php?file=<?php echo urlencode($file['file']) ?>"><?php echo $file['file'] ?></a></td>
					<td><?php echo $file['cur_vers'] ?></td>
					<td><?php echo $file['target_vers'] ?></td>
					<td><?php echo $file['head_vers'] ?></td>
					<td><?php echo $file['prod_test_vers'] ?></td>
					<td><?php echo $file['changes_by'] ?></td>
					<td><?php echo $file['actions'] ?></td>
				</tr>
	    	<?php } ?>
		<tbody>
	</table>
	
	<?php if ( ! empty( $pdata['other_projects'] ) ) { ?>
		<label class="other_projects" style="padding: 15px 10px 0 0; font-weight: bold; display: inline-block">Projects Sharing Files: </label>
		<?php
		  $content = array();
		  foreach ( $pdata['other_projects'] as $pname => $their_files ) {
	          $data = $their_files['data'];  unset( $their_files['data'] );
			  $content[] = ( '<a href="project.php?p='. urlencode($pname)
							 . '" title="Sharing '. count($their_files) .' Files:'. "\n". join("\n", $their_files) .'">'
							 . $pname
							 . ' ['. substr($data['project']->get_group(), 0, 2) .']'
							 . '</a>'
							 . ( $data['included']
								 ? ' <a href="project.php?'. $data['remove_project_url'] .'" style="color: green">[X]</a>'
								 : ( ' <a href="project.php?'. $view->project_url_params .'&p[]='. urlencode($pname) .'"'
									 . '><img src="'. $ctl->SKIN_BASE .'/images/'. ($pdata['project']->get_group() == $data['project']->get_group() ? 'merge_arrow.png' : 'gray_merge_arrow.png') .'"/></a>'
									 )
								 )
	                         );
		  }
		  echo join(', ', $content);
		?>
	<?php } ?>

	<?php if ( $pdata['project']->file_exists("summary.txt") ) { ?>
		<!-- /////  Summary File  ///// -->
		<h3>Summary</h3>
		<pre>
			<?php echo $pdata['project']->get_file("summary.txt"); ?>
		</pre>
	<?php } ?>
<?php } ?>
<!-- /////  If there were any locally modified files, then  ///// -->
<!-- /////  DISABLE Updating until they are fixed  ///// -->
<?php if ( $view->locally_modified ) { ?>
	<script type="text/javascript">
	disable_actions = 1;
	</script>
<?php } ?>


<?php require( $_SERVER['DOCUMENT_ROOT'] . $ctl->SKIN_BASE .'/inc/footer.inc.php' ); ?>
