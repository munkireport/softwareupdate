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
            Softwareupdate_model::select('softwareupdate.automaticcheckenabled', 'softwareupdate.automaticdownload', 'softwareupdate.configdatainstall', 'softwareupdate.criticalupdateinstall', 'softwareupdate.auto_update', 'softwareupdate.auto_update_restart_required', 'softwareupdate.allow_prerelease_installation', 'softwareupdate.lastattemptsystemversion', 'softwareupdate.lastbackgroundsuccessfuldate', 'softwareupdate.lastfullsuccessfuldate', 'softwareupdate.lastsuccessfuldate', 'softwareupdate.lastresultcode', 'softwareupdate.lastsessionsuccessful', 'softwareupdate.lastupdatesavailable', 'softwareupdate.lastrecommendedupdatesavailable', 'softwareupdate.recommendedupdates', 'softwareupdate.inactiveupdates', 'softwareupdate.catalogurl', 'softwareupdate.skiplocalcdn', 'softwareupdate.skip_download_lack_space', 'softwareupdate.eval_critical_if_unchanged', 'softwareupdate.one_time_force_scan_enabled', 'softwareupdate.managed_do_it_later_deferral_count', 'softwareupdate.managed_product_keys', 'softwareupdate.maximum_managed_do_it_later_deferral_count', 'softwareupdate.force_delayed_minor_updates', 'softwareupdate.minor_deferred_delay', 'softwareupdate.force_delayed_major_updates', 'softwareupdate.major_deferred_delay', 'softwareupdate.allow_rapid_security_response_installation', 'softwareupdate.allow_rapid_security_response_removal', 'softwareupdate.ddm_info', 'softwareupdate.deferred_updates', 'softwareupdate.xprotect_version', 'softwareupdate.mrxprotect',  'softwareupdate.xprotect_payloads_version', 'softwareupdate.xprotect_payloads_last_modified', 'softwareupdate.gatekeeper_version', 'softwareupdate.gatekeeper_last_modified', 'softwareupdate.gatekeeper_disk_version', 'softwareupdate.gatekeeper_disk_last_modified', 'softwareupdate.kext_exclude_version', 'softwareupdate.kext_exclude_last_modified', 'softwareupdate.mrt_version', 'softwareupdate.mrt_last_modified', 'softwareupdate.program_seed', 'softwareupdate.enrolled_seed', 'softwareupdate.catalog_url_seed', 'softwareupdate.softwareupdate_history')
            ->whereSerialNumber($serial_number)
            ->filter()
            ->limit(1)
            ->first()
            ->toArray()
        ]);
    }

    /**
     * Get data for widgets
     *
     * @return void
     * @author tuxudo
     **/
    public function get_binary_widget($column = '')
    {
        jsonView(
            Softwareupdate_model::select($column . ' AS label')
                ->selectRaw('count(*) AS count')
                ->whereNotNull($column)
                ->filter()
                ->groupBy($column)
                ->orderBy('count', 'desc')
                ->get()
                ->toArray()
        );
    }

    public function get_binary_widgetx($column = '')
    {
        jsonView(
            Softwareupdate_model::selectRaw("IF($column = 0, 0, 1) AS label")
                ->selectRaw('count(*) AS count')
                ->whereNotNull($column)
                ->filter()
                ->groupBy('label') // Group by the label instead of the original column
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
                    ->selectRaw('count(*) AS count')
                    ->whereNotNull($column)
                    ->where($column, '<>', '')
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