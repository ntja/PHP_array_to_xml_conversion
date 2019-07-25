/**
 * convert array to xml
 * @param array $data
 * @param string $root
 * @return \SimpleXMLElement
 */
function arrayToXml($data, $root = null){                
    $dom = new \DOMImplementation();
    $document = $dom->createDocument(
            null, 
            $root,
            $dom->createDocumentType(
                $root,
                "-//Ocam//DTD XML Command 1.0//EN",
                "xml/command.dtd"
            )
        );
    $document->formatOutput = false;
    $html = $document->documentElement;
    array_walk_recursive($data, function($value, $key) use ($document, $html){
       $node =  $document->createElement(strtoupper($key));
        $node_value = $document->createTextNode($value);
        $node->appendChild($node_value);
        $html->appendChild($node);
    });
    $xml = $document->saveXML();        
    return $xml;
}
