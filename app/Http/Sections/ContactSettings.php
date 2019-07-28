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
 * Class ContactSettings
 *
 * @property \App\Contact $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class ContactSettings extends Section
{
    
    protected $model = '\App\ContactSettings';
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = 'Contact Settings';

    /**
     * @var string
     */
    protected $alias = 'contacts';

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::table()

        ->setHtmlAttribute('class', 'table-danger')
        ->setColumns(
            AdminColumn::text('id', '#')->setWidth('30px'),
            
            AdminColumn::link('title', 'Title')->setWidth('200px'),

            AdminColumn::text('phone', 'phone'),

            AdminColumn::text('mail', 'mail'),

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

        AdminFormElement::text('id', 'ID#')->setReadonly(1),

        AdminFormElement::text('title', 'Title')->required(),

        AdminFormElement::text('phone', 'Phone')->required(),

        AdminFormElement::text('mail', 'Mail')->required()->unique(),

        AdminFormElement::ckeditor('description', 'Description')->required(),

        AdminFormElement::text('created_at', 'Created')->setReadonly(1),
    ]);

    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
      return AdminForm::panel()->addBody([
        AdminFormElement::text('title', 'Title')->required(),

        AdminFormElement::text('phone', 'Phone')->required(),

        AdminFormElement::text('mail', 'Mail')->required()->unique(),

        AdminFormElement::ckeditor('description', 'Description')->required(),
    ]);



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
}
