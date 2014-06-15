<?php

namespace FDevs\ArticleBundle\EventListener;

use Doctrine\Common\Cache\CacheProvider;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use FDevs\ArticleBundle\Model\Article;
use FDevs\UserBundle\Document\User;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class CachedResponse
{

    /** @var \Doctrine\Common\Cache\CacheProvider */
    private $cacheProvider;

    /** @var null|\Symfony\Component\DependencyInjection\ContainerInterface */
    private $container = null;

    /** @var string */
    private $baseNamespace;

    /**
     * init
     *
     * @param CacheProvider      $cacheProvider
     * @param ContainerInterface $container
     */
    public function __construct(CacheProvider $cacheProvider, ContainerInterface $container)
    {
        $this->cacheProvider = $cacheProvider;
        $this->container = $container;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if ($event->isMasterRequest()) {
            $request = $event->getRequest();
            $cacheId = self::getCacheId($request);
            $this->setNamespace(User::getUsernameByRequest($request));
            if ($this->checkCache($cacheId)) {
                $response = new Response();
                $response->setPublic()->setLastModified(unserialize($this->cacheProvider->fetch($cacheId)));
                if ($response->isNotModified($request)) {
                    $event->setResponse($response);
                }
            }
        }
    }

    /**
     * check Cache
     *
     * @param $cacheId
     *
     * @return bool
     */
    private function checkCache($cacheId)
    {
        return $this->cacheProvider->contains($cacheId)
        && $this->container->isScopeActive('request') && !$this->container->get('security.context')->isGranted('ROLE_USER');
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postUpdate(LifecycleEventArgs $args)
    {
        $object = $args->getObject();
        if ($object instanceof Article) {
            $authors = $object->getAuthors();
            $this->setNamespace();
            $this->cacheProvider->deleteAll();
            /** @var \FDevs\UserBundle\Document\User $author */
            foreach ($authors as $author) {
                $this->setNamespace($author->getUsernameCanonical());
                $this->cacheProvider->deleteAll();
            }
        }
    }

    /**
     * saveLastModified
     * @param \DateTime $time
     * @param Request   $request
     * @return $this
     */
    public function saveLastModified(\DateTime $time, Request $request)
    {
        $cacheId = self::getCacheId($request);
        if (!$this->checkCache($cacheId)) {
            $this->setNamespace(User::getUsernameByRequest($request));
            $this->cacheProvider->save($cacheId, serialize($time));
        }

        return $this;
    }

    /**
     * set Username
     *
     * @param string $username
     *
     * @return $this
     */
    private function setNamespace($username = '')
    {
        $this->baseNamespace = $this->baseNamespace ? : $this->cacheProvider->getNamespace();
        $this->cacheProvider->setNamespace($this->baseNamespace . $username);

        return $this;
    }

    /**
     * on Kernel Response
     *
     * @param FilterResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $response = $event->getResponse();
        $request = $event->getRequest();
        $cacheId = self::getCacheId($request);
        $this->setNamespace(User::getUsernameByRequest($request));
        if ($this->checkCache($cacheId)) {
            $response->setLastModified(unserialize($this->cacheProvider->fetch($cacheId)));
            $response->setPublic();
        } else {
            $response->setPrivate();
        }
        $event->setResponse($response);
    }

    /**
     * get Cache Id
     *
     * @param Request $request
     *
     * @return string
     */
    public static function getCacheId(Request $request)
    {
        return User::getUsernameByRequest($request) . $request->getRequestUri();
    }
}
