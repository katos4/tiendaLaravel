<?php
return array(

    'client_id' =>'AdlNUOTBgflKnCG0D-tquALyT_GZ4uK8NCM-H6VUzebI_xLKTKYtQmvHBTA1wR1MB5woumLcDRkj3JKP',
    'secret' =>'EEYiJT1ofKCuVnS-C6iEy0VfQExqiDq_ugVJXri60ERMDVoFIYtU4M3rRQuuTCDUDCHZ4hhHbyMDuyrX',

    'settings'=>array(

        'mode'=>'sandbox',
        
        'http.ConnectionTimeOut'=>30,

        'log.LogEnabled'=>true,

        'log.FileName'=> storage_path() . '/logs/paypal.log',

        'log.LogLevel'=> 'FINE'
    ),
);