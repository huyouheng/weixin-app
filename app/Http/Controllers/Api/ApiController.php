<?php

namespace App\Http\Controllers\Api;

use App\Models\Banner;
use App\Models\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
	public function banner()
	{
		$banner = Banner::where('isShow', 1)->select('title', 'description', 'url', 'img_url')->get();
		$banner = collect($banner)->map(function($item){
			$item->img_url = config('app.url').'/storage/'.$item->img_url;
			return $item;
		});

		return self::msg($banner);
	}

	public function attach()
	{
		$config = Config::select('table_one','table_two')->get();
		$config = collect($config)->map(function($item){
			$url = config('app.url').'/storage/';
			return ['one'=>$url.$item->table_one, 'two'=> $url.$item->table_two];
		});

		return self::msg($config);
	}

	private static function msg($data)
	{
		return response()->json([
			'msg' => 'ok',
			'status' => '1',
			'data' => $data
		]);
	}
}
