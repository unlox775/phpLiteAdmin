
$(document).ready(function(){
});

function openDrawer(drawer_id, target) {
	///  Close any other drawers first...
	var closedDrawer = false;
	$('.drawer.open').each(function(index, elm) {
		if ( $(elm).attr('id') != drawer_id ) {
			closedDrawer = true;
			closeDrawer($(elm).find('> .inner'), function() {
				openDrawer(drawer_id, target);
			});
		}
	});
	if ( closedDrawer ) return false;

	var drawer = $('#'+ drawer_id);
	if ( ! drawer.length || drawer.find('> .inner').length == 0 || drawer.hasClass('open') ) return false;
	if ( ! target ) return false;

	var height = drawer.find('> .inner').height();
	drawer.find('> .inner').css('top', '-'+ height +'px');
	drawer.css({ top : (target.position().top + target.height()) +'px',
                 left : 0
                 });
	drawer.show();
	drawer.find('> .inner').animate({ top: '0px'}, 200, 'swing', function(){});
	drawer.addClass('open');
}

function closeDrawer(drawer_subelm, callback) {
	var drawer = $(drawer_subelm).closest('.drawer');
	if ( ! drawer.length || drawer.find('> .inner').length == 0 ) alert('SORRY');//return false;

	var height = drawer.find('> .inner').height();
	drawer.find('> .inner').animate({ top: '-'+ height +'px'}, 200, 'swing', function(){
		drawer.hide();
		if ( $.isFunction(callback) ) callback();
	});
	drawer.removeClass('open');
}


var disable_actions = 0;

function confirmAction(which,newLocation) {
    //  If locally modified files, diabled actions
    if ( disable_actions ) {
        alert("Some of the below files are locally modified, or have conflicts.  $repo->display_name update actions would possibly conflict the file leaving code files in a broken state.  Please resolve these differences manually (command line) before continuing.\n\nActions are currently DISABLED.");
        return void(null);
    }

    var confirmed = confirm("Please confirm this action.\n\nAre you sure you want to "+which+" these files?");
    if (confirmed) { location.href = newLocation }
}
