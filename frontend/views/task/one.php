<?php
/** @var \common\models\tables\Tasks $model */
/** @var \common\models\tables\Chat[] $history */
?>

<form action="#" name="chat_form" id="chat_form">
    <label>
        введите сообщение
        <input type="hidden" name="channel" value="<?= $channel ?>">
        <input type="hidden" name="user_id" value="<?= Yii::$app->user->getId() ?>">
        <input type="text" name="message">
        <input type="submit">
    </label>

</form>
<hr>

<div id="root_chat">
    <?php foreach ($history as $msg): ?>
        <div><?= $msg->message ?></div>
    <?php endforeach; ?>
</div>

<script>
    if (!window.WebSocket) {
        alert("Ваш браузер не поддерживает цеб-сокеты");
    }
    // var webSocket = new WebSocket("ws://front.task.local/chat:8080");
    let webSocket = new WebSocket("ws://front.yii.local:8080?channel=<?=$channel?>");
    // let webSocket = new WebSocket("ws://front.task.local:8080");
    document.getElementById("chat_form")
        .addEventListener('submit', function (event) {
            // event.preventDefault();
            let data = {
                message: this.message.value,
                channel: this.channel.value,
                // user_id: this.user_id.value
                user_id: this.user_id.value
            };
            webSocket.send(JSON.stringify(data));
            event.preventDefault();
            console.log(data);
            return false;
        });
    webSocket.onmessage = function (event) {
        let data = event.data;
        let messageContainer = document.createElement('div');
        let textNode = document.createTextNode(data);
        messageContainer.appendChild(textNode);
        document.getElementById("root_chat")
            .appendChild(messageContainer);
    };
</script>