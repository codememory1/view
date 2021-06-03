<?php

namespace Codememory\Components\View\Exceptions;

use JetBrains\PhpStorm\Pure;

/**
 * Class TemplateNameNotExistException
 * @package Codememory\Components\View\Exceptions
 *
 * @author  Codememory
 */
class TemplateNameNotExistException extends ViewException
{

    /**
     * TemplateNameNotExistException constructor.
     *
     * @param string $templateName
     */
    #[Pure]
    public function __construct(string $templateName)
    {

        parent::__construct(sprintf('There is no saved template named %s', $templateName));

    }

}