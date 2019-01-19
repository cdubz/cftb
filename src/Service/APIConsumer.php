<?php

namespace App\Service;
use App\Entity\Race;
use App\Entity\RaceDay;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class APIConsumer
 *
 * @package App\Service
 */
class APIConsumer
{
    /**
     * The base URL for the API to use (see env).
     *
     * @var string
     */
    private $apiBaseUrl;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->apiBaseUrl = getenv('API_BASE_URL');
        if (empty($this->apiBaseUrl)) {
            throw new \RuntimeException('Missing API URL base configuration.');
        }
    }

    public function update()
    {
        $raceDayRepository = $this->entityManager->getRepository(RaceDay::class);
        $response = file_get_contents($this->apiBaseUrl . 'tracks/TRK/race-days.json');
        if ($response) {
            $data = json_decode($response);
            foreach ($data as $datum) {
                $date = new \DateTime($datum->Date);

                /** @var \App\Entity\RaceDay $raceDay */
                $raceDay = $raceDayRepository->findOneBy(['date' => $date]);
                if ($raceDay) {
                    self::updateRaceDay($raceDay, $datum);
                }
                else {
                    self::createRaceDay($datum);
                }
            }
            $this->entityManager->flush();
        }

        return TRUE;
    }

    /**
     * Create a new RaceDay entity.
     *
     * @param object $race_day_data
     */
    private function createRaceDay($race_day_data) {
        $date = new \DateTime($race_day_data->Date);
        $raceDay = new RaceDay();
        $raceDay->setDate($date);
        $this->entityManager->persist($raceDay);

        // Add child Race entities.
        for ($i = 1; $i <= $race_day_data->NumRaces; $i++) {
            $response = file_get_contents($this->apiBaseUrl
                . 'tracks/TRK/race-days/'
                . $race_day_data->Date . '/races/' . $i . '.json');
            if ($response) {
                $data = json_decode($response);
                $race = new Race();
                $race->setRaceDay($raceDay);
                $race->setDate($date);
                $race->setNumber($data->Number);
                $race->setSurface($data->Surface);
                $race->setTrackCondition($data->TrackCondition);
                $race->setUpdated(\DateTime::createFromFormat('Y-m-d\TH:i:s.u???P', $data->LastUpdatedAt));
                $this->entityManager->persist($race);
            }
        }
    }

    /**
     * Update an existing RaceDay entity.
     *
     * @param RaceDay $raceDay
     * @param $api_data
     */
    private function updateRaceDay(RaceDay $raceDay, $api_data) {
        /* @TODO */
    }
}