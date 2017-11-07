<?php

namespace Psr\Rdf;

/**
 * Example implementation of Literal.
 */
class LiteralImpl implements Literal
{
    /**
     * @var string
     */
    protected static $xsdString = 'http://www.w3.org/2001/XMLSchema#string';

    /**
     * @var string
     */
    protected static $rdfLangString = 'http://www.w3.org/1999/02/22-rdf-syntax-ns#langString';

    /**
     * @var string
     */
    protected $value;

    /**
     * @var Node
     */
    protected $datatype = null;

    /**
     * @var string
     */
    protected $lang = null;

    /**
     * @param string $value The Literal value
     * @param NamedNode $datatype The datatype of the Literal (respectively defaults to xsd:string or rdf:langString)
     * @param string $lang The language tag of the Literal (optional)
     */
    public function __construct($value, NamedNode $datatype = null, $lang = null)
    {
        if ($value === null) {
            throw new \Exception('Literal value can\'t be null. Please use AnyPattern if you need a variable.');
        } elseif (!is_string($value)) {
            throw new \Exception("The literal value has to be of type string");
        }

        $this->value = $value;

        if ($lang !== null) {
            $this->lang = (string)$lang;
        }

        if (
            $lang !== null &&
            $lang !== "" &&
            $datatype !== null &&
            $datatype->isNamed() &&
            $datatype->getUri() !== self::$rdfLangString
        ) {
            throw new \Exception('Language tagged Literals must have <'. self::$rdfLangString .'> datatype.');
        }

        if (
            ($lang === null || $lang == "") &&
            $datatype !== null &&
            $datatype->isNamed() &&
            $datatype->getUri() === self::$rdfLangString
        ) {
            throw new \Exception('No or empty Language Tag for Literals with <'. self::$rdfLangString .'> datatype.');
        }

        if ($datatype !== null) {
            $this->datatype = $datatype;
        } elseif ($lang !== null) {
            $this->datatype = new NamedNodeImpl(self::$rdfLangString);
        } else {
            $this->datatype = new NamedNodeImpl(self::$xsdString);
        }
    }

    /**
     * Get the value of the Literal in its string representations
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get the datatype of the Literal. It can be one of the XML Schema datatypes (XSD) or anything else. If the URI is
     * needed it can be retrieved by calling ->getDatatype()->getUri().
     *
     * An overview about all XML Schema datatypes: {@url http://www.w3.org/TR/xmlschema-2/#built-in-datatypes}
     *
     * @return Node the datatype of the Literal as named node
     */
    public function getDatatype()
    {
        return $this->datatype;
    }

    /**
     * Get the language tag of this Literal or null of the Literal has no language tag.
     *
     * @return string|null
     */
    public function getLanguage()
    {
        return $this->lang;
    }

    /**
     * Returns the literal value as string representation of the literal node
     *
     * @return string a string representation of the literal
     */
    public function __toString()
    {
        return (string)$this->getValue();
    }

    /**
     * Check if a given instance of Node is equal to this instance.
     *
     * @param Node $toCompare Node instance to check against.
     * @return boolean True, if both instances are semantically equal, false otherwise.
     */
    public function equals(Node $toCompare)
    {
        // Only compare, if given instance is a literal and the datatype matches
        if ($toCompare->isLiteral() && $this->getDatatype()->equals($toCompare->getDatatype())) {
            return $this->getValue() === $toCompare->getValue() && $this->getLanguage() == $toCompare->getLanguage();
        }
        return false;
    }

    /**
     * Returns true, if this pattern matches the given node. This method is the same as equals for concrete nodes
     * and is overwritten for pattern/variable nodes.
     *
     * See also {@url http://www.w3.org/TR/2013/REC-sparql11-query-20130321/#matchingRDFLiterals}
     *
     * @param Node $toMatch Node instance to apply the pattern on
     * @return boolean true, if this pattern matches the node, false otherwise
     */
    public function matches(Node $toMatch)
    {
        return $this->equals($toMatch);
    }

    /**
     * Checks if this instance is a blank node.
     *
     * @return boolean True, if this instance is a blank node, false otherwise.
     */
    public function isBlank()
    {
        return false;
    }

    /**
     * Checks if this instance is concrete, which means it does not contain pattern.
     *
     * @return boolean True, if this instance is concrete, false otherwise.
     */
    public function isConcrete()
    {
        return true;
    }

    /**
     * Checks if this instance is a literal.
     *
     * @return boolean True, if it is a literal, false otherwise.
     */
    public function isLiteral()
    {
        return true;
    }

    /**
     * Checks if this instance is a named node.
     *
     * @return boolean True, if it is a named node, false otherwise.
     */
    public function isNamed()
    {
        return false;
    }

    /**
     * Checks if this instance is a pattern. It can either be a pattern or concrete.
     *
     * @return boolean True, if this instance is a pattern, false otherwise.
     */
    public function isPattern()
    {
        return false;
    }

    /**
     * Transform this Node instance to a n-quads string, if possible.
     *
     * @return string N-quads string representation of this instance.
     */
    public function toNQuads()
    {
        $string = '"' . $this->encodeStringLitralForNQuads($this->getValue()) . '"';

        if ($this->getLanguage() !== null) {
            $string .= '@' . $this->getLanguage();
        } elseif ($this->getDatatype() !== null) {
            $string .= '^^<' . $this->getDatatype() . '>';
        }

        return $string;
    }

    /**
     * @param string $s
     * @return string encoded string for n-quads
     */
    public function encodeStringLitralForNQuads($s)
    {
        $s = str_replace('\\', '\\\\', $s);
        $s = str_replace("\t", '\t', $s);
        $s = str_replace("\n", '\n', $s);
        $s = str_replace("\r", '\r', $s);
        $s = str_replace('"', '\"', $s);

        return $s;
    }
}
