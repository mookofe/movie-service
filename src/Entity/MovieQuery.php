<?php
declare(strict_types = 1);

namespace App\Entity;

/**
 * Class MovieQuery
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
final class MovieQuery
{
    /**
     * Ascending orientation
     *
     * @var string
     */
    public const ORIENTATION_ASC = 'ASC';

    /**
     * Descending orientation
     *
     * @var string
     */
    public const ORIENTATION_DESC = 'DESC';

    /**
     * @var string
     */
    private $orderBy;

    /**
     * See self::ORIENTATION_*
     *
     * @var string
     */
    private $orientation;

    /**
     * @var int
     */
    private $skip = 0;

    /**
     * Page size limit
     *
     * @var int
     */
    private $limit = 20;

    /**
     * MovieQuery constructor.
     *
     * @param string $orderBy
     * @param string $orientation
     * @param int $skip
     * @param int $limit
     */
    public function __construct(?string $orderBy, ?string $orientation, int $skip = 0, int $limit = 20)
    {
        $this->orderBy = $orderBy;
        $this->orientation = $orientation;
        $this->skip = $skip;
        $this->limit = $limit;
    }

    /**
     * Get order by column
     *
     * @return string
     */
    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    /**
     * Get orientation
     *
     * @return string
     */
    public function getOrientation(): string
    {
        return $this->orientation;
    }

    /**
     * Get page number
     *
     * @return int
     */
    public function getSkip(): int
    {
        return $this->skip;
    }

    /**
     * Get page limit
     *
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }
}