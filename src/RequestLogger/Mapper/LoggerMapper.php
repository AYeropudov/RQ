<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 15.07.16
 * Time: 15:25
 */

namespace RequestLogger\Mapper;


use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\Common\Persistence\ObjectRepository;
use RequestLogger\Document\RequestLog;

class LoggerMapper implements LoggerMapperInterface
{
    /**\
     * @var DocumentManager;
     */


    protected $documentManager;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    protected $repository;

    public function __construct(ObjectManager $documentManager, ObjectRepository $repository)
    {
        $this->documentManager = $documentManager;
        $this->repository = $repository;
    }


    /**
     * @param $id
     *
     * @return object
     */
    public function find($id)
    {
        // TODO: Implement find() method.
       return $this->repository->find($id);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        // TODO: Implement findAll() method.
        return $this->repository->findAll();
    }

    /**
     * @param \RequestLogger\Document\RequestLog $log
     */
    public function save(RequestLog $log)
    {
        // TODO: Implement save() method.
        $this->documentManager->persist($log);
        $this->documentManager->flush();
    }

    /**
     * @param array $options
     * @param array $sorts
     * @param array $limits
     *
     * @return mixed
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function query(array $options, array $sorts=[], array $limits=[])
    {
        $logModel = new RequestLog();
        $qb = $this->documentManager->createQueryBuilder(get_class($logModel));
        $qbC = $this->documentManager->createQueryBuilder(get_class($logModel));
        $qbC->count();
        foreach ($options as $option) {
          $qb->field($option['field'])->$option['exp']($option['val']);
          $qbC->field($option['field'])->$option['exp']($option['val']);
        }
        foreach ($sorts as $sort)
        {
            $qb->$sort['exp']($sort['field'],$sort['val']);
        }

        foreach($limits as $key => $value)
        {
            $qb->$key($value);
        }
        return ['logs'=>$qb->getQuery()->execute(),'count'=>$qbC->getQuery()->execute()];
        // TODO: Implement query() method.

    }

}