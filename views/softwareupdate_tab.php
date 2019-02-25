<div id="softwareupdate-tab"></div>
<h2 data-i18n="softwareupdate.softwareupdate"></h2>

<script>
$(document).on('appReady', function(){
	$.getJSON(appUrl + '/module/softwareupdate/get_tab_data/' + serialNumber, function(data){
		var skipThese = ['id','serial_number'];
		$.each(data, function(i,d){

			// Generate rows from data
			var rows = ''
			var rows_seed = ''
			var rows_mrt = ''
			var rows_kext = ''
			var rows_gatekeeper = ''
			var rows_xprotect = ''
            var rows_history = '<tr><td></td><td></td><td></td><td></td><td></td></tr>'
			for (var prop in d){
				// Skip skipThese
				if(skipThese.indexOf(prop) == -1){
                    if (d[prop] == '' || d[prop] == null){
					   // Do nothing for empty values to blank them

                    } else if((prop == "lastfullsuccessfuldate" && d[prop].indexOf('-') === -1) || (prop == "lastbackgroundsuccessfuldate" && d[prop].indexOf('-') === -1) || (prop == "lastsuccessfuldate" && d[prop].indexOf('-') === -1)){
					   var date = new Date(d[prop] * 1000);
					   rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td><span title="'+moment(date).fromNow()+'">'+moment(date).format('llll')+'</span></td></tr>';
                        
                    } else if((prop == "gatekeeper_disk_last_modified" && d[prop].indexOf('-') === -1) || (prop == "gatekeeper_last_modified" && d[prop].indexOf('-') === -1)){
					   var date = new Date(d[prop] * 1000);
					   rows_gatekeeper = rows_gatekeeper + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td><span title="'+moment(date).fromNow()+'">'+moment(date).format('llll')+'</span></td></tr>';
                        
                    } else if((prop == "mrxprotect" && d[prop].indexOf('-') === -1)){
					   var date = new Date(d[prop] * 1000);
					   rows_xprotect = rows_xprotect + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td><span title="'+moment(date).fromNow()+'">'+moment(date).format('llll')+'</span></td></tr>';
                                                
                    } else if((prop == "kext_exclude_last_modified" && d[prop].indexOf('-') === -1)){
					   var date = new Date(d[prop] * 1000);
					   rows_kext = rows_kext + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td><span title="'+moment(date).fromNow()+'">'+moment(date).format('llll')+'</span></td></tr>';
                        
                    } else if((prop == "mrt_last_modified" && d[prop].indexOf('-') === -1)){
					   var date = new Date(d[prop] * 1000);
					   rows_mrt = rows_mrt + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td><span title="'+moment(date).fromNow()+'">'+moment(date).format('llll')+'</span></td></tr>';

                    } else if(prop == 'automaticcheckenabled' && d[prop] == 1){
					   rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                    } else if(prop == 'automaticcheckenabled' && d[prop] == 0){
					   rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';
                    } else if(prop == 'automaticcheckenabled' && d[prop] == -1){
                    }

                    else if(prop == 'automaticdownload' && d[prop] == 1){
					   rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                    } else if(prop == 'automaticdownload' && d[prop] == 0){
					   rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';
                    } else if(prop == 'automaticdownload' && d[prop] == -1){
                    }
                    
                    else if(prop == 'build_is_seed' && d[prop] == 1){
					   rows_seed = rows_seed + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                    } else if(prop == 'build_is_seed' && d[prop] == 0){
					   rows_seed = rows_seed + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';
                    }
                    
                    else if(prop == 'disable_seed_opt_out' && d[prop] == 1){
					   rows_seed = rows_seed + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                    } else if(prop == 'disable_seed_opt_out' && d[prop] == 0){
					   rows_seed = rows_seed + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';
                    }
                    
                    else if(prop == 'show_feedback_menu' && d[prop] == 1){
					   rows_seed = rows_seed + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                    } else if(prop == 'show_feedback_menu' && d[prop] == 0){
					   rows_seed = rows_seed + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';
                    }

                    else if(prop == 'configdatainstall' && d[prop] == 1){
					   rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                    } else if(prop == 'configdatainstall' && d[prop] == 0){
					   rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';
                    } else if(prop == 'configdatainstall' && d[prop] == -1){
                    }

                    else if(prop == 'criticalupdateinstall' && d[prop] == 1){
					   rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                    } else if(prop == 'criticalupdateinstall' && d[prop] == 0){
					   rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';
                    } else if(prop == 'criticalupdateinstall' && d[prop] == -1){
                    }

                    else if(prop == 'skiplocalcdn' && d[prop] == 1){
					   rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                    } else if(prop == 'skiplocalcdn' && d[prop] == 0){
					   rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';
                    }

                    else if(prop == 'skip_download_lack_space' && d[prop] == 1){
					   rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                    } else if(prop == 'skip_download_lack_space' && d[prop] == 0){
					   rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';
                    }

                    else if(prop == 'eval_critical_if_unchanged' && d[prop] == 1){
					   rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                    } else if(prop == 'eval_critical_if_unchanged' && d[prop] == 0){
					   rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';
                    }

                    else if(prop == 'one_time_force_scan_enabled' && d[prop] == 1){
					   rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                    } else if(prop == 'one_time_force_scan_enabled' && d[prop] == 0){
					   rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';
                    }

                    else if(prop == 'auto_update' && d[prop] == 1){
					   rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                    } else if(prop == 'auto_update' && d[prop] == 0){
					   rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';
                    }

                    else if(prop == 'auto_update_restart_required' && d[prop] == 1){
					   rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                    } else if(prop == 'auto_update_restart_required' && d[prop] == 0){
					   rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';
                    }

                    else if(prop == 'lastsessionsuccessful' && d[prop] == 1){
					   rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('yes')+'</td></tr>';
                    } else if(prop == 'lastsessionsuccessful' && d[prop] == 0){
					   rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+i18n.t('no')+'</td></tr>';
                    
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
                        
                    } else if(prop == 'mrt_version'){
					   rows_mrt = rows_mrt + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+d[prop]+'</td></tr>';
                    } else if(prop == 'kext_exclude_version'){
					   rows_kext = rows_kext + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+d[prop]+'</td></tr>';
                    } else if(prop == 'gatekeeper_version' || prop == 'gatekeeper_disk_version'){
					   rows_gatekeeper = rows_gatekeeper + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+d[prop]+'</td></tr>';
                    } else if(prop == 'xprotect_version' || prop == 'xprotect_version'){
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

                        
                    } else {
                        rows = rows + '<tr><th>'+i18n.t('softwareupdate.'+prop)+'</th><td>'+d[prop]+'</td></tr>';
					}
                    
                    // Update the tab badge count
                    $('#softwareupdate-cnt').text(data.lastupdatesavailable);
				}
			}
			$('#softwareupdate-tab')
				.append($('<div style="max-width:850px;">')
					.append($('<table>')
						.addClass('table table-striped table-condensed')
						.append($('<tbody>')
							.append(rows))))
            
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
	});
});
</script>
