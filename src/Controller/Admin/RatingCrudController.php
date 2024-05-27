<?php

namespace App\Controller\Admin;

use App\Entity\Rating;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RatingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Rating::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('rating', 'Rate'),
            TextField::new('comment', 'Comment'),
            DateField::new('created_At', 'Created at'),
            AssociationField::new('place')
            ->setCrudController(PlaceCrudController::class)
            ->setFormTypeOption('choice_label', 'name'),
            AssociationField::new('user')
                ->setCrudController(UserCrudController::class)
                ->setFormTypeOption('choice_label', 'name'),
        ];
    }
}
