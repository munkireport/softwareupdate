<?php

// Database seeder
// Please visit https://github.com/fzaninotto/Faker for more options

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Softwareupdate_model::class, function (Faker\Generator $faker) {

    return [
        'automaticcheckenabled' => $faker->boolean(),
        'automaticdownload' => $faker->boolean(),
        'configdatainstall' => $faker->boolean(),
        'criticalupdateinstall' => $faker->boolean(),
        'lastattemptsystemversion' => $faker->word(),
        'lastbackgroundccdsuccessfuldate' => $faker->dateTimeBetween('-1 month')->format('U'),
        'lastbackgroundsuccessfuldate' => $faker->dateTimeBetween('-1 month')->format('U'),
        'lastfullsuccessfuldate' => $faker->dateTimeBetween('-1 month')->format('U'),
        'lastrecommendedupdatesavailable' => $faker->randomNumber($nbDigits = 4, $strict = false),
        'lastresultcode' => $faker->randomNumber($nbDigits = 4, $strict = false),
        'lastsessionsuccessful' => $faker->boolean(),
        'lastsuccessfuldate' => $faker->dateTimeBetween('-1 month')->format('U'),
        'lastupdatesavailable' => $faker->randomNumber($nbDigits = 4, $strict = false),
        'skiplocalcdn' => $faker->boolean(),
        'recommendedupdates' => $faker->word(),
        'mrxprotect' => $faker->dateTimeBetween('-1 month')->format('U'),
        'catalogurl' => $faker->word(),
        'inactiveupdates' => $faker->word(),
        'skip_download_lack_space' => $faker->randomNumber($nbDigits = 4, $strict = false),
        'eval_critical_if_unchanged' => $faker->boolean(),
        'one_time_force_scan_enabled' => $faker->boolean(),
        'auto_update' => $faker->boolean(),
        'auto_update_restart_required' => $faker->boolean(),
        'xprotect_version' => $faker->word(),
        'gatekeeper_version' => $faker->word(),
        'gatekeeper_last_modified' => $faker->dateTimeBetween('-1 month')->format('U'),
        'gatekeeper_disk_version' => $faker->word(),
        'gatekeeper_disk_last_modified' => $faker->dateTimeBetween('-1 month')->format('U'),
        'kext_exclude_version' => $faker->word(),
        'kext_exclude_last_modified' => $faker->dateTimeBetween('-1 month')->format('U'),
        'mrt_version' => $faker->word(),
        'mrt_last_modified' => $faker->dateTimeBetween('-1 month')->format('U'),
        'enrolled_seed' => $faker->word(),
        'program_seed' => $faker->numberBetween(0, 3),
        'build_is_seed' => $faker->word(),
        'show_feedback_menu' => $faker->word(),
        'disable_seed_opt_out' => $faker->word(),
        'catalog_url_seed' => $faker->word(),
        'softwareupdate_history' => json_encode([]),
    ];
});
