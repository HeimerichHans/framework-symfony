<?php

namespace App\Controller\Admin;

use App\Entity\Moto;
use DateTime;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;

class MotoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Moto::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('marque');
        yield AssociationField::new('type');
        yield TextField::new('modele');           
        yield AssociationField::new('couleur');
        yield AssociationField::new('cylindre');
        yield TextField::new('imageFile')->setFormType(VichImageType::class);
        yield ImageField::new('image')->setBasePath('/uploads/images/moto')->onlyOnIndex();
        yield IntegerField::new('annee');
        yield TextareaField::new('article');
        $createdDate = DateTimeField::new('createdDate','Date création');
        if (Crud::PAGE_EDIT === $pageName) {
            yield $createdDate->setFormTypeOption('disabled', true);
        } else {
            yield $createdDate;
        }
        yield DateTimeField::new('updatedDate');
    }
}
