<?php

namespace Codememory\Components\View\Engines;

use Closure;
use Codememory\Components\Caching\Cache;
use Codememory\Components\Markup\Types\YamlType;
use Codememory\Support\Str;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Class TwigEngine
 *
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

            Str::replace($templateName, '.', '/');

            return $this->getTwig()->render(sprintf('%s.html.twig', $templateName), $this->parameters);
        };

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns an array of options for the twig template engine
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return array
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
     */
    private function getTwig(): Environment
    {

        if (!$this->twig instanceof Environment) {
            $filesystemLoader = new FilesystemLoader(
                $this->filesystem->getRealPath($this->utils->getPathWithTemplates())
            );

            $this->twig = new Environment($filesystemLoader, $this->getOptionsForTwig());

            if (null !== $this->utils->getTwigExpander()) {
                $expanderNamespace = $this->utils->getTwigExpander();

                new $expanderNamespace($this->twig);
            }
        }

        return $this->twig;

    }

}