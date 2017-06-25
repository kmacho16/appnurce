<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function searchMode($search,$type){
    return User::name($search)
    ->type($type)
    ->orderBy('id','DESC')
    ->paginate(8)
    ->appends(['seach'=>$search,'type'=>$type]);
    }


    public function scopeName($query,$search){
        if((!empty($search)) && (trim($search)!= '') ) {
            $query->where('name','like','%'.$search.'%')->orWhere('last_name','like','%'.$search.'%')->orWhere('email','like','%'.$search.'%');      
        }        
    }

    public function scopeType($query,$type){
        if((!empty($type)) && (trim($type)!= '') ) {
            $query->where('id_rol',$type);
        } 
    }
}
