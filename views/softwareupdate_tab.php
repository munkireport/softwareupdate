<div id="softwareupdate-tab"></div>
<h2 data-i18n="softwareupdate.softwareupdate"></h2>

<div id="softwareupdate-msg" data-i18n="listing.loading" class="col-lg-12 text-center"></div>

<script>
$(document).on('appReady', function(){
   $.getJSON(appUrl + '/module/softwareupdate/get_tab_data/' + serialNumber, function(data){

        // Set default badge to be blank
        $('#softwareupdate-cnt').text('')

        // Check if we have data
        if( data.length == 0 ){
            $('#softwareupdate-msg').text(i18n.t('no_data'));

        } else {
            // Hide loading message
            $('#softwareupdate-msg').text('');

            $.each(data, function(i,d){

                // Generate rows from data
                var rows = ''
                var rows_details = ''
                var rows_seed = ''
                var rows_mrt = ''
                var rows_kext = ''
                var rows_gatekeeper = ''
                var rows_xprotect = ''
                var rows_history = '<tr><td></td><td></td><td></td><td></td><td></td></tr>'
                for (var prop in d){
                    if ((d[prop] == '' || d[prop] == null) && d[prop] !== 0){
                       // Do nothing for empty values to blank them

                    } else if((prop == "lastfullsuccessfuldate" && d[prop] > 100) || (prop == "lastbackgroundsuccessfuldate" && d[prop] > 100) || (prop == "lastsuccessfuldate" && d[prop] > 100)){
                        var date = new Date(d[prop] * 1000);
                        rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td><span title="'+moment(date).fromNow()+'">'+moment(date).format('llll')+'</span></td></tr>';

                    } else if((prop == "gatekeeper_disk_last_modified" && d[prop] > 100) || (prop == "gatekeeper_last_modified" && d[prop] > 100)){
                        var date = new Date(d[prop] * 1000);
                        rows_gatekeeper = rows_gatekeeper + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td><span title="'+moment(date).fromNow()+'">'+moment(date).format('llll')+'</span></td></tr>';

                    } else if((prop == "mrxprotect" && d[prop] > 100) || (prop == 'xprotect_payloads_last_modified' && d[prop] > 100)){
                        var date = new Date(d[prop] * 1000);
                        rows_xprotect = rows_xprotect + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td><span title="'+moment(date).fromNow()+'">'+moment(date).format('llll')+'</span></td></tr>';

                    } else if((prop == "kext_exclude_last_modified" && d[prop] > 100)){
                        var date = new Date(d[prop] * 1000);
                        rows_kext = rows_kext + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td><span title="'+moment(date).fromNow()+'">'+moment(date).format('llll')+'</span></td></tr>';

                    } else if((prop == "mrt_last_modified" && d[prop] > 100)){
                        var date = new Date(d[prop] * 1000);
                        rows_mrt = rows_mrt + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td><span title="'+moment(date).fromNow()+'">'+moment(date).format('llll')+'</span></td></tr>';


                    } else if((prop == 'automaticcheckenabled' || prop == 'automaticdownload' || prop == 'allow_prerelease_installation' || prop == 'configdatainstall' || prop == 'criticalupdateinstall' || prop == 'skiplocalcdn' || prop == 'skip_download_lack_space' || prop == 'eval_critical_if_unchanged' || prop == 'one_time_force_scan_enabled' || prop == 'auto_update' || prop == 'auto_update_restart_required' || prop == 'lastsessionsuccessful' || prop == 'allow_rapid_security_response_installation' || prop == 'allow_rapid_security_response_removal') && d[prop] == 1){
                        rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';

                    } else if((prop == 'automaticcheckenabled' || prop == 'automaticdownload' || prop == 'allow_prerelease_installation' || prop == 'configdatainstall' || prop == 'criticalupdateinstall' || prop == 'skiplocalcdn' || prop == 'skip_download_lack_space' || prop == 'eval_critical_if_unchanged' || prop == 'one_time_force_scan_enabled' || prop == 'auto_update' || prop == 'auto_update_restart_required' || prop == 'lastsessionsuccessful' || prop == 'allow_rapid_security_response_installation' || prop == 'allow_rapid_security_response_removal') && d[prop] == 0){
                        rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';

                    } else if((prop == 'automaticcheckenabled' || prop == 'automaticdownload' || prop == 'allow_prerelease_installation' || prop == 'configdatainstall' || prop == 'criticalupdateinstall' || prop == 'skiplocalcdn' || prop == 'skip_download_lack_space' || prop == 'eval_critical_if_unchanged' || prop == 'one_time_force_scan_enabled' || prop == 'auto_update' || prop == 'auto_update_restart_required' || prop == 'lastsessionsuccessful' || prop == 'allow_rapid_security_response_installation' || prop == 'allow_rapid_security_response_removal') && d[prop] == -1){
                        // Do nothing for -1 values because they're empty
                        rows = rows

                    // Process force_delayed_minor_updates and force_delayed_major_updates
                    } else if((prop == 'force_delayed_minor_updates' || prop == 'force_delayed_major_updates') && d[prop] == 0){
                        rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';
                    } else if((prop == 'force_delayed_minor_updates' || prop == 'force_delayed_major_updates') && d[prop] == 1){
                        if (prop == 'force_delayed_minor_updates' && d['minor_deferred_delay'] == 1){
                            rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('yes')+' - '+d['minor_deferred_delay']+' '+i18n.t('date.day')+'</td></tr>';
                        } else if (prop == 'force_delayed_minor_updates' && d['minor_deferred_delay'] > 1){
                            rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('yes')+' - '+d['minor_deferred_delay']+' '+i18n.t('date.day_plural')+'</td></tr>';
                        } else {
                            rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                        }

                        if (prop == 'force_delayed_major_updates' && d['major_deferred_delay'] == 1){
                            rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('yes')+' - '+d['major_deferred_delay']+' '+i18n.t('date.day')+'</td></tr>';
                        } else if (prop == 'force_delayed_minor_updates' && d['major_deferred_delay'] > 1){
                            rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('yes')+' - '+d['major_deferred_delay']+' '+i18n.t('date.day_plural')+'</td></tr>';
                        } else {
                            rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                        }

                    } else if((prop == 'build_is_seed' || prop == 'disable_seed_opt_out' || prop == 'show_feedback_menu') && d[prop] == 1){
                        rows_seed = rows_seed + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                    } else if((prop == 'build_is_seed' || prop == 'disable_seed_opt_out' || prop == 'show_feedback_menu') && d[prop] == 0){
                        rows_seed = rows_seed + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';

                    } else if(prop == 'lastrecommendedupdatesavailable'){
                        $('#softwareupdate-cnt').text(d[prop])
                        rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+d[prop]+'</td></tr>';

                    } else if(prop == 'program_seed' && d[prop] == 0){
                        rows_seed = rows_seed + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td><span class="label label-success">'+i18n.t('softwareupdate.unenrolled')+'</span></td></tr>';
                    } else if(prop == 'program_seed' && d[prop] == 1){
                        rows_seed = rows_seed + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td><span class="label label-warning">'+i18n.t('softwareupdate.customerseed')+'</span></td></tr>';
                    } else if(prop == 'program_seed' && d[prop] == 2){
                        rows_seed = rows_seed + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td><span class="label label-danger">'+i18n.t('softwareupdate.developerseed')+'</span></td></tr>';
                    } else if(prop == 'program_seed' && d[prop] == 3){
                        rows_seed = rows_seed + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td><span class="label label-warning">'+i18n.t('softwareupdate.publicseed')+'</span></td></tr>';
                    } else if(prop == 'program_seed'){
                        rows_seed = rows_seed + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+d[prop]+'</td></tr>';
                    } else if(prop == 'enrolled_seed'){
                        rows_seed = rows_seed + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+d[prop]+'</td></tr>';

                    } else if(prop == 'mrt_version'){
                        rows_mrt = rows_mrt + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+d[prop]+'</td></tr>';
                    } else if(prop == 'kext_exclude_version'){
                        rows_kext = rows_kext + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+d[prop]+'</td></tr>';
                    } else if(prop == 'gatekeeper_version' || prop == 'gatekeeper_disk_version'){
                        rows_gatekeeper = rows_gatekeeper + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+d[prop]+'</td></tr>';
                    } else if(prop == 'xprotect_version' || prop == 'xprotect_version' || prop == 'xprotect_payloads_version'){
                        rows_xprotect = rows_xprotect + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+d[prop]+'</td></tr>';

                    // Else if build out the softwareupdate history table
                    } else if(prop == "softwareupdate_history"){
                        var softwareupdate_history_data = JSON.parse(d['softwareupdate_history']);
                        rows_history = '<tr><th>'+i18n.t('softwareupdate.display_name')+'</th><th>'+i18n.t('softwareupdate.display_version')+'</th><th>'+i18n.t('softwareupdate.install_date')+'</th><th>'+i18n.t('softwareupdate.content_type')+'</th><th>'+i18n.t('softwareupdate.package_identifiers')+'</th></tr>'
                        $.each(softwareupdate_history_data.reverse(), function(i,d){
                            if (typeof d['display_name'] !== "undefined") {var display_name = d['display_name']} else {var display_name = ""}
                            if (typeof d['display_version'] !== "undefined") {var display_version = d['display_version']} else {var display_version = ""}
                            if (typeof d['date'] !== "undefined") {var date_1 = new Date(d['date'] * 1000); date = '<span title="'+moment(date_1).fromNow()+'">'+moment(date_1).format('llll')} else {var date = ""}
                            if (typeof d['content_type'] !== "undefined") {var content_type = d['content_type']} else {var content_type = ""}
                            if (typeof d['package_identifiers'] !== "undefined") {var package_identifiers = d['package_identifiers'].join(", ")} else {var package_identifiers = ""}
                            // Generate rows from data
                            rows_history = rows_history + '<tr><td style="min-width:220px;">'+display_name+'</td><td style="min-width:117px;">'+display_version+'</td><td style="min-width:200px;">'+date+'</td><td style="min-width:105px;">'+content_type+'</td><td>'+package_identifiers+'</td></tr>';
                        })
                        rows_history = rows_history // Close softwareupdate history table framework

                    } else if(prop == "ddm_info"){
                        rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+d[prop].replaceAll("\n", "<br>")+'</td></tr>';

                    } else if(prop == "deferred_updates"){
                        // Build out the software update details table
                        var softwareupdate_detail_data = JSON.parse(d['deferred_updates']);
                        rows_details = '<tr><th>'+i18n.t('softwareupdate.name')+'</th><th>'+i18n.t('softwareupdate.version')+'</th><th>'+i18n.t('softwareupdate.build')+'</th><th>'+i18n.t('softwareupdate.deferred')+'</th><th>'+i18n.t('softwareupdate.deferred_until')+'</th><th>'+i18n.t('softwareupdate.major_os_update')+'</th><th>'+i18n.t('softwareupdate.minor_os_update')+'</th><th>'+i18n.t('softwareupdate.download_size')+'</th><th>'+i18n.t('softwareupdate.product_key')+'</th></tr>'
                        $.each(softwareupdate_detail_data, function(i,d){
                            if (typeof d['name'] !== "undefined") {var name = d['name']} else {var name = ""}
                            if (typeof d['version'] !== "undefined") {var version = d['version']} else {var version = ""}
                            if (typeof d['build'] !== "undefined") {var build = d['build']} else {var build = ""}
                            if (typeof d['deferred'] !== "undefined" && d['deferred'] == "1") {var deferred = i18n.t('yes')} else {var deferred = i18n.t('no')}
                            if (typeof d['deferred_until'] !== "undefined" && d['deferred_until'] !== "" && d['deferred_until'] > 0) {var date_1 = new Date(d['deferred_until'] * 1000); date = '<span title="'+moment(date_1).fromNow()+'">'+moment(date_1).format('llll')} else {var date = ""}
                            if (typeof d['major_os_update'] !== "undefined" && d['major_os_update'] == "1") {var major_os_update = i18n.t('yes')} else {var major_os_update = i18n.t('no')}
                            if (typeof d['minor_os_update'] !== "undefined" && d['minor_os_update'] == "1") {var minor_os_update = i18n.t('yes')} else {var minor_os_update = i18n.t('no')}
                            if (typeof d['security_response_update'] !== "undefined" && d['security_response_update'] == "1") {var security_response_update = i18n.t('yes')} else {var security_response_update = i18n.t('no')}
                            if (typeof d['download_size'] !== "undefined" && d['download_size'] !== "") {var download_size = fileSize(d['download_size'], 2)} else {var download_size = ""}
                            if (typeof d['product_key'] !== "undefined") {var product_key = d['product_key']} else {var product_key = ""}
                            
                            // Generate rows from data
                            rows_details = rows_details + '<tr><td style="min-width:200px;">'+name+'</td><td style="min-width:75px;">'+version+'</td><td style="min-width:75px;">'+build+'</td><td style="min-width:75px;">'+deferred+'</td><td style="min-width:200px;">'+date+'</td><td style="min-width:130px;">'+major_os_update+'</td><td style="min-width:130px;">'+minor_os_update+'</td><td style="min-width:100px;">'+download_size+'</td><td style="min-width:100px;">'+product_key+'</td></tr>';
                        })

                    } else {
                        rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+d[prop]+'</td></tr>';
                    }

                    // Update the tab badge count
                    $('#softwareupdate-cnt').text(data.lastupdatesavailable);
                }
                $('#softwareupdate-tab')
                    .append($('<div style="max-width:850px;">')
                        .append($('<table>')
                            .addClass('table table-striped table-condensed')
                            .append($('<tbody>')
                                .append(rows))))

                if (rows_details != '<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>' && rows_details != ""){
                    $('#softwareupdate-tab')
                        // Write out software update details table
                        .append($('<h4>')
                            .append($('<i>')
                                .addClass('fa fa-info-circle'))
                            .append(' '+i18n.t('softwareupdate.deferred_updates')))
                        .append($('<div style="max-width:1000px;">')
                            .append($('<table>')
                                .addClass('table table-striped table-condensed')
                                .append($('<tbody>')
                                    .append(rows_details))))
                }

                if (rows_xprotect != ''){
                    $('#softwareupdate-tab')
                        // Write out xprotect table
                        .append($('<h4>')
                            .append($('<i>')
                                .addClass('fa fa-shield'))
                            .append(' '+i18n.t('softwareupdate.xprotect')))
                        .append($('<div style="max-width:375px;">')
                            .append($('<table>')
                                .addClass('table table-striped table-condensed')
                                .append($('<tbody>')
                                    .append(rows_xprotect))))
                }

                if (rows_gatekeeper != ''){
                    $('#softwareupdate-tab')
                        // Write out gatekeeper table
                        .append($('<h4>')
                            .append($('<i>')
                                .addClass('fa fa-fort-awesome'))
                            .append(' '+i18n.t('softwareupdate.gatekeeper')))
                        .append($('<div style="max-width:375px;">')
                            .append($('<table>')
                                .addClass('table table-striped table-condensed')
                                .append($('<tbody>')
                                    .append(rows_gatekeeper))))
                }

                if (rows_mrt != ''){
                    $('#softwareupdate-tab')
                        // Write out mrt table
                        .append($('<h4>')
                            .append($('<i>')
                                .addClass('fa fa-heartbeat'))
                            .append(' '+i18n.t('softwareupdate.mrt_info')))
                        .append($('<div style="max-width:375px;">')
                            .append($('<table>')
                                .addClass('table table-striped table-condensed')
                                .append($('<tbody>')
                                    .append(rows_mrt))))
                }

                if (rows_kext != ''){
                    $('#softwareupdate-tab')
                        // Write out kext table
                        .append($('<h4>')
                            .append($('<i>')
                                .addClass('fa fa-puzzle-piece'))
                            .append(' '+i18n.t('softwareupdate.kext_exclude')))
                        .append($('<div style="max-width:375px;">')
                            .append($('<table>')
                                .addClass('table table-striped table-condensed')
                                .append($('<tbody>')
                                    .append(rows_kext))))
                }

                if (rows_seed != ''){
                    $('#softwareupdate-tab')
                        // Write out seed table
                        .append($('<h4>')
                            .append($('<i>')
                                .addClass('fa fa-leaf'))
                            .append(' '+i18n.t('softwareupdate.beta_program')))
                        .append($('<div style="max-width:375px;">')
                            .append($('<table>')
                                .addClass('table table-striped table-condensed')
                                .append($('<tbody>')
                                    .append(rows_seed))))
                }

                if (rows_history != '<tr><td></td><td></td><td></td><td></td><td></td></tr>'){
                    $('#softwareupdate-tab')
                        // Write out softwareupdate_history table
                        .append($('<h4>')
                            .append($('<i>')
                                .addClass('fa fa-history'))
                            .append(' '+i18n.t('softwareupdate.softwareupdate_history')))
                        .append($('<div style="max-width:1000px;">')
                            .append($('<table>')
                                .addClass('table table-striped table-condensed')
                                .append($('<tbody>')
                                    .append(rows_history))))
                }
            })
        }
   });
});
</script>
