<?php // Agradeço a Deus pelo dom do conhecimento

namespace App\Core;

class Error extends \Exception
{
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->showError();
    }

    public function showError()
    {
        return view('error', ['class' => $this->__toString(), 'message' => $this->message]);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
