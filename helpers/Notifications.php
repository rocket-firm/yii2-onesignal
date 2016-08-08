<?php
/**
 * Created by PhpStorm.
 * User: rocketman
 * Date: 23.06.16
 * Time: 14:20
 */

namespace rocketfirm\onesignal\helpers;


class Notifications extends Request
{
    public $id;

    public $methodName = 'notifications';

    public function view()
    {

    }

    public function viewAll()
    {

    }

    public function track()
    {

    }

    public function create($contents, $options = [])
    {
        $result = $this->curl->setOption(
            CURLOPT_POSTFIELDS, json_encode(
                array_merge(['contents' => $contents, 'app_id' => $this->appId], $options)
            )
        )
            ->setOption(CURLOPT_POST, true)
            ->setOption(CURLOPT_RETURNTRANSFER, TRUE)
            ->post($this->apiBaseUrl . $this->methodName);

        $result = json_decode($result, true);

        return $result;
    }

    public function cancel()
    {

    }
}