<?php

namespace App\Console\Commands;

use App\Models\Account;
use Illuminate\Console\Command;

class import extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import {file}';

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
     * @return int
     */
    public function handle()
    {
        Account::truncate();
        $file = storage_path("app/imports/" . $this->argument("file"));
        $f = fopen($file, "r");
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
            $a = Account::create($data);
            echo "\n";
            dump($a->toArray());
        };
        return 0;
    }
}
