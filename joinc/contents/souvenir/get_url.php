<?php
$data = [];
    $data['url'] = (explode('?', $_SERVER['HTTP_REFERER']));

    function Url($params){
        $data = [];
        $data['cek'] = strpos($params, '&');
        if ($data['cek']>0) {#explode jika ada tanda &
            $data['explode'] = explode('&', $params);
            $data['count'] = count($data['explode']);
            $data['temp-result'] = [];
            for ($i=1; $i <= $data['count'] ; $i++) { 
                # explode jika ada tanda =
                $explode = explode('=', $data['explode'][$i-1]);
                $data['temp-result'][$explode[0]] = $explode[1];
            }
            $data['result'] = $data['temp-result'];
        
        }

        else{
            $data['explode'] = explode('=', $params);
            $data['result'] = [$data['explode'][0] => $data['explode'][1]];
            
        }

        return $data['result'];
    }
if ( ! isset($data['url'][1])) {
   $data['get'] = '';
}else{
    $data['get'] = Url($data['url'][1]);
}
?>