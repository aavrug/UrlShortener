<?php

namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Url extends Model
{ 
 	protected $fillable = ['short_url', 'pc_target_url', 'mobile_target_url', 'pc_redirects', 'mobile_redirects'];	 
}
?>