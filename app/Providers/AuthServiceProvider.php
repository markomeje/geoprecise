<?php

namespace App\Providers;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $permissions = function($user, $resource) {
            $permissions = [];
            if (!$user->permissions()->exists() || !($user->permissions()->count() > 0)) {
                return [];
            }

            foreach ($user->permissions as $access) {
                $permissions[] = ($resource === $access->resource) ? $access->permission : [];
            }

            return $permissions;
        };

        // if (request()->user()->cannot('create', ['units'])) {
        //     return response()->json([
        //         'status' => 0, 
        //         'info' => 'Sorry. You cannot perform this operation.'
        //     ]);
        // }

        $allowed = ['owner'];
        Gate::define('view', function(User $user, $resource) use($allowed, $permissions) {
            return in_array('view', $permissions($user, $resource)) || in_array($user->role, $allowed);
        });

        Gate::define('create', function(User $user, $resource) use($allowed, $permissions) {
            return in_array('create', $permissions($user, $resource)) || in_array($user->role, $allowed);
        });

        Gate::define('update', function(User $user, $resource) use($allowed, $permissions) {
            return in_array('update', $permissions($user, $resource)) || in_array($user->role, $allowed);   
        });

        Gate::define('delete', function(User $user, $resource) use($allowed, $permissions) {
            return in_array('delete', $permissions($user, $resource)) || in_array($user->role, $allowed);   
        });
    }
}
