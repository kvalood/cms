<?php
/* Smarty version 3.1.32, created on 2018-07-10 22:10:35
  from 'C:\SERVER\domains\cms\simpla\design\html\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b44a23b3f2329_02671241',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a5a7eb595be6826de4943d1aaa1cf32206408f04' => 
    array (
      0 => 'C:\\SERVER\\domains\\cms\\simpla\\design\\html\\index.tpl',
      1 => 1505974129,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:admin_menu.tpl' => 1,
    'file:admin_notification.tpl' => 1,
  ),
),false)) {
function content_5b44a23b3f2329_02671241 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Expires" CONTENT="-1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $_smarty_tpl->tpl_vars['meta_title']->value;?>
</title>
    <link rel="icon" type="image/png" href="/simpla/design/images/favicon.png">


    <link href="/simpla/design/css/reset.css" rel="stylesheet" type="text/css" />
    <link href="/simpla/design/css/new_admin_style.css" rel="stylesheet" type="text/css" />
    <link href="/simpla/design/css/style_for_new_admin.css" rel="stylesheet" type="text/css" />
    <link href="/simpla/design/css/new.css" rel="stylesheet" type="text/css" />
    <link href="/simpla/design/css/icon.css" rel="stylesheet" type="text/css" />

    <link href="/simpla/design/css/categories.css" rel="stylesheet" type="text/css" />

    <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

        <?php echo '<script'; ?>
 src="/simpla/design/libs/jquery.2.2.4.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/simpla/design/js/jquery/jquery.form.min.js"><?php echo '</script'; ?>
>

        <?php echo '<script'; ?>
 src="/simpla/design/libs/bootstrap/js/bootstrap.min.js"><?php echo '</script'; ?>
>
    <link href="/simpla/design/libs/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />

        <?php echo '<script'; ?>
 src="/simpla/design/libs/bootstrap-select/bootstrap-select.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/simpla/design/libs/bootstrap-select/ajax-bootstrap-select.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/simpla/design/libs/bootstrap-select/locale/ajax-bootstrap-select.ru-RU.min.js"><?php echo '</script'; ?>
>
    <link href="/simpla/design/libs/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" type="text/css" />

        <?php echo '<script'; ?>
 src="/simpla/design/libs/autocomplete/jquery.autocomplete.min.js"><?php echo '</script'; ?>
>
    <link href="/simpla/design/libs/autocomplete/styles.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"><?php echo '</script'; ?>
>


        <?php echo '<script'; ?>
 src="/simpla/design/libs/datetimepicker/jquery.datetimepicker.full.min.js" type="text/javascript"><?php echo '</script'; ?>
>
    <link href="/simpla/design/libs/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />

        <?php echo '<script'; ?>
 src="/simpla/design/js/core.js"><?php echo '</script'; ?>
>

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
                <?php if (in_array('orders',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
                    <a href="index.php?module=Orderssimpla">Новых заказов <span class="green"><?php echo $_smarty_tpl->tpl_vars['new_orders_counter']->value;?>
</span></a>
                <?php }?>
                </div>

                <div class="right-align col m3 l5 simpla_profile no-mobile no-pad">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
" target="_blank" class="button green">На главную</a>
                    <a href='<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
?logout' class="button red">Выход</a>
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
                <?php $_smarty_tpl->_subTemplateRender('file:admin_menu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            </div>
        </div>
    </div>

    <main>
        <div class="container">
            <div class="content">
                <?php $_smarty_tpl->_subTemplateRender('file:admin_notification.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

            </div>
        </div>

    </main>

    <footer>
        <div class="container">
            &copy; 2016 <a href="http://pulse.studio" target="_blank">Sergey Sysa.</a> Core - SimplaCMS <?php echo $_smarty_tpl->tpl_vars['config']->value->version;?>
 (mod. <?php echo $_smarty_tpl->tpl_vars['config']->value->mod_version;?>
)

            <a href="#" class="right">Помощь по Административной панели</a>
        </div>
    </footer>

</body>
</html>

<?php if ($_smarty_tpl->tpl_vars['settings']->value->pz_server && $_smarty_tpl->tpl_vars['settings']->value->pz_phones[$_smarty_tpl->tpl_vars['manager']->value->login]) {
echo '<script'; ?>
 src="design/js/prostiezvonki/prostiezvonki.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
var pz_type = 'simpla';
var pz_password = '<?php echo $_smarty_tpl->tpl_vars['settings']->value->pz_password;?>
';
var pz_server = '<?php echo $_smarty_tpl->tpl_vars['settings']->value->pz_server;?>
';
var pz_phone = '<?php echo $_smarty_tpl->tpl_vars['settings']->value->pz_phones[$_smarty_tpl->tpl_vars['manager']->value->login];?>
';

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
					NotificationBar('<img src="design/images/phone_sound.png" align=absmiddle> Звонит <a href="index.php?module=Ordersimpla&id='+data[0].id+'">'+data[0].name+'</a>');
				}
				else
				{
					NotificationBar('<img src="design/images/phone_sound.png" align=absmiddle> Звонок с '+event.from+'. <a href="index.php?module=Ordersimpla&phone='+event.from+'">Создать заказ</a>');
				}
			});
        }
    });

});
<?php echo '</script'; ?>
>
<?php }
}
}
