<?php

namespace Nigma\ContentBundle\Controller;

use Nigma\CommonBundle\Entity\Page;
use Nigma\CommonBundle\Entity\PageRepository;
use Nigma\CommonBundle\Entity\DTO\SimplePageDto;
use Nigma\CommonBundle\Entity\DTO\SimplePageListDto;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RestController extends Controller {

    public function getPageByNameAction($name) {
        $repository = $this->getDoctrine()->getRepository('NigmaCommonBundle:Page');
        $page = $repository->findOneByName($name);
        if ($page == NULL) {
            throw new NotFoundHttpException("Page not found");
        }
        $pageDTO = new SimplePageDto($page);
        return new JsonResponse($pageDTO);
    }

    public function getPageByIdAction($id) {
        $repository = $this->getDoctrine()->getRepository('NigmaCommonBundle:Page');
        $page = $repository->findOneById($id);
        if ($page == NULL) {
            throw new NotFoundHttpException("Page not found");
        }
        $pageDTO = new SimplePageDto($page);
        return new JsonResponse($pageDTO);
    }

    public function getAllPages() {
        $repository = $this->getDoctrine()->getRepository('NigmaCommonBundle:Page');
        $pages = $repository->findAll();
        if (empty($pages)) {
            throw new NotFoundHttpException("Page not found");
        }
        $pageListDTO = new SimplePageListDto($pages);
        return new JsonResponse($pageListDTO);
    }

    public function updatePageAction() {
        $page = json_decode($request->getContent(), true);
        //...
    }

    public function createPageAction() {
        $page = json_decode($request->getContent(), true);
        //...
    }

    public function financeAction() {
        return $this->render('NigmaContentBundle:Pages:finance.html.twig');
    }

}
