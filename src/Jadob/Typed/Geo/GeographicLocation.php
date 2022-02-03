<?php

declare(strict_types=1);

namespace Jadob\Typed\Geo;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class GeographicLocation
{
    protected Latitude $latitude;

    protected Longitude $longitude;

    public function __construct(Latitude $latitude, Longitude $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }
}
