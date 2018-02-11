<?php

namespace App;



class Commodity extends Model
{
    

	public function bom(){
		return $this->HasMany('\App\Bom');
	}

	public function demand(){
		return $this->HasMany('\App\Demand');
	}
   
}
