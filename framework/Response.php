<?php

/*
 * Response Class
 * Used to form a response to client, with required code and headers
 */

namespace framework;

class Response
{
    /**
     * @param $template
     * @param array $params
     * @param array $headers
     * Used to render template to client side with specified parameters and headers
     */
    public function renderTemplate($template, $params = [], $headers = []) {
        foreach ($headers as $header) {
            header($header);
        }
        ob_start();
        extract($params, EXTR_SKIP);
        require '../src/view/' . $template . 'View.php';
        ob_end_flush();
    }

    /**
     * @param $template
     * @param array $params
     * @param array $headers
     * Used to render content on IndexView template with specified parameters and headers
     */
    public function renderContent($template, $params = [], $headers = []) {
        foreach ($headers as $header) {
            header($header);
        }
        ob_start();
        extract($params, EXTR_SKIP);
        require '../src/view/' . $template . 'View.php';
        $indexContent = ob_get_clean();
        require '../src/view/IndexView.php';
        ob_end_flush();
    }

    /**
     * @param $url
     * Used to redirect user to specified page
     */
    public function redirect($url) {
        header('Location: ' . $url);
        exit;
    }
}