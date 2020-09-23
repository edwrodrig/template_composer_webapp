<?php
declare(strict_types=1);

namespace tpl_company_tpl\tpl_project_tpl\app;


class ResponseFile extends \labo86\hapi_core\ResponseFile
{
    public function send()
    {
        //header('Content-Description: File Transfer');
        header('Content-Type: ' . mime_content_type($this->filename));
        //header('Content-Disposition: attachment; filename="' . basename($this->filename) . '"');
        //creo que estos headers de cache no son los mejores. Hay que investigar
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($this->filename));
        readfile($this->filename);
    }
}