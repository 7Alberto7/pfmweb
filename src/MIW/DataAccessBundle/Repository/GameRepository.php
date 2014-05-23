<?php

namespace MIW\DataAccessBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * GameRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GameRepository extends DocumentRepository
{
    public function findUserGames($user)
    {
        return $this->createQueryBuilder()
            ->field('admin.id')->equals($user->getId())
            ->sort('created', 'desc')
            ->getQuery()
            ->execute();
    }
    
    public function findSignupGames($user)
    {
        return $this->createQueryBuilder()
            ->field('players.$id')->equals(new \MongoId($user->getId()))
            ->getQuery()
            ->execute();
    }
    
    public function findPlayedGames($user)
    {
        $now=new \DateTime('now');
        return $this->createQueryBuilder()
            ->field('players.$id')->equals(new \MongoId($user->getId()))
            ->field('gameDate')->lte($now)
            ->getQuery()
            ->execute();
    }
    
    public function findPlayingGames($user)
    {
        $now=new \DateTime('now');
        return $this->createQueryBuilder()
            ->field('players.$id')->equals(new \MongoId($user->getId()))
            ->field('gameDate')->gte($now)
            ->getQuery()
            ->execute();
    }
    
    public function findAllBetweenDates($initDate, $endDate, $idUser)
    {
        return $this->createQueryBuilder()
            ->field('gameDate')->range($initDate, $endDate)
            ->field('admin.id')->notEqual($idUser)
            ->sort('gameDate', 'asc')
            ->getQuery()
            ->execute();
    }  
    
    public function findAllByCenterAndSports($center,$sports)
    {
        $now=new \DateTime('now');
        $qb= $this->createQueryBuilder()
                ->field('center.id')->equals($center->getId())
                ->field('gameDate')->gte($now);
        
        if(count($sports) > 0) {
            $qb->field('sport.id')->in($sports);
        }

        return $qb->getQuery()->execute();
    }  
    
}
