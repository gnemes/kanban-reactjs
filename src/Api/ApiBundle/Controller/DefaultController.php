<?php

namespace Api\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

// Entities
use Api\ApiBundle\Entity\Cards;
use Api\ApiBundle\Entity\Tasks;

class DefaultController extends Controller
{
    /**
     * @Route("/API/cards", name="cards")
     * @Method({"GET"})
     */
    public function cardsAction(Request $request)
    {
        $logger = $this->get('logger');

        $cards = $this->getDoctrine()
            ->getRepository('ApiBundle:Cards')
            ->findAll();


        $result = array();
        if ($cards) {
            foreach ($cards as $card) {
                $elem = array();
                $elem['id'] = $card->getId();
                $elem['title'] = $card->getTitle();
                $elem['description'] = $card->getDescription();
                $elem['color'] = $card->getColor();
                $elem['status'] = $card->getStatus();

                $elem['tasks'] = array();
                $tasks = $card->getTasks();

                if ($tasks) {
                    foreach ($tasks as $task) {
                        $elemTask = array();
                        $elemTask['id'] = $task->getId();
                        $elemTask['name'] = $task->getName();
                        $elemTask['done'] = $task->getDone();
                        array_push($elem['tasks'], $elemTask);
                    }
                }


                array_push($result, $elem);
            }
        }

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
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository('ApiBundle:Tasks')->findOneBy(
            array('id' => $taskId, 'cardid' => $cardId)
        );

        if (!$task) {
            throw $this->createNotFoundException(
                'No task found for id '
            );
        }

        $em->remove($task);
        $em->flush();

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
        $logger = $this->get('logger');
        $content = $request->getContent();
        if (!empty($content))
        {
            $params = json_decode($content, true);
        }

        $em = $this->getDoctrine()->getManager();
        $card = $em->getRepository('ApiBundle:Cards')->find($cardId);

        if (!$card) {
            $logger->error("Card not found");
            throw $this->createNotFoundException(
                'No card found for id '
            );
        }

        $task = new Tasks();
        $task->setName($params['name']);
        $task->setDone($params['done']);
        $task->setCardid($card);

        $em->persist($task);

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
        $logger = $this->get('logger');
        $content = $request->getContent();
        if (!empty($content))
        {
            $params = json_decode($content, true);
        }

        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository('ApiBundle:Tasks')->findOneBy(
            array('id' => $taskId, 'cardid' => $cardId)
        );

        if (!$task) {
            throw $this->createNotFoundException(
                'No task found for id '
            );
        }

        $task->setDone($params['done']);
        $em->flush();

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
