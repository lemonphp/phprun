<?php

namespace Lemon\PHPRun\Server;

use Lemon\PHPRun\Server\Configuration;
use Lemon\PHPRun\Server\Environment;

/**
 * Build server configuration
 */
class Builder
{
    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @var Environment
     */
    protected $env;

    /**
     * Construct
     *
     * @param Configuration $config
     * @param Environment   $env
     */
    public function __construct(Configuration $config, Environment $env)
    {
        $this->configuration = $config;
        $this->env = $env;

        $env->setAsProtected('server', [
            'name' => $config->getName(),
            'host' => $config->getHost(),
            'port' => $config->getPort(),
        ]);
    }

    /**
     * Define server host
     *
     * @param string $host
     * @return Builder
     */
    public function host($host)
    {
        $this->configuration->setHost($host);

        return $this;
    }

    /**
     * Define server port
     *
     * @param int $port
     * @return Builder
     */
    public function port($port)
    {
        $this->configuration->setPort($port);

        return $this;
    }

    /**
     * Define user name for authentication.
     *
     * @param string $name
     * @return Builder
     */
    public function user($name)
    {
        $this->configuration->setUser($name);

        return $this;
    }

    /**
     * Set password for connection
     *
     * @param string|null $password If you did not define password it will be asked on connection.
     *
     * @return Builder
     */
    public function password($password = null)
    {
        $this->configuration->setAuthenticationMethod(Configuration::AUTH_BY_PASSWORD);
        $this->configuration->setPassword($password);

        return $this;
    }

    /**
     * If you use an ssh config file you can user it.
     *
     * @param string $file Config file path
     *
     * @return Builder
     */
    public function configFile($file = '~/.ssh/config')
    {
        $this->configuration->setAuthenticationMethod(Configuration::AUTH_BY_CONFIG);
        $this->configuration->setConfigFile($file);

        return $this;
    }

    /**
     * Authenticate with public key
     *
     * @param string        $publicKeyFile
     * @param string        $privateKeyFile
     * @param string|null   $passPhrase
     * @return Builder
     */
    public function identityFile($publicKeyFile = '~/.ssh/id_rsa.pub', $privateKeyFile = '~/.ssh/id_rsa', $passPhrase = null)
    {
        $this->configuration->setAuthenticationMethod(Configuration::AUTH_BY_IDENTITY_FILE);
        $this->configuration->setPublicKey($publicKeyFile);
        $this->configuration->setPrivateKey($privateKeyFile);
        $this->configuration->setPassPhrase($passPhrase);

        return $this;
    }

    /**
     * Authenticate with pem file
     *
     * @param string $pemFile
     *
     * @return Builder
     */
    public function pemFile($pemFile)
    {
        $this->configuration->setAuthenticationMethod(Configuration::AUTH_BY_PEM_FILE);
        $this->configuration->setPemFile($pemFile);

        return $this;
    }

    /**
     * Using forward agent to authentication
     *
     * @return Builder
     */
    public function forwardAgent()
    {
        $this->configuration->setAuthenticationMethod(Configuration::AUTH_BY_AGENT);

        return $this;
    }

    /**
     * Enable two factor athentication feature and set token
     *
     * @return Builder
     */
    public function twoFactorAuth($enabled = true, $token = null)
    {
        if ($enabled) {
            $this->configuration->enable2FA();
            $this->configuration->set2FAToken($token);
        } else {
            $this->configuration->disable2FA();
        }

        return $this;
    }

    /**
     * Set env variable
     *
     * @param string           $name
     * @param array|int|string $value
     *
     * @return Builder
     */
    public function env($name, $value)
    {
        $this->env->set($name, $value);

        return $this;
    }

    /**
     * Indicate stage
     *
     * @param string|array $tags  Name or array on server stages.
     * @return Builder
     */
    public function tag($tags)
    {
        $this->env->set('stages', (array) $tags);

        return $this;
    }

    public function sudo($used)
    {
        return $this;
    }

    public function cwd($path)
    {
        return $this;
    }
}