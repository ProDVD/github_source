<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    public $name;
    public $fileId;
    public $driveKey;
    public $type;
    public $duration;
    public $thumbnailSource;
    public $directLink;
    public $downloadLink;

    function __construct($name, $duration, $fileId, $driveKey)
    {
        $this->name = $name;
        $this->duration = $duration;
        $this->fileId = $fileId;
        $this->driveKey = $driveKey;





        $this->downloadLink = 'https://drive.google.com/uc?id=' . $fileId . '&export=download';

        $this->thumbnailSource = 'https://drive.google.com/thumbnail?authuser=0&sz=w150&id=' . $this->fileId;
        if($this->duration == 0) {
            $this->type = 'photo';
            $this->directLink = 'https://drive.google.com/uc?id=' . $this->fileId . '&export=download';
        } else {
            $this->duration = gmdate("H:i:s\\", (int)$duration / 1000);
            $this->type = 'video';
            $this->directLink = "https://www.googleapis.com/drive/v3/files/" . $this->fileId . '?key=' . $this->driveKey . '&alt=media';
        }
    }
}
