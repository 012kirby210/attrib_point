<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

	public function configureCrud(Crud $crud): Crud
	{
		return $crud->setSearchFields(['nom','groupe.nom','attributions.point'])
			->setDefaultSort([ 'nom' => 'ASC' ]);
	}

	public function configureFields(string $pageName): iterable
	{
		if ( Crud::PAGE_INDEX === $pageName ){
			return [
				FormField::addPanel('Ajout de points'),
				FormField::addPanel('Liste des utilisateurs'),
				TextField::new('nom'),
				DateField::new('created_at'),
				AssociationField::new('groupe'),
				AssociationField::new('attributions'),
				NumberField::new('totalPoints')
			];
		}
		return [
			TextField::new('nom'),
			DateField::new('created_at'),
			AssociationField::new('groupe')->renderAsNativeWidget(),
			AssociationField::new('attributions')->autocomplete(),
		];

	}
}
