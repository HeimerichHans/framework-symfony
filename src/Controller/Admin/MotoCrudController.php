<?php

namespace App\Controller\Admin;

use App\Entity\Moto;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class MotoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Moto::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('marque'),
            AssociationField::new('type'),
            TextField::new('modele'),           
            AssociationField::new('couleur'),
            AssociationField::new('cylindre'),
            IntegerField::new('annee'),
            TextareaField::new('article'),
            DateTimeField::new('dateArticle'),
        ];
    }
}
