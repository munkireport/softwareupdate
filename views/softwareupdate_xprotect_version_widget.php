	<div class="col-lg-4 col-md-6">
	<div class="panel panel-default" id="softwareupdate-xprotect_version-widget">
		<div class="panel-heading" data-container="body" >
			<h3 class="panel-title"><i class="fa fa-shield"></i>
			    <span data-i18n="softwareupdate.xprotect_version"></span>
			    <list-link data-url="/show/listing/softwareupdate/softwareupdate"></list-link>
			</h3>
		</div>
		<div class="list-group scroll-box"></div>
	</div><!-- /panel -->
</div><!-- /col -->

<script>
$(document).on('appUpdate', function(e, lang) {
	
	var box = $('#softwareupdate-xprotect_version-widget div.scroll-box');
	
	$.getJSON( appUrl + '/module/softwareupdate/get_xprotect_version', function( data ) {
		
		box.empty();
		if(data.length){
			$.each(data, function(i,d){
				var badge = '<span class="badge pull-right">'+d.count+'</span>';
                box.append('<a href="'+appUrl+'/show/listing/softwareupdate/softwareupdate#'+d.xprotect_version+'" class="list-group-item">'+d.xprotect_version+badge+'</a>')
			});
		}
		else{
			box.append('<span class="list-group-item">'+i18n.t('softwareupdate.no_data')+'</span>');
		}
	});
});	
</script>
