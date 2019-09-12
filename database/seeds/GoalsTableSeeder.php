<?php

use Illuminate\Database\Seeder;
use App\Goal;

class GoalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Goal = Goal::create([
            'project_id' => 1,
            'name' => 'Publicidad',
            'estatud' => '1',
            'quantity' => 0
        ]);
        $Goal = Goal::create([
            'project_id' => 1,
            'name' => 'Ventas',
            'estatud' => '1',
            'quantity' => 0
        ]);
    }
}
