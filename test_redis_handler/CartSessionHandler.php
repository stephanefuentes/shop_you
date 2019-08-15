<?php

/*
 * This file is part of the Predis package.
 *
 * (c) Daniele Alessandri <suppakilla@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// namespace Predis\Session;

// use Predis\ClientInterface;

/**
 * Session handler class that relies on Predis\Client to store PHP's sessions
 * data into one or multiple Redis servers.
 *
 * This class is mostly intended for PHP 5.4 but it can be used under PHP 5.3
 * provided that a polyfill for `SessionHandlerInterface` is defined by either
 * you or an external package such as `symfony/http-foundation`.
 *
 * @author stephane Fuentes <stephane.fuentes@yahoo.fr>
 */
class CartSessionHandler implements SessionHandlerInterface
{
    protected $client;
    protected $ttl;

    /**
     * @param array           $options Session handler options.
     */
    public function __construct( $client, array $options = array())
    {
        $this->client = $client;

        if (isset($options['gc_maxlifetime'])) {
            $this->ttl = (int) $options['gc_maxlifetime'];
        } else {
            $this->ttl = ini_get('session.gc_maxlifetime');
        }
    }


    


    /**
     * Registers this instance as the current session handler.
     */
    public function register()
    {
        if (PHP_VERSION_ID >= 50400) {
            session_set_save_handler($this, true);
        } else {
            session_set_save_handler(
                array($this, 'open'),
                array($this, 'close'),
                array($this, 'read'),
                array($this, 'write'),
                array($this, 'destroy'),
                array($this, 'gc')
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function open($save_path, $session_id)
    {
        // NOOP
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function close()
    {
        // NOOP
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function gc($maxlifetime)
    {
        // NOOP
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function read($session_id)
    {
        if ($data = $this->client->get($session_id)) {
            return $data;
        }

        return '';
    }

    
    /**
     * {@inheritdoc}
     */
    public function write($session_id, $session_data)
    {
        dump($session_data);
        // si j'ai envoyé $_SESSION['cart'] exécute
        $session = [];
        while ($session_data) {
            list($key, $value) = explode("|", $session_data, 2);
            //dd(explode("|", $session_data, 2));
            
            $session[$key] = unserialize($value);

            $session_data = substr($value, strlen(serialize($session[$key])));
        }
        //if ($session['cart'])
            $this->client->setex($session_id, $this->ttl, serialize($session['cart']));

            

        
        
        return true;
    }

    
    /**
     * {@inheritdoc}
     */
    public function destroy($session_id)
    {
        $this->client->del($session_id);

        return true;
    }

    /**
     * Returns the underlying client instance.
     *
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Returns the session max lifetime value.
     *
     * @return int
     */
    public function getMaxLifeTime()
    {
        return $this->ttl;
    }
}
