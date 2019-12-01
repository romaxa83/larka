<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Schema;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FillSensorData extends Command
{
    protected $signature = 'sensor:meta';

    protected $description = 'Fill metadata to sensors tables';

    const TABLE_SENSOR = 'sensors_sensor';
    const TABLE_SENSORS = 'sensors_sensors';
    const TABLE_LOCATION = 'sensors_location';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        DB::table(self::TABLE_SENSOR)->insert($this->getData(self::TABLE_SENSOR));
        DB::table(self::TABLE_SENSORS)->insert($this->getData(self::TABLE_SENSORS));
        DB::table(self::TABLE_LOCATION)->insert($this->getData(self::TABLE_LOCATION));

//        $this->fillTable(self::TABLE_SENSOR);
//        $this->fillTable(self::TABLE_SENSORS);
//        $this->fillTable(self::TABLE_LOCATION);
    }

    private function fillTable($tableName)
    {
        if(!$this->existTable($tableName)){
            return;
        }

        if(!DB::table($tableName)->count()){
            $this->info("Таблица (${$tableName}) уже заполнена");
            return;
        }

        DB::table($tableName)->insert($this->getData($tableName));

        $this->info("Таблица (${$tableName}) заполнена тестовыми метаданными");

        return;

    }

    private function existTable($tableName) : bool
    {
        if(!$true = Schema::hasTable($tableName)){
            $this->error("Таблицы (${$tableName}) нету");
        }

        return $true ?? true;
    }

    private function isFillTable($tableName) : bool
    {
        if(DB::table($tableName)->count()){

            $this->info("Таблицы (${$tableName}) заполнена мета данными");
        }
        return $true ?? true;
    }

    private function getData($tableName)
    {
        if($tableName == self::TABLE_SENSOR){
            return [
                [
                    'sensor_type_id' => 1,
                    'sensor_type' => 'Температура',
                ],
                [
                    'sensor_type_id' => 2,
                    'sensor_type' => 'Влажность',
                ],
            ];
        }

        if($tableName == self::TABLE_LOCATION){
            return [
                [
                    'location_id' => 1,
                    'customer' => 'Labs',
                    'department' => 'R&D',
                    'building_name' => '222 Broadway',
                    'room' => 101,
                    'floor' => 1,
                    'location_on_floor' => 'c-101',
                    'latitude' => '40.710936',
                    'longitude' => '-74.008500',
                ],
            ];
        }

        if($tableName == self::TABLE_SENSORS){
            return [
                [
                    'sensor_id' => 1,
                    'sensor_type_id' => 1,
                    'location_id' => 1,
                ],
                [
                    'sensor_id' => 2,
                    'sensor_type_id' => 2,
                    'location_id' => 1,
                ],
            ];
        }
    }
}