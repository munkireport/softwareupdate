<?php

use munkireport\models\MRModel as Eloquent;

class Softwareupdate_model extends Eloquent
{
    protected $table = 'softwareupdate';

    protected $hidden = ['id', 'serial_number'];

    protected $fillable = [
      'serial_number',
      'automaticcheckenabled',
      'automaticdownload',
      'configdatainstall',
      'criticalupdateinstall',
      'lastattemptsystemversion',
      'lastbackgroundccdsuccessfuldate',
      'lastbackgroundsuccessfuldate',
      'lastfullsuccessfuldate',
      'lastrecommendedupdatesavailable',
      'lastresultcode',
      'lastsessionsuccessful',
      'lastsuccessfuldate',
      'lastupdatesavailable',
      'skiplocalcdn',
      'recommendedupdates',
      'mrxprotect',
      'catalogurl',
      'inactiveupdates',
      'skip_download_lack_space',
      'eval_critical_if_unchanged',
      'one_time_force_scan_enabled',
      'auto_update',
      'auto_update_restart_required',
      'xprotect_version',
      'gatekeeper_version',
      'gatekeeper_last_modified',
      'gatekeeper_disk_version',
      'gatekeeper_disk_last_modified',
      'kext_exclude_version',
      'kext_exclude_last_modified',
      'mrt_version',
      'mrt_last_modified',
      'enrolled_seed',
      'program_seed',
      'build_is_seed',
      'show_feedback_menu',
      'disable_seed_opt_out',
      'catalog_url_seed',
      'softwareupdate_history',
    ];
}
