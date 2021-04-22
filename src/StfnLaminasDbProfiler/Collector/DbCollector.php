<?php
namespace StfnLaminasDbProfiler\Collector;

use Laminas\Mvc\MvcEvent;
use Laminas\Db\Adapter\Profiler\Profiler;
use Laminas\DeveloperTools\Collector\CollectorInterface;

class DbCollector
    implements CollectorInterface
{
    protected $profilers = [];

    public function getName() : string
    {
        return 'StfnLaminasDbProfiler';
    }

    public function getPriority() : int
    {
        return 20;
    }

    public function collect(MvcEvent $mvcEvent) : void
    {
    }

    public function getQueryCount($queryType = null) : int
    {
        $profiles = $this->getProfiles();

        $count = 0;

        if(null == $queryType) {
            $count = count($profiles);
        } elseif('other' == strtolower($queryType)) {
            foreach ($profiles as $profile) {
                if(!preg_match('@(^SELECT|^UPDATE|^DELETE|^INSERT)@i', trim($profile['sql']))) {
                    $count++;
                }
            }
        } else {
            foreach ($profiles as $profile) {
                if(preg_match('|^' . $queryType . '|i', trim($profile['sql']))) {
                    $count++;
                }
            }
        }


        return $count;
    }

    public function getQueryTime($queryType = null) : int
    {
        $profiles = $this->getProfiles();

        $time = 0;

        if(null == $queryType) {
            foreach($profiles as $profile) {
                $time = $time + $profile['elapse'];
            }
        } elseif('other' == strtolower($queryType)) {
            foreach ($profiles as $profile) {
                if(!preg_match('@(^SELECT|^UPDATE|^DELETE|^INSERT)@i', trim($profile['sql']))) {
                    $time = $time + $profile['elapse'];
                }
            }
        } else {
            foreach ($profiles as $profile) {
                if(preg_match('|^' . $queryType . '|i', trim($profile['sql']))) {
                    $time = $time + $profile['elapse'];
                }
            }
        }

        return $time;
    }

    /**
     * @param string $adapterName
     * @param Profiler $profiler
     */
    public function addProfiler(string $adapterName, Profiler $profiler) : void
    {
        $this->profilers[$adapterName] = $profiler;
    }

    /**
     * @return Profiler[]
     */
    public function getProfilers() : array
    {
        return $this->profilers;
    }

    /**
     * @return boolean
     */
    public function hasProfiler() : bool
    {
        return (1 <= count($this->profilers)) ? true : false;
    }

    /**
     * @return array
     */
    public function getProfiles() : array
    {
        $profiles = [];

        foreach($this->getProfilers() as $adapterServiceKey => $profiler) {
            foreach($profiler->getProfiles() as $query) {
                $query['adapterServiceKey'] = $adapterServiceKey;
                $profiles[] = $query;
            }
        }

        usort($profiles, function($a, $b){
            if ($a['start'] == $b['start']) {
                return 0;
            }
                return ($a['start'] < $b['start']) ? -1 : 1;
        });

        return $profiles;
    }
}