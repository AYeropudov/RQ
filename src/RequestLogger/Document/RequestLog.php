<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 08.07.16
 * Time: 15:51
 */
namespace RequestLogger\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document(collection="logs") */
class RequestLog
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="hash") */
    private $body;

    /** @ODM\Field(type="string") */
    private $URI;

    /** @ODM\Field(type="hash") */
    private $headers;

    /** @ODM\Field(type="string") */
    private $method;

    /** @ODM\Field(type="int") */
    private $userID;


    /** @ODM\Field(type="date") */
    private $createdAt;

    /* @return the $id */
    public function getId()
    {
        return $this->id;
    }

    /* @param field_type $id */
    public function setId($id)
    {
        $this->id = $id;
    }

    /* @return the $body */
    public function getBody()
    {
        return $this->body;
    }

    /* @param field_type $body */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /* @return the $URI */
    public function getURI()
    {
        return $this->URI;
    }

    /* @param string $URI */
    public function setURI($URI)
    {
        $this->URI = $URI;
    }

    /* @return the $createdAt */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /* @param date $createdAt */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /* @return the $headers */
    public function getHeaders()
    {
        return $this->headers;
    }

    /* @param hash $headers */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    /* @return the $method */
    public function getMethod()
    {
        return $this->method;
    }

    /* @param string $method */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /* @return the $userID */
    public function getUserID()
    {
        return $this->userID;
    }

    /* @param string $userID */
    public function setUserID($uid)
    {
        $this->userID = $uid;
    }

}
