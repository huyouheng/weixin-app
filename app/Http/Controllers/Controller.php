<?php

namespace App\Http\Controllers;

use Encore\Admin\Layout\Content;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static $title;

	public function setTitle(Content $content)
	{
		$content->header(self::$title);
		$content->description('中心');
    }
}
