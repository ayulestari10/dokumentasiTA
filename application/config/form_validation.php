<?php
$config = array(
    array(
        'field' => 'username',
        'label' => 'Username',
        'rules' => 'required|min_length[14]|max_length[18]|alpha_numeric'
    ),
    array(
        'field' => 'password',
        'label' => 'Password',
        'rules' => 'required'
    ),
    array(
        'field' => 'max_text_field',
        'label' => 'Text Field Three',
        'rules' => 'required|max_length[20]'
    )
);


?>