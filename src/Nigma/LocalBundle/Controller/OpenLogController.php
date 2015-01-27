<?php

namespace Nigma\LocalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Request;

class OpenLogController extends Controller
{
    public function openSignalAction(Request $request, $secret)
    {
        $data = json_decode($request->getContent(), true);
        $remoteSecret = $this->container->getParameter('remote_secret');
        if($secret!=$remoteSecret){
            throw $this->createAccessDeniedException();
        }
        $openLogService = $this->get("nigma_local.open_log");
        $openLogService->openSignal($data);
        return new JsonResponse([
            'status' => 'success',
        ], 200);
    }
}
