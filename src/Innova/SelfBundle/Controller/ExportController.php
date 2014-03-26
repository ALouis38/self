<?php

namespace Innova\SelfBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class ExportController
 *
 * @Route(
 *      "",
 *      name = "",
 *      service = "innova_export"
 * )
 */
class ExportController
{
    protected $kernelRoot;
    protected $entityManager;
    
    public function __construct($kernelRoot, $entityManager)
    {
        $this->kernelRoot = $kernelRoot;
        $this->entityManager = $entityManager;
    }


    /**
     * exportCsvSQL function
     * Update : 16/10/2013 by EV email Cristiana
     *
     * @Route(
     *     "/admin/csv",
     *     name = "csv_export",
     *     options = {"expose"=true}
     * )
     *
     * @Method("GET")
     * @Template()
     */
    public function exportCsvSQLAction()
    {
        $em = $this->entityManager;

        //
        // CSV Export part
        //

        $rootPath = $this->kernelRoot . "/../";
        // File export path
        $csvPathExport = $rootPath . 'web/upload/export/csv/'; 

        // File export name
        $csvName = 'export-' . date("Ymd_d-m-Y_H:i:s") . '.csv';

        // Symfony
        $urlCSVRelativeToWeb = 'upload/export/csv/';

        // Path + Name
        $csvPath = $csvPathExport . $csvName;

        // Open file
        $csvh = fopen($csvPath, 'w+');

        // Init csv write variable
        $csv = '';

        // Loop for test
        $tests = $em->getRepository('InnovaSelfBundle:Test')->findAll();

        $result = array();

        foreach ($tests as $test) {
            $questionnaires = $test->getQuestionnaires();
            // For THE test, loop on the Questionnaire
            foreach ($questionnaires as $questionnaire) {
                // For THE questionnaire, loop on the Trace
                $traces = $questionnaire->getTraces();
                foreach ($traces as $trace) {
                    $userName  = (string) $trace->getUser();
                    $emailName = (string) $trace->getUser()->getEmail();
                    $testDate  = date_format($trace->getDate(), 'd-m-Y');
                    if (!isset($result[$userName]["time"])) {
                        $result[$userName]["time"]=0;
                    }
                    $result[$userName]["time"] = $result[$userName]["time"] + $trace->getTotalTime();
                    $result[$userName]["name"]  = $userName;
                    $result[$userName]["email"] = $emailName;
                    $result[$userName]["date"]  = $testDate;
                }
            }
        }

        $csv .= "\n";

        // Difficulty part
        $csv .= "Difficulté" . ";" ;
        $csv .= "Libellé" . ";" ;
        $csv .= "\n";
        $csv .= "1" . ";" ;
        $csv .= "Très facile" . ";" ;
        $csv .= "\n";
        $csv .= "2" . ";" ;
        $csv .= "Facile" . ";" ;
        $csv .= "\n";
        $csv .= "3" . ";" ;
        $csv .= "Normal" . ";" ;
        $csv .= "\n";
        $csv .= "4" . ";" ;
        $csv .= "Difficile" . ";" ;
        $csv .= "\n";
        $csv .= "5" . ";" ;
        $csv .= "Très Difficile" . ";" ;
        $csv .= "\n";

        $csv .= "\n";
        $csv .= "\n";

        // HEADER
        // Loop to display all questionnaire of the test
        $csv .= "Mail;" ; // A
        $csv .= "NOM;" ; // B
        $csv .= "Prénom;" ; // C
        $csv .= "Date;" ; // D
        $csv .= "tpstot;" ; // E

        $csv .= "filiere;" ; // F
        $csv .= "nivlans;" ; // G
        $csv .= "dialco;" ; // H
        $csv .= "dialce;" ; // I
        $csv .= "dialee;" ; // J

        $cpt_questionnaire=0;
        foreach ($tests as $test) {
            if ($cpt_questionnaire == 0) {
                $questionnaires = $test->getQuestionnaires();
                // For THE test, loop on the Questionnaire
                foreach ($questionnaires as $questionnaire) {
                    $cpt_questionnaire++;
                    // Suite réception nouvelle version du fichier le 29/11/2013 :
                    // je prends le dernier ou les 2 derniers caractères du thême
                    $themeCode = substr($questionnaire->getTheme(), -2);
                    // Si l'extrait est numérique, alors OK
                    // sinon, je ne prends que le dernier caractère.
                    // Exemple : A1COT2, je prends le dernier
                    // A1COT13, je prends les 2 derniers.
                    //
                    if (!is_numeric($themeCode)) {
                        $themeCode = substr($questionnaire->getTheme(), -1);
                    }
                    $csv .= $questionnaire->getTheme() . ";";
                    $csv .= "t" . $themeCode . "diff;";
                    $csv .= "t" . $themeCode . "tps;";
                    $questions = $questionnaire->getQuestions();
                    foreach ($questions as $question) {
                        $subquestions = $question->getSubQuestions();
                        $cpt=0;
                        foreach ($subquestions as $subquestion) {
                            $cpt++;
                            $csv .= "t" . $themeCode . "res" . $cpt . ";"; // Ajout d'une colonne pour chaque proposition de la question.
                            $csv .= "t" . $themeCode . "ch" . $cpt . ";";
                        }
                    }
                }
            }
        }

        $csv .= "\n";

        // BODY
        // Loop to display all data
        foreach ($tests as $test) {
            $users = $em->getRepository('InnovaSelfBundle:User')->findAll();
            foreach ($users as $user) {
                $csv .= $user->getEmail() . ";" ;
                $csv .= $user->getUserName() . ";" ;
                $csv .= $user->getFirstName() . ";" ;
                // For THE test, loop on the Questionnaire
                // CR
                //
                $countQuestionnaireDone = $em->getRepository('InnovaSelfBundle:Questionnaire')
                    ->countDoneYetByUserByTest($test->getId(), $user->getId());

                if ($countQuestionnaireDone > 0) {
                    $csv .= $result[$user->getUserName()]["date"] . ";" . $result[$user->getUserName()]["time"] . ";";
                    // Add 5 colums for Level
                    /*
                    $csv .= $user->getStudentType() . ";";
                    $csv .= $user->getLastLevel() . ";";
                    $csv .= $user->getCoLevel() . ";";
                    $csv .= $user->getCeLevel() . ";";
                    $csv .= $user->getEeLevel() . ";";
                    */
                    $csv .= ";";
                    $csv .= ";";
                    $csv .= ";";
                    $csv .= ";";
                    $csv .= ";";
                    $questionnaires = $em->getRepository('InnovaSelfBundle:Questionnaire')->findAll();
                    foreach ($questionnaires as $questionnaire) {

                        $traces = $em->getRepository('InnovaSelfBundle:Trace')->findBy(array('user' => $user->getId(),
                                        'questionnaire' => $questionnaire->getId()
                                        )
                                    );

                        foreach ($traces as $trace) {
                            $answers = $trace->getAnswers();
                            $csv .= ";" ;

                            $csv .= $trace->getDifficulty() . ";" ;
                            $csv .= $trace->getTotalTime() . ";" ;

                            foreach ($answers as $answer) {
                                $propositions = $answer->getProposition()->getSubQuestion()->getPropositions();
                                $cptProposition = 0;
                                foreach ($propositions as $proposition) {
                                    $cptProposition++;
                                    if ($proposition->getId() === $answer->getProposition()->getId()) {
                                        $propositionRank = $cptProposition;
                                    }
                                }
                                $csv .= ($answer->getProposition()->getRightAnswer() ? '1' : '0') . ";";

                                if ($answer->getProposition()->getTitle() != "") {
                                    $csv .= $answer->getProposition()->getTitle() . ";";
                                } else {
                                    $csv .= $propositionRank . ";";
                                }
                            }
                        }
                    }
                }
                $csv .= "\n";

            }
        }
        // FOOTER
        // Empty

        fwrite($csvh, $csv);
        fclose($csvh);

        //
        // Export file list
        //
        $fileList = array();
        $nbFile = 0;
        if ($dossier = opendir($csvPathExport)) {
            while (false !== ($fichier = readdir($dossier))) {
                if ($fichier != '.' && $fichier != '..') {
                    $nbFile++; // Number of files + 1
                    $fileList[$nbFile] = $fichier;
                }
            }
        }

        closedir($dossier); // Directory close

        //Sort file
        arsort($fileList);

        //
        // To view
        //
        return array(
            "urlCSVRelativeToWeb" => $urlCSVRelativeToWeb,
            "csvName"             => $csvName,
            "fileList"            => $fileList,
            "nbFile"              => $nbFile
        );
    }
}
