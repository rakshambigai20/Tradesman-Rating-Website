<?php
class Querry {
    private $name;
    private $email;
    private $comments;

    public function __construct($name, $email, $comments) {
        $this->name = $name;
        $this->email = $email;
        $this->comments = $comments;
    }

    public function replyQuerry() {
        error_reporting(0);
        if (!empty($this->name) && !empty($this->email) && !empty($this->comments)) {
            $body = "Name: " . $this->name . "\n\nComments: " . $this->comments;
            $body = wordwrap($body, 70);
            mail('balaraman.m2005@gmail.com', 'Contact Form Submission', $body, "From: " . $this->email);
            echo '<p><em>Thank you for contacting raters.co.uk. We will respond to your enquiry in 48 hours.</em></p>';
            $_POST = array();
        } else {
            echo '<p style="font-weight: bold; color: red">Please fill out the form completely.</p>';
        }
    }
}
?>
