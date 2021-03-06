<?php require(dirname($_SERVER['SCRIPT_FILENAME']) .'/ansible-controller.inc.php') ?>
<?php $view->scoped_include( $_SERVER['DOCUMENT_ROOT'] . $ctl->SKIN_BASE .'/inc/header.inc.php' ); ?>

<!-- /////  List of projects  ///// -->
<h3>List of <?= ( $view->category == 'archived' ? 'Archived' : '' ) ?> Projects</h3>

<form action="project.php" method="GET">
<?php foreach ( array_keys( $view->projects ) as $group ) { ?>
	<h2><?= ( isset( $view->groups[$group] ) ? $view->groups[$group] : $group ) ?></h2>
	<table class="ansible_one">
		<thead>
			<tr>
				<td width="1%"  align="left" class="first">&nbsp;</td>
				<td width="30%" align="left" class="first">Name</td>
				<td align="center" class="hide-on-phones">Created&nbsp;by</td>
				<td align="center" class="hide-on-phones">Modified</td>
				<td align="center"># Files</td>
				<td align="center" class="hide-on-phones">Summary File</td>
				<td align="left">Actions</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $view->projects[ $group ] as $project ) { ?>
				<tr>
					<td>
						<input type="checkbox" name="p[]" value="<?php echo htmlentities( $project['name'] ) ?>"/>
					</td>
					<td>
						<?php echo ( $view->category == 'archived'
						  			 ? $project['name']
						  			 : "<a href=\"project.php?p=". urlencode($project['name']) ."\">". $project['name'] ."</a>"
						) ?>
					</td>
					<td align="center" class="hide-on-phones"><?= $project['creator'] ?></td>
					<td align="center" class="hide-on-phones"><?= $project['mod_time_display'] ?></td>
					<td align="center"><?= $project['aff_file_count'] ?></td>
					<td align="center" class="hide-on-phones"><?= $project['has_summary'] ?></td>
					<td>
						<?= ( $view->category == 'archived'
						      ? "<a href=\"actions/unarchive_project.php?p=". urlencode($project['name']) ."\">Un-Archive</a>"
							  : "<a href=\"project.php?p=". urlencode($project['name']) ."\">View</a> | <a href=\"actions/archive_project.php?p=". urlencode($project['name']) ."\">Archive</a>"
							 )
						?>
					</td>
				</tr>
			<?php } ?>
		<tbody>
	</table>
	<input type="submit" value="View Checked Projects"/>
<?php } ?>
</form>

<?php if ( $view->category != 'archived' ) { ?>
	<p>See list of <a href="?cat=archived">Archived projects</p>
<?php } else  { ?>
	<p>Back to <a href="?">Active projects list</p>
<?php } ?>

<?php $view->scoped_include( $_SERVER['DOCUMENT_ROOT'] . $ctl->SKIN_BASE .'/inc/footer.inc.php' ); ?>
