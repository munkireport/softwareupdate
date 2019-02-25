<div class="col-lg-4 col-md-6">
    <div class="panel panel-default" id="softwareupdate_seed_widget-widget">
        <div id="softwareupdate_seed_widget-widget" class="panel-heading" data-container="body">
            <h3 class="panel-title"><i class="fa fa-leaf"></i> 
                <span data-i18n="softwareupdate.enrolled_seed"></span>
                <list-link data-url="/show/listing/softwareupdate/softwareupdate"></list-link>
            </h3>
        </div>
        <div class="panel-body text-center"></div>
    </div><!-- /panel -->
</div><!-- /col -->

<script>
$(document).on('appUpdate', function(e, lang) {

    $.getJSON( appUrl + '/module/softwareupdate/get_seed', function( data ) {
        if(data.error){
            //alert(data.error);
            return;
        }

        var panel = $('#softwareupdate_seed_widget-widget div.panel-body'),
        baseUrl = appUrl + '/show/listing/softwareupdate/softwareupdate/#';
        panel.empty();
        // Set blocks, disable if zero
        if(data.developer != "0"){
            panel.append(' <a href="'+baseUrl+'" class="btn btn-danger"><span class="bigger-150">'+data.developer+'</span><br>'+i18n.t('softwareupdate.developerseed')+'</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'" class="btn btn-danger disabled"><span class="bigger-150">'+data.developer+'</span><br>'+i18n.t('softwareupdate.developerseed')+'</a>');
        }
        if(data.public != "0"){
            panel.append(' <a href="'+baseUrl+'" class="btn btn-warning"><span class="bigger-150">'+data.public+'</span><br>'+i18n.t('softwareupdate.publicseed')+'</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'" class="btn btn-warning disabled"><span class="bigger-150">'+data.public+'</span><br>'+i18n.t('softwareupdate.publicseed')+'</a>');
        }
        if(data.customer != "0"){
            panel.append(' <a href="'+baseUrl+'" class="btn btn-warning"><span class="bigger-150">'+data.customer+'</span><br>'+i18n.t('softwareupdate.customerseed')+'</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'" class="btn btn-warning hidden"><span class="bigger-150">'+data.customer+'</span><br>'+i18n.t('softwareupdate.customerseed')+'</a>');
        }
        if(data.unenrolled != "0"){
            panel.append(' <a href="'+baseUrl+'" class="btn btn-success"><span class="bigger-150">'+data.unenrolled+'</span><br>'+i18n.t('softwareupdate.unenrolled')+'</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'" class="btn btn-success disabled"><span class="bigger-150">'+data.unenrolled+'</span><br>'+i18n.t('softwareupdate.unenrolled')+'</a>');
        }
    });
});

</script>
