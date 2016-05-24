<?php

namespace Twitchls\Logger;

use Eloquent;

class Log extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'log';

    protected $guarded = ['id'];
}
