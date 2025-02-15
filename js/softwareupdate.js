var softwareupdate_seed = function(colNumber, row){

    var col = $('td:eq('+colNumber+')', row),
        colvar = col.text();

    colvar = colvar == '3' ? '<span class="label label-warning">'+i18n.t('softwareupdate.publicseed')+'</span>' :
    colvar = colvar == '2' ? '<span class="label label-danger">'+i18n.t('softwareupdate.developerseed')+'</span>' :
    colvar = colvar == '1' ? '<span class="label label-warning">'+i18n.t('softwareupdate.customerseed')+'</span>' :
    (colvar === '0' ? '<span class="label label-success">'+i18n.t('softwareupdate.unenrolled')+'</span>' : colvar)
    col.html(colvar)
}


var format_softwareupdate_yes_no = function(colNumber, row){
    var col = $('td:eq('+colNumber+')', row),
        colvar = col.text();
    colvar = colvar == '0' ? '<span class="label label-success">'+i18n.t('No')+'</span>' :
    colvar = (colvar == '1' ? '<span class="label label-danger">'+i18n.t('Yes')+'</span>' : colvar)
    col.html(colvar)
}

var format_softwareupdate_yes_no_rev = function(colNumber, row){
    var col = $('td:eq('+colNumber+')', row),
        colvar = col.text();
    colvar = colvar == '0' ? '<span class="label label-danger">'+i18n.t('No')+'</span>' :
    colvar = (colvar == '1' ? '<span class="label label-success">'+i18n.t('Yes')+'</span>' : colvar)
    col.html(colvar)
}

var format_softwareupdate_updates_available = function(colNumber, row){
    var col = $('td:eq('+colNumber+')', row),
        colvar = col.text();
    colvar = colvar == '0' ? '<span class="label label-success">'+colvar+" "+i18n.t('softwareupdate.updates')+'</span>' :
    colvar = colvar == '1' ? '<span class="label label-danger">'+colvar+" "+i18n.t('softwareupdate.update')+'</span>' :
    colvar = (colvar > '1' ? '<span class="label label-danger">'+colvar+" "+i18n.t('softwareupdate.updates')+'</span>' : colvar)
    col.html(colvar)
}

var format_softwareupdate_ddm_info = function(colNumber, row){
    var col = $('td:eq('+colNumber+')', row),
        colvar = col.text();
    col.text(colvar.replaceAll("\n", ", "))
}

