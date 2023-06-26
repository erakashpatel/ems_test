<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Branch;
use App\Models\FeeCategory;
use App\Models\FeeCollectionType;
use App\Models\FeeTypes;
use App\Models\Module;
use App\Models\EntryMode;
use App\Models\FinancialTrans;
use App\Models\FinancialTransDetail;
use App\Models\CommonFeeCollection;
use App\Models\CommonFeeCollectionHeadwise;

class SendDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $row;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($row)
    {
        $this->row = $row;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         // Process each row and save the data
             $row = $this->row;
            // Create or update Branch record
            $branch_id = Branch::updateOrCreate(
                                        ['name' => $row[11]],
                                        ['name' => $row[11]]
                                    )->id;
            // Create or update FeeCategory record
            $feeCategory = FeeCategory::updateOrCreate(
                ['fee_category' => $row[10], 'br_id' => $branch_id],
                ['fee_category' => $row[10], 'br_id' => $branch_id]
            );

            if (strpos(strtolower($row[16]), 'fine') !== false) {
                $module = Module::where('module','AcademicMisc')->get()->first();
            }else if (strpos(strtolower($row[16]), 'mess') !== false) {
                $module = Module::where('module','Hostel')->get()->first();
            }else{
                $module = Module::where('module','Academic')->get()->first();
            }
            $fee_c_t = FeeCollectionType::updateOrCreate(
                ['collectionhead' => $module->module, 'br_id' => $branch_id],
                ['collectionhead' => $module->module, 'br_id' => $branch_id]
            );

             $feetype = FeeTypes::updateOrCreate(
                [
                    'fee_category' => $feeCategory->id,
                    'f_name' => $row[16],
                    'br_id' => $branch_id,
                    'Collection_id'=> $fee_c_t->id,
                    'Fee_headtype' => $module->id
                ],
                [
                    'fee_category' => $feeCategory->id,
                    'f_name' => $row[16],
                    'br_id' => $branch_id,
                    'Collection_id'=> $fee_c_t->id,
                    'Fee_headtype' => $module->id,
                    'Fee_type_ledger' =>  $row[16],
                ]
            );

              $entry_mode = EntryMode::where('Entry_modename',strtolower($row[5]))->get()->first();
                $type_of_concession = '';
                $amount = 0;
                if($entry_mode->Entry_modename == 'due'){
                    $amount = $row[17]; 
                }else if($entry_mode->Entry_modename == 'revdue'){
                    $amount = $row[22];
                }else if($entry_mode->Entry_modename == 'scholarship'){
                    $amount = $row[20];
                    $type_of_concession = '2';
                }else if($entry_mode->Entry_modename == 'scholarship/revconcession' || $entry_mode->Entry_modename == 'revconcession/scholarship'){
                    $amount = $row[21];
                }else if($entry_mode->Entry_modename == 'concession'){
                    $amount = $row[19];
                    $type_of_concession = '1';
                }else if($entry_mode->Entry_modename == 'rcpt'){
                    $amount = $row[18];
                }else if($entry_mode->Entry_modename == 'revrcpt'){
                    $amount = $row[18];
                }else if($entry_mode->Entry_modename == 'jv'){
                    $amount = $row[23];
                }else if($entry_mode->Entry_modename == 'revjv'){
                    $amount = $row[23];
                }else if($entry_mode->Entry_modename == 'pmt'){
                    $amount = $row[24];
                }else if($entry_mode->Entry_modename == 'revpmt'){
                    $amount = $row[24];
                }else if($entry_mode->Entry_modename == 'fundtransfer'){
                    $amount = $row[25];
                }
            // Voucher type : $row[5];
            $entry_modes =  EntryMode::whereIn('Entry_modename',['due','concession','scholarship','revdue','revconcession/scholarship','scholarship/revconcession'])->pluck('Entry_modename')->toArray();
            // echo '<pre>';
            // echo $row[5];
            // print_r($entry_modes);
            // exit;
            if(in_array(strtolower($row[5]),$entry_modes)){ // FinancialTrans
                    $financialTranData = FinancialTrans::where('voucherno',strtolower($row[6]))->get()->first();
                    if(!$financialTranData){
                                        $financialTranData = FinancialTrans::create(['module_id'=> $module->id,
                                                    'tranid' => rand(0,10000000),
                                                    'admno' => $row[7],
                                                    'amount' => $amount,
                                                    'crdr' => $entry_mode->crdr,
                                                    'tranDate' => date('y-m-d',strtotime($row[2])),
                                                    'acadYear' => $row[3],
                                                    'entrymode_id' => $entry_mode->id?$entry_mode->id:0,
                                                    'voucherno' => $row[6],
                                                    'br_id' => $branch_id,
                                                    'type_of_concession' => $type_of_concession
                                            ]);
                                                FinancialTransDetail::create([
                                                    'financial_tran_id' => $financialTranData->id,
                                                    'module_id' => $module->id,
                                                    'head_id' => $feetype->id,
                                                    'amount' => $amount,
                                                    'crdr'=> $entry_mode->crdr,
                                                    'br_id' => $branch_id,
                                                    'head_name' => $feetype->f_name
                                                ]);
                    
                }else{
                    
                            $newamount = round($financialTranData->amount) + round($amount);
                               $ftans = FinancialTrans::find($financialTranData->id);
                               $ftans->amount = $newamount;
                               $ftans->save();
                            FinancialTransDetail::create([
                                                            'financial_tran_id' => $financialTranData->id,
                                                            'module_id' => $module->id,
                                                            'amount' => $amount,
                                                            'head_id' => $feetype->id,
                                                            'crdr'=> $entry_mode->crdr,
                                                            'br_id' => $branch_id,
                                                            'head_name' => $feetype->f_name
                                                        ]);

                }
            }else{ 
                              //comman fee collection 
                $CommonFeeCollectionData = CommonFeeCollection::where('rollno',strtolower($row[7]))->get()->first();
                if(!$CommonFeeCollectionData){
                    $CommonFeeCollectionData = CommonFeeCollection::create([
                                        'module_id' => $module->id,
                                        'trans_id' => rand(0,1000000),
                                        'admno' => $row[8],
                                        'rollno' => $row[7],
                                        'amount' => $amount,
                                        'br_id' => $branch_id,
                                        'academic_year' => $row[3],
                                        'financial_year' => $row[3],
                    ]);
                    CommonFeeCollectionHeadwise::create([
                                        'module_id' => $module->id,
                                        'receipt_id' => $CommonFeeCollectionData->id,
                                        'head_id' => $feetype->id,
                                        'head_name' => $feetype->f_name,
                                        'br_id' => $branch_id,
                                        'amount' => $amount
                                     ]);

                }else{
                        $newamount1 = round($CommonFeeCollectionData->amount) + round($amount);
                        $CommonFee = CommonFeeCollection::find($CommonFeeCollectionData->id);
                        $CommonFee->amount = $newamount1;
                        $CommonFee->save();
                        CommonFeeCollectionHeadwise::create([
                                    'module_id' => $module->id,
                                    'receipt_id' => $CommonFeeCollectionData->id,
                                    'head_id' => $feetype->id,
                                    'head_name' => $feetype->f_name,
                                    'br_id' => $branch_id,
                                    'amount' => $amount
                                 ]);

                }
            }
                

        }
    
}
