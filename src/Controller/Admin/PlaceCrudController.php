<?php

namespace App\Controller\Admin;

use App\Entity\Place;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use App\Entity\PlaceType;
use App\Entity\PlaceCity;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class PlaceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Place::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Place Name'),
            TextField::new('address', 'Place Address'),
            TextField::new('description', 'Place Description'),
            TextField::new('type', 'Place Type'),
            TextField::new('city', 'Place City'),
            AssociationField::new('placeType')
            ->setCrudController(PlaceTypeCrudController::class)
            ->setFormTypeOption('choice_label', 'name')
            ->setFormTypeOption('choice_label', 'name')
            ->setLabel('Place Type'), BooleanField::new('isVisible', 'Is Visible'),
            AssociationField::new('placeCity')
                ->setCrudController(PlaceCityCrudController::class)
                ->setFormTypeOption('choice_label', 'name'),
        ];
    }
    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $qb = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
        $qb->andWhere('entity.isVisible = :visible')
            ->setParameter('visible', true);

        return $qb;
    }
}
