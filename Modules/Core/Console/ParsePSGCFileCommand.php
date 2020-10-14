<?php

namespace Modules\Core\Console;

use Illuminate\Console\Command;
use Modules\Core\Entities\City;
use Modules\Core\Entities\Region;
use Modules\Core\Entities\Barangay;
use Modules\Core\Entities\District;
use Modules\Core\Entities\Province;
use Modules\Core\Entities\Municipality;
use Modules\Core\Entities\SubMunicipality;
use Spatie\SimpleExcel\SimpleExcelReader;

class ParsePSGCFileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'psgc:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse PSGC Publication';

    protected $latest = '';

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
     * @return int
     */
    public function handle()
    {
        // source: https://psa.gov.ph/classification/psgc/
        $filePath = storage_path('psgc-mar2020.csv');

        // Delete existing records
        Region::truncate();
        Province::truncate();
        District::truncate();
        City::truncate();
        SubMunicipality::truncate();
        Municipality::truncate();
        Barangay::truncate();

        $rows = SimpleExcelReader::create($filePath)->getRows();

        $rows->each(function (array $properties) {
            $data = [
                'code'         => $properties['Code'],
                'name'         => $properties['Name'],
                'level'        => $properties['Geographic Level'],
                'city_class'   => $properties['City Class'],
                'income_class' => $properties["Income\r\nClassification"],
                'urban_rural'  => $properties["Urban / Rural\r\n(based on 2015 POPCEN)"],
                'population'   => preg_replace('/\D+/', '', $properties["POPULATION\r\n(2015 POPCEN)"]),
            ];

            $data = array_filter($data);

            if (isset($data['level'])) {
                $methods = 'process'.$data['level'];

                $this->$methods($data);
            }
        });
    }

    /**
     * Process Region Data.
     *
     * @param [type] $data
     * @return void
     */
    private function processReg($data)
    {
        // Create new records
        Region::create($data);

        $this->latest = Region::class;
    }

    /**
     * Process Province Data.
     *
     * @param [type] $data
     * @return void
     */
    private function processProv($data)
    {
        // Create new records
        $data['region_id'] = Region::orderBy('id', 'desc')->pluck('id')->first();

        Province::create($data);;

        $this->latest = Province::class;
    }

    /**
     * Process District Data.
     *
     * @param [type] $data
     * @return void
     */
    private function processDist($data)
    {
        // Create new records
        $data['region_id'] = Region::orderBy('id', 'desc')->pluck('id')->first();

        District::create($data);

        $this->latest = District::class;
    }

    /**
     * Process City Data.
     *
     * @param [type] $data
     * @return void
     */
    private function processCity($data)
    {
        // Create new records
        $region   = Region::orderBy('id', 'desc')->first();
        $province = Province::orderBy('id', 'desc')->first();
        $district = District::orderBy('id', 'desc')->first();

        $geographic = optional($district)->created_at > optional($province)->created_at ? $district : $province;

        // 099701000 &x 129804000
        if (in_array($data['code'], ['099701000', '129804000'])) {
            $geographic = $region;
        }

        $data['geographic_type'] = get_class($geographic);
        $data['geographic_id'] = $geographic->id;

        City::create($data);

        $this->latest = City::class;
    }

    /**
     * Process Sub Municipality Data.
     *
     * @param [type] $data
     * @return void
     */
    private function processSubMun($data)
    {
        // Create new records
        $data['city_id'] = City::orderBy('id', 'desc')->pluck('id')->first();

        SubMunicipality::create($data);

        $this->latest = SubMunicipality::class;
    }

    /**
     * Process Municipality Data.
     *
     * @param [type] $data
     * @return void
     */
    private function processMun($data)
    {
        // Create new records
        $data['province_id'] = Province::orderBy('id', 'desc')->pluck('id')->first();

        Municipality::create($data);

        $this->latest = Municipality::class;
    }

    /**
     * Process Barangay Data.
     *
     * @param [type] $data
     * @return void
     */
    private function processBgy($data)
    {
        // Create new records
        $latest = $this->latest;

        $geographic = (new $latest())->orderBy('id', 'desc')->first();

        $data['geographic_type'] = get_class($geographic);
        $data['geographic_id'] = $geographic->id;

        Barangay::create($data);
    }
}
