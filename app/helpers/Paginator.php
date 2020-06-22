<?php


namespace app\helpers;


use app\sys\db\QueryLOSParams;
use app\sys\exceptions\NotFoundException;
use app\sys\exceptions\RequestUriException;

class Paginator
{
    /**
     * @var string
     */
    public $pageParam = 'page';

    /**
     * @var QueryLOSParams
     */
    private $params;

    private $total;

    /**
     * Paginator constructor.
     * @param int $total
     * @param QueryLOSParams|null $params
     */
    public function __construct($total, QueryLOSParams $params = null)
    {
        $this->total = $total;
        $this->params = $params ?: new QueryLOSParams();
    }

    /**
     * @return QueryLOSParams
     * @throws NotFoundException
     */
    public function getPageParams()
    {
        $offset = $this->params->limit * ($this->getCurrentPage() - 1);
        if ($offset > $this->total) {
            throw new NotFoundException('This page don\'t have data');
        }

        $params = clone $this->params;
        $params->offset = $offset;
        return $params;
    }

    /**
     * @return int
     */
    private function getCurrentPage()
    {
        return (int)ArrayHelper::getValue($this->pageParam, $_GET, 1);
    }

    /**
     * @return int
     */
    public function getTotalPages()
    {
        return (int)ceil($this->total / $this->params->limit);
    }

    /**
     * @return array
     * @throws RequestUriException
     */
    public function getMeta()
    {
        if (!$urlString = ArrayHelper::getValue('REQUEST_URI', $_SERVER)) {
            throw new RequestUriException('Something wrong');
        }

        $parts = parse_url($urlString);
        $baseUrl = $parts['path'];
        parse_str($parts['query'], $params);

        $page = $this->getCurrentPage();
        return [
            'currentPage' => $page,
            'totalPages' => $this->getTotalPages(),
            'prevUrl' => $page === 1
                ? null
                : ($baseUrl . '?' . http_build_query(array_merge($params, [
                        $this->pageParam => $page - 1,
                    ]))),
            'nextUrl' => $page === $this->getTotalPages()
                ? null
                : ($baseUrl . '?' . http_build_query(array_merge($params, [
                        $this->pageParam => $page + 1,
                    ]))),
        ];
    }
}
