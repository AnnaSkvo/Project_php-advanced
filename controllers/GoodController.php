<?php

namespace app\controllers;

use app\repositories\GoodRepository;

class GoodController extends Controller
{
    public function allAction()
    {
        $goods = $this->container->goodRepository->getAll();
        return $this->render(
            'goodAll',
            ['goods' => $goods]
        );
    }

    public function oneAction()
    {
        $id = $this->getId();
        $good = $this->container->goodRepository->getOne($id);
        return $this->render('goodOne', ['good' => $good,]);
    }
}
