<?php

return array(
    'client_tabs' => array(
        'softwareupdate-tab' => array('view' => 'softwareupdate_tab', 'i18n' => 'softwareupdate.clienttabtitle', 'badge' => 'softwareupdate-cnt'),
    ),
    'listings' => array(
        'softwareupdate' => array('view' => 'softwareupdate_listing', 'i18n' => 'softwareupdate.softwareupdate'),
    ),
    'widgets' => array(
        'softwareupdate_seed' => array('view' => 'softwareupdate_seed_widget', 'i18n' => 'softwareupdate.program_seed'),
        'softwareupdate_auto_update' => array('view' => 'softwareupdate_auto_update_widget', 'i18n' => 'softwareupdate.auto_update'),
        'softwareupdate_automaticcheckenabled' => array('view' => 'softwareupdate_automaticcheckenabled_widget', 'i18n' => 'softwareupdate.automaticcheckenabled'),
        'softwareupdate_automaticdownload' => array('view' => 'softwareupdate_automaticdownload_widget', 'i18n' => 'softwareupdate.automaticdownload'),
        'softwareupdate_configdatainstall' => array('view' => 'softwareupdate_configdatainstall_widget', 'i18n' => 'softwareupdate.configdatainstall'),
        'softwareupdate_criticalupdateinstall' => array('view' => 'softwareupdate_criticalupdateinstall_widget', 'i18n' => 'softwareupdate.criticalupdateinstall'),
        'softwareupdate_auto_update_restart_required' => array('view' => 'softwareupdate_auto_update_restart_required_widget', 'i18n' => 'softwareupdate.auto_update_restart_required'),
        'softwareupdate_xprotect_version' => array('view' => 'softwareupdate_xprotect_version_widget', 'i18n' => 'softwareupdate.xprotect_version'),
        'softwareupdate_gatekeeper_version' => array('view' => 'softwareupdate_gatekeeper_version_widget', 'i18n' => 'softwareupdate.gatekeeper_version'),
        'softwareupdate_gatekeeper_disk_version' => array('view' => 'softwareupdate_gatekeeper_disk_version_widget', 'i18n' => 'softwareupdate.gatekeeper_disk_version'),
        'softwareupdate_kext_exclude_version' => array('view' => 'softwareupdate_kext_exclude_version_widget', 'i18n' => 'softwareupdate.kext_exclude_version'),
        'softwareupdate_mrt_version' => array('view' => 'softwareupdate_mrt_version_widget', 'i18n' => 'softwareupdate.mrt_version'),
    ),
    'reports' => array(
        'softwareupdate_report' => array('view' => 'softwareupdate_report', 'i18n' => 'softwareupdate.reporttitle'),
    ),
);
