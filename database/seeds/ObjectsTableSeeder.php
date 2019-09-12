<?php

use Illuminate\Database\Seeder;
use App\ObjectG;

class ObjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Object = ObjectG::create([
            'goal_id' => 1,
            'name' => 'Cosa que no se',
            'estatud' => 1
        ]);
        $Object = ObjectG::create([
            'goal_id' => 1,
            'name' => 'Codsa que no se',
            'estatud' => 1
        ]);
    }
}
