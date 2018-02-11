<?php

namespace App;


class Demand extends Model
{
    
   	public function commodity(){
		return $this->BelongsTo('\App\Commodity');
	}

	public function outlet(){
		return $this->BelongsTo('App\Outlet');
	}

	public function getBulanAttribute()
	{
		return $this->date->format('Y-m');
	}

	public static function getMonth($commodityId)
	{
		return static::where('commodity_id', $commodityId)
			->where('outlet_id', $outletId)->orderBy('date', 'desc')
			->get()
			->take(90)
			->sortBy('date')
			->pluck('date')
			->unique()
			->values();
	}

	public static function dekomposisi($commodityId, $outletId)
	{
		// nilai x = quantity bulan
		// $x = Demand::where('commodity_id', $commodityId)->where('outlet_id', $outletId)->get()->pluck('bulan')->unique()->count();
		// $val['x'] = 0;
		// $val['x2'] = 0;


		//nilai variabel x1+x2+x3 & x1kuadrat
		// for ($i=1; $i < $x+1; $i++) { 
		// 	$val['x'] += $i;
		// 	$val['x2'] += pow($i, 2);
		// }

		// quantity total transaksi
		// $val['y'] = Demand::where('commodity_id', $commodityId)->where('outlet_id', $outletId)->get()->sum('quantity');

		// nilai perbulan dikali
		$n = 1;
		$val['xy'] = 0;

		$demands = Demand::where('commodity_id', $commodityId)->where('outlet_id', $outletId)->orderBy('date', 'desc')->take(90)->get();

		if (empty($demands->first())) {
			$val['sumy'] = [0];
		}
		
		foreach ($demands as $demand) {
			
			$val['sumy'][$n] = $demand->quantity;
			// $val['xy'] += $n*$val['sumy'][$n];
			$n++;

		}

		// $val['a']=($val['xy']*$val['x']-$val['y']*$val['x2'])/(pow($val['x'], 2)-$val['x2']*$x);
		// $val['b']=($val['y']-$val['a']*$x)/$val['x'];
		
		//rumus hasil peramalan Trend Linear

		
		// $val['x3'] = 0;
		// for ($i=1; $i <= $x; $i++) { 
		// 	$Y[$i] = $val['a']+$val['b']*$i;
		// }

		// $val['Y'] = $Y;

		// $a=1;
		// foreach ($val['sumy'] as $sumy) {
		// 	$koef[$a]=$sumy/100;
		// 					// $Y[$a]
		// 	$a++;
		// }
		// $val['koef']=$koef;

		//error
		// for ($i=1; $i <= $x; $i++) { 
		// 		$H[$i] = number_format(($val['a']+$val['b']*$i)*$koef[$i], 0);
		// 		$error[$i] = $H[$i];
		// 					 // - $sumy[$i]
		// }

		// $val['error'] = array_sum($error);


		// if (request()->has('periode')) {
		// 	$periode=request('periode');
		// 	$a = 1;
		// 	for ($i=$x+1; $i <= $x+$periode; $i++) { 
		// 		$H[$i] = number_format(($val['a']+$val['b']*$i)*$koef[$a], 0);
		// 		$a++;
		// 	}
		// 	$val['H'] = $H;
		// }
	
		// return array_values($val['H']);
		$val['method'] = 'dekomposisi';
		return $val;




		// $val['b']=((($val['xy']-$val['b']*$val['x2'])/$val['x'])*n)/$val['y'];
		
		// $val['a']=($val['xy']-$val['b']*$val['x2'])/$val['x'];
		// $ramal= $val[a]+$val['b']*X
	}

	// public static function dekom()
	// {
	// 	$val = Demand::dekomposisi();
	// 	$res['H'] = $val['H'];
	// 	$res['error'] = $val['error'];

	// 	return $res;

	// }


