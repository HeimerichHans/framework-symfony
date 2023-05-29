<?php

namespace App\Controller\Admin;

use App\Entity\ListBrand;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ListBrandCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ListBrand::class;
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
