<? header('Content-Type; text/html'); include($_SERVER['DOCUMENT_ROOT'].'/controller.inc.php'); ?>
<script type="text/javascript">
var cur_database = null;
</script>
<frameset cols="280,*">
	<frame name="table_nav" src="tables_nav.php" frameborder=1/>
	<frame name="browser" src="database_list.php"/>
</frameset>