// Filters
var ManagedDeferralCounterFilter = function(colNumber, d){
    
    // Look for 'between' statement todo: make generic
    if(d.search.value.match(/^\d deferCount \d$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = d.search.value.replace(/(\d) deferCount (\d)/, function(m, from, to){return ' BETWEEN ' + (from) + ' AND ' + (to)});
        // Clear global search
        d.search.value = '';
    }

    // Look for a bigger/smaller/equal statement
    if(d.search.value.match(/^deferCount [<>=] \d$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = d.search.value.replace(/.*([<>=] )(\d)$/, function(m, o, content){return o + (content)});
        // Clear global search
        d.search.value = '';
    }
}

var uptodateFilter = function(colNumber, d){
    // Look for 'not_safety_frozen' keyword
    if(d.search.value.match(/^macos_updtodate$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = '= 0';
        // Clear global search
        d.search.value = '';
    }

    // Look for 'safety_frozen' keyword
    if(d.search.value.match(/^macos_not_updtodate$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = '!= 0';
        // Clear global search
        d.search.value = '';
    }
}

var allow_prerelease_installation_filter = function(colNumber, d){
    // Look for 'prerelease_off' keyword
    if(d.search.value.match(/^prerelease_off$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = '= 0';
        // Clear global search
        d.search.value = '';
    }

    // Look for 'prerelease_on' keyword
    if(d.search.value.match(/^prerelease_on$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = '= 1';
        // Clear global search
        d.search.value = '';
    }
}

var softwareUpdateYesNo = function(colNumber, row){
    var col = $('td:eq('+colNumber+')', row),
        colvar = col.text();
    colvar = colvar != '1' ? '<span class="label label-danger">'+i18n.t('No')+'</span>' :
    colvar = (colvar == '1' ? '<span class="label label-success">'+i18n.t('Yes')+'</span>' : colvar)
    col.html(colvar)
}

var allow_rsr_installation_filter = function(colNumber, d){
    // Look for 'rsr_off' keyword
    if(d.search.value.match(/^rsr_off$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = '= 0';
        // Clear global search
        d.search.value = '';
    }

    // Look for 'rsr_on' keyword
    if(d.search.value.match(/^rsr_on$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = '= 1';
        // Clear global search
        d.search.value = '';
    }
}

var allow_rsr_removal_filter = function(colNumber, d){
    // Look for 'rsr_removal_off' keyword
    if(d.search.value.match(/^rsr_removal_off$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = '= 0';
        // Clear global search
        d.search.value = '';
    }

    // Look for 'rsr_removal_on' keyword
    if(d.search.value.match(/^rsr_removal_on$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = '= 1';
        // Clear global search
        d.search.value = '';
    }
}

var auto_update_restart_required_filter = function(colNumber, d){
    // Look for 'restart_required_off' keyword
    if(d.search.value.match(/^restart_required_off$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = '= 0';
        // Clear global search
        d.search.value = '';
    }

    // Look for 'restart_required_on' keyword
    if(d.search.value.match(/^restart_required_on$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = '= 1';
        // Clear global search
        d.search.value = '';
    }
}

var auto_update_filter = function(colNumber, d){
    // Look for 'auto_update_off' keyword
    if(d.search.value.match(/^auto_update_off$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = '= 0';
        // Clear global search
        d.search.value = '';
    }

    // Look for 'auto_update_on' keyword
    if(d.search.value.match(/^auto_update_on$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = '= 1';
        // Clear global search
        d.search.value = '';
    }
}

var automaticcheckenabled_filter = function(colNumber, d){
    // Look for 'autocheck_off' keyword
    if(d.search.value.match(/^autocheck_off$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = '= 0';
        // Clear global search
        d.search.value = '';
    }

    // Look for 'autocheck_on' keyword
    if(d.search.value.match(/^autocheck_on$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = '= 1';
        // Clear global search
        d.search.value = '';
    }
}

var automaticdownload_filter = function(colNumber, d){
    // Look for 'autodownload_off' keyword
    if(d.search.value.match(/^autodownload_off$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = '= 0';
        // Clear global search
        d.search.value = '';
    }

    // Look for 'autodownload_on' keyword
    if(d.search.value.match(/^autodownload_on$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = '= 1';
        // Clear global search
        d.search.value = '';
    }
}

var force_major_deferred_filter = function(colNumber, d){
    if(d.search.value.match(/^major_deferred_off$/))
    {
        d.columns[colNumber].search.value = '= 0';
        d.search.value = '';
    }
    if(d.search.value.match(/^major_deferred_on$/))
    {
        d.columns[colNumber].search.value = '= 1';
        d.search.value = '';
    }
}

var criticalupdateinstall_filter = function(colNumber, d){
    if(d.search.value.match(/^critical_install_off$/))
    {
        d.columns[colNumber].search.value = '= 0';
        d.search.value = '';
    }
    if(d.search.value.match(/^critical_install_on$/))
    {
        d.columns[colNumber].search.value = '= 1';
        d.search.value = '';
    }
}

var configdatainstall_filter = function(colNumber, d){
    if(d.search.value.match(/^config_install_off$/))
    {
        d.columns[colNumber].search.value = '= 0';
        d.search.value = '';
    }
    if(d.search.value.match(/^config_install_on$/))
    {
        d.columns[colNumber].search.value = '= 1';
        d.search.value = '';
    }
}

var force_minor_deferred_filter = function(colNumber, d){
    // Look for 'minor_deferred_off' keyword
    if(d.search.value.match(/^minor_deferred_off$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = '= 0';
        // Clear global search
        d.search.value = '';
    }

    // Look for 'minor_deferred_on' keyword
    if(d.search.value.match(/^minor_deferred_on$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = '= 1';
        // Clear global search
        d.search.value = '';
    }
}

var lastsessionsuccessful_filter = function(colNumber, d){
    // Look for 'last_session_off' keyword
    if(d.search.value.match(/^last_session_off$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = '= 0';
        // Clear global search
        d.search.value = '';
    }

    // Look for 'last_session_on' keyword
    if(d.search.value.match(/^last_session_on$/))
    {
        // Add column specific search
        d.columns[colNumber].search.value = '= 1';
        // Clear global search
        d.search.value = '';
    }
}