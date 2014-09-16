<?php
/**
 * slince cache component
 * @author Taosikai <taosikai@yeah.net>
 */
namespace Slince\Cache;

class Cache
{

    /**
     * 处理句柄
     *
     * @var HandlerInterface
     */
    protected $_handler;

    /**
     * 默认的缓存时间
     *
     * @var int
     */
    protected $_duration = 3600;

    function __construct(HandlerInterface $handler)
    {
        $this->setHandler($handler);
    }

    /**
     * 设置处理器
     *
     * @param HandlerInterface $handler            
     */
    function setHandler(HandlerInterface $handler)
    {
        $this->_handler = $handler;
    }

    /**
     * 获取处理器
     *
     * @return HandlerInterface
     */
    function getHandler()
    {
        return $this->_handler;
    }

    /**
     * 设置默认的缓存时间
     *
     * @param int $duration            
     */
    function setDuration($duration)
    {
        $this->_duration = $duration;
    }

    /**
     * 获取默认的缓存时间
     *
     * @return int
     */
    function getDuration()
    {
        return $this->_duration;
    }

    /**
     * 设置一个值
     *
     * @param string $key            
     * @param mixed $value            
     * @param int $duration            
     * @return boolean
     */
    function set($key, $value, $duration = null)
    {
        if (is_null($duration)) {
            $duration = $this->_duration;
        }
        return $this->_handler->set($key, $value, $duration);
    }

    /**
     * 如果不存在则设置一个新值
     *
     * @param string $key            
     * @param mixed $value            
     * @param int $duration            
     * @return boolean
     */
    function add($key, $value, $duration = null)
    {
        if (is_null($duration)) {
            $duration = $this->_duration;
        }
        return $this->_handler->add($key, $value, $duration);
    }

    /**
     * 判断一个值是否存在
     *
     * @param string $key            
     * @return boolean
     */
    function exists($key)
    {
        return $this->_handler->exists($key);
    }

    /**
     * 获取一个值
     *
     * @param unknown $key            
     * @param string $defaultValue            
     * @return mixed
     */
    function get($key, $defaultValue = null)
    {
        $value = $this->_handler->get($key);
        return ($value === false) ? $defaultValue : $value;
    }

    /**
     * 删除一个值
     *
     * @param string $key            
     * @return boolean
     */
    function delete($key)
    {
        return $this->_handler->delete($key);
    }

    /**
     * 清空储存区
     */
    function flush()
    {
        $this->_handler->flush();
    }
}