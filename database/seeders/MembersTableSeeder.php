<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Member;
use Illuminate\Support\Arr;


class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $area = array('東京','大阪','福岡','北海道');
        $leader = array(true, false);
        $comment = array('こんにちは','こんばんわ');
        $gender = array('男性','女性','その他');


        for($i = 0; $i<100; $i++){

            DB::table('members')->insert(
                [
                    'team_id' => Arr::random([1, 2, 3]),
                    'name' => "$i . さん",
                    'age' => $i,
                    'area' => Arr::random($area),
                    'leader' => Arr::random($leader),
                    'comment' => Arr::random($comment),
                    'gender' => Arr::random($gender),
                ]);
        }
    }
}
