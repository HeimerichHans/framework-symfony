<?php

namespace App\Controller\Admin;

use App\Entity\User;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->remove(Crud::PAGE_INDEX, Action::NEW);
    }

    public function configureFields(string $pageName): iterable
    {
        
        return [
            TextField::new('email'),
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('pseudo'),
            ArrayField::new('roles'),
            BooleanField::new('actif'),
            DateTimeField::new('createdDate')->setDisabled(),
            DateTimeField::new('updatedDate'),
        ];
    }
}
