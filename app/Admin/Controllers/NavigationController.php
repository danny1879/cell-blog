<?php

namespace App\Admin\Controllers;

use App\Admin\Models\Navigation;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class NavigationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '导航';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Navigation());

        $grid->model()->orderBy('sort', 'desc');

        $grid->column('name', __('Name'));
        $grid->column('url', __('Url'));
        $grid->column('sort', __('Sort'))
            ->sortable()
            ->replace([0 => '-'])
            ->editable()
            ->label('default');
        $grid->column('created_at', __('Created at'))
            ->date('Y-m-d H:i:s');
        $grid->column('updated_at', __('Updated at'))
            ->date('Y-m-d H:i:s');

        $grid->quickSearch('name')->placeholder('搜索导航...');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Navigation::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('url', __('Url'));
        $show->field('sort', __('Sort'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Navigation());

        $form->text('name', __('Name'))
            ->required();
        $form->text('url', __('Url'))
            ->required();
        $form->number('sort', __('Sort'))
            ->default(0)
            ->min(0)
            ->max(10);

        return $form;
    }
}
