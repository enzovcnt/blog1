<?php

namespace Core\Response;

use Core\View\View;

class Response
{
public function redirect( array $urlParams = null)
    {
        $urlEnd = "";

        if($urlParams)
        {
            $urlEnd = "?";
            foreach($urlParams as $paramName => $paramValue)
            {
                $urlEnd .= $paramName . "=" . $paramValue . "&";
            }
            $urlEnd = substr($urlEnd, 0, -1);
        }


        header("Location: index.php$urlEnd");
        //exit();

        return $this;

    }

public function render(string $templateName, array $data)
{
    View::render($templateName, $data);

    return $this;

}

}