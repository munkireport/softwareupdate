Software Update module
==============

Reports on the status of software updates on the client


###Note 
Blank data entries within the listing or client tab mean the key is either not supported on that version of macOS or the key is set to the default value. When set to the default value, the state is not written to disk.

Table Schema
-----
* automaticcheckenabled - int - automatic checks enabled
* automaticdownload - int - automatic downloads enabled
* configdatainstall - int - automatic downloads of XProtect and GateKeeper data enabled
* criticalupdateinstall - int - automatic downloads of critical updates enabled
* lastattemptsystemversion - varchar(255) - last version and build of macOS that attempted an update
* lastbackgroundccdsuccessfuldate - varchar(255) - last background update successful date
* lastbackgroundsuccessfuldate - varchar(255) - last background update successful date
* lastfullsuccessfuldate - varchar(255) - date of last successful update
* lastrecommendedupdatesavailable - int - number of last recommended updates
* lastresultcode - int - last result code from update
* lastsessionsuccessful - int - last session successful
* lastsuccessfuldate - varchar(255) - last successful session date
* lastupdatesavailable - int - number of last available updates
* skiplocalcdn - int - skip the local CDN when downloading updates
* recommendedupdates - varchar(255) - names of items needs updated
* mrxprotect - varchar(255) - date of last XProtect update installation
* catalogurl - varchar(255) - current catalog URL, default is blank
* inactiveupdates - varchar(255) - list of updates that are ignored
* skip_download_lack_space - boolean - If updates were not auto downloaded due to lack of disk space
* eval_critical_if_unchanged - boolean - Evaluate critical updated even if unchanged
* one_time_force_scan_enabled - boolean - Rescan the full catalog one time if true
* auto_update - boolean - If macOS will automatically update
* auto_update_restart_required - boolean - If macOS will automatically install updates that require a restart
* xprotect_version - varchar(255) - version of XProtect installed
* gatekeeper_version - varchar(255) - version of Gatekeeper installed
* gatekeeper_last_modified - big integer - when Gatekeeper was last installed
* gatekeeper_disk_version - varchar(255) - version of Gatekeeper disk that is installed
* gatekeeper_disk_last_modified - big integer - when Gatekeeper disk was last installed
* kext_exclude_version - varchar(255) - version of kext exclude list is installed
* kext_exclude_last_modified - big integer - when kext exclude list was last installed
* mrt_version - varchar(255) - MRT version installed
* mrt_last_modified - big integer - when MRT was last installed
* enrolled_seed - varchar(255) - beta enrollment seed
* program_seed - varchar(255) - beta program enrollment value
* build_is_seed - varchar(255) - if macOS is a seed build
* show_feedback_menu - varchar(255) - if the feedback menu is shown
* disable_seed_opt_out - varchar(255) - if opting out of seed program is disabled
* catalog_url_seed - varchar(255) - catalog URL in use by seed program
* softwareupdate_history - medium text - JSON string containing history of all software updates