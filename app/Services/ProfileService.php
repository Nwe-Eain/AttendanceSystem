<?php

use Illuminate\Http\Request;

namespace App\Services;

use App\Dao\ProfileDao as ProfileDao;

class ProfileService
{

    protected $profiledao;

    public function __construct(ProfileDao $profiledao)
    {
        $this->profiledao=$profiledao;
    }

    //add new skill for employee
    public function addSkill($request)
    {
        $result= $this->profiledao->addSkill($request);
        return $result;
    }

    //show current login employee profile

    public function showProfile($id)
    {
        $result= $this->profiledao->showProfile($id);

        return $result;
    }

    //return data for current login employee editprofile page

    public function showEditProfile($id)
    {
        $result=$this->profiledao->showEditProfile($id);
        
        return $result;
    }


    //updated data for current login employee

    public function updateProfile($request,$id)
    {
        $result=$this->profiledao->updateProfile($request,$id);

        return $result;
    }

    //update skill for current login employee
    public function editSkill($request)
    {
        $result=$this->profiledao->editSkill($request);
        
        return $result;
    }

    //update photo for current login employee

    public function editPhoto($id,$request)
    {
        $result=$this->profiledao->editPhoto($id,$request);

        return $result;
    }

}

 



?>