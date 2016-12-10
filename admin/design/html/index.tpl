<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Expires" CONTENT="-1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{$meta_title}</title>
    <link rel="icon" type="image/png" href="/admin/design/images/favicon.png">


    <link href="/admin/design/css/reset.css" rel="stylesheet" type="text/css" />
    <link href="/admin/design/css/new_admin_style.css" rel="stylesheet" type="text/css" />
    <link href="/admin/design/css/style_for_new_admin.css" rel="stylesheet" type="text/css" />
    <link href="/admin/design/css/new.css" rel="stylesheet" type="text/css" />
    <link href="/admin/design/css/icon.css" rel="stylesheet" type="text/css" />

    <link href="/admin/design/css/categories.css" rel="stylesheet" type="text/css" />

    <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

    {* jQuery *}
    <script src="/admin/design/libs/jquery.2.2.4.min.js"></script>
    <script src="/admin/design/js/jquery/jquery.form.min.js"></script>

    {* Bootstrap *}
    <script src="/admin/design/libs/bootstrap/js/bootstrap.min.js"></script>
    <link href="/admin/design/libs/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />

    {* Bootstrap multiselect *}
    <script src="/admin/design/libs/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="/admin/design/libs/bootstrap-select/ajax-bootstrap-select.min.js"></script>
    <link href="/admin/design/libs/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" type="text/css" />

    {* Autocomplete *}
    <script src="/admin/design/libs/autocomplete/jquery.autocomplete.min.js"></script>
    <link href="/admin/design/libs/autocomplete/styles.css" rel="stylesheet" type="text/css" />

    {* jQuery UI *}
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>


    {* Date time picker *}
    <script src="/admin/design/libs/datetimepicker/jquery.datetimepicker.full.min.js" type="text/javascript"></script>
    <link href="/admin/design/libs/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />

    {* Ядро JS движка*}
    <script src="/admin/design/js/core.js"></script>

</head>
<body>

    <header>
        <div class="container">
            <div class="row">

                <div class="col m3 l2 logo no-mobile no-pad">
                    <i class="icon-home"></i>SimplaCMS CE
                </div>

                <div class="col s9 m4 l3 search_box">
                    <i class="icon-search"></i>
                    <input name="search" id="search_autocomplete" data-object="phone" placeholder="Поиск товаров/заказов" autocomplete="off" type="text">
                </div>

                <div class="col m2 l2 header_links no-mobile no-pad">
                {if in_array('orders', $manager->permissions)}
                    <a href="index.php?module=OrdersAdmin">Новых заказов <span class="green">{$new_orders_counter}</span></a>
                {/if}
                </div>

                <div class="right-align col m3 l5 admin_profile no-mobile no-pad">
                    <a href="{$config->root_url}" target="_blank" class="button green">На главную</a>
                    <a href='{$config->root_url}?logout' class="button red">Выход</a>
                </div>

                <div class="pad col s3 right-align mobile_menu">
                    <a href="#"><i class="icon-menu"></i></a>
                </div>

            </div>
        </div>
    </header>

    <div class="admin_menu no-pad no-mobile">
        <div class="container">
            <div class="fow">
                {include file='admin_menu.tpl'}
            </div>
        </div>
    </div>

    <main>
        <div class="container">
            <div class="content">
                {include file='admin_notification.tpl'}

                {$content}
            </div>
        </div>

    </main>

    <footer>
        <div class="container">
            &copy; 2016 <a href="http://pulse.studio" target="_blank">Sergey Sysa.</a> Core - SimplaCMS {$config->version} (mod. {$config->mod_version})

            <a href="#" class="right">Помощь по Административной панели</a>
        </div>
    </footer>

</body>
</html>

{* Интеграция с ПростымиЗвонками *}
{if $settings->pz_server && $settings->pz_phones[$manager->login]}
<script src="design/js/prostiezvonki/prostiezvonki.min.js"></script>
<script>
var pz_type = 'simpla';
var pz_password = '{$settings->pz_password}';
var pz_server = '{$settings->pz_server}';
var pz_phone = '{$settings->pz_phones[$manager->login]}';
{literal}
function NotificationBar(message)
{
	ttop = $('body').height()-110;
	var HTMLmessage = "<div class='notification-message' style='  text-align:center; line-height: 40px;'> " + message + " </div>";
	if ($('#notification-bar').size() == 0)
	{
		$('body').prepend("<div id='notification-bar' style='-moz-border-radius: 5px 5px 5px 5px; -webkit-border-radius: 5px 5px 5px 5px; display:none;  height: 40px; padding: 20px; background-color: #fff; position: fixed; top:"+ttop+"px; right:30px; z-index: 100; color: #000;border: 1px solid #cccccc;'>" + HTMLmessage + "</div>");
	}
	else
    {
    	$('#notification-bar').html(HTMLmessage);
    }
    $('#notification-bar').slideDown();
}

$(window).on("blur focus", function (e) {
    if ($(this).data('prevType') !== e.type) {
        $(this).data('prevType', e.type);

        switch (e.type) {
        case 'focus':
            if (!pz.isConnected()) {
				pz.connect({
				            client_id: pz_password,
				            client_type: pz_type,
				            host: pz_server
				});
            }
            break;
        }
    }
});

$(function() {
	// Простые звонки
	pz.setUserPhone(pz_phone);
	pz.connect({
                client_id: pz_password,
                client_type: pz_type,
                host: pz_server
	});
    pz.onConnect(function () {
        $(".ip_call").addClass('phone');
    });
    pz.onDisconnect(function () {
        $(".ip_call").removeClass('phone');
    });

    $(".ip_call").click( function() {
        var phone = $(this).attr('data-phone').trim();
        pz.call(phone);
        return false;
    });

    pz.onEvent(function (event) {
        if (event.isIncoming()) {
			$.ajax({
				type: "GET",
				url: "ajax/search_orders.php",
				data: { keyword: event.from, limit:"1"},
				dataType: 'json'
			}).success(function(data){
				if(event.to == pz_phone)
				if(data.length>0)
				{
					NotificationBar('<img src="design/images/phone_sound.png" align=absmiddle> Звонит <a href="index.php?module=OrderAdmin&id='+data[0].id+'">'+data[0].name+'</a>');
				}
				else
				{
					NotificationBar('<img src="design/images/phone_sound.png" align=absmiddle> Звонок с '+event.from+'. <a href="index.php?module=OrderAdmin&phone='+event.from+'">Создать заказ</a>');
				}
			});
        }
    });
{/literal}
});
</script>
{/if}