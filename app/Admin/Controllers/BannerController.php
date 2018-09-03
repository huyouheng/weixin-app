<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\ModelForm;

class BannerController extends Controller
{
	use ModelForm;

	public function __construct()
	{
		parent::$title = '轮播图';
	}

    public function index()
    {
        return Admin::content(function (Content $content) {

            $this->setTitle($content);

			$content->body($this->grid());

        });
    }

	protected function grid()
	{
		return Admin::grid(Banner::class, function (Grid $grid) {
			$states = [
				'on'  => ['value' => 1, 'text' => '是', 'color' => 'primary'],
				'off' => ['value' => 0, 'text' => '否', 'color' => 'default'],
			];

			$grid->id('ID')->sortable();
			$grid->title('标题');
			$grid->description('描述');
			$grid->url('链接');
			$grid->isShow('是否显示')->switch($states);
			$grid->img_url('图片')->display(function(){
				return '<img src='.config('app.url').'/storage/'.$this->img_url.' width="100" height="100">';
			});

			$grid->created_at('创建时间');
		});
	}

	public function create()
	{
		return Admin::content(function (Content $content) {

			$this->setTitle($content);

			$content->body($this->form());
		});
	}

	public function edit($id)
	{
		return Admin::content(function (Content $content) use ($id) {

			$this->setTitle($content);

			$content->body($this->form()->edit($id));
		});
	}

	protected function form()
	{
		return Admin::form(Banner::class, function (Form $form) {

			$form->display('id', 'ID');
			$form->text('title', '标题');
			$form->text('description', '描述');
			$form->text('url', '链接');
			$form->image('img_url','图片');
			$form->switch('isShow','是否显示')->states([
				'on'  => ['value' => 1, 'text' => '是', 'color' => 'primary'],
				'off' => ['value' => 0, 'text' => '否', 'color' => 'default'],
			]);
			$form->display('created_at', 'Created At');
		});
	}
}
