<?php

namespace App\Controller;

use App\Repository\RaceDayRepository;
use App\Service\APIConsumer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ToteBoardController extends AbstractController
{
    /**
     * @Route("/board", name="board")
     */
    public function board(Request $request, RaceDayRepository $raceDayRepository, APIConsumer $apiConsumer)
    {
        $RaceDays = $raceDayRepository->findAll();

        $race_choices = [];
        foreach ($RaceDays as $RaceDay) {
            $race_choices[$RaceDay->getDate()->format('Y-m-d')] = $RaceDay->getId();
        }
        $form = $this->createFormBuilder()
            ->add('id', ChoiceType::class, ['choices' => $race_choices])
            ->add('save', SubmitType::class, ['label' => 'Load'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $RaceDay = $raceDayRepository->find($data['id']);
        }
        else {
            $RaceDay = $raceDayRepository->findMostRecent();
        }

        return $this->render('tote_board/index.html.twig', [
            'form' => $form->createView(),
            'race_day' => $RaceDay,
        ]);
    }
}
