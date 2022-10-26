<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;


    public function AddActivity($request)
    {
        $this->title = $request->title;
        $this->description = $request->description;
        $this->image = $request->image;
        $this->type = $request->type;
        // $this->user_id = $userId;
        $this->date = date($request->date);
        $this->save();
        return $this;
    }

    public function AssignToUser($request, $userId)
    {
        $this->title = $request->title;
        $this->description = $request->description;
        $this->image = $request->image;
        $this->type = "N";
        $this->user_id = $userId;
        $this->date = date($request->date);
        $this->save();
        return $this;
    }

    public function AddActivity2($request)
    {
        $this->title = $request->title;
        $this->description = $request->description;
        $this->image = $request->image;
        $this->type = $request->type;
        $this->user_id = $request->userId;
        $this->date = date($request->date);
        $this->save();
        return $this;
    }

    public function UpdateActivity($fromDb , $request)
    {
        $fromDb->title = $request->title;
        $fromDb->description = $request->description;
        $fromDb->type = $request->type;
        $fromDb->date = date($request->date);
        $fromDb->save();
        return $fromDb;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'foreign_key');
    }
}