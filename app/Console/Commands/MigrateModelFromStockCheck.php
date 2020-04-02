<?php

namespace App\Console\Commands;

use App\Models\Manufactor;
use App\Models\Model;
use App\Models\Category;
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
        $filename = 'find_query.csv';
        $filepath = public_path($location."/".$filename);
        $file = fopen($filepath,"r");

        $importData_arr = array();
        $i = 0;

        while (($filedata = fgetcsv($file, 1000, ',')) !== FALSE) {
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
            $newCate = Category::firstOrCreate(['name' => $importData[1]]);
            $insertData = array(
                "name"=>$importData[0],
                'categoryId' => $newCate -> id,
            );
            Model::insertData($insertData);

        }
    }
}
