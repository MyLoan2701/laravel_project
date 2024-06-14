<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $timestamp = false; // set time to false

    protected $fillable = [
        'name_admin',
        'email_admin',
        'password_admin',
        'role_admin',
        'status_admin',
        'phone_admin',
        'address_admin',
        'hometown_admin',
        'sex_admin',
        'birth_admin',
        'avatar_admin',
    ];

    protected $primaryKey = 'id_admin';
    protected $table = 'admin';

    public function getAuthPassword()
    {
        return $this->password_admin;
    }

    public function role(): BelongsToMany {
        return $this->belongsToMany(Role::class);
    }
    public function hasAnyRole($roles) {
        if(is_array($roles)){
            foreach($roles as $role){
                if($this->hasRole($role)){
                    return true;
                }
            }
        }else{
            if($this->hasRole($roles)){
                return true;
            }
        }
        return false;
    }
    public function hasRole($role) {
        // return null !== $this->role()->where('name_role', $role)->first();
        if ($this->role()->where('name_role', $role)->first()) {
            return true;
        }
        else return false;
    }
}
