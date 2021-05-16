<?php

namespace Codememory\Components\View;

use Closure;
use Codememory\Components\Configuration\Exceptions\ConfigNotFoundException;
use Codememory\Components\Environment\Exceptions\EnvironmentVariableNotFoundException;
use Codememory\Components\Environment\Exceptions\IncorrectPathToEnviException;
use Codememory\Components\Environment\Exceptions\ParsingErrorException;
use Codememory\Components\Environment\Exceptions\VariableParsingErrorException;
use Codememory\Components\View\Exceptions\TemplateNameNotExistException;
use Codememory\Components\View\Interfaces\ViewEngineInterface;
use Codememory\Components\View\Interfaces\ViewInterface;
use Codememory\FileSystem\Interfaces\FileInterface;

/**
 * Class View
 * @package Codememory\Components\View
 *
 * @author  Codememory
 */
class View implements ViewInterface
{

    /**
     * @var FileInterface
     */
    private FileInterface $filesystem;

    /**
     * @var string|null
     */
    private ?string $templatePath = null;

    /**
     * @var array
     */
    private array $parameters = [];

    /**
     * @var ViewEngineInterface|null
     */
    private ?ViewEngineInterface $engine = null;

    /**
     * @var Utils|null
     */
    private ?Utils $utils = null;

    /**
     * @var array
     */
    private array $templatesWithNames = [];

    /**
     * View constructor.
     *
     * @param FileInterface $filesystem
     *
     * @throws ConfigNotFoundException
     * @throws EnvironmentVariableNotFoundException
     * @throws IncorrectPathToEnviException
     * @throws ParsingErrorException
     * @throws VariableParsingErrorException
     */
    public function __construct(FileInterface $filesystem)
    {

        $this->filesystem = $filesystem;

        $engine = $this->getUtils()->getNamespaceEngine();
        $this->engine(new $engine());

    }

    /**
     * @inheritDoc
     * @throws ConfigNotFoundException
     * @throws EnvironmentVariableNotFoundException
     * @throws IncorrectPathToEnviException
     * @throws ParsingErrorException
     * @throws VariableParsingErrorException
     */
    public function render(string $templatePath, array $parameters = []): ViewInterface
    {

        $this->parameters = [];

        $templatePath = trim($this->getUtils()->getPathWithTemplates()) . '/' . $templatePath;
        $this->templatePath = $templatePath;
        $this->parameters = $parameters;

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function with(string $parameterName, mixed $value): ViewInterface
    {

        $this->parameters[$parameterName] = $value;

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function engine(ViewEngineInterface $engine): ViewInterface
    {

        $this->engine = $engine;

        return $this;

    }

    /**
     * @inheritDoc
     * @throws ConfigNotFoundException
     * @throws EnvironmentVariableNotFoundException
     * @throws IncorrectPathToEnviException
     * @throws ParsingErrorException
     * @throws VariableParsingErrorException
     */
    public function saveByName(string $name): ViewInterface
    {

        $this->templatesWithNames[$name] = $this->getTemplateClosure();

        return $this;

    }

    /**
     * @inheritDoc
     * @throws ConfigNotFoundException
     * @throws EnvironmentVariableNotFoundException
     * @throws IncorrectPathToEnviException
     * @throws ParsingErrorException
     * @throws VariableParsingErrorException
     */
    public function getTemplateClosure(): Closure
    {

        return $this->engine
            ->setTemplatePath($this->templatePath)
            ->setParameters($this->parameters)
            ->setFilesystem($this->filesystem)
            ->setUtils($this->getUtils())
            ->get();

    }

    /**
     * @inheritDoc
     * @throws TemplateNameNotExistException
     */
    public function renderByName(string $name): void
    {

        if (!$this->existTemplateName($name)) {
            throw new TemplateNameNotExistException($name);
        }

        echo $this->templatesWithNames[$name]->__invoke();

    }

    /**
     * @inheritDoc
     */
    public function existTemplateName(string $name): bool
    {

        return array_key_exists($name, $this->templatesWithNames);

    }

    /**
     * @throws ConfigNotFoundException
     * @throws EnvironmentVariableNotFoundException
     * @throws VariableParsingErrorException
     * @throws IncorrectPathToEnviException
     * @throws ParsingErrorException
     */
    public function makeOutput(): void
    {

        $this->getTemplateClosure()->__invoke();

    }

    /**
     * @return Utils
     * @throws ConfigNotFoundException
     * @throws EnvironmentVariableNotFoundException
     * @throws IncorrectPathToEnviException
     * @throws ParsingErrorException
     * @throws VariableParsingErrorException
     */
    private function getUtils(): Utils
    {

        if (!$this->utils instanceof Utils) {
            $this->utils = new Utils($this->filesystem);
        }

        return $this->utils;

    }

}