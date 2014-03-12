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

/**
 * Symfony command to add or not fixtures. EV.
 *
*/
class Itcea1FixtureCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('self:fixtures:itcea1')
            ->setDescription('SELF CE Italien A1')
        ;
    }

    /**
     * If I have any data in database, then I don't execute fixtures. EV.
     *
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $em = $this->getContainer()->get('doctrine')->getEntityManager('default');

        // CREATION TEST
        $test = $this->createTest("CE Italien A1", "Italian");


        /*******************************************

                    NIVEAU : A1

        ********************************************/

        /*******************************************
                    QUESTIONNAIRE 1 : TVF
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_1 = $this->createQuestionnaire("A1_CE_parking_gare", "A1", "CE", $test);
        $questionnaire_1->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere o false", ""));
        $questionnaire_1->setMediaContext($this->mediaText("", "Pubblicità in stazione", ""));
        $questionnaire_1->setMediaText(
        $this->mediaText("Parcheggia l’auto e parti in treno!",
        "Lascia l’auto vicino alla stazione e parti con i treni Frecciarossa, Frecciargento e Frecciabianca.@@@ A Torino, Milano e Padova puoi avere una tariffa speciale in alcuni parcheggi e garage convenzionati, semplicemente presentando il tuo biglietto valido su treni Frecciarossa, Frecciargento e Frecciabianca.", "")
        );
        // CREATION QUESTION
        $questionnaire_1_1 = $this->createQuestion("TVF", $questionnaire_1);
        // CREATION SUBQUESTION
        //$questionnaire_1_1_1 = $this->createSubquestion("QRM", $questionnaire_1_1, "");
        // CREATION PROPOSITIONS
        //$questionnaire_1_1_1_1 = $this->createProposition("L’offerta è valida solo in alcune città.", true, $questionnaire_1_1_1);
        //$questionnaire_1_1_1_2 = $this->createProposition("Con il biglietto del treno il parcheggio per l’automobile è gratuito.", true, $questionnaire_1_1_1);
        //$questionnaire_1_1_1_3 = $this->createProposition("Per avere tariffa speciale è necessario presentare il biglietto del treno.", true, $questionnaire_1_1_1);
        // CREATION SUBQUESTION
        $questionnaire_1_1_1 = $this->createSubquestionVF("VF", $questionnaire_1_1, "", "L’offerta è valida solo in alcune città.");
        $questionnaire_1_1_2 = $this->createSubquestionVF("VF", $questionnaire_1_1, "", "Con il biglietto del treno il parcheggio per l’automobile è gratuito.");
        $questionnaire_1_1_3 = $this->createSubquestionVF("VF", $questionnaire_1_1, "", "Per avere tariffa speciale è necessario presentare il biglietto del treno.");
        // CREATION PROPOSITIONS
        $questionnaire_1_1_1_1 = $this->createPropositionVF("", "VRAI", true, $questionnaire_1_1_1);
        $questionnaire_1_1_1_1 = $this->createPropositionVF("", "FAUX", false, $questionnaire_1_1_1);

        $questionnaire_1_1_1_2 = $this->createPropositionVF("", "VRAI", true, $questionnaire_1_1_2);
        $questionnaire_1_1_1_2 = $this->createPropositionVF("", "FAUX", false, $questionnaire_1_1_2);

        $questionnaire_1_1_1_3 = $this->createPropositionVF("", "VRAI", true, $questionnaire_1_1_3);
        $questionnaire_1_1_1_3 = $this->createPropositionVF("", "FAUX", false, $questionnaire_1_1_3);


        /*******************************************
                    QUESTIONNAIRE 2 : TQRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_2 = $this->createQuestionnaire("A1_CE_shopping_florence_1_2", "A1", "CE", $test);
        $questionnaire_2->setMediaInstruction($this->mediaText("", "Completa il testo usando le parole suggerite", ""));
        $questionnaire_2->setMediaContext($this->mediaText("", "Breve articolo su rivista femminile", ""));
        $questionnaire_2->setMediaText($this->mediaText("Le vie dello shopping a Firenze", "**1.** _________ davvero tanti i luoghi dove turisti e cittadini fiorentini **2.** __________ trascorrere una bella giornata di shopping all'aria aperta. Partendo dal centro storico, Via Tornabuoni **3.**  _______ sicuramente il posto ideale dove poter fare acquisti chic ed eleganti.", "Le vie dello shopping a Firenze", ""));
        // CREATION QUESTION
        $questionnaire_2_1 = $this->createQuestion("TQRU", $questionnaire_2);
        // CREATION SUBQUESTION
        $questionnaire_2_1_1 = $this->createSubquestion("QRU", $questionnaire_2_1, "**1.** _________ davvero tanti i luoghi dove turisti e cittadini fiorentini");
        $questionnaire_2_1_2 = $this->createSubquestion("QRU", $questionnaire_2_1, "**2.** __________ trascorrere una bella giornata di shopping all'aria aperta. Partendo dal centro storico, Via Tornabuoni ");
        $questionnaire_2_1_3 = $this->createSubquestion("QRU", $questionnaire_2_1, "**3.**  _______ sicuramente il posto ideale dove poter fare acquisti chic ed eleganti.");
        // CREATION PROPOSITIONS
        $questionnaire_2_1_1_1 = $this->createProposition("1.1. Sono", true, $questionnaire_2_1_1);
        $questionnaire_2_1_1_2 = $this->createProposition("1.2. Siamo", false, $questionnaire_2_1_1);
        $questionnaire_2_1_1_3 = $this->createProposition("1.3. é", false, $questionnaire_2_1_1);

        $questionnaire_2_1_2_1 = $this->createProposition("2.1. possiamo", false, $questionnaire_2_1_2);
        $questionnaire_2_1_2_2 = $this->createProposition("2.2.  possono", true, $questionnaire_2_1_2);
        $questionnaire_2_1_2_3 = $this->createProposition("2.3.  posso", false, $questionnaire_2_1_2);

        $questionnaire_2_1_3_1 = $this->createProposition("3.1.  č", true, $questionnaire_2_1_3);
        $questionnaire_2_1_3_2 = $this->createProposition("3.2.  sono", false, $questionnaire_2_1_3);
        $questionnaire_2_1_3_3 = $this->createProposition("3.3.  siamo ", false, $questionnaire_2_1_3);

        /*******************************************
                    QUESTIONNAIRE 3 : QRM
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_3 = $this->createQuestionnaire("A1_CE_vie_tokyo", "A1", "CE", $test);
        $questionnaire_3->setMediaInstruction($this->mediaText("", "Due informazioni sono presenti nel testo. Quali?", ""));
        $questionnaire_3->setMediaContext($this->mediaText("", "E-mail ad un amico", ""));
        $questionnaire_3->setMediaText($this->mediaText("Notizie da Tokyo", "Ciao Matteo,@@@qui sono le 4.00 del mattino e sono stanchissimo! Sono arrivato a Tokyo, finalmente! Il viaggio è stato davvero lungo, ho cambiato tre aerei e ho attraversato due continenti, quasi non ci credo!@@@Sull’aereo ho mangiato il primo vero sushi della mia vita, non mi è piaciuto molto!@@@Ho conosciuto una ragazza americana che studia qui al Campus, mi ha parlato molto bene della città, domani mi porta a fare un giro, poi ti racconto.@@@Buona notte a presto,@@@Giulio", ""));
        // CREATION QUESTION
        $questionnaire_3_1 = $this->createQuestion("QRM", $questionnaire_3);
        // CREATION SUBQUESTION
        $questionnaire_3_1_1 = $this->createSubquestion("QRM", $questionnaire_3_1, "");
        // CREATION PROPOSITIONS
        $questionnaire_3_1_1_1 = $this->createProposition("Giulio scrive a Matteo dopo un lungo viaggio.", true, $questionnaire_3_1_1);
        $questionnaire_3_1_1_2 = $this->createProposition("Giulio racconta che l’aereo è arrivato in ritardo.", false, $questionnaire_3_1_1);
        $questionnaire_3_1_1_3 = $this->createProposition("Giulio visiterà la città accompagnato da una nuova amica.", true, $questionnaire_3_1_1);
        $questionnaire_3_1_1_4 = $this->createProposition("Giulio ha iniziato uno stage.", false, $questionnaire_3_1_1);

        /*******************************************
                    QUESTIONNAIRE 4 : TVF
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_4 = $this->createQuestionnaire("A1_CE_services_bibliotheque", "A1", "CE", $test);
        $questionnaire_4->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere o false", ""));
        $questionnaire_4->setMediaContext($this->mediaText("", "Avviso in biblioteca", ""));
        $questionnaire_4->setMediaText($this->mediaText("Orari e servizi della biblioteca", "A1_CE_services_bibliotheque", "image"));

        // CREATION QUESTION
        $questionnaire_4_1 = $this->createQuestion("TVF", $questionnaire_4);
        // CREATION SUBQUESTION
        //$questionnaire_4_1_1 = $this->createSubquestion("QRM", $questionnaire_4_1, "");
        // CREATION PROPOSITIONS
        //$questionnaire_4_1_1_1 = $this->createProposition("La biblioteca chiude per la pausa pranzo", true, $questionnaire_4_1_1);
        //$questionnaire_4_1_1_2 = $this->createProposition("La biblioteca č aperta tutte le mattine.", false, $questionnaire_4_1_1);
        //$questionnaire_4_1_1_3 = $this->createProposition("In biblioteca č possibile navigare su internet senza pagare.", true, $questionnaire_4_1_1);
        //$questionnaire_4_1_1_4 = $this->createProposition("XXXXXXXXXXXXXXXXXX", true, $questionnaire_4_1_1);

        $questionnaire_4_1_1 = $this->createSubquestionVF("VF", $questionnaire_4_1, "", "La biblioteca chiude per la pausa pranzo");
        $questionnaire_4_1_2 = $this->createSubquestionVF("VF", $questionnaire_4_1, "", "La biblioteca č aperta tutte le mattine.");
        $questionnaire_4_1_3 = $this->createSubquestionVF("VF", $questionnaire_4_1, "", "In biblioteca č possibile navigare su internet senza pagare.");
        $questionnaire_4_1_4 = $this->createSubquestionVF("VF", $questionnaire_4_1, "", "Non è permesso restare in biblioteca a studiare");
        // CREATION PROPOSITIONS
        $questionnaire_4_1_1_1 = $this->createPropositionVF("", "VRAI", true, $questionnaire_4_1_1);
        $questionnaire_4_1_1_1 = $this->createPropositionVF("", "FAUX", false, $questionnaire_4_1_1);

        $questionnaire_4_1_1_2 = $this->createPropositionVF("", "VRAI", false, $questionnaire_4_1_2);
        $questionnaire_4_1_1_2 = $this->createPropositionVF("", "FAUX", true, $questionnaire_4_1_2);

        $questionnaire_4_1_1_3 = $this->createPropositionVF("", "VRAI", true, $questionnaire_4_1_3);
        $questionnaire_4_1_1_3 = $this->createPropositionVF("", "FAUX", false, $questionnaire_4_1_3);

        $questionnaire_4_1_1_4 = $this->createPropositionVF("", "VRAI", false, $questionnaire_4_1_4);
        $questionnaire_4_1_1_4 = $this->createPropositionVF("", "FAUX", true, $questionnaire_4_1_4);


        /*******************************************
                    QUESTIONNAIRE 5 : n'existe pas
        ********************************************/

        /*******************************************
                    QUESTIONNAIRE 6 : TQRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_6 = $this->createQuestionnaire("A1_CE_cours_bibliotheque", "A1", "CE", $test);
        $questionnaire_6->setMediaInstruction($this->mediaText("", "Rispondi alle domande. Una sola risposta è corretta", ""));
        $questionnaire_6->setMediaContext($this->mediaText("", "Brochure informativa in biblioteca", ""));
        $questionnaire_6->setMediaText($this->mediaText("I corsi della Società per la biblioteca circolante", "A1_CE_cours_bibliotheque", "image"));
        // CREATION QUESTION
        $questionnaire_6_1 = $this->createQuestion("TQRU", $questionnaire_6);
        // CREATION SUBQUESTION
        $questionnaire_6_1_1 = $this->createSubquestion("QRU", $questionnaire_6_1, "1.I corsi dell’associazione sono");
        $questionnaire_6_1_2 = $this->createSubquestion("QRU", $questionnaire_6_1, "2. L’Associazione:");
        $questionnaire_6_1_3 = $this->createSubquestion("QRU", $questionnaire_6_1, "3. Per iscriversi all’Associazione:");
        // CREATION PROPOSITIONS
        $questionnaire_6_1_1_1 = $this->createProposition("rivolti agli anziani.", false, $questionnaire_6_1_1);
        $questionnaire_6_1_1_2 = $this->createProposition("aperti a tutti.", false, $questionnaire_6_1_1);
        $questionnaire_6_1_1_3 = $this->createProposition("solo per i soci.", true, $questionnaire_6_1_1);

        $questionnaire_6_1_2_1 = $this->createProposition("Offre solo corsi di lingua.", false, $questionnaire_6_1_2);
        $questionnaire_6_1_2_2 = $this->createProposition("Offre corsi di lingua e informatica.", false, $questionnaire_6_1_2);
        $questionnaire_6_1_2_3 = $this->createProposition("Offre corsi di vario tipo.", true, $questionnaire_6_1_2);

        $questionnaire_6_1_3_1 = $this->createProposition("Non si paga nulla", false, $questionnaire_6_1_3);
        $questionnaire_6_1_3_2 = $this->createProposition("Bisogna pagare una piccola somma", true, $questionnaire_6_1_3);
        $questionnaire_6_1_3_3 = $this->createProposition("Bisogna presentarsi il primo giorno dell’anno", false, $questionnaire_6_1_3);

        /*******************************************
                    QUESTIONNAIRE 7 : QRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_7 = $this->createQuestionnaire("A1_CE_ticket_SMS", "A1", "CE", $test);
        $questionnaire_7->setMediaInstruction($this->mediaText("", "Rispondi alle domande. Una sola risposta è corretta", ""));
        $questionnaire_7->setMediaContext($this->mediaText("", "Brochure informativa sui servizi in autobus", ""));
        $questionnaire_7->setMediaText($this->mediaText("", "A1_CE_ticket_SMS", "image"));
        // CREATION QUESTION
        $questionnaire_7_1 = $this->createQuestion("QRU", $questionnaire_7);
        // CREATION SUBQUESTION
        $questionnaire_7_1_1 = $this->createSubquestion("QRU", $questionnaire_7_1, "Il servizio permette di");

        // CREATION PROPOSITIONS
        $questionnaire_7_1_1_1 = $this->createProposition("avere informazioni sul traffico.", false, $questionnaire_7_1_1);
        $questionnaire_7_1_1_2 = $this->createProposition("comprare il biglietto con il cellulare.", true, $questionnaire_7_1_1);
        $questionnaire_7_1_1_3 = $this->createProposition("conoscere gli orari dell’autobus.", false, $questionnaire_7_1_1);

        /*******************************************
                    QUESTIONNAIRE 8 : n'existe pas
        ********************************************/

        /*******************************************
                    QUESTIONNAIRE 9 : QRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_9 = $this->createQuestionnaire("A1_CE_train_enfants", "A1", "CE", $test);
        $questionnaire_9->setMediaInstruction($this->mediaText("", "Quale informazione č presente nel testo?", ""));
        $questionnaire_9->setMediaContext($this->mediaText("", "Pubblicitŕ informativa in stazione", ""));
        $questionnaire_9->setMediaText($this->mediaText("Su Italo i bambini fino a 4 anni viaggiano gratuitamente  e devono essere accompagnati da  un adulto. Quelli dai 5 ai 14 anni possono viaggiare da soli ma  i genitori devono richiedere il Servizio Hostess. Per i ragazzi dai 15 anni ai 18 anni sono previsti ottimi sconti sulle offerte Base ed Economy.
", "Su Italo grandi vantaggi per i piccoli!", ""));
        // CREATION QUESTION
        $questionnaire_9_1 = $this->createQuestion("QRU", $questionnaire_9);
        // CREATION SUBQUESTION
        $questionnaire_9_1_1 = $this->createSubquestion("QRU", $questionnaire_9_1, "Il servizio permette di");

        // CREATION PROPOSITIONS
        $questionnaire_9_1_1_1 = $this->createProposition("I bambini che hanno meno di quattro anni non devono pagare il biglietto.", true, $questionnaire_9_1_1);
        $questionnaire_9_1_1_2 = $this->createProposition("Il Servizio Hostess č incluso nel prezzo del biglietto.", false, $questionnaire_9_1_1);
        $questionnaire_9_1_1_3 = $this->createProposition("Comprare il biglietto su internet permette di avere ottimi sconti.", false, $questionnaire_9_1_1);

        /*******************************************
                    QUESTIONNAIRE 10 : QRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_10 = $this->createQuestionnaire("A1_CE_SMS_pizza", "A1", "CE", $test);
        $questionnaire_10->setMediaInstruction($this->mediaText("", "Rispondi alle domande. Una sola risposta č corretta", ""));
        $questionnaire_10->setMediaContext($this->mediaText("", "SMS tra madre e figlia", ""));
        $questionnaire_10->setMediaText($this->mediaText("", "Mamma, stasera non ci sono, vado a mangiare la pizza con Paolo. Tranquilla non faccio tardi, lo so che domani cč scuola, torno verso le 1**1.**30. A dopo, Francy", ""));
        // CREATION QUESTION
        $questionnaire_10_1 = $this->createQuestion("TQRU", $questionnaire_10);
        // CREATION SUBQUESTION
        $questionnaire_10_1_1 = $this->createSubquestion("QRU", $questionnaire_10_1, "1.Francesca esce con Paolo per:");
        $questionnaire_10_1_2 = $this->createSubquestion("QRU", $questionnaire_10_1, "2. Domani Francesca:");
        // CREATION PROPOSITIONS
        $questionnaire_10_1_1_1 = $this->createProposition("cena", true, $questionnaire_10_1_1);
        $questionnaire_10_1_1_2 = $this->createProposition("apranzo", false, $questionnaire_10_1_1);
        $questionnaire_10_1_1_3 = $this->createProposition("merenda", false, $questionnaire_10_1_1);

        $questionnaire_10_1_2_1 = $this->createProposition("č in vacanza.", false, $questionnaire_10_1_2);
        $questionnaire_10_1_2_2 = $this->createProposition("deve andare a scuola.", true, $questionnaire_10_1_2);
        $questionnaire_10_1_2_3 = $this->createProposition("esce con Paolo.", false, $questionnaire_10_1_2);

        /*******************************************
                    QUESTIONNAIRE 11 : QRM
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_11 = $this->createQuestionnaire("A1_CE_mail_vacances", "A1", "CE", $test);
        $questionnaire_11->setMediaInstruction($this->mediaText("", "Due informazioni sono presenti nel testo. Quali?", ""));
        $questionnaire_11->setMediaContext($this->mediaText("", "E-mail tra padre e figlio", ""));
        $questionnaire_11->setMediaText($this->mediaText("Qui tutto bene!", "Ciao papà,@@@le vacanze procedono benissimo! La mattina faccio sempre colazione al bar e poi vado in spiaggia fino all’ora di pranzo. Nel pomeriggio sto in camera a leggere e a riposarmi e poi la sera, verso le 7.00, vado a correre e dopo cena esco con dei ragazzi simpatici che ho conosciuto qui. Spero tutto bene lì a casa!! @@@Un abbraccio e a presto, Giulio", ""));
        // CREATION QUESTION
        $questionnaire_11_1 = $this->createQuestion("QRM", $questionnaire_11);
        // CREATION SUBQUESTION
        $questionnaire_11_1_1 = $this->createSubquestion("QRM", $questionnaire_11_1, "");
        // CREATION PROPOSITIONS
        $questionnaire_11_1_1_1 = $this->createProposition("Giulio č in vacanza al mare.", true, $questionnaire_11_1_1);
        $questionnaire_11_1_1_2 = $this->createProposition("Giulio la mattina prende il cappuccino", false, $questionnaire_11_1_1);
        $questionnaire_11_1_1_3 = $this->createProposition("Giulio dopo pranzo controlla le sue mail.", false, $questionnaire_11_1_1);
        $questionnaire_11_1_1_4 = $this->createProposition("Giulio ha trovato dei nuovi amici in vacanza.", true, $questionnaire_11_1_1);

        /*******************************************
                    QUESTIONNAIRE 12 : TVF
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_12 = $this->createQuestionnaire("A1_CE_cours_prives_science", "A1", "CE", $test);
        $questionnaire_12->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere o false", ""));
        $questionnaire_12->setMediaContext($this->mediaText("", "Annuncio all’università", ""));
        $questionnaire_12->setMediaText($this->mediaText("Lezioni private", "Hai problemi con la matematica? Non capisci la fisica? Non dormi prima dell’esame di chimica? Stai tranquillo!! C’è chi può aiutarti!! Sono disponibile per lezioni private e preparazione agli esami. Chiamami al 345 6756433,  oppure scrivi al mio indirizzo mail:@@@ fabrizio.sos-esami@hotmail.it.", ""));
        // CREATION QUESTION
        $questionnaire_12_1 = $this->createQuestion("TVF", $questionnaire_12);
        // CREATION SUBQUESTION
        //$questionnaire_12_1_1 = $this->createSubquestion("QRM", $questionnaire_12_1, "");
        // CREATION PROPOSITIONS
        //$questionnaire_12_1_1_1 = $this->createProposition("Lannuncio č rivolto agli studenti che hanno problemi con le materie letterarie.", false, $questionnaire_12_1_1);
        //$questionnaire_12_1_1_2 = $this->createProposition("Lannuncio pubblicizza i servizi di una scuola.", false, $questionnaire_12_1_1);
        //$questionnaire_12_1_1_3 = $this->createProposition("Fabrizio propone lezioni individuali.", true, $questionnaire_12_1_1);


        // CREATION SUBQUESTION
        $questionnaire_12_1_1 = $this->createSubquestionVF("VF", $questionnaire_12_1, "", "L’annuncio è rivolto agli studenti che hanno problemi con le materie letterarie.");
        $questionnaire_12_1_2 = $this->createSubquestionVF("VF", $questionnaire_12_1, "", "DL’annuncio pubblicizza i servizi di una scuola.");
        $questionnaire_12_1_3 = $this->createSubquestionVF("VF", $questionnaire_12_1, "", "Fabrizio propone lezioni individuali.");
        // CREATION PROPOSITIONS
        $questionnaire_12_1_1_1 = $this->createPropositionVF("", "VRAI", false, $questionnaire_12_1_1);
        $questionnaire_12_1_1_1 = $this->createPropositionVF("", "FAUX", true, $questionnaire_12_1_1);

        $questionnaire_12_1_1_2 = $this->createPropositionVF("", "VRAI", false, $questionnaire_12_1_2);
        $questionnaire_12_1_1_2 = $this->createPropositionVF("", "FAUX", true, $questionnaire_12_1_2);

        $questionnaire_12_1_1_3 = $this->createPropositionVF("", "VRAI", true, $questionnaire_12_1_3);
        $questionnaire_12_1_1_3 = $this->createPropositionVF("", "FAUX", false, $questionnaire_12_1_3);


        /*******************************************
                    QUESTIONNAIRE 13 : QRM
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_13 = $this->createQuestionnaire("A1_CE_livres_universite", "A1", "CE", $test);
        $questionnaire_13->setMediaInstruction($this->mediaText("", "Due informazioni sono presenti nel testo. Quali?", ""));
        $questionnaire_13->setMediaContext($this->mediaText("", "Annuncio all’università", ""));
        $questionnaire_13->setMediaText($this->mediaText("Vendita libri usati", "Vendo libri usati per gli studenti del I anno di Letteratura italiana. I libri sono come nuovi, prezzo da stabilire. Offro in regalo le fotocopie distribuite durante il corso.@@@Per informazioni chiamare il 329 6753123", ""));
        // CREATION QUESTION
        $questionnaire_13_1 = $this->createQuestion("QRM", $questionnaire_13);
        // CREATION SUBQUESTION
        $questionnaire_13_1_1 = $this->createSubquestion("QRM", $questionnaire_13_1, "");
        // CREATION PROPOSITIONS
        $questionnaire_13_1_1_1 = $this->createProposition("L’annuncio è rivolto a studenti che cercano libri.", true, $questionnaire_13_1_1);
        $questionnaire_13_1_1_2 = $this->createProposition("I libri sono venduti a metà prezzo.", false, $questionnaire_13_1_1);
        $questionnaire_13_1_1_3 = $this->createProposition("Chi compra i libri non deve pagare le fotocopie del corso.", true, $questionnaire_13_1_1);

        /*******************************************
                    QUESTIONNAIRE 14 : TQRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_14 = $this->createQuestionnaire("A1_CE_soldes_ete", "A1", "CE", $test);
        $questionnaire_14->setMediaInstruction($this->mediaText("", "Rispondi alle domande. Una sola risposta è corretta", ""));
        $questionnaire_14->setMediaContext($this->mediaText("", "Pubblicità in un negozio di abbigliamento", ""));
        $questionnaire_14->setMediaText($this->mediaText("Sconti di stagione","Dal 1° luglio al 30 agosto grandi sconti su tutti i capi d’abbigliamento. Pantaloni e giacche al 40%, gonne e vestiti fino al 60% e tutti i costumi da bagno al 50%. Per i clienti che hanno la carta fedeltà, in regalo una borsa da spiaggia. Venite a trovarci, dal lunedì al sabato dalle 9 alle 19. Siamo aperti anche la prima domenica del mese.", ""));
        // CREATION QUESTION
        $questionnaire_14_1 = $this->createQuestion("TQRU", $questionnaire_14);
        // CREATION SUBQUESTION
        $questionnaire_14_1_1 = $this->createSubquestion("QRU", $questionnaire_14_1, "1. Il messaggio pubblicizza gli sconti:");
        $questionnaire_14_1_2 = $this->createSubquestion("QRU", $questionnaire_14_1, "2. I clienti con la carta fedeltà hanno diritto a:");
        $questionnaire_14_1_3 = $this->createSubquestion("QRU", $questionnaire_14_1, "3. Il negozio è aperto la domenica:");
        // CREATION PROPOSITIONS
        $questionnaire_14_1_1_1 = $this->createProposition("estivi", true, $questionnaire_14_1_1);
        $questionnaire_14_1_1_2 = $this->createProposition("invernali", false, $questionnaire_14_1_1);
        $questionnaire_14_1_1_3 = $this->createProposition("primaverili", false, $questionnaire_14_1_1);

        $questionnaire_14_1_2_1 = $this->createProposition("uno sconto ulteriore", false, $questionnaire_14_1_2);
        $questionnaire_14_1_2_2 = $this->createProposition("un oggetto in regalo", true, $questionnaire_14_1_2);
        $questionnaire_14_1_2_3 = $this->createProposition("punti extra per le prossime spese", false, $questionnaire_14_1_2);

        $questionnaire_14_1_3_1 = $this->createProposition("una volta al mese", true, $questionnaire_14_1_3);
        $questionnaire_14_1_3_2 = $this->createProposition("due volte al mese", false, $questionnaire_14_1_3);
        $questionnaire_14_1_3_3 = $this->createProposition("sempre", false, $questionnaire_14_1_3);

        /*******************************************
                    QUESTIONNAIRE 15 : TVF
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_15 = $this->createQuestionnaire("A1_CE_competitions_campus", "A1", "CE", $test);
        $questionnaire_15->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere o false", ""));
        $questionnaire_15->setMediaContext($this->mediaText("", "E-mail ad un amico", ""));
        $questionnaire_15->setMediaText($this->mediaText("Gare di atletica", "Ciao Luca,@@@sono stanchissimo ma ho trovato le energie per scriverti. @@@Oggi, qui al campus sono iniziate le gare di atletica: che emozione! Io ho fatto i 100 metri e sono arrivato 3°! Sono tanto contento perché mi sono classificato tra i primi tre e domani posso correre di nuovo.@@@Laura fa la maratona domani, è andata a letto molto presto stasera. Domani ti racconto come va. @@@Ciao ciao, buona notte.@@@Riccardo", ""));
        // CREATION QUESTION
        $questionnaire_15_1 = $this->createQuestion("TVF", $questionnaire_15);
        // CREATION SUBQUESTION
        //$questionnaire_15_1_1 = $this->createSubquestion("TVF", $questionnaire_15_1, "");
        // CREATION PROPOSITIONS
        //$questionnaire_15_1_1_1 = $this->createProposition("Al campus sono iniziate le competizioni sportive.", true, $questionnaire_15_1_1);
        //$questionnaire_15_1_1_2 = $this->createProposition("Riccardo ha finito le sue gare.", false, $questionnaire_15_1_1);
        //$questionnaire_15_1_1_3 = $this->createProposition("Laura ha dormito tutto il pomeriggio.", false, $questionnaire_15_1_1);

        // CREATION SUBQUESTION
        $questionnaire_15_1_1 = $this->createSubquestionVF("VF", $questionnaire_15_1, "", "Al campus sono iniziate le competizioni sportive.");
        $questionnaire_15_1_2 = $this->createSubquestionVF("VF", $questionnaire_15_1, "", "Riccardo ha finito le sue gare.");
        $questionnaire_15_1_3 = $this->createSubquestionVF("VF", $questionnaire_15_1, "", "Laura ha dormito tutto il pomeriggio.");
        // CREATION PROPOSITIONS
        $questionnaire_15_1_1_1 = $this->createPropositionVF("", "VRAI", true, $questionnaire_15_1_1);
        $questionnaire_15_1_1_1 = $this->createPropositionVF("", "FAUX", false, $questionnaire_15_1_1);

        $questionnaire_15_1_1_2 = $this->createPropositionVF("", "VRAI", false, $questionnaire_15_1_2);
        $questionnaire_15_1_1_2 = $this->createPropositionVF("", "FAUX", true, $questionnaire_15_1_2);

        $questionnaire_15_1_1_3 = $this->createPropositionVF("", "VRAI", false, $questionnaire_15_1_3);
        $questionnaire_15_1_1_3 = $this->createPropositionVF("", "FAUX", true, $questionnaire_15_1_3);

        /*******************************************
                    QUESTIONNAIRE 16 : TQRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_16 = $this->createQuestionnaire("A1_CE_nouvelles_londres", "A1", "CE", $test);
        $questionnaire_16->setMediaInstruction($this->mediaText("", "Completa il testo usando le parole suggerite", ""));
        $questionnaire_16->setMediaContext($this->mediaText("", "E-mail ad un amico", ""));
        $questionnaire_16->setMediaText($this->mediaText("Notizie da Londra", "Ciao Luca, scusa il ritardo ma** 1.** _______ancora abituarmi ai ritmi della nuova vita. @@@ Sai dove vivo adesso? Sono a Londra e finalmente posso fare il lavoro dei miei sogni! @@@Lavoro come stilista per una grande marca.** 2.** ________ assolutamente venire a trovarmi!@@@In questa cittŕ **3.** ________ fare davvero quello che ti piace.
I miei genitori ancora non sanno che ho una ragazza, incredibile vero? @@@Adesso **4.**_______ andare! Ciao@@@Giovanni @@@P. S. Dobbiamo sentirci piů spesso!", ""));
        // CREATION QUESTION
        $questionnaire_16_1 = $this->createQuestion("TQRU", $questionnaire_16);
        // CREATION SUBQUESTION
        $questionnaire_16_1_1 = $this->createSubquestion("QRU", $questionnaire_16_1, ""); // Partie vide, vu avec Francesca. 04/04/2014.
        $questionnaire_16_1_2 = $this->createSubquestion("QRU", $questionnaire_16_1, "");
        $questionnaire_16_1_3 = $this->createSubquestion("QRU", $questionnaire_16_1, "");
        $questionnaire_16_1_4 = $this->createSubquestion("QRU", $questionnaire_16_1, "");
        // CREATION PROPOSITIONS
        $questionnaire_16_1_1_1 = $this->createProposition("1.1. devo", true, $questionnaire_16_1_1);
        $questionnaire_16_1_1_2 = $this->createProposition("1.2. posso", false, $questionnaire_16_1_1);
        $questionnaire_16_1_1_3 = $this->createProposition("1.3. voglio", false, $questionnaire_16_1_1);

        $questionnaire_16_1_2_1 = $this->createProposition("2.1. devi", true, $questionnaire_16_1_2);
        $questionnaire_16_1_2_2 = $this->createProposition("2.2. puoi", false, $questionnaire_16_1_2);
        $questionnaire_16_1_2_3 = $this->createProposition("2.3. vuoi", false, $questionnaire_16_1_2);

        $questionnaire_16_1_3_1 = $this->createProposition("3.1. devi", false, $questionnaire_16_1_3);
        $questionnaire_16_1_3_2 = $this->createProposition("3.2. puoi", true, $questionnaire_16_1_3);
        $questionnaire_16_1_3_3 = $this->createProposition("3.3. vuoi", false, $questionnaire_16_1_3);

        $questionnaire_16_1_4_1 = $this->createProposition("4.1. devo", true, $questionnaire_16_1_4);
        $questionnaire_16_1_4_2 = $this->createProposition("4.2. posso", false, $questionnaire_16_1_4);
        $questionnaire_16_1_4_3 = $this->createProposition("4.3. voglio", false, $questionnaire_16_1_4);

        /*******************************************
                    QUESTIONNAIRE 17 : TVF
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_17 = $this->createQuestionnaire("A1_CE_indications_route", "A1", "CE", $test);
        $questionnaire_17->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere o false", ""));
        $questionnaire_17->setMediaContext($this->mediaText("", "Post-it ad un’amica", ""));
        $questionnaire_17->setMediaText($this->mediaText("", "Ciao Sara,@@@io esco, ci vediamo direttamente a casa di Giorgio, ci vogliono due minuti a piedi. La festa inizia alle 10.00, non arrivare tardi come sempre! È facilissimo: attraversa la strada e continua dritto fino a piazza Verdi, poi quando arrivi al supermercato all’angolo prendi la seconda a sinistra, non puoi sbagliare, perché trovi il Bar Sport. Dopo gira subito a destra e trovi la sua casa accanto al panificio. Suona al campanello Rossi. @@@A stasera,@@@Lucia", ""));
        // CREATION QUESTION
        $questionnaire_17_1 = $this->createQuestion("TVF", $questionnaire_17);
        // CREATION SUBQUESTION
        //$questionnaire_17_1_1 = $this->createSubquestion("QRM", $questionnaire_17_1, "");
        // CREATION PROPOSITIONS
        //$questionnaire_17_1_1_1 = $this->createProposition("La casa di Giorgio è lontana da quella di Lucia e Sara", false, $questionnaire_17_1_1);
        //$questionnaire_17_1_1_2 = $this->createProposition("Per andare alla festa Sara deve prendere il tram", false, $questionnaire_17_1_1);
        //$questionnaire_17_1_1_3 = $this->createProposition("Il Bar Sport si trova dopo piazza Verdi", true, $questionnaire_17_1_1);
        //$questionnaire_17_1_1_4 = $this->createProposition("La casa di Giorgio si trova al lato del panificio", true, $questionnaire_17_1_1);

        // CREATION SUBQUESTION
        $questionnaire_17_1_1 = $this->createSubquestionVF("VF", $questionnaire_17_1, "", "La casa di Giorgio è lontana da quella di Lucia e Sara");
        $questionnaire_17_1_2 = $this->createSubquestionVF("VF", $questionnaire_17_1, "", "Per andare alla festa Sara deve prendere il tram");
        $questionnaire_17_1_3 = $this->createSubquestionVF("VF", $questionnaire_17_1, "", "Il Bar Sport si trova dopo piazza Verdi");
        $questionnaire_17_1_4 = $this->createSubquestionVF("VF", $questionnaire_17_1, "", "La casa di Giorgio si trova al lato del panificio");
        // CREATION PROPOSITIONS
        $questionnaire_17_1_1_1 = $this->createPropositionVF("", "VRAI", false, $questionnaire_17_1_1);
        $questionnaire_17_1_1_1 = $this->createPropositionVF("", "FAUX", true, $questionnaire_17_1_1);

        $questionnaire_17_1_1_2 = $this->createPropositionVF("", "VRAI", false, $questionnaire_17_1_2);
        $questionnaire_17_1_1_2 = $this->createPropositionVF("", "FAUX", true, $questionnaire_17_1_2);

        $questionnaire_17_1_1_3 = $this->createPropositionVF("", "VRAI", true, $questionnaire_17_1_3);
        $questionnaire_17_1_1_3 = $this->createPropositionVF("", "FAUX", false, $questionnaire_17_1_3);

        $questionnaire_17_1_1_4 = $this->createPropositionVF("", "VRAI", true, $questionnaire_17_1_4);
        $questionnaire_17_1_1_4 = $this->createPropositionVF("", "FAUX", false, $questionnaire_17_1_4);

        /*******************************************
                    QUESTIONNAIRE 18 : TQRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_18 = $this->createQuestionnaire("A1_CE_shopping_florence_2_2", "A1", "CE", $test);
        $questionnaire_18->setMediaInstruction($this->mediaText("", "Completa il testo usando le parole suggerite", ""));
        $questionnaire_18->setMediaContext($this->mediaText("", "Breve articolo su rivista femminile", ""));
        $questionnaire_18->setMediaText($this->mediaText("Le vie dello shopping a Firenze", "Sempre **1.** ____ pieno centro per uno shopping più alla portata dei giovani segnaliamo Via dei Calzaioli, **2.** ______ potrete trovare negozi sportivi, grandi catene commerciali e anche, per la felicità dei più piccoli tanti negozi **3.** ____ giocattoli.", ""));
        // CREATION QUESTION
        $questionnaire_18_1 = $this->createQuestion("TQRU", $questionnaire_18);
        // CREATION SUBQUESTION
        $questionnaire_18_1_1 = $this->createSubquestion("QRU", $questionnaire_18_1, "");
        $questionnaire_18_1_2 = $this->createSubquestion("QRU", $questionnaire_18_1, "");
        $questionnaire_18_1_3 = $this->createSubquestion("QRU", $questionnaire_18_1, "");
        // CREATION PROPOSITIONS
        $questionnaire_18_1_1_1 = $this->createProposition("1.1. dal", false, $questionnaire_18_1_1);
        $questionnaire_18_1_1_2 = $this->createProposition("1.2. in", true, $questionnaire_18_1_1);
        $questionnaire_18_1_1_3 = $this->createProposition("1.3. sul ", false, $questionnaire_18_1_1);

        $questionnaire_18_1_2_1 = $this->createProposition("2.1. quando", false, $questionnaire_18_1_2);
        $questionnaire_18_1_2_2 = $this->createProposition("2.2. come", false, $questionnaire_18_1_2);
        $questionnaire_18_1_2_3 = $this->createProposition("2.3. dove ", true, $questionnaire_18_1_2);

        $questionnaire_18_1_3_1 = $this->createProposition("3.1. di", true, $questionnaire_18_1_3);
        $questionnaire_18_1_3_2 = $this->createProposition("3.2. a", false, $questionnaire_18_1_3);
        $questionnaire_18_1_3_3 = $this->createProposition("3.3. da", false, $questionnaire_18_1_3);

        /*******************************************
                    QUESTIONNAIRE 19 : TVF
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_19 = $this->createQuestionnaire("A1_CE_agenda_anita", "A1", "CE", $test);
        $questionnaire_19->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere o false", ""));
        $questionnaire_19->setMediaContext($this->mediaText("", "L’agenda di Anita", ""));
        $questionnaire_19->setMediaText($this->mediaText("Appuntamenti della settimana", "Le tableau vous sera donner dans un dossier  à part", ""));
        // CREATION QUESTION
        $questionnaire_19_1 = $this->createQuestion("TVF", $questionnaire_19);
        // CREATION SUBQUESTION
        //$questionnaire_19_1_1 = $this->createSubquestion("QRM", $questionnaire_19_1, "");
        // CREATION PROPOSITIONS
        //$questionnaire_19_1_1_1 = $this->createProposition("Anita esce spesso con Luca.", false, $questionnaire_19_1_1);
        //$questionnaire_19_1_1_2 = $this->createProposition("Anita non va mai a correre.", true, $questionnaire_19_1_1);
        //$questionnaire_19_1_1_3 = $this->createProposition("Le lezioni di Anita sono quasi sempre la mattina.", true, $questionnaire_19_1_1);
        //$questionnaire_19_1_1_4 = $this->createProposition("Anita vede i genitori durante la settimana", false, $questionnaire_19_1_1);
        //$questionnaire_19_1_1_1 = $this->createProposition("Anita lavora solo la sera.", false, $questionnaire_19_1_1);

        // CREATION SUBQUESTION
        $questionnaire_19_1_1 = $this->createSubquestionVF("VF", $questionnaire_19_1, "", "Anita esce spesso con Luca.");
        $questionnaire_19_1_2 = $this->createSubquestionVF("VF", $questionnaire_19_1, "", "Anita non va mai a correre.");
        $questionnaire_19_1_3 = $this->createSubquestionVF("VF", $questionnaire_19_1, "", "Le lezioni di Anita sono quasi sempre la mattina.");
        $questionnaire_19_1_4 = $this->createSubquestionVF("VF", $questionnaire_19_1, "", "Anita vede i genitori durante la settimana");
        $questionnaire_19_1_5 = $this->createSubquestionVF("VF", $questionnaire_19_1, "", "Anita lavora solo la sera.");

        // CREATION PROPOSITIONS
        $questionnaire_19_1_1_1 = $this->createPropositionVF("", "VRAI", false, $questionnaire_19_1_1);
        $questionnaire_19_1_1_1 = $this->createPropositionVF("", "FAUX", true, $questionnaire_19_1_1);

        $questionnaire_19_1_1_2 = $this->createPropositionVF("", "VRAI", true, $questionnaire_19_1_2);
        $questionnaire_19_1_1_2 = $this->createPropositionVF("", "FAUX", false, $questionnaire_19_1_2);

        $questionnaire_19_1_1_3 = $this->createPropositionVF("", "VRAI", true, $questionnaire_19_1_3);
        $questionnaire_19_1_1_3 = $this->createPropositionVF("", "FAUX", false, $questionnaire_19_1_3);

        $questionnaire_19_1_1_4 = $this->createPropositionVF("", "VRAI", false, $questionnaire_19_1_4);
        $questionnaire_19_1_1_4 = $this->createPropositionVF("", "FAUX", true, $questionnaire_19_1_4);

        $questionnaire_19_1_1_5 = $this->createPropositionVF("", "VRAI", false, $questionnaire_19_1_5);
        $questionnaire_19_1_1_5 = $this->createPropositionVF("", "FAUX", true, $questionnaire_19_1_5);

        /*******************************************
                    MISE EN BASE
        ********************************************/
        $em->flush();

        $output->writeln("Fixtures Italian CE A1 exécutées.");
    }

    /**
     *
     */
    protected function createTest($name, $language)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager('default');

        $test = new Test();
        $test->setName($name);
        $language = $em->getRepository('InnovaSelfBundle:Language')->findOneByName($language);
        $test->setLanguage($language);
        $em->persist($test);

        return $test;
    }

    /**
     *
     */
    protected function createQuestionnaire($title, $level, $skill, $test)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager('default');

        // Création du questionnaire
        $questionnaire = new Questionnaire();

        $questionnaire->addTest($test);

        $questionnaire->setTheme($title);

        $level = $em->getRepository('InnovaSelfBundle:Level')->findOneByName($level);
        $questionnaire->setLevel($level);

        // Traitement sur le skill
        $skill = $em->getRepository('InnovaSelfBundle:Skill')->findOneByName($skill);
        $questionnaire->setSkill($skill);


        $questionnaire->setAuthor();
        $questionnaire->setInstruction();
                        $questionnaire->setDuration();
                        $questionnaire->setDomain();
                        $questionnaire->setSupport();
                        $questionnaire->setFlow();
                        $questionnaire->setFocus();
                        $questionnaire->setSource();
                        $questionnaire->setListeningLimit(0); //ListeningLimit
                        $questionnaire->setDialogue(0);


        $em->persist($questionnaire);

        return $questionnaire;
    }

    /**
     *
     */
    protected function createQuestion($typology, $questionnaire)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager('default');

        // Création du questionnaire
        $question = new Question();

        $typo = $em->getRepository('InnovaSelfBundle:Typology')->findOneByName($typology);
        $question->setTypology($typo);

        $question->setQuestionnaire($questionnaire);

        $em->persist($question);

        return $question;
    }

    /**
     *
     */
    protected function createSubquestion($typology, $question, $amorce)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager('default');

        // Création du questionnaire
        $subquestion = new Subquestion();

        $typo = $em->getRepository('InnovaSelfBundle:Typology')->findOneByName($typology);
        $subquestion->setTypology($typo);

        $subquestion->setQuestion($question);

        if ($amorce != '') {
            $subquestion->setMediaAmorce($this->mediaText("", $amorce, ""));
        }

        $em->persist($subquestion);

        return $subquestion;
    }

    /**
     *
     */
    protected function createSubquestionVF($typology, $question, $amorce, $media)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager('default');

        // Création du questionnaire
        $subquestion = new Subquestion();

        $typo = $em->getRepository('InnovaSelfBundle:Typology')->findOneByName($typology);
        $subquestion->setTypology($typo);

        $subquestion->setQuestion($question);

        if ($amorce != '') {
            $subquestion->setMediaAmorce($this->mediaText("", $amorce, ""));
        }
        if ($media != '') {
            $subquestion->setMedia($this->mediaText("", $media, ""));
        }

        $em->persist($subquestion);

        return $subquestion;
    }

    /**
     *
     */
    protected function createProposition($text, $rightAnswer, Subquestion $subquestion)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager('default');

        $proposition = new Proposition();

        $proposition->setSubquestion($subquestion);
        $proposition->setMedia($this->mediaText("", $text, ""));
        $proposition->setRightAnswer($rightAnswer);

        $em->persist($proposition);

        return $proposition;
    }


    /**
     *createPropositionVF()
     */
    protected function createPropositionVF($text, $textAnswer, $rightAnswer, Subquestion $subquestion)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager('default');

        $proposition = new Proposition();

        $proposition->setSubquestion($subquestion);
        $proposition->setMedia($this->mediaText("", $textAnswer, ""));
        $proposition->setRightAnswer($rightAnswer);

        $em->persist($proposition);

        return $proposition;
    }

    /**
     *
     */
    protected function mediaText($title, $name, $type)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager('default');

        // TODO : l'appel à la fonction qui traite le markdown !!
        // Création dans "Media"
        $media = new Media();

        if ($type != "") {
            $media->setMediaType($em->getRepository('InnovaSelfBundle:MediaType')->findOneByName("image"));
            $media->setUrl($name.".jpg");
        }
        else
        {
            $media->setMediaType($em->getRepository('InnovaSelfBundle:MediaType')->findOneByName("texte"));
            $media->setUrl(NULL);
        }

        $media->setName($this->textSource($title.$name));
        $media->setDescription($this->textSource($title.$name)); // Ajout ERV 03/03/2014 car c'est la description que l'on affiche dans la macro.texte

        $em->persist($media);

        return $media;
    }

    /**
     * textSource function
     *
     */
    private function textSource($textSource)
    {

        // Règles :
        // *** pour un texte italique
        // $$$ pour un texte souligné
        // @@@ pour aller à la ligne
        //
        //
        // For more explications : http://www.php.net/manual/fr/reference.pcre.pattern.modifiers.php
        // echo "<br /><br />Texte AVANT = " . $textSource;
        //$rule = '($$$).*?($$$)';
        //$final = '<i>.*?</i>';

        $textDisplay = preg_replace('/\*{3}(.*?)\*{3}/s', '<i>$1</i>', $textSource);
        // echo "<br /><br />Texte APRES = " . $textDisplay;

        // echo "<br /><br />Texte AVANT = " . $textSource;
        $textDisplay = preg_replace('/\${3}(.*?)\${3}/s', '<u>$1</u>', $textDisplay);
        //$textDisplay = preg_replace('/***(.*?)***/s', '<i>$1</i>', $textSource); // Texte italique

        $textDisplay = str_replace('@@@', '<br>', $textDisplay); // Saut de ligne

        // echo "<br /><br />Texte APRES = " . $textDisplay;

        return $textDisplay;
    }

}