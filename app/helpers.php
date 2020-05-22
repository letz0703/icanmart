<?php

function avatar_url($email){
    $email = md5($email);
    //return "https://avatar.com/{$email}?s=60&d='https://s3.amazoneaws.com/laracasts/images/default-square-avatar.jpg'";

    return  "https://avatar.com/{$email}".http_build_query([
            's' => 60,
            'd' => 'https://s3.amazoneaws.com/laracasts/images/default-square-avatar.jpg'
        ]);
}
