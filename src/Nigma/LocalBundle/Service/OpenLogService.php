<?php

namespace Nigma\ContentBundle\Service;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Nigma\CommonBundle\Entity\Page;
use Nigma\LocalBundle\Entity\OpenLog;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Validator\Constraints\DateTime;

class OpenLogService
{

    const OPEN_LOG_REPOSITORY = 'NigmaLocalBundle:OpenLog';
    const EM = 'doctrine.orm.default_entity_manager';
    const TIMEOUT = 300;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function openSignal()
    {
        $em = $this->container->$this->get(self::EM);
        $lastLog = $this->getLastLog();
        if(!$lastLog){
            $lastLog = new OpenLog();
        }
        $now = new \DateTime();
        $diff = $now->getTimestamp()-$lastLog-self::TIMEOUT;
        if($diff<0){
            $lastLog = new OpenLog();
        }
        $end = new \DateTime();
        $end->setTimestamp($now->getTimestamp()+self::TIMEOUT);
        $lastLog->setEnd($end);
        $em->persist($em);
        $em->flush();
    }

    public function sendOpenSignalToRemote()
    {
        $router = $this->container->get('router');
        $secret = $this->container->getParameter('remote_secret');
        $remoteApiUrl = $this->container->getParameter('remote_api_url');
        $uri = $router->generate('nigma_open_signal', [
            'secret' => $secret
        ]);
        $url = $remoteApiUrl.$uri;
    }

    public function getLastLog(){
        $em = $this->container->$this->get(self::EM);
        try {
            $result = $em->createQueryBuilder()
                ->select('o')
                ->from(self::OPEN_LOG_REPOSITORY, 'o')
                ->orderBy('up.end', 'DESC')
                ->getQuery()
                ->setMaxResults(1)
                ->getSingleResult();
            return $result;
        } catch (NoResultException $ex) {
            return null;
        }
    }

}
