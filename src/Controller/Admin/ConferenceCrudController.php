<?php

namespace App\Controller\Admin;

use App\Entity\Conference;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;



class ConferenceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Conference::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('city','Ciudad');
        yield TextField::new('year', 'Año');
        yield BooleanField::new('isInternational', '¿Internacional?');
        yield AssociationField::new('comments', 'Total Comentarios');        
    }
    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            //->setDateFormat('D/m/Y')
            //->renderContentMaximized()
            //->renderSidebarMinimized()
            ->setEntityLabelInSingular('Conferencia')
            ->setEntityLabelInPlural('Conferencias')
            //->setEntityPermission('ROLE_EDITOR')
            ->setPageTitle('index', 'Listado de %entity_label_plural%')
            ->setPageTitle('new', 'Nueva %entity_label_singular%')
            //->setPageTitle('detail', "hoo")
            ->setPageTitle('edit',"Editar %entity_label_singular%")
            
            //Search Box
            ->setSearchFields(['city', 'year'])
            // set it to null to disable and hide the search box
            //->setSearchFields(null)

            //Sort
            ->setDefaultSort(['id' => 'DESC'])
            //->setDefaultSort(['id' => 'DESC', 'title' => 'ASC', 'startsAt' => 'DESC'])
            // you can sort by Doctrine associations up to two levels
            //->setDefaultSort(['seller.name' => 'ASC'])

            //Paginación
            ->setPaginatorPageSize(30)
            // set this number to 0 to display a simple "< Previous | Next >" pager
            ->setPaginatorRangeSize(4)
            // these are advanced options related to Doctrine Pagination
            // (see https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/tutorials/pagination.html)
            ->setPaginatorUseOutputWalkers(true)
            ->setPaginatorFetchJoinCollection(true)
        ;
    }
}
