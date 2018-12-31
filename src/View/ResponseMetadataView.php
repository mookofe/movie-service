<?php
declare(strict_types = 1);

namespace App\View;

/**
 * Class MetadataView
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
final class ResponseMetadataView
{
    /**
     * @var int
     */
    private $skipped;

    /**
     * @var int
     */
    private $totalRows;

    /**
     * MetadataView constructor.
     *
     * @param int $skipped
     * @param int $totalRows
     */
    public function __construct(int $skipped, int $totalRows)
    {
        $this->skipped = $skipped;
        $this->totalRows = $totalRows;
    }
}