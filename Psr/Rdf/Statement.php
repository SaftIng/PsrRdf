<?php

namespace Psr\Rdf;

/**
 * This interface is common for RDF statement. It can represent a 3- or 4-tuple. A 3-tuple (triple) consists
 * of subject, predicate and object, whereas a 4-tuple (quad) is a 3-tuple with a graph.
 */
interface Statement
{
    /**
     * Returns Statements subject.
     *
     * @return Node Subject node.
     */
    public function getSubject();

    /**
     * Returns Statements predicate.
     *
     * @return Node Predicate node.
     */
    public function getPredicate();

    /**
     * Returns Statements object.
     *
     * @return Node Object node.
     */
    public function getObject();

    /**
     * Returns Statements graph, if available.
     *
     * @return Node|null Graph node, if available.
     */
    public function getGraph();

    /**
     * Determines if this statement contains graph information.
     *
     * @return boolean True, if this statement consists of subject, predicate, object and graph, false otherwise.
     */
    public function isQuad();

    /**
     * Determines if this statement contains no graph information.
     *
     * @return boolean True, if this statement consists of subject, predicate and object,
     *                 but no graph, false otherwise.
     */
    public function isTriple();

    /**
     * Checks if this statement contains no pattern.
     *
     * @return boolean True, if neither subject, predicate, object nor, if available, graph, are patterns,
     *                 false otherwise.
     */
    public function isConcrete();

    /**
     * Checks if this statement contains a pattern.
     *
     * @return boolean True, if at least subject, predicate, object or, if available, graph, are patterns,
     *                 false otherwise.
     */
    public function isPattern();

    /**
     * Get a valid NQuads serialization of the statement. If the statement is not concrete because
     * it contains pattern, this method has to throw an exception.
     *
     * @throws \Exception if the statment is not concrete
     * @return string a string representation of the statement in valid NQuads syntax.
     */
    public function toNQuads();

    /**
     * Get a string representation of the current statement. It should contain a human readable description of the parts
     * of the statement.
     *
     * @return string A string representation of the statement.
     */
    public function __toString();

    /**
     * Returns true, if the given argument matches the is statement-pattern.
     *
     * @param Statement $toCompare the statement to where this pattern shoul be applied to.
     */
    public function matches(Statement $toCompare);

    /**
     * Checks if a given Statement instance is equal to this instance.
     *
     * @param Statement $toCompare the statement to compare with
     * @return boolean True, if the given Statement instance is equal to this one.
     */
    public function equals(Statement $toCompare);
}
