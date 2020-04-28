<?php

namespace App\Console\Commands;

use App\Models\Condition;
use App\Models\Item;
use App\Models\Manufactor;
use App\Models\Model;
use App\Models\Category;
use App\Models\OldModel;
use App\Models\Supplier;
use app\Models\WHLocation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MigrateModelFromStockCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:migratemodelfromstockcheck';

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

//            $newSup = Supplier::firstOrCreate(['name' => $importData[0]])
//            $newModelll = explode('#', $importData[1]) ;

//            if($importData[8] == ""){
//                $newModel = explode('#', $importData[2]) ;
//                $importData[8] = $newModel[0];
//            }
//
//            if($importData[7] == ""){
//                $importData[7] = $importData[2];
//            }
            Log::info($importData[5]);
            $newModel = Model::updateOrCreate(['name' => $importData[1]],[ 'addedBy' => 'Old Data']);
            $newCon = Condition::firstOrCreate(['name' => $importData[3]]);

            if(!$importData[3] || $importData[3] == 6.01E+11 || $importData[3] == 6.01004E+11){
                $importData[3] = now() -> timestamp;
            }

            $insertData = array(

                "supplierId" => 39,
                "conditionId" => $newCon -> id,
                "created_at" => date('Y/m/d H:i:s', $importData[5]),
                "serialNumber" => $importData[2],
                "stockStatus" => $importData[6],
                "note"=> $importData[4],
                "aliasModel" => $importData[1],
                "modelId" => $newModel -> id,
                "whlocationId" => 1,
                "addedBy" => 'Old data',
                "smartnet" => 'NC',

//                "supplierId" => $importData[0],
//                "modelId" => $importData[1],
//                "serialNumber" => $importData[2],
//                "note"=> $importData[4],
//                "conditionId" => $importData[5],
//                "stockStatus" => $importData[6],
//                "whlocationId" => $importData[7],
//                "location" => $importData[8],
//                "smartnet" => $importData[9],
//                "addedBy" => $importData[10],
//                "created_at" => now(),

            );
            Item::insertData($insertData);

        }
    }
}
