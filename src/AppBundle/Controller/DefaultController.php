<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Cache\CacheItem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class DefaultController extends Controller
{
    const DEFAULT_CACHE_TTL = 10;
    const DEFAULT_PER_PAGE = 10;

    /**
     * @var FilesystemAdapter
     */
    protected $cache;

    /**
     * DefaultController constructor.
     */
    public function __construct()
    {
        $this->cache = new FilesystemAdapter();
    }

    /**
     * @Route("/no-orm")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function noOrmAction(Request $request)
    {
        $page = $this->getPageParam($request);
        $offset = ($page - 1 ) * self::DEFAULT_PER_PAGE;
        $limit = self::DEFAULT_PER_PAGE;

        /**
         * @var $item CacheItem
         */
        $item = $this->cache->getItem('no_orm.page_' . $page);
        if (!$item->isHit()) {
            $patients = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('AppBundle:Patient')
                ->findPatientsWithOneOrMoreDrugsNoORM('Alex', $offset, $limit);

            $item->set($patients);
            $item->expiresAfter(self::DEFAULT_CACHE_TTL);
            $this->cache->save($item);
        }

        return $this->render(
            ':default:no_orm.html.twig',
            [
                'patients' => $item->get(),
                'page' => $page
            ]
        );
    }

    /**
     * @Route("/orm")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ormAction(Request $request)
    {
        $page = $this->getPageParam($request);
        $offset = ($page - 1 ) * self::DEFAULT_PER_PAGE;
        $limit = self::DEFAULT_PER_PAGE;

        /**
         * @var $item CacheItem
         */
        $item = $this->cache->getItem('orm.page_' . $page);
        if (!$item->isHit()) {
            $patients = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('AppBundle:Patient')
                ->findPatientsWithOneOrMoreDrugs('Alex', $offset, $limit);

            $item->set($patients);
            $item->expiresAfter(self::DEFAULT_CACHE_TTL);
            $this->cache->save($item);
        }

        return $this->render(
            ':default:orm.html.twig',
            [
                'patients' => $item->get(),
                'page' => $page
            ]
        );
    }

    /**
     * @param Request $request
     * @return int
     */
    protected function getPageParam(Request $request)
    {
        $page = (int) $request->get('page', 0);
        return $page > 0 ? $page : 1;
    }
}
