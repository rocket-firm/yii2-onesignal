# yii2-onesignal
Yii2 component for OneSignal.com integration. Any contribution is highly encouraged!

## Installation

Preferred way to install is through [Composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx).

```
composer require rocketfirm/yii2-onesignal
```

## Configuration

Add following code to your configuration file (main.php):

```
'components' => [
	// ...

	'onesignal' => [
		'appId' => 'ONESIGNAL_APP_ID',
		'apiKey' => 'ONESIGNAL_API_KEY',
	]
]
```

## Usage

After adding onesignal component to your project you can now simply add players to your OneSignal application by running following code:
```
\Yii::$app->onesignal->players()->add($deviceType, $options);
```

Run following command to send notifications:
```
\Yii::$app->onesignal->notifications()->create($message, $options)
```

Visit official [onesignal.com documentation](https://documentation.onesignal.com/) for more details.
