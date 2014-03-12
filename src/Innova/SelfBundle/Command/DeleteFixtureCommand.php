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
use Innova\SelfBundle\Entity\Test;
use Innova\SelfBundle\Entity\Questionnaire;
use Innova\SelfBundle\Entity\Question;
use Innova\SelfBundle\Entity\Subquestion;
use Innova\SelfBundle\Entity\Proposition;
use Innova\SelfBundle\Entity\Media;
use Innova\SelfBundle\Entity\Answer;
use Innova\SelfBundle\Entity\Trace;

use Symfony\Component\Console\Helper\DialogHelper;
use Symfony\Component\Console\Helper\HelperSet;

/**
 * Symfony command to delete tests. EV. 12/03/2014
 * We must execute this command with parameter "sql" like :
 * php app/console self:fixtures:delete sql
*/
class DeleteFixtureCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('self:fixtures:delete')
            ->setDescription('Delete test SELF')
            ->addArgument('name')
           ;
    }

    /**
     * If I have any data in database, then I don't execute fixtures. EV.
     *
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {


        $name = $input->getArgument('name');
        if ($name != 'sql') {
        $output->writeln("Absence de paramètres. Impossible d'exécuter les requêtes.");
        exit;
        }

        $em = $this->getContainer()->get('doctrine')->getEntityManager('default');

        $output->writeln("Suppression ANSWER ...");
        $answers = $em->getRepository('InnovaSelfBundle:Answer')->findAll();
        foreach ($answers as $answer) {
            $em->remove($answer);
        }

        $output->writeln("Suppression TRACE ...");
        $traces = $em->getRepository('InnovaSelfBundle:Trace')->findAll();
        foreach ($traces as $trace) {
            $em->remove($trace);
        }

        $output->writeln("Suppression PROPOSITION ...");
        $propositions = $em->getRepository('InnovaSelfBundle:Proposition')->findAll();
        foreach ($propositions as $proposition) {
            $em->remove($proposition);
        }

        $output->writeln("Suppression SUBQUESTION ...");
        $subquestions = $em->getRepository('InnovaSelfBundle:Subquestion')->findAll();
        foreach ($subquestions as $subquestion) {
            $em->remove($subquestion);
        }

        $output->writeln("Suppression QUESTION ...");
        $questions = $em->getRepository('InnovaSelfBundle:Question')->findAll();
        foreach ($questions as $question) {
            $em->remove($question);
        }

        $output->writeln("Suppression QUESTIONNAIRE ...");
        $questionnaires = $em->getRepository('InnovaSelfBundle:Questionnaire')->findAll();
        foreach ($questionnaires as $questionnaire) {
            $em->remove($questionnaire);
        }

        $output->writeln("Suppression MEDIA ...");
        $medias = $em->getRepository('InnovaSelfBundle:Media')->findAll();
        foreach ($medias as $media) {
            $em->remove($media);
        }

        $output->writeln("Suppression TEST ...");
        $tests = $em->getRepository('InnovaSelfBundle:Test')->findAll();
        foreach ($tests as $test) {
            $em->remove($test);
        }

        $em->flush();

        /* il faut exécuter ces requêtes.
delete from answer;# 4 lignes affectées.
delete from trace;# 1 ligne affectée.
delete from proposition;# MySQL a retourné un résultat vide (aucune ligne).
delete from subquestion;# 6 lignes affectées.
delete from question;# 2 lignes affectées.
delete from questionnaire;# 2 lignes affectées.
delete from media;# 4 lignes affectées.
delete from test;
delete from test_questionnaire;
*/


    }

}