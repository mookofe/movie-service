<?php
declare(strict_types = 1);

namespace App\Entity;

/**
 * Movie formats
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class MovieFormat
{
    /**
     * @var string
     */
    public const VHS = 'vhs';

    /**
     * @var string
     */
    public const DVD = 'dvd';

    /**
     * @var string
     */
    public const STREAMING = 'streaming';
}