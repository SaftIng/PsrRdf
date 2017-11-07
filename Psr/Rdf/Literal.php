<?php

namespace Psr\Rdf;

/**
 * Literals are used for values such as strings, numbers, and dates.
 * For more information see https://www.w3.org/TR/rdf11-concepts/#section-Graph-Literal
 */
interface Literal extends Node
{
    /**
     * Get the value of the Literal in its string representations
     *
     * @return string the value of the Literal
     */
    public function getValue();

    /**
     * Get the datatype of the Literal. It can be one of the XML Schema datatypes (XSD) or anything else. If the URI is
     * needed it can be retrieved by calling ->getDatatype()->getUri().
     *
     * An overview about all XML Schema datatypes: {@url http://www.w3.org/TR/xmlschema-2/#built-in-datatypes}
     *
     * @return Node the datatype of the Literal as named node
     */
    public function getDatatype();

    /**
     * Get the language tag of this Literal or null of the Literal has no language tag.
     *
     * @return string|null Language tag or null, if none is given.
     */
    public function getLanguage();
}
