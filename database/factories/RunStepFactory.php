<?php

namespace Database\Factories;

use ChrisReedIO\Inteliment\Models\RunStep;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RunStepFactory extends Factory
{
    protected $model = RunStep::class;

    public function definition()
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
