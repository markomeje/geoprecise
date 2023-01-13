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
            $staff = $user->staff;
            if (empty($staff) || auth()->user()->role !== 'admin') {
                return [[], ''];
            }

            $role = $staff->role;
            if (empty($role->permissions) || !$role->permissions()->exists() || auth()->user()->role !== 'admin') {
                return [[], ''];
            }

            $functions = [];
            foreach ($role->permissions as $permission) {
                if ($resource === strtolower($permission->resource)) {
                    $functions[] = $permission->action;
                }
            }

            return [$functions, strtolower($role->name)];
        };

        $allowed = ['owner', 'superadmin', 'admin'];
        Gate::define('view', function(User $user, $resource) use($allowed, $permissions) {
            [$functions, $role] = $permissions($user, $resource);
            return in_array('view', $functions) || in_array($role, $allowed) || in_array(auth()->user()->role, $allowed);
        });

        Gate::define('create', function(User $user, $resource) use($allowed, $permissions) {
            [$functions, $role] = $permissions($user, $resource);
            return in_array('create', $functions) || in_array($role, $allowed) || in_array(auth()->user()->role, $allowed);
        });

        Gate::define('update', function(User $user, $resource) use($allowed, $permissions) {
            [$functions, $role] = $permissions($user, $resource);
            return in_array('update', $functions) || in_array($role, $allowed) || in_array(auth()->user()->role, $allowed);
        });

        Gate::define('delete', function(User $user, $resource) use($allowed, $permissions) {
            [$functions, $role] = $permissions($user, $resource);
            return in_array('delete', $functions) || in_array($role, $allowed) || in_array(auth()->user()->role, $allowed);   
        });

        Gate::define('approve', function(User $user, $resource) use($allowed, $permissions) {
            [$functions, $role] = $permissions($user, $resource);
            return in_array('approve', $functions) || in_array($role, $allowed) || in_array(auth()->user()->role, $allowed);   
        });
    }
}
