<?php

namespace IH\Http;

class Response
{
    /** @var array Response data */
    protected $data;

    /** @var int Http code */
    protected $code;

    /**
     * Send reponse
     */
    public function send()
    {
        header('Content-type: application/json');
        http_response_code($this->code);
        echo($this->format($this->data));
        exit;
    }

    /**
     * Encodes data array to JSON
     */
    private function format(array $data = array())
    {
        return json_encode($data); 
    }

    /**
     * Sets response data
     *
     * @return object
     */
    public function setData(array $data = array())
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Sets HTTP code
     */
    public function setCode(int $code = 404)
    {
        $this->code = $code;

        return $this;
    }
}
