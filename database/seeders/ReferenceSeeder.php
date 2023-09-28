<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $ref = [
            // type
            [
                'name' => 'ticket-type',
                'code' => 'bug',
                'value' => 'Bug'
            ],
            [
                'name' => 'ticket-type',
                'code' => 'feedback-suggestion',
                'value' => 'Feedback & Suggestion'
            ],
            [
                'name' => 'ticket-type',
                'code' => 'others',
                'value' => 'Others'
            ],

            //status
            [
                'name' => 'status',
                'code' => 'open',
                'value' => 'Open'
            ],
            [
                'name' => 'status',
                'code' => 'in-progress',
                'value' => 'In Progress'
            ],
            [
                'name' => 'status',
                'code' => 'closed',
                'value' => 'Closed'
            ],
            //priority
            [
                'name' => 'priority',
                'code' => 'low',
                'value' => 'Low'
            ],
            [
                'name' => 'priority',
                'code' => 'medium',
                'value' => 'Medium'
            ],
            [
                'name' => 'priority',
                'code' => 'high',
                'value' => 'High'
            ],
        ];
        DB::table('references')->insert($ref);
    }
}
