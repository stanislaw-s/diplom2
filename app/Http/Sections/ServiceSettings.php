<?php

namespace App\Http\Sections;

use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\initialize;

/**
 * Class ServiceSettings
 *
 * @property \App\Service $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class ServiceSettings extends Section
{
    protected $model = '\App\ServiceSettings';

    public function initialize()
    {
        $this->addToNavigation($priority = 500, function() {
            return \App\Service::count();
        });

        $this->creating(function($config, \Illuminate\Databse\Eloquent\Model $model) {

        });
    }
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = 'Настройки сервисов';

    /**
     * @var string
     */
    protected $alias = 'services';

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::table()

        ->setHtmlAttribute('class', 'table-danger')
        ->setColumns(
            AdminColumn::text('id', '#')->setWidth('30px'),
            AdminColumn::link('title', 'Настройка')->setWidth('200px'),
        )->paginate(20);
        ;
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('id', 'ID')->setReadonly(1),
            AdminFormElement::text('title', 'Название')->required(),
            

            AdminFormElement::textarea('description', 'Описание')->required(),
             AdminFormElement::text('icon', 'Иконка')->required(),

        ]);

        
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('title', 'Название сервиса')->required(),
            AdminFormElement::text('description', 'Описание сервисов')->required(),
            AdminFormElement::text('icon', 'Иконка')->required()
        ]);
        ;
    }

    /**
     * @return void
     */
    public function onDelete($id)
    {
        // remove if unused
    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
        // remove if unused
    }

    public function getCreateTitle()
    {
        return 'Сервисы';
    }

    public function getIcon()
    {
        return 'fa fa gear';
    }
}
