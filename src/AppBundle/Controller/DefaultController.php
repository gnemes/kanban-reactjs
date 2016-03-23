<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('kanban/index.html', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }

    /**
     * @Route("/cards", name="cards")
     */
    public function cardsAction(Request $request)
    {
        $result = array();

        $card = array(
            "id" => 1,
            "title" => "Read a book",
            "description" => "I should read the **whole** book",
            "status" => $this->_getColumn(),
            "color" => "#BD8D31",
            "tasks" => array()
        );

        array_push($result, $card);

        $card = array(
            "id" => 2,
            "title" => "Write some code",
            "description" => "Code along with the samples in this book. The complete source can be found at [github](https://github.com/pro-react)",
            "status" => $this->_getColumn(),
            "color" => "#3A7E28",
            "tasks" => array()
        );

        $task = array(
            "id" => 1,
            "name" => "Contact list example",
            "done" => true
        );

        array_push($card["tasks"], $task);

        $task = array(
            "id" => 2,
            "name" => "Kanban example",
            "done" => false
        );

        array_push($card["tasks"], $task);

        $task = array(
            "id" => 3,
            "name" => "My own experiments",
            "done" => false
        );

        array_push($card["tasks"], $task);

        array_push($result, $card);

        $response = new JsonResponse();
        $response->setData($result);

        return $response;
    }

    private function _getColumn()
    {
        $columns = array("todo", "in-progress", "done");
        $index = rand(2);
        return $columns[$index];
    }
}
