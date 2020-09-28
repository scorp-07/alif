<?php


class Calculator
{
    public static $filename;
    public static $operation;

    public static function setCalc($filename, $operation)
    {
        self::$filename=$filename;
        self::$operation=$operation;

        return self::setOutput();
    }

    public static function getFile()
    {
        $filename = self::$filename;
        $file = file_get_contents($filename);
        $params = explode("\n", $file);

        return $params;
    }

    public static function getAnswer()
    {
        $operation = self::$operation;
        $params = self::getFile();

        for ($i = 0; $i <= count($params) - 1; $i++) {
            $number = explode(" ", $params[$i]);
            switch ($operation){
                case "+":
                    $result[] = $number[0]+$number[1];
                    break;
                case "-":
                    $result[] = $number[0]-$number[1];
                    break;
                case "*":
                    $result[] = $number[0]*$number[1];
                    break;
                case "/":
                    $result[] = $number[0]/$number[1];
                    break;
                default:
                    $result[] = null;
                    break;
            }
        }
        return $result;
    }

    public static function setOutput()
    {
        self::deleteFile("out_negative.txt");
        self::deleteFile("out_positive.txt");

        $answer = self::getAnswer();
        $result = [];
        for ($i = 0; $i <= count($answer) - 1; $i++){
            if ($answer[$i] < 0){
                $result["negative"][$i] = $answer[$i];
                file_put_contents("out_negative.txt", $result["negative"][$i].PHP_EOL, FILE_APPEND);
            }else{
                $result["positive"][$i] = $answer[$i];
                file_put_contents("out_positive.txt", $result["positive"][$i].PHP_EOL, FILE_APPEND);
            }
        }
        return $result;
    }

    public static function deleteFile($filename){
        if (file_exists($filename)){
            unlink($filename);
        }
    }

}