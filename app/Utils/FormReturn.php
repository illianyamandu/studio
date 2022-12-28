<?php

namespace App\Utils;

class FormReturn
{
    public static function ReturnError($erros, $errorCode = 400)
    {
        return response()->json(['success' => false,'error' => $erros], $errorCode);
    }

    public static function ReturnSuccess($message, $successCode = 200)
    {
        return response()->json(['success' => true, 'message' => $message], $successCode);
    }

    public static function ReturnSuccessId($message, $id, $successCode)
    {
        return response()->json(['success' => true ,'message' => $message, 'id' => $id], $successCode);
    }
}
