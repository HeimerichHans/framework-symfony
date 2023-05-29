<?php

namespace App\Controller\Admin;

use App\Entity\ListType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ListTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ListType::class;
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
