<?php
namespace console\components;
use common\models\tables\Chat;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
class WsServer implements MessageComponentInterface
{
    protected $clients = [
    ];

    function onOpen(ConnectionInterface $conn)
    {
        $queryString = $conn->httpRequest->getUri()->getQuery();
        $channel = explode("=", $queryString)[1];
        echo $channel;
//        var_dump( $channel); exit;

        $this->clients[$channel][$conn->resourceId] = $conn;
        echo " - New connection: {$conn->resourceId}\n";
    }
    function onMessage(ConnectionInterface $from, $data)
    {
        $data = json_decode($data,true);
        $channel = $data['channel'];
        (new Chat($data))->save();

        foreach ($this->clients[$channel] as $client) {
            $client->send($data['message']);
        }
    }
    function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "user {$conn->resourceId} disconnect \n";
    }
    function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->close();
        echo "conn {$conn->resourceId} closed with error \n";
    }
}