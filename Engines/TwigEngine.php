<?php

namespace Codememory\Components\View\Engines;

use Closure;
use Codememory\Components\Caching\Cache;
use Codememory\Components\Caching\Exceptions\ConfigPathNotExistException;
use Codememory\Components\Markup\Types\YamlType;
use Codememory\Support\Str;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Class TwigEngine
 * @package Codememory\Components\View\Engines
 *
 * @author  Codememory
 */
class TwigEngine extends EngineAbstract
{

    /**
     * @var Environment|null
     */
    private ?Environment $twig = null;

    /**
     * @inheritDoc
     */
    public function get(): Closure
    {

        Str::replace($this->templatePath, '//', '/');

        return function () {
            $templateName = Str::trimToSymbol($this->templatePath, '/', false);

            echo $this->getTwig()->render($templateName, $this->parameters);
        };

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns an array of options for the twig template engine
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return array
     * @throws ConfigPathNotExistException
     */
    private function getOptionsForTwig(): array
    {

        $options = [];

        if ($this->utils->useCache()) {
            $caching = new Cache(new YamlType(), $this->filesystem);

            $options['cache'] = $this->filesystem->getRealPath($caching->getUtils()->getPath());
        }

        return $options;

    }

    /**
     * @return Environment
     * @throws ConfigPathNotExistException
     */
    private function getTwig(): Environment
    {

        if (!$this->twig instanceof Environment) {
            $filesystemLoader = new FilesystemLoader(
                $this->filesystem->getRealPath($this->utils->getPathWithTemplates())
            );

            $this->twig = new Environment($filesystemLoader, $this->getOptionsForTwig());
        }

        return $this->twig;

    }

}