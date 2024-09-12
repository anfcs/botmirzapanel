<?php
require_once 'config.php';
require_once 'functions.php';
$setting = select("setting", "*");
$admin_ids = select("admin", "id_admin",null,null,"FETCH_COLUMN");
//-----------------------------[  text panel  ]-------------------------------
$sql = "SHOW TABLES LIKE 'textbot'";
$stmt = $pdo->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll();
  $table_exists = count($result) > 0;
$datatextbot = array(
    'text_usertest' => '',
    'text_Purchased_services' => '',
    'text_support' => '',
    'text_help' => '',
    'text_start' => '',
    'text_bot_off' => '',
    'text_dec_info' => '',
    'text_dec_usertest' => '',
    'text_fq' => '',
    'text_account' => '',
    'text_sell' => '',
    'text_Add_Balance' => '',
    'text_Discount' => '',
    'text_Tariff_list' => '',

);
if ($table_exists) {
    $textdatabot = select("textbot", "*",null ,null ,"fetchAll");
    $data_text_bot = array();
    foreach ($textdatabot as $row) {
        $data_text_bot[] = array(
            'id_text' => $row['id_text'],
            'text' => $row['text']
        );
    }
    foreach ($data_text_bot as $item) {
        if (isset($datatextbot[$item['id_text']])) {
            $datatextbot[$item['id_text']] = $item['text'];
        }
    }
}
$keyboard = [
    'keyboard' => [
        [['text' => $datatextbot['text_sell']],['text' => $datatextbot['text_usertest']]],
        [['text' => $datatextbot['text_Purchased_services']],['text' => $datatextbot['text_Tariff_list']]],
        [['text' => $datatextbot['text_account']],['text' => $datatextbot['text_Add_Balance']]],
        [['text' => "👥 زیر مجموعه گیری"]],
        [['text' => $datatextbot['text_support']], ['text' => $datatextbot['text_help']]],
    ],
    'resize_keyboard' => true
];
if(in_array($from_id,$admin_ids)){
$keyboard['keyboard'][] = [
        ['text' => "ادمین"],
    ];
}
$keyboard  = json_encode($keyboard);


