<?php

namespace Codememory\Components\View\Interfaces;

use Closure;

/**
 * Interface ViewInterface
 * @package Codememory\Components\View\Interfaces
 *
 * @author  Codememory
 */
interface ViewInterface
{

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Rendering a template from the path specified in the configuration, name
     * of the template or the path to it relative to the path the view
     * configuration is passed as the first argument; the second argument
     * is an array of variables that must be passed to the template
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $templatePath
     * @param array  $parameters
     *
     * @return ViewInterface
     */
    public function render(string $templatePath, array $parameters = []): ViewInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * A simplified method for adding parameters to a template, the name
     * of the variable is passed as the first argument; the second parameter
     * is the value of the passed variable
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $parameterName
     * @param mixed  $value
     *
     * @return ViewInterface
     */
    public function with(string $parameterName, mixed $value): ViewInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Change dynamically template loading engine
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param ViewEngineInterface $engine
     *
     * @return ViewInterface
     */
    public function engine(ViewEngineInterface $engine): ViewInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Saves the entire template and its parameters with a name, so that
     * you can get the same template without specifying the same parameters
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $name
     *
     * @return ViewInterface
     */
    public function saveByName(string $name): ViewInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns a closure of an open template, this closure can be
     * called and the template will be displayed on the screen
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return Closure
     */
    public function getTemplateClosure(): Closure;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Rendering a template by the name that was saved before
     * calling this render
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $name
     *
     * @return void
     */
    public function renderByName(string $name): void;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Will return boolean by checking the existence of the
     * template in the stored ones
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $name
     *
     * @return bool
     */
    public function existTemplateName(string $name): bool;

}