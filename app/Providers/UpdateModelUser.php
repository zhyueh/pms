<?php

namespace App\Providers;

use Auth;
use Illuminate\Support\ServiceProvider;

class UpdateModelUser extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */

    public function boot()
    {
        $models = [
            'App\Http\Models\Setting\Enum',
            'App\Http\Models\Project\Story',
            'App\Http\Models\Project\StoryComment',
            'App\Http\Models\Project\DevPlan',
            'App\Http\Models\Project\TestCase',
            'App\Http\Models\Project\TestPlan',
            'App\Http\Models\Project\TestResult',
            'App\Http\Models\Project\Bug',
        ];

        foreach($models as $model)
        {
            $model::creating(function ($m){
                $m->created_by = Auth::user()->id;
                $m->updated_by = Auth::user()->id;
                return true;
            });

            $model::updating(function ($m){
                $m->updated_by = Auth::user()->id;
                return true;
            });
        }
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
