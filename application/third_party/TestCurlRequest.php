<?php
class TestCurlRequest extends RollingCurlGroupRequest {
    public $test_verbose = true;

    function process($output, $info) {
        parent::process($output, $info);
    }
}
?>