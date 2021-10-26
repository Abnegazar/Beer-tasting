<?php

    class TastingController extends BaseController implements Controller{
        
        const viewDirectory = 'tastings/';

        public function getAllTastings(){
            $view = "tastings.phtml";
            $tastings = Tasting::getAllTastings();

            var_dump($tastings);
            exit;
            
            $content = App::get_content(
                self::viewDirectory.$view,
                array(
                    'tastings' => $tastings
                )
            );
            return $content;
        }

        public function getSometastings($limit){
            $view = "tastings.phtml";
            $tastings = Tasting::getSometastings($limit);

            $content = App::get_content(
                self::viewDirectory.$view,
                array('tastings' => $tastings)
            );

            return $content;
        }

        public function getUserTastings($id){
            $view = "tastings.phtml";
            $tastings = Tasting::getUserTastings($id);

            $content = App::get_content(
                self::viewDirectory . $view,
                array('tastings' => $tastings)
            );

            return $content;
        }

        public function render()
        {
            $content = false;
            $operation = $_GET['operation'];
            switch ($operation) {
                case 'getAll':
                    $content = $this->getAllTastings();
                    break;
                default:
                    break;
            }
            return $content;
        }
    }

?>