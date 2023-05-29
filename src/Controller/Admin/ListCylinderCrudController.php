<?php

namespace App\Controller\Admin;

use App\Entity\ListCylinder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ListCylinderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ListCylinder::class;
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
