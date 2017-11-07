<?php

namespace Psr\Rdf;

/**
 * The StatementIterator interface extends the \Iterator interface by restricting it to Statements.
 *
 * Note: It extends \Iterator, but contains its methods too, to be compatible to all implementations
 *       requiring an \Iterator instance.
 */
interface StatementIterator extends \Iterator
{
    /**
     * Get current Statement instance.
     *
     * @return Statement
     */
    public function current();

    /**
     * Get key of current Statement.
     *
     * @return scalar May not be meaningful, but must be unique.
     */
    public function key();

    /**
     * Go to the next Statement instance. Any returned value is ignored.
     */
    public function next();

    /**
     * Reset this iterator.
     *
     * Be aware, it may not be implemented! This can be the case if the implementation is based
     * on a stream.
     */
    public function rewind();

    /**
     * Checks if the current Statement is valid.
     *
     * @return boolean
     */
    public function valid();
}
