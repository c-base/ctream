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
namespace CBase\Ctream\Application;

use Symfony\Component\Console\Application as BaseConsole;
use Symfony\Component\Console\Helper;

/**
 * Class Console
 * @package CBase\Ctream\Application
 */
class Console extends BaseConsole
{
    /**
     * Gets the default helper set with the helpers that should always be available.
     *
     * @return HelperSet A HelperSet instance
     */
    protected function getDefaultHelperSet()
    {
        return new Helper\HelperSet([
            new Helper\FormatterHelper(),
            new Helper\QuestionHelper(),
            new Helper\DebugFormatterHelper(),
        ]);
    }
} 