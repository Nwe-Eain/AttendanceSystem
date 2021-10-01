<?php

use Illuminate\Http\Request;

namespace App\Services;

use App\Dao\AttendanceListDao as AttendanceListDao;

class AttendanceListService 
{
    protected $attendancelistdao;

    public function __construct(AttendanceListDao $attendancelistdao)
    {
        $this->attendancelistdao=$attendancelistdao;
    }

    public function getAll()
    {
        //default view for current month

        return $this->attendancelistdao->getAll();

    }


    public function getFilter($request)
    {
        return $this->attendancelistdao->getFilter($request);
    }




    
}

?>