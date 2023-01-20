<?php

namespace App\Controller\Admin;

use App\Entity\Attribution;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AttributionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Attribution::class;
    }

    public function configureFields(string $pageName): iterable
    {
		return [
			DateField::new('created_at'),
			AssociationField::new('beneficiaire'),
			NumberField::new('points'),
		];

    }
}
