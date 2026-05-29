<?php

namespace Training\Api\Database\Seeders;

use Admin\Api\Models\User;
use Illuminate\Database\Seeder;

class UserCsvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        echo PHP_EOL . 'Running UserCsvSeeder...' . PHP_EOL;

        try {
            //..
            $file = fopen(__DIR__."/./data/users.csv","r");
            $users_data = [];
            $row = 0;
            /**
             * 0.id
             * 1.name
             * 2.email
             */
            if (($handle = $file) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $row++;
                    //skip first
                    if($row === 1){
                        //return;
                    } else {
                        $model = User::create([
                            'name' => $data[1],
                            'email' => $data[2],
                            'password' => bcrypt($data[2]),
                        ]);

                        //Add to array
                        $users_data[$data[0]] = $model;
                    }
                }
                fclose($handle);
            }

            echo PHP_EOL . 'SEEDED Users:'. count($users_data) . PHP_EOL;

        } catch (\Exception $exception) {
            echo PHP_EOL . json_encode($exception->getMessage(), JSON_PRETTY_PRINT) . PHP_EOL;
        }


    }
}