<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ImportController extends Controller
{
    public function index(Request $request)
    {
        $items = Storage::files("imports");
        return view("admin.import.index", compact("items"));
    }

    public function upload(Request $request)
    {
        $file =  $request->file('file');
        $fileName  = $file->getClientOriginalName();
        $file->storeAs('imports',$fileName);
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        Storage::delete($request->importFile);
        return redirect()->back();
    }

    public function import(Request $request)
    {
        $file = $request->importFile;
        $file = storage_path("app/".$file);
        $f = fopen($file, "r");
        $count = 0;
        while ($line = fgets($f)) {
            $arr = explode("|", $line);
            if (array_key_exists(3, $arr)) {
                if ($arr[3] == "no order in the last 6 months") {
                    $no = 1;
                } else {
                    $no = 0;
                };
            } else {
                $no = 0;
            }

            $data = [
                "email" => $arr[0],
                "password" => $arr[1],
                "no_order_6months" => $no,
                "status" => 1,
                "full_address" => $line,
                "state" => trim($arr[2])
            ];
            if(Account::where("email",$data['email'])->first()){

            }else{
                $a = Account::create($data);
                $count++;
            }
        };

        echo "Total imported: $count records.";
    }
}
