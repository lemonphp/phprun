<?php

namespace Lemon\PHPRun\Server;

interface ServerInterface
{
    /**
     * Get server's configuration
     *
     * @return \Lemon\PHPRun\Server\Configuration
     */
    public function getConfiguration();

    /**
     * Connect to server.
     *
     * @return void
     * @throws \RuntimeException when connect error
     */
    public function connect();

    /**
     * Check server is connected
     *
     * @return bool
     */
    public function isConnected();

    /**
     * Run shell command on remote server.
     *
     * @param string $command   Shell command to run
     * @param int    $timeout   Time out
     * @return string           Output of command.
     * @throws \RuntimeException when shell command has error
     */
    public function run($command, $timeout = 60);

    /**
     * Upload file to remote server.
     *
     * @param string $local     Local path to file.
     * @param string $remote    Remote path where upload.
     * @return void
     * @throws \RuntimeException when upload failure
     */
    public function upload($local, $remote);

    /**
     * Download file from remote server.
     *
     * @param string $local     Where to download file on local machine.
     * @param string $remote    Which file to download from remote server.
     * @throws \RuntimeException when download failure
     */
    public function download($local, $remote);
}