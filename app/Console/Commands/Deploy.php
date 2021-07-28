<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;

class Deploy extends Command
{
    public const NUMBER_OF_RETRIES = 3;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Collect Data from API in our cache';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (file_exists('vendor/autoload.php')) {
            for($i = 0 ; $i < (self::NUMBER_OF_RETRIES); $i++) {
                try {
                    $this->call('package:discover');
                    $this->call('config:cache');
                    $this->call('migrate');
                    echo 'Successfully migrated.'.PHP_EOL;

                    $this->call('prediction:btc-price');
                    echo 'Retrieved bitcoin price.'.PHP_EOL;

                    try {
                        $this->call('db:seed');
                        echo 'Default data populated.'.PHP_EOL;
                    } catch (Exception $e) {
                        echo 'Seeder did not run.'.PHP_EOL;
                    }

                    $this->call('prediction:get-data');
                    echo 'Retrieved history of actual and prediction values for bitcoin.'.PHP_EOL;

                    $this->call('invoice:status-update');
                    echo 'Invoice status updated.'.PHP_EOL;

                    return 0;
                } catch (Exception $exception) {
                    echo 'Attempting to migrate in 30s'.PHP_EOL;
                    sleep(30);

                    continue;
                }
            }

            echo 'Did not migrate. Exiting'.PHP_EOL;

            return 0;
        }
        echo 'Waiting till autoload is generated. Resuming in 30s'.PHP_EOL;
        sleep(30);

        return $this->handle();
    }
}
