<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Episode;
use \Doctrine\ORM\EntityRepository;

/**
 * EpisodeRepository
 *
 * Queries for the Episode object
 */
class EpisodeRepository extends EntityRepository
{
    /**
     * Find an Episode by its number
     *
     * @param String $epNum episode to find in format X.X or X
     * @return Episode episode found
     */
    public function findEpisodeByNumber(String $epNum) {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->findOneBy(array('number' => $epNum));
    }

    /**
     * @param int $page 1 indexed page
     * @param int $limit integer greater than 1
     * @return Episode[] episodes in the given span
     */
    public function getEpisodesByPage(int $page, int $limit)
    {
        //return episodes sorted by descending episode number
        //where max records = limit
        //Starting with record limit*(page-1)
        $query = $this->createQueryBuilder('ep')
            ->setMaxResults($limit)
            ->setFirstResult($limit * ($page - 1))
            ->orderBy('ep.number', 'DESC')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @param bool $ascending true for ascending sort, else descending sort
     * @return \AppBundle\Entity\Episode[] Every episode sorted by number
     */
    public function allEpisodes(bool $ascending = false) {
        if($ascending) {
            $sort = 'ASC';
        } else {
            $sort = 'DESC';
        }

        $query = $this->createQueryBuilder('ep')
            ->orderBy('ep.number', $sort)
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @return Episode
     */
    public function getMostRecentEpisode() {
        return $this->getEpisodesByPage(1,1)[0];
    }
}
