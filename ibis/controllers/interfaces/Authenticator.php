<?php
    interface Authenticator {
        public function authenticate();
        public function getAuthenticatedUser();
    }
?>