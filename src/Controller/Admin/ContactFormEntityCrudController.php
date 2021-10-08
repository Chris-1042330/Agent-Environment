<?php

namespace App\Controller\Admin;

use App\Entity\ContactFormEntity;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContactFormEntityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ContactFormEntity::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
