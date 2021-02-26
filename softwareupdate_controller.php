<?php 

/**
 * softwareupdate class
 *
 * @package munkireport
 * @author 
 **/
class Softwareupdate_controller extends Module_controller
{
	    function __construct()
    {
        // Store module path
        $this->module_path = dirname(__FILE__);
    }
	
    /**
     * Get softwareupdate information for serial_number
     *
     * @param string $serial serial number
     **/
    public function get_tab_data($serial_number = '')
    {
        jsonView([
            Softwareupdate_model::select('softwareupdate.automaticcheckenabled', 'softwareupdate.automaticdownload', 'softwareupdate.configdatainstall', 'softwareupdate.criticalupdateinstall', 'softwareupdate.auto_update', 'softwareupdate.auto_update_restart_required', 'softwareupdate.lastattemptsystemversion', 'softwareupdate.lastbackgroundsuccessfuldate', 'softwareupdate.lastfullsuccessfuldate', 'softwareupdate.lastsuccessfuldate', 'softwareupdate.lastresultcode', 'softwareupdate.lastsessionsuccessful', 'softwareupdate.lastupdatesavailable', 'softwareupdate.lastrecommendedupdatesavailable', 'softwareupdate.recommendedupdates', 'softwareupdate.inactiveupdates', 'softwareupdate.catalogurl', 'softwareupdate.skiplocalcdn', 'softwareupdate.skip_download_lack_space', 'softwareupdate.eval_critical_if_unchanged', 'softwareupdate.one_time_force_scan_enabled', 'softwareupdate.xprotect_version', 'softwareupdate.mrxprotect', 'softwareupdate.gatekeeper_version', 'softwareupdate.gatekeeper_last_modified', 'softwareupdate.gatekeeper_disk_version', 'softwareupdate.gatekeeper_disk_last_modified', 'softwareupdate.kext_exclude_version', 'softwareupdate.kext_exclude_last_modified', 'softwareupdate.mrt_version', 'softwareupdate.mrt_last_modified', 'softwareupdate.enrolled_seed', 'softwareupdate.program_seed', 'softwareupdate.build_is_seed', 'softwareupdate.show_feedback_menu', 'softwareupdate.disable_seed_opt_out', 'softwareupdate.catalog_url_seed', 'softwareupdate.softwareupdate_history')
            ->whereSerialNumber($serial_number)
            ->filter()
            ->limit(1)
            ->first()
            ->toArray()
        ]);
    }

    /**
     * Get data for binary widget
     *
     * @return void
     * @author tuxudo
     **/
    public function get_binary_widget($column = '')
    {
        jsonView(
            Softwareupdate_model::select($column . ' AS label')
                ->selectRaw('count(*) AS count')
                ->filter()
                ->groupBy($column)
                ->orderBy('count', 'desc')
                ->get()
                ->toArray()
        );
    }

    public function get_scroll_widget($column = '')
    {
        $this->get_binary_widget($column);
    }

    public function get_pending_widget($column = '')
    {
        $updates = [];
        

        foreach(Softwareupdate_model::select($column . ' AS label')
                    ->filter()
                    ->groupBy($column)
                    ->orderBy('count', 'desc')
                    ->get()
                    ->toArray() as $update){
            $update_array = explode( ', ', $update['label']);
            foreach($update_array as $update_single){
                $updates[] = $update_single;
            }
        }

        $update_count = array_count_values($updates);
        arsort($update_count);

        $out = [];
        foreach($update_count as $label => $value){
                $out[] = ['label' => $label, 'count' => $value];
        }
        
        jsonView($out);        
    }
} 