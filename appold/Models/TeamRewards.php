<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamRewards extends Model
{
	/**
	 * [$table description]
	 * @var string
	 */
    protected $table = "tbl_direct_reward_setting";

    /**
     * [$guarded description]
     * @var array
     */
    protected $guarded = [];

    /**
     * [$hidden description]
     * @var array
     */
    protected $hidden = [];

}
