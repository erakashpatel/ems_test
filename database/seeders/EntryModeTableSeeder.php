<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EntryMode;
class EntryModeTableSeeder extends Seeder
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
                'Entry_modename'    => 'due',
                'crdr' => 'D',
                'entrymodeno'=>'0'
            ],
            [
                'id'    => '2',
                'Entry_modename'    => 'revdue',
                'crdr' => 'C',
                'entrymodeno'=>'12'
            ],[
                'id'    => '3',
                'Entry_modename'    => 'scholarship',
                'crdr' => 'C',
                'entrymodeno'=>'15'
            ],[
                'id'    => '4',
                'Entry_modename'    => 'scholarship/revconcession',
                'crdr' => 'D',
                'entrymodeno'=>'16'
            ],[
                'id'    => '5',
                'Entry_modename'    => 'concession',
                'crdr' => 'C',
                'entrymodeno'=>'15'
            ],[
                'id'    => '6',
                'Entry_modename'    => 'rcpt',
                'crdr' => 'C',
                'entrymodeno'=>'0'
            ]
            ,[
                'id'    => '7',
                'Entry_modename'    => 'revrcpt',
                'crdr' => 'D',
                'entrymodeno'=>'0'
            ]
            ,[
                'id'    => '8',
                'Entry_modename'    => 'jv',
                'crdr' => 'C',
                'entrymodeno'=>'14'
            ]
            ,[
                'id'    => '9',
                'Entry_modename'    => 'revjv',
                'crdr' => 'D',
                'entrymodeno'=>'14'
            ]
            ,[
                'id'    => '10',
                'Entry_modename'    => 'pmt',
                'crdr' => 'D',
                'entrymodeno'=>'1'
            ]
             ,[
                'id'    => '11',
                'Entry_modename'    => 'revpmt',
                'crdr' => 'C',
                'entrymodeno'=>'1'
            ]
            ,[
                'id'    => '12',
                'Entry_modename'    => 'fundtransfer',
                'crdr' => 'positive or nagetive',
                'entrymodeno'=>'1'
            ],
        ];
         EntryMode::insert($modules);
    }
}
