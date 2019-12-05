<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
	protected $fillable = ['user_id'];
    protected $table = 'users_subscription';

}
