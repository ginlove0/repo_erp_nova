<?php

namespace App\Console\Commands;

use App\Models\Condition;
use App\Models\Item;
use App\Models\Model;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MigrateLocationFromStockCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:migratelocation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        //
        $location = 'uploads';
        $filename = 'itemWithNewModelName_AU.csv';
        $filepath = public_path($location."/".$filename);
        $file = fopen($filepath,"r");


        $importData_arr = array();
        $i = 0;

        while (($filedata = fgetcsv($file, 20000, ',')) !== FALSE) {
            $num = count($filedata );
            // Skip first row (Remove below comment if you want to skip the first row)
            if($i == 0){
                $i++;
                continue;
            }
            for ($c=0; $c < $num; $c++) {
                $importData_arr[$i][] = $filedata [$c];
            }
            $i++;
        }
        fclose($file);
        // Insert to MySQL database
        foreach($importData_arr as $importData){
            $newModelll = explode('#', $importData[1]) ;
            $modelData = Model::updateOrCreate(['name' => $newModelll[0]], ['addedBy' => "Add by stock-check" ]);
            $conditionData = Condition::updateOrCreate(['name' => $importData[4]]);
            Item::updateOrCreate(
                ['serialNumber' => $importData[0]],
                [
                    'supplierId' => 39,
                    'modelId' => $modelData -> id,
                    'conditionId' => $conditionData -> id,
                    'location' => $importData[2],
                    'whlocationId' => 1,
                    'aliasModel' => $importData[1],
                ]);

        }
    }
}
