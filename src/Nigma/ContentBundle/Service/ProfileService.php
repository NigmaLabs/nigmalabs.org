<?php

namespace Nigma\ContentBundle\Service;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Nigma\CommonBundle\Entity\Page;
use Symfony\Component\Security\Core\SecurityContext;

class ProfileService {

    const PAGE_REPOSITORY_NAME = 'NigmaContentBundle:Page';

    private $securityContext;
    private $doctrine;

    public function __construct(SecurityContext $securityContext, $doctrine) {
        $this->securityContext = $securityContext;
        $this->doctrine = $doctrine;
    }

    /**
     * @return Profile
     
    public function getCurrentUserProfile() {
        $id = $this->securityContext->getToken()->getUser()->getId();
        return $this->getUserProfile($id);
    }*/

    /**
     * @return Page
     */
    public function getPageById($id) {
        return $this->doctrine
                ->getRepository(self::PAGE_REPOSITORY_NAME)
                ->findOneById($id);
    }

    /**
     * @return Page
     */
    public function getPageByName($name) {
        return $this->doctrine
                ->getRepository(self::PAGE_REPOSITORY_NAME)
                ->findOneByName($name);
    }

    /**
     * @return NULL
     */
    public function persistPage($pageData) {
        //...
    }

}
