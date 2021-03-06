<?php

namespace Innova\SelfBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Innova\SelfBundle\Entity\MediaType;
use Innova\SelfBundle\Entity\Duration;
use Innova\SelfBundle\Entity\Level;
use Innova\SelfBundle\Entity\Skill;
use Innova\SelfBundle\Entity\Typology;
use Innova\SelfBundle\Entity\OriginStudent;
use Innova\SelfBundle\Entity\Language;
use Innova\SelfBundle\Entity\LevelLansad;


class FixtureCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('self:fixtures:load')
            ->setDescription('Load needed datas')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
            $start = time();
            $em = $this->getContainer()->get('doctrine')->getEntityManager('default');

            $mediaTypes = array("audio", "video", "texte", "image");
            foreach ($mediaTypes as $mediaType) {
                if (!$em->getRepository('InnovaSelfBundle:MediaType')->findOneByName($mediaType)){
                    $type = new mediaType();
                    $type->setName($mediaType);
                    $em->persist($type);
                    $output->writeln("Add new mediaType (".$mediaType.").");
                }
            }

            $questionnaireDurations = array("brève", "moyenne", "longue");
            foreach ($questionnaireDurations as $questionnaireDuration) {
                if (!$em->getRepository('InnovaSelfBundle:Duration')->findOneByName($questionnaireDuration)){
                    $duration = new Duration();
                    $duration->setName($questionnaireDuration);
                    $em->persist($duration);
                    $output->writeln("Add new Duration (".$questionnaireDuration.").");
                }
            }

            $questionnaireLevels = array("A1", "A2", "B1", "B2", "C1");
            foreach ($questionnaireLevels as $questionnaireLevel) {
                if (!$em->getRepository('InnovaSelfBundle:Level')->findOneByName($questionnaireLevel)){
                    $level = new Level();
                    $level->setName($questionnaireLevel);
                    $em->persist($level);
                    $output->writeln("Add new Level (".$questionnaireLevel.").");
                }
            }

            $questionnaireSkills = array("CO", "CE");
            foreach ($questionnaireSkills as $questionnaireSkill) {
                if (!$em->getRepository('InnovaSelfBundle:Skill')->findOneByName($questionnaireSkill)){
                    $skill = new Skill();
                    $skill->setName($questionnaireSkill);
                    $em->persist($skill);
                    $output->writeln("Add new Skill (".$questionnaireSkill.").");
                }
            }

            $typologies = array("TVF", "QRU", "VF", "QRM", "TQRU", "TQRM", "TVFPM",
            "VFPM", "APPAT", "APPAA", "APPAI", "RE", "APPTT", "TVFNM", "VFNM");
            foreach ($typologies as $typology) {
                if (!$em->getRepository('InnovaSelfBundle:Typology')->findOneByName($typology)){
                    $typo = new Typology();
                    $typo->setName($typology);
                    $em->persist($typo);
                    $output->writeln("Add new Typology (".$typology.").");
                }
            }

            /*
                New table for version 1.2 or version 2 (2014)
                fixtures for originStudent table
            */
            $originStudents = array("LANSAD", "LLCE", "LEA", "UJF", "Autres");
            foreach ($originStudents as $originStudent) {
                if (!$em->getRepository('InnovaSelfBundle:OriginStudent')->findOneByName($originStudent)){
                    $student = new originStudent();
                    $student->setName($originStudent);
                    $em->persist($student);
                    $output->writeln("Add new OriginStudent (".$originStudent.").");
                }
            }

            /*  New table for version 1.2 or version 2 (2014)
                fixtures for language table
                Important : we must have some keywords to add test.
                So, in TestController.php, we create the test with language "English" or "Italian". 
            */
            if (!$em->getRepository('InnovaSelfBundle:Language')->findOneByName("English")){
                $langEng = new Language();
                $langEng->setName("English");
                $langEng->setColor("blue");
                $em->persist($langEng);
                $em->flush();
                $output->writeln("Add new Language (English).");
            }

            if (!$em->getRepository('InnovaSelfBundle:Language')->findOneByName("Italian")){
                $langIt = new Language();
                $langIt->setName("Italian");
                $langIt->setColor("pink");
                $em->persist($langIt);
                $em->flush();
                $output->writeln("Add new Language (Italian).");
            }

            /*
                New table for version 1.2 or version 2 (2014)
                fixtures for levelLansad table
            */
            $langEng = $em->getRepository('InnovaSelfBundle:Language')->findOneByName("English");
            /* Level for English language */
            $levelLansadEngs = array("A1", "A2", "B1.1", "B1.2", "B1.3", "B2.1", "B2.2", "C1", "C2");
            foreach ($levelLansadEngs as $levelLansadEng) {
                if (!$em->getRepository('InnovaSelfBundle:LevelLansad')->findOneByName($levelLansadEng)){
                    $level = new LevelLansad();
                    $level->setLanguage($langEng);
                    $level->setName($levelLansadEng);
                    $em->persist($level);
                    $output->writeln("Add new LevelLansad (".$levelLansadEng.").");
                }
            }

            $langIt = $em->getRepository('InnovaSelfBundle:Language')->findOneByName("Italian");
            /* Level for Ialian language */
            $levelLansadIts = array("A1", "A2", "B1.1", "B1.2", "B1.3", "B2.1", "B2.2", "C1", "C2");
            foreach ($levelLansadIts as $levelLansadIt) {
                if (!$em->getRepository('InnovaSelfBundle:LevelLansad')->findOneByName($levelLansadIt)){
                    $level = new LevelLansad();
                    $level->setLanguage($langIt);
                    $level->setName($levelLansadIt);
                    $em->persist($level);
                    $output->writeln("Add new LevelLansad (".$levelLansadIt.").");
                }
            }

            $em->flush();

            $now = time();
            $duration = $now - $start;

            $output->writeln("Fixtures exécutées en ".$duration." sec.");
    }
}