	public function movingAverage($commodityId, $outletId)
	{
		$val = Demand::dekomposisi($commodityId, $outletId);

		if (empty($val['sumy'])) {
			dd($commodityId, $outletId);
		}

		$sumy = $val['sumy'];

		if (count($sumy) < 4) {
			$MA = 0;
			$error = [10000];
		}

		for ($n=4; $n <= count($sumy);) { 
			$MA[$n] = ($sumy[$n-3]+$sumy[$n-2]+$sumy[$n-1])/3;

			$error[$n] = (abs($MA[$n] - $sumy[$n]));
			$n++;
		}

		$val['H'] = $MA;
		$val['error'] = (array_sum($error))/count($sumy);

		if (count($sumy) > 5) {
			$val['R'] = $this->forecast('MA', $val['H'], 3);
		}

		$val['method'] = 'movingAverage';
		return $val;
		
	}



	public function SES($commodityId, $outletId)
	{

		$val = Demand::dekomposisi($commodityId, $outletId);


		$sumy = $val['sumy'];
		$alpas=[0.1,0.2,0.3,0.4,0.5,0.6,0.7,0.8,0.9];

		$n=0;
		
		foreach ($alpas as $alpa) {

				$SES[$n][1] = $sumy[1];

				for ($i=2; $i <= count($sumy);) { 

		       		$SES[$n][$i] = $SES[$n][$i-1] + $alpa*($sumy[$i-1] - $SES[$n][$i-1]);

		       		$error[$n][$i] = abs($sumy[$i-1] - $SES[$n][$i]);
		       		$i++;

				}

			$sumerror[$n] = (array_sum($error[$n]))/count($sumy);

			$n++;

			// return $u;
			// return $sumy;
		}

		// return $SESS;
		$key = array_values(array_keys($sumerror, min($sumerror)));

		$res['H'] = $SES[$key['0']];
		$res['error'] = $sumerror[$key['0']];

		$res['method'] = 'SES';
		return $res;

	}

	public function DES($commodityId, $outletId)
	{

		$val = Demand::dekomposisi($commodityId, $outletId);
		$sumy = $val['sumy'];

		$alpas = [0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9];
		$betas = [0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9];

		$n=0;
		
		foreach ($alpas as $alpa) {

			
			$m = 0;

			foreach ($betas as $beta) {

				$SES[$m][1] = $sumy[1];

				for ($i=2; $i <= count($sumy);) { 

		       		$SES[$m][$i] = $SES[$m][$i-1]*$beta + $alpa*($sumy[$i-1] - $SES[$m][$i-1]);

		       		$error[$m][$i] = abs($sumy[$i-1]-$SES[$m][$i]);
		       		$i++;
				}

				$res ["$n$m"] = [
					'error' => (array_sum($error[$m]))/count($sumy),
					'H' => $SES[$m],
				];
				$sumerror['ke-'.$m] = array_sum($error[$m]);

				$m++;

			}

			// $SESS['ke-'.$n] = $SES;
			// $errors[$n] = $error;
			// $sumerrors[$n] = $sumerror;

			// $val[$n] = $res;

			$n++;

			// return $u;
			// return $sumy;
		}

		$collection = collect($res);

		$val = $collection->sortBy('error')->first();

		// return $val;

		// $collection = collect($res);

		// $sorted = $collection->sortBy(function($e, $k)
		// {
		// 	return min($e['error']);
		// });
		$val['method'] = 'DES';
		return $val;



		// return $SESS;
		// $key = array_keys($sumerrors, min($sumerrors));

	}

		


	


		// foreach ($alpas as $alpa) {
		// 	foreach (Demand::getMonth() as $bulan) {
		// 	$val['H'][$alpa] = $val['sumy'][$bulan]*$alpa;
		// 	}
		// }

		// return ($val['H']);

	public function forecast($method, array $H, $n)
	{
		switch ($method) {
			case 'MA':
				$R = array();
				$key = collect($H)->keys()->last();
                for ($i=$key+1; $i <= $key+$n ; $i++) { 
                	$R[$i] = collect([$H[$i-3], $H[$i-1], $H[$i-2]])->avg();
                	$H[$i] = $R[$i];
                }

                return $R;
				break;
			
			default:
				# code...
				break;
		}
	}
			
		

		
	

	protected $dates = ['date'];
	protected $appends = ['bulan', 'outlet_id'];
}

