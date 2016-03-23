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
        $result = $this->_getDummyCards();

        $response = new JsonResponse();
        $response->setData($result);

        return $response;
    }

    private function _getDummyCards()
    {
        $result = array();
        $cardsQty = rand(10, 30);
        $taskId = 0;
        for ($i = 0; $i < $cardsQty; $i++) {
            $card = array(
                "id" => $i,
                "title" => "Write some code",
                "description" => "Code along with the samples in this book. The complete source can be found at [github](https://github.com/pro-react)",
                "status" => $this->_getColumn(),
                "color" => "#3A7E28",
                "tasks" => array()
            );

            $task = array(
                "id" => ++$taskId,
                "name" => "Contact list example",
                "done" => true
            );

            array_push($card["tasks"], $task);

            $task = array(
                "id" => ++$taskId,
                "name" => "Kanban example",
                "done" => false
            );

            array_push($card["tasks"], $task);

            $task = array(
                "id" => ++$taskId,
                "name" => "My own experiments",
                "done" => false
            );

            array_push($card["tasks"], $task);

            array_push($result, $card);
        }

        return $result;
    }

    private function _getColumn()
    {
        $columns = array("todo", "in-progress", "done");
        $index = rand(0, 2);
        return $columns[$index];
    }
}
