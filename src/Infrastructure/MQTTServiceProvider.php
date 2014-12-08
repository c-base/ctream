<?php
/**
 * A modified MIT License (MIT)
 * Copyright © 2014
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so., subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * Neither the Software, nor any derivative product, shall be used to operate weapons,
 * military nuclear facilities, life support or other mission critical applications
 * where human life or property may be at stake or endangered.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
namespace CBase\Ctream\Infrastructure;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class MQTTServiceProvider
 * @package CBase\Ctream\Infrastructure
 */
class MQTTServiceProvider implements ServiceProviderInterface
{
    const SUBSCRIBE_TOPIC_ALL = 'all';
    /**
     * @param Container $container An Container instance
     */
    public function register(Container $container)
    {
        $container['mqtt.address']  = 'tcp://c-beam.cbrp3.c-base.org:1883/';
        $container['mqtt.clientId'] = 'cstream';

        $container['mqtt.client'] = function ($container) {
            $mqtt = new \spMQTT(
                $container['mqtt.address'],
                $container['mqtt.clientId']
            );
            return $mqtt;
        };

        $container['mqtt.topic'] = [
            self::SUBSCRIBE_TOPIC_ALL => ['#' => 1],
        ];

        $container['mqtt.subscribe.callback'] = function ($mqtt, $topic, $message) {
            throw new \InvalidArgumentException('mqtt.subscribe.callback ');
        };

        $container['mqtt.subscribe'] = $container->protect(
            function ($topic) use ($container) {
                /** @var \spMQTT $mqtt */
                $mqtt = $container['mqtt.client'];
                $mqtt->setKeepalive(3600);
                $connected = $mqtt->connect();
                if (!$connected) {
                    die("Not connected\n");
                }

                $mqtt->subscribe($container['mqtt.topic'][$topic]);
                $mqtt->loop($container->raw('mqtt.subscribe.callback'));
            }
        );

        $container['mqtt.debug'] = false;
        if ($container['mqtt.debug']) {
            \spMQTTDebug::Enable();
        }
    }
}