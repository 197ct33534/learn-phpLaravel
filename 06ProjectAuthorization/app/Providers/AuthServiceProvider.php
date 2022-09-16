<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Modules;
use App\Models\User;
use App\Models\Posts;
use App\Models\Groups;
use App\Policies\PostsPolicy;
use App\Policies\UsersPolicy;
use App\Policies\GroupsPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Posts::class => PostsPolicy::class,
        User::class => UsersPolicy::class,
        Groups::class => GroupsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // get module List
        $moduleList = Modules::all();


        if ($moduleList->count() > 0) {
            foreach ($moduleList as $idx => $module) {
                // gate :users.view , posts.view, groups.view
                Gate::define($module->name, function (User $user) use ($module) {
                    $dataPermissionsJSON = $user->getGroup->permissions;

                    $dataPermissionArr = [];
                    if (!empty($dataPermissionsJSON)) {
                        $dataPermissionArr = json_decode($dataPermissionsJSON, true);
                        $check = is_Role($dataPermissionArr, $module->name);
                        return $check;
                    }
                    return false;
                });

                Gate::define($module->name . '.edit', function (User $user) use ($module) {
                    $dataPermissionsJSON = $user->getGroup->permissions;

                    $dataPermissionArr = [];
                    if (!empty($dataPermissionsJSON)) {
                        $dataPermissionArr = json_decode($dataPermissionsJSON, true);
                        $check = is_Role($dataPermissionArr, $module->name, 'edit');
                        return $check;
                    }
                    return false;
                });
                Gate::define($module->name . '.delete', function (User $user) use ($module) {
                    $dataPermissionsJSON = $user->getGroup->permissions;

                    $dataPermissionArr = [];
                    if (!empty($dataPermissionsJSON)) {
                        $dataPermissionArr = json_decode($dataPermissionsJSON, true);
                        $check = is_Role($dataPermissionArr, $module->name, 'delete');
                        return $check;
                    }
                    return false;
                });

                Gate::define($module->name . '.permission', function (User $user) use ($module) {
                    $dataPermissionsJSON = $user->getGroup->permissions;

                    $dataPermissionArr = [];
                    if (!empty($dataPermissionsJSON)) {
                        $dataPermissionArr = json_decode($dataPermissionsJSON, true);
                        $check = is_Role($dataPermissionArr, $module->name, 'permission');
                        return $check;
                    }
                    return false;
                });
            }
        }
    }
}
