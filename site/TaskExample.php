<?php
include_once "ITask.php";

class TaskExample implements ITask 
{
    public function DoSomething() 
    {
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');

        for($progress = 0; $progress <= 100; $progress++)
        {
            $this->NotifyClient(array('progress' => $progress, 'message' => "$progress% completed" ));
            sleep(1);
        }
    }

    private function NotifyClient($data)
    {
         echo "id: TaskExample" . PHP_EOL;
         echo "event: Notification" . PHP_EOL;
         echo "data: " . json_encode($data) . PHP_EOL;
         echo PHP_EOL;
     
         ob_flush();
         flush();
    }
}