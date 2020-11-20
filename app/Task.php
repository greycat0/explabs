<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'description',
    ];


    public function users()
    {

        return $this->belongsToMany(User::class, 'task-user');
    }

//    public function forUser(User $user)
//    {
//        return Task::where('user_id', $user->id)
//            ->orderBy('created_at', 'asc')
//            ->get();
//    }

}

