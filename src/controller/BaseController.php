<?php

namespace app\controller;

use app\component\Template;

class BaseController
{

    protected Template $template;

    public function __construct()
    {
        $this->template = new Template('./src/template');
    }

    public function toJson($data): string
    {
        header('Content-Type: application/json; charset=utf-8');
        if (is_array($data)){
            foreach ($data as $item) {
                if (is_object($item)) {
                    $result[] = $this->toArray($item);
                } else {
                    $result[] = $item;
                }
            }
        } else if (is_object($data)) {
            $result = $this->toArray($data);
        } else {
            $result = $data;
        }

        return \json_encode($result);
    }

    public function toXML($data): string
    {
        header('Content-Type: text/xml; charset=utf-8');
        $xml = new \SimpleXMLElement("<data></data>");

        $xml = $this->addXmlItem($xml, $data);

        return $xml->asXML();
    }

    private function addXmlItem($xml, $data, $key = null)
    {
        if (is_array($data)){
            $items = $xml->addChild(is_null($key) ? 'items' : $key);
            foreach ($data as $k => $item) {
                $items = $this->addXmlItem($items, $item);
            }
        } else if (is_object($data)) {
            $object = $this->toArray($data);
            $xmlObj = $xml->addChild(substr($data::class, strrpos($data::class, '\\') + 1));
            foreach ($object as $k => $v) {
                $xmlObj = $this->addXmlItem($xmlObj, $v, $k);
            }
        } else {
            $xml->addChild(is_null($key) ? 'item' : $key, is_bool($data) ? (int)$data : $data);
        }

        return $xml;
    }

    private function toArray($object) {
        $public = [];
        $reflection = new \ReflectionClass($object);
        foreach ($reflection->getProperties() as $property) {
            $property->setAccessible(true);
            $public[$property->getName()] = $property->getValue($object);
        }
        return $public;
    }
}