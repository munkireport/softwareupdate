<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class SoftwareupdateRewriteColumns extends Migration
{
    private $tableName = 'softwareupdate';

    public function up()
    {
        $capsule = new Capsule();
        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->boolean('skip_download_lack_space')->nullable();
            $table->boolean('eval_critical_if_unchanged')->nullable();
            $table->boolean('one_time_force_scan_enabled')->nullable();
            $table->boolean('auto_update')->nullable();
            $table->boolean('auto_update_restart_required')->nullable();
            $table->string('xprotect_version')->nullable();
            $table->string('gatekeeper_version')->nullable();
            $table->bigInteger('gatekeeper_last_modified')->nullable();
            $table->string('gatekeeper_disk_version')->nullable();
            $table->bigInteger('gatekeeper_disk_last_modified')->nullable();
            $table->string('kext_exclude_version')->nullable();
            $table->bigInteger('kext_exclude_last_modified')->nullable();
            $table->string('mrt_version')->nullable();
            $table->bigInteger('mrt_last_modified')->nullable();
            $table->string('enrolled_seed')->nullable();
            $table->string('program_seed')->nullable();
            $table->string('build_is_seed')->nullable();
            $table->string('show_feedback_menu')->nullable();
            $table->string('disable_seed_opt_out')->nullable();
            $table->string('catalog_url_seed')->nullable();
            $table->mediumText('softwareupdate_history')->nullable();
            
            $table->index('skip_download_lack_space');
            $table->index('eval_critical_if_unchanged');
            $table->index('one_time_force_scan_enabled');
            $table->index('auto_update');
            $table->index('auto_update_restart_required');
            $table->index('xprotect_version');
            $table->index('gatekeeper_version');
            $table->index('gatekeeper_disk_version');
            $table->index('kext_exclude_version');
            $table->index('mrt_version');
            $table->index('enrolled_seed');
            $table->index('program_seed');
            $table->index('build_is_seed');
            $table->index('show_feedback_menu');
            $table->index('disable_seed_opt_out');
            $table->index('catalog_url_seed');
        });
    }
    
    public function down()
    {
        $capsule = new Capsule();
        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->dropColumn('skip_download_lack_space');
            $table->dropColumn('eval_critical_if_unchanged');
            $table->dropColumn('one_time_force_scan_enabled');
            $table->dropColumn('auto_update');
            $table->dropColumn('auto_update_restart_required');
            $table->dropColumn('xprotect_version');
            $table->dropColumn('gatekeeper_version');
            $table->dropColumn('gatekeeper_last_modified');
            $table->dropColumn('gatekeeper_disk_version');
            $table->dropColumn('gatekeeper_disk_last_modified');
            $table->dropColumn('kext_exclude_version');
            $table->dropColumn('kext_exclude_last_modified');
            $table->dropColumn('mrt_version');
            $table->dropColumn('mrt_last_modified');
            $table->dropColumn('enrolled_seed');
            $table->dropColumn('program_seed');
            $table->dropColumn('build_is_seed');
            $table->dropColumn('show_feedback_menu');
            $table->dropColumn('disable_seed_opt_out');
            $table->dropColumn('catalog_url_seed');          
            $table->dropColumn('softwareupdate_history');          
        });
    }
}
