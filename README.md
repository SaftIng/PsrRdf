# Repository for the PSR\RDF candidate

Based on the following specification: https://github.com/SaftIng/fig-standards/blob/psr-rdf/proposed/rdf/rdf.md

|     Interface     |      According Class       |
|:-----------------:|:--------------------------:|
|       Node        |             -              |
|     BlankNode     |       BlankNodeImpl        |
|      Literal      |        LiteralImpl         |
|     NamedNode     |       NamedNodeImpl        |
|     Statement     |       StatementImpl        |
|    NodeFactory    |      NodeFactoryImpl       |
|         -         |       AnyPatternImpl       |
| StatementIterator | ArrayStatementIteratorImpl |

## Acknowledgement

All interfaces and classes are originally from the [Saft](https://github.com/SaftIng/Saft/tree/master/src/Saft/Rdf) project.
