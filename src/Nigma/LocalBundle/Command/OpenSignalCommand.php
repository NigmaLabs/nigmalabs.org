<?php

namespace Code247\CronBundle\Command;

use Code247\CommonBundle\Consts\REPOSITORY;
use Doctrine\ORM\Query\Expr\Join;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class OpenSignalCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this->setName('nigma:local:sendOpenSignal')
            ->setDescription('send local is open signal to remote server');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $openLogService = $this->getContainer()->get('nigma_local.open_log');

        $now = new \DateTime();
        $paidUsers = $paymentService->getAllPaidUsers($now);

        $time = $input->getArgument('time');
        $now = $time ? new \DateTime($time) : new \DateTime();

        foreach ($paidUsers as $user) {
            $uId = $user->getId();
            $uEmail = $user->getEmail();
            echo "\n\n User ($uId) $uEmail: ";
            $remindTimestamp = ($user->getRemindDays() + $user->getRemindMonths() * 30 + $user->getRemindYears() * 365) * 60 * 60 * 24;
            $lastRemind = $user->getLastLifePoint();
            $reminBeginPoint = new \DateTime();
            $reminBeginPoint->setTimestamp($lastRemind->getTimestamp() + $remindTimestamp);

            if ($now < $reminBeginPoint) continue;
            $remindCount = $user->getRemindCount();
            $weekTimestamp = 60 * 60 * 24 * 7;
            $nextRemindPoint = 0;
            if ($remindCount == 3) {
                $killPoint = new \DateTime();
                $killPoint->setTimestamp($lastRemind->getTimestamp() + $weekTimestamp * 4);
                if ($now < $killPoint) continue;
                $this->sendUserEmails($user);
                $user->setIsLife(false);
                $user->setRemindCount(++$remindCount);
                $userManager->updateUser($user);
                echo 'user die';
                continue;
            } else if ($remindCount == 0) {
                $nextRemindPoint = $reminBeginPoint;
            } else if ($remindCount == 1) {
                $nextRemindPoint = new \DateTime();
                $nextRemindPoint->setTimestamp($lastRemind->getTimestamp() + $weekTimestamp * 2);
            } else if ($remindCount == 2) {
                $nextRemindPoint = new \DateTime();
                $nextRemindPoint->setTimestamp($lastRemind->getTimestamp() + $weekTimestamp * 3);
            } else {
                echo 'Error. ' . $remindCount . ' remind. User die ' . $user->getIsLife();
                continue;
            }
            if ($now < $nextRemindPoint) {
                echo 'no send next remind';
                continue;
            }
            echo 'remind ' . $remindCount;
            $user->setRemindCount(++$remindCount);
            $userManager->updateUser($user);
            $this->sendRemindMessage($user);
        }
        //$em->flush();
        echo "\n\n";
    }

}
