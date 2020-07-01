<?php 


	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use Illuminate\Support\Arr;
	class Shuzu extends Controller{
		public function index(){
			$array = [1,2,3,4,5,6]; 
			$slice = Arr::only($array, [1, 3,5]); 
			//$res=[0 => 1, 1 => 2];
			dump($slice);
		} 
	}

 ?>