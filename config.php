<?php

define('APP_NAME',              'Emporio Llicorella Priorato');
define('APP_VERSION',              '1.3.5');

define('BASE_URL',      'localhost/php_store/public/');

define('STATUS',            ['AGENDADA','PENDENTE', 'EM PROCESSAMENTO', 'ENVIADA', 'CANCELADA', 'CONCLUIDA']);
define('STATUS_PREMIO',            ['PENDENTE','RECEBIDO']);


// MYSQL
define('MYSQL_SERVER',        'localhost');
define('MYSQL_DATABASE',        'llicorella');
define('MYSQL_USER',        'marcos');
define('MYSQL_PASS',        '123456');
define('MYSQL_CHARSET',        'utf8');
// AES encriptação
define('AES_KEY',   'q7YnEzug3s89yGHtSytYCY5hwFPcXjzB');
define('AES_IV',   'p4kqQ4kfFH4TmhgD');

// mail (preciso um email corporativo para que funcione)

define('EMAIL_SMTP',    'smtp.hostinger.com');
define('EMAIL_FROM',    'info@llicorellapriorato.store');
define('EMAIL_PASS',    'Ma748596321/');
define('EMAIL_PORT',     465);


// API envio OpenCage

define('API_OC_KEY',    '96667c9aeaa04049a83e903c93355a14');

// API CEP aberto
define('API_AB_KEY',    'b4829126fa75d73d9276cb2f8e48e32c');

// LOCALIZAÇÃO DAS LOJAS
define('LOJA_JURERE_COO_LAT',    '-27.444837');
define('LOJA_JURERE_COO_LNG',    '-48.486922');
define('LOJA_CENTRO_COO_LAT',    '-27.590086');
define('LOJA_CENTRO_COO_LNG',    '-48.548183');

// API GetNet

define('CLIENT_GETNET_ID',       '445046dc-e772-4676-a65d-3d096fa99d70');
define('CLIENT_SECRET_ID',       'f9c1c6c9-caf3-451a-970c-b6013827c36e');
