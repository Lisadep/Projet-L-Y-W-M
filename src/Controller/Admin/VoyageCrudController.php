<?php

namespace App\Controller\Admin;

use App\Entity\Voyage;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VoyageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Voyage::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            BooleanField::new('active', 'Actif en front')
                ->setTextAlign('center'),
            ImageField::new('image', 'Photo')
                ->setBasePath('images/upload')
                ->setUploadDir('public/images/upload')
                ->setFormType(FileUploadType::class)
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setTemplatePath('admin/admin_imageVoiture.html.twig'),
            TextField::new('pays', 'Pays')
                ->setTextAlign('center'),
            TextField::new('nomhotel', 'Hotel')
                ->setTextAlign('center'),
            TextareaField::new('description', 'Description')
                ->setTextAlign('center'),
            MoneyField::new('prix', 'Prix TTC')
                ->setCurrency('EUR')
                ->setTextAlign('center'),
        ];
    }
}
