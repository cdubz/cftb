<?php

namespace App\Controller;

use App\Service\APIConsumer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ToteBoardController extends AbstractController
{
    /**
     * @Route("/board", name="board")
     */
    public function board(APIConsumer $apiConsumer)
    {
        $apiConsumer->update();
        return $this->render('tote_board/index.html.twig', [
            'controller_name' => 'ToteBoardController',
        ]);
    }
}
