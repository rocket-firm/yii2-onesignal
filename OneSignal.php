<?php
/**
 * Created by PhpStorm.
 * User: rocketman
 * Date: 23.06.16
 * Time: 12:39
 */

namespace rocketfirm\onesignal;


use rocketfirm\onesignal\helpers\Notifications;
use rocketfirm\onesignal\helpers\Player;
use yii\base\Component;
use yii\base\Exception;

class OneSignal extends Component
{
    public $appId;
    public $apiKey;

    /**
     * Initializing OneSignal component
     *
     * @return void
     * @throws Exception
     */
    public function init()
    {
        if (empty($this->appId)) {
            throw new Exception('Configure onesignal appId!');
        }

        if (empty($this->apiKey)) {
            throw new Exception('Configure onesignal apiKey!');
        }
    }

    /**
     * Work with player API
     *
     * @param bool|int $id ID of player to edit/view
     *                     or false for common methods
     *
     * @return Player
     */
    public function players($id = false)
    {
        $player = new Player(
            ['appId' => $this->appId, 'apiKey' => $this->apiKey, 'id' => $id]
        );

        return $player;
    }

    /**
     * Work with notifications API
     *
     * @param bool|int $id ID of notification to edit/view
     *                     or false for common methods
     *
     * @return Notifications
     */
    public function notifications($id = false)
    {
        $notification = new Notifications(
            ['appId' => $this->appId, 'apiKey' => $this->apiKey, 'id' => $id]
        );

        return $notification;
    }
}