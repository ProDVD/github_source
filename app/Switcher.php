<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Switcher extends Model
{
    public static function userAuth($mail, $pass)
    {
        $res = Doctor::where('email', $mail)->where('password', $pass)->first();
        if($res != null) {
            return $res;
        } else if(($res = Patient::where('email', $mail)->where('password', $pass)->first()) != null) {
            return $res;
        } else
            return null;
    }

    public static function getSessByPatId($sess_id)
    {
        $res = Session::where('patient_id', $sess_id)->get()->sortByDesc('creation_time');
        foreach ($res as $k) {
            $sessionList[] = $k->toArray();
        }
        return $sessionList;
    }

    public static function getFilesById($id)
    {
//        $sql = "SELECT tbl_files.name, tbl_files.crtDateTime, tbl_files.duration, tbl_files.path, tbl_cloud_drives.Browse_key
//FROM tbl_files right join tbl_cloud_drives on tbl_cloud_drives.cloud_drive_id=tbl_files.cloud_drive_id
//WHERE tbl_files.session_id=$ID";

        $rows = DB::table('tbl_files')
            ->rightJoin('tbl_cloud_drives','tbl_cloud_drives.cloud_drive_id','=','tbl_files.cloud_drive_id')
            ->select('tbl_files.name','tbl_files.crtDateTime', 'tbl_files.duration', 'tbl_files.path', 'tbl_cloud_drives.Browse_key')
            ->where('tbl_files.session_id', $id)
            ->get();

        foreach ($rows as $row) {
            $fileList[] = new Files($row->name, $row->duration, $row->path, $row->Browse_key);
        }
        return $fileList;
    }
}
