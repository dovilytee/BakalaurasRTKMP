<?php

namespace App\Controller\Admin;

use App\Entity\Place;
use App\Entity\PlaceType;
use App\Entity\PlaceCity;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PlaceTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PlaceType::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('name', 'Type Name'),
        ];
    }
}
