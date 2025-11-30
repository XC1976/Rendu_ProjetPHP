<?php

function verifyIfUserConnected() {
    if(isset($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
}