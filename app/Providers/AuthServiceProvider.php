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
            if (empty($staff)) return [[], ''];

            $role = $staff->role;
            if (empty($role->permissions) || !$role->permissions()->exists()) {
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

        $allowed = Role::$withFullAccess;
        collect(['view', 'create', 'approve', 'update'])->map(function ($action) use ($allowed, $getPermissions) {
            Gate::define($action, function(User $user, $resource) use ($allowed, $getPermissions) {
                [$functions, $role] = $getPermissions($user, $resource);
                return in_array('view', $functions) || in_array($role, $allowed);
            });
        });
    }
}
