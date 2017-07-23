<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 23.07.17
 * Time: 16:19
 */

namespace AppBundle\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class TransactionsAdmin extends AbstractAdmin
{
    /**
     * @var int
     */
    protected $maxPerPage = 10;

    /**
     * @var array
     */
    protected $perPageOptions = [5, 10, 50];

    /**
     * @var array
     */
    protected $datagridValues = [
        '_page' => 1,
        '_per_page' => 10,
    ];

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('delete')
            ->clearExcept(['list', 'show']);
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('amount')
            ->add('customer')
            ->add('date', 'doctrine_orm_date_range');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('customer')
            ->add('amount')
            ->add('date', 'datetime');
    }
}