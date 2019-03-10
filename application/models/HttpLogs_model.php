<?php
class httpLogs_model extends CI_Model{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function OLDinserthttpLogs($data)
    {
        $this->db->insert('httpLogs', $data);
        return $this->db->insert_id();
    }

    function inserthttpLogs($data){
        /*$query = $this->db->query('INSERT into httpLogs (monitorId, url, statusCode, loadTime) SELECT id,"'.$data['url'].'",'.$data['statusCode'].','.$data['loadTime'].' from monitor where adress="'.$data['url'].'"');*/
        $query = $this->db->query('INSERT into httpLogs (monitorId, url, statusCode, loadTime) VALUES ("'.$data['monitorId'].'","'.$data['url'].'",'.$data['statusCode'].','.$data['loadTime'].')');
        
        $id = $this->db->insert_id();
        $q = $this->db->get_where('httpLogs', array('id' => $id));
        return $q->row();
    }

    function overallUptime($monitorId){
        $query = $this->db->query('select ROUND(((select SUM(IFNULL(duration,UNIX_TIMESTAMP(now()) - UNIX_TIMESTAMP(dateTime))) from monitorEvents where monitorId = '.$monitorId.' and lastStatus in (select code from httpCodes where status!="down"))*100/TIMESTAMPDIFF(SECOND,addDate,NOW())),2) as `Percentage` from monitor where id = '.$monitorId.';');
        $result = $query->result_array();
        return $result[0]; 
    }

    function dayUptime($monitorId){
        $query = $this->db->query('select ROUND(100-((select SUM(IFNULL(duration,UNIX_TIMESTAMP(now()) - UNIX_TIMESTAMP(dateTime))) from monitorEvents where monitorId = '.$monitorId.' and lastStatus in (select code from httpCodes where status="down") and dateTime >= NOW()-INTERVAL 1 DAY)*100/TIMEDIFF(TIMEDIFF(NOW(),NOW()-INTERVAL 1 DAY), COALESCE(NULLIF (ABS(TIMEDIFF(addDate,NOW()-INTERVAL 1 DAY)), -TIMEDIFF(addDate,NOW()-INTERVAL 1 DAY)), 0))),2) as `Percentage` from monitor where id = '.$monitorId.';');
        $result = $query->result_array();
        return $result[0]; 
    }

    function weekUptime($monitorId){
        $query = $this->db->query('select ROUND(100-((select SUM(IFNULL(duration,UNIX_TIMESTAMP(now()) - UNIX_TIMESTAMP(dateTime))) from monitorEvents where monitorId = '.$monitorId.' and lastStatus in (select code from httpCodes where status="down") and dateTime >= NOW()-INTERVAL 1 WEEK)*100/TIMEDIFF(TIMEDIFF(NOW(),NOW()-INTERVAL 1 WEEK), COALESCE(NULLIF (ABS(TIMEDIFF(addDate,NOW()-INTERVAL 1 WEEK)), -TIMEDIFF(addDate,NOW()-INTERVAL 1 WEEK)), 0))),2) as `Percentage` from monitor where id = '.$monitorId.';');
        $result = $query->result_array();
        return $result[0]; 
    }

    function monthUptime($monitorId){
        $query = $this->db->query('select ROUND(100-((select SUM(IFNULL(duration,UNIX_TIMESTAMP(now()) - UNIX_TIMESTAMP(dateTime))) from monitorEvents where monitorId = '.$monitorId.' and lastStatus in (select code from httpCodes where status="down") and dateTime >= NOW()-INTERVAL 1 MONTH)*100/TIMEDIFF(TIMEDIFF(NOW(),NOW()-INTERVAL 1 MONTH), COALESCE(NULLIF (ABS(TIMEDIFF(addDate,NOW()-INTERVAL 1 MONTH)), -TIMEDIFF(addDate,NOW()-INTERVAL 1 MONTH)), 0))),2) as `Percentage` from monitor where id = '.$monitorId.';');
        $result = $query->result_array();
        return $result[0]; 
    }

