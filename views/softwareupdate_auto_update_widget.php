<div class="col-lg-4 col-md-6">
    <div class="panel panel-default" id="su_auto_update-widget">
        <div id="su_auto_update-widget" class="panel-heading" data-container="body">
            <h3 class="panel-title"><i class="fa fa-cubes"></i> 
                <span data-i18n="softwareupdate.auto_update_widget"></span>
                <list-link data-url="/show/listing/softwareupdate/softwareupdate"></list-link>
            </h3>
        </div>
        <div class="panel-body text-center"></div>
    </div><!-- /panel -->
</div><!-- /col -->

<script>
$(document).on('appUpdate', function(e, lang) {

    $.getJSON( appUrl + '/module/softwareupdate/get_auto_update', function( data ) {
        if(data.error){
            //alert(data.error);
            return;
        }

        var panel = $('#su_auto_update-widget div.panel-body'),
        baseUrl = appUrl + '/show/listing/softwareupdate/softwareupdate/';
        panel.empty();
        // Set blocks, disable if zero
        if(data.no != "0"){
            panel.append(' <a href="'+baseUrl+'" class="btn btn-danger"><span class="bigger-150">'+data.no+'</span><br>&nbsp;&nbsp;&nbsp;'+i18n.t('no')+'&nbsp;&nbsp;&nbsp;</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'" class="btn btn-danger disabled"><span class="bigger-150">'+data.no+'</span><br>&nbsp;&nbsp;&nbsp;'+i18n.t('no')+'&nbsp;&nbsp;&nbsp;</a>');
        }
        if(data.yes != "0"){
            panel.append(' <a href="'+baseUrl+'" class="btn btn-success"><span class="bigger-150">'+data.yes+'</span><br>&nbsp;&nbsp;'+i18n.t('yes')+'&nbsp;&nbsp;</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'" class="btn btn-success disabled"><span class="bigger-150">'+data.yes+'</span><br>&nbsp;&nbsp;'+i18n.t('yes')+'&nbsp;&nbsp;</a>');
        }
    });

});

</script>
