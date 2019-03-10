<?php
class TestCurlGroup extends RollingCurlGroup {
    function process($output, $info, $request) {
        //echo "Group CB: Progress " . $this->name . " (" . ($this->finished_requests + 1) . "/" . $this->num_requests . ")<br>";
        parent::process($output, $info, $request);
    }

    function finished() {
        //echo "Group CB: Finished" . $this->name . "<br>";
        parent::finished();
    }
}
?>