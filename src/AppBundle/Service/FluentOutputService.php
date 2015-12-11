<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2015/12/11
 * Time: 17:52
 */

namespace AppBundle\Service;


use AppBundle\Entity\Article;
use Doctrine\ORM\EntityManager;
use Fluent\Logger\FluentLogger;
use Symfony\Component\Serializer\Serializer;

class FluentOutputService
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var FluentLogger
     */
    private $fluentLogger;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * FluentOutputService constructor.
     * @param EntityManager $entityManager
     * @param FluentLogger $fluentLogger
     * @param Serializer $serializer
     */
    public function __construct(
        EntityManager $entityManager,
        FluentLogger $fluentLogger,
        Serializer $serializer
    )
    {
        $this->entityManager = $entityManager;
        $this->fluentLogger = $fluentLogger;
        $this->serializer = $serializer;
    }

    public function save(Article $article)
    {
        $metadata = $this->entityManager->getClassMetadata(get_class($article));
        $type = "app.".$metadata->getTableName();
        $this->fluentLogger->post($type, array_filter($this->serializer->normalize($article),function($idx){
            if ($idx == 'id') {
                return false;
            }
            return true;
        },ARRAY_FILTER_USE_KEY));
    }

}