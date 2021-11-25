<?php

class TastingController extends BaseController implements Controller
{

    const viewDirectory = 'tastings/';

    public function getAllTastings()
    {

        $view = "tastings.phtml";

        $limit = DEFAULT_PAGINATION;

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $offset = ($page - 1) * $limit;

        $tastings = Tasting::getAllTastings($offset, $limit);

        $content = App::get_content(
            self::viewDirectory . $view,
            array(
                'tastings' => $tastings
            )
        );
        return $content;
    }


    public function getUserTastings($userId)
    {
        $view = "tastings.phtml";

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $limit = DEFAULT_PAGINATION;

        $offset = ($page - 1) * $limit;

        $tastings = Tasting::getUserTastings($userId, $offset, $limit);

        $content = App::get_content(
            self::viewDirectory . $view,
            array('tastings' => $tastings)
        );
        return $content;
    }

    public function getTastingById($id)
    {
        $view = "tastings.phtml";

        $tastings = Tasting::getTastingById($id);

        $content = App::get_content(
            self::viewDirectory . $view,
            array('tastings' => $tastings)
        );
        return $content;
    }

    public function addNew()
    {
        $view = 'addtasting.phtml';
        $errors = [];
        $success = false;
        if (!empty($_POST)) {
            //sélection de la bière dégustée
            if (!isset($_POST['beerId'])) {
                $errors[] = 'Aucune Bière n\'a été sélectionnée.';
            }

            //nom de la bière
            if (!isset($_POST['beerName']) || empty($_POST['beerName'])) {
                $errors[] = 'Le nom de la bière est obligatoire.';
            }

            //score donné à l'arôme
            if (!isset($_POST['aromaSore']) || empty($_POST['aromaScore'])) {
                $errors[] = 'Le score donné à l\'arôme est obligatoire.';
            } else if (!preg_match($_POST['aromaScore'], PATERN_TWO_DECIMAL_DIGIT_NUMBER)) {
                $errors[] = PATERN_TWO_DECIMAL_DIGIT_NUMBER_EXPL;
            } else if ((tasting::getFloat($_POST['aromaScore'])) > 10) {
                $errors[] = 'Le score donné à l\'arôme doit être inférieur ou égal à 10';
            }

            //score donné à l'apparance
            if (!isset($_POST['appearanceScore']) || empty($_POST['appearanceScore'])) {
                $errors[] = 'Le score donné à l\'apparance est obligatoire.';
            } else if (!preg_match($_POST['appearanceScore'], PATERN_TWO_DECIMAL_DIGIT_NUMBER)) {
                $errors[] = PATERN_TWO_DECIMAL_DIGIT_NUMBER_EXPL;
            } else if ((tasting::getFloat($_POST['appearanceScore'])) > 10) {
                $errors[] = 'Le score donné à l\'apparance doit être inférieur ou égal à 10';
            }

            //score donné à la saveur
            if (!isset($_POST['flavorScore']) || empty($_POST['flavorScore'])) {
                $errors[] = 'Le score donné à la saveur est obligatoire.';
            } else if (!preg_match($_POST['flavorScore'], PATERN_TWO_DECIMAL_DIGIT_NUMBER)) {
                $errors[] = PATERN_TWO_DECIMAL_DIGIT_NUMBER_EXPL;
            } else if ((tasting::getFloat($_POST['flavorScore'])) > 10) {
                $errors[] = 'Le score donné à lla saveur doit être inférieur ou égal à 10';
            }

            //score donné à la sensation en bouche
            if (!isset($_POST['mouthfeelScore']) || empty($_POST['mouthfeelScore'])) {
                $errors[] = 'Le score donné à la sensation en bouche est obligatoire.';
            } else if (!preg_match($_POST['mouthfeelScore'], PATERN_TWO_DECIMAL_DIGIT_NUMBER)) {
                $errors[] = PATERN_TWO_DECIMAL_DIGIT_NUMBER_EXPL;
            } else if ((tasting::getFloat($_POST['mouthfeelScore'])) > 10) {
                $errors[] = 'Le score donné à la sensation en bouche doit être inférieur ou égal à 10';
            }

            //score général
            if (!isset($_POST['overallScore']) || empty($_POST['overallScore'])) {
                $errors[] = 'Le score donné à la bière en général est obligatoire.';
            } else if (!preg_match($_POST['overallScore'], PATERN_TWO_DECIMAL_DIGIT_NUMBER)) {
                $errors[] = PATERN_TWO_DECIMAL_DIGIT_NUMBER_EXPL;
            } else if ((tasting::getFloat($_POST['overallScore'])) > 10) {
                $errors[] = 'Le score donné à la bière en général doit être inférieur ou égal à 10';
            }

            //Précision stylistique
            if (!isset($_POST['stylisticAccuracy']) || empty($_POST['stylisticAccuracy'])) {
                $errors[] = 'La précision stylistique est obligatoire.';
            } else if (!preg_match($_POST['stylisticAccuracy'], PATERN_ONE_DIGIT_BETWEEN_1_AND_5)) {
                $errors[] = PATERN_ONE_DIGIT_BETWEEN_1_AND_5_EXPL;
            }

            //Intangibilité
            if (!isset($_POST['intangibles']) || empty($_POST['intangibles'])) {
                $errors[] = 'L\'intangibilité est obligatoire.';
            } else if (!preg_match($_POST['intangibles'], PATERN_ONE_DIGIT_BETWEEN_1_AND_5)) {
                $errors[] = PATERN_ONE_DIGIT_BETWEEN_1_AND_5_EXPL;
            }

            //Mérite thechinique
            if (!isset($_POST['technicalMerit']) || empty($_POST['technicalMerit'])) {
                $errors[] = 'Le mérite thechinique est obligatoire.';
            } else if (!preg_match($_POST['technicalMerit'], PATERN_ONE_DIGIT_BETWEEN_1_AND_5)) {
                $errors[] = PATERN_ONE_DIGIT_BETWEEN_1_AND_5_EXPL;
            }

            if (empty($errors)) {

                $userId = Session::getConnectedUser()->id;
                $beerId = $_POST['beer'];
                $beerName = Tasting::clearComments($_POST['beerName']);
                $title = $_POST['title'];
                $aromaComment = Tasting::clearComments($_POST['aromaComment']);
                $appearanceComment = Tasting::clearComments($_POST['appearanceComment']);
                $flavorComment = Tasting::clearComments($_POST['flavorComment']);
                $mouthfeelComment = Tasting::clearComments($_POST['mouthfeelComment']);
                $overallComment = Tasting::clearComments($_POST['overallComment']);
                $aromaScore = tasting::getFloat($_POST['aromaScore']);
                $appearanceScore = tasting::getFloat($_POST['appearanceScore']);
                $flavorScore = tasting::getFloat($_POST['flavorScore']);
                $mouthfeelScore = tasting::getFloat($_POST['mouthfeelScore']);
                $overallScore = tasting::getFloat($_POST['overallScore']);
                $total = Tasting::calculateTotal($aromaScore, $appearanceScore, $flavorScore, $mouthfeelScore, $overallScore);
                $isAcetaldehyde = $_POST['isAcetaldehyde'];
                $isAlcoholic = $_POST['isAlcoholic'];
                $isAstringent = $_POST['isAstringent'];
                $isDiacetyl = $_POST['isDiacetyl'];
                $isDms = $_POST['isDms'];
                $isEstery = $_POST['isEstery'];
                $isGrassy = $_POST['isGrassy'];
                $isLightStruck = $_POST['isLightStruck'];
                $isMetallic = $_POST['isMetallic'];
                $isMusty = $_POST['isMusty'];
                $isOxidized = $_POST['isOxidized'];
                $isPhenolic = $_POST['isPhenolic'];
                $isSolvent = $_POST['isSolvent'];
                $isAcidic = $_POST['isAcidic'];
                $isSulfur = $_POST['isSulfur'];
                $isVegetal = $_POST['isVegetal'];
                $isBottleOk = $_POST['isBottleOk'];
                $isYeasty = $_POST['isYeasty'];

                $stylisticAccuracy = $_POST['isYeasty'];
                $intangibles = $_POST['intangibles'];
                $technicalMerit = $_POST['technicalMerit'];

                $tasting = new Tasting();
                $tasting->initValue(
                    $id = false,
                    $userId,
                    $beerId,
                    $beerName,
                    $title,
                    $aromaComment,
                    $appearanceComment,
                    $flavorComment,
                    $mouthfeelComment,
                    $overallComment,
                    $aromaScore,
                    $appearanceScore,
                    $flavorScore,
                    $mouthfeelScore,
                    $overallScore,
                    $total,
                    $isAcetaldehyde,
                    $isAlcoholic,
                    $isAstringent,
                    $isDiacetyl,
                    $isDms,
                    $isEstery,
                    $isGrassy,
                    $isLightStruck,
                    $isMetallic,
                    $isMusty,
                    $isOxidized,
                    $isPhenolic,
                    $isSolvent,
                    $isAcidic,
                    $isSulfur,
                    $isVegetal,
                    $isBottleOk,
                    $isYeasty,
                    $stylisticAccuracy,
                    $intangibles,
                    $technicalMerit
                );
                if ($tasting->save()) {
                    $success = "La dégustation a été enregistré avec succès.";
                } else {
                    $errors[] = "Une erreur s'est produite lors de l'ajout de cette dégustation.";
                }
            }
        }
        $content = App::get_content(
            self::viewDirectory . $view,
            array(
                'errors'             => $errors,
                'success'            => $success
            )
        );
        return $content;
    }

    public function render()
    {
        $content = false;
        $operation = $_GET['operation'];
        switch ($operation) {
            case 'getAllTastings':
                $content = $this->getAllTastings();
                break;
            case 'getUserTastings':
                $content = $this->getUserTastings($_GET['userId']);
                break;
            case 'getTastingById':
                $content = $this->getTastingById($_GET['id']);
                break;
            case 'addTasting':
                $content = $this->addNew();
                break;
            default:
                break;
        }
        return $content;
    }
}
