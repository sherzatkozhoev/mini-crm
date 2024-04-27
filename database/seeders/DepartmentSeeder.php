<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            'IT',
            'Маркетинг и продажи',
            'Финансы',
            'Производство',
            'Связи с общественностью',
            'HR',
        ];

        foreach (range(1,9) as $index) {
            foreach ($departments as $department) {
                DB::table('departments')->insert([
                    'name'            => $department,
                    'description'     => fake()->paragraph(1),
                    'organization_id' => $index,
                    'created_at'      => Carbon::now(),
                    'updated_at'      => Carbon::now(),
                ]);
            }
        }
    }
}
