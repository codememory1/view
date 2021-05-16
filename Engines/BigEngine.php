<?php

namespace Codememory\Components\View\Engines;

use Closure;
use Codememory\Components\Big\Big;
use Codememory\Components\Big\Interfaces\BigInterface;
use Codememory\Components\Configuration\Exceptions\ConfigNotFoundException;
use Codememory\Components\Environment\Exceptions\EnvironmentVariableNotFoundException;
use Codememory\Components\Environment\Exceptions\IncorrectPathToEnviException;
use Codememory\Components\Environment\Exceptions\ParsingErrorException;
use Codememory\Components\Environment\Exceptions\VariableParsingErrorException;

/**
 * Class BigEngine
 * @package Codememory\Components\View\Engines
 *
 * @author  Codememory
 */
class BigEngine extends EngineAbstract
{

    /**
     * @var Big|null
     */
    private ?Big $big = null;

    /**
     * @inheritDoc
     * @throws ConfigNotFoundException
     * @throws EnvironmentVariableNotFoundException
     * @throws IncorrectPathToEnviException
     * @throws ParsingErrorException
     * @throws VariableParsingErrorException
     */
    public function get(): Closure
    {

        return $this->getBig()
            ->useCache($this->utils->useCache())
            ->setParameters($this->parameters)
            ->make()
            ->getCompiledTemplate();

    }

    /**
     * @return BigInterface
     * @throws ConfigNotFoundException
     * @throws EnvironmentVariableNotFoundException
     * @throws IncorrectPathToEnviException
     * @throws ParsingErrorException
     * @throws VariableParsingErrorException
     */
    private function getBig(): BigInterface
    {

        if(!$this->big instanceof BigInterface) {
            $this->big = new Big($this->templatePath, $this->filesystem);
        }

        return $this->big;

    }

}