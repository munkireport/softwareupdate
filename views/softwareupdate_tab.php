<div id="softwareupdate-tab"></div>

<div id="lister" style="font-size: large; float: right;">
    <a href="/show/listing/softwareupdate/softwareupdate" title="List">
        <i class="btn btn-default tab-btn fa fa-list"></i>
    </a>
</div>
<div id="report_btn" style="font-size: large; float: right;">
    <a href="/show/report/softwareupdate/softwareupdate_report" title="Report">
        <i class="btn btn-default tab-btn fa fa-th"></i>
    </a>
</div>
<h2 data-i18n="softwareupdate.softwareupdate"></h2>

<div id="softwareupdate-msg" data-i18n="listing.loading" class="col-lg-12 text-center"></div>

<script>
$(document).on('appReady', function(){
   $.getJSON(appUrl + '/module/softwareupdate/get_tab_data/' + serialNumber, function(data){
        // Reset badge and handle empty data
        $('#softwareupdate-cnt').text('');
        
        if (!data.length) {
            $('#softwareupdate-msg').text(i18n.t('no_data'));
            return;
        }

        // Hide loading message
        $('#softwareupdate-msg').text('');

        // Helper functions
        const formatDate = timestamp => {
            const date = new Date(timestamp * 1000);
            return `<span title="${moment(date).fromNow()}">${moment(date).format('llll')}</span>`;
        };

        const createSection = (icon, title, content, maxWidth) => {
            if (!icon && !title) {
                return `<div style="max-width:${maxWidth}px;">
                    <table class="table table-striped table-condensed">
                        <tbody>${content}</tbody>
                    </table>
                </div>`;
            }
            return `<h4><i class="fa ${icon}"></i> ${i18n.t('softwareupdate.' + title)}</h4>
                <div style="max-width:${maxWidth}px;">
                    <table class="table table-striped table-condensed">
                        <tbody>${content}</tbody>
                    </table>
                </div>`;
        };

        $.each(data, function(i, d){
            let sections = {
                main: [],
                details: [],
                seed: [],
                mrt: [],
                kext: [],
                gatekeeper: [],
                xprotect: [],
                history: []
            };

            // Initialize history header
            sections.history.push('<tr>' +
                '<th>'+i18n.t('softwareupdate.display_name')+'</th>' +
                '<th>'+i18n.t('softwareupdate.display_version')+'</th>' +
                '<th>'+i18n.t('softwareupdate.install_date')+'</th>' +
                '<th>'+i18n.t('softwareupdate.content_type')+'</th>' +
                '<th>'+i18n.t('softwareupdate.package_identifiers')+'</th>' +
            '</tr>');

            for (const prop in d) {
                const value = d[prop];
                if (!value && value !== 0) continue;

                // Handle dates
                if (/last.*date/.test(prop) && value > 100) {
                    sections.main.push(`<tr><th>${i18n.t('softwareupdate.'+prop)}</th><td>${formatDate(value)}</td></tr>`);
                }
                // Handle boolean properties
                else if (['automaticcheckenabled', 'automaticdownload', 'allow_prerelease_installation', 
                         'configdatainstall', 'criticalupdateinstall', 'skiplocalcdn', 
                         'skip_download_lack_space', 'eval_critical_if_unchanged', 
                         'one_time_force_scan_enabled', 'auto_update', 'auto_update_restart_required',
                         'lastsessionsuccessful', 'allow_rapid_security_response_installation',
                         'allow_rapid_security_response_removal'].includes(prop)) {
                    if (value !== -1) {
                        sections.main.push(`<tr><th>${i18n.t('softwareupdate.'+prop)}</th><td>${i18n.t(parseInt(value) === 1 ? 'yes' : 'no')}</td></tr>`);
                    }
                }
                // Handle delayed updates
                else if (prop === 'force_delayed_minor_updates' || prop === 'force_delayed_major_updates') {
                    if (value === 0) {
                        sections.main.push(`<tr><th>${i18n.t('softwareupdate.'+prop)}</th><td>${i18n.t('no')}</td></tr>`);
                    } else if (value === 1) {
                        const delayType = prop === 'force_delayed_minor_updates' ? 'minor_deferred_delay' : 'major_deferred_delay';
                        const delayDays = d[delayType];
                        const dayText = delayDays === 1 ? 'day' : 'day_plural';
                        if (delayDays) {
                            sections.main.push(`<tr><th>${i18n.t('softwareupdate.'+prop)}</th><td>${i18n.t('yes')} - ${delayDays} ${i18n.t('date.'+dayText)}</td></tr>`);
                        } else {
                            sections.main.push(`<tr><th>${i18n.t('softwareupdate.'+prop)}</th><td>${i18n.t('yes')}</td></tr>`);
                        }
                    }
                }
                // Handle seed program
                else if (prop === 'program_seed') {
                    const seedLabels = {
                        0: '<span class="label label-success">'+i18n.t('softwareupdate.unenrolled')+'</span>',
                        1: '<span class="label label-warning">'+i18n.t('softwareupdate.customerseed')+'</span>',
                        2: '<span class="label label-danger">'+i18n.t('softwareupdate.developerseed')+'</span>',
                        3: '<span class="label label-warning">'+i18n.t('softwareupdate.publicseed')+'</span>'
                    };
                    sections.seed.push(`<tr><th>${i18n.t('softwareupdate.'+prop)}</th><td>${seedLabels[value] || value}</td></tr>`);
                }
                // Handle history
                else if (prop === 'softwareupdate_history') {
                    const history = JSON.parse(value);
                    history.reverse().forEach(item => {
                        sections.history.push('<tr>' +
                            `<td style="min-width:220px;">${item.display_name || ''}</td>` +
                            `<td style="min-width:117px;">${item.display_version || ''}</td>` +
                            `<td style="min-width:200px;">${item.date ? formatDate(item.date) : ''}</td>` +
                            `<td style="min-width:105px;">${item.content_type || ''}</td>` +
                            `<td>${item.package_identifiers ? item.package_identifiers.join(', ') : ''}</td>` +
                        '</tr>');
                    });
                }
                // Handle deferred updates
                else if (prop === 'deferred_updates') {
                    sections.details.push('<tr>' +
                        '<th>'+i18n.t('softwareupdate.name')+'</th>' +
                        '<th>'+i18n.t('softwareupdate.version')+'</th>' +
                        '<th>'+i18n.t('softwareupdate.build')+'</th>' +
                        '<th>'+i18n.t('softwareupdate.deferred')+'</th>' +
                        '<th>'+i18n.t('softwareupdate.deferred_until')+'</th>' +
                        '<th>'+i18n.t('softwareupdate.major_os_update')+'</th>' +
                        '<th>'+i18n.t('softwareupdate.minor_os_update')+'</th>' +
                        '<th>'+i18n.t('softwareupdate.download_size')+'</th>' +
                        '<th>'+i18n.t('softwareupdate.product_key')+'</th>' +
                    '</tr>');

                    JSON.parse(value).forEach(update => {
                        sections.details.push('<tr>' +
                            `<td style="min-width:200px;">${update.name || ''}</td>` +
                            `<td style="min-width:75px;">${update.version || ''}</td>` +
                            `<td style="min-width:75px;">${update.build || ''}</td>` +
                            `<td style="min-width:75px;">${update.deferred === 1 ? i18n.t('yes') : i18n.t('no')}</td>` +
                            `<td style="min-width:200px;">${update.deferred_until ? formatDate(update.deferred_until) : ''}</td>` +
                            `<td style="min-width:130px;">${update.major_os_update === 1 ? i18n.t('yes') : i18n.t('no')}</td>` +
                            `<td style="min-width:130px;">${update.minor_os_update === 1 ? i18n.t('yes') : i18n.t('no')}</td>` +
                            `<td style="min-width:100px;">${update.download_size ? fileSize(update.download_size, 2) : ''}</td>` +
                            `<td style="min-width:100px;">${update.product_key || ''}</td>` +
                        '</tr>');
                    });
                }
                // Update badge count
                else if (prop === 'lastrecommendedupdatesavailable') {
                    $('#softwareupdate-cnt').text(value);
                    sections.main.push(`<tr><th>${i18n.t('softwareupdate.'+prop)}</th><td>${value}</td></tr>`);
                }
                // Handle remaining properties
                else {
                    sections.main.push(`<tr><th>${i18n.t('softwareupdate.'+prop)}</th><td>${value}</td></tr>`);
                }
            }

            // Render all sections
            const container = $('#softwareupdate-tab');
            if (sections.main.length) {
                container.append(createSection('', '', sections.main.join(''), 850));
            }
            if (sections.details.length > 1) {
                container.append(createSection('fa-info-circle', 'deferred_updates', sections.details.join(''), 1000));
            }
            if (sections.xprotect.length) {
                container.append(createSection('fa-shield', 'xprotect', sections.xprotect.join(''), 375));
            }
            if (sections.gatekeeper.length) {
                container.append(createSection('fa-fort-awesome', 'gatekeeper', sections.gatekeeper.join(''), 375));
            }
            if (sections.mrt.length) {
                container.append(createSection('fa-heartbeat', 'mrt_info', sections.mrt.join(''), 375));
            }
            if (sections.kext.length) {
                container.append(createSection('fa-puzzle-piece', 'kext_exclude', sections.kext.join(''), 375));
            }
            if (sections.seed.length) {
                container.append(createSection('fa-leaf', 'beta_program', sections.seed.join(''), 375));
            }
            if (sections.history.length > 1) {
                container.append(createSection('fa-history', 'softwareupdate_history', sections.history.join(''), 1000));
            }
        });
   });
});
</script>
