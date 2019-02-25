<?php

use CFPropertyList\CFPropertyList;

class Softwareupdate_model extends \Model 
{
    public function __construct($serial='')
    {
        parent::__construct('id', 'softwareupdate'); //primary key, tablename
        $this->rs['id'] = 0;
        $this->rs['serial_number'] = $serial;
        $this->rs['automaticcheckenabled'] = 0; // True/False
        $this->rs['automaticdownload'] = 0; // True/False
        $this->rs['configdatainstall'] = 0; // True/False
        $this->rs['criticalupdateinstall'] = 0; // True/False
        $this->rs['lastattemptsystemversion'] = '';
        $this->rs['lastbackgroundccdsuccessfuldate'] = '';
        $this->rs['lastbackgroundsuccessfuldate'] = '';
        $this->rs['lastfullsuccessfuldate'] = '';
        $this->rs['lastrecommendedupdatesavailable'] = 0;
        $this->rs['lastresultcode'] = 0;
        $this->rs['lastsessionsuccessful'] = 0;
        $this->rs['lastsuccessfuldate'] = '';
        $this->rs['lastupdatesavailable'] = 0;
        $this->rs['skiplocalcdn'] = 0; // True/False
        $this->rs['recommendedupdates'] = '';
        $this->rs['mrxprotect'] = '';
        $this->rs['catalogurl'] = '';
        $this->rs['inactiveupdates'] = '';
        $this->rs['skip_download_lack_space'] = 0; // True/False
        $this->rs['eval_critical_if_unchanged'] = 0; // True/False
        $this->rs['one_time_force_scan_enabled'] = 0; // True/False
        $this->rs['auto_update'] = 0; // True/False
        $this->rs['auto_update_restart_required'] = 0; // True/False
        $this->rs['xprotect_version'] = '';
        $this->rs['gatekeeper_version'] = '';
        $this->rs['gatekeeper_last_modified'] = '';
        $this->rs['gatekeeper_disk_version'] = '';
        $this->rs['gatekeeper_disk_last_modified'] = '';
        $this->rs['kext_exclude_version'] = '';
        $this->rs['kext_exclude_last_modified'] = '';
        $this->rs['mrt_version'] = '';
        $this->rs['mrt_last_modified'] = '';
        $this->rs['enrolled_seed'] = '';
        $this->rs['program_seed'] = '';
        $this->rs['build_is_seed'] = '';
        $this->rs['show_feedback_menu'] = '';
        $this->rs['disable_seed_opt_out'] = '';
        $this->rs['catalog_url_seed'] = '';
        $this->rs['softwareupdate_history'] = '';

        // Retrieve data for serial number
        if ($serial) {
            $this->retrieve_record($serial);
        }

        $this->serial = $serial;
    }

    // ------------------------------------------------------------------------

    /**
     * Process data sent by postflight
     *
     * @param string data
     * 
     **/
    public function process($data)
    {        
        // Check if data has been passed to model
        if (! $data) {
            throw new Exception("Error Processing Request: No data found", 1);
        }

        // Process incoming softwareupdate.plist
        $parser = new CFPropertyList();
        $parser->parse($data, CFPropertyList::FORMAT_XML);
        $plist = array_change_key_case($parser->toArray(), CASE_LOWER);

        // Process each of the items
        foreach (array('automaticcheckenabled', 'automaticdownload', 'configdatainstall', 'criticalupdateinstall', 'lastattemptsystemversion', 'lastbackgroundccdsuccessfuldate', 'lastbackgroundsuccessfuldate', 'lastfullsuccessfuldate', 'lastrecommendedupdatesavailable', 'lastresultcode', 'lastsessionsuccessful', 'lastsuccessfuldate', 'lastupdatesavailable', 'skiplocalcdn', 'recommendedupdates', 'mrxprotect', 'catalogurl', 'inactiveupdates', 'skip_download_lack_space', 'eval_critical_if_unchanged', 'one_time_force_scan_enabled', 'auto_update', 'auto_update_restart_required', 'xprotect_version', 'gatekeeper_version', 'gatekeeper_last_modified', 'gatekeeper_disk_version', 'gatekeeper_disk_last_modified', 'kext_exclude_version', 'kext_exclude_last_modified', 'mrt_version', 'mrt_last_modified', 'enrolled_seed', 'program_seed', 'build_is_seed', 'show_feedback_menu', 'disable_seed_opt_out', 'catalog_url_seed','softwareupdate_history') as $item) {
            // If key exists and is zero, set it to zero
            if ( array_key_exists($item, $plist) && $plist[$item] === 0 && $item != 'recommendedupdates' && $item != 'inactiveupdates') {
                $this->$item = 0;
            // Else if key does not exist in $plist, null it
            } else if (! array_key_exists($item, $plist) || $plist[$item] == '') {
                $this->$item = null;

            // Else if recommendedupdates, process for viewing
            } else if (array_key_exists($item, $plist) && $item == 'recommendedupdates' && $plist[$item] != 0) {
                print_r("here");
                $recommendedupdateslist = array_column($plist["recommendedupdates"], 'Display Name');                  
                sort($recommendedupdateslist);
                $recommendedupdateslistproper = implode(", ",$recommendedupdateslist);
                $this->$item = $recommendedupdateslistproper;

            // Else if inactiveupdates, process for viewing
            } else if (array_key_exists($item, $plist) && $item == 'inactiveupdates' && $plist[$item] != 0) { 
                $inactiveupdateslist = $plist["inactiveupdates"];                      
                sort($inactiveupdateslist);
                $inactiveupdateslistproper = implode(", ",$inactiveupdateslist);
                $this->$item = $inactiveupdateslistproper;

            // Else if softwareupdate_history, turn it into a JSON string
            } else if (array_key_exists($item, $plist) && $item == 'softwareupdate_history'){
                $this->$item = json_encode($plist[$item]);
                
            // Set the db fields to be the same as those in the preference file
            } else {
                $this->$item = $plist[$item];
            }
        }
        // Save the data into the cookie jar! :D 
        $this->save(); 
    }
}