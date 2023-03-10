<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\Comment;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function($user) {
            foreach($user->roles as $role){
                if($role->name=='admin') {
                    return true;
                }   
            }
            return false;
        });

        Gate::define('adminAndMyself', function($user, Comment $comment) {
            foreach($user->roles as $role){
                if($role->name=='admin') {
                    return true;
                }   
            }
            if($comment->user_id === $user->id){
                return true;
            }
            return false;
        });
    }
}
