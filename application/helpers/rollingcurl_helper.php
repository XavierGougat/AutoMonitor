<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('rcurl_domains'))
{
    function rcurl_domains($urls)
    {
        $s = microtime(true);

        $group = new TestCurlGroup("domains");
        foreach($urls as $url){
            $group->add(new TestCurlRequest($url['monitorAdress']."?monitorid=".$url['monitorId']));
        }
        $reqs[] = $group;

        // No callback here, as its done in Request class
        $rc = new GroupRollingCurl("monitorCallback");

        foreach ($reqs as $req)
            $rc->add($req);

        $rc->execute();
    }
    
    function monitorCallback($response, $info, $request){
        $ci =& get_instance();
        $ci->insertLogs($info, $request);
    }
}