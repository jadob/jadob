<?php
declare(strict_types=1);

namespace Jadob\Dashboard\ObjectManager;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Jadob\Dashboard\Exception\DashboardException;

class DoctrineOrmObjectManager
{

    protected EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function getPagesCount(string $objectFqcn, int $resultsPerPage): int
    {
        $objectsCountQuery = $this->em->createQueryBuilder()
            ->from($objectFqcn, 'obj')
            ->select('COUNT(obj) as count')
            ->getQuery()
            ->getOneOrNullResult();

        $objectsCount = $objectsCountQuery['count'] ?? 0;

        return (int)ceil(($objectsCount / $resultsPerPage));
    }

    public function read(string $objectFqcn, int $pageNumber, int $resultsPerPage)
    {
        return $this
            ->em
            ->getRepository($objectFqcn)
            ->findBy(
                [],
                null,
                $resultsPerPage,
                (($pageNumber - 1) * $resultsPerPage)
            );

    }

    public function persist(object $object): void
    {
        $this->em->persist($object);
        $this->em->flush();
    }

    /**
     * @psalm-param class-string $objectFqcn
     * @param string $objectFqcn
     * @param string|int $objectId
     * @return object
     * @throws DashboardException
     */
    public function getOneById(string $objectFqcn, $objectId): object
    {
        $object = $this->em->find($objectFqcn, $objectId);

        if ($object === null) {
            throw new DashboardException(
                sprintf(
                    'Could not find object "%s" with ID "%s"',
                    $objectFqcn,
                    $objectId
                )
            );
        }

        return $object;
    }

    public function getObjectRepository(string $objectFqcn): \Doctrine\Persistence\ObjectRepository
    {
        return $this->em->getRepository($objectFqcn);
    }
}