<?php

namespace App\Models;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'bmdc_reg_no', 'designation', 'member_type', 'status', 'mobile_no', 'profile_pic', 'is_admin'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Avatar shown in the AdminLTE navbar user menu.
     */
    public function adminlte_image()
    {
        return $this->profile_pic
            ? asset($this->profile_pic)
            : asset('images/logo.png');
    }

    /**
     * Subtitle shown under the name in the AdminLTE navbar user menu.
     */
    public function adminlte_desc()
    {
        return $this->is_admin ? 'Administrator' : 'Member';
    }
}
