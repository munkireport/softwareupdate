<?php 

/**
 * Softwareupdate module class
 *
 * @package munkireport
 * @author tuxudo
 **/
class Softwareupdate_controller extends Module_controller
{
    /*** Protect methods with auth! ****/
    public function __construct()
    {
        // Store module path
        $this->module_path = dirname(__FILE__);
    }

    /**
     * Default method
     *
     * @author tuxudo
     **/
    public function index()
    {
        echo "You've loaded the softwareupdate module!";
    }

    /**
     * Get data for scroll widget
     *
     * @return void
     * @author tuxudo
     **/
    public function get_scroll_widget($column)
    {
        $sql = "SELECT COUNT(CASE WHEN ".$column." <> '' AND ".$column." IS NOT NULL THEN 1 END) AS count, ".$column."
                FROM softwareupdate
                LEFT JOIN reportdata USING (serial_number)
                ".get_machine_group_filter()."
                AND ".$column." <> '' AND ".$column." IS NOT NULL 
                GROUP BY ".$column."
                ORDER BY ".$column." DESC";
    
        $queryobj = new Softwareupdate_model;
        jsonView($queryobj->query($sql));
    }

    /**
     * Get data for binary widget
     *
     * @return void
     * @author tuxudo
     **/
    public function get_binary_widget($column)
    {
        $sql = "SELECT COUNT(1) as total,
                        COUNT(CASE WHEN `".$column."` = 1 THEN 1 END) AS 'yes',
                        COUNT(CASE WHEN `".$column."` = 0 THEN 1 END) AS 'no'
                        from softwareupdate
                        LEFT JOIN reportdata USING (serial_number)
                        WHERE ".get_machine_group_filter('');

        $out = [];
        $queryobj = new Softwareupdate_model();
        foreach($queryobj->query($sql)[0] as $label => $value){
                $out[] = ['label' => $label, 'count' => $value];
        }

        jsonView($out);
    }

    /**
     * Get data for pending updates scroll widget
     *
     * @return void
     * @author tuxudo
     **/
    public function get_pending_widget($column)
    {
        $sql = "SELECT COUNT(CASE WHEN ".$column." <> '' AND ".$column." IS NOT NULL THEN 1 END) AS count, ".$column."
                FROM softwareupdate
                LEFT JOIN reportdata USING (serial_number)
                ".get_machine_group_filter()."
                AND ".$column." <> '' AND ".$column." IS NOT NULL 
                GROUP BY ".$column."
                ORDER BY ".$column." DESC";

        $updates = [];
        $queryobj = new Softwareupdate_model();

        foreach($queryobj->query($sql) as $update){
            $update_array = explode( ', ', $update->$column);
            foreach($update_array as $update_single){
                $updates[] = $update_single;
            }
        }

        $update_count = array_count_values($updates);
        arsort($update_count);

        $out = [];
        foreach($update_count as $label => $value){
                $out[] = ['update' => $label, 'count' => $value];
        }
        
        jsonView($out);
    }
    
    /**
    * Retrieve program seed in json format
    *
    * @return void
    * @author tuxudo
    **/
    public function get_seed()
    {
        $queryobj = new Softwareupdate_model();
        $sql = "SELECT COUNT(1) as total,
                        COUNT(CASE WHEN `program_seed` = 3 THEN 1 END) AS 'public',
                        COUNT(CASE WHEN `program_seed` = 2 THEN 1 END) AS 'developer',
                        COUNT(CASE WHEN `program_seed` = 1 THEN 1 END) AS 'customer',
                        COUNT(CASE WHEN `program_seed` = 0 THEN 1 END) AS 'unenrolled'
                        from softwareupdate
                        LEFT JOIN reportdata USING (serial_number)
                        WHERE ".get_machine_group_filter('');

        $out = [];
        $queryobj = new Softwareupdate_model();
        
        foreach($queryobj->query($sql)[0] as $label => $value){
                $out[] = ['label' => $label, 'count' => $value];
        }

        jsonView($out);
    }

    /**
     * Retrieve data in json format
     *
     **/
    public function get_tab_data($serial_number = '')
    {
   
        $sql = "SELECT automaticcheckenabled, automaticdownload, configdatainstall, criticalupdateinstall, auto_update, auto_update_restart_required, lastattemptsystemversion, lastbackgroundsuccessfuldate, lastfullsuccessfuldate, lastsuccessfuldate, lastresultcode, lastsessionsuccessful, lastupdatesavailable, lastrecommendedupdatesavailable, recommendedupdates, inactiveupdates, catalogurl, skiplocalcdn,  skip_download_lack_space, eval_critical_if_unchanged, one_time_force_scan_enabled, xprotect_version, mrxprotect, gatekeeper_version, gatekeeper_last_modified, gatekeeper_disk_version, gatekeeper_disk_last_modified, kext_exclude_version, kext_exclude_last_modified, mrt_version, mrt_last_modified, enrolled_seed, program_seed, build_is_seed, show_feedback_menu, disable_seed_opt_out, catalog_url_seed, softwareupdate_history
                        FROM softwareupdate 
                        WHERE serial_number = '$serial_number'";

        $queryobj = new Softwareupdate_model();
        jsonView($queryobj->query($sql));
    }
} // END class Softwareupdate_model