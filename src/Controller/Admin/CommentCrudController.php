<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\File\File;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;


class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield DateTimeField::new('createdAt', 'Creado')
        ->setFormat('dd/MM/Y HH:mm:ss')
        ->setSortable(true)
        ->setFormTypeOption('disabled', 'disabled');        
        yield TextField::new('author','Autor');
        yield TextField::new('email', 'Email');
        yield TextEditorField::new('text', 'Comentario');

        // Problemática con las imágenes
        $avatar = ImageField::new('photoFilename')->setBasePath('uploads/photos/')->setLabel('Photo');
        $avatarTextFile = TextField::new('photoFilename');

        if (Crud::PAGE_INDEX === $pageName) {
            yield ImageField::new('photoFilename')
            ->setBasePath('uploads/photos/')
            ->setLabel('Photo');
        } elseif (Crud::PAGE_EDIT === $pageName) {
            yield TextField::new('photoFilename')
            ->setLabel('Photo');
        }
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('conference');
    }
    
}
