<?php

class PremiumMember extends member
{
    private $inDoorInterests;
    private $outDoorInterests;

    /**
     * PremiumMember constructor.
     * @param $inDoorInterests
     * @param $outDoorInterests
     */
    public function __construct($inDoorInterests, $outDoorInterests)
    {
        parent::__construct();
        $this->inDoorInterests = $inDoorInterests;
        $this->outDoorInterests = $outDoorInterests;
    }

    /**
     * @return mixed
     */
    public function getInDoorInterests()
    {
        return $this->inDoorInterests;
    }

    /**
     * @param mixed $inDoorInterests
     */
    public function setInDoorInterests($inDoorInterests)
    {
        $this->inDoorInterests = $inDoorInterests;
    }

    /**
     * @return mixed
     */
    public function getOutDoorInterests()
    {
        return $this->outDoorInterests;
    }

    /**
     * @param mixed $outDoorInterests
     */
    public function setOutDoorInterests($outDoorInterests)
    {
        $this->outDoorInterests = $outDoorInterests;
    }

}