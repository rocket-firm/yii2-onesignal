<?php
/**
 * Created by PhpStorm.
 * User: rocketman
 * Date: 23.06.16
 * Time: 14:20
 */

namespace rocketfirm\onesignal\helpers;


use yii\base\Exception;

/**
 * Class Player
 *
 * Used for interactions with users api
 *
 * @package rocketfirm\onesignal\helpers
 */
class Player extends Request
{
    public $id;
    public $methodName = 'players';

    /**
     * Gets all the devices. Not recommended for apps with 10 000 + devices
     *
     * @return array
     */
    public function view()
    {
        return json_decode($this->curl
            ->get($this->apiBaseUrl . $this->methodName . '?app_id=' . $this->appId));
    }

    /**
     * View player info
     * @return object returns Player object
     *
     * @throws Exception
     */
    public function viewOne()
    {
        if (!$this->id) {
            throw new Exception('ID of player is not defined');
        }

        return json_decode(
            $this
                ->curl
                ->get($this->apiBaseUrl . $this->methodName . '/' . $this->id . '?app_id=' . $this->appId)
        );
    }

    /**
     * Adds device to player
     *
     * @param int   $deviceType 0 = iOS,
     *                          1 = Android,
     *                          2 = Amazon,
     *                          3 = WindowsPhone(MPNS),
     *                          4 = ChromeApp,
     *                          5 = ChromeWebsite,
     *                          6 = WindowsPhone(WNS),
     *                          7 = Safari,
     *                          8 = Firefox,
     *                          9 = Mac OS X
     *
     * @param array $options    Additional options can be found at OneSignal docs page
     *                          https://documentation.onesignal.com/docs/players-add-a-device
     *
     * @return bool|string
     */
    public function add($deviceType, $options = [])
    {
        $result = $this->curl->setOption(
            CURLOPT_POSTFIELDS, json_encode(
                array_merge($options, ['device_type' => $deviceType, 'app_id' => $this->appId])
            )
        )
            ->setOption(CURLOPT_POST, true)
            ->setOption(CURLOPT_RETURNTRANSFER, TRUE)
            ->post($this->apiBaseUrl . $this->methodName);

        $result = json_decode($result, true);

        if ($result['success'] == true) {
            return $result['id'];
        }

        return false;
    }

    /**
     * Edit player info
     * @param  array $options Parameters to edit.
     * Visit [onesignal.com](https://documentation.onesignal.com/) for more details.
     * @return boolean returns true if edition is successfully done
     *
     * @throws Exception
     */
    public function edit($options)
    {
        if (!$this->id) {
            throw new Exception('ID of player is not defined');
        }

        $result = $this->curl->setOption(
            CURLOPT_POSTFIELDS, json_encode(
                $options
            )
        )->put($this->apiBaseUrl . $this->methodName . '/' . $this->id);

        $result = json_decode($result, true);

        return $result['success'];
    }

    /**
     * Adds tag to selected player
     * @param array|string  $tagName  Tags to be added
     * @param boolean $tagValue returns true if edition is successfully done
     *
     * @return bool|mixed
     */
    public function addTag($tagName, $tagValue = true)
    {
        if (is_array($tagName)) {
            return $this->edit(['tags' => $tagName]);
        } else {
            return $this->edit(['tags' => [$tagName => $tagValue]]);
        }
    }

    /**
     * Removes tags from player
     * @param  array|string  $tagName  Tag to be removed
     *
     * @return bool|mixed
     */
    public function removeTag($tagName)
    {
        return $this->addTag($tagName, '');
    }
}