    function overallUptimeUser($userId){
        $query = $this->db->query('select ROUND(SUM(100-((select SUM(IFNULL(duration,UNIX_TIMESTAMP(now()) - UNIX_TIMESTAMP(dateTime))) from monitorEvents where monitorId in (select monitorId from supervise where userId='.$userId.') and lastStatus in (select code from httpCodes where status="up"))*100/(TIMEDIFF(NOW(),addDate))))/(select count(*) from supervise where userId = '.$userId.'),2) as `Percentage` from monitor where id in (select monitorId from supervise where userId='.$userId.')');
        $result = $query->result_array();
        return $result[0]; 
    }

    function dayUptimeUser($userId,$time){
        $query = $this->db->query('select IFNULL(ROUND(SUM((select SUM(IFNULL(duration,UNIX_TIMESTAMP("'.$time.'") - UNIX_TIMESTAMP(dateTime))) from monitorEvents where monitorId in (select monitorId from supervise where userId='.$userId.') and lastStatus in (select code from httpCodes where status="up") and dateTimeRefresh >= "'.$time.'"-INTERVAL 1 DAY)*100/TIMEDIFF(TIMEDIFF("'.$time.'","'.$time.'"-INTERVAL 1 DAY), COALESCE(NULLIF (ABS(TIMEDIFF(addDate,"'.$time.'"-INTERVAL 1 DAY)), -TIMEDIFF(addDate,"'.$time.'"-INTERVAL 1 DAY)), 0)))/(select count(*) from supervise where userId='.$userId.'),2),0) as `Percentage` from monitor where id in (select monitorId from supervise where userId='.$userId.');');
        $result = $query->result_array();
        return $result[0]; 
    }

    function weekUptimeUser($userId,$time){
        $query = $this->db->query('select IFNULL(ROUND(100-(SUM((select SUM(IFNULL(duration,UNIX_TIMESTAMP("'.$time.'") - UNIX_TIMESTAMP(dateTime))) from monitorEvents where monitorId in (select monitorId from supervise where userId='.$userId.') and lastStatus in (select code from httpCodes where status="down") and dateTimeRefresh >= "'.$time.'"-INTERVAL 1 WEEK)*100/TIMEDIFF(TIMEDIFF("'.$time.'","'.$time.'"-INTERVAL 1 WEEK), COALESCE(NULLIF (ABS(TIMEDIFF(addDate,"'.$time.'"-INTERVAL 1 WEEK)), -TIMEDIFF(addDate,"'.$time.'"-INTERVAL 1 WEEK)), 0))))/(select count(*) from supervise where userId='.$userId.'),2),100) as `Percentage` from monitor where id in (select monitorId from supervise where userId='.$userId.');');
        $result = $query->result_array();
        return $result[0]; 
    }

    function monthUptimeUser($userId,$time){
        $query = $this->db->query('select IFNULL(ROUND(100-(SUM((select SUM(IFNULL(duration,UNIX_TIMESTAMP("'.$time.'") - UNIX_TIMESTAMP(dateTime))) from monitorEvents where monitorId in (select monitorId from supervise where userId='.$userId.') and lastStatus in (select code from httpCodes where status="down") and dateTimeRefresh >= "'.$time.'"-INTERVAL 1 MONTH)*100/TIMEDIFF(TIMEDIFF("'.$time.'","'.$time.'"-INTERVAL 1 MONTH), COALESCE(NULLIF (ABS(TIMEDIFF(addDate,"'.$time.'"-INTERVAL 1 MONTH)), -TIMEDIFF(addDate,"'.$time.'"-INTERVAL 1 MONTH)), 0))))/(select count(*) from supervise where userId='.$userId.'),2),100) as `Percentage` from monitor where id in (select monitorId from supervise where userId='.$userId.');');
        $result = $query->result_array();
        return $result[0]; 
    }

