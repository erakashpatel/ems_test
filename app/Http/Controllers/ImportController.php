<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendDataJob;
use Illuminate\Support\Facades\File;
class ImportController extends Controller
{
    public function showImportForm()
    {
        return view('import');
    }

    public function import(Request $request)
    {

        // Validate the uploaded file
        request()->validate([
            'csv_file' => 'required|mimes:csv,txt',
        ]);

        $file =  file($request->csv_file);
        unset($file[0]); // csv file have first row empty so removed it.
        $header = $file[1]; // csv header 
        $chunks = array_chunk($file,500); 
       
        $path = public_path('temp');

        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
        $path = public_path('temp');
        $files = File::glob($path . '/*.csv');  
        File::delete($files); // delete ago files before spliting files.

        foreach ($chunks as $key => $chunk) {
            $key++;
            $newchunk_with_header = array_merge(array($header),$chunk); // merge header in all files.
            $name = "/tmp{$key}.csv";
            $path = public_path('temp');
            file_put_contents($path.$name, $newchunk_with_header);
        }
      
       
        // Redirect back or to a success page
        return redirect()->back()->with('message1', 'Split Data successfully.');
    }
    public function store(){
        $path = public_path('temp');
        $files = File::glob($path . '/*.csv'); // read folder all csv files.
        foreach ($files as $file_key => $file_value) {
           $csvData = file_get_contents($file_value);
           $rows = array_map('str_getcsv', explode("\n", $csvData));
                $removefirstrow = array_shift($rows);
                $header = array_shift($rows);
                foreach ($rows as $key => $row) {
                    if($row[0]){
                        SendDataJob::dispatch($row);
                    }
                }
        }
        File::delete($files);
        return redirect()->back()->with('message', 'Storing all files data in background.');
    }
}
