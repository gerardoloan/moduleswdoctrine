<?php

namespace ZfModule\Options;

use Zend\Stdlib\AbstractOptions;

/**
 * Description of ModuleOptions
 *
 * @author gerard
 */
class ModuleOptions extends AbstractOptions {

    protected $moduleEntityClass;
    protected $tagEntityClass;
    protected $moduleIndexPath;

    public function setModuleEntityClass($string) {
        $this->moduleEntityClass = $string;
        return $this;
    }

    public function getModuleEntityClass() {
        return $this->moduleEntityClass = $string;
    }

    public function setTagEntityClass($string) {
        $this->tagEntityClass = $string;
        return $this;
    }

    public function getTagEntityClass() {
        return $this->tagEntityClass = $string;
    }

    public function getTagIndexPath() {
        return $this->getBaseSearchIndexPath() . '/tag';
    }
    public function getModuleIndexPath() {
        return $this->getBaseSearchIndexPath() . '/module';
    }
    public function getBaseSearchIndexPath(){
        $path = dirname(__FILE__); // should be /zfmodule/src/zfmodules/options
        $path .= '/../../../../../'; //go back
        $path .= 'data/search';
        return $path;
    }

    public function setModuleIndexPath($path) {
        $this->moduleIndexPath = $path;
        return $this;
    }

}

?>