<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class SoftwareupdateXprotectPayloads extends Migration
{
    private $tableName = 'softwareupdate';

    public function up()
    {
        $capsule = new Capsule();
        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->string('xprotect_payloads_version')->nullable();
            $table->bigInteger('xprotect_payloads_last_modified')->nullable();
            
            $table->index('xprotect_payloads_version');
        });
    }
    
    public function down()
    {
        $capsule = new Capsule();
        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->dropColumn('xprotect_payloads_version');
            $table->dropColumn('xprotect_payloads_last_modified');       
        });
    }
}
