<?php
if ($userID == $userid_pemilik) {
    $admins = dapatkan_admin($chat_id);
    foreach ($admins['result'] as $adminnn) {
        if ($adminnn['user']['id'] == ID_BOT) {
            $previelge = array(
                "is_anonymous" => var_to_str($adminnn['is_anonymous']),
                "can_change_info" => var_to_str($adminnn['can_change_info']),
                "can_post_messages" => var_to_str($adminnn['can_post_messages']),
                "can_edit_messages" => var_to_str($adminnn['can_edit_messages']),
                "can_delete_messages" => var_to_str($adminnn['can_delete_messages']),
                "can_invite_users" => var_to_str($adminnn['can_invite_users']),
                "can_restrict_members" => var_to_str($adminnn['can_restrict_members']),
                "can_pin_messages" => var_to_str($adminnn['can_pin_messages']),
                "can_promote_members" => var_to_str($adminnn['can_promote_members']),
            );
        }
    }

    $reply = substr(json_encode($previelge, JSON_PRETTY_PRINT), 0, 4000);
    $content = array('chat_id' => $chat_id, 'text' => $reply);
    $telegram->sendMessage($content);
}
