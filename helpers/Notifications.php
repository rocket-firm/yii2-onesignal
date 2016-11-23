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

    /**
     * TODO: View sent notification info
     * @param integer $id OneSignal notification ID
     * @return array notification info from OneSignal API
     */
    public function view($id)
    {

    }

    /**
     * TODO: View all sent notification
     * @return [type] [description]
     */
    public function viewAll()
    {

    }

    /**
     * TODO: Tracks notification state
     * @param integer $id OneSignal notification ID
     * @return array notification info from OneSignal API
     */
    public function track($id)
    {

    }

    /**
     * Posts notification to OneSignal API
     * @param  array  $contents array with lang id as keys and message as value
     * **Example:**
     * ```
     * ['en' => 'Notification in english', 'ru' => 'Уведомление на русском']
     * ```
     * @param  array  $options  additional options. 
     * Visit [onesignal.com](https://documentation.onesignal.com/) for more details.
     * @return array  json encoded array, that contains result from OneSignal API
     */
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

    /**
     * Used to stop a scheduled or currently outgoing notification.
     * @param $id string
     * @return array
     */
    public function cancel($id)
    {
        $result = $this->curl->delete(
            $this->apiBaseUrl . $this->methodName . "/{$id}?app_id={$this->appId}"
        );

        return json_decode($result);
    }
}