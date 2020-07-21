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
            Softwareupdate_model::select('softwareupdate.*')
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