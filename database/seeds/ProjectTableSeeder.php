<?php

use Illuminate\Database\Seeder;
use App\Project;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project = Project::create([
            'name' => 'projects',
            'mission' => 'mission',
            'vision' => 'vision',
            'estatud' => '1',
            'user_id' => 2
        ]);
        $project = Project::create([
            'name' => 'projects',
            'mission' => 'mission',
            'vision' => 'vision',
            'estatud' => '1',
            'user_id' => 3
        ]);
    }
}
