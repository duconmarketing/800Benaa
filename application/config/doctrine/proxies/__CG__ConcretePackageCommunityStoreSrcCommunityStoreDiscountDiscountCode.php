<?php

namespace DoctrineProxies\__CG__\Concrete\Package\CommunityStore\Src\CommunityStore\Discount;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class DiscountCode extends \Concrete\Package\CommunityStore\Src\CommunityStore\Discount\DiscountCode implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', 'dcID', '' . "\0" . 'Concrete\\Package\\CommunityStore\\Src\\CommunityStore\\Discount\\DiscountCode' . "\0" . 'discountRule', 'dcCode', 'oID', 'dcDateAdded');
        }

        return array('__isInitialized__', 'dcID', '' . "\0" . 'Concrete\\Package\\CommunityStore\\Src\\CommunityStore\\Discount\\DiscountCode' . "\0" . 'discountRule', 'dcCode', 'oID', 'dcDateAdded');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (DiscountCode $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getID()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getID', array());

        return parent::getID();
    }

    /**
     * {@inheritDoc}
     */
    public function getCode()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCode', array());

        return parent::getCode();
    }

    /**
     * {@inheritDoc}
     */
    public function setCode($dcCode)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCode', array($dcCode));

        return parent::setCode($dcCode);
    }

    /**
     * {@inheritDoc}
     */
    public function getDiscountRule()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDiscountRule', array());

        return parent::getDiscountRule();
    }

    /**
     * {@inheritDoc}
     */
    public function setDiscountRule($discountRule)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDiscountRule', array($discountRule));

        return parent::setDiscountRule($discountRule);
    }

    /**
     * {@inheritDoc}
     */
    public function getOID()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOID', array());

        return parent::getOID();
    }

    /**
     * {@inheritDoc}
     */
    public function setOID($oID)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOID', array($oID));

        return parent::setOID($oID);
    }

    /**
     * {@inheritDoc}
     */
    public function getDateAdded()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDateAdded', array());

        return parent::getDateAdded();
    }

    /**
     * {@inheritDoc}
     */
    public function isUsed()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isUsed', array());

        return parent::isUsed();
    }

    /**
     * {@inheritDoc}
     */
    public function setDateAdded($dcDateAdded)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDateAdded', array($dcDateAdded));

        return parent::setDateAdded($dcDateAdded);
    }

    /**
     * {@inheritDoc}
     */
    public function save()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'save', array());

        return parent::save();
    }

    /**
     * {@inheritDoc}
     */
    public function delete()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'delete', array());

        return parent::delete();
    }

}
