<?php

namespace Psr\Rdf;

/**
 * This interface is common for named nodes according to RDF 1.1 specification.
 * For more information see http://www.w3.org/TR/rdf11-concepts/#section-IRIs.
 */
interface NamedNode extends Node
{
    /**
     * Returns the URI of the node.
     *
     * @return string URI of the node.
     */
    public function getUri();
}
