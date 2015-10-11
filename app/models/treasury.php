<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 10/6/2015
 * Time: 4:08 PM
 */
class Treasury extends Eloquent
{


    protected $table = 'treasury_view';

    public function branch()
    {
        return $this->hasOne('Branches','id','br_id');

    }

}
