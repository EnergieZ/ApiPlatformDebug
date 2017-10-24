<?php

namespace Xxx\ClientBundle\Doctrine\ORM\Extension;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Xxx\ClientBundle\Entity\Bill;
use Xxx\ClientBundle\Entity\Contract;
use Xxx\ClientBundle\Entity\Favorite;
use Xxx\ClientBundle\Entity\InterventionReport;
use Xxx\ClientBundle\Entity\Project;
use Xxx\ClientBundle\Entity\Quotation;
use Xxx\ClientBundle\Entity\RaisingMoney;
use Xxx\ClientBundle\Entity\Ticket;
use Xxx\ClientBundle\Entity\TicketAnswer;
use Xxx\ClientBundle\Entity\User;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

final class ControllUserCollectionExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{
    private $tokenStorage;
    private $authorizationChecker;

    public function __construct(TokenStorageInterface $tokenStorage, AuthorizationChecker $checker)
    {
        $this->tokenStorage = $tokenStorage;
        $this->authorizationChecker = $checker;
    }

    /**
     * {@inheritdoc}
     */
    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    /**
     * {@inheritdoc}
     */
    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, string $operationName = null, array $context = [])
    {
        //nothing
    }

    /**
     *
     * @param QueryBuilder $queryBuilder
     * @param string       $resourceClass
     */
    private function addWhere(QueryBuilder $queryBuilder, string $resourceClass)
    {
        $user = $this->tokenStorage->getToken()->getUser();
        if (Ticket::class === $resourceClass && $user instanceof User && !$this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $rootAlias = $queryBuilder->getRootAliases()[0];
            $queryBuilder->leftJoin(sprintf('%s.project', $rootAlias), 'p');
            $queryBuilder->andWhere('p.customer = :current_user');
            $queryBuilder->setParameter('current_user', $user->getId());
        }
        else if (TicketAnswer::class === $resourceClass && $user instanceof User && !$this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $rootAlias = $queryBuilder->getRootAliases()[0];
            $queryBuilder->leftJoin(sprintf('%s.ticket', $rootAlias), 't');
            $queryBuilder->leftJoin('t.project', 'p');
            $queryBuilder->andWhere('p.customer = :current_user');
            $queryBuilder->setParameter('current_user', $user->getId());
        }
        else if (Bill::class === $resourceClass && $user instanceof User && !$this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $rootAlias = $queryBuilder->getRootAliases()[0];
            $queryBuilder->leftJoin(sprintf('%s.project', $rootAlias), 'p');
            $queryBuilder->andWhere('p.customer = :current_user');
            $queryBuilder->setParameter('current_user', $user->getId());
        }
        else if (RaisingMoney::class === $resourceClass && $user instanceof User && !$this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $rootAlias = $queryBuilder->getRootAliases()[0];
            $queryBuilder->leftJoin(sprintf('%s.project', $rootAlias), 'p');
            $queryBuilder->andWhere('p.customer = :current_user');
            $queryBuilder->setParameter('current_user', $user->getId());
        }
        else if (Quotation::class === $resourceClass && $user instanceof User && !$this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $rootAlias = $queryBuilder->getRootAliases()[0];
            $queryBuilder->leftJoin(sprintf('%s.project', $rootAlias), 'p');
            $queryBuilder->andWhere('p.customer = :current_user');
            $queryBuilder->setParameter('current_user', $user->getId());
        }
        else if (InterventionReport::class === $resourceClass && $user instanceof User && !$this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $rootAlias = $queryBuilder->getRootAliases()[0];
            $queryBuilder->leftJoin(sprintf('%s.project', $rootAlias), 'p');
            $queryBuilder->andWhere('p.customer = :current_user');
            $queryBuilder->setParameter('current_user', $user->getId());
        }
        else if (Contract::class === $resourceClass && $user instanceof User && !$this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $rootAlias = $queryBuilder->getRootAliases()[0];
            $queryBuilder->leftJoin(sprintf('%s.project', $rootAlias), 'p');
            $queryBuilder->andWhere('p.customer = :current_user');
            $queryBuilder->setParameter('current_user', $user->getId());
        }
        else if (Project::class === $resourceClass && $user instanceof User && !$this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $rootAlias = $queryBuilder->getRootAliases()[0];
            $queryBuilder->andWhere(sprintf('%s.customer = :current_user', $rootAlias));
            $queryBuilder->setParameter('current_user', $user->getId());
        }
        else if (Favorite::class === $resourceClass && $user instanceof User && !$this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $rootAlias = $queryBuilder->getRootAliases()[0];
            $queryBuilder->andWhere(sprintf('%s.user = :current_user', $rootAlias));
            $queryBuilder->setParameter('current_user', $user->getId());
        }
        else if (Configuration::class === $resourceClass && $user instanceof User && !$this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $rootAlias = $queryBuilder->getRootAliases()[0];
            $queryBuilder->andWhere(sprintf('%s.user = :current_user', $rootAlias));
            $queryBuilder->setParameter('current_user', $user->getId());
        }
        else if (File::class === $resourceClass && $user instanceof User && !$this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $rootAlias = $queryBuilder->getRootAliases()[0];
            $queryBuilder->andWhere(sprintf('%s.user = :current_user', $rootAlias));
            $queryBuilder->setParameter('current_user', $user->getId());
        }
        else if (Child::class === $resourceClass && $user instanceof User && !$this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $rootAlias = $queryBuilder->getRootAliases()[0];
            $queryBuilder->andWhere(sprintf('%s.user = :current_user', $rootAlias));
            $queryBuilder->setParameter('current_user', $user->getId());
        }
    }
}