    function getOverallDuration($userId){
        $query = $this->db->query('select sum(IFNULL(duration,UNIX_TIMESTAMP(now()) - UNIX_TIMESTAMP(monitorEvents.dateTime))) as `Duration` from monitorEvents
        inner join httpCodes on httpCodes.code = monitorEvents.lastStatus
        inner join supervise on supervise.monitorId = monitorEvents.monitorId
        where httpCodes.status != "started"
        and supervise.userId = '.$userId.';');
        $result = $query->result_array();
        return $result[0]; 
    }

    function getOverallUpDuration($userId){
        $query = $this->db->query('select sum(IFNULL(duration,UNIX_TIMESTAMP(now()) - UNIX_TIMESTAMP(monitorEvents.dateTime))) as `Duration` from monitorEvents
        inner join httpCodes on httpCodes.code = monitorEvents.lastStatus
        inner join supervise on supervise.monitorId = monitorEvents.monitorId
        where httpCodes.status = "up"
        and supervise.userId = '.$userId.';');
        $result = $query->result_array();
        return $result[0]; 
    }

    function getDayDuration($userId){
        $query = $this->db->query('select sum(IFNULL(duration,UNIX_TIMESTAMP(now()) - UNIX_TIMESTAMP(monitorEvents.dateTimeRefresh))) as `Duration` from monitorEvents
        inner join httpCodes on httpCodes.code = monitorEvents.lastStatus
        inner join supervise on supervise.monitorId = monitorEvents.monitorId
        where httpCodes.status != "started"
        and supervise.userId = '.$userId.'
        and monitorEvents.dateTimeRefresh >= now()-INTERVAL 1 DAY;');
        $result = $query->result_array();
        return $result[0]; 
    }

    function getDayUpDuration($userId){
        $query = $this->db->query('select sum(IFNULL(duration,UNIX_TIMESTAMP(now()) - UNIX_TIMESTAMP(monitorEvents.dateTimeRefresh))) as `Duration` from monitorEvents
        inner join httpCodes on httpCodes.code = monitorEvents.lastStatus
        inner join supervise on supervise.monitorId = monitorEvents.monitorId
        where httpCodes.status = "up"
        and supervise.userId = '.$userId.'
        and monitorEvents.dateTimeRefresh >= now()-INTERVAL 1 DAY;');
        $result = $query->result_array();
        return $result[0]; 
    }

    function getWeekDuration($userId){
        $query = $this->db->query('select sum(IFNULL(duration,UNIX_TIMESTAMP(now()) - UNIX_TIMESTAMP(monitorEvents.dateTime))) as `Duration` from monitorEvents
        inner join httpCodes on httpCodes.code = monitorEvents.lastStatus
        inner join supervise on supervise.monitorId = monitorEvents.monitorId
        where httpCodes.status != "started"
        and supervise.userId = '.$userId.'
        and monitorEvents.dateTimeRefresh >= now()-INTERVAL 1 WEEK;');
        $result = $query->result_array();
        return $result[0]; 
    }

    function getWeekUpDuration($userId){
        $query = $this->db->query('select sum(IFNULL(duration,UNIX_TIMESTAMP(now()) - UNIX_TIMESTAMP(monitorEvents.dateTime))) as `Duration` from monitorEvents
        inner join httpCodes on httpCodes.code = monitorEvents.lastStatus
        inner join supervise on supervise.monitorId = monitorEvents.monitorId
        where httpCodes.status = "up"
        and supervise.userId = '.$userId.'
        and monitorEvents.dateTimeRefresh >= now()-INTERVAL 1 WEEK;');
        $result = $query->result_array();
        return $result[0]; 
    }

    function getMonthDuration($userId){
        $query = $this->db->query('select sum(IFNULL(duration,UNIX_TIMESTAMP(now()) - UNIX_TIMESTAMP(monitorEvents.dateTime))) as `Duration` from monitorEvents
        inner join httpCodes on httpCodes.code = monitorEvents.lastStatus
        inner join supervise on supervise.monitorId = monitorEvents.monitorId
        where httpCodes.status != "started"
        and supervise.userId = '.$userId.'
        and monitorEvents.dateTimeRefresh >= now()-INTERVAL 1 MONTH;');
        $result = $query->result_array();
        return $result[0]; 
    }

    function getMonthUpDuration($userId){
        $query = $this->db->query('select sum(IFNULL(duration,UNIX_TIMESTAMP(now()) - UNIX_TIMESTAMP(monitorEvents.dateTime))) as `Duration` from monitorEvents
        inner join httpCodes on httpCodes.code = monitorEvents.lastStatus
        inner join supervise on supervise.monitorId = monitorEvents.monitorId
        where httpCodes.status = "up"
        and supervise.userId = '.$userId.'
        and monitorEvents.dateTimeRefresh >= now()-INTERVAL 1 MONTH;');
        $result = $query->result_array();
        return $result[0]; 
    }

    function nowAverageLoadtime($monitorId){
        $query = $this->db->query('select round(sum(loadTime)/count(*),2) as `loadTime` from httpLogs
                                    inner join httpCodes on statusCode = code
                                    where monitorId = '.$monitorId.'
                                    and dateTime >= now() - INTERVAL 1 HOUR ;');
        $result = $query->result_array();
        return $result[0]; 
    }

    function overallAverageLoadtime($monitorId){
        $query = $this->db->query('select round(sum(loadTime)/count(*),2) as `loadTime` from httpLogs
                                    inner join httpCodes on statusCode = code
                                    where status = "up"
                                    and monitorId = '.$monitorId.';');
        $result = $query->result_array();
        return $result[0]; 
    }

    function lastDayAverageLoadtime($monitorId){
        $query = $this->db->query('select round(sum(loadTime)/count(*),2) as `loadTime` from httpLogs
                                    inner join httpCodes on statusCode = code
                                    where status = "up"
                                    and monitorId = '.$monitorId.'
                                    and dateTime >= now() - INTERVAL 1 DAY;');
        $result = $query->result_array();
        return $result[0]; 
    }

    function lastWeekAverageLoadtime($monitorId){
        $query = $this->db->query('select round(sum(loadTime)/count(*),2) as `loadTime` from httpLogs
                                    inner join httpCodes on statusCode = code
                                    where status = "up"
                                    and monitorId = '.$monitorId.'
                                    and dateTime >= now() - INTERVAL 1 WEEK;');
        $result = $query->result_array();
        return $result[0]; 
    }

    function getLastLoadTime($monitorId)
    {
        $this->db->select('round(loadTime,2) as `loadTime`');
        $this->db->from('httpLogs');
        $this->db->where('monitorId', $monitorId);
        $this->db->order_by('dateTime', 'ASC');
        $this->db->limit(12,0);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getOverallLoadTime($monitorId, $minmax)
    {
        $this->db->select($minmax.'(loadTime) as `loadTime`, dateTime as `dateTime`');
        $this->db->from('httpLogs');
        $this->db->where('monitorId', $monitorId);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getDayLoadTime($monitorId, $minmax)
    {
        $this->db->select($minmax.'(loadTime) as `loadTime`, dateTime as `dateTime`');
        $this->db->from('httpLogs');
        $this->db->where('monitorId', $monitorId);
        $this->db->where('dateTime >', 'NOW() - INTERVAL 1 DAY');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getWeekLoadTime($monitorId, $minmax)
    {
        $this->db->select($minmax.'(loadTime) as `loadTime`, dateTime as `dateTime`');
        $this->db->from('httpLogs');
        $this->db->where('monitorId', $monitorId);
        $this->db->where('dateTime >', 'NOW() - INTERVAL 1 WEEK');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getMonthLoadTime($monitorId, $minmax)
    {
        $this->db->select($minmax.'(loadTime) as `loadTime`, dateTime as `dateTime`');
        $this->db->from('httpLogs');
        $this->db->where('monitorId', $monitorId);
        $this->db->where('dateTime >', 'NOW() - INTERVAL 1 MONTH');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getDownCodes()
    {
        $this->db->select('code');
        $this->db->from('httpCodes');
        $this->db->where('status', 'down');
        $query = $this->db->get();
        return $query->result();
    }

    function getUpCodes()
    {
        $this->db->select('code');
        $this->db->from('httpCodes');
        $this->db->where('status', 'up');
        $query = $this->db->get();
        return $query->result();
    }

    function getLastLog($monitorId)
    {
        $this->db->select('statusCode as `code`');
        $this->db->from('httpLogs');
        $this->db->where('monitorId', $monitorId);
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->result();
        return $result[0]; 
    }
}
?>