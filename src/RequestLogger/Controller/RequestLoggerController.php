<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 11.07.16
 * Time: 12:24
 */

namespace RequestLogger\Controller;

use Application\Controller\Admin\AbstractAdminController;
use RequestLogger\Form\SearchForm;
use RequestLogger\Mapper\LoggerMapper;

class RequestLoggerController extends AbstractAdminController
{

    public function indexAction()
    {
        /* @var $form SearchForm */
        $form = $this->getForm();

        /* @var $params array */
        $params = [];
        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            if ($this->getRequest()->getPost('uid')) {
                $params[] = [
                    'field' => 'userID',
                    'exp'   => 'equals',
                    'val'   => intval($this->getRequest()->getPost('uid')),
                ];
            }
            if (!empty($this->getRequest()->getPost('dateStart'))) {
                $params[] = [
                    'field' => 'createdAt',
                    'exp'   => 'gte',
                    'val'   => new \DateTime($this->getRequest()->getPost('dateStart')),
                ];
            }
            if (!empty($this->getRequest()->getPost('dateEnd'))) {
                $params[] = [
                    'field' => 'createdAt',
                    'exp'   => 'lte',
                    'val'   => new \DateTime($this->getRequest()->getPost('dateEnd')),
                ];
            }
            if (!empty($this->getRequest()->getPost('method'))) {
                $params[] = [
                    'field' => 'method',
                    'exp'   => 'equals',
                    'val'   => $this->getRequest()->getPost('method'),
                ];
            }

        }
        $rows_per_page = 50;
        $currentPage = ($this->getRequest()->getQuery('p')) ? $this->getRequest()->getQuery('p') : 1;
        $logs = $this->getMapperManager()->query($params, [['exp' => 'sort', 'field' => 'createdAt', 'val' => 'desc']],
            ['skip' => ($currentPage - 1) * $rows_per_page, 'limit' => $rows_per_page]);
        $paginator = [
            'CurrentPageNumber' => $currentPage,
            'count'             => (floor($logs['count'] / $rows_per_page) > 0) ? floor($logs['count'] / $rows_per_page) : 1,
        ];

        return [
            'logs'      => $logs['logs'],
            'paginator' => $paginator,
            'form'      => $form,
        ];
    }

    /**
     * @return HandWithdrawForm
     */
    public function getForm()
    {
        return $this->getServiceLocator()
            ->get('FormElementManager')
            ->get('RequestLogger\Form\SearchForm');
    }

    public function viewAction()
    {

        $obj = $this->getMapperManager()->find($this->getEvent()->getRouteMatch()->getParam('id'));

        return [
            'lid' => $this->getEvent()->getRouteMatch()->getParam('id'),
            'obj' => $obj,
        ];
    }

    public function testAction()
    {
        /* @var $form SearchForm */
        $form = $this->getForm();

        /* @var $params array */
        $params = [];
        $form->setAttribute('action', '/admin/requestlogger/test');
        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            if ($this->getRequest()->getPost('uid')) {
                $params[] = [
                    'field' => 'userID',
                    'exp'   => 'equals',
                    'val'   => $this->getRequest()->getPost('uid'),
                ];
            }
            if (!empty($this->getRequest()->getPost('dateStart'))) {
                $params[] = [
                    'field' => 'createdAt',
                    'exp'   => 'gte',
                    'val'   => new \DateTime($this->getRequest()->getPost('dateStart')),
                ];
            }
            if (!empty($this->getRequest()->getPost('dateEnd'))) {
                $params[] = [
                    'field' => 'createdAt',
                    'exp'   => 'lte',
                    'val'   => new \DateTime($this->getRequest()->getPost('dateEnd')),
                ];
            }
            if (!empty($this->getRequest()->getPost('method'))) {
                $params[] = [
                    'field' => 'method',
                    'exp'   => 'equals',
                    'val'   => $this->getRequest()->getPost('method'),
                ];
            }

        }
        $rows_per_page = 50;
        $currentPage = ($this->getRequest()->getQuery('p')) ? $this->getRequest()->getQuery('p') : 1;
        $logs = $this->getMapperManager()->query($params, [['exp' => 'sort', 'field' => 'createdAt', 'val' => 'desc']],
            ['skip' => ($currentPage - 1) * $rows_per_page, 'limit' => $rows_per_page]);
        $paginator = [
            'CurrentPageNumber' => $currentPage,
            'count'             => (floor($logs['count'] / $rows_per_page) > 0) ? floor($logs['count'] / $rows_per_page) : 1,
        ];

        return [
            'logs'      => $logs['logs'],
            'paginator' => $paginator,
            'form'      => $form,
        ];


    }

    private $mapperManager = null;

    /**
     * @return LoggerMapper
     */
    protected function getMapperManager()
    {
        if ($this->mapperManager == null) {
            $this->mapperManager = $this->getServiceLocator()->get('LoggerMapper');
        }

        return $this->mapperManager;
    }
}
