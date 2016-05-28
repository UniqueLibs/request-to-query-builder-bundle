<?php

namespace UniqueLibs\RequestToQueryBuilderTestBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/")
     *
     * @return array
     */
    public function indexAction(Request $request)
    {
        $queryBuilder = $this->get('uniquelibs.request_to_query_builder_test_bundle.entity.product_repository')->getQueryBuilder();

        $apiBuilder = $this->get('uniquelibs.request_to_query_builder_test_bundle.request_processor.product');
        $apiBuilder->execute($request, $queryBuilder);

        return new Response($queryBuilder->getQuery()->getSql());
    }
}