$keyboardPanel = json_encode([
    'inline_keyboard' => [
        [['text' => $datatextbot['text_Discount'] ,'callback_data' => "Discount"]],
    ],
    'resize_keyboard' => true
]);
$keyboardadmin = json_encode([
    'keyboard' => [
        [['text' => "📊 Статистика бота"]],
        [['text' => "✏️ Управление панелью"], ['text' => "🖥 Добавить панель"]],
        [['text' => "🔑 Настройки тестовой учетной записи"]],
        [['text' => "🏬 Магазин"], ['text' => "💵 Финансы"]],
        [['text' => "👨‍🔧 Административный раздел"], ['text' => "📝 Настройка текста бота"]],
        [['text' => "👤 Услуги для пользователей"], ['text' => "👁‍🗨 Поиск пользователя"], ['text' => "📨 Отправить сообщение"]],
        [['text' => "👥 Настройки подчиненных"]],
        [['text' => "📚 Образовательный раздел"], ['text' => "⚙️ Настройки"]],
        [['text' => "🏠 Вернуться в главное меню"]]
    ],
    'resize_keyboard' => true
]);
$keyboardpaymentManage = json_encode([
    'keyboard' => [
        [['text' => "💳 Настройки оффлайн-ворот"]],
        [['text' => "💵 Настройки nowpayment"]],
        [['text' => "🔵 Шлюз Mr. Pay"], ['text' => "🔴 Шлюз Perfect Money"]],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
$CartManage = json_encode([
    'keyboard' => [
        [['text' => "💳 Настройка номера карты"]],
        [['text' => "🔌 Статус оффлайн-ворот"]],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
$alsat = json_encode([
    'keyboard' => [
        [['text' => "Настройка мерчанта"], ['text' => "Статус Al Sat шлюза"]],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
$aqayepardakht = json_encode([
    'keyboard' => [
        [['text' => "Настройка мерчанта Mr. Pay"], ['text' => "Статус шлюза Mr. Pay"]],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
$NowPaymentsManage = json_encode([
    'keyboard' => [
        [['text' => "🧩 API nowpayment"]],
        [['text' => "🔌 Статус шлюза nowpayments"]],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
$admin_section_panel =  json_encode([
    'keyboard' => [
        [['text' => "👨‍💻 Добавить администратора"], ['text' => "❌ Удалить администратора"]],
        [['text' => "📜 Просмотреть список администраторов"]],
        [['text' => "🏠 Вернуться в меню управления"]],

    ],
    'resize_keyboard' => true
]);
$keyboard_usertest =  json_encode([
    'keyboard' => [
        [['text' => "➕ Ограничение на создание тестовых аккаунтов для пользователя"]],
        [['text' => "➕ Ограничение на создание тестовых аккаунтов для всех"]],
        [['text' => "⏳ Время тестового сервиса"], ['text' => "💾 Объем тестового аккаунта"]],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
$setting_panel =  json_encode([
    'keyboard' => [
        [['text' => "🕚 Настройки cron job"]],
        [['text' => "📡 Статус бота"], ['text' => "♨️ Раздел правил"]],
        [['text' => "📣 Настройка канала отчетов"], ['text' => "📯 Настройки канала"]],
        [['text' => "👤 Кнопка имени пользователя"]],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
$valid_Number =  json_encode([
    'keyboard' => [
        [['text' => "☎️ Статус подтверждения номера телефона"]],
        [['text' => "Подтверждение иранского номера 🇮🇷"]],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
$PaySettingcard = select("PaySetting", "ValuePay", "NamePay", 'Cartstatus',"select")['ValuePay'];
$PaySettingnow = select("PaySetting", "ValuePay", "NamePay", 'nowpaymentstatus',"select")['ValuePay'];
$PaySettingdigi = select("PaySetting", "ValuePay", "NamePay", 'digistatus',"select")['ValuePay'];
$PaySettingaqayepardakht = select("PaySetting", "ValuePay", "NamePay", 'statusaqayepardakht',"select")['ValuePay'];
$PaySettingperfectmoney = select("PaySetting", "ValuePay", "NamePay", 'status_perfectmoney',"select")['ValuePay'];
$step_payment = [
    'inline_keyboard' => []
    ];
    if($PaySettingcard == "oncard"){
        $step_payment['inline_keyboard'][] = [
            ['text' => "💳 Перевод на карту" ,'callback_data' => "cart_to_offline"],
    ];
    }
   if($PaySettingnow == "onnowpayment"){
        $step_payment['inline_keyboard'][] = [
            ['text' => "💵 Оплата через nowpayments", 'callback_data' => "nowpayments" ]
    ];
    }
   if($PaySettingdigi == "ondigi"){
        $step_payment['inline_keyboard'][] = [
            ['text' => "💎 Валютный платежный шлюз (в риалах)" , 'callback_data' => "iranpay" ]
    ];
    }
   if($PaySettingaqayepardakht == "onaqayepardakht"){
        $step_payment['inline_keyboard'][] = [
            ['text' => "🔵 Платежный шлюз onaqayepardakht" , 'callback_data' => "aqayepardakht" ]
    ];
    }
    if($PaySettingperfectmoney == "onperfectmoney"){
        $step_payment['inline_keyboard'][] = [
            ['text' => "🔴 Платежный шлюз Perfect Money" , 'callback_data' => "perfectmoney" ]
    ];
    }
    $step_payment['inline_keyboard'][] = [
            ['text' => "❌ Закрыть список" , 'callback_data' => "colselist" ]
    ];
    $step_payment = json_encode($step_payment);
$User_Services = json_encode([
    'keyboard' => [
        [['text' => "📱 Подтверждение номера"]],
        [['text' => "🛍 Просмотр заказов пользователя"]],
        [['text' => "❌ Удалить сервис пользователя"], ['text' => "👥 Общая зарядка"]],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
$keyboardhelpadmin = json_encode([
    'keyboard' => [
        [['text' => "📚 Добавить обучение"], ['text' => "❌ Удалить обучение"]],
        [['text' => "💡 Статус раздела обучения"]],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
$shopkeyboard = json_encode([
    'keyboard' => [
        [['text' => "🛍 Добавить продукт"], ['text' => "❌ Удалить продукт"]],
        [['text' => "✏️ Редактировать продукт"]],
        [['text' => "➕ Установить цену на дополнительный объем"]],
        [['text' => "🎁 Создать подарочный код"], ['text' => "❌ Удалить подарочный код"]],
        [['text' => "🎁 Создать код скидки"], ['text' => "❌ Удалить код скидки"]],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
$confrimrolls = json_encode([
    'keyboard' => [
        [['text' => "✅ Я принимаю правила"]],
    ],
    'resize_keyboard' => true
]);
$request_contact = json_encode([
    'keyboard' => [
        [['text' => "☎️ Отправить номер телефона", 'request_contact' => true]],
        [['text' => "🏠 Вернуться в главное меню"]]
    ],
    'resize_keyboard' => true
]);
$rollkey = json_encode([
    'keyboard' => [
        [['text' => "💡 Включить / выключить подтверждение правил"], ['text' => "⚖️ Текст закона"]],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
$sendmessageuser = json_encode([
    'keyboard' => [
        [['text' => "✉️ Отправить массово"], ['text' => "📤 Переслать массово"]],
        [['text' => "✍️ Отправить сообщение пользователю"]],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
$Feature_status = json_encode([
    'keyboard' => [
        [['text' => "Возможность просмотра информации об аккаунте"]],
        [['text' => "Возможность тестового аккаунта"], ['text' => "Возможность обучения"]],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
$channelkeyboard = json_encode([
    'keyboard' => [
        [['text' => "📣 Настройка обязательного присоединения к каналу"]],
        [['text' => "🔑 Включить / выключить блокировку канала"]],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
$backuser = json_encode([
    'keyboard' => [
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true,
    'input_field_placeholder' =>"Для возврата нажмите кнопку ниже"
]);
$backadmin = json_encode([
    'keyboard' => [
        [['text' => "🏠 بازگشت به منوی مدیریت"]]
    ],
    'resize_keyboard' => true,
    'input_field_placeholder' =>"Для возврата нажмите кнопку ниже"
]);
$stmt = $pdo->prepare("SHOW TABLES LIKE 'marzban_panel'");
  $stmt->execute();
  $result = $stmt->fetchAll();
  $table_exists = count($result) > 0;
  $namepanel = [];
  if ($table_exists) {
    $stmt = $pdo->prepare("SELECT * FROM marzban_panel");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $namepanel[] = [$row['name_panel']];
    }
    $list_marzban_panel = [
        'keyboard' => [],
        'resize_keyboard' => true,
    ];
    foreach ($namepanel as $button) {
        $list_marzban_panel['keyboard'][] = [
            ['text' => $button[0]]
        ];
    }
    $list_marzban_panel['keyboard'][] = [
        ['text' => "🏠 Вернуться в меню управления"],
    ];
    $json_list_marzban_panel = json_encode($list_marzban_panel);
}
$sql = "SHOW TABLES LIKE 'help'";
$stmt = $pdo->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll();
  $table_exists = count($result) > 0;
  if ($table_exists) {
        $help = [];
        $stmt = $pdo->prepare("SELECT * FROM help");
        $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $help[] = [$row['name_os']];
        }
        $help_arr = [
            'keyboard' => [],
            'resize_keyboard' => true,
        ];
        foreach ($help as $button) {
            $help_arr['keyboard'][] = [
                ['text' => $button[0]]
            ];
        }
                $help_arr['keyboard'][] = [
            ['text' => "🏠 Вернуться в меню управления"],
        ];
        $json_list_help = json_encode($help_arr);
    }

$users = select("user", "*", "id", $from_id,"select");
if ($users == false) {
    $users = array();
    $users = array(
        'step' => '',
    );
}
$stmt = $pdo->prepare("SELECT * FROM marzban_panel WHERE status = 'activepanel'");
$stmt->execute();
$list_marzban_panel_users = ['inline_keyboard' => []];
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($users['step'] == "getusernameinfo") {
            $list_marzban_panel_users['inline_keyboard'][] = [
                ['text' => $result['name_panel'], 'callback_data' => "locationnotuser_{$result['id']}"]
            ];
        }
        else{
            $list_marzban_panel_users['inline_keyboard'][] = [['text' => $result['name_panel'], 'callback_data' => "location_{$result['id']}"]
            ];
        }
    }
$list_marzban_panel_users['inline_keyboard'][] = [
    ['text' => "🏠 Вернуться в меню управления", 'callback_data' => "backuser"],
];
$list_marzban_panel_user = json_encode($list_marzban_panel_users);

  $list_marzban_panel_usertest = [
        'inline_keyboard' => [],
    ];
$stmt = $pdo->prepare("SELECT * FROM marzban_panel WHERE statusTest = 'ontestshowpanel'");
$stmt->execute();
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $list_marzban_panel_usertest['inline_keyboard'][] = [['text' => $result['name_panel'], 'callback_data' => "locationtests_{$result['id']}"]
            ];
    }
$list_marzban_panel_usertest['inline_keyboard'][] = [
    ['text' => "🏠 Вернуться в меню управления", 'callback_data' => "backuser"],
];
$list_marzban_usertest = json_encode($list_marzban_panel_usertest);
$textbot = json_encode([
    'keyboard' => [
        [['text' => "Настройка текста начала"], ['text' => "Кнопка купленной услуги"]],
        [['text' => "Кнопка тестового аккаунта"], ['text' => "Кнопка часто задаваемых вопросов"]],
        [['text' => "Текст кнопки 📚 Обучение"], ['text' => "Текст кнопки ☎️ Поддержка"]],
        [['text' => "Кнопка пополнения баланса"]],
        [['text' => "Текст кнопки покупки подписки"], ['text' => "Текст кнопки списка тарифов"]],
        [['text' => "Текст описания списка тарифов"]],
        [['text' => "Текст кнопки личного кабинета"]],
        [['text' => "📝 Настройка текста описания обязательного членства"]],
        [['text' => "📝 Настройка текста описания часто задаваемых вопросов"]],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
//--------------------------------------------------
$sql = "SHOW TABLES LIKE 'protocol'";
$stmt = $pdo->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll();
  $table_exists = count($result) > 0;
  if ($table_exists) {
    $getdataprotocol = select("protocol", "*",null ,null ,"fetchAll");
    $protocol = [];
    foreach($getdataprotocol as $result)
    {
        $protocol[] = [['text'=>$result['NameProtocol']]];
    }
    $protocol[] = [['text'=>"🏠 Вернуться в меню управления"]];
    $keyboardprotocollist = json_encode(['resize_keyboard'=>true,'keyboard'=> $protocol]);
 }
//--------------------------------------------------
$sql = "SHOW TABLES LIKE 'product'";
$stmt = $pdo->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll();
  $table_exists = count($result) > 0;
  if ($table_exists) {
    $product = [];
    $stmt = $pdo->prepare("SELECT * FROM product WHERE Location = :Location OR Location = '/all'");
    $stmt->bindParam(':Location', $text, PDO::PARAM_STR);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $product[] = [$row['name_product']];
    }
    $list_product = [
        'keyboard' => [],
        'resize_keyboard' => true,
    ];
    $list_product['keyboard'][] = [
        ['text' => "🏠 Вернуться в меню управления"],
    ];
    foreach ($product as $button) {
        $list_product['keyboard'][] = [
            ['text' => $button[0]]
        ];
    }
    $json_list_product_list_admin = json_encode($list_product);
    }
//--------------------------------------------------
$sql = "SHOW TABLES LIKE 'Discount'";
$stmt = $pdo->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll();
  $table_exists = count($result) > 0;
  if ($table_exists) {
    $Discount = [];
    $stmt = $pdo->prepare("SELECT * FROM Discount");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $Discount[] = [$row['code']];
    }
    $list_Discount = [
        'keyboard' => [],
        'resize_keyboard' => true,
    ];
    $list_Discount['keyboard'][] = [
        ['text' => "🏠 Вернуться в меню управления"],
    ];
    foreach ($Discount as $button) {
        $list_Discount['keyboard'][] = [
            ['text' => $button[0]]
        ];
    }
    $json_list_Discount_list_admin = json_encode($list_Discount);
}
//--------------------------------------------------
$sql = "SHOW TABLES LIKE 'DiscountSell'";
$stmt = $pdo->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll();
  $table_exists = count($result) > 0;
  $namepanel = [];
  if ($table_exists) {
    $DiscountSell = [];
    $stmt = $pdo->prepare("SELECT * FROM DiscountSell");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $DiscountSell[] = [$row['codeDiscount']];
    }
    $list_Discountsell = [
        'keyboard' => [],
        'resize_keyboard' => true,
    ];
    $list_Discountsell['keyboard'][] = [
        ['text' => "🏠 Вернуться в меню управления"],
    ];
    foreach ($DiscountSell as $button) {
        $list_Discountsell['keyboard'][] = [
            ['text' => $button[0]]
        ];
    }
    $json_list_Discount_list_admin_sell = json_encode($list_Discountsell);
}
$payment = json_encode([
    'inline_keyboard' => [
        [['text' => "💰 Оплата и получение услуги", 'callback_data' => "confirmandgetservice"]],
        [['text' => "🎁 Ввод кода скидки", 'callback_data' => "aptdc"]],
        [['text' => "🏠 Вернуться в меню управления" ,  'callback_data' => "backuser"]]
    ]
]);
$change_product = json_encode([
    'keyboard' => [
        [['text' => "Цена"], ['text' => "Объем"], ['text' => "Время"]],
        [['text' => "Название продукта"]],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
$NotProductUser = json_encode([
    'keyboard' => [
        [['text' => "⭕️ Мое имя пользователя не в списке ⭕️"]],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);

$keyboardprotocol = json_encode([
    'keyboard' => [
        [['text' => "vless"],['text' => "vmess"],['text' => "trojan"]],
        [['text' => "shadowsocks"]],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
$MethodUsername = json_encode([
    'keyboard' => [
        [['text' => "Имя пользователя + число по порядку"]],
        [['text' => "Числовой ID + буквы и случайное число"]],
        [['text' => "Желаемое имя пользователя"]],
        [['text' => "Произвольный текст + случайное число"]],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
$optionMarzban = json_encode([
    'keyboard' => [
        [['text' => "🔌 Статус подключения панели "], ['text' => "👁‍🗨 Статус отображения панели"]],
        [['text' => "🎁 Статус тестового аккаунта"]],
        [['text' => "✍️ Название панели"], ['text' => "❌ Удалить панель"]],
        [['text' => "🔗 Редактировать адрес панели"], ['text' => "👤 Редактировать имя пользователя"]],
        [['text' => "🔐 Редактировать пароль"], ['text' => "⚙️ Настройки протокола"]],
        [['text' => "🍀 Возможность flow"], ['text' => "💡 Способ создания имени пользователя"]],
        [['text' => "🔗 Отправить ссылку на подписку"], ['text' => "⚙️ Отправить конфигурацию"]],
        [['text' => "⏳ Возможность первого подключения"]],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
$optionX_ui_single = json_encode([
    'keyboard' => [
        [['text' => "🔌 Статус подключения панели"], ['text' => "👁‍🗨 Статус отображения панели"]],
        [['text' => "🎁 Статус тестового аккаунта"]],
        [['text' => "✍️ Название панели"], ['text' => "❌ Удалить панель"]],
        [['text' => "💡 Метод создания имени пользователя"]],
        [['text' => "🔐 Изменить пароль"], ['text' => "👤 Изменить имя пользователя"]],
        [['text' => "🔗 Изменить адрес панели"], ['text' => "💎 Настроить идентификатор Inbound"]],
        [['text' => "🔗 Отправить ссылку на подписку"], ['text' => "⚙️ Отправить конфигурацию"]],
        [['text' => '🔗 Домен ссылки на подписку']],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
$supportoption = json_encode([
        'inline_keyboard' => [
            [
                ['text' => "⁉️ Часто задаваемые вопросы", 'callback_data' => "fqQuestions"] ,
            ],
            [
                ['text' => "🎟 Отправить сообщение в поддержку", 'callback_data' => "support"],
            ],
        ]
    ]);
$perfectmoneykeyboard = json_encode([
    'keyboard' => [
        [['text' => "Настроить номер кошелька"], ['text' => "Настроить номер аккаунта"]],
        [['text' => "Настроить пароль аккаунта"], ['text' => "Статус Perfect Money"]],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
$affiliates =  json_encode([
    'keyboard' => [
        [['text' => "🎁 Статус привлечения партнеров"]],
        [['text' => "🧮 Настроить процент от партнеров"]],
        [['text' => "🏞 Настроить баннер привлечения партнеров"]],
        [['text' => "🎁 Комиссия после покупки"], ['text' => "🎁 Получить подарок"]],
        [['text' => "🌟 Сумма стартового подарка"]],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
$typepanel =  json_encode([
    'keyboard' => [
        [['text' => "marzban"],['text' => "x-ui_single"]],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
$keyboardcronjob =  json_encode([
    'keyboard' => [
        [['text' => 'Активация тестового Cron'], ['text' => 'Деактивация тестового Cron']],
        [['text' => 'Активация объемного Cron'], ['text' => 'Деактивация объемного Cron']],
        [['text' => 'Активация временного Cron'], ['text' => 'Деактивация временного Cron']],
        [['text' => "🏠 Вернуться в меню управления"]]
    ],
    'resize_keyboard' => true
]);
