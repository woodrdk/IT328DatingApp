<?php
/*
 * This class will allow users to create sign up premium member objects extending from
 * member objects this include allowing upload an image and include interests.
 *
 */
class PremiumMember extends Member
{
    private $_inDoorInterests;
    private $_outDoorInterests;


    /*
    * Overrides parent's membership type.
    * @return String of current user's membership type.
    */
    public function memberType()
    {
        return "prem";
    }

    /**
     * @return array of indoor interests of the user
     */
    public function getInDoorInterests()
    {
        return $this->_inDoorInterests;
    }

    /**
     * sets the users indoor interests
     * @param mixed $_inDoorInterests
     */
    public function setInDoorInterests($_inDoorInterests)
    {
        $this->_inDoorInterests = $_inDoorInterests;
    }

    /**
     * @return array of outdoor interests of the user
     */
    public function getOutDoorInterests()
    {
        return $this->_outDoorInterests;
    }

    /**
     *  sets the users outdoor interests
     * @param mixed $_outDoorInterests
     */
    public function setOutDoorInterests($_outDoorInterests)
    {
        $this->_outDoorInterests = $_outDoorInterests;
    }

}