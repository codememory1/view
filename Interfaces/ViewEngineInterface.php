<?php

namespace Codememory\Components\View\Interfaces;

use Closure;
use Codememory\Components\View\Utils;
use Codememory\FileSystem\Interfaces\FileInterface;

/**
 * Interface ViewEngineInterface
 * @package Codememory\Components\View\Interfaces
 *
 * @author  Codememory
 */
interface ViewEngineInterface
{

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Set full full to opened template
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $path
     *
     * @return ViewEngineInterface
     */
    public function setTemplatePath(string $path): ViewEngineInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Set parameters that should be passed to the opened template
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param array $parameters
     *
     * @return ViewEngineInterface
     */
    public function setParameters(array $parameters): ViewEngineInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Set the utilities object View, through which you can
     * get values from the view configuration
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param Utils $utils
     *
     * @return ViewEngineInterface
     */
    public function setUtils(Utils $utils): ViewEngineInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Set filesystem object to work with correct template paths
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param FileInterface $filesystem
     *
     * @return ViewEngineInterface
     */
    public function setFilesystem(FileInterface $filesystem): ViewEngineInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the Closure of an open compiled template
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return Closure
     */
    public function get(): Closure;

}