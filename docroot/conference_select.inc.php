<div class="row">
	<div class="two columns">
		Choose a Conference:
	</div>
	<div class="ten columns">
		<select <?= $view->input_attrs('select','conf_id') ?>
				onchange="$('.<?= $view->target_prefix ?>').hide();  $('#<?= $view->target_prefix ?>_'+ $(this).val()).show();"
				>
			<? foreach ($view->conferences as $conference ) { ?>
				<option <?= $view->input_attrs('option','conf_id',null, $conference->conf_id ) ?>>
					<?= $conference->conference_name ?>
				</option>
			<? } ?>
		</select>
	</div>
</div>
