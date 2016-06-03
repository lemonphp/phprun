<?php

namespace Lemon\PHPRun\Server;

use Lemon\PHPRun\Utils\Path;

class Configuration
{

    const AUTH_BY_PASSWORD = 0;
    const AUTH_BY_CONFIG = 1;
    const AUTH_BY_IDENTITY_FILE = 2;
    const AUTH_BY_PEM_FILE = 3;
    const AUTH_BY_AGENT = 4;

    /**
     * Type of authentication.
     * By default try to connect via password authentication
     *
     * @var int
     */
    private $authenticationMethod = self::AUTH_BY_PASSWORD;

    /**
     * Enabled two factor authentication feature flag
     *
     * @var bool
     */
    private $twoFactorAuthEnabled = false;

    /**
     * Used for authentication with two factor authentication
     *
     * @var string
     */
    private $twoFactorAuthToken;

    /**
     * Server name
     *
     * @var string
     */
    private $name;

    /**
     * Server host.
     *
     * @var string
     */
    private $host;

    /**
     * Server port.
     *
     * @var int
     */
    private $port;

    /**
     * User of remote server.
     *
     * @var string
     */
    private $user;

    /**
     * Used for authentication with password.
     *
     * @var string
     */
    private $password;

    /**
     * Used for authentication with config file.
     *
     * @var string
     */
    private $configFile;

    /**
     * Used for authentication with public key.
     *
     * @var string
     */
    private $publicKey;

    /**
     * Used for authentication with public key.
     *
     * @var string
     */
    private $privateKey;

    /**
     * Used for authentication with public key.
     *
     * @var string
     */
    private $passPhrase;

    /**
     * Pem file.
     *
     * @var string
     */
    private $pemFile;

    /**
     * Construct
     *
     * @param string $name
     * @param string $host
     * @param int    $port
     */
    public function __construct($name, $host, $port = 22)
    {
        $this->setName($name);
        $this->setHost($host);
        $this->setPort($port);
        $this->disable2FA();
    }

    /**
     * Get authentication method
     *
     * @return int
     */
    public function getAuthenticationMethod()
    {
        return $this->authenticationMethod;
    }

    /**
     * Set authentication method
     *
     * @param int $authenticationMethod
     * @return Configuration
     */
    public function setAuthenticationMethod($authenticationMethod)
    {
        $this->authenticationMethod = $authenticationMethod;

        return $this;
    }

    /**
     * Enable 2-Factor authentication feature
     *
     * @return Configuration
     */
    public function enable2FA()
    {
        $this->twoFactorAuthEnabled = true;

        return $this;
    }

    /**
     * Disable 2-Factor authentication feature
     *
     * @return Configuration
     */
    public function disable2FA()
    {
        $this->twoFactorAuthEnabled = false;

        return $this;
    }

    /**
     * Check 2-Factor authentication is enabled
     *
     * @return bool
     */
    public function enabled2FA()
    {
        return $this->twoFactorAuthEnabled;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Configuration
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get host for connection
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set host for connection
     *
     * @param string $host
     * @return Configuration
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get port
     *
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set port for connection
     *
     * @param int $port
     * @return Configuration
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param string $user
     * @return Configuration
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get password for connection
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->getRealPassword($this->password);
    }

    /**
     * Set password for connection
     *
     * @param string $password
     * @return Configuration
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get configuration file
     *
     * @return string
     */
    public function getConfigFile()
    {
        return $this->configFile;
    }

    /**
     * Set configuration file
     *
     * @param string $configFile
     * @return Configuration
     */
    public function setConfigFile($configFile)
    {
        $this->configFile = Path::parseHomeDir($configFile);

        return $this;
    }

    /**
     * Get public key
     *
     * @return string
     */
    public function getPublicKey()
    {
        return $this->publicKey;
    }

    /**
     * Set public key
     *
     * @param string $path
     * @return Configuration
     */
    public function setPublicKey($path)
    {
        $this->publicKey = Path::parseHomeDir($path);

        return $this;
    }

    /**
     * Get private key
     *
     * @return string
     */
    public function getPrivateKey()
    {
        return $this->privateKey;
    }

    /**
     * Set private key
     *
     * @param string $path
     * @return Configuration
     */
    public function setPrivateKey($path)
    {
        $this->privateKey = Path::parseHomeDir($path);

        return $this;
    }

    /**
     * Get pass phrase
     *
     * @return string
     */
    public function getPassPhrase()
    {
        return $this->passPhrase;
    }

    /**
     * Set pass phrase
     *
     * @param string $passPhrase
     * @return Configuration
     */
    public function setPassPhrase($passPhrase)
    {
        $this->passPhrase = $passPhrase;

        return $this;
    }

    /**
     * Get pem file
     *
     * @return string
     */
    public function getPemFile()
    {
        return $this->pemFile;
    }

    /**
     * To auth with pem file use pemFile() method instead of this.
     *
     * @param string $pemFile
     * @return Configuration
     */
    public function setPemFile($pemFile)
    {
        $this->pemFile = Path::parseHomeDir($pemFile);

        return $this;
    }

    /**
     * Get two factor authentication token
     *
     * @return string
     */
    public function get2FAToken()
    {
        return $this->twoFactorAuthToken;
    }

    /**
     * Set two factor authentication token
     *
     * @param string|null $token
     * @return Configuration
     */
    public function set2FAToken($token = null)
    {
        $this->twoFactorAuthToken = $token;

        return $this;
    }
}