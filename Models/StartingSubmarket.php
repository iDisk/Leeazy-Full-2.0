<?php

/**
 * StartingCities Model
 *
 * StartingCities Model manages StartingCities operation.
 *
 * @category   StartingCities
 * @package    vRent
 * @author     Techvillage Dev Team
 * @copyright  2020 Techvillage
 * @license
 * @version    2.7
 * @link       http://techvill.net
 * @since      Version 1.3
 * @deprecated None
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;


class StartingSubmarket extends Model
{
    protected $table   = 'starting_submarket';
    public $timestamps = false;


	public static function getAll()
	{
		$data = Cache::get('vr-submarket');
		
		if (empty($data)) {
			$data = parent::where('status', 'Active')->select('city_id','name')->get();

			Cache::put('vr-submarket', $data, 86400);
		}
		return $data;
	}

}
