<?php
/**
 * payment
 * class controller for table p_bank
 *
 * @since 08/06/2015 13:25:03
 * @author wiliamdecosta@gmail.com
 */
class p_user_loket_controller extends wbController{

    public static function valid_login($args = array()){

        $data = array('rows' => array(), 'total' => 0, 'success' => false, 'message' => '');

        try{
            $ws_client = self::getNusoap();
		    $params = array('search' => '',
					'getParams' => json_encode($_GET),
					'controller' => json_encode(array('module' => 'paymentccbs','class' => 'p_user_loket', 'method' => 'valid_login', 'type' => 'json' )),
					'postParams' => json_encode($_POST),
					'jsonItems' => '');

            $ws_data = self::getResultData($ws_client, $params);
            /*if($ws_data['data'] == null) {
                throw new Exception("Request Data Error. Data tidak dapat diproses");
            }*/

            $data['rows']       = $ws_data ['data'];
            $data['total']      = $ws_data ['total'];
            $data['current']    = $ws_data['current'];
            $data['rowCount']   = $ws_data['rowCount'];

            $data['message']    = $ws_data ['message'];
            $data['success']    = $ws_data ['success'];

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }
        echo json_encode($data);
        exit;

    }
    
    
    public static function get_user_loket($args = array()){

        $data = array('rows' => array(), 'total' => 0, 'success' => false, 'message' => '');

        try{
            $ws_client = self::getNusoap();
		    $params = array('search' => '',
					'getParams' => json_encode($_GET),
					'controller' => json_encode(array('module' => 'paymentccbs','class' => 'p_user_loket', 'method' => 'get_user_loket', 'type' => 'json' )),
					'postParams' => json_encode($_POST),
					'jsonItems' => '');

            $ws_data = self::getResultData($ws_client, $params);
            /*if($ws_data['data'] == null) {
                throw new Exception("Request Data Error. Data tidak dapat diproses");
            }*/

            $data['rows']       = $ws_data ['data'];
            $data['total']      = $ws_data ['total'];
            $data['current']    = $ws_data['current'];
            $data['rowCount']   = $ws_data['rowCount'];

            $data['message']    = $ws_data ['message'];
            $data['success']    = $ws_data ['success'];

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }
        echo json_encode($data);
        exit;

    }
    
}
?>