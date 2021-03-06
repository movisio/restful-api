<?php
declare(strict_types = 1);

namespace Movisio\RestfulApi;

/**
 * BadRequestException
 * @property array $errors
 */
class BadRequestException extends \Nette\Application\BadRequestException
{
    /** @var array Some other errors appear in request */
    public $errors = [];

    /****************** Simple factories ******************/

    /**
     * Is thrown when trying to reach secured resource without authentication
     * @param string $message
     * @param \Exception|\Throwable $previous
     * @return BadRequestException
     */
    public static function unauthorized(string $message = '', $previous = null) : BadRequestException
    {
        return new self($message, 401, $previous);
    }

    /**
     * Is thrown when access to this resource is forbidden
     * @param string $message
     * @param \Exception|\Throwable $previous
     * @return BadRequestException
     */
    public static function forbidden(string $message = '', $previous = null) : BadRequestException
    {
        return new self($message, 403, $previous);
    }

    /**
     * Is thrown when resource's not found
     * @param string $message
     * @param \Exception|\Throwable $previous
     * @return BadRequestException
     */
    public static function notFound(string $message = '', $previous = null) : BadRequestException
    {
        return new self($message, 404, $previous);
    }

    /**
     * Is thrown when request method (e.g. POST or PUT) is not allowed for this resource
     * @param string $message
     * @param \Exception|\Throwable $previous
     * @return BadRequestException
     */
    public static function methodNotSupported(string $message = '', $previous = null) : BadRequestException
    {
        return new self($message, 405, $previous);
    }

    /**
     * Is thrown when this resource is not no longer available (e.g. with new API version)
     * @param string $message
     * @param \Exception|\Throwable $previous
     * @return BadRequestException
     */
    public static function gone(string $message = '', $previous = null) : BadRequestException
    {
        return new self($message, 410, $previous);
    }

    /**
     * Is thrown when incorrect (or unknown) Content-Type was provided in request
     * @param string $message
     * @param \Exception|\Throwable $previous
     * @return BadRequestException
     */
    public static function unsupportedMediaType(string $message = '', $previous = null) : BadRequestException
    {
        return new self($message, 415, $previous);
    }

    /**
     * Is thrown when validation problem appears
     * @param Error[] $errors during validation
     * @param string $message
     * @param \Exception|\Throwable $previous
     * @return BadRequestException
     */
    public static function unprocessableEntity(
        array $errors,
        string $message = '',
        $previous = null
    ) : BadRequestException {
        $e = new self($message, 422, $previous);
        $e->errors = $errors;
        return $e;
    }

    /**
     * Is thrown to reject request due to rate limiting
     * @param string $message
     * @param \Exception|\Throwable $previous
     * @return BadRequestException
     */
    public static function tooManyRequests(string $message = '', $previous = null) : BadRequestException
    {
        return new self($message, 429, $previous);
    }
}
