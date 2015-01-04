<?php
// src/Acme/HelloBundle/DataFixtures/ORM/LoadUserData.php

namespace Nigma\CommonBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nigma\CommonBundle\Entity\Page;

class LoadUserData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $home = new Page();
        $home->setTitle("Strona startowa");
        $home->setName("home");
        $home->setDescription("Strona startowa.");
        $home->setContent("<b>NigmaLabs</b> opis strony startowej");
        $manager->persist($home);
        
        $oNas = new Page();
        $oNas->setTitle("o nas");
        $oNas->setName("o-nas");
        $oNas->setDescription("NigmaLabs to stowarzyszenie. Jesteśmy dla ludzi, których pasją jest majsterkowanie.");
        $oNas->setContent("<b>NigmaLabs</b> to stowarzyszenie. Zrzeszamy ludzi zajmujących się elektroniką i lubiących majsterkować. Dla części to hobby dla innych praca. Jesteśmy różni ale łączy nas pasja i chęć rozwoju. Tworzymy społeczność ludzi o podobnych zainteresowaniach...");
        $manager->persist($oNas);
        
        //at end
        $manager->flush();
    }
}