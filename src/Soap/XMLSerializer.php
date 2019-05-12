<?php
namespace Tanvir\Sabre\Soap;

class XMLSerializer {
    // functions adopted from http://www.sean-barton.co.uk/2009/03/turning-an-array-or-object-into-xml-using-php/

    public static function generateValidXmlFromArray($array, $node_block='nodes', $node_name='node') {
        $xml = self::generateXmlFromArray($array, $node_name);
        return $xml;
    }

    private static function generateXmlFromArray($array, $node_name) {
        $xml = '';

        if ((is_array($array) || is_object($array))) {
            foreach ($array as $key=>$value) {
                if (is_numeric($key)) {
                    $key = $node_name;
                }
                if ($key != '_namespace' && $key != '_attributes' && $key != '_value') {
                    $xml .= '<' . $key .self::generateAttributesFromArray($value)
                        .self::generateNamespace($value)
                            . '>' 
                            . self::generateXmlFromArray($value, $node_name) . '</' . $key . '>';
                }
                if ($key == '_value') {
                    $xml = htmlspecialchars($value, ENT_QUOTES);
                }
            }
        } else {
            $xml = htmlspecialchars($array, ENT_QUOTES);
        }

        return $xml;
    }
    
    private static function generateAttributesFromArray($array) {
        if (isset($array['_attributes']) && is_array($array['_attributes'])) {
            
            $attributes = ' ';
            foreach ($array['_attributes'] as $key=>$value) {
                $attributes .= $key.'="'.$value.'" ';
            }
            return $attributes;
        } else {
            return '';
        }
    }
    
    private static function generateNamespace($namespace) {
        if (isset($namespace['_namespace']) && $namespace['_namespace']) {
            return ' xmlns="'.$namespace['_namespace'].'"';
        } else {
            return '';
        }
    }

}
