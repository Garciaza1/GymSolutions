<?php
namespace GymSolution\Controllers;

use GymSolution\Controllers\BaseController;
use GymSolution\Models\Main as ModelsMain;

class App extends BaseController
{

    
    public function calculos(){
        

        $data['user'] = $_SESSION['user'];

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('calculos', $data);
        $this->view('shared/html_footer');


    }


/*

    public function planner(){

        $data = $_SESSION['user'];
    }

    public function planner_form(){

        $data = $_SESSION['user'];

    }

    public function planner_submit(){

        $data = $_SESSION['user'];

    }


    
    public function estatisticas(){

        $data = $_SESSION['user'];

    }

    public function estatisticas_form(){

        $data = $_SESSION['user'];

    }

    public function estatisticas_submit(){

        $data = $_SESSION['user'];

    }
    */
}