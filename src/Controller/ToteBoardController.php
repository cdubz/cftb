<?php

namespace App\Controller;

use App\Entity\RaceEntry;
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
     * @Route(
     *     "/board/{race_date}/{race_number}",
     *     name="board",
     *     defaults={"race_date"=null, "race_number"=1}
     * )
     */
    public function board($race_date, $race_number, Request $request, RaceDayRepository $raceDayRepository, APIConsumer $apiConsumer)
    {
        $apiConsumer->update();

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
        elseif ($race_date) {
            $RaceDay = $raceDayRepository->findByDate(new \DateTime($race_date));
        }
        else {
            $RaceDay = $raceDayRepository->findMostRecent();
        }
        $Race = $RaceDay->getRaceByNumber($race_number);

        $entries = [
            'scratched' => $Race->getScratchedEntries(),
            'also_ran' => $Race->getAlsoRanEntries(),
            'finished' => $Race->getFinishedEntries(3),
        ];


        return $this->render('race.html.twig', [
            'form' => $form->createView(),
            'race_day' => $RaceDay,
            'race' => $Race,
            'entries' => $entries,
        ]);
    }
}
