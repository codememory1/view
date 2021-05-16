<?php

namespace Codememory\Components\View\Engines;

use Codememory\Components\View\Interfaces\ViewEngineInterface;
use Codememory\Components\View\Utils;
use Codememory\FileSystem\Interfaces\FileInterface;

/**
 * Class EngineAbstract
 * @package Codememory\Components\View\Engines
 *
 * @author  Codememory
 */
abstract class EngineAbstract implements ViewEngineInterface
{

    /**
     * @var string|null
     */
    protected ?string $templatePath = null;

    /**
     * @var array
     */
    protected array $parameters = [];

    /**
     * @var Utils|null
     */
    protected ?Utils $utils = null;

    /**
     * @var FileInterface|null
     */
    protected ?FileInterface $filesystem = null;

    /**
     * @inheritDoc
     */
    public function setTemplatePath(string $path): ViewEngineInterface
    {

        $this->templatePath = $path;

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function setParameters(array $parameters): ViewEngineInterface
    {

        $this->parameters = $parameters;

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function setUtils(Utils $utils): ViewEngineInterface
    {

        $this->utils = $utils;

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function setFilesystem(FileInterface $filesystem): ViewEngineInterface
    {

        $this->filesystem = $filesystem;

        return $this;

    }

}