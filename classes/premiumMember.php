<?php

class PremiumMember extends Member
{
    private $_inDoorInterests;
    private $_outDoorInterests;

    public function memberType()
    {
        return "prem";
    }
    /**
     * @return mixed
     */
    public function getInDoorInterests()
    {
        return $this->_inDoorInterests;
    }

    /**
     * @param mixed $_inDoorInterests
     */
    public function setInDoorInterests($_inDoorInterests)
    {
        $this->_inDoorInterests = $_inDoorInterests;
    }

    /**
     * @return mixed
     */
    public function getOutDoorInterests()
    {
        return $this->_outDoorInterests;
    }

    /**
     * @param mixed $_outDoorInterests
     */
    public function setOutDoorInterests($_outDoorInterests)
    {
        $this->_outDoorInterests = $_outDoorInterests;
    }

}