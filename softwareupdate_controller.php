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
    * Retrieve program seed in json format
    *
    * @return void
    * @author tuxudo
    **/
    public function get_seed()
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
  
        $queryobj = new Softwareupdate_model();
        $sql = "SELECT COUNT(1) as total,
                        COUNT(CASE WHEN `program_seed` = 3 THEN 1 END) AS 'public',
                        COUNT(CASE WHEN `program_seed` = 2 THEN 1 END) AS 'developer',
                        COUNT(CASE WHEN `program_seed` = 1 THEN 1 END) AS 'customer',
                        COUNT(CASE WHEN `program_seed` = 0 THEN 1 END) AS 'unenrolled'
                        from softwareupdate
                        LEFT JOIN reportdata USING (serial_number)
                        WHERE
                            ".get_machine_group_filter('');
        $obj->view('json', array('msg' => current($queryobj->query($sql))));
    }
    
    /**
    * Retrieve mrt_version in json format
    *
    * @return void
    * @author tuxudo
    **/
    public function get_mrt_version()
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
  
        $queryobj = new Softwareupdate_model();
        
        $out = array();
        $sql = "SELECT COUNT(CASE WHEN mrt_version <> '' AND mrt_version IS NOT NULL THEN 1 END) AS count, mrt_version 
                FROM softwareupdate
                LEFT JOIN reportdata USING (serial_number)
                ".get_machine_group_filter()."
                GROUP BY mrt_version
                ORDER BY mrt_version DESC";
        
        foreach ($queryobj->query($sql) as $obj) {
            if ("$obj->count" !== "0") {
                $obj->mrt_version = $obj->mrt_version ? $obj->mrt_version : 'Unknown';
                $out[] = $obj;
            }
        }
        
        return print_r(json_encode($out));
    }
    
    /**
    * Retrieve kext_exclude_version in json format
    *
    * @return void
    * @author tuxudo
    **/
    public function get_kext_exclude_version()
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
  
        $queryobj = new Softwareupdate_model();
        
        $out = array();
        $sql = "SELECT COUNT(CASE WHEN kext_exclude_version <> '' AND kext_exclude_version IS NOT NULL THEN 1 END) AS count, kext_exclude_version 
                FROM softwareupdate
                LEFT JOIN reportdata USING (serial_number)
                ".get_machine_group_filter()."
                GROUP BY kext_exclude_version
                ORDER BY kext_exclude_version DESC";
        
        foreach ($queryobj->query($sql) as $obj) {
            if ("$obj->count" !== "0") {
                $obj->kext_exclude_version = $obj->kext_exclude_version ? $obj->kext_exclude_version : 'Unknown';
                $out[] = $obj;
            }
        }
        
        return print_r(json_encode($out));
    }
    
    /**
    * Retrieve gatekeeper_disk_version in json format
    *
    * @return void
    * @author tuxudo
    **/
    public function get_gatekeeper_disk_version()
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
  
        $queryobj = new Softwareupdate_model();
        
        $out = array();
        $sql = "SELECT COUNT(CASE WHEN gatekeeper_disk_version <> '' AND gatekeeper_disk_version IS NOT NULL THEN 1 END) AS count, gatekeeper_disk_version 
                FROM softwareupdate
                LEFT JOIN reportdata USING (serial_number)
                ".get_machine_group_filter()."
                GROUP BY gatekeeper_disk_version
                ORDER BY gatekeeper_disk_version DESC";
        
        foreach ($queryobj->query($sql) as $obj) {
            if ("$obj->count" !== "0") {
                $obj->gatekeeper_disk_version = $obj->gatekeeper_disk_version ? $obj->gatekeeper_disk_version : 'Unknown';
                $out[] = $obj;
            }
        }
        
        return print_r(json_encode($out));
    }
    
    /**
    * Retrieve gatekeeper_version in json format
    *
    * @return void
    * @author tuxudo
    **/
    public function get_gatekeeper_version()
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
  
        $queryobj = new Softwareupdate_model();
        
        $out = array();
        $sql = "SELECT COUNT(CASE WHEN gatekeeper_version <> '' AND gatekeeper_version IS NOT NULL THEN 1 END) AS count, gatekeeper_version 
                FROM softwareupdate
                LEFT JOIN reportdata USING (serial_number)
                ".get_machine_group_filter()."
                GROUP BY gatekeeper_version
                ORDER BY gatekeeper_version DESC";
        
        foreach ($queryobj->query($sql) as $obj) {
            if ("$obj->count" !== "0") {
                $obj->gatekeeper_version = $obj->gatekeeper_version ? $obj->gatekeeper_version : 'Unknown';
                $out[] = $obj;
            }
        }
        
        return print_r(json_encode($out));
    }
    
    /**
    * Retrieve xprotect_version in json format
    *
    * @return void
    * @author tuxudo
    **/
    public function get_xprotect_version()
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
  
        $queryobj = new Softwareupdate_model();
        
        $out = array();
        $sql = "SELECT COUNT(CASE WHEN xprotect_version <> '' AND xprotect_version IS NOT NULL THEN 1 END) AS count, xprotect_version 
                FROM softwareupdate
                LEFT JOIN reportdata USING (serial_number)
                ".get_machine_group_filter()."
                GROUP BY xprotect_version
                ORDER BY xprotect_version DESC";
        
        foreach ($queryobj->query($sql) as $obj) {
            if ("$obj->count" !== "0") {
                $obj->xprotect_version = $obj->xprotect_version ? $obj->xprotect_version : 'Unknown';
                $out[] = $obj;
            }
        }
        
        return print_r(json_encode($out));
    }
    
    /**
    * Retrieve auto_update_restart_required in json format
    *
    * @return void
    * @author tuxudo
    **/
    public function get_auto_update_restart_required()
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
  
        $queryobj = new Softwareupdate_model();
        $sql = "SELECT COUNT(1) as total,
                        COUNT(CASE WHEN `auto_update_restart_required` = 1 THEN 1 END) AS 'yes',
                        COUNT(CASE WHEN `auto_update_restart_required` = 0 THEN 1 END) AS 'no'
                        from softwareupdate
                        LEFT JOIN reportdata USING (serial_number)
                        WHERE
                            ".get_machine_group_filter('');
        $obj->view('json', array('msg' => current($queryobj->query($sql))));
    }
    
    /**
    * Retrieve criticalupdateinstall in json format
    *
    * @return void
    * @author tuxudo
    **/
    public function get_criticalupdateinstall()
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
  
        $queryobj = new Softwareupdate_model();
        $sql = "SELECT COUNT(1) as total,
                        COUNT(CASE WHEN `criticalupdateinstall` = 1 THEN 1 END) AS 'yes',
                        COUNT(CASE WHEN `criticalupdateinstall` = 0 THEN 1 END) AS 'no'
                        from softwareupdate
                        LEFT JOIN reportdata USING (serial_number)
                        WHERE
                            ".get_machine_group_filter('');
        $obj->view('json', array('msg' => current($queryobj->query($sql))));
    }
    
    /**
    * Retrieve configdatainstall in json format
    *
    * @return void
    * @author tuxudo
    **/
    public function get_configdatainstall()
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
  
        $queryobj = new Softwareupdate_model();
        $sql = "SELECT COUNT(1) as total,
                        COUNT(CASE WHEN `configdatainstall` = 1 THEN 1 END) AS 'yes',
                        COUNT(CASE WHEN `configdatainstall` = 0 THEN 1 END) AS 'no'
                        from softwareupdate
                        LEFT JOIN reportdata USING (serial_number)
                        WHERE
                            ".get_machine_group_filter('');
        $obj->view('json', array('msg' => current($queryobj->query($sql))));
    }
    
    /**
    * Retrieve automaticdownload in json format
    *
    * @return void
    * @author tuxudo
    **/
    public function get_automaticdownload()
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
  
        $queryobj = new Softwareupdate_model();
        $sql = "SELECT COUNT(1) as total,
                        COUNT(CASE WHEN `automaticdownload` = 1 THEN 1 END) AS 'yes',
                        COUNT(CASE WHEN `automaticdownload` = 0 THEN 1 END) AS 'no'
                        from softwareupdate
                        LEFT JOIN reportdata USING (serial_number)
                        WHERE
                            ".get_machine_group_filter('');
        $obj->view('json', array('msg' => current($queryobj->query($sql))));
    }
    
    /**
    * Retrieve automaticcheckenabled in json format
    *
    * @return void
    * @author tuxudo
    **/
    public function get_automaticcheckenabled()
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
  
        $queryobj = new Softwareupdate_model();
        $sql = "SELECT COUNT(1) as total,
                        COUNT(CASE WHEN `automaticcheckenabled` = 1 THEN 1 END) AS 'yes',
                        COUNT(CASE WHEN `automaticcheckenabled` = 0 THEN 1 END) AS 'no'
                        from softwareupdate
                        LEFT JOIN reportdata USING (serial_number)
                        WHERE
                            ".get_machine_group_filter('');
        $obj->view('json', array('msg' => current($queryobj->query($sql))));
    }
    
    /**
    * Retrieve auto_update in json format
    *
    * @return void
    * @author tuxudo
    **/
    public function get_auto_update()
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
  
        $queryobj = new Softwareupdate_model();
        $sql = "SELECT COUNT(1) as total,
                        COUNT(CASE WHEN `auto_update` = 1 THEN 1 END) AS 'yes',
                        COUNT(CASE WHEN `auto_update` = 0 THEN 1 END) AS 'no'
                        from softwareupdate
                        LEFT JOIN reportdata USING (serial_number)
                        WHERE
                            ".get_machine_group_filter('');
        $obj->view('json', array('msg' => current($queryobj->query($sql))));
    }
    
    /**
    * Retrieve lastsessionsuccessful in json format
    *
    * @return void
    * @author tuxudo
    **/
    public function get_lastsessionsuccessful()
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
  
        $queryobj = new Softwareupdate_model();
        $sql = "SELECT COUNT(1) as total,
                        COUNT(CASE WHEN `lastsessionsuccessful` = 1 THEN 1 END) AS 'yes',
                        COUNT(CASE WHEN `lastsessionsuccessful` = 0 THEN 1 END) AS 'no'
                        from softwareupdate
                        LEFT JOIN reportdata USING (serial_number)
                        WHERE
                            ".get_machine_group_filter('');
        $obj->view('json', array('msg' => current($queryobj->query($sql))));
    }
    
    /**
     * Retrieve data in json format
     *
     **/
    public function get_tab_data($serial_number = '')
    {
        $obj = new View();

        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
        
        $queryobj = new Softwareupdate_model();
        
        $sql = "SELECT automaticcheckenabled, automaticdownload, configdatainstall, criticalupdateinstall, auto_update, auto_update_restart_required, lastattemptsystemversion, lastbackgroundsuccessfuldate, lastfullsuccessfuldate, lastsuccessfuldate, lastresultcode, lastsessionsuccessful, lastupdatesavailable, lastrecommendedupdatesavailable, recommendedupdates, inactiveupdates, catalogurl, skiplocalcdn,  skip_download_lack_space, eval_critical_if_unchanged, one_time_force_scan_enabled, xprotect_version, mrxprotect, gatekeeper_version, gatekeeper_last_modified, gatekeeper_disk_version, gatekeeper_disk_last_modified, kext_exclude_version, kext_exclude_last_modified, mrt_version, mrt_last_modified, enrolled_seed, program_seed, build_is_seed, show_feedback_menu, disable_seed_opt_out, catalog_url_seed, softwareupdate_history
                        FROM softwareupdate 
                        WHERE serial_number = '$serial_number'";
        
        $softwareupdate_tab = $queryobj->query($sql);
        $obj->view('json', array('msg' => current(array('msg' => $softwareupdate_tab)))); 
    }
} // END class Softwareupdate_model