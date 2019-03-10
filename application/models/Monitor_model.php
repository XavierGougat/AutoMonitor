<?php
class monitor_model extends CI_Model{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function getMonitors($offset, $limit)
    {
        $this->db->select('monitor.id as `monitorId`, monitorType.label as `typeLabel`, monitor.name as `monitorName`, monitor.adress as `monitorAdress`');
        $this->db->from('monitor');
        $this->db->join('monitorType', 'monitor.type = monitorType.id', 'inner');
        $this->db->limit($limit, $offset);
        $this->db->order_by('monitor.Id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function getMonitorsWithInterval($offset, $limit, $checkInterval)
    {
        $this->db->select('monitor.id as `monitorId`, monitorType.label as `typeLabel`, monitor.name as `monitorName`, monitor.adress as `monitorAdress`');
        $this->db->from('monitor');
        $this->db->join('monitorType', 'monitor.type = monitorType.id', 'inner');
        $this->db->where_in('monitor.checkInterval', $checkInterval);
        $this->db->limit($limit, $offset);
        $this->db->order_by('monitor.Id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }


    function getUserMonitors($userId)
    {
        $this->db->select('monitor.id as `monitorId`, monitorType.label as `typeLabel`, monitor.name as `monitorName`, monitor.adress as `monitorAdress`, monitor.status as `monitorStatus`');
        $this->db->from('monitor');
        $this->db->join('monitorType', 'monitor.type = monitorType.id', 'inner');
        $this->db->join('supervise', 'supervise.monitorId=monitor.id', 'inner');
        $this->db->join('user', 'supervise.userId = user.id', 'inner');
        $this->db->where_in('user.id', $userId);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getUserMonitorsStatus($userId){
        $this->db->select('t1.*, monitor.id, monitor.name, monitor.adress, httpCodes.status');
        $this->db->from('monitorEvents t1');
        $this->db->join('monitor', 't1.monitorId = monitor.id', 'inner');
        $this->db->join('supervise', 'supervise.monitorId=t1.monitorId', 'inner');
        $this->db->join('user', 'supervise.userId = user.id', 'inner');
        $this->db->join('monitorEvents t2', 't1.monitorId = t2.monitorId and t1.dateTime < t2.dateTime', 'left');
        $this->db->join('httpCodes', 'httpCodes.code=t1.lastStatus');
        $this->db->where('user.id', $userId);
        $this->db->where('t2.dateTime', null);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getUserMonitorsUpStatus($userId){
        $this->db->select('t1.*');
        $this->db->from('monitorEvents t1');
        $this->db->join('supervise', 'supervise.monitorId=t1.monitorId', 'inner');
        $this->db->join('user', 'supervise.userId = user.id', 'inner');
        $this->db->join('monitorEvents t2', 't1.monitorId = t2.monitorId and t1.dateTime < t2.dateTime', 'left');
        $this->db->join('httpCodes', 't1.lastStatus = httpCodes.code');
        $this->db->where('user.id', $userId);
        $this->db->where('t2.dateTime', null);
        $this->db->where('httpCodes.status', 'up');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getUserMonitorsDownStatus($userId){
        $this->db->select('t1.*, monitor.name');
        $this->db->from('monitorEvents t1');
        $this->db->join('monitor', 'monitor.id=t1.monitorId', 'inner');
        $this->db->join('supervise', 'supervise.monitorId=t1.monitorId', 'inner');
        $this->db->join('user', 'supervise.userId = user.id', 'inner');
        $this->db->join('monitorEvents t2', 't1.monitorId = t2.monitorId and t1.dateTime < t2.dateTime', 'left');
        $this->db->join('httpCodes', 't1.lastStatus = httpCodes.code');
        $this->db->where('user.id', $userId);
        $this->db->where('t2.dateTime', null);
        $this->db->where('httpCodes.status', 'down');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getUserMonitorsLastDownTime($userId){
        $this->db->select('monitor.id as `monitorId`, monitor.name as `monitorName`, max(monitorEvents.dateTime) as `maxTime`, monitorEvents.lastStatus as `monitorStatus`');
        $this->db->from('monitorEvents');
        $this->db->join('monitor', 'monitor.id = monitorEvents.monitorId', 'inner');
        $this->db->join('supervise', 'supervise.monitorId=monitor.id', 'inner');
        $this->db->join('httpCodes', 'monitorEvents.lastStatus = httpCodes.code');
        $this->db->where('supervise.userId', $userId);
        $this->db->where('httpCodes.status', 'down');
        $query = $this->db->get();
        return $query->result_array();
    }


    function getUserMonitorsEvents($userId){
        $this->db->select('monitor.id as `monitorId`, monitor.name as `monitorName`, monitor.adress as `monitorAdress`, monitorEvents.dateTime as `dateTime`, monitorEvents.lastStatus as `monitorStatus`, monitorEvents.duration as `duration`, httpCodes.status as `statusLabel`, httpCodes.color as `statusColor`');
        $this->db->from('monitorEvents');
        $this->db->join('monitor', 'monitor.id = monitorEvents.monitorId', 'inner');
        $this->db->join('supervise', 'supervise.monitorId=monitor.id', 'inner');
        $this->db->join('user', 'supervise.userId = user.id', 'inner');
        $this->db->join('httpCodes', 'httpCodes.code = monitorEvents.lastStatus');
        $this->db->where('user.id', $userId);
        $this->db->order_by('monitorEvents.dateTime', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getmonitorEvents($monitorId){
        $this->db->select('monitor.id as `monitorId`, monitor.name as `monitorName`, monitorEvents.dateTime as `dateTime`, monitorEvents.lastStatus as `monitorStatus`, monitorEvents.duration as `duration`, httpCodes.status as `statusLabel`, httpCodes.color as `statusColor`');
        $this->db->from('monitorEvents');
        $this->db->join('monitor', 'monitor.id = monitorEvents.monitorId', 'inner');
        $this->db->join('httpCodes', 'httpCodes.code = monitorEvents.lastStatus');
        $this->db->where('monitor.id', $monitorId);
        $this->db->order_by('monitorEvents.dateTime', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getMonitorById($monitorId)
    {
        $this->db->select('monitor.id as `monitorId`, monitor.name as `monitorName`, monitor.adress as `monitorAdress`, monitor.checkInterval as `checkInterval`');
        $this->db->from('monitor');
        $this->db->where_in('monitor.id', $monitorId);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function getMonitorByUrl($monitorUrl)
    {
        $this->db->select('monitor.id as `monitorId`, monitor.name as `monitorName`, monitor.adress as `monitorAdress`, monitor.checkInterval as `checkInterval`');
        $this->db->from('monitor');
        $this->db->where_in('monitor.url', $monitorUrl);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function getMonitorLastDownTime($monitorId){
        $this->db->select('monitor.id as `monitorId`, monitor.name as `monitorName`, max(monitorEvents.dateTime) as `maxTime`, monitorEvents.lastStatus as `monitorStatus`');
        $this->db->from('monitorEvents');
        $this->db->join('monitor', 'monitor.id = monitorEvents.monitorId', 'inner');
        $this->db->join('httpCodes', 'monitorEvents.lastStatus = httpCodes.code');
        $this->db->where('httpCodes.status', 'down');
        $this->db->where('monitor.id', $monitorId);
        $this->db->order_by('monitorEvents.dateTime', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getUserHttpMonitors($userId)
    {
        $this->db->select('*');
        $this->db->from('monitor');
        $this->db->join('monitorType', 'monitor.type = monitorType.id', 'inner');
        $this->db->join('supervise', 'supervise.monitorId=monitor.id', 'inner');
        $this->db->join('user', 'supervise.userId = user.id', 'inner');
        $this->db->where('user.id', $userId);
        $this->db->where('monitorType.label', 'http');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getUserPingMonitors($userId)
    {
        $this->db->select('*');
        $this->db->from('monitor');
        $this->db->join('monitorType', 'monitor.type = monitorType.id', 'inner');
        $this->db->join('supervise', 'supervise.monitorId=monitor.id', 'inner');
        $this->db->join('user', 'supervise.userId = user.id', 'inner');
        $this->db->where('user.id', $userId);
        $this->db->where('monitorType.label', 'ping');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getUserByMonitor($monitorId){
        $this->db->select('supervise.userId as `userId`');
        $this->db->from('supervise');
        $this->db->where('supervise.monitorId', $monitorId);
        $query = $this->db->get();
        return $query->result_array();
    }



    function insertMonitor($data)
    {
        $this->db->insert('monitor', $data);
        return $this->db->insert_id();
    }

    function updateMonitor($data){
        $this->db->where('id', $data[0]['id']);
        $this->db->update('monitor', $data[0]);
    }

    function insertSupervise($data)
    {
        $this->db->insert('supervise', $data);
        return $this->db->insert_id();
    }

    function deleteMonitor($data){
        $this->db->where('id', $data);
        $this->db->delete('monitor'); 
    }
    
    function refreshDate(){
        $data['dateTimeRefresh'] = date("Y-m-d H:i:s");
        $this->db->where('duration', null);
        $this->db->update('monitorEvents', $data); 
    }

}
?>