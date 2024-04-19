<?php
/**
 * @licence Proprietary
 */

namespace Ludicat\MtgFinder\Exception;

/**
 * class EventPostException
 *
 * @author Joseph Lemoine<j.lemoine@ludi.cat>
 */
class EventPostException extends \Exception
{
    protected $errors = [];

    public function __construct(
        $message = 'An error occured while posting the event',
        $code = 0,
        \Throwable $previous = null,
        $errors = []
    )
    {
        parent::__construct($message, $code, $previous);

        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}