<?php
namespace StefanoDbProfiler\Options;

use Laminas\Stdlib\AbstractOptions;

class ModuleOptions
    extends AbstractOptions
{
    private $dbAdapterServiceManagerKey = [];

    /**
     * @param array|string $keyName
     */
    public function setDbAdapterServiceManagerKey($keyName) {
        $this->dbAdapterServiceManagerKey = (array) $keyName;
    }

    /**
     * @return array
     */
    public function getDbAdapterServiceManagerKey() {
        return $this->dbAdapterServiceManagerKey;
    }
}
