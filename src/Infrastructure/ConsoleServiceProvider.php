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
use CBase\Ctream\Application\Console;
use Symfony\Component\Console\Helper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ConsoleServiceProvider
 * @package CBase\Ctream\Infrastructure
 */
class ConsoleServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {

        $container['console'] = function () use ($container) {
            $console = new Console($container['app.name'] . ' console', '0.1');
            $console->setDispatcher($container['dispatcher']);

            return $console;
        };

        $container['console']
            ->register('mqtt:subscribe')
            ->setDefinition(array())
            ->setDescription('subscribes to the mqtt')
            ->setCode(
                function (InputInterface $input, OutputInterface $output) use ($container)  {

                    $container['mqtt.subscribe.callback'] = function ($mqtt, $topic, $message) use ($output) {
                        $output->writeln(
                            sprintf('{"command": "%s", "payload": %s}', $topic, $message)
                        );
                    };

                    $container['mqtt.subscribe'](MQTTServiceProvider::SUBSCRIBE_TOPIC_ALL);
                }
            );
    }
}
