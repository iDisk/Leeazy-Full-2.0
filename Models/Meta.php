<?php

/**
 * Metas Model
 *
 * Metas Model manages Metas operation.
 *
 * @category   Metas
 * @package    Leeazy
 * @author     Techvillage Dev Team
 * @copyright  2022 idisk mx
 * @license
 * @version    2.7
 * @link       http://techvill.net
 * @since      Version 1.3
 * @deprecated None
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $table   = 'seo_metas';
    public $timestamps = false;
}
