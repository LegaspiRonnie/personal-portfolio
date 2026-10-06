<?php

require_once dirname(__DIR__, 3) . '/vendor/autoload.php';

use Ratchet\ConnectionInterface;
use Ratchet\Http\HttpServer;
use Ratchet\MessageComponentInterface;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

// Handles connections and echoes received messages back to all clients.
class EchoServer implements MessageComponentInterface
{
    private SplObjectStorage $clients;

    public function __construct()
    {
        $this->clients = new SplObjectStorage();
    }

    // Remember each new connection.
    public function onOpen(ConnectionInterface $connection): void
    {
        $this->clients->attach($connection);
        echo "Client connected: {$connection->resourceId}\n";
    }

    // Send each message to every connected client.
    public function onMessage(ConnectionInterface $from, $message): void
    {
        foreach ($this->clients as $client) {
            $client->send('Echo: ' . $message);
        }
    }

    // Forget connections when clients leave.
    public function onClose(ConnectionInterface $connection): void
    {
        $this->clients->detach($connection);
        echo "Client disconnected: {$connection->resourceId}\n";
    }

    // Log errors and close the affected connection.
    public function onError(ConnectionInterface $connection, \Exception $error): void
    {
        fwrite(STDERR, "WebSocket error: {$error->getMessage()}\n");
        $connection->close();
    }
}

// Run this file from the command line to start the WebSocket server.
$server = IoServer::factory(
    new HttpServer(new WsServer(new EchoServer())),
    8080,
);

echo "WebSocket server listening at ws://127.0.0.1:8080\n";
$server->run();
