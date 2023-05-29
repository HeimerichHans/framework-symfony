<?php

namespace App\Controller\Admin;

use App\Entity\ListColor;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ListColorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ListColor::class;
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
