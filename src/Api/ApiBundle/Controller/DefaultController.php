<?php

namespace Api\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller
{
    /**
     * @Route("/API/cards", name="cards")
     * @Method({"GET"})
     */
    public function cardsAction(Request $request)
    {
        $result = $this->_getDummyCards();

        $response = new JsonResponse();
        $response->setData($result);

        return $response;
    }

    /**
     * @Route("/API/cards/{cardId}/tasks/{taskId}", name="task_delete")
     * @Method({"DELETE"})
     */
    public function taskDeleteAction($cardId, $taskId, Request $request)
    {
        $result = array();

        $response = new JsonResponse();
        $response->setData($result);

        return $response;
    }

    /**
     * @Route("/API/cards/{cardId}/tasks", name="task_add")
     * @Method({"POST"})
     */
    public function taskAddAction($cardId, Request $request)
    {
        $result = array();

        $response = new JsonResponse();
        $response->setData($result);

        return $response;
    }

    /**
     * @Route("/API/cards/{cardId}/tasks/{taskId}", name="task_toggle")
     * @Method({"PUT"})
     */
    public function taskToggleAction($cardId, $taskId, Request $request)
    {
        $result = array();

        $response = new JsonResponse();
        $response->setData($result);

        return $response;
    }

    /****************** PRIVATE METHODS *******************/

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
