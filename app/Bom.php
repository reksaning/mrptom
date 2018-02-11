<?php

namespace App;



class Bom extends Model
{

	public function commodity(){
		return $this->belongsTo('\App\Commodity');
	}

	public function outlet(){
		return $this->belongsTo('\App\Outlet');
	}

	public function packaging(){
		return $this->belongsTo('\App\Packaging');
	}

}
