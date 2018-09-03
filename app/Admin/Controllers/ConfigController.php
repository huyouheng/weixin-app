<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Form;

class ConfigController extends Controller
{
	use ModelForm;

	public function __construct()
	{
		parent::$title = '附件';
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
		return Admin::grid(Config::class, function (Grid $grid) {
			$grid->id('ID');
			$grid->table_one('申请表');
			$grid->table_two('委托书');
			$grid->email('接收邮箱');
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
		return Admin::form(Config::class, function (Form $form) {

			$form->display('id', 'ID');
			$form->file('table_one', '申请表')->rules('required', [
				'required' => '申请表不能为空'
			]);
			$form->file('table_two', '委托书')->rules('required', [
				'required' => '委托书不能为空'
			]);
			$form->email('email','接收邮箱');
			$form->display('created_at', 'Created At');
		});
	}
}
