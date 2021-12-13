<?php

class commentContr extends post
{
    private $content;
    private $roomNum;

    public function __construct($content, $roomNum)
    {
        $this->content = $content;
        $this->roomNum = $roomNum;
    }

    
    public function PostComment() {
        if($this->emptyInput() == false)
        {
            header("location: ?error=emptyinput");
            exit();
        }
        $this->PostCommentToDB($this->content, $this->roomNum);
        
   }

    
    private function emptyInput() {
        $result = 0;
        if(empty($this->content)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
   

?>