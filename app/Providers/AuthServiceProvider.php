<?php

namespace App\Providers;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\{User, Role};

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $getPermissions = function($user, $resource) {
            $staff = $user->staff;

            $functions = [];
            if (empty($staff)) return [[], ''];

            $role = $staff->role;
            if ($role->permissions()->exists()) {
                foreach ($role->permissions as $permission) {
                    if ($resource === strtolower($permission->resource)) {
                        $functions[] = $permission->action;
                    }
                }
            }

            return [$functions, strtolower($role->name)];
        };

        $rolesWithFullAccess = Role::$withFullAccess;
        Gate::define('view', function(User $user, $resource) use ($rolesWithFullAccess, $getPermissions) {

            [$functions, $role] = $getPermissions($user, $resource);
            return in_array($role, $rolesWithFullAccess) || in_array('view', $functions);
        });

        Gate::define('create', function(User $user, $resource) use ($rolesWithFullAccess, $getPermissions) {

            [$functions, $role] = $getPermissions($user, $resource);
            return in_array('create', $functions) || in_array($role, $rolesWithFullAccess);
        });

        Gate::define('approve', function(User $user, $resource) use ($rolesWithFullAccess, $getPermissions) {

            [$functions, $role] = $getPermissions($user, $resource);
            return in_array('approve', $functions) || in_array($role, $rolesWithFullAccess);
        });

        Gate::define('update', function(User $user, $resource) use ($rolesWithFullAccess, $getPermissions) {
            
            [$functions, $role] = $getPermissions($user, $resource);
            return in_array('update', $functions) || in_array($role, $rolesWithFullAccess);
        });

        Gate::define('delete', function(User $user, $resource) use ($rolesWithFullAccess, $getPermissions) {
            
            [$functions, $role] = $getPermissions($user, $resource);
            return in_array('delete', $functions) || in_array($role, $rolesWithFullAccess);
        });
    }
}
