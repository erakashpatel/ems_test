<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
            [
                'id'    => '1',
                'module'    => 'Academic',
                'ModuleID' => '1',
            ],
             [
                'id'    => '2',
                'module'    => 'AcademicMisc',
                'ModuleID' => '11',
            ],
             [
                'id'    => '3',
                'module'    => 'Hostel',
                'ModuleID' => '2',
            ],
             [
                'id'    => '4',
                'module'    => 'HostelMisc',
                'ModuleID' => '22',
            ],
             [
                'id'    => '5',
                'module'    => 'Transport',
                'ModuleID' => '3',
            ],
             [
                'id'    => '6',
                'module'    => 'TransportMisc',
                'ModuleID' => '33',
            ],
        ];
         Module::insert($modules);
    }
}
