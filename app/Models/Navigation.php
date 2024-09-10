<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Exceptions\GuardDoesNotMatch;
use Spatie\Permission\Traits\HasPermissions;

class Navigation extends Model
{
    use HasFactory, HasPermissions;

    protected $guarded = ['_token'];

    public function subMenus()
    {
        return $this->hasMany(Navigation::class, 'main_menu');
    }

    // public function hasPermissionTo($permission): bool
    // {
    //     if (config('permission.enable_wildcard_permission', false)) {
    //         return $this->hasWildcardPermission($permission, $this->getDefaultGuardName());
    //     }

    //     $permissionClass = $this->getPermissionClass();

    //     if (\is_string($permission)) {
    //         $permission = $permissionClass->findByName($permission, $this->getDefaultGuardName());
    //     }

    //     if (\is_int($permission)) {
    //         $permission = $permission->findById($permission, $this->getDefaultGuardName());
    //     }

    //     if (! $this->getGuardNames()->contains($permission->guard_name)) {
    //         throw GuardDoesNotMatch::create($permission->guard_name, $this->getGuardNames());
    //     }

    //     return $this->permissions->contains($permission->getKeyName(), $permission->getKey());

    // }
}
