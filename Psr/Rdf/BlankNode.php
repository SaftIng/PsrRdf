<?php

namespace Psr\Rdf;

/**
 * This interface is common for blank nodes according to RDF 1.1.
 * For more information see http://www.w3.org/TR/rdf11-concepts/#section-blank-nodes
 */
interface BlankNode extends Node
{
    /**
     * Returns the blank ID of this blank node.
     *
     * @return string Blank ID.
     */
    public function getBlankId();
}
